<x-app-layout>
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 to-white" x-data="{ mobileMenuOpen: false }">

    {{-- OVERLAY MOBILE --}}
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
                          Tableau de bord
                    </a>
                    <a href="{{ route('patient.rendezvous.index') }}" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50' }}">
                       Rendez-vous
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
               Mes Rendez-vous
            </a>
          
            <a href="{{ route('patient.lab_results.index') }}" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all {{ request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600' }}">
                Analyses Médicales
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
    <main class="flex-1 p-4 md:p-8 min-h-screen pt-24 lg:pt-20">
        <div class="max-w-3xl mx-auto">
            
            {{-- Navigation / Retour --}}
            <div class="mb-6">
                <a href="{{ route('patient.rendezvous.index') }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition font-bold text-sm group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Retour à mes rendez-vous
                </a>
            </div>

            {{-- Formulaire --}}
            <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden">
                
                {{-- Header --}}
                <div class="bg-blue-700 p-8 text-white">
                    <h1 class="text-2xl md:text-3xl font-black tracking-tight">
                        Modifier le <span class="text-blue-200">Rendez-vous</span>
                    </h1>
                    <p class="text-blue-100 mt-2 font-medium">Mise à jour de votre consultation médicale.</p>
                </div>

                {{-- Formulaire --}}
                <form action="{{ route('patient.rendezvous.update', $rendezvous->id) }}" method="POST" id="editRdvForm" class="p-6 md:p-8 space-y-8">
                    @csrf
                    @method('PUT')

                    @if(session('error') || $errors->any())
                        <div class="bg-rose-50 border-l-4 border-rose-500 p-5 rounded-xl text-rose-700 text-xs font-bold space-y-1">
                            @if(session('error')) <p>{{ session('error') }}</p> @endif
                            @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                        </div>
                    @endif

                    {{-- Étape 1 : Praticien (Lecture seule) --}}
                    <div class="space-y-2">
                        <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-slate-500">
                            <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px]">1</span>
                            Praticien sélectionné
                        </label>
                        <div class="relative">
                            <select name="medecin_id" id="medecin_id" class="w-full bg-slate-100 border border-slate-200 rounded-xl px-5 py-3.5 text-slate-500 font-medium appearance-none cursor-not-allowed">
                                @foreach($medecins as $medecin)
                                    <option value="{{ $medecin->id }}" 
                                            data-user="{{ $medecin->user_id }}"
                                            {{ $rendezvous->medecin_id == $medecin->id ? 'selected' : '' }}>
                                        Dr. {{ $medecin->name }} ({{ $medecin->specialite->nom_specialite ?? 'Généraliste' }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-[10px] text-slate-400 italic">Le médecin ne peut pas être modifié après la création du rendez-vous.</p>
                    </div>

                    {{-- Étape 2 & 3 : Date et Créneaux --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Date --}}
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-slate-500">
                                <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px]">2</span>
                                Date de consultation
                            </label>
                            <input type="date" name="date_rdv" id="date_rdv" min="{{ date('Y-m-d') }}"
                                value="{{ old('date_rdv', $rendezvous->date_rdv) }}"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none">
                        </div>

                        {{-- Créneaux disponibles --}}
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-slate-500">
                                <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px]">3</span>
                                Créneaux disponibles
                            </label>
                            <div id="heures_container" class="grid grid-cols-2 gap-2">
                                {{-- Injecté par JS --}}
                            </div>
                            <input type="hidden" name="heure_rdv" id="heure_rdv_hidden" value="{{ old('heure_rdv', \Carbon\Carbon::parse($rendezvous->heure_rdv)->format('H:i:s')) }}" required>
                            
                            <div id="msg_select" class="text-[11px] text-slate-400 font-medium bg-slate-50 p-4 rounded-xl border border-dashed border-slate-200 text-center hidden">
                                Chargement des disponibilités...
                            </div>
                        </div>
                    </div>

                    {{-- Étape 4 : Motif --}}
                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-wider text-slate-500 ml-1">Motif de consultation</label>
                        <textarea name="motif" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none placeholder:text-slate-300" placeholder="Décrivez l'objet de votre visite...">{{ old('motif', $rendezvous->motif) }}</textarea>
                    </div>

                    {{-- Bouton submit --}}
                    <button type="submit" id="submitBtn" class="w-full py-4 bg-blue-600 text-white rounded-xl font-black uppercase tracking-wider text-sm shadow-md transition-all duration-300 flex items-center justify-center gap-3 hover:bg-blue-700 active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Confirmer les modifications
                    </button>
                </form>
            </div>
        </div>
    </main>

</div>

<script>
    const medecinSelect = document.getElementById('medecin_id');
    const dateInput = document.getElementById('date_rdv');
    const heuresContainer = document.getElementById('heures_container');
    const heureHidden = document.getElementById('heure_rdv_hidden');
    const msgSelect = document.getElementById('msg_select');

    const disponibilites = @json($disponibilites);
    const heureActuelleOriginale = "{{ \Carbon\Carbon::parse($rendezvous->heure_rdv)->format('H:i:s') }}";
    const dateActuelleOriginale = "{{ $rendezvous->date_rdv }}";

    // Format heure HH:MM
    function formatHour(heure) {
        return heure.substring(0, 5);
    }

    dateInput.addEventListener('change', updateHeures);
    window.onload = updateHeures; 

    function updateHeures() {
        const selectedOption = medecinSelect.options[medecinSelect.selectedIndex];
        const userId = selectedOption.dataset.user;
        const selectedDate = dateInput.value;
        
        heuresContainer.innerHTML = "";
        msgSelect.classList.add('hidden');

        let slots = [];
        
        // Récupère les slots libres
        if (disponibilites[userId] && disponibilites[userId][selectedDate]) {
            slots = [...disponibilites[userId][selectedDate]];
        }

        // Si l'utilisateur consulte la date d'origine de son RDV, 
        // on remet son créneau actuel dans la liste (même s'il n'est plus "libre")
        if (selectedDate === dateActuelleOriginale && !slots.includes(heureActuelleOriginale)) {
            slots.push(heureActuelleOriginale);
            slots.sort(); 
        }

        if (slots.length > 0) {
            slots.forEach(heure => {
                const btn = document.createElement('button');
                btn.type = "button";
                btn.innerText = formatHour(heure);
                
                // Déterminer si ce bouton est celui actuellement sélectionné
                const isSelected = (heure === heureHidden.value);

                // Style dynamique
                btn.className = isSelected 
                    ? "py-3 bg-blue-600 text-white rounded-xl text-[11px] font-bold shadow-md transition-all"
                    : "py-3 bg-white border border-slate-200 rounded-xl text-[11px] font-semibold text-slate-600 shadow-sm transition-all hover:border-blue-400 hover:bg-blue-50";
                
                btn.onclick = function() {
                    heuresContainer.querySelectorAll('button').forEach(b => {
                        b.className = "py-3 bg-white border border-slate-200 rounded-xl text-[11px] font-semibold text-slate-600 shadow-sm transition-all";
                    });
                    this.className = "py-3 bg-blue-600 text-white rounded-xl text-[11px] font-bold shadow-md transition-all";
                    heureHidden.value = heure;
                };
                heuresContainer.appendChild(btn);
            });
        } else {
            msgSelect.classList.remove('hidden');
            msgSelect.innerText = "Aucun créneau disponible pour cette date.";
            msgSelect.className = "text-[11px] font-medium p-4 rounded-xl border border-rose-200 bg-rose-50 text-rose-500 text-center";
        }
    }
</script>

<style>
    [x-cloak] { display: none !important; }
    body { 
        font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
    }
    input[type="date"] {
        appearance: none;
        -webkit-appearance: none;
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        opacity: 0.6;
    }
    textarea {
        resize: vertical;
    }
</style>
</x-app-layout>