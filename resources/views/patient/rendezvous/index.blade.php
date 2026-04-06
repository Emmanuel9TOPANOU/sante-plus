<x-app-layout>
    <div class="py-6 md:py-12 bg-[#F8FAFC] min-h-screen montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
   

            {{-- Navigation / Retour --}}
            <div class="mb-6 md:mb-8">
                <a href="{{ route('patient.dashboard') }}" class="inline-flex items-center p-2.5 bg-white rounded-xl shadow-sm border border-gray-50 text-gray-400 hover:text-blue-600 transition-colors gap-2 text-xs md:text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour au tableau de bord
                </a>
            </div>

            {{-- Header Adaptatif --}}
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-8 md:mb-12 gap-6">
                <div>
                    <h2 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight uppercase">
                        Suivi <span class="text-blue-600">Médical</span>
                    </h2>
                    <p class="text-slate-400 text-[9px] md:text-[11px] font-bold uppercase tracking-[0.2em] mt-2 md:mt-3 italic flex items-center">
                        <span class="w-6 md:w-8 h-[2px] bg-blue-600 mr-3"></span>
                        Historique des consultations
                    </p>
                </div>
                
                <a href="{{ route('patient.rendezvous.create') }}" 
                   class="w-full lg:w-auto inline-flex items-center justify-center px-8 py-4 md:py-5 bg-blue-600 text-white rounded-2xl md:rounded-[1.8rem] font-black uppercase tracking-widest text-[10px] md:text-[11px] shadow-xl shadow-blue-200 hover:bg-slate-900 transform lg:hover:-translate-y-1 transition-all duration-300">
                    <i class="fa-solid fa-plus mr-3"></i>
                    Nouveau Rendez-vous
                </a>
            </div>

            {{-- Card Principale --}}
            <div class="bg-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-blue-900/5 overflow-hidden border border-white">
                
                {{-- Vue Desktop (Tableau) --}}
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-0">
                        <thead>
                            <tr class="bg-slate-50/80">
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Praticien</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Date & Heure</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Motif</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Statut</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($rendezvous as $rdv)
                                <tr class="hover:bg-blue-50/20 transition-all duration-200 group {{ $rdv->statut === 'annule' ? 'opacity-60 bg-slate-50/30' : '' }}">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center text-blue-600 font-black mr-4 border border-blue-200 transition-transform group-hover:scale-110">
                                                {{ strtoupper(substr($rdv->medecin->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="block font-black text-slate-700 text-sm leading-tight group-hover:text-blue-600">Dr. {{ $rdv->medecin->name }}</span>
                                                <span class="text-[9px] text-blue-400 font-black uppercase tracking-[0.1em] mt-1 block italic">{{ $rdv->medecin->specialite->nom_specialite ?? 'Généraliste' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-xs font-black text-slate-700 uppercase">
                                        {{ \Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d F Y') }}
                                        <span class="block text-blue-500 mt-1 font-bold italic"><i class="fa-regular fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H\hi') }}</span>
                                    </td>
                                    <td class="px-8 py-6 text-xs font-bold text-slate-400 italic">
                                        {{ Str::limit($rdv->motif ?? 'Consultation de routine', 30) }}
                                    </td>
                                    <td class="px-8 py-6">
                                        @php
                                            $statusColors = [
                                                'en_attente' => 'bg-amber-50 text-amber-600 border-amber-200',
                                                'confirme' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                                'annule' => 'bg-rose-50 text-rose-600 border-rose-200',
                                                'termine' => 'bg-slate-100 text-slate-500 border-slate-200',
                                            ][$rdv->statut] ?? 'bg-slate-50 text-slate-400';
                                        @endphp
                                        <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest border {{ $statusColors }}">
                                            {{ str_replace('_', ' ', $rdv->statut) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-3">
                                            @if($rdv->statut === 'en_attente' || $rdv->statut === 'confirme')
                                                {{-- Bouton Modifier --}}
                                                <a href="{{ route('patient.rendezvous.edit', $rdv->id) }}" 
                                                   class="px-4 py-2 bg-slate-100 text-slate-600 hover:bg-blue-600 hover:text-white rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300 border border-slate-200 hover:border-blue-500 shadow-sm">
                                                    Modifier
                                                </a>

                                                {{-- Bouton Annuler --}}
                                                <a href="{{ route('patient.rendezvous.annulation_rapide', $rdv->id) }}" 
                                                   onclick="return confirm('Voulez-vous vraiment annuler ce rendez-vous ?');"
                                                   class="px-4 py-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300 border border-rose-100 hover:border-rose-600 shadow-sm">
                                                    Annuler
                                                </a>
                                            @else
                                                <span class="text-[9px] text-slate-300 font-black uppercase italic tracking-widest flex items-center bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
                                                    <i class="fa-solid fa-lock mr-2"></i> Archivé
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-10 py-32 text-center text-slate-300 font-black uppercase text-xs tracking-widest italic">Aucun rendez-vous trouvé</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Vue Mobile --}}
                <div class="lg:hidden divide-y divide-slate-50">
                    @forelse($rendezvous as $rdv)
                        <div class="p-6 md:p-8 flex flex-col gap-5 {{ $rdv->statut === 'annule' ? 'bg-slate-50/50' : '' }}">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-black mr-4 border border-blue-100">
                                        {{ strtoupper(substr($rdv->medecin->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 class="font-black text-slate-700 text-sm">Dr. {{ $rdv->medecin->name }}</h4>
                                        <span class="text-[9px] text-blue-400 font-black uppercase italic tracking-wider">{{ $rdv->medecin->specialite->nom_specialite ?? 'Généraliste' }}</span>
                                    </div>
                                </div>
                                <span class="px-2 py-1 rounded-lg text-[8px] font-black uppercase border {{ $statusColors }}">
                                    {{ str_replace('_', ' ', $rdv->statut) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 py-4 border-y border-slate-50 border-dashed">
                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Date & Heure</p>
                                    <p class="text-[10px] font-black text-slate-700 uppercase tracking-tighter">
                                        {{ \Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d M Y') }}
                                    </p>
                                    <p class="text-[10px] font-bold text-blue-500">{{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H\hi') }}</p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Motif</p>
                                    <p class="text-[10px] font-bold text-slate-400 italic leading-tight">{{ $rdv->motif ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3">
                                @if($rdv->statut === 'en_attente' || $rdv->statut === 'confirme')
                                    <a href="{{ route('patient.rendezvous.edit', $rdv->id) }}" class="flex-1 flex items-center justify-center py-3 bg-slate-50 text-slate-600 rounded-xl text-[10px] font-black uppercase border border-slate-100 transition-colors active:bg-blue-600 active:text-white">
                                        Modifier
                                    </a>
                                    <a href="{{ route('patient.rendezvous.annulation_rapide', $rdv->id) }}" 
                                       onclick="return confirm('Annuler ce rendez-vous ?');"
                                       class="flex-1 flex items-center justify-center py-3 bg-rose-50 text-rose-600 rounded-xl text-[10px] font-black uppercase border border-rose-100 transition-colors active:bg-rose-600 active:text-white">
                                        Annuler
                                    </a>
                                @else
                                    <div class="w-full text-center py-3 bg-slate-50 rounded-xl text-[9px] font-black text-slate-300 uppercase italic border border-slate-100">
                                        Dossier Archivé
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="py-20 text-center px-6">
                            <i class="fa-solid fa-folder-open text-4xl text-slate-100 mb-4"></i>
                            <p class="text-slate-400 font-black uppercase text-[10px] tracking-widest">Aucun historique</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($rendezvous->hasPages())
                    <div class="px-6 md:px-10 py-6 md:py-8 bg-slate-50/50 border-t border-slate-50">
                        {{ $rendezvous->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>