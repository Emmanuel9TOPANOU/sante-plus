<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id', 
        'contenu'
    ];

    /* -------------------------------------------------------------------------- */
    /* RELATIONS                                                                  */
    /* -------------------------------------------------------------------------- */

    /**
     * Lien vers l'utilisateur (Médecin) qui a créé la note.
     * On précise 'user_id' pour être en cohérence avec ta table SQL.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}