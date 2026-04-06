<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Récupère la liste des patients avec le compte des messages non lus.
     */
    private function getContacts()
    {
        return User::where('role', 'patient')
            ->withCount(['messagesSent as unread' => function($q) {
                $q->where('receiver_id', Auth::id())
                  ->where('is_read', false);
            }])
            ->get();
    }

    /**
     * Récupère la liste des secrétaires avec le compte des messages non lus.
     */
    private function getSecretaires()
    {
        return User::where('role', 'secretaire')
            ->withCount(['messagesSent as unread' => function($q) {
                $q->where('receiver_id', Auth::id())
                  ->where('is_read', false);
            }])
            ->get();
    }

    /**
     * Compte global des messages non lus pour le badge d'urgence.
     */
    private function getUrgentMessagesCount()
    {
        return Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
    }

    /**
     * Affiche la liste des contacts (Premier chargement).
     */
    public function index()
    {
        $contacts = $this->getContacts();
        $secretaires = $this->getSecretaires();
        $messagesUrgentsCount = $this->getUrgentMessagesCount();

        return view('doctor.messages.index', compact('contacts', 'secretaires', 'messagesUrgentsCount'));
    }

    /**
     * Affiche la discussion avec un contact spécifique.
     */
    public function show(User $patient) // $patient représente ici le contact (Patient ou Secrétaire)
    {
        // 1. Marquer les messages reçus de ce contact comme "Lus"
        Message::where('sender_id', $patient->id)
               ->where('receiver_id', Auth::id())
               ->where('is_read', false)
               ->update(['is_read' => true]);

        // 2. Récupérer les données pour la barre latérale
        $contacts = $this->getContacts();
        $secretaires = $this->getSecretaires();

        // 3. Récupérer l'historique des messages entre les deux utilisateurs
        $messages = Message::where(function($q) use ($patient) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $patient->id);
        })->orWhere(function($q) use ($patient) {
            $q->where('sender_id', $patient->id)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        $messagesUrgentsCount = $this->getUrgentMessagesCount();

        return view('doctor.messages.show', [
            'activeContact' => $patient,
            'contacts' => $contacts,
            'secretaires' => $secretaires,
            'messages' => $messages,
            'messagesUrgentsCount' => $messagesUrgentsCount
        ]);
    }

    /**
     * Enregistre et envoie un nouveau message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'nullable|string',
            'receiver_id' => 'required|exists:users,id',
            'attachment' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120' // Max 5MB
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('attachments', 'public');
        }

        $content = $request->content;
        if (empty($content) && $attachmentPath) {
            $content = "Document partagé";
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $content,
            'file_path' => $attachmentPath,
            'is_read' => false
        ]);

        return back()->with('success', 'Message envoyé');
    }

    /**
     * Supprime toute la conversation avec un utilisateur.
     */
    public function destroy($id)
    {
        $authId = Auth::id();

        // On récupère les messages qui ont des pièces jointes pour les supprimer du disque
        $messagesWithFiles = Message::where(function($q) use ($authId, $id) {
            $q->where('sender_id', $authId)->where('receiver_id', $id);
        })->orWhere(function($q) use ($authId, $id) {
            $q->where('sender_id', $id)->where('receiver_id', $authId);
        })->whereNotNull('file_path')->get();

        foreach ($messagesWithFiles as $msg) {
            Storage::disk('public')->delete($msg->file_path);
        }

        // Suppression en base de données
        Message::where(function($q) use ($authId, $id) {
            $q->where('sender_id', $authId)->where('receiver_id', $id);
        })->orWhere(function($q) use ($authId, $id) {
            $q->where('sender_id', $id)->where('receiver_id', $authId);
        })->delete();

        return redirect()->route('medecin.messages.index')->with('success', 'Conversation supprimée');
    }
}