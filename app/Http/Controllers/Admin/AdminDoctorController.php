<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Medecin;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminDoctorController extends Controller
{
    /**
     * Affiche la liste de tous les médecins avec leur profil détaillé.
     */
    public function index(Request $request): View
    {
        // On récupère les utilisateurs médecins avec leur profil lié dans la table 'medecins'
        $query = User::where('role', 'medecin')->with(['medecin', 'specialite']);

        // Filtre par nom/email
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filtre par spécialité via la relation medecin
        if ($request->filled('specialite')) {
            $query->whereHas('medecin', function($q) use ($request) {
                $q->where('specialite_id', $request->specialite);
            });
        }

        $medecins = $query->latest()->paginate(10)->withQueryString();
        $specialites = Specialite::all();
        
        // 🔥 Ajout des statistiques pour la navbar
        $stats = [
            'new_users_month' => User::where('created_at', '>=', now()->startOfMonth())->count()
        ];

        return view('admin.medecins.index', compact('medecins', 'specialites', 'stats'));
    }

    /**
     * Valider ou Suspendre un médecin
     */
    public function validateDoctor($id): RedirectResponse
    {
        $medecinProfil = Medecin::findOrFail($id);
        
        $medecinProfil->est_valide = !$medecinProfil->est_valide;
        $medecinProfil->save();

        $statusMessage = $medecinProfil->est_valide 
            ? "Le compte du médecin a été validé. Il peut maintenant se connecter." 
            : "Le compte du médecin a été suspendu.";

        return redirect()->back()->with('success', $statusMessage);
    }

    /**
     * Formulaire de création d'un médecin.
     */
    public function create(): View
    {
        $specialites = Specialite::all();
        return view('admin.medecins.create', compact('specialites'));
    }

    /**
     * Enregistre un nouveau médecin.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'specialite_id' => 'required|exists:specialites,id',
            'matricule' => 'required|string|unique:medecins,matricule',
            'numero_ordre' => 'nullable|string|max:30|unique:medecins,numero_ordre',
            'cabinet_nom' => 'nullable|string|max:255',
            'cabinet_adresse' => 'nullable|string|max:500',
            'cabinet_telephone' => 'nullable|string|max:20',
            'cabinet_ville' => 'nullable|string|max:100',
        ]);

        $tempPassword = 'Clinique2026!';

        // 1. Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
            'role' => 'medecin',
            'is_active' => true,
            'must_change_password' => true, 
        ]);

        // 2. Création du profil médecin lié
        Medecin::create([
            'user_id' => $user->id,
            'specialite_id' => $request->specialite_id,
            'matricule' => $request->matricule,
            'numero_ordre' => $request->numero_ordre,
            'cabinet_nom' => $request->cabinet_nom,
            'cabinet_adresse' => $request->cabinet_adresse,
            'cabinet_telephone' => $request->cabinet_telephone,
            'cabinet_ville' => $request->cabinet_ville,
            'est_valide' => true, 
        ]);

        return redirect()->route('admin.medecins.index')
            ->with('success', "Compte créé avec succès. Mot de passe temporaire : $tempPassword");
    }

    /**
     * Formulaire d'édition d'un médecin.
     */
    public function edit($id): View
    {
        $medecin = User::with('medecin')->findOrFail($id);

        if ($medecin->role !== 'medecin') {
            return redirect()->route('admin.medecins.index')
                ->with('error', 'Cet utilisateur n\'est pas un médecin.');
        }

        $specialites = Specialite::all();
        return view('admin.medecins.edit', compact('medecin', 'specialites'));
    }

    /**
     * Met à jour les informations du médecin.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'specialite_id' => 'required|exists:specialites,id',
            'matricule' => 'required|string|unique:medecins,matricule,' . ($user->medecin->id ?? 0),
            'numero_ordre' => 'nullable|string|unique:medecins,numero_ordre,' . ($user->medecin->id ?? 0),
            'cabinet_nom' => 'nullable|string|max:255',
            'cabinet_adresse' => 'nullable|string|max:500',
            'cabinet_telephone' => 'nullable|string|max:20',
            'cabinet_ville' => 'nullable|string|max:100',
        ]);

        // Mise à jour User
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Mise à jour Profil Medecin
        if($user->medecin) {
            $user->medecin->update([
                'specialite_id' => $request->specialite_id,
                'matricule' => $request->matricule,
                'numero_ordre' => $request->numero_ordre,
                'cabinet_nom' => $request->cabinet_nom,
                'cabinet_adresse' => $request->cabinet_adresse,
                'cabinet_telephone' => $request->cabinet_telephone,
                'cabinet_ville' => $request->cabinet_ville,
            ]);
        }

        return redirect()->route('admin.medecins.index')
            ->with('success', 'Informations du médecin mises à jour.');
    }

    /**
     * Supprime un médecin.
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'medecin') {
            $user->delete();
            return redirect()->route('admin.medecins.index')
                ->with('success', 'Compte médecin supprimé.');
        }

        return redirect()->route('admin.medecins.index')
            ->with('error', 'Action non autorisée.');
    }
}