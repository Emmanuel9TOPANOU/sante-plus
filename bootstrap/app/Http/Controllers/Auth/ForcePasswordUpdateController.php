<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ForcePasswordUpdateController extends Controller
{
    public function show()
    {
        return view('auth.force-password-change');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = auth()->user();
        
        // Mise à jour du mot de passe et retrait du flag de blocage
        $user->update([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ]);

        // Redirection vers le dashboard correspondant au rôle
        if ($user->role === 'medecin') {
            return redirect()->route('medecin.dashboard')->with('success', 'Votre compte est désormais actif avec votre nouveau mot de passe.');
        }

        return redirect()->route('dashboard');
    }
}
