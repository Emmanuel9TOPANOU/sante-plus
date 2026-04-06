<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    /**
     * Affiche la page des paramètres avec un design Pro.
     */
    public function index()
    {
        // Récupère les réglages ou renvoie un tableau vide
        $settings = Setting::pluck('value', 'key')->all();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Met à jour les paramètres du système de manière sécurisée.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'clinic_name'    => 'required|string|max:100',
            'clinic_email'   => 'required|email',
            'clinic_phone'   => 'nullable|string',
            'clinic_address' => 'nullable|string',
            'logo'           => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // 1. Traitement des champs textuels (sauf le logo)
        $inputs = $request->except(['_token', '_method', 'logo']);
        
        foreach ($inputs as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // 2. Gestion spécifique du Logo
        if ($request->hasFile('logo')) {
            // Optionnel : Supprimer l'ancien logo si vous voulez économiser de l'espace
            $oldLogo = Setting::where('key', 'clinic_logo')->first();
            if ($oldLogo && $oldLogo->value) {
                Storage::disk('public')->delete($oldLogo->value);
            }

            // Stockage dans storage/app/public/settings
            $path = $request->file('logo')->store('settings', 'public');
            
            Setting::updateOrCreate(
                ['key' => 'clinic_logo'],
                ['value' => $path]
            );
        }

        return back()->with('success', 'Configuration mise à jour avec succès.');
    }
}