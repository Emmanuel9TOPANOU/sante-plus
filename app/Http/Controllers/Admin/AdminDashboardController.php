<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Note; // Import du modèle Note
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Affiche le tableau de bord avec les statistiques et le journal de bord.
     */
    public function index()
    {
        // 1. Statistiques des compteurs (KPI)
        $stats = [
            'total_users'      => User::count(),
            'total_patients'   => User::where('role', 'patient')->count(), 
            'total_medecins'   => User::where('role', 'medecin')->count(),
            'total_documents'  => Document::count(),
            'new_users_month'  => User::whereMonth('created_at', now()->month)->count(),
        ];

        // 2. Répartition des utilisateurs par rôle
        $userDistribution = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get();

        // 3. Activité récente
        $recentUsers = User::latest()->take(5)->get();

        // 4. RÉCUPÉRATION DE LA NOTE (Le point manquant)
        // On récupère la note de l'admin connecté pour l'afficher dynamiquement
        $adminNote = Note::where('user_id', Auth::id())->first();

        return view('admin.dashboard', compact(
            'stats', 
            'userDistribution', 
            'recentUsers', 
            'adminNote'
        ));
    }

    /**
     * Affiche des statistiques plus détaillées.
     */
    public function stats()
    {
        return view('admin.stats');
    }
}