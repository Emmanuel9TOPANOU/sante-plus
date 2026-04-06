<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Rendezvous;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MedicalRecordController extends Controller
{
    /**
     * Affiche le dossier médical avec les alertes ET l'historique
     */
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 1. Les infos de santé sont portées directement par l'objet User
        $infosSante = $user; 

        // 2. Récupération de l'historique
        // AJOUT : 'consultation' pour afficher les observations
        // AJOUT : 'medecin.specialite' pour charger la relation HasOneThrough
        $historique = Rendezvous::where('patient_id', $user->id)
    ->with([
        'medecin.specialite', // Charge la spécialité via le HasOneThrough de User
        'consultation'        // Charge la table des comptes-rendus
    ])
    ->whereIn('statut', ['termine', 'confirme'])
    ->latest('date_rdv')
    ->paginate(5);

        return view('patient.history.index', compact('infosSante', 'historique'));
    }

    /**
     * Historique détaillé (Ordonnances)
     */
    public function history(): View|RedirectResponse
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $ordonnances = $user->ordonnances() 
            ->with(['rendezvous.medecin.specialite'])
            ->latest()
            ->paginate(10);

        return view('patient.prescriptions.index', compact('ordonnances')); 
    }
}