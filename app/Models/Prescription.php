<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'medecin_id',
        'patient_id',
        'consultation_id',
        'rendezvous_id', // Ajouté pour correspondre à ton appel dans la vue
        'contenu',
        'date_emission',
        'age',
        'poids',
    ];

    /**
     * Relation avec le Patient
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    /**
     * Relation avec le Médecin (Dr Fox)
     */
    public function medecin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    /**
     * Relation avec le Rendez-vous (Celle qui causait l'erreur)
     */
    public function rendezvous(): BelongsTo
    {
        return $this->belongsTo(Rendezvous::class, 'rendezvous_id');
    }

    /**
     * Relation avec la Consultation
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }
}