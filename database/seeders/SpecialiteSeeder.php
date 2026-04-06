<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialiteSeeder extends Seeder
{
    public function run(): void
    {
        $specialites = [
            ['nom_specialite' => 'Médecine Générale', 'description' => 'Consultations de premier recours et suivi global.'],
            ['nom_specialite' => 'Cardiologie', 'description' => 'Maladies du cœur et des vaisseaux sanguins.'],
            ['nom_specialite' => 'Pédiatrie', 'description' => 'Santé et développement des enfants et nourrissons.'],
            ['nom_specialite' => 'Dermatologie', 'description' => 'Maladies de la peau, des cheveux et des ongles.'],
            ['nom_specialite' => 'Gynécologie', 'description' => 'Santé reproductive de la femme et suivi de grossesse.'],
            ['nom_specialite' => 'Ophtalmologie', 'description' => 'Troubles de la vision et maladies oculaires.'],
            ['nom_specialite' => 'Psychiatrie', 'description' => 'Troubles mentaux et accompagnement psychologique.'],
            ['nom_specialite' => 'Neurologie', 'description' => 'Maladies du système nerveux.'],
            ['nom_specialite' => 'Orthopédie', 'description' => 'Chirurgie des os, articulations et ligaments.'],
            ['nom_specialite' => 'Dentiste', 'description' => 'Soins bucco-dentaires et chirurgie dentaire.'],
        ];

        foreach ($specialites as $spe) {
            DB::table('specialites')->updateOrInsert(
                ['nom_specialite' => $spe['nom_specialite']], // Évite les doublons
                [
                    'description' => $spe['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}