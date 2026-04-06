<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne; // Import nécessaire
use Carbon\Carbon;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'is_booked',
    ];

    protected $casts = [
        'date' => 'date',
        'is_booked' => 'boolean',
    ];

    /**
     * Relation : Une disponibilité appartient à un médecin (User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * RELATION RÉELLE (Indispensable pour whereDoesntHave)
     * On lie le créneau au rendez-vous via les colonnes communes.
     */
    public function linked_rendezvous(): HasOne
    {
        return $this->hasOne(Rendezvous::class, 'availability_id');
        // NOTE : Si tu n'as pas de colonne 'availability_id' dans ta table 'rendezvous',
        // il faudra utiliser ta logique de comparaison de dates, mais la relation 
        // par ID est beaucoup plus performante et fiable.
    }

    /**
     * Accessor pour la compatibilité avec ton code existant
     */
    public function getLinkedRendezvousAttribute()
    {
        return $this->linked_rendezvous()->first();
    }

    /**
     * Formater la date proprement
     */
    public function getFormattedDateAttribute()
    {
        return $this->date->translatedFormat('d M Y');
    }
}