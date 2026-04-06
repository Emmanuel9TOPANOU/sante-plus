<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // Si l'utilisateur a déjà vérifié son email
        if ($request->user()->hasVerifiedEmail()) {
            
            // Redirection intelligente selon le rôle
            if ($request->user()->role === 'medecin') {
                return redirect()->intended(route('medecin.dashboard', absolute: false));
            }

            if ($request->user()->role === 'patient') {
                return redirect()->intended(route('patient.dashboard', absolute: false));
            }

            // Redirection par défaut (dashboard générique)
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Sinon, on affiche la vue de demande de vérification
        return view('auth.verify-email');
    }
}