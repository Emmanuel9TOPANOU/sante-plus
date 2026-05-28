<x-app-layout>
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 to-white" x-data="{ mobileMenuOpen: false }">

    {{-- OVERLAY MOBILE --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-blue-900/40 backdrop-blur-sm z-[40] lg:hidden" x-cloak>
    </div>

  {{-- NAVBAR HORIZONTALE --}}
<nav class="fixed top-0 left-0 right-0 bg-white shadow-md border-b border-blue-100 z-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex justify-between items-center h-20">
            
            {{-- LOGO / TITRE --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo MonEspaceSanté" class="w-full h-full object-contain">
                </div>
            </div>

            {{-- LIENS NAVIGATION DESKTOP --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('patient.dashboard') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
                     Tableau de bord
                </a>
                <a href="{{ route('patient.rendezvous.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
                   Rendez-vous
                </a>
               
                <a href="{{ route('patient.lab_results.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
                   Analyses
                </a>
              
                <a href="{{ route('patient.medical_record.index') }}" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
                   Dossier Médical
                </a>

                  <a href="{{ route('patient.messages.index') }}" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
              Messagerie
            </a>
            </div>

            {{-- ACTIONS & DÉCONNEXION --}}
            <div class="flex items-center gap-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-md cursor-pointer">
                            <span>Quitter</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                @endauth

                {{-- BOUTON HAMBURGER UNIQUE --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-700 hover:bg-blue-50 rounded-xl transition-all">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE (Dropdown) avec liens actifs --}}
    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="lg:hidden bg-white border-t border-blue-100 px-4 py-4 space-y-2 shadow-xl">
        <a href="{{ route('patient.dashboard') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
              Tableau de bord
        </a>
        <a href="{{ route('patient.rendezvous.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
           Rendez-vous
        </a>
      
        <a href="{{ route('patient.lab_results.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
           Analyses
        </a>
     
        <a href="{{ route('patient.medical_record.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
           Dossier Médical
        </a>

          <a href="{{ route('patient.messages.index') }}" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
              Messagerie
            </a>
    </div>
</nav>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-4 md:p-8 min-h-screen pt-24 lg:pt-20">
        <div class="max-w-7xl mx-auto">
            
            {{-- Navigation / Retour --}}
            <div class="mb-6 md:mb-8">
                <a href="{{ route('patient.dashboard') }}" class="inline-flex items-center p-2.5 bg-white rounded-xl shadow-sm border border-blue-100 text-slate-400 hover:text-blue-600 transition-colors gap-2 text-xs md:text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour au tableau de bord
                </a>
            </div>

            {{-- En-tête --}}
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-black text-blue-900 tracking-tight">
                    Mon <span class="text-blue-600">Dossier Médical</span>
                </h2>
                <p class="text-blue-500/80 font-medium mt-1 text-sm md:text-base">Consultez vos alertes santé et l'historique de vos soins.</p>
            </div>

            {{-- BANDEAU ALERTE SANTÉ --}}
            @if($infosSante->allergies || $infosSante->antecedents)
                <div class="mb-8 p-5 md:p-6 bg-white border-l-4 md:border-l-8 border-red-500 rounded-3xl md:rounded-[2rem] shadow-xl shadow-red-100/50 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex items-start md:items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center text-red-600 mr-4 shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] md:text-[11px] font-black uppercase tracking-[0.15em] text-red-500/60 leading-none mb-2">Alertes Médicales</h4>
                            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-y-2 gap-x-4">
                                @if($infosSante->allergies)
                                    <span class="text-red-900 font-black text-sm italic">
                                        <span class="text-red-500/50 not-italic mr-1">Allergies:</span>{{ $infosSante->allergies }}
                                    </span>
                                @endif
                                @if($infosSante->antecedents)
                                    <span class="text-red-900 font-black text-sm italic sm:border-l-2 sm:border-red-100 sm:pl-4">
                                        <span class="text-red-500/50 not-italic mr-1">Antécédents:</span>{{ $infosSante->antecedents }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 bg-red-50/50 p-3 rounded-2xl lg:bg-transparent lg:p-0">
                        <span class="text-[10px] font-black uppercase text-gray-400">Groupe Sanguin</span>
                        <div class="bg-red-600 px-4 py-2 rounded-xl text-xs font-black text-white shadow-md shadow-red-200">
                            {{ $infosSante->groupe_sanguin ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            @endif

            {{-- Liste de l'historique --}}
            <div class="space-y-4 md:space-y-6">
                @forelse($historique as $consultation)
                    <div class="bg-white rounded-3xl md:rounded-[2rem] shadow-xl shadow-blue-100/40 border border-blue-100 overflow-hidden hover:border-blue-300 hover:shadow-blue-200/50 transition-all duration-300">
                        <div class="p-5 md:p-8">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-blue-600 flex flex-col items-center justify-center text-white shadow-lg shadow-blue-200 shrink-0">
                                        <span class="text-[10px] font-bold uppercase">{{ \Carbon\Carbon::parse($consultation->date_rdv)->translatedFormat('M') }}</span>
                                        <span class="text-lg md:text-xl font-black leading-none">{{ \Carbon\Carbon::parse($consultation->date_rdv)->format('d') }}</span>
                                    </div>
                                    <div>
                                        <h3 class="text-base md:text-lg font-black text-blue-900 leading-tight">
                                            Dr. {{ $consultation->medecin->name ?? 'Médecin' }}
                                        </h3>
                                        <p class="text-blue-500 text-xs md:text-sm font-medium">
                                            {{ $consultation->medecin->specialite->nom_specialite ?? 'Ophtalmologie' }} 
                                            • {{ \Carbon\Carbon::parse($consultation->heure_rdv)->format('H:i') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="self-start sm:self-center">
                                    <span class="px-3 py-1.5 rounded-lg {{ $consultation->statut === 'termine' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-blue-50 text-blue-600 border-blue-100' }} text-[9px] md:text-[10px] font-black uppercase tracking-widest border">
                                        {{ $consultation->statut === 'termine' ? 'Terminé' : ucfirst($consultation->statut) }}
                                    </span>
                                </div>
                            </div>

                            <hr class="my-5 md:my-6 border-blue-100">

                            {{-- Section Observations --}}
                            <div class="bg-blue-50/30 rounded-2xl p-4 md:p-6 mb-4">
                                <h4 class="text-[10px] md:text-[11px] font-black uppercase tracking-widest text-blue-400 mb-2 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Observations Médicales
                                </h4>
                                <p class="text-blue-900/80 text-sm leading-relaxed italic">
                                    "{{ $consultation->consultation->observations ?? 'Aucune observation rédigée pour ce rendez-vous.' }}"
                                </p>
                            </div>

                            {{-- Section Analyses & Examens --}}
                            @if($consultation->consultation && $consultation->consultation->analyses->count() > 0)
                                <div class="border border-blue-100 rounded-2xl p-4 md:p-6 bg-white">
                                    <h4 class="text-[10px] md:text-[11px] font-black uppercase tracking-widest text-blue-400 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                        Analyses & Examens Complémentaires
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        @foreach($consultation->consultation->analyses as $analyse)
                                            <div class="flex items-center justify-between p-3 bg-blue-50/30 border border-blue-100 rounded-xl hover:bg-blue-50 transition-all">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-lg {{ $analyse->statut === 'termine' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }} flex items-center justify-center mr-3">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-bold text-blue-900">{{ $analyse->type_analyse }}</p>
                                                        <p class="text-[10px] text-gray-400 font-medium uppercase">{{ $analyse->statut === 'termine' ? 'Disponible' : 'En cours' }}</p>
                                                    </div>
                                                </div>
                                                @if($analyse->statut === 'termine' && $analyse->pdf_path)
                                                    <a href="{{ asset('storage/' . $analyse->pdf_path) }}" target="_blank" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl md:rounded-[2rem] py-16 md:py-24 px-6 text-center border-2 border-dashed border-blue-200">
                        <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-blue-50 text-blue-400 rounded-full mb-4">
                            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-blue-900 font-black text-lg md:text-xl">Aucun historique disponible</h3>
                        <p class="text-blue-400 mt-2 font-medium text-sm">Vos consultations terminées apparaîtront ici.</p>
                    </div>
                @endforelse

                {{-- Pagination --}}
                @if($historique->hasPages())
                    <div class="mt-8">
                        {{ $historique->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>

</div>

<style>
    [x-cloak] { display: none !important; }
    body { 
        font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
    }
</style>
</x-app-layout>