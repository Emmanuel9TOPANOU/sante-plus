<x-app-layout>
<div x-data="{ mobileMenuOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-100 to-white font-sans antialiased">

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.5; }
            100% { transform: scale(1.2); opacity: 0; }
        }
        
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
        
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
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
                        @if(($messagesNonLus ?? 0) > 0)
                            <span class="ml-1 text-[10px] font-black bg-red-500 text-white px-1.5 py-0.5 rounded-full">{{ $messagesNonLus }}</span>
                        @endif
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
            
            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-6 border-b border-slate-200">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-4">
                     
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Bonjour, <span class="text-blue-600">Dr. {{ Auth::user()->name }}</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">Voici l'activité de votre cabinet aujourd'hui</p>
                </div>
                
                <div class="glass-effect px-6 py-3.5 rounded-2xl shadow-sm text-sm font-medium text-slate-600 border border-white/50">
                    <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y') }}
                </div>
            </div>

           {{-- STATS CARDS PREMIUM --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    
    {{-- Carte RDV --}}
    <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-all"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-500 to-blue-600"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-2.5 py-1.5 rounded-full border border-blue-100">Aujourd'hui</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $rendezvous->count() }}</h3>
            <p class="text-slate-500 text-[11px] font-semibold uppercase tracking-wider mt-1">Rendez-vous</p>
        </div>
    </div>

    {{-- Carte Patients --}}
    <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:bg-indigo-500/20 transition-all"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-indigo-600"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2.5 py-1.5 rounded-full border border-indigo-100">Suivi</span>
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $totalPatients ?? 0 }}</h3>
            <p class="text-slate-500 text-[11px] font-semibold uppercase tracking-wider mt-1">Patients actifs</p>
        </div>
    </div>

    {{-- Carte Messages --}}
    <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-24 h-24 bg-rose-500/10 rounded-full blur-2xl group-hover:bg-rose-500/20 transition-all"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-rose-500 to-rose-600"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl flex items-center justify-center shadow-lg shadow-rose-200 group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                @if(($messagesNonLus ?? 0) > 0)
                    <span class="text-[10px] font-black text-rose-600 bg-rose-50 px-2.5 py-1.5 rounded-full border border-rose-100 animate-pulse">{{ $messagesNonLus }} non lus</span>
                @else
                    <span class="text-[10px] font-black text-rose-600 bg-rose-50 px-2.5 py-1.5 rounded-full border border-rose-100">Tous lus</span>
                @endif
            </div>
            <h3 class="text-3xl font-black text-slate-800">{{ $messagesNonLus ?? 0 }}</h3>
            <p class="text-slate-500 text-[11px] font-semibold uppercase tracking-wider mt-1">Messages non lus</p>
        </div>
    </div>

    {{-- Carte Spécialité --}}
    <div class="group relative overflow-hidden bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-all"></div>
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-400 to-blue-500"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center backdrop-blur-sm group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <span class="text-[10px] font-black text-blue-300 bg-blue-500/20 px-2.5 py-1.5 rounded-full border border-blue-400/30">Certifié</span>
            </div>
            <h3 class="text-xl font-black text-white truncate">{{ Auth::user()->specialite->nom_specialite ?? 'Généraliste' }}</h3>
            <p class="text-blue-300 text-[11px] font-semibold uppercase tracking-wider mt-1">Ma spécialité</p>
        </div>
    </div>
</div>

            {{-- ACTIONS RAPIDES --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a href="{{ route('doctor.patients.index') }}" class="group flex flex-col items-center justify-center p-5 bg-white border border-slate-200 rounded-2xl font-semibold hover:bg-indigo-600 hover:text-white hover:border-transparent hover:shadow-xl transition-all duration-300 no-underline text-center">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center mb-2.5 group-hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5 text-indigo-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <span class="text-[11px] uppercase tracking-wider text-slate-600 group-hover:text-white">Patients</span>
                </a>

                <a href="{{ route('doctor.availabilities.index') }}" class="group flex flex-col items-center justify-center p-5 bg-white border border-slate-200 rounded-2xl font-semibold hover:bg-blue-600 hover:text-white hover:border-transparent hover:shadow-xl transition-all duration-300 no-underline text-center">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-2.5 group-hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-[11px] uppercase tracking-wider text-slate-600 group-hover:text-white">Horaires</span>
                </a>

                <a href="{{ route('doctor.rendezvous.index') }}" class="group flex flex-col items-center justify-center p-5 bg-white border border-slate-200 rounded-2xl font-semibold hover:bg-slate-800 hover:text-white hover:border-transparent hover:shadow-xl transition-all duration-300 no-underline text-center">
                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center mb-2.5 group-hover:bg-white/20 transition-all">
                        <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-[11px] uppercase tracking-wider text-slate-600 group-hover:text-white">Agenda</span>
                </a>
            </div>

            {{-- TABLEAU DES CONSULTATIONS --}}
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden">
                <div class="flex justify-between items-center px-6 py-5 border-b border-slate-100">
                    <div>
                        <h2 class="font-bold text-slate-800">Consultations du jour</h2>
                        <p class="text-slate-400 text-xs mt-0.5">Rendez-vous planifiés pour aujourd'hui</p>
                    </div>
                    <span class="px-3 py-1.5 bg-blue-100 text-blue-600 rounded-lg text-[10px] font-black">{{ $rendezvous->count() }} RDV</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-wider text-slate-500">Heure</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-wider text-slate-500">Patient</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-wider text-slate-500">Motif</th>
                                <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-wider text-slate-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($rendezvous as $rdv)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-blue-600">{{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center text-slate-600 font-bold text-xs">
                                            {{ $rdv->patient ? substr($rdv->patient->name, 0, 1) : 'P' }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">{{ $rdv->patient->name ?? 'Patient' }}</p>
                                            <p class="text-[9px] text-slate-400">ID: #{{ $rdv->patient_id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-slate-500 text-sm italic">{{ Str::limit($rdv->motif ?? 'Consultation générale', 40) }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($rdv->statut === 'termine')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg text-[10px] font-black uppercase">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Terminé
                                        </span>
                                    @else
                                        <a href="{{ route('doctor.consultations.create', ['rendezvous' => $rdv->id]) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg text-[10px] font-black uppercase tracking-wider hover:bg-blue-700 transition-all">
                                            Démarrer
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="font-medium">Aucun rendez-vous aujourd'hui</p>
                                        <p class="text-xs mt-1">Profitez de cette accalmie !</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

   
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dashboard', () => ({
            showNoteModal: false
        }))
    })
</script>
</x-app-layout>