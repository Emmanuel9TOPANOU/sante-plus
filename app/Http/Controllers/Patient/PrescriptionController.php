<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Prescription;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class PrescriptionController extends Controller
{
    /**
     * Affiche la liste des ordonnances du patient
     */
    public function index(): View
    {
        $ordonnances = Prescription::where('patient_id', Auth::id())
            // On charge le médecin ET sa spécialité d'un coup
            ->with(['medecin.specialite']) 
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('patient.prescriptions.index', compact('ordonnances'));
    }

    /**
     * Affiche le détail d'une ordonnance spécifique
     */
    public function show($id): View
    {
        $prescription = Prescription::where('patient_id', Auth::id())
            ->with(['medecin.specialite', 'consultation'])
            ->findOrFail($id);

        return view('patient.prescriptions.show', compact('prescription'));
    }

    /**
     * Téléchargement PDF avec les infos complètes
     */
    public function download($id)
    {
        $prescription = Prescription::where('patient_id', Auth::id())
            ->with(['medecin.specialite'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('doctor.prescriptions.pdf', compact('prescription'));
        
        return $pdf->download('Ordonnance-' . ($prescription->reference ?? $prescription->id) . '.pdf');
    }
}