<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'nom',
        'telephone',
        'email',
        'adresse',
        'etage',      // ← Optionnel, peut être NULL
    ];

    /**
     * Relation avec les médecins (un service a plusieurs médecins)
     */
    public function medecins(): HasMany
    {
        return $this->hasMany(Medecin::class);
    }

    /**
     * Récupère l'adresse complète formatée (gère le cas sans étage)
     */
    public function getFullAdresseAttribute(): string
    {
        $parts = [];
        
        // N'afficher l'étage que s'il existe
        if ($this->etage && !empty($this->etage)) {
            $parts[] = $this->etage;
        }
        
        if ($this->adresse && !empty($this->adresse)) {
            $parts[] = $this->adresse;
        }
        
        return !empty($parts) ? implode(' - ', $parts) : 'Adresse non renseignée';
    }

    /**
     * Récupère le nom du service (avec étage uniquement si renseigné)
     */
    public function getNomCompletAttribute(): string
    {
        $nom = $this->nom;
        if ($this->etage && !empty($this->etage)) {
            $nom .= ' (' . $this->etage . ')';
        }
        return $nom;
    }
}