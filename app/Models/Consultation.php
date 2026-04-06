<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rendezvous_id', 
        'patient_id',    
        'doctor_id',     
        'diagnostic', 
        'observations', 
        'tension', 
        'poids', 
        'temperature',
        'frequence_cardiaque',
        'notes_privees'
    ];

    protected $casts = [
        'poids' => 'float',
        'temperature' => 'float',
        'created_at' => 'datetime',
    ];

    /* --- RELATIONS DE BASE --- */

    public function rendezvous(): BelongsTo
    {
        return $this->belongsTo(Rendezvous::class, 'rendezvous_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function medecin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    /* --- RELATIONS LIÉES AU TRAITEMENT --- */

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }

    /**
     * NOUVEAU : Une consultation peut générer plusieurs analyses en laboratoire.
     */
    public function analyses(): HasMany
    {
        return $this->hasMany(LabResult::class, 'consultation_id');
    }

    /* --- HELPERS --- */

    /**
     * Vérifie si des analyses ont été prescrites lors de cette consultation
     */
    public function hasAnalyses(): bool
    {
        return $this->analyses()->exists();
    }
}