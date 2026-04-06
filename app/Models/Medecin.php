<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medecin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialite_id',
        'matricule',
        'telephone_pro',
        'biographie',
        'cabinet_numero',
        'est_valide',
    ];

    protected $casts = [
        'est_valide' => 'boolean',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec la spécialité
     */
    public function specialite(): BelongsTo
    {
        return $this->belongsTo(Specialite::class);
    }
}