<x-app-layout>
    <div class="py-12 bg-[#F8FAFC] min-h-screen montserrat">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Retour --}}
            <div class="mb-8">
                <a href="{{ route('patient.rendezvous.index') }}" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition font-bold text-sm group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Retour à mes rendez-vous
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-100 overflow-hidden">
                {{-- Header Style Premium --}}
                <div class="bg-gradient-to-br from-slate-900 to-blue-900 p-10 text-white relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <h1 class="text-3xl font-black tracking-tight italic">Modifier le <span class="text-blue-400 uppercase">RDV</span></h1>
                        <p class="text-slate-300 mt-2 font-medium opacity-80">Mise à jour de votre consultation médicale.</p>
                    </div>
                </div>

                <form action="{{ route('patient.rendezvous.update', $rendezvous->id) }}" method="POST" id="editRdvForm" class="p-10 space-y-10">
                    @csrf
                    @method('PUT')

                    @if(session('error') || $errors->any())
                        <div class="bg-rose-50 border-l-4 border-rose-500 p-5 rounded-2xl text-rose-700 text-xs font-bold space-y-1">
                            @if(session('error')) <p>{{ session('error') }}</p> @endif
                            @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                        </div>
                    @endif

                    {{-- Étape 1 : Praticien (Lecture seule pour conserver la cohérence du dossier) --}}
                    <div class="space-y-4">
                        <label class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[8px]">1</span>
                            Praticien sélectionné
                        </label>
                        <div class="relative">
                            <select name="medecin_id" id="medecin_id" class="w-full bg-slate-100 border-none rounded-2xl px-6 py-4 text-slate-500 font-bold appearance-none cursor-not-allowed">
                                @foreach($medecins as $medecin)
                                    <option value="{{ $medecin->id }}" 
                                            data-user="{{ $medecin->user_id }}"
                                            {{ $rendezvous->medecin_id == $medecin->id ? 'selected' : '' }}>
                                        Dr. {{ $medecin->name }} ({{ $medecin->specialite->nom_specialite ?? 'Généraliste' }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 text-slate-400">
                                <i class="fa-solid fa-lock text-xs"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Étape 2 & 3 : Date et Créneaux --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[8px]">2</span>
                                Date de consultation
                            </label>
                            <input type="date" name="date_rdv" id="date_rdv" min="{{ date('Y-m-d') }}"
                                value="{{ old('date_rdv', $rendezvous->date_rdv) }}"
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition shadow-sm outline-none">
                        </div>

                        <div class="space-y-4">
                            <label class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[8px]">3</span>
                                Créneaux disponibles
                            </label>
                            <div id="heures_container" class="grid grid-cols-2 gap-2">
                                {{-- Injecté par JS --}}
                            </div>
                            <input type="hidden" name="heure_rdv" id="heure_rdv_hidden" value="{{ old('heure_rdv', \Carbon\Carbon::parse($rendezvous->heure_rdv)->format('H:i:s')) }}" required>
                            
                            <div id="msg_select" class="text-[11px] text-slate-400 font-bold italic bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200 text-center hidden">
                                Chargement des disponibilités...
                            </div>
                        </div>
                    </div>

                    {{-- Étape 4 : Motif --}}
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Motif de consultation</label>
                        <textarea name="motif" rows="3" class="w-full bg-slate-50 border-none rounded-[1.5rem] px-6 py-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition outline-none placeholder-slate-300" placeholder="Décrivez l'objet de votre visite...">{{ old('motif', $rendezvous->motif) }}</textarea>
                    </div>

                    <button type="submit" id="submitBtn" class="w-full py-6 bg-slate-900 text-white rounded-[2rem] font-black uppercase tracking-[0.3em] text-xs shadow-lg transition-all duration-500 flex items-center justify-center gap-3 hover:scale-[1.02] active:scale-95">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        Confirmer les modifications
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const medecinSelect = document.getElementById('medecin_id');
        const dateInput = document.getElementById('date_rdv');
        const heuresContainer = document.getElementById('heures_container');
        const heureHidden = document.getElementById('heure_rdv_hidden');
        const msgSelect = document.getElementById('msg_select');
        const submitBtn = document.getElementById('submitBtn');

        const disponibilites = @json($disponibilites);
        const heureActuelleOriginale = "{{ \Carbon\Carbon::parse($rendezvous->heure_rdv)->format('H:i:s') }}";
        const dateActuelleOriginale = "{{ $rendezvous->date_rdv }}";

        dateInput.addEventListener('change', updateHeures);
        window.onload = updateHeures; 

        function updateHeures() {
            const selectedOption = medecinSelect.options[medecinSelect.selectedIndex];
            const userId = selectedOption.dataset.user;
            const selectedDate = dateInput.value;
            
            heuresContainer.innerHTML = "";
            msgSelect.classList.add('hidden');

            let slots = [];
            // On récupère les slots libres
            if (disponibilites[userId] && disponibilites[userId][selectedDate]) {
                slots = [...disponibilites[userId][selectedDate]];
            }

            // IMPORTANT : Si l'utilisateur consulte la date d'origine de son RDV, 
            // on doit remettre son créneau actuel dans la liste (même s'il n'est plus "libre")
            if (selectedDate === dateActuelleOriginale && !slots.includes(heureActuelleOriginale)) {
                slots.push(heureActuelleOriginale);
                slots.sort(); 
            }

            if (slots.length > 0) {
                slots.forEach(heure => {
                    const btn = document.createElement('button');
                    btn.type = "button";
                    btn.innerText = heure.substring(0, 5);
                    
                    // Déterminer si ce bouton est celui actuellement sélectionné
                    const isSelected = (heure === heureHidden.value);

                    // Style dynamique identique à create
                    btn.className = isSelected 
                        ? "py-3 bg-blue-600 text-white rounded-xl text-[11px] font-black shadow-lg scale-105 transition-all"
                        : "py-3 bg-white border border-slate-100 rounded-xl text-[11px] font-black text-slate-600 shadow-sm transition-all hover:border-blue-400";
                    
                    btn.onclick = function() {
                        heuresContainer.querySelectorAll('button').forEach(b => {
                            b.className = "py-3 bg-white border border-slate-100 rounded-xl text-[11px] font-black text-slate-600 shadow-sm transition-all";
                        });
                        this.className = "py-3 bg-blue-600 text-white rounded-xl text-[11px] font-black shadow-lg scale-105 transition-all";
                        heureHidden.value = heure;
                    };
                    heuresContainer.appendChild(btn);
                });
            } else {
                msgSelect.classList.remove('hidden');
                msgSelect.innerText = "Aucun créneau disponible pour cette date.";
                msgSelect.className = "text-[11px] font-bold italic p-4 rounded-2xl border border-rose-100 bg-rose-50 text-rose-500 text-center";
            }
        }
    </script>
</x-app-layout>