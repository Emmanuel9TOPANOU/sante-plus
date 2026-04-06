<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Ordonnance extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'rendezvous_id', // Ajouté car présent dans votre table SQL
        'contenu_prescription',
        'date_emission',
        'date_expiration',
    ];

    protected $casts = [
        'date_emission' => 'date',
        'date_expiration' => 'date',
        'contenu_prescription' => 'array', 
    ];

    /**
     * Relation directe : Une ordonnance est liée à une consultation.
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class, 'consultation_id');
    }

    /**
     * Relation directe : Accès au Rendez-vous.
     * D'après votre capture SQL, vous avez une colonne rendezvous_id.
     */
    public function rendezvous(): BelongsTo
    {
        return $this->belongsTo(Rendezvous::class, 'rendezvous_id');
    }

    /**
     * Accès indirect au Médecin via le Rendez-vous.
     * Très utile pour le Dashboard du patient.
     */
    public function medecin(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,         // Le modèle final (Médecin)
            Rendezvous::class,   // Le modèle intermédiaire
            'id',                // Clé étrangère sur Rendezvous (PK)
            'id',                // Clé étrangère sur User (PK)
            'rendezvous_id',     // Clé locale sur Ordonnance
            'medecin_id'         // Clé locale sur Rendezvous
        );
    }

    /**
     * Accesseur : Vérifie la validité.
     */
    public function getEstValideAttribute(): bool
    {
        if (!$this->date_expiration) {
            return true;
        }
        return $this->date_expiration->isFuture() || $this->date_expiration->isToday();
    }

    /**
     * Scope : Filtrer les ordonnances valides.
     */
    public function scopeValides($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('date_expiration')
              ->orWhere('date_expiration', '>=', now()->startOfDay());
        });
    }
}