<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabResult extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés massivement.
     * Basé sur la structure réelle de ta base de données.
     */
    protected $fillable = [
        'user_id',
        'consultation_id',
        'type_analyse',
        'valeur',
        'unite',
        'norme',
        'laboratoire_nom',    // Ajouté pour la traçabilité du lieu
        'statut', 
        'date_prelevement',   // Ajouté pour la précision médicale
        'date_validation',    // Ajouté pour le suivi temporel
        'interpretation',     // Utilise 'interpretation' comme dans ta DB (au lieu de commentaire)
        'biologiste_nom',     // Ajouté pour identifier l'auteur du résultat
        'pdf_path',
    ];

    /**
     * Relation : L'analyse appartient à un patient (User).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : L'analyse est issue d'une consultation spécifique.
     */
    public function consultation(): BelongsTo
    {
        return $this->belongsTo(Consultation::class);
    }

    /**
     * Relation : L'analyse est prescrite par un médecin.
     * (Optionnel, si tu as une colonne doctor_id ou medecin_id dans ta table)
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}