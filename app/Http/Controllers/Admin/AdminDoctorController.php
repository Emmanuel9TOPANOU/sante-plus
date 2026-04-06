<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Medecin; // Ajouté
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminDoctorController extends Controller
{
    /**
     * Affiche la liste de tous les médecins avec leur profil détaillé.
     */
    public function index(Request $request)
    {
        // On récupère les utilisateurs médecins avec leur profil lié dans la table 'medecins'
        $query = User::where('role', 'medecin')->with(['medecin', 'specialite']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($request->filled('specialite')) {
            $query->where('specialite_id', $request->specialite);
        }

        $medecins = $query->latest()->paginate(10)->withQueryString();
        $specialites = Specialite::all();

        return view('admin.medecins.index', compact('medecins', 'specialites'));
    }

    /**
     * NOUVELLE MÉTHODE : Valider ou Suspendre un médecin (Option A)
     */
    public function validateDoctor($id)
    {
        
        // On cherche dans la table 'medecins' via l'ID du profil médecin
        $medecinProfil = Medecin::findOrFail($id);
        
        // Bascule entre true et false
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
    public function create()
    {
        $specialites = Specialite::all();
        return view('admin.medecins.create', compact('specialites'));
    }

    /**
     * Enregistre un nouveau médecin (Création forcée par l'admin).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'specialite_id' => 'required|exists:specialites,id',
            'matricule' => 'required|string|unique:medecins,matricule',
        ]);

        $tempPassword = 'Clinique2026!';

        // 1. Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($tempPassword),
            'role' => 'medecin',
            'specialite_id' => $request->specialite_id,
            'is_active' => true,
            'must_change_password' => true, 
        ]);

        // 2. Création du profil médecin lié (validé par défaut car créé par l'admin)
        Medecin::create([
            'user_id' => $user->id,
            'specialite_id' => $request->specialite_id,
            'matricule' => $request->matricule,
            'est_valide' => true, 
        ]);

        return redirect()->route('admin.medecins.index')
            ->with('success', "Compte créé avec succès. Mot de passe temporaire : $tempPassword");
    }

    /**
     * Formulaire d'édition d'un médecin.
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'specialite_id' => 'required|exists:specialites,id',
            'matricule' => 'required|string|unique:medecins,matricule,' . ($user->medecin->id ?? 0),
        ]);

        // Mise à jour User
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'specialite_id' => $request->specialite_id,
        ]);

        // Mise à jour Profil Medecin
        if($user->medecin) {
            $user->medecin->update([
                'specialite_id' => $request->specialite_id,
                'matricule' => $request->matricule,
            ]);
        }

        return redirect()->route('admin.medecins.index')
            ->with('success', 'Informations du médecin mises à jour.');
    }

    /**
     * Supprime un médecin.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->role === 'medecin') {
            $user->delete(); // Supprime aussi le profil médecin grâce au onDelete('cascade')
            return redirect()->route('admin.medecins.index')
                ->with('success', 'Compte médecin supprimé.');
        }

        return redirect()->route('admin.medecins.index')
            ->with('error', 'Action non autorisée.');
    }
}