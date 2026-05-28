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
        'service_id',           // ← Service d'affectation dans l'établissement
        'matricule',
        'numero_ordre',         // N° inscription Ordre des Médecins
        'telephone_pro',
        'biographie',
        'est_valide',
    ];

    protected $casts = [
        'est_valide' => 'boolean',
    ];

    /**
     * Relation avec l'utilisateur (médecin)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec la spécialité médicale
     */
    public function specialite(): BelongsTo
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
    }

    /**
     * Relation avec le service d'affectation (établissement)
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    /**
     * Vérifie si le médecin a tous les champs légaux requis pour les ordonnances
     */
    public function hasLegalInfo(): bool
    {
        return !is_null($this->numero_ordre);
    }

    /**
     * Formate le numéro d'ordre pour l'affichage
     */
    public function getFormattedNumeroOrdreAttribute(): string
    {
        if (!$this->numero_ordre) {
            return 'En cours d\'enregistrement';
        }
        return $this->numero_ordre;
    }

    /**
     * Nom complet du médecin avec titre
     */
    public function getFullNameAttribute(): string
    {
        return 'Dr. ' . $this->user->name;
    }

    /**
     * Email du médecin via la relation user
     */
    public function getEmailAttribute(): ?string
    {
        return $this->user?->email;
    }

    /**
     * Téléphone professionnel formaté
     */
    public function getFormattedPhoneAttribute(): string
    {
        return $this->telephone_pro ?? $this->user?->telephone ?? 'Non renseigné';
    }

    /**
     * Récupère l'adresse complète du service (si existe)
     */
    public function getServiceAdresseAttribute(): string
    {
        if (!$this->service) {
            return 'Adresse non renseignée';
        }
        
        $parts = [];
        if ($this->service->etage) {
            $parts[] = $this->service->etage;
        }
        if ($this->service->adresse) {
            $parts[] = $this->service->adresse;
        }
        
        return !empty($parts) ? implode(' - ', $parts) : 'Adresse non renseignée';
    }

    /**
     * Téléphone du service (si existe)
     */
    public function getServiceTelephoneAttribute(): ?string
    {
        return $this->service?->telephone;
    }

    /**
     * Nom du service (si existe)
     */
    public function getServiceNomAttribute(): ?string
    {
        return $this->service?->nom;
    }
}