<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * 1️⃣ Voir la liste des utilisateurs (avec filtres)
     */
  public function index(Request $request)
{
    $query = User::with(['medecin', 'specialite']);

    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        });
    }

    if ($request->filled('specialite')) {
        $query->whereHas('medecin', function($q) use ($request) {
            $q->where('specialite_id', $request->specialite);
        });
    }

    $users = $query->latest()->paginate(10)->withQueryString();
    $specialites = Specialite::all();
    
    // 🔥 Ajout des statistiques
    $stats = [
        'new_users_month' => User::where('created_at', '>=', now()->startOfMonth())->count()
    ];

    return view('admin.users.index', compact('users', 'specialites', 'stats'));
}

    /**
     * Formulaire de création
     */
    public function create()
    {
        $specialites = Specialite::all();
        return view('admin.users.create', compact('specialites'));
    }

    /**
     * Enregistrement d'un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,medecin,secretaire,patient',
            'specialite_id' => 'required_if:role,medecin|nullable|exists:specialites,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'specialite_id' => ($request->role === 'medecin') ? $request->specialite_id : null,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "L'utilisateur {$user->name} a été créé avec succès.");
    }

    /**
     *  Formulaire de modification (C'est ce qui manquait !)
     */
    public function edit(User $user)
    {
        $specialites = Specialite::all();
        return view('admin.users.edit', compact('user', 'specialites'));
    }

    /**
     *  Mise à jour des informations
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,medecin,secretaire,patient',
            'specialite_id' => 'required_if:role,medecin|nullable|exists:specialites,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'specialite_id' => ($request->role === 'medecin') ? $request->specialite_id : null,
        ];

        // On ne change le mot de passe que s'il est rempli
        if ($request->filled('password')) {
            $request->validate(['password' => 'confirmed|min:8']);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', "Le profil de {$user->name} a été mis à jour.");
    }

    /**
     * Réinitialiser un mot de passe
     */
    public function resetPassword(Request $request, User $user)
    {
        $user->update([
            'password' => Hash::make('Hospit2026')
        ]);

        return back()->with('success', 'Le mot de passe a été réinitialisé à : Hospit2026');
    }

    /**
     * Activer/Désactiver le compte
     */
    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas vous désactiver vous-même.');
        }

        $user->is_active = !$user->is_active; 
        $user->save();

        $status = $user->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Le compte de {$user->name} a été {$status}.");
    }

    /**
     * Supprimer un compte
     */
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Action impossible sur votre propre compte.');
        }

        $user->delete();
        return back()->with('success', 'Utilisateur supprimé définitivement.');
    }
}