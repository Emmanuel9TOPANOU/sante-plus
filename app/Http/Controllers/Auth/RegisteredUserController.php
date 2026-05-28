<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Medecin;
use App\Models\Specialite;
use App\Models\Service;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Affiche la vue d'inscription.
     */
    public function create(Request $request): View
    {
        $specialites = Specialite::all();
        $services = Service::all(); // Pour que le médecin choisisse son service
        $role = $request->query('role', 'patient');
        $role = in_array($role, ['patient', 'medecin']) ? $role : 'patient';

        return view('auth.register', compact('specialites', 'services', 'role'));
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validation des règles de base
        $rules = [
            'name'      => ['required', 'string', 'max:255', 'regex:/^[A-Za-zÀ-ÿ\s\-]+$/'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['nullable', 'same:password'],
            'role'      => ['required', 'in:patient,medecin'],
            'telephone' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]+$/'],
            'adresse'   => ['required', 'string', 'max:255'],
        ];

        // Règles spécifiques selon le rôle
        if ($request->role === 'medecin') {
            $rules += [
                'matricule'         => ['required', 'string', 'max:20', 'unique:medecins,matricule', 'regex:/^[A-Z0-9\-]+$/'],
                'specialite_id'     => ['required', 'exists:specialites,id'],
                'service_id'        => ['required', 'exists:services,id'],
                'numero_ordre'      => ['required', 'string', 'max:30', 'unique:medecins,numero_ordre', 'regex:/^[A-Z]{3}-\d{4}-\d{5}$/'],
                // Optionnels pour le médecin
                'biographie'        => ['nullable', 'string', 'max:1000'],
            ];
        } else {
            $rules['sexe'] = ['required', 'in:M,F'];
            $rules['date_naissance'] = ['required', 'date', 'before:today'];
        }

        // Messages d'erreur personnalisés
        $messages = [
            'name.regex' => 'Le nom ne doit contenir que des lettres, espaces et tirets.',
            'telephone.regex' => 'Le numéro de téléphone ne doit contenir que des chiffres, +, - et espaces.',
            'matricule.regex' => 'Le matricule ne doit contenir que des lettres majuscules, chiffres et tirets.',
            'numero_ordre.regex' => 'Le numéro d\'ordre doit être au format: AAA-0000-00000 (ex: OMB-2024-00123)',
            'service_id.required' => 'Veuillez sélectionner un service d\'affectation.',
            'service_id.exists' => 'Le service sélectionné n\'existe pas.',
            'required' => 'Le champ :attribute est obligatoire.',
            'unique' => 'La valeur du champ :attribute existe déjà dans notre système.',
            'exists' => 'La valeur sélectionnée n\'est pas valide.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'min' => 'Le champ :attribute doit contenir au moins :min caractères.',
            'email' => 'Veuillez entrer une adresse email valide.',
            'confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'in' => 'La valeur sélectionnée n\'est pas valide.',
            'date' => 'Veuillez entrer une date valide.',
            'before' => 'La date de naissance doit être antérieure à aujourd\'hui.',
        ];

        $request->validate($rules, $messages);

        try {
            return DB::transaction(function () use ($request) {

                // 2. Création de l'utilisateur
                $user = User::create([
                    'name'           => $request->name,
                    'email'          => $request->email,
                    'password'       => Hash::make($request->password),
                    'telephone'      => $request->telephone,
                    'role'           => $request->role,
                    'status'         => ($request->role === 'patient') ? 'active' : 'inactive',
                    'sexe'           => $request->sexe,
                    'date_naissance' => $request->date_naissance,
                    'adresse'        => $request->adresse,
                ]);

                // 3. Création du profil Médecin
                if ($user->role === 'medecin') {
                 Medecin::create([
    'user_id'           => $user->id,
    'specialite_id'     => $request->specialite_id,
    'service_id'        => $request->service_id,  // ← Ajouter ceci
    'matricule'         => strtoupper($request->matricule),
    'numero_ordre'      => strtoupper($request->numero_ordre),
    'telephone_pro'     => $request->telephone,
    'biographie'        => $request->biographie,
    'est_valide'        => false,
]);

                    $message = "Votre demande d'inscription médecin a été transmise pour validation par l'administrateur.";
                } else {
                    $message = "Votre compte patient a été créé avec succès. Vous pouvez maintenant vous connecter.";
                }

                event(new Registered($user));

                return redirect()->route('login')->with('success', $message);
            });

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => "Erreur système : " . $e->getMessage()]);
        }
    }
}