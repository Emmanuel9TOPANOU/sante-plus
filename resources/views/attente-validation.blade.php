<x-guest-layout>
    {{-- CSS & ASSETS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <video autoplay muted loop playsinline class="fixed inset-0 w-full h-full object-cover -z-30 filter brightness-[0.4]">
        <source src="{{ asset('assets/videos/18203708-hd_1920_1080_60fps.mp4') }}" type="video/mp4">
    </video>

    <div class="fixed inset-0 bg-gradient-to-br from-slate-900/90 via-blue-900/20 to-slate-900/90 -z-20"></div>

    <div class="flex items-center justify-center min-h-screen px-6 font-['Montserrat']">
        <div class="w-full max-w-lg text-center">
            <div class="relative p-10 rounded-[3.5rem] bg-white/5 backdrop-blur-3xl border border-white/10 shadow-2xl overflow-hidden">
                
                @if(auth()->user()->medecin && auth()->user()->medecin->est_valide)
                    {{-- ÉTAT : COMPTE VALIDÉ (SUCCÈS) --}}
                    <div class="relative inline-flex items-center justify-center w-20 h-20 bg-emerald-500/20 rounded-3xl mb-8 border border-emerald-500/30">
                        <i class="fa-solid fa-circle-check text-emerald-400 text-3xl animate-bounce"></i>
                        <div class="absolute inset-0 border-2 border-emerald-400/20 rounded-3xl animate-ping"></div>
                    </div>

                    <h2 class="text-2xl font-black text-white uppercase tracking-tighter mb-4">
                        Accès <span class="text-emerald-400">Premium Activé</span>
                    </h2>

                    <div class="space-y-6 mb-8">
                        <p class="text-slate-300 text-xs leading-relaxed uppercase tracking-wide font-medium">
                            Félicitations Docteur ! Votre compte a été validé. Vous pouvez désormais accéder à l'intégralité des outils <span class="font-black text-white">SANTÉ+</span>.
                        </p>
                        
                        <a href="{{ route('doctor.dashboard') }}" class="inline-block w-full py-4 bg-emerald-600 hover:bg-emerald-500 text-white font-black text-[10px] uppercase tracking-[0.2em] rounded-2xl shadow-lg shadow-emerald-900/20 transition-all duration-300 transform hover:-translate-y-1">
                            Accéder à mon espace <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                @else
                    {{-- ÉTAT : EN ATTENTE (TON CODE ACTUEL) --}}
                    <div class="relative inline-flex items-center justify-center w-20 h-20 bg-blue-500/20 rounded-3xl mb-8 border border-blue-500/30">
                        <i class="fa-solid fa-user-shield text-blue-400 text-3xl animate-pulse"></i>
                        <div class="absolute inset-0 border-2 border-blue-400/20 rounded-3xl animate-ping"></div>
                    </div>

                    <h2 class="text-2xl font-black text-white uppercase tracking-tighter mb-4">
                        Vérification <span class="text-blue-400">en cours</span>
                    </h2>

                    <div class="space-y-4 mb-8">
                        <p class="text-slate-300 text-xs leading-relaxed uppercase tracking-wide font-medium">
                            Bienvenue Docteur. Votre demande d'adhésion à la plateforme <span class="font-black text-white">SANTÉ+</span> a été transmise avec succès.
                        </p>
                        
                        <div class="inline-block px-4 py-2 bg-white/5 border border-white/10 rounded-xl">
                            <p class="text-[9px] text-blue-400 font-black uppercase tracking-[0.2em]">
                                Matricule : {{ auth()->user()->medecin->matricule ?? 'ANALYSE...' }}
                            </p>
                        </div>

                        <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                            Statut : <span class="text-amber-500 italic">En attente de validation admin</span>
                        </p>
                    </div>
                @endif

                <div class="pt-6 border-t border-white/10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-[10px] text-white/50 hover:text-white font-black uppercase tracking-widest transition-colors">
                            <i class="fa-solid fa-power-off mr-2"></i> Se déconnecter et quitter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>