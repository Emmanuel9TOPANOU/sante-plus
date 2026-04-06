<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AvailabilityController extends Controller
{
    /**
     * Affiche les créneaux avec pagination
     */
    public function index()
    {
        $today = Carbon::today();

        $availabilities = Auth::user()->availabilities()
            ->where('date', '>=', $today->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->paginate(12);

        return view('doctor.availabilities.index', compact('availabilities'));
    }

    /**
     * Génération massive basée sur les jours sélectionnés
     */
    public function store(Request $request)
    {
        $request->validate([
            'days'       => 'required|array|min:1', // Au moins un jour coché
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time'   => 'required|after:start_time',
            'duration'   => 'required|integer|min:15|max:480',
        ]);

        $duration = (int) $request->duration;
        $selectedDays = $request->days; // Ex: [1, 2, 4] pour Lun, Mar, Jeu
        $count = 0;
        $skipped = 0;

        // Création de la période entre les deux dates
        $period = CarbonPeriod::create($request->start_date, $request->end_date);

        foreach ($period as $date) {
            // On vérifie si le jour de la semaine (0-6) est dans la sélection du docteur
            // Carbon dayOfWeek : 0 (Dim) à 6 (Sam)
            if (!in_array($date->dayOfWeek, $selectedDays)) {
                continue;
            }

            $dateString = $date->toDateString();
            
            // Initialisation des objets Carbon pour les heures de début et fin de la journée
            $startTimeObj = Carbon::parse($dateString . ' ' . $request->start_time);
            $endTimeLimit = Carbon::parse($dateString . ' ' . $request->end_time);

            $current = $startTimeObj->copy();

            // Génération des créneaux tant que le créneau complet tient dans l'intervalle
            while ($current->copy()->addMinutes($duration)->lte($endTimeLimit)) {
                $slotStart = $current->format('H:i:s');
                $slotEnd = $current->copy()->addMinutes($duration)->format('H:i:s');

                // Vérification d'existence (Évite les erreurs SQL Duplicate Entry)
                $exists = Availability::where('user_id', Auth::id())
                    ->where('date', $dateString)
                    ->where('start_time', $slotStart)
                    ->exists();

                if (!$exists) {
                    Availability::create([
                        'user_id'    => Auth::id(),
                        'date'       => $dateString,
                        'start_time' => $slotStart,
                        'end_time'   => $slotEnd,
                        'is_booked'  => false,
                    ]);
                    $count++;
                } else {
                    $skipped++;
                }

                $current->addMinutes($duration);
            }
        }

        if ($count === 0 && $skipped === 0) {
            return back()->with('error', 'Aucun créneau généré. Vérifiez la cohérence entre vos jours sélectionnés et la période.');
        }

        $msg = "Opération terminée : $count créneau(x) créé(s).";
        if ($skipped > 0) {
            $msg .= " ($skipped créneaux existaient déjà et ont été ignorés).";
        }

        return back()->with('success', $msg);
    }

    /**
     * Supprime un créneau individuel
     */
    public function destroy($id)
    {
        $availability = Availability::where('user_id', Auth::id())->findOrFail($id);

        if ($availability->is_booked) {
            return back()->with('error', 'Impossible de supprimer un créneau déjà réservé.');
        }

        $availability->delete();
        
        return back()->with('success', 'Créneau supprimé.');
    }

    /**
     * Nettoyage complet d'une date spécifique
     */
    public function clearDay(Request $request)
    {
        $request->validate(['date' => 'required|date']);

        $deleted = Availability::where('user_id', Auth::id())
            ->where('date', $request->date)
            ->where('is_booked', false)
            ->delete();

        return back()->with('success', "Les créneaux libres du " . Carbon::parse($request->date)->format('d/m/Y') . " ont été supprimés.");
    }
}