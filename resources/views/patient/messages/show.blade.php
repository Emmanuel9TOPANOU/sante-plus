<x-app-layout>
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 to-white" x-data="{ mobileMenuOpen: false, openSidebar: false }">

    {{-- OVERLAY MOBILE POUR NAVBAR --}}
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
                       Vue d'ensemble
                    </a>
                    <a href="{{ route('patient.rendezvous.index') }}" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
                       Rendez-vous
                    </a>
                    <a href="{{ route('patient.prescriptions.index') }}" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.prescriptions*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
                       Ordonnances
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
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
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
            <a href="{{ route('patient.prescriptions.index') }}" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.prescriptions*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
               Ordonnances
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
    <main class="flex-1 h-full min-h-screen ">
        <div class="flex h-full min-h-[calc(100vh-5rem)] bg-gradient-to-br from-slate-50 via-white to-blue-50/30 font-sans">

            {{-- SIDEBAR PREMIUM --}}
            <aside 
                class="fixed inset-y-0 left-0 w-80 max-w-full bg-white/95 backdrop-blur-xl border-r border-slate-200/60 shadow-2xl transform transition-all duration-500 ease-out rounded-r-3xl
                z-40 md:z-30 lg:static lg:translate-x-0"
                :class="openSidebar ? 'translate-x-0' : '-translate-x-full'"
                style="top: 80px; height: calc(100dvh - 80px);">

                {{-- Header premium --}}
                <div class="flex items-center justify-between p-5 lg:hidden border-b border-slate-100">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <h2 class="font-black text-slate-700 uppercase text-xs tracking-widest">Messages</h2>
                    </div>
                    <button @click="openSidebar = false" class="p-2 bg-slate-100 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-200 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Search premium --}}
                <div class="p-5 border-b border-slate-100">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" id="contactSearch" placeholder="Rechercher un contact..." 
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm font-medium focus:ring-2 focus:ring-blue-200 focus:border-blue-300 placeholder:text-slate-400 focus:outline-none transition-all">
                    </div>
                </div>

                {{-- Contacts List premium --}}
                <div id="contactList" class="flex-1 overflow-y-auto p-3 space-y-1.5 scrollbar-thin scrollbar-thumb-slate-200 scrollbar-track-transparent" style="height: calc(100% - 130px);">
                    
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-3 pt-2 pb-1">Médecins</h3>
                    @isset($medecins)
                        @foreach($medecins as $medecin)
                        <a href="{{ route('patient.messages.show', $medecin->id) }}" 
                            data-name="{{ strtolower($medecin->name) }}"
                            class="contact-item flex items-center p-3 rounded-xl transition-all duration-300 group
                            {{ (isset($receiver) && $receiver->id == $medecin->id) 
                                ? 'bg-gradient-to-r from-blue-50 to-white shadow-md border border-blue-200/50' 
                                : 'hover:bg-slate-50 hover:shadow-sm' }}">

                            <div class="relative">
                                <div class="w-12 h-12 {{ (isset($receiver) && $receiver->id == $medecin->id) ? 'bg-gradient-to-br from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-200' : 'bg-slate-100 text-slate-600 group-hover:bg-blue-100 group-hover:text-blue-600' }} flex items-center justify-center rounded-xl font-black transition-all duration-300">
                                    {{ strtoupper(substr($medecin->name, 0, 1)) }}
                                </div>
                            </div>

                            <div class="ml-3 flex-1 truncate">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-black {{ (isset($receiver) && $receiver->id == $medecin->id) ? 'text-blue-700' : 'text-slate-700 group-hover:text-blue-700' }} truncate">
                                        Dr. {{ $medecin->name }}
                                    </h4>
                                    @if(isset($receiver) && $receiver->id == $medecin->id)
                                        <span class="w-2 h-2 bg-blue-500 rounded-full shadow-sm shadow-blue-200"></span>
                                    @endif
                                </div>
                                <p class="text-[10px] {{ (isset($receiver) && $receiver->id == $medecin->id) ? 'text-blue-400' : 'text-slate-400 group-hover:text-blue-400' }} font-semibold uppercase tracking-tight truncate mt-0.5">
                                    {{ $medecin->specialite->nom ?? 'Généraliste' }}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    @endisset

                    {{-- Section Administration --}}
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest px-3 pt-4 pb-1">Administration</h3>
                    @isset($secretaires)
                        @foreach($secretaires as $secretaire)
                        <a href="{{ route('patient.messages.show', $secretaire->id) }}" 
                            data-name="{{ strtolower($secretaire->name) }}"
                            class="contact-item flex items-center p-3 rounded-xl transition-all duration-300 group
                            {{ (isset($receiver) && $receiver->id == $secretaire->id) 
                                ? 'bg-gradient-to-r from-blue-50 to-white shadow-md border border-blue-200/50' 
                                : 'hover:bg-slate-50 hover:shadow-sm' }}">

                            <div class="relative">
                                <div class="w-12 h-12 {{ (isset($receiver) && $receiver->id == $secretaire->id) ? 'bg-gradient-to-br from-slate-600 to-slate-500 text-white shadow-lg' : 'bg-slate-100 text-slate-500 group-hover:bg-slate-200 group-hover:text-slate-600' }} flex items-center justify-center rounded-xl font-black transition-all duration-300">
                                    {{ strtoupper(substr($secretaire->name, 0, 1)) }}
                                </div>
                            </div>

                            <div class="ml-3 flex-1 truncate">
                                <h4 class="text-sm font-black {{ (isset($receiver) && $receiver->id == $secretaire->id) ? 'text-slate-800' : 'text-slate-700 group-hover:text-slate-800' }} truncate">
                                    {{ $secretaire->name }}
                                </h4>
                                <p class="text-[10px] {{ (isset($receiver) && $receiver->id == $secretaire->id) ? 'text-slate-500' : 'text-slate-400 group-hover:text-slate-500' }} font-semibold uppercase tracking-tight truncate mt-0.5">
                                    Secrétariat
                                </p>
                            </div>
                        </a>
                        @endforeach
                    @else
                        <p class="text-[10px] text-slate-400 italic px-3 py-2">Aucun agent disponible</p>
                    @endisset
                </div>
            </aside>

            {{-- OVERLAY MOBILE POUR SIDEBAR --}}
            <div x-show="openSidebar" x-transition.opacity.duration.300 @click="openSidebar = false"
                class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 md:z-20 lg:hidden"></div>

            {{-- ZONE DE CHAT PREMIUM --}}
            <div class="flex-1 flex flex-col h-full relative min-w-0">

                {{-- HEADER CHAT PREMIUM --}}
                <div class="flex items-center justify-between p-5 border-b border-slate-100 bg-white/80 backdrop-blur-md">
                    <div class="flex items-center space-x-3">
                        <button @click="openSidebar = true" class="lg:hidden p-2.5 bg-white rounded-xl shadow-md border border-slate-100 text-blue-600 hover:bg-blue-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/>
                            </svg>
                        </button>

                   

                      
                    </div>

                </div>

                {{-- ZONE DE DISCUSSION PREMIUM --}}
                <div class="flex-1 flex flex-col bg-gradient-to-b from-slate-50 to-white">

                    @if(isset($receiver))

                        {{-- CHAT HEADER PREMIUM --}}
                        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-white/40 backdrop-blur-sm">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 text-white rounded-2xl flex items-center justify-center font-black text-lg shadow-lg shadow-blue-200 mr-4">
                                    {{ strtoupper(substr($receiver->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="font-black text-slate-800 text-base">
                                        {{ in_array($receiver->role ?? '', ['doctor', 'medecin']) ? 'Dr.' : '' }} {{ $receiver->name }}
                                    </h3>
                                   
                                </div>
                            </div>
                            <div class="hidden md:flex items-center gap-2 text-xs text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <span>Messagerie chiffrée</span>
                            </div>
                        </div>

                        {{-- MESSAGES PREMIUM --}}
                        <div id="message-container" class="flex-1 overflow-y-auto p-6 space-y-4 scroll-smooth">
                            @foreach($messages as $message)
                                @php $isMe = $message->sender_id == Auth::id(); @endphp

                                <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} animate-fade-in-up">
                                    <div class="max-w-[85%] md:max-w-[65%] lg:max-w-[55%]">
                                        <div class="relative px-5 py-3 shadow-sm transition-all duration-200
                                            {{ $isMe 
                                                ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-2xl rounded-br-md' 
                                                : 'bg-white border border-slate-100 text-slate-700 rounded-2xl rounded-bl-md shadow-md' }}">
                                            
                                            <p class="text-sm leading-relaxed {{ $isMe ? 'text-white' : 'text-slate-700' }}">
                                                {{ $message->content }}
                                            </p>
                                        </div>
                                        <div class="mt-1.5 px-2 {{ $isMe ? 'text-right' : 'text-left' }} text-[10px] font-medium text-slate-400">
                                            {{ $message->created_at->translatedFormat('H:i') }}
                                            @if($isMe)
                                                <span class="ml-1">
                                                    <svg class="w-3 h-3 inline text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- INPUT PREMIUM --}}
                        <div class="p-5 bg-white/90 backdrop-blur-sm border-t border-slate-100">
                            <form action="{{ route('patient.messages.store') }}" method="POST" class="relative max-w-4xl mx-auto">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                                <div class="relative flex items-center bg-slate-50 rounded-2xl border border-slate-200 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                                    <textarea name="content" required rows="1"
                                        placeholder="Écrivez votre message ici..."
                                        class="flex-1 bg-transparent border-none text-sm font-medium focus:ring-0 placeholder:text-slate-400 px-5 py-3.5 resize-none focus:outline-none"
                                        style="min-height: 48px; max-height: 120px;"
                                        oninput="this.style.height = 'auto'; this.style.height = Math.min(this.scrollHeight, 120) + 'px'"></textarea>

                                    <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-r from-blue-600 to-blue-500 text-white h-9 w-9 flex items-center justify-center rounded-xl shadow-md shadow-blue-200 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 active:scale-95">
                                        <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-[9px] text-slate-400 mt-2 text-center">
                                    <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                    Messages confidentiels et sécurisés
                                </p>
                            </form>
                        </div>

                    @else
                        {{-- EMPTY STATE PREMIUM --}}
                        <div class="flex-1 flex flex-col items-center justify-center text-center p-8">
                            <div class="relative">
                                <div class="w-28 h-28 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center mb-6 shadow-inner">
                                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </div>
                                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                            <h2 class="text-slate-800 font-black text-xl uppercase tracking-tight">Votre messagerie médicale</h2>
                            <p class="text-slate-400 text-sm max-w-sm mt-2 font-medium">Sélectionnez un contact dans la liste pour démarrer une conversation sécurisée.</p>
                            
                            <div class="mt-8 flex items-center gap-4 text-xs text-slate-300">
                                <span class="flex items-center gap-1"><span class="w-2 h-2 bg-emerald-400 rounded-full"></span> Confidentiel</span>
                                <span class="flex items-center gap-1"><span class="w-2 h-2 bg-blue-400 rounded-full"></span> Chiffré</span>
                                <span class="flex items-center gap-1"><span class="w-2 h-2 bg-amber-400 rounded-full"></span> Sécurisé</span>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Scroll automatique vers le bas
    const scrollToBottom = () => {
        const container = document.getElementById('message-container');
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    };

    window.onload = scrollToBottom;

    // Filtre de recherche
    const searchInput = document.getElementById('contactSearch');
    if(searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.contact-item').forEach(c => {
                const name = c.dataset.name;
                c.style.display = name && name.includes(term) ? 'flex' : 'none';
            });
        });
    }

    // Auto-resize textarea
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        });
    });
</script>

<style>
    [x-cloak] { display: none !important; }
    
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out;
    }
    
    textarea {
        overflow-y: hidden;
    }
    
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }
    
    .scrollbar-thumb-slate-200::-webkit-scrollbar-thumb {
        background-color: #e2e8f0;
        border-radius: 9999px;
    }
    
    .scrollbar-track-transparent::-webkit-scrollbar-track {
        background-color: transparent;
    }
    
    #message-container::-webkit-scrollbar {
        width: 4px;
    }
    
    #message-container::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #message-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 9999px;
    }
    
    body { 
        font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
    }
</style>
</x-app-layout>