<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\User;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PrescriptionController extends Controller
{
    // Liste des ordonnances du médecin avec PAGINATION
    public function index()
    {
        $prescriptions = Prescription::where('medecin_id', Auth::id())
            ->with('patient')
            ->latest()
            ->paginate(10);

        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    // Formulaire de création
    public function create()
    {
        // On récupère les patients avec leurs colonnes de santé (poids, allergies, date_naissance)
        $patients = User::where('role', 'patient')
            ->orderBy('name')
            ->get(['id', 'name', 'date_naissance', 'poids', 'allergies']);

        $consultations = Consultation::where('doctor_id', Auth::id())
            ->latest()
            ->get();

        return view('doctor.prescriptions.create', compact('patients', 'consultations'));
    }

    // Enregistrement de l’ordonnance
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'      => 'required|exists:users,id',
            'contenu'         => 'required|string',
            'date_emission'   => 'required|date',
            'consultation_id' => 'nullable|exists:consultations,id',
            'age'             => 'nullable', // On valide après nettoyage
            'poids'           => 'nullable|numeric|min:0|max:500', // Protection Out of Range
        ]);

        // Nettoyage de l'âge : transforme "21 ans" en 21 (entier)
        $ageValue = null;
        if ($request->filled('age')) {
            $ageValue = (int) filter_var($request->age, FILTER_SANITIZE_NUMBER_INT);
        }

        $prescription = Prescription::create([
            'reference'       => 'ORD-' . strtoupper(substr(uniqid(), -6)),
            'medecin_id'      => Auth::id(),
            'patient_id'      => $validated['patient_id'],
            'consultation_id' => $validated['consultation_id'],
            'contenu'         => $validated['contenu'],
            'date_emission'   => $validated['date_emission'],
            'age'             => $ageValue,
            'poids'           => $validated['poids'] ?? null,
        ]);

        return redirect()
            ->route('doctor.prescriptions.index')
            ->with('success', "L'ordonnance {$prescription->reference} a été créée avec succès.")
            ->with('prescription_id', $prescription->id); // Pour le bouton PDF dans la vue
    }

    // Téléchargement de l’ordonnance en PDF
    public function download($id)
    {
        $prescription = Prescription::with(['patient', 'medecin'])->findOrFail($id);

        // Sécurité : seul le médecin prescripteur peut télécharger
        if ($prescription->medecin_id !== Auth::id()) {
            abort(403, 'Action non autorisée.');
        }

        $pdf = Pdf::loadView('doctor.prescriptions.pdf', compact('prescription'));

        return $pdf->download("Ordonnance-{$prescription->reference}.pdf");
    }
}