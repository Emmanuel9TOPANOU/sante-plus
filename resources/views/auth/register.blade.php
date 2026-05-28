<x-guest-layout>

    {{-- MESSAGE DE SUCCÈS PREMIUM --}}
    @if (session('success'))
        <div x-data="{ show: true }" 
             x-show="show" 
             x-init="setTimeout(() => show = false, 2000)"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 -translate-y-10"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-500"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-10"
             class="fixed top-10 left-1/2 -translate-x-1/2 z-[100] w-full max-w-xs px-4">
            
            <div class="bg-white/10 backdrop-blur-2xl border border-emerald-500/50 p-4 rounded-3xl shadow-[0_0_30px_rgba(16,185,129,0.2)] flex items-center gap-4">
                <div class="flex-shrink-0 w-10 h-10 bg-emerald-500/20 rounded-2xl flex items-center justify-center border border-emerald-500/30">
                    <i class="fa-solid fa-check text-emerald-400"></i>
                </div>
                <div>
                    <p class="text-[10px] font-black text-white uppercase tracking-widest">Félicitations</p>
                    <p class="text-[9px] text-emerald-400/80 font-bold uppercase">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    {{-- CSS & ASSETS --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;800;900&display=swap');
        .montserrat { font-family: 'Montserrat', sans-serif; }

        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .animate-float { animation: float 6s ease-in-out infinite; }

        .btn-shimmer { position: relative; overflow: hidden; }
        .btn-shimmer::after { content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%; background: linear-gradient(45deg, transparent, rgba(255,255,255,0.25), transparent); transform: rotate(45deg); transition: 0.6s; }
        .btn-shimmer:hover::after { left: 120%; }

        .video-background { filter: brightness(0.5) contrast(1.1); }
        .compact-input { padding-top: 0.8rem !important; padding-bottom: 0.8rem !important; }
        
        .field-label { display: block; text-transform: uppercase; font-weight: 800; letter-spacing: 0.1em; color: rgba(255,255,255,0.4); font-size: 8px; margin-left: 1.25rem; margin-bottom: 0.25rem; }

        .custom-scroll::-webkit-scrollbar { width: 4px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>

    <video autoplay muted loop playsinline class="fixed inset-0 w-full h-full object-cover -z-30 video-background">
        <source src="{{ asset('assets/videos/18203708-hd_1920_1080_60fps.mp4') }}" type="video/mp4">
    </video>

    <div class="fixed inset-0 bg-gradient-to-tr from-slate-900/90 via-slate-900/20 to-blue-900/50 -z-20"></div>

    {{-- ÉTAT GLOBAL --}}
    <div class="flex items-center justify-center min-h-screen relative z-10 py-10 px-6 montserrat" 
         x-data="{ 
            role: '{{ $role }}', 
            openModal: false, 
            search: '',
            selectedSpecName: 'Choisir une spécialité...',
            selectedSpecId: '',
            specialites: {{ $specialites->map(fn($s) => ['id' => $s->id, 'nom' => $s->nom_specialite])->toJson() }}
         }">

        <div class="animate-float w-full max-w-lg">
            <div class="relative p-6 md:p-10 rounded-[2.5rem] md:rounded-[3.5rem] shadow-2xl bg-white/5 backdrop-blur-xl border border-white/10 overflow-hidden">
                
                <a href="/" class="absolute top-8 left-8 text-white/40 hover:text-white transition-colors flex items-center gap-2 text-[9px] font-bold uppercase tracking-widest">
                    <i class="fa-solid fa-arrow-left"></i> Accueil
                </a>

                <div class="text-center mb-6 mt-4">
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-600 to-cyan-400 rounded-2xl mb-4 shadow-lg rotate-3">
                        <i class="fa-solid fa-heart-pulse text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-white uppercase tracking-tighter">SANTÉ<span class="text-blue-400"> +</span></h2>
                    <p class="text-slate-400 text-[9px] font-bold uppercase tracking-[0.4em] mt-2">Création dossier <span x-text="role === 'patient' ? 'patient' : 'médecin'"></span></p>
                </div>

                <div class="flex bg-black/20 p-1.5 rounded-2xl mb-6 border border-white/5">
                    <button @click="role = 'patient'" type="button" :class="role === 'patient' ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400'" class="flex-1 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">Patient</button>
                    <button @click="role = 'medecin'" type="button" :class="role === 'medecin' ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400'" class="flex-1 py-3 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all">Médecin</button>
                </div>


                <form method="POST" action="{{ route('register') }}" class="space-y-3">
    @csrf
    <input type="hidden" name="role" :value="role">

    {{-- Nom (lettres seulement) --}}
    <div class="relative group">
        <i class="fa-solid fa-user absolute left-5 top-1/2 -translate-y-1/2 text-slate-500"></i>
        <input type="text" name="name" value="{{ old('name') }}" required 
               pattern="^[A-Za-zÀ-ÿ\s\-]+$"
               title="Le nom ne doit contenir que des lettres, espaces et tirets"
               class="w-full pl-12 pr-4 compact-input bg-white/5 border border-white/10 rounded-2xl text-xs text-white placeholder-slate-500 focus:border-blue-500/50 outline-none transition-all" 
               placeholder="Nom complet (ex: Jean Dupont)">
    </div>

    {{-- Champs PATIENT --}}
    <div x-show="role === 'patient'" x-transition class="grid grid-cols-2 gap-3">
        <div class="space-y-2">
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Genre / Sexe</label>
            <div class="relative group">
                <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-400 transition-colors">
                    <i class="fa-solid fa-venus-mars"></i>
                </div>
                <select name="sexe" class="w-full pl-12 pr-10 py-4 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl text-sm text-white focus:border-blue-500/50 focus:ring-4 focus:ring-blue-500/10 outline-none appearance-none transition-all cursor-pointer">
                    <option value="" disabled selected class="bg-slate-900">Choisir le genre</option>
                    <option value="M" class="bg-slate-900">Masculin</option>
                    <option value="F" class="bg-slate-900">Féminin</option>
                </select>
            </div>
        </div>
        <div class="relative group">
            <label class="field-label">Date de naissance</label>
            <input type="date" name="date_naissance" class="w-full px-4 compact-input bg-white/5 border border-white/10 rounded-2xl text-[10px] text-white focus:border-blue-500/50 outline-none">
        </div>
    </div>

    {{-- Champs MÉDECIN (version établissement) --}}
    <div x-show="role === 'medecin'" x-transition class="space-y-3">
        <div class="grid grid-cols-2 gap-3">
            <div class="relative group">
                <label class="field-label">Matricule</label>
                <input type="text" name="matricule" placeholder="Ex: MED-001" required
                       pattern="^[A-Z0-9\-]+$"
                       title="Lettres majuscules, chiffres et tirets uniquement"
                       class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-xs text-white focus:border-blue-500/50 outline-none">
            </div>
            <div class="relative group">
                <label class="field-label">Spécialité</label>
                <button type="button" @click="openModal = true" 
                        class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-xs text-white text-left focus:border-blue-500/50 outline-none flex items-center justify-between">
                    <span x-text="selectedSpecName" class="truncate">Choisir une spécialité</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-500"></i>
                </button>
                <input type="hidden" name="specialite_id" :value="selectedSpecId">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div class="relative group">
                <label class="field-label">Numéro d'Ordre des Médecins</label>
                <input type="text" name="numero_ordre" required
                       pattern="^[A-Z]{3}-\d{4}-\d{5}$"
                       title="Format: OMB-2024-00123"
                       class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-xs text-white font-mono focus:border-blue-500/50 outline-none"
                       placeholder="Ex: OMB-2024-00123">
                <p class="text-[7px] text-blue-400/50 mt-1 ml-3">Format: OMB-2024-00123 (Ordre des Médecins du Bénin)</p>
            </div>
   <div class="relative group">
    <label class="block text-[10px] font-black text-slate-400 group-focus-within:text-blue-400 uppercase tracking-widest mb-2 ml-2 transition-colors duration-300">
        <i class="fa-solid fa-building mr-1.5 opacity-70"></i> Service d'affectation
    </label>
    
    <div class="relative">
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-400 transition-colors duration-300 z-10 pointer-events-none">
            <i class="fa-solid fa-hospital-user text-base"></i>
        </div>
        
        <select name="service_id" required
                class="w-full pl-11 pr-12 py-4 bg-white/[0.04] backdrop-blur-xl border border-white/10 rounded-2xl text-sm text-slate-200 appearance-none cursor-pointer focus:border-blue-500/50 focus:ring-2 focus:ring-blue-500/10 focus:shadow-[0_0_20px_rgba(59,130,246,0.15)] outline-none transition-all duration-300 hover:bg-white/[0.08] hover:border-white/20">
            <option value="" disabled selected class="bg-slate-900 text-slate-500">Sélectionner un service</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" class="bg-slate-900 text-slate-300 py-3" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->nom }}
                </option>
            @endforeach
        </select>
        
        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-focus-within:text-blue-400 group-hover:text-slate-200 transition-all duration-300 group-focus-within:rotate-180">
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </div>
    </div>
    
    <div class="flex items-center gap-2 mt-2.5 ml-2 opacity-80 group-focus-within:opacity-100 transition-opacity duration-300">
        <div class="w-1 h-1 bg-blue-500 rounded-full shadow-[0_0_8px_#3b82f6]"></div>
        <p class="text-[9px] text-slate-400 font-semibold tracking-wide">Service où vous exercez dans l'établissement</p>
    </div>
</div>
        </div>
        
        {{-- Champ biographie (optionnel) --}}
        <div class="relative group">
            <label class="field-label">Biographie (optionnel)</label>
            <textarea name="biographie" rows="2" 
                      class="w-full px-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-xs text-white placeholder-slate-500 focus:border-blue-500/50 outline-none resize-none"
                      placeholder="Bref résumé de votre parcours..."></textarea>
        </div>
    </div>

    {{-- Email --}}
    <div class="relative group">
        <i class="fa-solid fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-slate-500"></i>
        <input type="email" name="email" value="{{ old('email') }}" required 
               pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
               title="Entrez une adresse email valide (ex: nom@domaine.com)"
               class="w-full pl-12 pr-4 compact-input bg-white/5 border border-white/10 rounded-2xl text-xs text-white placeholder-slate-500 outline-none" 
               placeholder="Adresse e-mail">
    </div>

    {{-- Téléphone et Ville de résidence --}}
    <div class="grid grid-cols-2 gap-3">
        <div class="relative group">
            <i class="fa-solid fa-phone absolute left-5 top-1/2 -translate-y-1/2 text-slate-500"></i>
            <input type="tel" name="telephone" value="{{ old('telephone') }}" required 
                   pattern="^[0-9+\-\s]{8,20}$"
                   title="Entrez un numéro de téléphone valide"
                   class="w-full pl-12 pr-4 compact-input bg-white/5 border border-white/10 rounded-2xl text-xs text-white placeholder-slate-500 outline-none" 
                   placeholder="Téléphone (ex: +229 01 23 45 67)">
        </div>
        <div class="relative group">
            <i class="fa-solid fa-location-dot absolute left-5 top-1/2 -translate-y-1/2 text-slate-500"></i>
            <input type="text" name="adresse" value="{{ old('adresse') }}" required 
                   class="w-full pl-12 pr-4 compact-input bg-white/5 border border-white/10 rounded-2xl text-xs text-white placeholder-slate-500 outline-none" 
                   placeholder="Ville de résidence">
        </div>
    </div>

    {{-- Mot de passe --}}
    <div x-data="{ show: false }" class="relative group">
        <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-slate-500"></i>
        <input :type="show ? 'text' : 'password'" name="password" required 
               minlength="6"
               class="w-full pl-12 pr-12 compact-input bg-white/5 border border-white/10 rounded-2xl text-xs text-white placeholder-slate-500 outline-none" 
               placeholder="Mot de passe (6 caractères minimum)">
        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-600">
            <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
        </button>
        <p class="text-[7px] text-slate-500 mt-1 ml-3">6 caractères minimum</p>
    </div>

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
    <div class="bg-red-500/20 border border-red-500/50 rounded-xl p-3">
        <ul class="text-[10px] text-red-300 space-y-1">
            @foreach ($errors->all() as $error)
                <li>⚠️ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="pt-4">
        <button type="submit" class="btn-shimmer w-full bg-gradient-to-r from-blue-700 to-blue-500 text-white font-black py-4 rounded-2xl shadow-xl uppercase tracking-widest text-[10px] transform hover:-translate-y-1 transition-all">
            Finaliser mon inscription
        </button>
    </div>

    {{-- Lien vers login --}}
    <div class="text-center pt-6 border-t border-white/10">
        <p class="text-[10px] text-slate-400 uppercase">
            Déjà inscrit ?
            <a href="{{ route('login') }}" class="text-white font-bold hover:text-blue-400 underline ml-1">Se connecter</a>
        </p>
    </div>
</form>

        {{-- MODAL POPUP --}}
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 scale-95" 
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100 scale-100" 
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 z-[110] flex items-center justify-center p-6 bg-slate-900/60 backdrop-blur-md"
             style="display: none;">
            
            <div @click.away="openModal = false" class="bg-slate-900 border border-white/10 w-full max-w-sm rounded-[2.5rem] overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-white/5 flex justify-between items-center">
                    <h3 class="text-white font-black uppercase text-[10px] tracking-widest">Spécialités disponibles</h3>
                    <button @click="openModal = false" class="text-slate-500 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
                </div>
                
                <div class="p-4">
                    <input type="text" x-model="search" placeholder="Rechercher une spécialité..." 
                           class="w-full bg-white/5 border border-white/10 rounded-xl py-2 px-4 text-xs text-white outline-none focus:border-blue-500 mb-4">
                    
                    <div class="max-h-60 overflow-y-auto custom-scroll space-y-1">
                        <template x-for="spec in specialites.filter(s => s.nom.toLowerCase().includes(search.toLowerCase()))" :key="spec.id">
                            <button type="button" 
                                    @click="selectedSpecId = spec.id; selectedSpecName = spec.nom; openModal = false"
                                    class="w-full text-left px-4 py-3 rounded-xl hover:bg-blue-600/20 text-slate-300 hover:text-white text-[11px] transition-colors border border-transparent hover:border-blue-500/30 font-semibold uppercase tracking-tight">
                                <span x-text="spec.nom"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>



<script>
    // Validation en temps réel du numéro de téléphone (chiffres seulement)
    document.querySelectorAll('input[name="telephone"], input[name="cabinet_telephone"]')?.forEach(function(input) {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9+\-\s]/g, '');
        });
    });

    // Validation du nom (lettres seulement)
    document.querySelector('input[name="name"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-zÀ-ÿ\s\-]/g, '');
    });

    // Validation du format numéro d'ordre
    document.querySelector('input[name="numero_ordre"]')?.addEventListener('input', function(e) {
        let value = this.value.toUpperCase();
        value = value.replace(/[^A-Z0-9\-]/g, '');
        if (value.length > 3 && value[3] !== '-') {
            value = value.slice(0, 3) + '-' + value.slice(3);
        }
        if (value.length > 8 && value[8] !== '-') {
            value = value.slice(0, 8) + '-' + value.slice(8);
        }
        this.value = value;
    });
</script>