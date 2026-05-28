<x-app-layout>
<div x-data="{ mobileMenuOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-100 to-white font-sans antialiased">

    <style>
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
        
        .analysis-card {
            transition: all 0.3s ease;
        }
        .analysis-card:hover {
            transform: translateY(-4px);
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
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
                <span class="text-blue-600">Analyses</span>
            </nav>

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
                
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Suivi des <span class="text-blue-600">Analyses</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">Gestion interne du laboratoire et validation des résultats</p>
                </div>
                
                <div class="glass-effect px-6 py-3.5 rounded-2xl shadow-sm text-sm font-medium text-slate-600 border border-white/50 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ now()->translatedFormat('l d F Y') }}
                </div>
            </div>


            {{-- LISTE DES ANALYSES --}}
            <div class="space-y-6">
                @forelse($analyses as $analyse)
                    <div class="analysis-card bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                        <div class="p-6 md:p-8">
                            <div class="flex flex-col lg:flex-row gap-8">
                                
                                {{-- BLOC PRESCRIPTION (Infos Patient) --}}
                                <div class="w-full lg:w-1/3">
                                    <div class="flex items-center gap-3 mb-4">
                                        <span class="px-3 py-1.5 bg-blue-100 text-blue-700 rounded-xl text-[10px] font-black">
                                            N° {{ $analyse->id }}
                                        </span>
                                        @if($analyse->statut == 'en_attente')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-100 text-amber-700 rounded-xl text-[10px] font-black">
                                                <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                                En attente
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-xl text-[10px] font-black">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Résultat disponible
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-md">
                                            {{ substr($analyse->user->name ?? 'P', 0, 2) }}
                                        </div>
                                        <div>
                                            <h3 class="font-black text-slate-800 text-lg">{{ $analyse->user->name ?? 'Patient inconnu' }}</h3>
                                            <p class="text-[10px] text-slate-400">ID: #{{ $analyse->user_id }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 space-y-2">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                            </svg>
                                            <p class="text-sm font-bold text-blue-600 uppercase">{{ $analyse->type_analyse }}</p>
                                        </div>
                                        <p class="text-slate-500 text-sm italic bg-slate-50 p-3 rounded-xl">
                                            "{{ $analyse->observations ?? 'Aucune observation particulière' }}"
                                        </p>
                                    </div>
                                    
                                    <div class="mt-6 pt-4 border-t border-slate-100">
                                        <p class="text-[9px] text-slate-400 uppercase font-black tracking-wider">Prescrit par</p>
                                        <p class="text-sm font-bold text-slate-700">Dr. {{ $analyse->doctor->name ?? Auth::user()->name }}</p>
                                        <p class="text-[10px] text-slate-400 mt-1">{{ $analyse->created_at->format('d/m/Y à H:i') }}</p>
                                    </div>
                                </div>

                                {{-- BLOC SAISIE / RÉSULTATS --}}
                                <div class="w-full lg:w-2/3">
                                    @if($analyse->statut == 'en_attente')
                                        <form action="{{ route('doctor.analyses.store_result', $analyse->id) }}" method="POST" class="space-y-5">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50/30 p-5 rounded-xl border border-blue-100">
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-blue-600 ml-1">Date & Heure Prélèvement</label>
                                                    <input type="datetime-local" name="date_prelevement" required value="{{ now()->format('Y-m-d\TH:i') }}" 
                                                        class="w-full mt-1 border border-slate-200 bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-blue-600 ml-1">Laboratoire / Service</label>
                                                    <input type="text" name="laboratoire_nom" required value="Laboratoire Interne Santé+" 
                                                        class="w-full mt-1 border border-slate-200 bg-white rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-wider">Valeur mesurée</label>
                                                    <input type="text" name="valeur" placeholder="Ex: 1.20" required 
                                                        class="w-full mt-1 border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-center font-black text-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-wider">Unité</label>
                                                    <input type="text" name="unite" placeholder="Ex: g/L" required 
                                                        class="w-full mt-1 border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-center font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                                </div>
                                                <div>
                                                    <label class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-wider">Normes (Min-Max)</label>
                                                    <input type="text" name="norme" placeholder="Ex: 0.70 - 1.10" required 
                                                        class="w-full mt-1 border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-center font-bold text-blue-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                                </div>
                                            </div>

                                            <div>
                                                <label class="text-[10px] font-black uppercase text-slate-500 ml-1 tracking-wider">Interprétation clinique</label>
                                                <textarea name="interpretation" rows="2" placeholder="Ex: Glycémie normale. Pas d'anomalie détectée..." 
                                                    class="w-full mt-1 border border-slate-200 bg-slate-50 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none"></textarea>
                                            </div>

                                            <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-blue-700 transition-all shadow-md shadow-blue-200">
                                                Valider & Générer le bilan
                                            </button>
                                        </form>
                                    @else
                                        <div class="space-y-5">
                                            <div class="grid grid-cols-3 gap-4">
                                                <div class="bg-gradient-to-br from-blue-600 to-blue-500 p-5 rounded-xl text-white">
                                                    <p class="text-[8px] font-black uppercase opacity-70 tracking-wider">Résultat</p>
                                                    <p class="text-2xl font-black">{{ $analyse->valeur }} <span class="text-xs font-medium">{{ $analyse->unite }}</span></p>
                                                </div>
                                                <div class="bg-slate-800 p-5 rounded-xl text-white">
                                                    <p class="text-[8px] font-black uppercase opacity-70 tracking-wider">Normes</p>
                                                    <p class="text-sm font-black">{{ $analyse->norme }}</p>
                                                </div>
                                                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100">
                                                    <p class="text-[8px] font-black uppercase text-slate-400 tracking-wider">Prélèvement</p>
                                                    <p class="text-xs font-bold text-slate-700">{{ \Carbon\Carbon::parse($analyse->date_prelevement)->format('d/m/Y H:i') }}</p>
                                                    <p class="text-[9px] text-slate-400 mt-1">{{ $analyse->laboratoire_nom }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="bg-slate-50 p-5 rounded-xl border border-slate-100 relative">
                                                <span class="absolute -top-2.5 left-4 bg-white px-3 py-0.5 text-[9px] font-black text-blue-600 border border-blue-100 rounded-full tracking-wider">
                                                    Conclusion Médicale
                                                </span>
                                                <p class="text-slate-600 text-sm leading-relaxed italic mt-2">
                                                    "{{ $analyse->interpretation ?? 'Aucune interprétation saisie.' }}"
                                                </p>
                                                <div class="mt-4 flex justify-between items-center pt-3 border-t border-slate-200">
                                                    <div>
                                                        <p class="text-[8px] font-black uppercase text-slate-400">Validé par</p>
                                                        <p class="text-xs font-bold text-slate-800">Dr. {{ $analyse->biologiste_nom }}</p>
                                                    </div>
                                                    <a href="{{ route('doctor.analyses.download', $analyse->id) }}" 
                                                       class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-slate-50 transition-all shadow-sm">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                        </svg>
                                                        Télécharger PDF
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
                    <div class="bg-white rounded-2xl p-16 text-center border-2 border-dashed border-slate-200">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-full mb-5">
                            <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-800 mb-2">Aucune analyse</h3>
                        <p class="text-slate-400 font-medium">Aucune analyse n'est en attente de traitement actuellement.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            @if($analyses->hasPages())
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    {{ $analyses->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
</x-app-layout>