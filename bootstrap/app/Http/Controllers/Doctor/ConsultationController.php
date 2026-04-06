<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Models\Rendezvous;
use App\Models\User;
use App\Models\Ordonnance; 
use App\Models\LabResult; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // Pour le futur téléchargement

class ConsultationController extends Controller
{
    /**
     * Liste des consultations passées par le médecin connecté
     */
    public function index()
    {
        $consultations = Consultation::with('patient')
            ->where('doctor_id', Auth::id())
            ->latest()
            ->get();

        return view('doctor.consultations.index', compact('consultations'));
    }

    /**
     * Affiche le formulaire de création de consultation
     */
    public function create($rendezvous_id)
    {
        $rendezvous = Rendezvous::with('patient')->findOrFail($rendezvous_id);
        return view('doctor.consultations.create', compact('rendezvous'));
    }

    /**
     * Enregistre la consultation, l'ordonnance, les analyses et termine le RDV
     */
    public function store(Request $request)
    {
        $request->validate([
            'rendezvous_id'   => 'required|exists:rendezvous,id',
            'patient_id'      => 'required|exists:users,id',
            'diagnostic'      => 'required|string|max:255',
            'sexe'            => 'nullable|in:M,F',
            'groupe_sanguin'  => 'nullable|string|max:5',
            'date_naissance'  => 'nullable|date',
            'antecedents_medicaux' => 'nullable|string',
            'allergies'       => 'nullable|string',
            'tension'         => 'nullable|string|max:10',
            'temperature'     => 'nullable|numeric',
            'poids'           => 'nullable|numeric',
            'motif'           => 'nullable|string',
            'ordonnance'      => 'nullable|string',
            'analyses'        => 'nullable|array',
        ]);

        return DB::transaction(function () use ($request) {
            
            // 1. Mise à jour du dossier permanent du Patient
            $patient = User::findOrFail($request->patient_id);
            $patient->update([
                'sexe'           => $request->sexe,
                'date_naissance' => $request->date_naissance,
                'groupe_sanguin' => $request->groupe_sanguin,
                'antecedents'    => $request->antecedents_medicaux,
                'allergies'      => $request->allergies,
            ]);

            // 2. Création de la Consultation
            $consultation = Consultation::create([
                'rendezvous_id'     => $request->rendezvous_id,
                'patient_id'        => $request->patient_id,
                'doctor_id'         => Auth::id(), 
                'diagnostic'        => $request->diagnostic,
                'observations'      => $request->motif,
                'tension'           => $request->tension,
                'temperature'       => $request->temperature,
                'poids'             => $request->poids,
                'date_consultation' => now(),
            ]);

            // 3. ENREGISTREMENT DE L'ORDONNANCE
            if (!empty($request->ordonnance)) {
                Ordonnance::create([
                    'consultation_id'      => $consultation->id,
                    'rendezvous_id'        => $request->rendezvous_id,
                    'contenu_prescription' => $request->ordonnance,
                    'date_emission'        => now(),
                    'date_expiration'      => now()->addDays(30),
                ]);
            }

            // 4. ENREGISTREMENT DES ANALYSES (Statut en attente)
            if ($request->has('analyses')) {
                foreach ($request->analyses as $typeAnalyse) {
                    if (!empty($typeAnalyse)) {
                        LabResult::create([
                            'consultation_id' => $consultation->id,
                            'user_id'         => $request->patient_id,
                            'type_analyse'    => $typeAnalyse,
                            'statut'          => 'en_attente',
                        ]);
                    }
                }
            }

            // 5. Clôture du Rendez-vous
            Rendezvous::where('id', $request->rendezvous_id)->update(['statut' => 'termine']);

            return redirect()->route('doctor.dashboard')
                             ->with('success', 'La consultation et les prescriptions ont été enregistrées.');
        });
    }

    /**
     * Liste des analyses prescrites par le médecin (pour saisie des résultats)
     */
    public function indexAnalyses()
    {
        $analyses = LabResult::whereHas('consultation', function($query) {
                $query->where('doctor_id', Auth::id());
            })
            ->with('user')
            ->latest()
            ->get();

        return view('doctor.analyses.index', compact('analyses'));
    }

    /**
     * Enregistre les résultats d'analyses (Le médecin valide en interne)
     */
  public function storeAnalyseResult(Request $request, $id)
{
    // 1. Validation des données arrivant du formulaire
    $request->validate([
        'valeur' => 'required|string',
        'unite' => 'required|string',
        'norme' => 'required|string',
        'date_prelevement' => 'required',
        'laboratoire_nom' => 'required|string',
        'interpretation' => 'nullable|string',
    ]);

    $analyse = LabResult::findOrFail($id);

    // 2. Mise à jour selon TES colonnes PHPMyAdmin
    $analyse->update([
        'valeur' => $request->valeur,
        'unite' => $request->unite,
        'norme' => $request->norme,
        'date_prelevement' => $request->date_prelevement,
        'laboratoire_nom' => $request->laboratoire_nom,
        'interpretation' => $request->interpretation,
        
        // Champs automatiques
        'statut' => 'termine', 
        'date_validation' => now(),
        'biologiste_nom' => Auth::user()->name,
    ]);

    return back()->with('success', 'Résultats enregistrés avec succès.');
}


    public function downloadAnalyse($id)
{
    $analyse = LabResult::with(['user', 'doctor', 'consultation'])->findOrFail($id);

    // Vérification de sécurité
    if ($analyse->statut !== 'termine') {
        return back()->with('error', 'Le résultat n\'est pas encore disponible.');
    }

    $pdf = Pdf::loadView('doctor.analyses.pdf', compact('analyse'));
    
    // Format du nom de fichier : Analyse_NomPatient_Date.pdf
    $fileName = 'Analyse_' . str_replace(' ', '_', $analyse->user->name) . '_' . now()->format('dmY') . '.pdf';

    return $pdf->download($fileName);
}



    public function show($id)
    {
        $consultation = Consultation::with(['patient', 'doctor'])->findOrFail($id);
        
        if ($consultation->doctor_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403, 'Accès non autorisé.');
        }

        return view('doctor.consultations.show', compact('consultation'));
    }
}