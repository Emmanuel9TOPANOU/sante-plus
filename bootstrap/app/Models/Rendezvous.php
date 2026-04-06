<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rendezvous extends Model
{
    use HasFactory;

    protected $table = 'rendezvous';

    protected $fillable = [
        'patient_id',
        'medecin_id',
        'cree_par',
        'date_rdv',
        'heure_rdv',
        'statut',
        'motif'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function medecin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'medecin_id');
    }

    public function createur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cree_par');
    }

    public function consultation(): HasOne
    {
        return $this->hasOne(Consultation::class, 'rendezvous_id');
    }

    /**
     * AJOUT : Relation avec l'ordonnance via la consultation
     */
    public function ordonnance(): HasOne
    {
        // On lie le RDV à la prescription en passant par la consultation
        return $this->hasOne(Prescription::class, 'consultation_id', 'id');
    }
}