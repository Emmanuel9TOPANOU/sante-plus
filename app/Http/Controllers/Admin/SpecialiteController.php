<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialite;
use App\Models\User;  // ← AJOUTER CETTE LIGNE
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SpecialiteController extends Controller
{
    /**
     * Affiche la liste des spécialités avec filtrage et pagination.
     */
    public function index(Request $request)
    {
        $query = Specialite::query();

        if ($request->filled('search')) {
            $query->where('nom_specialite', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('description', 'LIKE', '%' . $request->search . '%');
        }

        $specialites = $query->paginate(10)->withQueryString();
        
        // Ajouter les statistiques pour la navbar
        $stats = [
            'new_users_month' => User::where('created_at', '>=', now()->startOfMonth())->count()
        ];

        return view('admin.specialites.index', compact('specialites', 'stats'));
    }

    /**
     * Enregistre une nouvelle spécialité avec messages personnalisés.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom_specialite' => 'required|string|unique:specialites,nom_specialite|max:100',
            'description'    => 'nullable|string|max:500'
        ], [
            'nom_specialite.unique' => 'Cette discipline existe déjà dans le répertoire.',
            'nom_specialite.required' => 'Le nom de la spécialité est obligatoire.'
        ]);

        Specialite::create($validated);

        return back()->with('success', 'La nouvelle discipline a été propulsée avec succès.');
    }

    /**
     * Met à jour une spécialité existante (ignore l'ID actuel pour l'unicité).
     */
    public function update(Request $request, Specialite $specialite): RedirectResponse
    {
        $validated = $request->validate([
            'nom_specialite' => 'required|string|max:100|unique:specialites,nom_specialite,' . $specialite->id,
            'description'    => 'nullable|string|max:500'
        ]);

        $specialite->update($validated);

        return back()->with('success', 'La spécialité a été mise à jour avec succès.');
    }

    /**
     * Supprime une spécialité si aucun médecin n'y est lié.
     */
    public function destroy(Specialite $specialite): RedirectResponse
    {
        // Protection de l'intégrité des données
        if ($specialite->users()->exists()) {
            return back()->with('error', 'Action impossible : des médecins sont actuellement rattachés à cette discipline.');
        }

        $specialite->delete();

        return back()->with('success', 'La discipline a été retirée du répertoire.');
    }
}