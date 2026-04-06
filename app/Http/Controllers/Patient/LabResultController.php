<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf; 

class LabResultController extends Controller
{
    /**
     * Affiche la liste des résultats d'analyses pour le patient connecté.
     */
    public function index(): View|RedirectResponse
    {
        $user = Auth::user();

        // 1. Sécurité : Vérification de la session
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. Récupération des analyses via la relation définie dans User.php
        $analyses = $user->analyses()
            ->latest()
            ->paginate(10);

        return view('patient.lab_results.index', compact('analyses'));
    }

    /**
     * Permet de voir le détail d'une analyse spécifique.
     */
    public function show($id): View|RedirectResponse
    {
        $user = Auth::user();
        
        // On récupère l'analyse uniquement si elle appartient à ce patient
        $analyse = $user->analyses()->findOrFail($id);

        return view('patient.lab_results.show', compact('analyse'));
    }

    /**
     * Génère et télécharge le résultat de l'analyse en PDF.
     */
    public function download($id)
    {
        $user = Auth::user();

        // 1. Récupération sécurisée via la relation utilisateur
        $analyse = $user->analyses()->findOrFail($id);

        // 2. Vérification du statut pour éviter le téléchargement de résultats vides
        if ($analyse->statut !== 'termine') {
            return back()->with('error', 'Le document n\'est pas encore disponible au téléchargement.');
        }

        // 3. Appel de la vue PDF (Corrigé selon tes captures d'écran)
        // Comme ton fichier est dans resources/views/doctor/analyses/
        $pdf = Pdf::loadView('doctor.analyses.pdf', [
            'analyse' => $analyse,
            'user' => $user,
            'date' => now()->format('d/m/Y')
        ]);

        // 4. Nettoyage du nom de fichier pour le téléchargement
        $fileName = 'Resultat_' . str_replace(' ', '_', $analyse->type_analyse) . '_' . $analyse->id . '.pdf';

        return $pdf->download($fileName);
    }
}