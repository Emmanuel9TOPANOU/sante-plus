<x-app-layout>
    <div class="py-6 md:py-10 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            
            {{-- HEADER : INFOS PATIENT --}}
            <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-6 px-4 md:px-0">
                <div class="flex flex-col sm:flex-row items-center text-center sm:text-left space-y-4 sm:space-y-0 sm:space-x-6">
                    <div class="w-20 h-20 rounded-[2rem] bg-gradient-to-br from-blue-600 to-blue-800 shadow-xl shadow-blue-200 flex-shrink-0 flex items-center justify-center text-white text-2xl font-black">
                        @php
                            $initials = collect(explode(' ', $patient->name))->map(fn($n) => strtoupper(substr($n, 0, 1)))->take(2)->implode('');
                        @endphp
                        {{ $initials }}
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-slate-900 italic tracking-tighter">{{ $patient->name }}</h1>
                        <p class="text-slate-500 font-bold text-[10px] md:text-xs uppercase tracking-[0.1em] md:tracking-[0.2em] leading-relaxed">
                            ID: #PAT-{{ $patient->id }} <span class="hidden sm:inline">•</span><br class="sm:hidden">
                            {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->age : '??' }} ans • 
                            Sexe: <span class="text-slate-900">{{ $patient->sexe ?? 'N/A' }}</span> <span class="hidden sm:inline">•</span><br class="sm:hidden">
                            Groupe: <span class="text-red-600 font-black">{{ $patient->groupe_sanguin ?? 'Inconnu' }}</span>
                        </p>
                    </div>
                </div>

               
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                
                {{-- COLONNE GAUCHE : ALERTES ET INFOS FIXES --}}
                <div class="space-y-6 md:space-y-8 order-2 lg:order-1">
                    {{-- FICHE ALLERGIES --}}
                    <div class="bg-red-50 rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-8 border border-red-100 shadow-xl shadow-red-100/50 relative overflow-hidden">
                        <div class="absolute -right-4 -top-4 w-20 h-20 bg-red-100 rounded-full opacity-50"></div>
                        <h3 class="text-red-800 font-black italic mb-4 flex items-center relative z-10 text-sm md:text-base">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"/></svg>
                            Allergies & Alertes
                        </h3>
                        <div class="flex flex-wrap gap-2 relative z-10">
                            @if($patient->allergies && $patient->allergies !== 'Aucune')
                                @foreach(preg_split('/[, et]+/', $patient->allergies) as $allergy)
                                    <span class="bg-white px-3 py-1.5 rounded-xl text-red-600 text-[9px] font-black uppercase border border-red-200 shadow-sm">{{ trim($allergy) }}</span>
                                @endforeach
                            @else
                                <p class="text-red-400 text-xs font-bold italic">Aucune allergie signalée</p>
                            @endif
                        </div>
                    </div>

                    {{-- FICHE ANTÉCÉDENTS --}}
                    <div class="bg-white rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-8 border border-slate-100 shadow-xl shadow-slate-200/50">
                        <h3 class="text-slate-900 font-black italic mb-6 text-sm md:text-base">Antécédents Médicaux</h3>
                        <ul class="space-y-4">
                            @if($patient->antecedents)
                                <li class="flex items-start">
                                    <span class="w-2 h-2 bg-blue-500 rounded-full mt-1.5 mr-3 flex-shrink-0"></span>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800 leading-tight">{{ $patient->antecedents }}</p>
                                        <p class="text-[9px] md:text-[10px] text-slate-400 font-bold uppercase mt-1">{{ $patient->observations_medicales ?? 'Pas d\'observations globales' }}</p>
                                    </div>
                                </li>
                            @else
                                <li class="text-slate-400 text-xs italic">Aucun antécédent listé</li>
                            @endif
                        </ul>
                    </div>
                </div>

                {{-- COLONNE DROITE : HISTORIQUE --}}
                <div class="lg:col-span-2 space-y-6 order-1 lg:order-2">
                    <h3 class="text-slate-400 font-black text-[10px] md:text-xs uppercase tracking-[0.3em] ml-4 md:ml-6">Journal des Consultations</h3>
                    
                    @forelse($consultations as $consultation)
                        <div class="bg-white rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-8 border border-slate-100 shadow-xl shadow-slate-200/40 group hover:border-blue-200 transition-all">
                            <div class="flex flex-col sm:flex-row justify-between items-start mb-6 gap-4">
                                <div>
                                    <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-xl text-[9px] md:text-[10px] font-black uppercase tracking-widest">
                                        {{ $consultation->created_at->translatedFormat('d F Y') }}
                                    </span>
                                    <h4 class="text-lg md:text-xl font-black text-slate-900 mt-3 italic">{{ $consultation->diagnostic }}</h4>
                                </div>
                                
                                {{-- Badges de constantes (Grille 3 colonnes même sur mobile car petits textes) --}}
                                <div class="flex space-x-2 sm:space-x-4 bg-slate-50 p-3 md:p-4 rounded-2xl w-full sm:w-auto justify-between sm:justify-start">
                                    <div class="text-center px-2">
                                        <p class="text-[8px] md:text-[9px] font-black text-slate-400 uppercase">Poids</p>
                                        <p class="text-[11px] md:text-xs font-bold text-blue-600">{{ $consultation->poids ?? '--' }} kg</p>
                                    </div>
                                    <div class="text-center border-l border-slate-200 px-2 sm:pl-4">
                                        <p class="text-[8px] md:text-[9px] font-black text-slate-400 uppercase">Tension</p>
                                        <p class="text-[11px] md:text-xs font-bold text-blue-600">{{ $consultation->tension ?? '--' }}</p>
                                    </div>
                                    <div class="text-center border-l border-slate-200 px-2 sm:pl-4">
                                        <p class="text-[8px] md:text-[9px] font-black text-slate-400 uppercase">Temp.</p>
                                        <p class="text-[11px] md:text-xs font-bold text-blue-600">{{ $consultation->temperature ?? '--' }}°C</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-slate-50/50 rounded-2xl p-5 md:p-6 mb-6 border border-slate-100/50">
                                <p class="text-xs md:text-sm text-slate-600 font-medium leading-relaxed italic">
                                    "{{ $consultation->observations ?? 'Pas d\'observations pour cette séance.' }}"
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row items-center justify-between pt-4 border-t border-slate-50 gap-4">
                                <div class="flex items-center space-x-2 w-full sm:w-auto">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex-shrink-0 flex items-center justify-center text-[10px] font-bold text-blue-600 border border-blue-200 uppercase">
                                        {{ substr($consultation->doctor->name ?? 'D', 0, 1) }}
                                    </div>
                                    <span class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest truncate">Dr. {{ $consultation->doctor->name ?? 'Inconnu' }}</span>
                                </div>
                                
                                @if(isset($consultation->prescription))
                                    <a href="{{ route('doctor.prescriptions.show', $consultation->prescription->id) }}" class="w-full sm:w-auto text-center border sm:border-none border-blue-100 py-2 sm:py-0 rounded-xl text-blue-600 font-black text-[9px] md:text-[10px] uppercase tracking-widest flex items-center justify-center group-hover:translate-x-1 transition-all">
                                        Voir Ordonnance 
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-[2rem] md:rounded-[2.5rem] p-12 md:p-20 text-center border-2 border-dashed border-slate-200">
                            <p class="text-slate-400 font-bold italic uppercase text-[10px] md:text-xs tracking-widest">Aucune consultation enregistrée.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>