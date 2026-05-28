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
        
        .availability-card {
            transition: all 0.3s ease;
        }
        .availability-card:hover {
            transform: translateY(-4px);
        }
        
        .day-checkbox:checked + div {
            background-color: #2563eb;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2), 0 4px 6px -2px rgba(37, 99, 235, 0.1);
        }
        
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
                <span class="text-blue-600">Disponibilités</span>
            </nav>

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
                 
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Gestion des <span class="text-blue-600">Disponibilités</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">Configurez vos jours et heures de consultation</p>
                </div>
                
                <div class="glass-effect px-6 py-3.5 rounded-2xl shadow-sm text-sm font-medium text-slate-600 border border-white/50 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ now()->translatedFormat('l d F Y') }}
                </div>
            </div>

        
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {{-- FORMULAIRE DE GÉNÉRATION --}}
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden sticky top-28">
                        <div class="bg-blue-600 px-6 py-5">
                            <h2 class="text-white font-black text-sm uppercase tracking-wider">Générateur de créneaux</h2>
                            <p class="text-blue-100 text-[10px] mt-1">Créez vos disponibilités en masse</p>
                        </div>
                        
                        <form action="{{ route('doctor.availabilities.store') }}" method="POST" id="generateForm" class="p-6 space-y-5">
                            @csrf
                            
                            {{-- Choix des jours pour spécialistes --}}
                            @if(Auth::user()->isSpecialist())
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Jours de présence</label>
                                    <div class="grid grid-cols-4 sm:grid-cols-7 gap-2">
                                        @php
                                            $jours = [1 => 'Lun', 2 => 'Mar', 3 => 'Mer', 4 => 'Jeu', 5 => 'Ven', 6 => 'Sam', 0 => 'Dim'];
                                        @endphp
                                        @foreach($jours as $val => $nom)
                                            <label class="cursor-pointer">
                                                <input type="checkbox" name="days[]" value="{{ $val }}" class="hidden day-checkbox" {{ in_array($val, [1,2,3,4,5]) ? 'checked' : '' }}>
                                                <div class="py-2.5 text-center rounded-xl bg-slate-50 text-[10px] font-black uppercase transition-all border border-slate-200 hover:border-blue-300 cursor-pointer">
                                                    {{ $nom }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    <p class="text-[9px] text-slate-400 italic ml-1">Le système créera vos créneaux pour ces jours sur toute la période choisie</p>
                                </div>
                            @else
                                <input type="hidden" name="days[]" value="1">
                                <input type="hidden" name="days[]" value="2">
                                <input type="hidden" name="days[]" value="3">
                                <input type="hidden" name="days[]" value="4">
                                <input type="hidden" name="days[]" value="5">
                                <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-[10px] font-bold text-blue-700">Planning du lundi au vendredi uniquement</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Période --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Du</label>
                                    <input type="date" name="start_date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Au</label>
                                    <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime('+1 month')) }}" min="{{ date('Y-m-d') }}" required 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                </div>
                            </div>

                            {{-- Heures & Durée --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Début</label>
                                    <input type="time" name="start_time" value="08:00" required 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Fin</label>
                                    <input type="time" name="end_time" value="17:00" required 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Durée par patient</label>
                                <select name="duration" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all cursor-pointer">
                                    <option value="15">15 minutes</option>
                                    <option value="30" selected>30 minutes</option>
                                    <option value="45">45 minutes</option>
                                    <option value="60">60 minutes</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full py-3.5 bg-blue-600 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-blue-700 transition-all duration-300 shadow-md shadow-blue-200">
                                Générer le planning
                            </button>
                        </form>
                    </div>
                </div>

                {{-- LISTE DES CRÉNEAUX --}}
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                        <div class="flex justify-between items-center px-6 py-5 border-b border-slate-100">
                            <div>
                                <h2 class="font-bold text-slate-800">Planning actuel</h2>
                                <p class="text-slate-400 text-[10px] mt-0.5">Vos disponibilités visibles par les patients</p>
                            </div>
                            <span class="px-3 py-1.5 bg-blue-100 text-blue-600 rounded-lg text-[10px] font-black">
                                {{ $availabilities->total() }} créneaux
                            </span>
                        </div>

                        <div class="p-6">
                            @if($availabilities->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($availabilities as $item)
                                        <div class="availability-card flex items-center justify-between p-4 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:shadow-md transition-all">
                                            <div class="flex items-center gap-4">
                                                <div class="flex flex-col items-center justify-center w-12 h-12 rounded-xl bg-blue-100">
                                                    <span class="text-sm font-black text-blue-600">{{ $item->date->format('d') }}</span>
                                                    <span class="text-[8px] font-bold uppercase text-blue-400 leading-none">{{ $item->date->translatedFormat('M') }}</span>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-black text-slate-400 uppercase">{{ $item->date->translatedFormat('l') }}</p>
                                                    <p class="text-sm font-black text-slate-800">
                                                        {{ \Carbon\Carbon::parse($item->start_time)->format('H:i') }} → {{ \Carbon\Carbon::parse($item->end_time)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex items-center gap-2">
                                                @if($item->is_booked)
                                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-lg text-[9px] font-black">Réservé</span>
                                                @else
                                                    <form action="{{ route('doctor.availabilities.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Supprimer ce créneau ?')" class="inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="py-16 text-center">
                                    <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-slate-400 font-medium">Aucun créneau généré</p>
                                    <p class="text-slate-300 text-xs mt-1">Utilisez le formulaire pour créer vos disponibilités</p>
                                </div>
                            @endif
                        </div>

                        {{-- PAGINATION --}}
                        @if($availabilities->hasPages())
                            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                                {{ $availabilities->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Animation des checkboxes jours
    document.querySelectorAll('.day-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.nextElementSibling.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'border-blue-600');
                this.nextElementSibling.classList.remove('bg-slate-50', 'text-slate-700', 'border-slate-200');
            } else {
                this.nextElementSibling.classList.remove('bg-blue-600', 'text-white', 'shadow-md', 'border-blue-600');
                this.nextElementSibling.classList.add('bg-slate-50', 'text-slate-700', 'border-slate-200');
            }
        });
        // Déclencher l'état initial
        if (checkbox.checked) {
            checkbox.nextElementSibling.classList.add('bg-blue-600', 'text-white', 'shadow-md', 'border-blue-600');
            checkbox.nextElementSibling.classList.remove('bg-slate-50', 'text-slate-700', 'border-slate-200');
        }
    });

    // Validation formulaire
    document.getElementById('generateForm').addEventListener('submit', function(e) {
        const daysContainer = document.querySelector('.grid-cols-4');
        if (daysContainer) {
            const checkboxes = document.querySelectorAll('input[name="days[]"]:checked');
            if (checkboxes.length === 0) {
                e.preventDefault();
                alert('Veuillez sélectionner au moins un jour de la semaine.');
            }
        }
    });
</script>
</x-app-layout>