<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Affiche le formulaire de profil.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Met à jour les informations (Nom, Email, Tel, Adresse, Photo).
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // 1. On récupère les données validées sauf la photo pour l'instant
        $data = $request->validated();

        // 2. Gestion spécifique de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo physiquement si elle existe
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            
            // Stocker la nouvelle photo et récupérer le chemin (ex: avatars/abc.jpg)
            $path = $request->file('photo')->store('avatars', 'public');
            
            // On remplace l'objet File par la chaîne de caractères du chemin dans le tableau $data
            $data['photo'] = $path;
        }

        // 3. On remplit le modèle avec les données nettoyées
        $user->fill($data);

        // Logique spécifique pour l'email (Laravel Breeze standard)
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Suppression du compte.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Nettoyage de la photo lors de la suppression du compte
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}