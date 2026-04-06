<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'nom_specialite',
        'description',
    ];

    /**
     * Relation : Une spécialité possède plusieurs utilisateurs (médecins).
     *
     */
    public function users()
    {
        return $this->hasMany(User::class, 'specialite_id');
    }
}