<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rendezvous;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmationRendezvous;
use App\Mail\RappelRendezvous;

class RendezvousController extends Controller
{
    /**
     * 📅 Afficher les rendez-vous actifs
     */
    public function index()
    {
        $rendezvous = Rendezvous::with(['patient'])
            ->where('medecin_id', Auth::id())
            ->whereNotIn('statut', ['termine', 'annule'])
            ->orderBy('date_rdv', 'asc')
            ->orderBy('heure_rdv', 'asc')
            ->paginate(10);

        return view('doctor.rendezvous.index', compact('rendezvous'));
    }

    /**
     * Confirmer un rendez-vous + email auto
     * Renommé en confirmerRDV pour correspondre à la route
     */
    public function confirmerRDV($id)
    {
        $rdv = Rendezvous::with(['patient', 'medecin'])
            ->where('medecin_id', Auth::id())
            ->findOrFail($id);

        if ($rdv->statut === 'confirme') {
            return back()->with('error', 'Ce rendez-vous est déjà confirmé.');
        }

        // Vérification de l'email
        if (!$rdv->patient || !$rdv->patient->email) {
            return back()->with('error', ' Le patient n\'a pas d\'adresse email.');
        }

        $rdv->update(['statut' => 'confirme']);

        try {
            Mail::to($rdv->patient->email)->send(new ConfirmationRendezvous($rdv));
            return back()->with('success', ' Rendez-vous confirmé et email envoyé.');
        } catch (\Exception $e) {
            // On log l'erreur mais on confirme quand même le RDV en base
            return back()->with('success', ' RDV confirmé, mais l\'email n\'a pas pu être envoyé.');
        }
    }

    /**
     * 📩 Envoyer un rappel manuel
     */
    public function envoyerMail($id)
    {
        $rdv = Rendezvous::with(['patient', 'medecin'])
            ->where('medecin_id', Auth::id())
            ->findOrFail($id);

        if (!$rdv->patient || !$rdv->patient->email) {
            return back()->with('error', ' Email du patient introuvable.');
        }

        try {
            Mail::to($rdv->patient->email)->send(new RappelRendezvous($rdv));
            return back()->with('success', ' Rappel envoyé avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, on affiche un message clair
            return back()->with('error', ' Échec de l\'envoi du rappel technique.');
        }
    }

    /**
     *  Annuler un rendez-vous
     */
    public function annulerRDV($id)
    {
        $rdv = Rendezvous::where('medecin_id', Auth::id())->findOrFail($id);
        
        $rdv->update(['statut' => 'annule']);
        
        return back()->with('success', ' Rendez-vous annulé.');
    }

    /**
     * 📜 Historique
     */
    public function history()
    {
        $historique = Rendezvous::with(['patient'])
            ->where('medecin_id', Auth::id())
            ->where('statut', 'termine')
            ->orderBy('date_rdv', 'desc')
            ->paginate(15);

        return view('doctor.rendezvous.history', compact('historique'));
    }
}