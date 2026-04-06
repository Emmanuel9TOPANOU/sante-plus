<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rendezvous;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRendezvousController extends Controller
{
    public function index(Request $request)
    {
        $query = Rendezvous::with(['patient', 'medecin']);

        // Filtre par Médecin
        if ($request->filled('medecin_id')) {
            $query->where('medecin_id', $request->medecin_id);
        }

        // Filtre par Date
        if ($request->filled('date')) {
            $query->whereDate('date_rdv', $request->date);
        }

        $rendezvous = $query->orderBy('date_rdv', 'desc')->paginate(15);
        $medecins = User::where('role', 'medecin')->get();

        return view('admin.rendezvous.index', compact('rendezvous', 'medecins'));
    }

    public function updateStatus(Request $request, $id)
    {
        $rdv = Rendezvous::findOrFail($id);
        $rdv->update(['status' => $request->status]);

        return back()->with('success', 'Le statut du rendez-vous a été modifié.');
    }
}