<x-app-layout>
    <div x-data="{ mobileMenu: false }" class="flex min-h-screen bg-[#F8FAFC] font-sans antialiased text-slate-900">

        <style>
            /* Masquer la barre de défilement */
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            
            /* Animation d'entrée douce */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        </style>

        {{-- HEADER MOBILE --}}
        <header class="lg:hidden fixed top-0 left-0 right-0 h-16 bg-white/80 backdrop-blur-md border-b border-slate-100 z-50 px-6 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-200">
                    <span class="text-white font-black text-sm">A</span>
                </div>
                <span class="font-bold text-lg tracking-tight">Admin<span class="text-blue-600">Panel</span></span>
            </div>
            <button @click="mobileMenu = true" class="p-2 hover:bg-slate-100 rounded-xl transition">
                <i class="fa-solid fa-bars-staggered text-xl text-slate-600"></i>
            </button>
        </header>

        {{-- SIDEBAR COMPLÈTE --}}
        <aside 
            :class="mobileMenu ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
            class="w-72 bg-white fixed h-screen z-[60] border-r border-slate-100 shadow-2xl lg:shadow-none transition-transform duration-500 ease-in-out flex flex-col">
            
            {{-- Header Sidebar --}}
            <div class="p-8 flex-shrink-0 flex items-center justify-between">
                <div class="flex items-center gap-3 group cursor-pointer">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center shadow-xl shadow-blue-100 transition-transform group-hover:scale-110">
                        <span class="text-white font-black text-xl">A</span>
                    </div>
                    <span class="font-black text-xl text-slate-800 tracking-tight">
                        Admin<span class="text-blue-600">Panel</span>
                    </span>
                </div>
                <button @click="mobileMenu = false" class="lg:hidden p-2 text-slate-400 hover:text-red-500 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 space-y-8 overflow-y-auto no-scrollbar pb-10">
                
                {{-- SECTION : GÉNÉRAL --}}
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4 mb-4">Général</p>
                    
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300
                       {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <div class="w-6 flex justify-center"><i class="fa-solid fa-chart-pie text-lg"></i></div>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all duration-300
                       {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <div class="w-6 flex justify-center"><i class="fa-solid fa-users text-lg"></i></div>
                        Utilisateurs
                    </a>
                </div>

                {{-- SECTION : RESSOURCES MÉDICALES --}}
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4 mb-4">Ressources</p>
                    
                    <a href="{{ route('admin.medecins.index') }}" 
                       class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all
                       {{ request()->routeIs('admin.medecins.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-transform group-hover:scale-110 {{ request()->routeIs('admin.medecins.*') ? 'bg-white/20' : 'bg-emerald-50 text-emerald-600' }}">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        Médecins
                    </a>

                    <a href="{{ route('admin.specialites.index') }}" 
                       class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all
                       {{ request()->routeIs('admin.specialites.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-transform group-hover:scale-110 {{ request()->routeIs('admin.specialites.*') ? 'bg-white/20' : 'bg-purple-50 text-purple-600' }}">
                            <i class="fa-solid fa-stethoscope"></i>
                        </div>
                        Spécialités
                    </a>
                </div>

                {{-- SECTION : MAINTENANCE --}}
                <div class="space-y-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-4 mb-4">Maintenance</p>
                    
                    <a href="{{ route('admin.settings.index') }}" 
                       class="group flex items-center gap-3 px-4 py-3.5 rounded-2xl font-bold text-sm transition-all
                       {{ request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-transform group-hover:scale-110 {{ request()->routeIs('admin.settings.*') ? 'bg-white/20' : 'bg-slate-100 text-slate-600' }}">
                            <i class="fa-solid fa-gear"></i>
                        </div>
                        Paramètres
                    </a>
                </div>
            </nav>

            {{-- Footer Sidebar (Déconnexion fixe) --}}
            <div class="p-6 flex-shrink-0 bg-white border-t border-slate-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="group w-full flex items-center justify-center gap-3 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest text-red-500 bg-red-50 hover:bg-red-500 hover:text-white transition-all duration-500 hover:shadow-lg hover:shadow-red-200">
                        <i class="fa-solid fa-power-off transition-transform group-hover:rotate-90"></i>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        {{-- OVERLAY MOBILE --}}
        <div x-show="mobileMenu" @click="mobileMenu = false" x-transition.opacity class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 lg:hidden"></div>

        {{-- CONTENU PRINCIPAL --}}
        <main class="flex-1 lg:ml-72 p-6 md:p-12 pt-24 lg:pt-12 transition-all duration-500">
            <div class="max-w-7xl mx-auto space-y-10 animate-fade-in-up">

                {{-- HEADER PAGE --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Tableau de bord</h1>
                        <p class="text-slate-500 mt-1 font-medium">Bienvenue sur l'interface de gestion HospiConnect.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 bg-white border border-slate-100 rounded-2xl text-xs font-bold shadow-sm text-slate-600">
                            <i class="fa-regular fa-calendar-days mr-2"></i>{{ now()->translatedFormat('d F Y') }}
                        </span>
                    </div>
                </div>

                {{-- STATS GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @php
                        $cards = [
                            ['label' => 'Utilisateurs', 'val' => $stats['total_users'], 'color' => 'blue', 'icon' => 'fa-users'],
                            ['label' => 'Médecins', 'val' => $stats['total_medecins'], 'color' => 'emerald', 'icon' => 'fa-user-md'],
                            ['label' => 'Patients', 'val' => $stats['total_patients'], 'color' => 'indigo', 'icon' => 'fa-hospital-user']
                        ];
                    @endphp

                    @foreach($cards as $card)
                    <div class="group bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-500">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs uppercase text-slate-400 font-black tracking-widest">{{ $card['label'] }}</p>
                                <h3 class="text-4xl font-black mt-3 group-hover:scale-105 transition-transform origin-left">{{ $card['val'] }}</h3>
                            </div>
                            <div class="w-12 h-12 bg-{{ $card['color'] }}-50 text-{{ $card['color'] }}-600 rounded-2xl flex items-center justify-center text-xl group-hover:rotate-12 transition-transform">
                                <i class="fa-solid {{ $card['icon'] }}"></i>
                            </div>
                        </div>
                        @if($card['label'] == 'Utilisateurs')
                            <p class="text-xs text-emerald-500 font-bold mt-4 flex items-center gap-1">
                                <i class="fa-solid fa-arrow-trend-up"></i> +{{ $stats['new_users_month'] }} ce mois-ci
                            </p>
                        @endif
                    </div>
                    @endforeach
                </div>

                {{-- SECTION TABLEAU RÉCENT --}}
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-500">
                    <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/30">
                        <h2 class="font-black text-sm uppercase tracking-widest text-slate-800">Inscriptions récentes</h2>
                        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition">Voir tout</a>
                    </div>
                    <div class="overflow-x-auto no-scrollbar">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] uppercase text-slate-400 tracking-widest bg-slate-50/20">
                                    <th class="px-8 py-5 font-black">Membre</th>
                                    <th class="px-8 py-5 font-black">Rôle</th>
                                    <th class="px-8 py-5 font-black text-right">Date d'inscription</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($recentUsers as $user)
                                <tr class="group hover:bg-blue-50/30 transition-colors">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-black shadow-sm group-hover:scale-110 transition">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-sm text-slate-800">{{ $user->name }}</p>
                                                <p class="text-xs text-slate-400 font-medium">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-tighter group-hover:bg-white transition-colors">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-right text-xs text-slate-400 font-bold">
                                        {{ $user->created_at->translatedFormat('d M H:i') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>