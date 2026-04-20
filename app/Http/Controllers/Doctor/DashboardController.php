<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rendezvous;
use App\Models\User;
use App\Models\Note;
use App\Models\Medecin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Affiche le tableau de bord du médecin.
     */
    public function index()
    {
        // On récupère l'utilisateur avec son profil médecin et sa spécialité liée
        $user = Auth::user()->load(['medecin.specialite']);

        // 1. Rendez-vous du jour
        // CORRECTION : On ajoute le filtre statut != 'annule' pour qu'ils disparaissent du dashboard
        $rendezvous = Rendezvous::where('medecin_id', $user->id)
            ->whereDate('date_rdv', Carbon::today())
            ->where('statut', '!=', 'annule') 
            ->with('patient') 
            ->orderBy('heure_rdv', 'asc')
            ->get();

        // 2. Nombre total de patients uniques (uniquement ceux qui n'ont pas tout annulé)
        $totalPatients = Rendezvous::where('medecin_id', $user->id)
            ->where('statut', '!=', 'annule')
            ->distinct('patient_id')
            ->count('patient_id');

        // 3. Messages non lus
        $messagesNonLus = $user->messagesReceived()
            ->where('is_read', false)
            ->count();

        // 4. Dernière note personnelle
        $derniereNote = Note::where('user_id', $user->id)
            ->latest()
            ->first();

        // 5. Nouveaux patients (Inscrits ce mois-ci globalement)
        $nouveauxPatients = User::where('role', 'patient')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        return view('doctor.dashboard', compact(
            'user',
            'rendezvous',
            'totalPatients',
            'nouveauxPatients',
            'messagesNonLus',
            'derniereNote'
        ));
    }

    /**
     * Confirmer un rendez-vous
     */
    public function confirmerRDV(Rendezvous $rendezvous)
    {
        // Sécurité : Vérifier que le RDV appartient bien au médecin connecté
        if ($rendezvous->medecin_id !== Auth::id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        $rendezvous->update(['statut' => 'confirme']);
        
        return back()->with('success', 'Rendez-vous confirmé avec succès.');
    }

    /**
     * Annuler un rendez-vous (Action depuis le dashboard médecin)
     */
    public function annulerRDV(Rendezvous $rendezvous)
    {
        if ($rendezvous->medecin_id !== Auth::id()) {
            return back()->with('error', 'Action non autorisée.');
        }

        $rendezvous->update(['statut' => 'annule']);

        // Le rendez-vous disparaîtra automatiquement au prochain rechargement grâce au filtre dans index()
        return back()->with('warning', 'Le rendez-vous a été annulé.');
    }

    /**
     * Enregistre une nouvelle note du cabinet.
     */
    public function storeNote(Request $request)
    {
        $request->validate([
            'contenu' => 'required|string|max:1000',
        ]);

        Note::create([
            'user_id' => Auth::id(),
            'contenu' => $request->contenu,
        ]);

        return back()->with('success', 'Note enregistrée.');
    }
}