<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Specialite;
use App\Models\Rendezvous;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RendezvousController extends Controller
{
    /**
     * Liste des rendez-vous du patient
     */
    public function index(): View
    {
        $rendezvous = Auth::user()->rendezvous()
            ->with(['medecin.specialite'])
            ->orderBy('date_rdv', 'desc')
            ->orderBy('heure_rdv', 'desc')
            ->paginate(10);

        return view('patient.rendezvous.index', compact('rendezvous'));
    }

    /**
     * Formulaire de prise de rendez-vous
     */
 public function create(): View
    {
        // 1. Récupération des médecins avec leur spécialité (Jointure indispensable)
        $medecins = DB::table('medecins')
            ->join('users', 'medecins.user_id', '=', 'users.id')
            ->select(
                'medecins.id',           // ID de la table medecins (utilisé pour le store)
                'users.id as user_id',   // ID de l'utilisateur (utilisé pour les dispos)
                'users.name', 
                'medecins.specialite_id'
            )
            ->where('medecins.est_valide', 1)
            ->get();

        // 2. Récupération des spécialités pour le filtre
        $specialites = Specialite::all();

        // 3. Récupération des disponibilités non réservées
        $allAvailabilities = Availability::where('is_booked', false)
            ->where('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        // 4. Construction du tableau des disponibilités
        $disponibilites = [];
        foreach ($allAvailabilities as $avail) {
            $heureCle = Carbon::parse($avail->start_time)->format('H:i');
            $dateCle = ($avail->date instanceof Carbon) ? $avail->date->format('Y-m-d') : $avail->date;
            
            // On indexe par user_id car c'est ce qui lie Availability et Users
            $disponibilites[$avail->user_id][$dateCle][] = $heureCle;
        }

        return view('patient.rendezvous.create', compact('medecins', 'specialites', 'disponibilites'));
    }
    /**
     * Enregistrement d'un nouveau rendez-vous
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'medecin_id' => 'required|exists:medecins,id',
        'date_rdv'   => 'required|date|after_or_equal:today',
        'heure_rdv'  => 'required',
        'motif'      => 'nullable|string|max:255',
    ]);

    try {
        // 1. Récupérer les infos du médecin (pour avoir son user_id)
        $medecinTable = \DB::table('medecins')->where('id', $request->medecin_id)->first();

        // 2. Insertion avec le BON ID (celui de l'utilisateur médecin)
        \App\Models\Rendezvous::create([
            'patient_id' => \Auth::id(),
            // CRUCIAL : On utilise l'ID de l'utilisateur, pas l'ID de la table medecins
            'medecin_id' => $medecinTable->user_id, 
            'cree_par'   => \Auth::id(),
            'date_rdv'   => $request->date_rdv,
            'heure_rdv'  => $request->heure_rdv,
            'motif'      => $request->motif,
            'statut'     => 'en_attente',
        ]);

        // 3. Marquer le créneau comme réservé
        \App\Models\Availability::where('user_id', $medecinTable->user_id)
            ->where('date', $request->date_rdv)
            ->where('start_time', 'LIKE', $request->heure_rdv . '%')
            ->update(['is_booked' => true]);

        return redirect()->route('patient.rendezvous.index')
            ->with('success', 'Votre rendez-vous a été enregistré avec succès.');

    } catch (\Exception $e) {
        dd("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
}

    /**
     * Formulaire de modification d'un rendez-vous
     */
    public function edit($id): View
    {
        $rendezvous = Auth::user()->rendezvous()->findOrFail($id);

        // Sécurité : On ne modifie pas un RDV passé ou à moins de 24h
        $dateStr = ($rendezvous->date_rdv instanceof Carbon) ? $rendezvous->date_rdv->format('Y-m-d') : $rendezvous->date_rdv;
        $dateTimeRdv = Carbon::parse($dateStr . ' ' . $rendezvous->heure_rdv);
        
        if ($dateTimeRdv->isPast() || Carbon::now()->diffInHours($dateTimeRdv, false) < 24) {
            abort(403, 'Modification impossible moins de 24h avant le rendez-vous.');
        }

        $medecins = User::where('role', 'medecin')->get();
        $specialites = Specialite::all();

        // Récupération des disponibilités pour le formulaire
        $allAvailabilities = Availability::where('is_booked', false)
            ->where('date', '>=', now()->toDateString())
            ->get();

        $disponibilites = [];
        foreach ($allAvailabilities as $avail) {
            $heureCle = Carbon::parse($avail->start_time)->format('H:i');
            $dateCle = ($avail->date instanceof Carbon) ? $avail->date->format('Y-m-d') : $avail->date;
            $disponibilites[$avail->user_id][$dateCle][] = $heureCle;
        }

        return view('patient.rendezvous.edit', compact('rendezvous', 'medecins', 'specialites', 'disponibilites'));
    }

    /**
     * Mise à jour du rendez-vous
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $rendezvous = Auth::user()->rendezvous()->findOrFail($id);

        $request->validate([
            'medecin_id' => 'required|exists:users,id',
            'date_rdv'   => 'required|date|after_or_equal:today',
            'heure_rdv'  => 'required',
            'motif'      => 'nullable|string|max:255',
        ]);

        // Si la date ou l'heure change, on vérifie la nouvelle disponibilité
        if ($rendezvous->date_rdv != $request->date_rdv || substr($rendezvous->heure_rdv, 0, 5) != substr($request->heure_rdv, 0, 5)) {
            
            $newDispo = Availability::where('user_id', $request->medecin_id)
                ->where('date', $request->date_rdv)
                ->where('start_time', 'LIKE', $request->heure_rdv . '%')
                ->where('is_booked', false)
                ->first();

            if (!$newDispo) {
                return back()->withInput()->with('error', 'Le nouveau créneau choisi n\'est pas disponible.');
            }

            // 1. Libérer l'ancien créneau
            $this->libererCreneau($rendezvous);

            // 2. Réserver le nouveau
            $newDispo->update(['is_booked' => true]);
        }

        // 3. Mise à jour des infos
        $rendezvous->update([
            'medecin_id' => $request->medecin_id,
            'date_rdv'   => $request->date_rdv,
            'heure_rdv'  => $request->heure_rdv,
            'motif'      => $request->motif,
            'statut'     => 'en_attente', // Repasse en attente après modification
        ]);

        return redirect()->route('patient.rendezvous.index')
            ->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    /**
     * Annulation via bouton classique
     */
    public function destroy($id): RedirectResponse
    {
        $rendezvous = Auth::user()->rendezvous()->findOrFail($id);
        
        $dateStr = ($rendezvous->date_rdv instanceof Carbon) ? $rendezvous->date_rdv->format('Y-m-d') : $rendezvous->date_rdv;
        $dateTimeRdv = Carbon::parse($dateStr . ' ' . $rendezvous->heure_rdv);
        
        if ($dateTimeRdv->isPast() || Carbon::now()->diffInHours($dateTimeRdv, false) < 24) {
            return back()->with('error', 'Annulation impossible moins de 24h avant.');
        }

        $this->libererCreneau($rendezvous);
        $rendezvous->update(['statut' => 'annule']);

        return back()->with('success', 'Le rendez-vous a été annulé avec succès.');
    }

    /**
     * Annulation rapide (Page succès premium)
     */
    public function annulationRapide($id): View
    {
        $rendezvous = Auth::user()->rendezvous()->with('medecin')->findOrFail($id);
        
        $dateStr = ($rendezvous->date_rdv instanceof Carbon) ? $rendezvous->date_rdv->format('Y-m-d') : $rendezvous->date_rdv;
        $dateTimeRdv = Carbon::parse($dateStr . ' ' . $rendezvous->heure_rdv);
        
        if ($rendezvous->statut === 'annule') {
            return view('patient.rendezvous.annulation_succes', ['rendezvous' => $rendezvous, 'info' => 'Déjà annulé.']);
        }

        if ($dateTimeRdv->isPast()) {
            return view('patient.rendezvous.annulation_success', ['rendezvous' => $rendezvous, 'error_msg' => 'Date passée.']);
        }

        $this->libererCreneau($rendezvous);
        $rendezvous->update(['statut' => 'annule']);

        return view('patient.rendezvous.annulation_succes', compact('rendezvous'));
    }

    /**
     * Libération du créneau
     */
    private function libererCreneau($rendezvous)
    {
        $dateStr = ($rendezvous->date_rdv instanceof Carbon) ? $rendezvous->date_rdv->format('Y-m-d') : $rendezvous->date_rdv;
        $heureNettoyee = substr($rendezvous->heure_rdv, 0, 5);

        Availability::where('user_id', $rendezvous->medecin_id)
            ->where('date', $dateStr)
            ->where('start_time', 'LIKE', $heureNettoyee . '%')
            ->update(['is_booked' => false]);
    }
}