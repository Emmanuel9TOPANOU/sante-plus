<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

  protected $fillable = [
    'patient_id',
    'nom',
    'type',
    'chemin_fichier',
    'uploaded_by',
];
    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}