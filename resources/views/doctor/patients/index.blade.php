<x-app-layout>
<div x-data="{ mobileMenuOpen: false, search: '', filterSexe: '', filterGroupe: '', showFilters: false }" class="flex min-h-screen bg-gradient-to-br from-slate-100 to-white font-sans antialiased">

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        
        .glass-effect { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); }
        [x-cloak] { display: none !important; }
        
        .nav-item {
            transition: all 0.2s ease;
            position: relative;
        }
        .nav-item:hover {
            transform: translateY(-2px);
        }
        .nav-item.active {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2), 0 4px 6px -2px rgba(37, 99, 235, 0.1);
        }
        .nav-item.active svg {
            color: white;
        }
        
        .patient-card {
            transition: all 0.3s ease;
        }
        .patient-card:hover {
            transform: translateY(-8px);
        }
    </style>

    {{-- OVERLAY MOBILE --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden" x-cloak>
    </div>

    {{-- NAVBAR HORIZONTALE MÉDECIN --}}
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg border-b border-slate-100 z-50">
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
                    <a href="{{ route('doctor.dashboard') }}" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('doctor.dashboard') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="{{ route('doctor.patients.index') }}" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('doctor.patients*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Patients
                    </a>

                    <a href="{{ route('doctor.rendezvous.index') }}" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('doctor.rendezvous*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Agenda
                    </a>

                    <a href="{{ route('doctor.analyses.index') }}" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('doctor.analyses*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        Analyses
                    </a>

                 
                    <a href="{{ route('doctor.availabilities.index') }}" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('doctor.availabilities*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Horaires
                    </a>

                    <a href="{{ route('doctor.messages.index') }}" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('doctor.messages*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Messages
                    </a>
                </div>

                {{-- ACTIONS & DÉCONNEXION --}}
                <div class="flex items-center gap-4">
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-red-700 transition-all duration-300 shadow-md cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="hidden sm:inline">Déconnexion</span>
                            </button>
                        </form>
                    @endauth

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-700 hover:bg-slate-100 rounded-xl transition-all">
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

        {{-- MENU MOBILE --}}
        <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="lg:hidden bg-white border-t border-slate-100 px-4 py-4 space-y-2 shadow-xl">
            <a href="{{ route('doctor.dashboard') }}" class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('doctor.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Dashboard</a>
            <a href="{{ route('doctor.patients.index') }}" class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('doctor.patients*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Mes Patients</a>
            <a href="{{ route('doctor.rendezvous.index') }}" class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('doctor.rendezvous*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Agenda</a>
            <a href="{{ route('doctor.analyses.index') }}" class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('doctor.analyses*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Analyses</a>
            <a href="{{ route('doctor.availabilities.index') }}" class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('doctor.availabilities*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Mes Horaires</a>
            <a href="{{ route('doctor.messages.index') }}" class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('doctor.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">Messagerie</a>
        </div>
    </nav>

    {{-- CONTENU PRINCIPAL --}}
    <main class="flex-1 p-4 md:p-8 pt-24 transition-all duration-300">
        <div class="max-w-7xl mx-auto space-y-6 md:space-y-8 animate-fade-in-up">
            
            {{-- BREADCRUMB --}}
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-wider">
                <a href="{{ route('doctor.dashboard') }}" class="text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <span class="text-slate-300">/</span>
                <span class="text-blue-600">Patients</span>
            </nav>

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
                   
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Ma <span class="text-blue-600">Patientèle</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">Gestion complète des dossiers médicaux de vos patients</p>
                </div>
                
                <div class="glass-effect px-6 py-3.5 rounded-2xl shadow-sm text-sm font-medium text-slate-600 border border-white/50">
                    <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Total: {{ $patients->total() }} patients
                </div>
            </div>

            {{-- BARRE DE RECHERCHE & FILTRES --}}
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-1">
                        <svg class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" x-model="search" placeholder="Rechercher un patient..." 
                               class="w-full pl-11 pr-4 py-3.5 bg-white border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>
                    
                    <button @click="showFilters = !showFilters" 
                            class="px-5 py-3.5 bg-white border border-slate-200 rounded-xl font-bold text-xs flex items-center justify-center gap-2 hover:bg-slate-50 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span x-text="showFilters ? 'Masquer les filtres' : 'Afficher les filtres'"></span>
                    </button>
                </div>

                {{-- FILTRES --}}
                <div x-show="showFilters" x-collapse x-cloak class="bg-white rounded-xl border border-slate-200 p-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2 ml-1">Genre</label>
                            <select x-model="filterSexe" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <option value="">Tous les genres</option>
                                <option value="Masculin">Masculin</option>
                                <option value="Féminin">Féminin</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-wider mb-2 ml-1">Groupe Sanguin</label>
                            <select x-model="filterGroupe" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                                <option value="">Tous les groupes</option>
                                @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $gp)
                                    <option value="{{ $gp }}">{{ $gp }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end">
                            <button @click="search = ''; filterSexe = ''; filterGroupe = ''" class="text-[10px] font-black text-rose-600 uppercase tracking-wider hover:underline px-4 py-2.5">
                                Réinitialiser les filtres
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GRILLE DES PATIENTS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="patients-grid">
                @forelse($patients as $patient)
                    <div 
                        x-show="(search === '' || '{{ strtolower($patient->name) }}'.includes(search.toLowerCase())) && 
                                (filterSexe === '' || '{{ $patient->patient?->sexe ?? '' }}' === filterSexe) &&
                                (filterGroupe === '' || '{{ $patient->patient?->groupe_sanguin ?? '' }}' === filterGroupe)"
                        x-transition
                        class="patient-card bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl"
                    >
                        {{-- Header avec badge consultation --}}
                        <div class="relative p-5 pb-0">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-xl shadow-lg">
                                        {{ strtoupper(substr($patient->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-black text-slate-800 text-base">{{ $patient->name }}</h3>
                                        <p class="text-[10px] text-slate-400 font-semibold">
                                            {{ $patient->patient?->sexe ?? 'Sexe inconnu' }} • 
                                            {{ $patient->patient?->age ? $patient->patient->age . ' ans' : 'Âge inconnu' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-blue-50 text-blue-600 rounded-lg text-[9px] font-black">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $patient->rendezvous_count ?? 0 }} rdv
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Infos médicales --}}
                        <div class="p-5">
                            <div class="grid grid-cols-2 gap-3 mb-5">
                                <div class="bg-slate-50 rounded-xl p-3 text-center border border-slate-100">
                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-wider mb-1">Groupe sanguin</p>
                                    <p class="text-sm font-black {{ $patient->patient?->groupe_sanguin ? 'text-rose-600' : 'text-slate-400' }}">
                                        {{ $patient->patient?->groupe_sanguin ?? 'Inconnu' }}
                                    </p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3 text-center border border-slate-100">
                                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-wider mb-1">Téléphone</p>
                                    <p class="text-[11px] font-bold text-slate-700 truncate">
                                        {{ $patient->patient?->telephone ?? 'Non renseigné' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Allergies (si présentes) --}}
                            @if($patient->patient?->allergies)
                                <div class="mb-5 p-2.5 bg-amber-50 rounded-xl border border-amber-100">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-3 h-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                        </svg>
                                        <p class="text-[9px] font-bold text-amber-700">Allergies: {{ $patient->patient->allergies }}</p>
                                    </div>
                                </div>
                            @endif

                            <a href="{{ route('doctor.patients.show', $patient->id) }}" 
                               class="block w-full text-center bg-slate-800 text-white py-3.5 rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-blue-600 transition-all duration-300">
                                Voir le dossier médical
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-2xl border-2 border-dashed border-slate-200">
                        <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <p class="text-slate-400 font-black uppercase text-xs tracking-widest">Aucun patient trouvé</p>
                        <p class="text-slate-300 text-sm mt-1">Modifiez vos critères de recherche</p>
                    </div>
                @endforelse
            </div>

            {{-- Message "Aucun résultat" dynamique --}}
            <div x-show="document.querySelectorAll('#patients-grid > div[style*=\'display: none\']').length > 0 && 
                         document.querySelectorAll('#patients-grid > div[style*=\'display: none\']').length === document.querySelectorAll('#patients-grid > div').length && 
                         search !== ''" 
                 class="text-center py-10 text-slate-400 font-black uppercase text-xs tracking-widest border-t border-slate-100 pt-8">
                Aucun patient ne correspond à vos critères de recherche.
            </div>

            {{-- PAGINATION --}}
            @if($patients->hasPages())
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    {{ $patients->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
</x-app-layout>