<x-app-layout>
<div class="flex min-h-screen bg-[#F8FAFC]" x-data="{ showNoteModal: false, mobileMenuOpen: false }">

    {{-- BOUTON HAMBURGER (Visible uniquement sur mobile/tablette) --}}
    <div class="lg:hidden fixed top-4 left-4 z-[60]">
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-3 bg-white rounded-2xl shadow-sm border border-gray-100 text-blue-600 outline-none">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    {{-- OVERLAY MOBILE --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[40] lg:hidden" x-cloak>
    </div>
{{-- SIDEBAR --}}
<aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" 
       class="w-72 bg-white flex flex-col fixed h-full z-50 border-r border-gray-100 shadow-sm overflow-hidden transition-transform duration-300 ease-in-out">
    
    {{-- Branding (Optionnel si tu l'as déjà en haut, sinon garde-le) --}}
    <div class="p-8">
    </div>

    <nav class="flex-1 px-4 overflow-y-auto space-y-6 [scrollbar-width:none]">
        {{-- SECTION : GESTION CABINET --}}
        <div>
            <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-4 ml-4">Gestion Cabinet</p>
            <div class="flex flex-col gap-1">
                <a href="{{ route('doctor.dashboard') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline {{ request()->routeIs('doctor.dashboard') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span class="font-bold text-sm">Vue d'ensemble</span>
                </a>

                <a href="{{ route('doctor.patients.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline {{ request()->routeIs('doctor.patients*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    <span class="font-bold text-sm">Mes Patients</span>
                </a>

                <a href="{{ route('doctor.rendezvous.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline {{ request()->routeIs('doctor.rendezvous*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="font-bold text-sm">Agenda</span>
                </a>

                {{-- Ajout de l'onglet Analyses --}}
<a href="{{ route('doctor.analyses.index') }}" 
    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline {{ request()->routeIs('doctor.analyses*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
    </svg>
    <span class="font-bold text-sm">Analyses & Labo</span>
</a>
            </div>
        </div>

        {{-- SECTION : CONFIGURATION --}}
        <div>
            <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-4 ml-4">Configuration</p>
            <div class="flex flex-col gap-1">
                <a href="{{ route('doctor.availabilities.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline {{ request()->routeIs('doctor.availabilities*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-bold text-sm">Mes Horaires</span>
                </a>

                <a href="{{ route('doctor.prescriptions.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline {{ request()->routeIs('doctor.prescriptions*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    <span class="font-bold text-sm">Ordonnances</span>
                </a>

                <a href="{{ route('doctor.messages.index') }}" 
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline {{ request()->routeIs('doctor.messages*') ? 'bg-blue-50 text-blue-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span class="font-bold text-sm">Messagerie</span>
                </a>
            </div>
        </div>
    </nav>

   {{-- FOOTER SIDEBAR : Bouton Déconnexion Uniquement --}}
    <div class="p-4 mt-auto border-t border-gray-100 bg-gray-50/50 mb-20">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                    class="group w-full flex items-center justify-center gap-3 py-4 rounded-2xl text-rose-600 bg-white shadow-sm border border-rose-100/50 hover:bg-rose-50 hover:text-rose-700 transition-all duration-300 font-black uppercase text-[10px] tracking-[0.15em] cursor-pointer">
                    
                    {{-- Icône Sortie --}}
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>

                    {{ __('Déconnexion') }}
                </button>
            </form>
        @endauth
    </div>
</aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 lg:ml-72 p-4 md:p-10 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6 md:space-y-10">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 md:mb-10 pt-12 lg:pt-0">
                <div>
                    <h1 class="text-2xl md:text-4xl font-black text-gray-800">
                        Bonjour, <span class="text-blue-600"> {{ Auth::user()->name }}</span>
                    </h1>
                    <p class="text-gray-500 mt-1 font-medium text-sm md:text-base">Voici l'activité de votre cabinet aujourd'hui</p>
                </div>
                <div class="w-full md:w-auto">
                    <span class="bg-white block text-center px-5 py-3 rounded-2xl shadow-sm border border-gray-100 text-sm font-bold text-gray-600">
                        {{ \Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y') }}
                    </span>
                </div>
            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <p class="text-[11px] uppercase text-gray-400 font-bold tracking-wider">RDV du jour</p>
                    <h3 class="text-3xl font-black text-blue-600 mt-2">{{ $rendezvous->count() }}</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <p class="text-[11px] uppercase text-gray-400 font-bold tracking-wider">Patients suivis</p>
                    <h3 class="text-3xl font-black text-indigo-600 mt-2">{{ $totalPatients ?? 0 }}</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <p class="text-[11px] uppercase text-gray-400 font-bold tracking-wider">Messages</p>
                    <h3 class="text-3xl font-black text-red-500 mt-2">{{ $messagesNonLus ?? 0 }}</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <p class="text-[11px] uppercase text-gray-400 font-bold tracking-wider">Spécialité</p>
                    <h3 class="text-lg font-black mt-2 text-gray-700 truncate">
                        {{ Auth::user()->specialite->nom_specialite ?? 'Généraliste' }}
                    </h3>
                </div>
            </div>

            {{-- ACTIONS RAPIDES --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('doctor.patients.index') }}" class="flex flex-col items-center justify-center p-4 md:p-6 bg-indigo-600 text-white rounded-3xl font-bold hover:scale-[1.02] transition shadow-lg shadow-indigo-100 no-underline text-center">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" stroke-linecap="round"/></svg>
                    <span class="text-xs md:text-sm">Patients</span>
                </a>
                <a href="{{ route('doctor.prescriptions.index') }}" class="flex flex-col items-center justify-center p-4 md:p-6 bg-emerald-600 text-white rounded-3xl font-bold hover:scale-[1.02] transition shadow-lg shadow-emerald-100 no-underline text-center">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2" stroke-linecap="round"/></svg>
                    <span class="text-xs md:text-sm">Ordonnance</span>
                </a>
                <a href="{{ route('doctor.availabilities.index') }}" class="flex flex-col items-center justify-center p-4 md:p-6 bg-blue-600 text-white rounded-3xl font-bold hover:scale-[1.02] transition shadow-lg shadow-blue-100 no-underline text-center">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round"/></svg>
                    <span class="text-xs md:text-sm">Horaires</span>
                </a>
                <a href="{{ route('doctor.rendezvous.index') }}" class="flex flex-col items-center justify-center p-4 md:p-6 bg-slate-900 text-white rounded-3xl font-bold hover:scale-[1.02] transition shadow-lg shadow-slate-200 no-underline text-center">
                    <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round"/></svg>
                    <span class="text-xs md:text-sm">Agenda</span>
                </a>
            </div>

            {{-- TABLEAU ET NOTES --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
             {{-- TABLEAU CONSULTATIONS (DYNAMISÉ) --}}
<div class="lg:col-span-8 overflow-hidden">
    <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-8">
            <h2 class="font-black uppercase text-gray-400 text-[10px] md:text-sm tracking-widest">Consultations du jour</h2>
            <span class="bg-blue-50 text-blue-600 px-4 py-1 rounded-full text-[10px] font-black">
                {{ $rendezvous->count() }} RDV
            </span>
        </div>

        <div class="overflow-x-auto -mx-6 md:mx-0">
            <table class="w-full text-left min-w-[500px] md:min-w-full">
                <thead>
                    <tr class="text-gray-400 text-[10px] uppercase tracking-[0.2em] border-b border-gray-50">
                        <th class="pb-4 px-6 md:px-0 font-black">Heure</th>
                        <th class="pb-4 font-black">Patient</th>
                        <th class="pb-4 font-black">Motif</th>
                        <th class="pb-4 font-black text-right px-6 md:px-0">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($rendezvous as $rdv)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            <td class="py-5 px-6 md:px-0 text-sm font-black text-blue-600">
                                {{ \Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i') }}
                            </td>
                            <td class="py-5">
                                <div class="flex items-center">
                                    {{-- Initiale stylisée --}}
                                    <div class="w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center mr-3 text-xs font-black text-gray-500 uppercase group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors">
                                        {{ $rdv->patient ? substr($rdv->patient->name, 0, 1) : 'P' }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-800">
                                            {{ $rdv->patient->name ?? 'Patient Inconnu' }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 font-medium tracking-tight">ID: #{{ $rdv->patient_id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 text-sm text-gray-500 italic">
                                {{ Str::limit($rdv->motif ?? 'Consultation générale', 30) }}
                            </td>
                            <td class="py-5 text-right px-6 md:px-0">
                                {{-- Condition d'affichage selon le statut --}}
                                @if($rdv->statut === 'termine' || $rdv->statut === 'effectue')
                                    <span class="inline-flex items-center justify-center px-4 py-2 bg-emerald-50 text-emerald-600 rounded-xl font-black text-[10px] uppercase tracking-widest border border-emerald-100">
                                        <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Terminé
                                    </span>
                                @else
                                    <a href="{{ route('doctor.consultations.create', ['rendezvous' => $rdv->id]) }}" 
                                       class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 no-underline">
                                        Démarrer
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-400 text-sm font-medium italic">Aucun rendez-vous pour aujourd'hui.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
                {{-- NOTES DU CABINET --}}
                <div class="lg:col-span-4">
                    <div class="bg-[#0F172A] text-white rounded-[2.5rem] p-8 shadow-xl shadow-blue-900/10 h-full">
                        <h2 class="text-xs font-black uppercase mb-6 tracking-[0.2em] text-blue-400">Notes du Cabinet</h2>
                        <div class="p-5 bg-slate-800/40 rounded-3xl border border-slate-700/50 min-h-[120px] flex items-center justify-center text-center">
                            <p class="text-xs text-slate-300 leading-relaxed italic font-medium">
                                @if(isset($derniereNote))
                                    "{{ $derniereNote->contenu }}"
                                @else
                                    "Gardez une trace de vos idées importantes ici."
                                @endif
                            </p>
                        </div>
                        <button @click="showNoteModal = true" class="w-full mt-6 py-4 bg-blue-600 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-blue-700 transition shadow-lg shadow-blue-600/20 cursor-pointer border-none">
                            Ajouter une note
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- MODALE --}}
    <div x-show="showNoteModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-cloak>
        <div @click.away="showNoteModal = false" class="bg-white rounded-[2rem] p-6 md:p-10 max-w-md w-full shadow-2xl">
            <h3 class="text-xl md:text-2xl font-black text-gray-800 mb-2">Pense-bête</h3>
            <p class="text-gray-500 text-xs md:text-sm mb-6">Visible uniquement sur votre dashboard.</p>
            
            <form action="{{ route('doctor.notes.store') }}" method="POST">
                @csrf
                <textarea name="contenu" rows="5" required
                    class="w-full border-gray-100 bg-gray-50 rounded-[1.5rem] p-5 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent mb-6 transition outline-none"
                    placeholder="Note importante..."></textarea>
                
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" @click="showNoteModal = false" 
                        class="py-4 text-gray-400 font-black text-[10px] uppercase tracking-widest hover:bg-gray-100 rounded-2xl transition border-none cursor-pointer">Annuler</button>
                    <button type="submit" 
                        class="py-4 bg-blue-600 text-white font-black text-[10px] uppercase tracking-widest rounded-2xl hover:bg-blue-700 transition shadow-lg shadow-blue-100 border-none cursor-pointer">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>
</x-app-layout>