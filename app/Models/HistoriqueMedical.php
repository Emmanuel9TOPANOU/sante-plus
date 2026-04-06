<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueMedical extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée.
     * Votre choix 'historiques_medicaux' est excellent pour le français.
     */
    protected $table = 'historiques_medicaux';

    /**
     * Les attributs assignables en masse.
     */
    protected $fillable = [
        'user_id', // On utilise user_id pour être cohérent avec le reste du projet
        'antecedents_medicaux',
        'allergies',
        'maladies_chroniques',
        'operations_passees',
        'traitements_en_cours',
        'notes',
    ];

    /**
     * Relation : Un historique médical appartient à un utilisateur (Patient).
     * Correction : On pointe vers User car 'Patient' n'est pas un modèle à part entière 
     * mais un rôle dans la table users.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}