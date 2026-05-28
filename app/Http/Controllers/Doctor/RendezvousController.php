<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rendezvous;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RappelRendezvous;
use Illuminate\Support\Facades\Log;

class RendezvousController extends Controller
{
    public function index()
    {
        $rendezvous = Rendezvous::with(['patient'])
            ->where('medecin_id', Auth::id())
            // On exclut les terminés et annulés pour ne garder que 'attente' et 'confirme'
            ->whereNotIn('statut', ['termine', 'annule']) 
            ->orderBy('date_rdv', 'asc')
            ->orderBy('heure_rdv', 'asc')
            ->get();

        return view('doctor.rendezvous.index', compact('rendezvous'));
    }

 public function confirmerRDV(Rendezvous $rendezvous)
{
    // 1. Sécurité : On vérifie que c'est bien le médecin du RDV
    if ($rendezvous->medecin_id !== Auth::id()) {
        abort(403);
    }

    // 2. Mise à jour du statut en base de données
    $rendezvous->update(['statut' => 'confirme']);

    try {
        // 3. Envoi du mail avec le nom exact de la classe : ConfirmationRendezvous
        Mail::to($rendezvous->patient->email)->send(new \App\Mail\ConfirmationRendezvous($rendezvous));
        
        return back()->with('success', 'Le rendez-vous a été confirmé et un email a été envoyé au patient.');
    } catch (\Exception $e) {
        // En cas d'erreur d'envoi (problème SMTP par exemple)
        Log::error("Erreur Mail Confirmation: " . $e->getMessage());
        
        // Le statut reste 'confirme' en base, mais on informe l'utilisateur pour le mail
        return back()->with('warning', 'Rendez-vous confirmé, mais l\'envoi de l\'email a échoué. Vérifiez votre configuration mail.');
    }
}

    public function annulerRDV(Rendezvous $rendezvous)
    {
        if ($rendezvous->medecin_id !== Auth::id()) {
            abort(403);
        }

        // Mise à jour vers 'annule' (conforme à votre BDD)
        $rendezvous->update(['statut' => 'annule']);
        
        return back()->with('success', 'Rendez-vous annulé.');
    }

    public function envoyerMail($id)
    {
        $rdv = Rendezvous::with(['patient'])->findOrFail($id);

        try {
            Mail::to($rdv->patient->email)->send(new RappelRendezvous($rdv));
            return back()->with('success', 'Rappel envoyé.');
        } catch (\Exception $e) {
            Log::error("Erreur Rappel: " . $e->getMessage());
            return back()->with('error', 'L\'envoi a échoué.');
        }
    }
}