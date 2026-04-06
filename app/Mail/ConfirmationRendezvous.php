<?php

namespace App\Mail;

use App\Models\Rendezvous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationRendezvous extends Mailable
{
    use Queueable, SerializesModels;

    public $rdv;

    public function __construct(Rendezvous $rdv)
    {
        $this->rdv = $rdv->load(['patient', 'medecin']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre rendez-vous - Santé +',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.confirmation_rdv',
        );
    }
}