<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la requête.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            
            'email' => [
                'required', 
                'string', 
                'lowercase', 
                'email', 
                'max:255', 
                Rule::unique(User::class)->ignore($this->user()->id)
            ],

            'telephone' => ['nullable', 'string', 'max:20'],
            
            'adresse' => ['nullable', 'string', 'max:500'],
            
            'photo' => [
                'nullable', 
                'file',     // Indispensable pour que Laravel reconnaisse l'upload
                'image',    // Vérifie que c'est bien une image (jpg, jpeg, png, bmp, gif, svg, ou webp)
                'mimes:jpg,jpeg,png', 
                'max:2048'  // Limite à 2Mo
            ],
        ];
    }

    /**
     * Messages de validation personnalisés (très utile pour l'expérience utilisateur).
     */
    public function messages(): array
    {
        return [
            'name.required'  => 'Le nom complet est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.unique'   => 'Cette adresse email est déjà utilisée.',
            'photo.image'    => 'Le fichier doit être une image.',
            'photo.mimes'    => 'Seuls les formats JPG, JPEG et PNG sont acceptés.',
            'photo.max'      => 'La photo est trop lourde (maximum 2 Mo).',
        ];
    }
}