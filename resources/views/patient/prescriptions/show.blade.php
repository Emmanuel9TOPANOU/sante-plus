<x-app-layout>
    <div class="py-12 bg-slate-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Actions --}}
            <div class="mb-6 flex justify-between items-center">
                <a href="{{ route('patient.history.index') }}" class="text-blue-600 font-bold flex items-center hover:underline">
                    ← Retour au dossier
                </a>
                <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded-xl font-bold shadow-lg hover:bg-blue-700 transition-all flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                    Imprimer / PDF
                </button>
            </div>

            {{-- Papier Ordonnance --}}
            <div class="bg-white shadow-2xl rounded-sm border-t-[12px] border-blue-600 p-12 md:p-16 relative overflow-hidden print:shadow-none print:border-none">
                
                {{-- Filigrane (Background deco) --}}
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-[0.03] pointer-events-none">
                    <img src="/logo.png" class="w-96 grayscale" alt="">
                </div>

                {{-- En-tête Médical --}}
                <div class="flex justify-between items-start mb-16 border-b pb-8 border-slate-100">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">Dr. {{ $prescription->medecin->name }}</h2>
                        <p class="text-blue-600 font-bold uppercase tracking-widest text-sm">{{ $prescription->medecin->specialite->nom ?? 'Médecin Généraliste' }}</p>
                        <p class="text-slate-500 text-xs mt-2 italic leading-relaxed">
                            Inscrit à l'Ordre des Médecins<br>
                            Santé + Medical Center
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-slate-400 uppercase text-[10px] font-black tracking-widest">Date de prescription</p>
                        <p class="text-slate-900 font-bold">{{ \Carbon\Carbon::parse($prescription->created_at)->translatedFormat('d F Y') }}</p>
                    </div>
                </div>

                {{-- Infos Patient --}}
                <div class="mb-12">
                    <p class="text-slate-500 text-sm mb-1">Patient :</p>
                    <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight">{{ Auth::user()->name }}</h3>
                </div>

                {{-- Contenu (Les Médicaments) --}}
               {{-- Contenu (Les Médicaments) --}}
<div class="min-h-[400px]">
    <h4 class="text-4xl font-serif italic text-slate-300 mb-8 select-none">Rp/</h4>
    
    <div class="space-y-8 text-slate-800 text-lg leading-relaxed">
        {{-- Utilisation de la colonne 'contenu' définie dans ton modèle --}}
        {!! nl2br(e($prescription->contenu ?? 'Aucun médicament spécifié')) !!}
    </div>
</div>

                {{-- Bas de page / Signature --}}
                <div class="mt-20 pt-12 border-t border-slate-50 flex justify-between items-end">
                    <div class="text-[10px] text-slate-400 w-2/3">
                        Cette ordonnance est valable 3 mois à compter de sa date d'émission. 
                        Document généré numériquement via Santé +.
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-black uppercase text-slate-400 mb-8">Signature & Cachet</p>
                        <div class="w-32 h-16 border-b-2 border-slate-200 border-dashed mx-auto"></div>
                        <p class="text-xs font-serif italic mt-2 text-slate-900">Dr. {{ $prescription->medecin->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>