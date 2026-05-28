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
        
        .doctor-card {
            transition: all 0.3s ease;
        }
        .doctor-card:hover {
            transform: translateY(-8px);
        }
        
        @keyframes ping {
            0% { transform: scale(1); opacity: 1; }
            75%, 100% { transform: scale(1.5); opacity: 0; }
        }
        .animate-ping-slow {
            animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
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


   <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg border-b border-slate-100 z-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex justify-between items-center h-20">
            
            {{-- LOGO --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo MonEspaceSanté" class="w-full h-full object-contain">
                </div>
            </div>

            {{-- LIENS NAVIGATION DESKTOP --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('admin.users.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Utilisateurs
                    @if($stats['new_users_month'] > 0)
                        <span class="text-[10px] font-black bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full ml-1">+{{ $stats['new_users_month'] }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.medecins.index') }}" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('admin.medecins.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Médecins
                </a>

                <a href="{{ route('admin.specialites.index') }}" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('admin.specialites.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    Spécialités
                </a>

                {{-- NOUVEAU LIEN SERVICES --}}
                <a href="{{ route('admin.services.index') }}" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('admin.services.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Services
                </a>

               

                <a href="{{ route('admin.settings.index') }}" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 {{ request()->routeIs('admin.settings.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Paramètres
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

                {{-- BOUTON HAMBURGER MOBILE --}}
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

    {{-- MENU MOBILE (Dropdown) --}}
    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="lg:hidden bg-white border-t border-slate-100 px-4 py-4 space-y-2 shadow-xl">
        <a href="{{ route('admin.dashboard') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
            Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
            Utilisateurs
        </a>
        <a href="{{ route('admin.medecins.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.medecins.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
            Médecins
        </a>
        <a href="{{ route('admin.specialites.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.specialites.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
            Spécialités
        </a>
        {{-- NOUVEAU LIEN SERVICES MOBILE --}}
        <a href="{{ route('admin.services.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
            Services
        </a>
       
        <a href="{{ route('admin.settings.index') }}" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600' }}">
            Paramètres
        </a>
    </div>
</nav>

    {{-- CONTENU PRINCIPAL --}}
    <main class="flex-1 p-4 md:p-8 pt-24 transition-all duration-300">
        <div class="max-w-7xl mx-auto space-y-6 md:space-y-8 animate-fade-in-up">
            
            {{-- HEADER --}}
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 border-b border-slate-200 pb-8">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="h-px w-10 bg-blue-600 rounded-full"></span>
                        <span class="text-blue-600 font-black text-xs uppercase tracking-[0.3em]">Gestion Médicale</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Corps <span class="text-blue-600">Médical</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">
                        Gestion et supervision des  praticiens de la plateforme
                    </p>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="glass-effect px-6 py-4 rounded-2xl shadow-sm text-center">
                        <p class="text-[9px] font-black uppercase text-slate-400 tracking-wider">Total Actifs</p>
                        <p class="text-2xl font-black text-blue-600">{{ $medecins->total() }}</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-4 bg-white border border-slate-200 rounded-xl text-xs font-black uppercase tracking-wider text-slate-600 hover:text-blue-600 hover:border-blue-200 hover:shadow-md transition-all duration-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Dashboard
                    </a>
                </div>
            </div>

            {{-- FILTRES DE RECHERCHE --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                <form action="{{ route('admin.medecins.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                    
                    <div class="md:col-span-5 space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Recherche</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom ou email..." 
                               class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder:text-slate-400 outline-none">
                    </div>

                    <div class="md:col-span-4 space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Spécialité</label>
                        <select name="specialite" class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all cursor-pointer outline-none">
                            <option value="">Toutes les spécialités</option>
                            @foreach($specialites as $spec)
                                <option value="{{ $spec->id }}" {{ request('specialite') == $spec->id ? 'selected' : '' }}>
                                    {{ $spec->nom_specialite }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-3 flex gap-3">
                        <button type="submit" class="flex-1 py-3.5 bg-blue-600 text-white rounded-xl font-black text-[10px] uppercase tracking-wider hover:bg-blue-700 shadow-md shadow-blue-200 transition-all">
                            Filtrer
                        </button>
                        @if(request()->anyFilled(['search', 'specialite']))
                            <a href="{{ route('admin.medecins.index') }}" class="px-5 py-3.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all flex items-center justify-center font-black text-[10px] uppercase tracking-wider">
                                actualiser
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- GRILLE DES MÉDECINS --}}
            @if($medecins->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($medecins as $medecin)
                    <div class="doctor-card bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                        
                        {{-- Header avec statut --}}
                        <div class="relative p-5 pb-0">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center gap-3">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center text-blue-600 font-black text-xl shadow-sm">
                                        {{ strtoupper(substr($medecin->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-black text-slate-800 text-base">{{ $medecin->name }}</h3>
                                        <p class="text-[11px] text-slate-400 font-medium">{{ $medecin->email }}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-500 text-[9px] font-black uppercase rounded-lg">
                                        ID: {{ $medecin->medecin?->matricule ?? 'N/A' }}
                                    </span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-600 text-[9px] font-black uppercase rounded-lg">
                                        {{ $medecin->specialite?->nom_specialite ?? 'Généraliste' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Corps --}}
                        <div class="p-5 pt-3">
                            <div class="flex items-center justify-between mb-4 pt-2 border-t border-slate-100">
                                <div class="flex items-center gap-2">
                                    <div class="relative">
                                        <div class="w-2.5 h-2.5 rounded-full {{ $medecin->medecin?->est_valide ? 'bg-emerald-500' : 'bg-amber-500' }}"></div>
                                        @if(!$medecin->medecin?->est_valide)
                                            <div class="absolute inset-0 w-2.5 h-2.5 rounded-full bg-amber-500 animate-ping-slow"></div>
                                        @endif
                                    </div>
                                    <span class="text-[10px] font-black uppercase {{ $medecin->medecin?->est_valide ? 'text-emerald-600' : 'text-amber-600' }}">
                                        {{ $medecin->medecin?->est_valide ? 'Compte validé' : 'En attente de validation' }}
                                    </span>
                                </div>
                                <span class="text-[10px] text-slate-400">Inscrit le {{ $medecin->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                        </div>

                     {{-- Actions --}}
<div class="p-4 bg-slate-50/50 border-t border-slate-100 space-y-2">
    @if($medecin->medecin)
        {{-- Bouton Valider/Suspendre --}}
        <form action="{{ route('admin.medecins.validate', ['id' => $medecin->medecin->id]) }}" method="POST">
            @csrf @method('PATCH')
            <button type="submit" 
                    class="w-full py-3 rounded-xl font-black text-[10px] uppercase tracking-wider transition-all duration-300 flex items-center justify-center gap-2
                    {{ $medecin->medecin->est_valide 
                        ? 'bg-amber-100 text-amber-600 hover:bg-amber-600 hover:text-white border border-amber-200' 
                        : 'bg-emerald-100 text-emerald-600 hover:bg-emerald-600 hover:text-white border border-emerald-200' }}">
                @if($medecin->medecin->est_valide)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                    </svg>
                    Suspendre le compte
                @else
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Valider le compte
                @endif
            </button>
        </form>

        {{-- Bouton Supprimer --}}
        <form action="{{ route('admin.medecins.destroy', $medecin->id) }}" method="POST" onsubmit="return confirm('⚠️ Attention : Cette action est irréversible. Confirmer la suppression ?')">
            @csrf @method('DELETE')
            <button type="submit" class="w-full py-2.5 bg-white border border-rose-200 text-rose-500 rounded-xl font-black text-[9px] uppercase tracking-wider hover:bg-rose-50 transition-all duration-300 flex items-center justify-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Supprimer le compte
            </button>
        </form>
    @endif
</div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="py-20 text-center bg-white rounded-2xl border-2 border-dashed border-slate-200">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <p class="text-slate-400 font-black uppercase tracking-wider text-sm">Aucun médecin trouvé</p>
                    <p class="text-slate-300 text-xs mt-1">Modifiez vos critères de recherche</p>
                </div>
            @endif
            
            {{-- PAGINATION --}}
            @if($medecins->hasPages())
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    {{ $medecins->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
</x-app-layout>