<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Consultation;
use App\Models\Rendezvous;
use App\Models\Availability;
use App\Models\LabResult; // Importé pour les analyses
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Importé pour les PDF

class PatientController extends Controller
{
    /**
     * Liste des patients du médecin avec statistiques.
     */
    public function index()
    {
        $patients = User::where('role', 'patient')
            ->whereHas('rendezvous', function ($query) {
                $query->where('medecin_id', Auth::id()); 
            })
            ->withCount(['rendezvous' => function ($query) {
                $query->where('medecin_id', Auth::id());
            }])
            ->orderBy('name', 'asc')
            ->paginate(15);

        return view('doctor.patients.index', compact('patients'));
    }

    /**
     * Dossier médical complet (Consultations + Analyses).
     */
    public function show($id)
    {
        $user = User::where('role', 'patient')->findOrFail($id);

        $dernierRdv = Rendezvous::where('patient_id', $user->id)
            ->where('medecin_id', Auth::id())
            ->where('statut', 'confirme')
            ->latest()
            ->first();

        $consultations = Consultation::where('patient_id', $id)
            ->with('medecin')
            ->latest()
            ->get();

        // Ajout des analyses pour le dossier premium
        $analyses = LabResult::where('user_id', $id)
            ->latest()
            ->get();

        return view('doctor.patients.show', [
            'patient'       => $user,
            'consultations' => $consultations,
            'analyses'      => $analyses,
            'dernierRdv'    => $dernierRdv 
        ]);
    }

    /**
     * Enregistre une consultation et clôture le RDV.
     */
    public function storeConsultation(Request $request)
    {
        $validated = $request->validate([
            'rendezvous_id'   => 'required|exists:rendezvous,id',
            'patient_id'      => 'required|exists:users,id',
            'diagnostic'      => 'required|string',
            'observations'    => 'nullable|string',
            'poids'           => 'nullable|numeric',
            'tension'         => 'nullable|string',
            'temperature'     => 'nullable|numeric',
            'groupe_sanguin'  => 'nullable|string|max:5',
            'antecedents'     => 'nullable|string',
            'allergies'       => 'nullable|string',
        ]);

        // 1. Mise à jour du dossier permanent
        $patient = User::findOrFail($validated['patient_id']);
        $patient->update([
            'groupe_sanguin' => $validated['groupe_sanguin'],
            'antecedents'    => $validated['antecedents'],
            'allergies'      => $validated['allergies'],
        ]);

        // 2. Création de la Consultation
        Consultation::create([
            'rendezvous_id' => $validated['rendezvous_id'],
            'patient_id'    => $validated['patient_id'],
            'doctor_id'     => Auth::id(), 
            'diagnostic'    => $validated['diagnostic'],
            'observations'  => $validated['observations'],
            'tension'       => $validated['tension'],
            'temperature'   => $validated['temperature'],
            'poids'         => $validated['poids'],
        ]);

        // 3. Clôture du RDV et Disponibilité
        $rdv = Rendezvous::findOrFail($validated['rendezvous_id']);
        $rdv->update(['statut' => 'termine']);

        if ($rdv->availability_id) {
            Availability::where('id', $rdv->availability_id)->update(['is_booked' => true]);
        }

        return redirect()
            ->route('doctor.patients.show', $validated['patient_id'])
            ->with('success', 'Consultation enregistrée.');
    }

    /**
     * Téléchargement PDF pour le Docteur ou le Patient (Sécurisé).
     */
    public function downloadAnalysis($id)
    {
        $analyse = LabResult::with(['user', 'consultation'])->findOrFail($id);

        // Sécurité : Seul le patient concerné ou un médecin peut télécharger
        if (Auth::user()->role === 'patient' && $analyse->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé.');
        }

        if ($analyse->statut !== 'termine') {
            return back()->with('error', 'Le résultat n\'est pas encore validé.');
        }

        $pdf = Pdf::loadView('doctor.analyses.pdf', compact('analyse'));
        
        $fileName = 'Resultat_' . str_replace(' ', '_', $analyse->user->name) . '_' . $analyse->id . '.pdf';
        return $pdf->download($fileName);
    }

    /**
     * Mise à jour rapide du dossier médical.
     */
    public function updateMedicalInfo(Request $request, $id)
    {
        $user = User::where('role', 'patient')->findOrFail($id);

        $validated = $request->validate([
            'sexe'                    => 'nullable|string|in:M,F',
            'date_naissance'          => 'nullable|date',
            'groupe_sanguin'          => 'nullable|string|max:5',
            'telephone'               => 'nullable|string|max:20',
            'adresse'                 => 'nullable|string|max:255',
            'antecedents'             => 'nullable|string',
            'allergies'               => 'nullable|string',
            'observations_medicales'  => 'nullable|string',
            'numero_securite_sociale' => 'nullable|string|max:50',
        ]);

        $user->update($validated);

        return back()->with('success', "Dossier de {$user->name} mis à jour.");
    }
}