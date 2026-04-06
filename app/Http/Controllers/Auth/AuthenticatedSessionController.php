<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
   public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Récupération de l'utilisateur pour vérifier son rôle
        $user = Auth::user();

        // Redirection chirurgicale selon la fonction choisie lors de l'inscription
        return match ($user->role) {
            'admin'      => redirect()->intended(route('admin.dashboard')),
            'medecin'    => redirect()->intended(route('doctor.dashboard')),
            'secretaire' => redirect()->intended(route('secretaire.dashboard')),
            'patient'    => redirect()->intended(route('patient.dashboard')),
            default      => redirect()->intended(route('dashboard')),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
