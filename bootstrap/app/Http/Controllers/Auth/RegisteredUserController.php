<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Medecin;
use App\Models\Specialite;
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
    public function create(): View
    {
        // On récupère les spécialités. 
        // Note : Assure-toi que ton modèle Specialite est bien lié à la table 'specialites'
        $specialites = Specialite::all(); 
        return view('auth.register', compact('specialites'));
    }

    /**
     * Gère la requête d'inscription entrante.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validation dynamique
        $rules = [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // CORRECTION : J'ai retiré 'confirmed' car tu n'as qu'un seul champ password dans ta vue
            'password'  => ['required', Rules\Password::defaults()],
            'role'      => ['required', 'in:patient,medecin'],
            'telephone' => ['required', 'string', 'max:20'],
            'adresse'   => ['required', 'string', 'max:255'],
        ];

        // Règles spécifiques selon le rôle
        if ($request->role === 'medecin') {
            $rules['matricule']     = ['required', 'string', 'unique:medecins,matricule'];
            $rules['specialite_id'] = ['required', 'exists:specialites,id'];
        } else {
            $rules['sexe']           = ['required', 'in:M,F'];
            $rules['date_naissance'] = ['required', 'date', 'before:today'];
        }

        $request->validate($rules);

        // 2. Transaction pour garantir l'intégrité des données
        try {
            return DB::transaction(function () use ($request) {
                
                // Création de l'utilisateur
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

                // 3. Profil spécifique pour le médecin
                if ($user->role === 'medecin') {
                    Medecin::create([
                        'user_id'        => $user->id,
                        'specialite_id'  => $request->specialite_id,
                        'matricule'      => $request->matricule,
                        'telephone_pro'  => $request->telephone, // Par défaut le même
                        'est_valide'     => false,
                    ]);
                    
                    $message = "Votre demande d'inscription médecin a été transmise pour validation.";
                } else {
                    $message = "Votre compte patient a été créé avec succès.";
                }

                event(new Registered($user));

                // On redirige vers login avec le message de succès que ton AlpineJS affichera
                return redirect()->route('login')->with('success', $message);
            });
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => "Une erreur est survenue lors de l'inscription."]);
        }
    }
}