<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Suivi des <span class="text-blue-600">Analyses</span></h2>
                    <p class="text-gray-500 font-medium">Gestion interne du laboratoire et validation des résultats.</p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black uppercase text-gray-400 block tracking-widest">Date du jour</span>
                    <span class="text-sm font-bold text-gray-900">{{ now()->format('d/m/Y') }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8">
                @forelse($analyses as $analyse)
                    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden transition hover:shadow-xl hover:border-blue-100">
                        <div class="p-8 md:p-10">
                            <div class="flex flex-col lg:flex-row gap-10">
                                
                                {{-- 1. 📌 BLOC PRESCRIPTION (Infos Patient) --}}
                                <div class="w-full lg:w-1/3 border-r border-gray-50 pr-6">
                                    <div class="flex items-center gap-3 mb-6">
                                        <span class="bg-blue-600 text-white text-[10px] font-black uppercase px-3 py-1 rounded-lg">
                                            N° {{ $analyse->id }}
                                        </span>
                                        @if($analyse->statut == 'en_attente')
                                            <span class="bg-yellow-100 text-yellow-700 text-[10px] font-black uppercase px-3 py-1 rounded-lg">En attente</span>
                                        @else
                                            <span class="bg-green-100 text-green-700 text-[10px] font-black uppercase px-3 py-1 rounded-lg">Résultat disponible</span>
                                        @endif
                                    </div>
                                    
                                    <h3 class="text-2xl font-black text-gray-900">{{ $analyse->user->name }}</h3>
                                    <div class="mt-4 space-y-2">
                                        <p class="text-sm font-bold text-blue-600 uppercase tracking-tight">{{ $analyse->type_analyse }}</p>
                                        <p class="text-xs text-gray-500 italic">"{{ $analyse->observations ?? 'Aucune observation particulière' }}"</p>
                                    </div>
                                    
                                    <div class="mt-8 pt-6 border-t border-gray-50">
                                        <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Prescrit par</p>
                                        <p class="text-sm font-bold text-gray-700">Dr. {{ $analyse->doctor->name ?? Auth::user()->name }}</p>
                                        <p class="text-[10px] text-gray-400 mt-1 italic">{{ $analyse->created_at->format('d/m/Y à H:i') }}</p>
                                    </div>
                                </div>

                                {{-- 2. 🔬 BLOC SAISIE / RÉSULTATS --}}
                                <div class="w-full lg:w-2/3">
                                    @if($analyse->statut == 'en_attente')
                                        {{-- CORRECTION ICI : doctor.analyses.store_result --}}
                                        <form action="{{ route('doctor.analyses.store_result', $analyse->id) }}" method="POST" class="space-y-6">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-blue-50/30 p-6 rounded-[2rem] border border-blue-50">
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-blue-500 ml-2">Date & Heure Prélèvement</label>
                                                    <input type="datetime-local" name="date_prelevement" required value="{{ now()->format('Y-m-d\TH:i') }}" 
                                                        class="w-full mt-1 border-none bg-white rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 text-sm h-12">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-blue-500 ml-2">Laboratoire / Service</label>
                                                    <input type="text" name="laboratoire_nom" required value="Laboratoire Interne Santé+" 
                                                        class="w-full mt-1 border-none bg-white rounded-2xl shadow-sm focus:ring-2 focus:ring-blue-500 text-sm h-12 font-medium">
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-gray-400 ml-2 tracking-widest">Valeur mesurée</label>
                                                    <input type="text" name="valeur" placeholder="Ex: 1.20" required 
                                                        class="w-full mt-1 border-none bg-gray-100 rounded-2xl shadow-inner focus:ring-2 focus:ring-blue-500 font-black text-lg text-center h-14">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-gray-400 ml-2 tracking-widest">Unité</label>
                                                    <input type="text" name="unite" placeholder="Ex: g/L" required 
                                                        class="w-full mt-1 border-none bg-gray-100 rounded-2xl shadow-inner focus:ring-2 focus:ring-blue-500 font-bold text-center h-14">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-gray-400 ml-2 tracking-widest">Normes (Min-Max)</label>
                                                    <input type="text" name="norme" placeholder="Ex: 0.70 - 1.10" required 
                                                        class="w-full mt-1 border-none bg-gray-100 rounded-2xl shadow-inner focus:ring-2 focus:ring-blue-500 font-bold text-center h-14 text-blue-600">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="text-[10px] font-black uppercase text-gray-400 ml-2 tracking-widest">Interprétation clinique & Conclusion</label>
                                                <textarea name="interpretation" rows="2" placeholder="Ex: Glycémie normale. Pas d'anomalie détectée..." 
                                                    class="w-full mt-1 border-none bg-gray-100 rounded-3xl shadow-inner focus:ring-2 focus:ring-blue-500 text-sm p-4"></textarea>
                                            </div>

                                            <button type="submit" class="w-full bg-gray-900 text-white h-16 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.3em] hover:bg-blue-600 transition-all shadow-xl active:scale-95">
                                                Valider & Générer le Bilan Final
                                            </button>
                                        </form>
                                    @else
                                        <div class="space-y-6">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="bg-blue-600 p-6 rounded-[2rem] text-white">
                                                    <p class="text-[9px] font-black uppercase opacity-60 tracking-[0.2em]">Résultat</p>
                                                    <p class="text-2xl font-black">{{ $analyse->valeur }} <span class="text-xs font-medium">{{ $analyse->unite }}</span></p>
                                                </div>
                                                <div class="bg-gray-900 p-6 rounded-[2rem] text-white">
                                                    <p class="text-[9px] font-black uppercase opacity-60 tracking-[0.2em]">Normes</p>
                                                    <p class="text-sm font-black">{{ $analyse->norme }}</p>
                                                </div>
                                                <div class="bg-gray-50 p-6 rounded-[2rem] border border-gray-100">
                                                    <p class="text-[9px] font-black uppercase text-gray-400 tracking-[0.2em]">Prélèvement</p>
                                                    <p class="text-xs font-bold text-gray-700">{{ \Carbon\Carbon::parse($analyse->date_prelevement)->format('d/m/Y H:i') }}</p>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 relative">
                                                <span class="absolute -top-3 left-8 bg-white px-4 py-1 text-[9px] font-black uppercase text-blue-600 border border-blue-100 rounded-full italic tracking-widest italic">
                                                    Conclusion Médicale
                                                </span>
                                                <p class="text-sm text-gray-600 leading-relaxed font-medium italic">"{{ $analyse->interpretation ?? 'Aucune interprétation saisie.' }}"</p>
                                                <div class="mt-6 flex justify-between items-end border-t border-gray-200 pt-6">
                                                    <div>
                                                        <p class="text-[9px] font-black uppercase text-gray-400">Validé par</p>
                                                        <p class="text-sm font-black text-gray-800">Dr. {{ $analyse->biologiste_nom }}</p>
                                                    </div>
                                                    {{-- CORRECTION ICI : doctor.analyses.download --}}
                                                    <a href="{{ route('doctor.analyses.download', $analyse->id) }}" class="flex items-center gap-2 bg-white border border-gray-200 px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition shadow-sm">
                                                        📄 Télécharger PDF
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[4rem] p-32 text-center border-2 border-dashed border-gray-100">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 rounded-full mb-6 text-blue-300 text-4xl">🔬</div>
                        <h3 class="text-xl font-black text-gray-900 mb-2 uppercase tracking-widest">Laboratoire Vide</h3>
                        <p class="text-gray-400 font-medium">Aucune analyse n'est en attente de traitement actuellement.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>