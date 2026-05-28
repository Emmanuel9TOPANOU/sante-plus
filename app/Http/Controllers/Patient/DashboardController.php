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

        // 2. Dernières Analyses (LabResult)
        // On utilise la relation définie dans ton modèle User
        $dernieresAnalyses = $user->analyses()
            ->latest()
            ->take(3)
            ->get();

        // 3. Calcul des statistiques
        $stats = [
            'rdv_count'         => $prochainsRendezVous->count(),
            'analyses_count'    => $user->analyses()->count(),
        ];

        return view('patient.dashboard', compact(
            'user', // On passe directement $user
            'prochainsRendezVous', 
            'dernieresAnalyses',
            'stats'
        ));
    }


    public function history()
{
    $user = Auth::user();
    
    // 1. On définit $infosSante (qui est l'utilisateur lui-même pour ses allergies/antécédents)
    $infosSante = $user; 

    // 2. On récupère les rendez-vous passés (l'historique) avec la pagination
    // On utilise le nom $historique car c'est ce que ta vue utilise dans son @forelse
    $historique = $user->rendezvous()
        ->with(['medecin.specialite', 'consultation.analyses'])
        ->where('statut', 'termine')
        ->latest('date_rdv')
        ->paginate(10); // Importante pour la ligne {{ $historique->links() }} de ta vue

    return view('patient.history.index', compact('historique', 'infosSante'));
}
}