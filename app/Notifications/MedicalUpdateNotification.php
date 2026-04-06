<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Consultation;

class MedicalUpdateNotification extends Notification
{
    use Queueable;

    protected $consultation;

    /**
     * On passe la consultation au constructeur pour récupérer les infos
     */
    public function __construct(Consultation $consultation)
    {
        $this->consultation = $consultation;
    }

    /**
     * On définit le canal de diffusion : ici la base de données (table notifications)
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Ce qui sera stocké dans la colonne 'data' de ta table SQL
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => 'Nouveau compte-rendu médical',
            'message' => 'Le Dr. ' . auth()->user()->name . ' a ajouté les détails de votre consultation.',
            'consultation_id' => $this->consultation->id,
            'type' => 'medical_update',
        ];
    }
}