<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMedecinValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    // 1. On vérifie si l'utilisateur est connecté
    if (auth()->check()) {
        $user = auth()->user();

        // 2. On vérifie si c'est un médecin (en supposant que tu as un champ 'role' dans ta table users)
        if ($user->role === 'medecin') {
            
            // On récupère ses infos de médecin (relation un-à-un)
            // Assure-toi d'avoir la relation 'medecin' dans ton Model User
            $medecin = $user->medecin;

            // 3. Si le médecin n'est pas encore validé
            if ($medecin && !$medecin->est_valide) {
                
                // On évite une boucle infinie : si l'utilisateur est déjà sur la page d'attente
                // ou s'il essaie de se déconnecter, on le laisse passer.
                if (!$request->routeIs('attente-validation') && !$request->is('logout')) {
                    return redirect()->route('attente-validation');
                }
            }
        }
    }

    return $next($request);
}
}
