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
        
        .specialty-card {
            transition: all 0.3s ease;
        }
        .specialty-card:hover {
            transform: translateY(-4px);
        }
        
        .admin-table-wrapper::-webkit-scrollbar {
            height: 6px;
        }
        .admin-table-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .admin-table-wrapper::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
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
            
            {{-- BREADCRUMB --}}
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-wider">
                <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <span class="text-slate-300">/</span>
                <span class="text-blue-600">Spécialités</span>
            </nav>

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-6 border-b border-slate-200">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Spécialités <span class="text-blue-600">Médicales</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-blue-600 rounded-full"></span>
                        Architecture des disciplines de la plateforme
                    </p>
                </div>
                


                <div x-data="{ 
    search: '{{ request('search') }}', 
    loading: false,
    timeout: null 
}">
    <form action="{{ route('admin.specialites.index') }}" method="GET" class="relative w-full md:w-80">
        <input type="text" name="search" x-model="search" 
               @input="loading = true; clearTimeout(timeout); timeout = setTimeout(() => { $el.closest('form').submit(); }, 500)"
               placeholder="Rechercher une discipline..." 
               class="w-full pl-12 pr-10 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none">
        <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <div x-show="loading" class="absolute right-4 top-1/2 -translate-y-1/2">
            <svg class="w-4 h-4 animate-spin text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
        </div>
    </form>
</div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                {{-- LISTE DES SPÉCIALITÉS --}}
                <div class="lg:col-span-8 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-[10px] font-black uppercase tracking-wider text-slate-400">Répertoire des compétences</h3>
                        <span class="px-3 py-1.5 bg-white text-blue-600 text-[10px] font-black uppercase rounded-lg border border-slate-100 shadow-sm">
                            Total: {{ $specialites->total() }}
                        </span>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden admin-table-wrapper">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-slate-50/80 border-b border-slate-100">
                                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-wider text-slate-500">Discipline</th>
                                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-wider text-slate-500">Description</th>
                                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-wider text-slate-500 text-right w-24">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($specialites as $spec)
                                    <tr class="hover:bg-blue-50/30 transition-all duration-200 group">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center text-blue-600 font-bold group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                                    {{ strtoupper(substr($spec->nom_specialite, 0, 2)) }}
                                                </div>
                                                <span class="font-bold text-slate-800">{{ $spec->nom_specialite }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-slate-500 text-sm max-w-md">
                                            {{ Str::limit($spec->description, 80) ?: '—' }}
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <form action="{{ route('admin.specialites.destroy', $spec) }}" method="POST" onsubmit="return confirm('Supprimer définitivement cette discipline ?')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2.5 rounded-xl text-rose-500 hover:bg-rose-50 transition-all duration-300 opacity-0 group-hover:opacity-100">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-16 text-center text-slate-400">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-12 h-12 mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                                    </svg>
                                                    <p class="font-medium">Aucune spécialité trouvée</p>
                                                    <p class="text-xs mt-1">Modifiez vos critères de recherche</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- PAGINATION --}}
                    @if($specialites->hasPages())
                        <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                            {{ $specialites->links() }}
                        </div>
                    @endif
                </div>

                {{-- FORMULAIRE D'AJOUT --}}
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden sticky top-28">
                        <div class="bg-blue-600 px-6 py-5">
                            <h3 class="text-white font-black text-sm uppercase tracking-wider">Nouvelle discipline</h3>
                            <p class="text-blue-100 text-[10px] mt-1">Ajouter une spécialité médicale</p>
                        </div>
                        
                        <form action="{{ route('admin.specialites.store') }}" method="POST" class="p-6 space-y-5">
                            @csrf
                            
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Appellation</label>
                                <input type="text" name="nom_specialite" 
                                       class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" 
                                       placeholder="ex: Cardiologie" required>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Description</label>
                                <textarea name="description" rows="4" 
                                          class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none resize-none" 
                                          placeholder="Description de la spécialité..."></textarea>
                            </div>
                            
                            <button type="submit" class="w-full py-3.5 bg-blue-600 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-blue-700 transition-all duration-300 shadow-md shadow-blue-200">
                                Ajouter la spécialité
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</x-app-layout>