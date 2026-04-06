<x-app-layout>
    <div class="py-12 bg-[#F8FAFC] min-h-screen montserrat">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Retour --}}
            <div class="mb-8">
                <a href="{{ route('patient.rendezvous.index') }}" class="inline-flex items-center text-slate-400 hover:text-blue-600 transition font-bold text-sm group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Retour à mes rendez-vous
                </a>
            </div>

            <div class="mb-12">
                <h1 class="text-4xl font-black text-slate-800 tracking-tight uppercase">Modifier le <span class="text-blue-600">RDV</span></h1>
                <p class="text-slate-400 text-[11px] font-bold uppercase tracking-[0.2em] mt-2 italic flex items-center">
                    <span class="w-8 h-[2px] bg-blue-600 mr-2"></span>
                    Mise à jour de votre consultation
                </p>
            </div>

            <div class="bg-white rounded-[3rem] p-10 shadow-xl shadow-blue-900/5 border border-white">
                <form action="{{ route('patient.rendezvous.update', $rendezvous->id) }}" method="POST" id="editRdvForm" class="space-y-8">
                    @csrf
                    @method('PUT')

                    {{-- Sélection du Médecin (Désactivé ou en lecture seule si vous ne voulez pas qu'il change de médecin ici) --}}
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Médecin référent</label>
                        <select name="medecin_id" id="medecin_id" class="w-full bg-slate-100 border-none rounded-2xl px-6 py-4 text-slate-500 font-bold appearance-none cursor-not-allowed" readonly>
                            @foreach($medecins as $medecin)
                                <option value="{{ $medecin->id }}" 
                                    data-user="{{ $medecin->user_id }}"
                                    {{ $rendezvous->medecin_id == $medecin->id ? 'selected' : '' }}>
                                    Dr. {{ $medecin->name }} ({{ $medecin->specialite->nom_specialite ?? 'Généraliste' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Date --}}
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Date de consultation</label>
                            <input type="date" name="date_rdv" id="date_rdv" min="{{ date('Y-m-d') }}"
                                value="{{ old('date_rdv', $rendezvous->date_rdv) }}"
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-700 font-bold focus:ring-2 focus:ring-blue-500 transition-all">
                        </div>

                        {{-- Sélection de l'Heure via Créneaux --}}
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Heure disponible</label>
                            
                            <div id="heures_container" class="grid grid-cols-2 gap-2">
                                {{-- Les boutons de créneaux seront injectés ici par JS --}}
                            </div>
                            
                            <input type="hidden" name="heure_rdv" id="heure_rdv_hidden" value="{{ old('heure_rdv', \Carbon\Carbon::parse($rendezvous->heure_rdv)->format('H:i:s')) }}">

                            <div id="msg_select" class="text-[10px] text-slate-400 font-bold italic bg-slate-50 p-4 rounded-xl border border-dashed border-slate-200 text-center">
                                Chargement des disponibilités...
                            </div>
                        </div>
                    </div>

                    {{-- Motif --}}
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-2">Motif de consultation</label>
                        <textarea name="motif" rows="3" 
                            class="w-full bg-slate-50 border-none rounded-[2rem] px-6 py-4 text-slate-700 font-bold focus:ring-2 focus:ring-blue-500 transition-all placeholder:text-slate-300"
                            placeholder="Décrivez brièvement l'objet de votre visite...">{{ old('motif', $rendezvous->motif) }}</textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" id="submitBtn"
                            class="w-full bg-blue-600 text-white rounded-2xl py-5 font-black uppercase tracking-widest text-[11px] shadow-xl shadow-blue-200 hover:bg-slate-900 transform hover:-translate-y-1 transition-all duration-300">
                            Confirmer les modifications
                        </button>
                    </div>
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
        
        // Données JSON envoyées par le contrôleur
        const disponibilites = @json($disponibilites);
        const heureActuelle = "{{ \Carbon\Carbon::parse($rendezvous->heure_rdv)->format('H:i:s') }}";
        const dateActuelle = "{{ $rendezvous->date_rdv }}";

        dateInput.addEventListener('change', updateHeures);
        window.onload = updateHeures; // Charger au démarrage

        function updateHeures() {
            const selectedOption = medecinSelect.options[medecinSelect.selectedIndex];
            const userId = selectedOption.dataset.user;
            const selectedDate = dateInput.value;
            
            heuresContainer.innerHTML = "";
            msgSelect.classList.add('hidden');

            let slots = [];
            if (disponibilites[userId] && disponibilites[userId][selectedDate]) {
                slots = [...disponibilites[userId][selectedDate]];
            }

            // Si on est sur la date d'origine, on rajoute l'heure actuelle du RDV dans la liste
            if (selectedDate === dateActuelle && !slots.includes(heureActuelle)) {
                slots.push(heureActuelle);
                slots.sort(); // Garder l'ordre chronologique
            }

            if (slots.length > 0) {
                slots.forEach(heure => {
                    const isOriginal = (heure === heureActuelle && selectedDate === dateActuelle);
                    const btn = document.createElement('button');
                    btn.type = "button";
                    btn.innerText = heure.substring(0, 5);
                    
                    // Style de base
                    let baseClass = "py-3 rounded-xl text-[11px] font-black transition-all border ";
                    if (heure === heureHidden.value) {
                        baseClass += "bg-blue-600 text-white border-blue-600 shadow-lg shadow-blue-100";
                    } else {
                        baseClass += "bg-white text-slate-600 border-slate-100 hover:border-blue-500";
                    }
                    
                    btn.className = baseClass;
                    
                    btn.onclick = function() {
                        heuresContainer.querySelectorAll('button').forEach(b => {
                            b.className = "py-3 bg-white border border-slate-100 rounded-xl text-[11px] font-black text-slate-600 transition-all";
                        });
                        this.className = "py-3 bg-blue-600 border border-blue-600 rounded-xl text-[11px] font-black text-white shadow-lg shadow-blue-100";
                        heureHidden.value = heure;
                    };
                    heuresContainer.appendChild(btn);
                });
            } else {
                msgSelect.classList.remove('hidden');
                msgSelect.innerText = "Aucun créneau libre pour cette date.";
            }
        }
    </script>
</x-app-layout>