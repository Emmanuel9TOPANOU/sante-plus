<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Liste des discussions (Index)
     */
    public function index()
    {
        $patientId = Auth::id();

        // On ne récupère que les médecins
        $medecins = User::where('role', 'medecin')
            ->with('specialite')
            ->get();

        // Compte des messages non lus par expéditeur
        $unreadCounts = Message::where('receiver_id', $patientId)
            ->where('is_read', false)
            ->selectRaw('sender_id, COUNT(*) as total')
            ->groupBy('sender_id')
            ->pluck('total', 'sender_id');

        return view('patient.messages.index', compact('medecins', 'unreadCounts'));
    }

    /**
     * Afficher une conversation (Show)
     */
    public function show($id)
    {
        $patientId = Auth::id();
        $receiver = User::findOrFail($id);

        // --- SÉCURITÉ ---
        // Vérifier que le destinataire est bien un médecin
        if ($receiver->role !== 'medecin') {
            abort(403, 'Ce contact n\'est pas un médecin.');
        }

        // Vérifier si le patient a au moins un RDV avec ce médecin pour autoriser la discussion
        $hasRdv = RendezVous::where('medecin_id', $receiver->id)
            ->where('patient_id', $patientId)
            ->exists();

        if (!$hasRdv) {
            abort(403, 'Vous ne pouvez pas contacter ce médecin sans avoir pris de rendez-vous.');
        }

        // --- DONNÉES POUR LA SIDEBAR ---
        $medecins = User::where('role', 'medecin')->with('specialite')->get();
        
        $unreadCounts = Message::where('receiver_id', $patientId)
            ->where('is_read', false)
            ->selectRaw('sender_id, COUNT(*) as total')
            ->groupBy('sender_id')
            ->pluck('total', 'sender_id');

        // --- RÉCUPÉRATION DES MESSAGES (Fil de discussion) ---
        $messages = Message::where(function ($query) use ($receiver, $patientId) {
                $query->where('sender_id', $patientId)
                      ->where('receiver_id', $receiver->id);
            })
            ->orWhere(function ($query) use ($receiver, $patientId) {
                $query->where('sender_id', $receiver->id)
                      ->where('receiver_id', $patientId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Marquer les messages entrants comme "Lus"
        Message::where('sender_id', $receiver->id)
            ->where('receiver_id', $patientId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('patient.messages.show', compact('messages', 'receiver', 'medecins', 'unreadCounts'));
    }

    /**
     * Envoyer un message (Store)
     */
    public function store(Request $request)
    {
        $patientId = Auth::id();

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:1000',
        ]);

        $receiver = User::findOrFail($request->receiver_id);

        // Sécurité supplémentaire : On vérifie à nouveau le RDV lors de l'envoi
        $hasRdv = RendezVous::where('medecin_id', $receiver->id)
            ->where('patient_id', $patientId)
            ->exists();

        if (!$hasRdv) {
            abort(403, 'Action non autorisée.');
        }

        Message::create([
            'sender_id' => $patientId,
            'receiver_id' => $receiver->id,
            'content' => $request->content,
            'is_read' => false,
        ]);

        return back()->with('success', 'Message envoyé avec succès.');
    }
}