<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // 1. Prochains Rendez-vous
        // On charge 'medecin' car c'est un BelongsTo vers la table Users
        $prochainsRendezVous = $user->rendezvous()
            ->with(['medecin']) 
            ->where('date_rdv', '>=', now()->toDateString())
            ->whereIn('statut', ['en_attente', 'confirme'])
            ->orderBy('date_rdv')
            ->orderBy('heure_rdv')
            ->get();

        // 2. Dernières Ordonnances
        // ATTENTION : 'medecin' est déjà un User, donc pas de .user après
        $dernieresOrdonnances = $user->ordonnances()
            ->with(['medecin']) 
            ->latest()
            ->take(5)
            ->get();

        // 3. Dernières Analyses (LabResult)
        // On utilise la relation définie dans ton modèle User
        $dernieresAnalyses = $user->analyses()
            ->latest()
            ->take(3)
            ->get();

        // 4. Calcul des statistiques
        $stats = [
            'rdv_count'         => $prochainsRendezVous->count(),
            'ordonnances_count' => $user->ordonnances()->count(),
            'analyses_count'    => $user->analyses()->count(),
        ];

        return view('patient.dashboard', compact(
            'user', // On passe directement $user
            'prochainsRendezVous', 
            'dernieresOrdonnances',
            'dernieresAnalyses',
            'stats'
        ));
    }
}