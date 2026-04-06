<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class NoteController extends Controller
{
    /**
     * Met à jour ou crée la note pour l'utilisateur actuel.
     * Accessible par les Admins et les Médecins.
     */
    public function update(Request $request)
{
    $request->validate([
        'contenu' => 'required|string|max:2000',
    ]);

    $note = \App\Models\Note::updateOrCreate(
        ['user_id' => auth()->id()],
        ['contenu' => $request->contenu]
    );

    // Si la requête vient de Fetch/AJAX, on renvoie du JSON
    if ($request->expectsJson()) {
        return response()->json([
            'status' => 'success',
            'contenu' => $note->contenu
        ]);
    }

    // Sinon on redirige normalement (pour la compatibilité)
    return back()->with('status', 'Note mise à jour !');
}
}