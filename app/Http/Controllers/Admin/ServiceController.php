<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;  // ← AJOUTER CETTE LIGNE
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    /**
     * Affiche la liste des services
     */
    public function index(Request $request): View
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('nom', 'LIKE', '%' . $request->search . '%');
        }

        $services = $query->paginate(10);
        
        // 🔥 Ajout des statistiques pour la navbar
        $stats = [
            'new_users_month' => User::where('created_at', '>=', now()->startOfMonth())->count()
        ];

        return view('admin.services.index', compact('services', 'stats'));
    }

    /**
     * Enregistre un nouveau service
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:services,nom',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'etage' => 'nullable|string|max:100',
        ]);

        Service::create($request->all());

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service ajouté avec succès.');
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Met à jour un service
     */
    public function update(Request $request, Service $service): RedirectResponse
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:services,nom,' . $service->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'etage' => 'nullable|string|max:100',
        ]);

        $service->update($request->all());

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service modifié avec succès.');
    }

    /**
     * Supprime un service
     */
    public function destroy(Service $service): RedirectResponse
    {
        // Vérifier si des médecins sont rattachés à ce service
        if ($service->medecins()->count() > 0) {
            return back()->with('error', 'Impossible de supprimer ce service car des médecins y sont rattachés.');
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service supprimé avec succès.');
    }
}