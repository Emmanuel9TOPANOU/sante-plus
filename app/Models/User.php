<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status',           
        'validated_by', 'validated_at', 'photo', 'must_change_password', 
        'telephone', 'date_naissance', 'sexe', 'adresse',
        'groupe_sanguin', 'antecedents', 'allergies', 'observations_medicales', 
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'validated_at' => 'datetime',
            'date_naissance' => 'date',
            'must_change_password' => 'boolean',
        ];
    }

    protected static function booted()
    {
        static::creating(function ($user) {
            if (!$user->status) {
                $user->status = ($user->role === 'admin') ? 'active' : 'inactive';
            }
        });
    }

    /* --- VÉRIFICATION DE RÔLE --- */
    public function isAdmin(): bool { return $this->role === 'admin'; }
    public function isMedecin(): bool { return $this->role === 'medecin'; }
    public function isPatient(): bool { return $this->role === 'patient'; }
    public function isActive(): bool { return $this->status === 'active'; }

    /* --- RELATIONS MÉDECIN --- */
    
    public function medecin(): HasOne
    {
        return $this->hasOne(Medecin::class);
    }

   public function specialite(): HasOneThrough
{
    return $this->hasOneThrough(
        Specialite::class,    // Le modèle final (ce qu'on veut récupérer)
        Medecin::class,       // Le modèle intermédiaire (la table pivot)
        'user_id',            // Clé étrangère sur la table 'medecins' qui pointe vers 'users'
        'id',                 // Clé étrangère sur la table 'specialites' qui pointe vers 'medecins'
        'id',                 // Clé locale sur la table 'users'
        'specialite_id'       // Clé locale sur la table 'medecins' qui pointe vers 'specialites'
    );
}

    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    public function availabilities(): HasMany 
    { 
        return $this->hasMany(Availability::class, 'user_id'); 
    }

    /* --- MESSAGERIE --- */

    public function messagesReceived(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function messagesSent(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /* --- RELATIONS PATIENT (DASHBOARD) --- */

    /**
     * Relation pour les analyses (Lien vers LabResult)
     * On garde le nom 'analyses' pour le DashboardController
     */
    public function analyses(): HasMany
    {
        return $this->hasMany(LabResult::class, 'user_id');
    }

    public function rendezvous(): HasMany 
    { 
        return $this->hasMany(Rendezvous::class, 'patient_id'); 
    }

    public function ordonnances(): HasMany 
    { 
        return $this->hasMany(Prescription::class, 'patient_id'); 
    }
    
    /* --- RELATIONS COMPLEXES --- */
    public function consultations(): HasManyThrough
    {
        return $this->hasManyThrough(
            Consultation::class, 
            Rendezvous::class, 
            'patient_id', 
            'rendezvous_id'
        );
    }

    /* --- ACCESSORS --- */
    public function getAgeAttribute(): ?int
    {
        return $this->date_naissance ? $this->date_naissance->age : null;
    }
}