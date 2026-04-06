<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDocumentController extends Controller
{
    /**
     * 📂 Liste tous les documents (Ordonnances, Analyses, etc.)
     */
    public function index(Request $request)
    {
        // On récupère les documents avec les infos du patient et du créateur (user)
        $query = Document::with(['user', 'patient.user']); 

        // Filtre par type si demandé (ordonnance, analyse, rapport)
        if ($request->filled('type')) {
            $query->where('type_document', $request->type);
        }

        $documents = $query->latest()->paginate(12);

        return view('admin.documents.index', compact('documents'));
    }

    /**
     * 📥 Téléchargement sécurisé pour l'admin
     */
    public function download($id)
    {
        $document = Document::findOrFail($id);
        
        // On vérifie si le fichier existe physiquement sur le disque
        if (!Storage::exists($document->chemin_fichier)) {
            return back()->with('error', 'Fichier introuvable sur le serveur.');
        }

        return Storage::download($document->chemin_fichier, $document->nom_original);
    }

    /**
     * 🗑️ Suppression d'un document (Nettoyage administratif)
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        
        // 1. Supprimer le fichier physique pour libérer de l'espace
        if (Storage::exists($document->chemin_fichier)) {
            Storage::delete($document->chemin_fichier);
        }

        // 2. Supprimer la ligne dans la base de données
        $document->delete();

        return back()->with('success', 'Document supprimé définitivement.');
    }
}