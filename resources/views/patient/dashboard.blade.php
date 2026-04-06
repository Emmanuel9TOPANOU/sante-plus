<x-app-layout>
    <div class="flex min-h-screen bg-[#F8FAFC]">

        {{-- BOUTON HAMBURGER (Mobile uniquement) --}}
        <button id="sidebarToggle" class="fixed top-4 left-4 z-[60] md:hidden p-2 bg-white rounded-xl shadow-lg border border-gray-100 text-blue-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

     {{-- SIDEBAR --}}
<aside class="w-72 bg-white fixed h-screen z-50 border-r border-gray-100 shadow-sm transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
    <div class="flex flex-col h-full py-8">
        
        {{-- Navigation --}}
        <nav class="flex-1 px-3 overflow-y-auto space-y-8 scrollbar-none min-h-0">
            {{-- Menu Principal --}}
            <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-4 ml-4">
                    Menu Principal
                </p>
                <div class="flex flex-col space-y-8"> {{-- Augmentation de l'espace ici --}}
                    <x-nav-link :href="route('patient.dashboard')" :active="request()->routeIs('patient.dashboard')" 
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline border-none {{ request()->routeIs('patient.dashboard') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-bold text-sm">Vue d'ensemble</span>
                    </x-nav-link>

                    <x-nav-link :href="route('patient.rendezvous.index')" :active="request()->routeIs('patient.rendezvous.*')"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline border-none {{ request()->routeIs('patient.rendezvous.*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-bold text-sm">Mes Rendez-vous</span>
                    </x-nav-link>

                    <x-nav-link :href="route('patient.lab_results.index')" :active="request()->routeIs('patient.lab_results.*')"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline border-none {{ request()->routeIs('patient.lab_results.*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        <span class="font-bold text-sm">Résultats d'analyses</span>
                    </x-nav-link>

                    {{-- NOUVEAU : Messagerie --}}
        <x-nav-link :href="route('patient.messages.index')" :active="request()->routeIs('patient.messages.*')"
            class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline border-none {{ request()->routeIs('patient.messages.*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <span class="font-bold text-sm">Messagerie</span>
        </x-nav-link>

                    
                </div>
            </div>

            {{-- Ma Santé --}}
            <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-4 ml-4">
                    Ma Santé
                </p>
                <div class="flex flex-col space-y-8"> {{-- Augmentation de l'espace ici --}}
                    <x-nav-link :href="route('patient.medical_record.index')" :active="request()->routeIs('patient.medical_record.*')"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline border-none {{ request()->routeIs('patient.medical_record.*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-bold text-sm">Dossier Médical</span>
                    </x-nav-link>

                    <x-nav-link :href="route('patient.prescriptions.index')" :active="request()->routeIs('patient.prescriptions.*')"
                        class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline border-none {{ request()->routeIs('patient.prescriptions.*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span class="font-bold text-sm">Ordonnances</span>
                    </x-nav-link>
                </div>
            </div>
        </nav>

        {{-- Pied de Sidebar --}}
    <div class="p-4 mt-auto border-t border-gray-100 bg-white sticky bottom-0 z-10">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-red-600 hover:bg-red-50 transition-colors duration-200 font-semibold text-sm border-none cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        @endauth
    </div>
    </div>
</aside>



        {{-- MAIN CONTENT --}}
        <main class="flex-1 w-full md:ml-72 p-4 md:p-10 bg-[#F8FAFC] min-h-screen transition-all">
            
            {{-- HEADER --}}
            <div class="flex justify-between items-center mb-10 mt-12 md:mt-0">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-gray-800">
                        Bonjour, <span class="text-blue-600">{{ explode(' ', Auth::user()->name)[0] }}</span>
                    </h1>
                    <p class="text-gray-500 mt-1 text-sm md:text-base">Bienvenue dans votre espace santé</p>
                </div>
            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <p class="text-[10px] uppercase text-gray-400 font-black tracking-widest">Rendez-vous</p>
                    <h3 class="text-3xl font-black text-blue-600 mt-2">{{ $prochainsRendezVous->count() }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <p class="text-[10px] uppercase text-gray-400 font-black tracking-widest">Ordonnances</p>
                    <h3 class="text-3xl font-black text-indigo-600 mt-2">{{ $dernieresOrdonnances->count() }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <p class="text-[10px] uppercase text-gray-400 font-black tracking-widest">Analyses</p>
                    <h3 class="text-3xl font-black text-emerald-600 mt-2">{{ $analyses ?? 0 }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300">
                    <p class="text-[10px] uppercase text-gray-400 font-black tracking-widest">ID Patient</p>
                    <h3 class="text-lg font-black mt-2 text-gray-800">#HS-{{ str_pad($patient->id ?? 0, 4, '0', STR_PAD_LEFT) }}</h3>
                </div>
            </div>

            {{-- ACTIONS RAPIDES --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                <a href="{{ route('patient.rendezvous.create') }}" class="flex flex-col items-center justify-center p-6 bg-blue-600 text-white rounded-3xl text-center font-bold hover:bg-blue-700 hover:scale-[1.02] transition-all duration-300 shadow-lg shadow-blue-200 no-underline">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-xs md:text-sm">Prendre RDV</span>
                </a>
                <a href="{{ route('patient.prescriptions.index') }}" class="flex flex-col items-center justify-center p-6 bg-indigo-600 text-white rounded-3xl text-center font-bold hover:bg-indigo-700 hover:scale-[1.02] transition-all duration-300 shadow-lg shadow-indigo-200 no-underline">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-xs md:text-sm">Mes ordonnances</span>
                </a>
              <a href="{{ route('patient.lab_results.index') }}" class="flex flex-col items-center justify-center p-6 bg-emerald-600 text-white rounded-3xl text-center font-bold hover:bg-emerald-700 hover:scale-[1.02] transition-all duration-300 shadow-lg shadow-emerald-200 no-underline">
    {{-- Icône Fiche de résultats / Cahier --}}
    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
    </svg>
    <span class="text-xs md:text-sm">Résultats labo</span>
</a>
                <a href="{{ route('patient.history.index') }}" class="flex flex-col items-center justify-center p-6 bg-slate-900 text-white rounded-3xl text-center font-bold hover:bg-black hover:scale-[1.02] transition-all duration-300 shadow-lg shadow-slate-200 no-underline">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="text-xs md:text-sm">Mon Historique</span>
                </a>
            </div>

            {{-- GRID RDV & PROFIL --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-6">
                {{-- PROCHAINS RDV --}}
                <div class="lg:col-span-8 col-span-1">
                    <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100">
                        <h2 class="text-[10px] font-black uppercase text-gray-400 mb-6 tracking-[0.2em]">Prochains rendez-vous</h2>
                        <div class="space-y-4">
                            @forelse($prochainsRendezVous as $rdv)
                                <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 border border-transparent hover:border-blue-100 transition-all">
                                    <div>
                                        <p class="font-black text-gray-800">Dr. {{ $rdv->medecin->name ?? 'Médecin' }}</p>
                                        <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">
                                            {{ \Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d F Y') }} • {{ $rdv->heure_rdv }}
                                        </p>
                                    </div>
                                    <span class="px-3 py-1 bg-white rounded-full text-[10px] font-black text-blue-600 shadow-sm border border-blue-50">CONFIRMÉ</span>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <p class="text-gray-400 italic text-sm">Aucun rendez-vous planifié.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- PROFIL SANTE --}}
                <div class="lg:col-span-4 col-span-1 space-y-6">
                    <div class="bg-white rounded-[2.5rem] p-6 md:p-8 shadow-sm border border-slate-100">
                        <h2 class="text-[10px] font-black uppercase text-slate-400 mb-6 tracking-[0.2em]">Mon profil santé</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center border-b border-slate-50 pb-2">
                                <span class="text-slate-500 text-xs font-bold uppercase">Nom complet</span>
                                <span class="font-black text-slate-800 text-sm">{{ Auth::user()->name }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-slate-50 pb-2">
                                <span class="text-slate-500 text-xs font-bold uppercase">Contact</span>
                                <span class="font-bold text-slate-800 text-sm tracking-tight">{{ $patient->telephone ?? 'Non renseigné' }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <span class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Groupe sanguin</span>
                                <div class="flex items-center gap-2 bg-red-50 px-4 py-2 rounded-2xl border border-red-100">
                                    <span class="font-black text-red-600 text-sm">{{ $patient->groupe_sanguin ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Ordonnances récentes --}}
                    <div class="bg-slate-900 text-white rounded-[2.5rem] p-6 md:p-8 shadow-xl shadow-slate-200">
                        <h2 class="text-[10px] font-black uppercase mb-6 tracking-[0.2em] text-blue-400 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                            Ordonnances récentes
                        </h2>
                        <div class="space-y-4">
                            @forelse($dernieresOrdonnances as $ordonnance)
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-blue-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-slate-500 uppercase mb-1">{{ \Carbon\Carbon::parse($ordonnance->created_at)->translatedFormat('d M Y') }}</p>
                                        <p class="font-black text-white text-sm">Dr. {{ $ordonnance->medecin->user->name ?? 'Médecin' }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-slate-500 text-xs font-bold italic opacity-60 text-center">Aucune ordonnance.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- JS: Toggle Sidebar sur Mobile --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleButton = document.getElementById('sidebarToggle');
        
        if(toggleButton && sidebar){
            toggleButton.addEventListener('click', (e) => {
                e.stopPropagation();
                sidebar.classList.toggle('-translate-x-full');
            });

            // Fermer le sidebar en cliquant à l'extérieur (optionnel mais recommandé)
            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && !toggleButton.contains(e.target)) {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        }
    </script>
</x-app-layout>