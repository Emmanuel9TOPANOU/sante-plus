<x-guest-layout>

    {{-- NOTIFICATIONS FLOTTANTES SANTÉ+ --}}
    <div class="fixed top-10 left-1/2 -translate-x-1/2 z-[100] w-full max-w-xs px-4 space-y-4">
        
        {{-- INFO : Compte en attente de validation (Option A) --}}
        @if (session('info'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 5000)"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 -translate-y-12"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-500"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-12"
                 class="bg-white/10 backdrop-blur-2xl border border-blue-500/40 p-4 rounded-[2rem] shadow-[0_10px_40px_rgba(59,130,246,0.2)] flex items-center gap-4">
                
                <div class="flex-shrink-0 w-10 h-10 bg-blue-500/20 rounded-2xl flex items-center justify-center border border-blue-500/30">
                    <i class="fa-solid fa-clock-rotate-left text-blue-400"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[9px] font-black text-white uppercase tracking-widest mb-0.5">Dossier en attente</p>
                    <p class="text-[8px] text-blue-400/90 font-bold uppercase leading-tight">{{ session('info') }}</p>
                </div>
            </div>
        @endif

        {{-- SUCCÈS : Inscription réussie --}}
        @if (session('status'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 2500)"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 -translate-y-12"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white/10 backdrop-blur-2xl border border-emerald-500/40 p-4 rounded-[2rem] shadow-[0_10px_40px_rgba(16,185,129,0.2)] flex items-center gap-4">
                
                <div class="flex-shrink-0 w-10 h-10 bg-emerald-500/20 rounded-2xl flex items-center justify-center border border-emerald-500/30">
                    <i class="fa-solid fa-check text-emerald-400"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[9px] font-black text-white uppercase tracking-widest mb-0.5">Félicitations</p>
                    <p class="text-[8px] text-emerald-400/90 font-bold uppercase leading-tight">{{ session('status') }}</p>
                </div>
            </div>
        @endif

        {{-- ERREUR : Identifiants incorrects --}}
        @if ($errors->any())
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-init="setTimeout(() => show = false, 3500)"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 -translate-y-12"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white/10 backdrop-blur-2xl border border-red-500/40 p-4 rounded-[2rem] shadow-[0_10px_40px_rgba(239,68,68,0.2)] flex items-center gap-4">
                
                <div class="flex-shrink-0 w-10 h-10 bg-red-500/20 rounded-2xl flex items-center justify-center border border-red-500/30">
                    <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                </div>
                <div class="flex-1">
                    <p class="text-[9px] font-black text-white uppercase tracking-widest mb-0.5">Attention</p>
                    <p class="text-[8px] text-red-400/90 font-bold uppercase leading-tight">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </p>
                </div>
            </div>
        @endif
    </div>

    {{-- CSS --}}
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
    </style>

    {{-- VIDEO --}}
    <video autoplay muted loop playsinline class="fixed inset-0 w-full h-full object-cover -z-20 video-background">
        <source src="{{ asset('assets/videos/18203708-hd_1920_1080_60fps.mp4') }}" type="video/mp4">
    </video>

    {{-- OVERLAY --}}
    <div class="fixed inset-0 bg-gradient-to-tr from-slate-900/80 via-transparent to-blue-900/40 -z-10"></div>

    <div class="flex items-center justify-center min-h-screen relative z-10 px-6 montserrat">
        <div class="animate-float w-full max-w-md">

            {{-- CARD --}}
            <div class="relative p-8 rounded-[2.5rem] shadow-2xl bg-white/10 backdrop-blur-2xl border border-white/20 overflow-hidden">

                {{-- RETOUR --}}
                <a href="/" class="absolute top-6 left-6 text-white/50 hover:text-white flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest">
                    <i class="fa-solid fa-arrow-left"></i> Accueil
                </a>

                {{-- HEADER --}}
                <div class="text-center mb-8 mt-4">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-400 rounded-2xl mb-4 shadow-lg rotate-3">
                        <i class="fa-solid fa-plus text-white text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-white uppercase">SANTÉ<span class="text-blue-400"> +</span></h2>
                    <p class="text-slate-300 text-[10px] uppercase tracking-[0.3em] mt-2">Votre priorité digitale</p>
                </div>

                {{-- FORM --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="relative">
                        <i class="fa-solid fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full pl-14 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl text-sm text-white placeholder-slate-400 focus:border-blue-500 outline-none" placeholder="Adresse e-mail">
                    </div>

                    {{-- PASSWORD --}}
                    <div x-data="{ show: false }">
                        <div class="relative">
                            <i class="fa-solid fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required class="w-full pl-14 pr-12 py-4 bg-white/5 border border-white/10 rounded-2xl text-sm text-white placeholder-slate-400 focus:border-blue-500 outline-none" placeholder="Mot de passe">
                            <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-blue-400">
                                <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                            </button>
                        </div>
                    </div>

                    {{-- OPTIONS --}}
                    <div class="flex justify-between items-center px-1">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-white/10 bg-white/5 text-blue-500">
                            <span class="text-[10px] text-slate-400 uppercase">Rester connecté</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] text-blue-400 hover:text-blue-300 uppercase">Oublié ?</a>
                        @endif
                    </div>

                    {{-- BTN --}}
                    <button type="submit" class="btn-shimmer w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-xs transition-all">
                        S'authentifier
                    </button>

                    {{-- REGISTER --}}
                    <div class="text-center pt-6 border-t border-white/10">
                        <p class="text-[10px] text-slate-400 uppercase">
                            Nouveau ici ?
                            <a href="{{ route('register') }}" class="text-white font-bold hover:text-blue-400 underline ml-1">Créer un profil</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>