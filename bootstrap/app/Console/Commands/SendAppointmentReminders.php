<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rendezvous;
use Carbon\Carbon;

class SendAppointmentReminders extends Command
{
    protected $signature = 'app:send-reminders';
    protected $description = 'Envoie des rappels WhatsApp via flux HTTP (Contourne l\'erreur cURL)';

    public function handle()
    {
        // 1. Récupérer les RDV de demain confirmés
        $demain = Carbon::tomorrow()->format('Y-m-d');
        $rendezvous = Rendezvous::with(['patient', 'medecin'])
            ->where('date_rdv', $demain)
            ->where('statut', 'confirme')
            ->get();

        if ($rendezvous->isEmpty()) {
            $this->info("Aucun rappel à envoyer pour demain ($demain).");
            return;
        }

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = "whatsapp:" . env('TWILIO_WHATSAPP_NUMBER');

        foreach ($rendezvous as $rdv) {
            $nomPatient = $rdv->patient->name ?? 'Patient';
            $heure = Carbon::parse($rdv->heure_rdv)->format('H\hi');
            $nomMedecin = $rdv->medecin->name ?? 'le médecin';
            
            // Correction du numéro : Ajout du +229 si manquant
            $telephone = $rdv->patient->telephone;
            if (!str_starts_with($telephone, '+')) {
                $telephone = '+229' . ltrim($telephone, '0');
            }

            $to = "whatsapp:" . $telephone;
            $messageBody = "Bonjour $nomPatient, Santé+ vous rappelle votre RDV avec le Dr. $nomMedecin demain à $heure. Merci de votre confiance.";

            // 2. Méthode native sans cURL
            $url = "https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json";
            $data = [
                'To' => $to,
                'From' => $from,
                'Body' => $messageBody,
            ];

            $options = [
                'http' => [
                    'method'  => 'POST',
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n" .
                                 "Authorization: Basic " . base64_encode("$sid:$token"),
                    'content' => http_build_query($data),
                    'ignore_errors' => true 
                ],
            ];

            try {
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);

                if ($result === FALSE) {
                    $this->error("Erreur réseau pour $nomPatient.");
                } else {
                    $this->info("Rappel envoyé avec succès à $nomPatient ($telephone) !");
                }
            } catch (\Exception $e) {
                $this->error("Erreur : " . $e->getMessage());
            }
        }

        $this->info("Traitement terminé.");
    }
}