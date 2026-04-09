<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-50 via-white to-white backdrop-blur-xl border-b border-blue-100 sticky top-0 z-40 shadow-lg">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            {{-- PARTIE GAUCHE : Branding & Espace Rôle --}}
          <div class="flex items-center">
    
    {{-- Bloc Marque : Logo Seul et Agrandi --}}
    <a href="{{ url('/') }}" class="flex items-center justify-center mr-10 group no-underline border-none">
        {{-- Conteneur du Logo agrandi --}}
        <div class="w-12 h-12 flex items-center justify-center overflow-hidden transform group-hover:scale-105 transition duration-500">
            {{-- Remplacez le chemin 'assets/images/logo.png' par le chemin réel de votre image du logo (image_2.png) --}}
            <img src="{{ asset('assets/images/logo.png') }}" 
                 alt="SANTÉ+ Logo" 
                 class="w-full h-full object-contain">
        </div>
    </a>

    @php
        $user = Auth::user();
        $roleConfig = [
            'patient'    => ['color' => 'black',  'label' => 'Patient'],
            'medecin'    => ['color' => 'indigo', 'label' => 'Médecin'],
            'secretaire' => ['color' => 'sky',    'label' => 'Secrétaire'],
            'admin'      => ['color' => 'blue',   'label' => 'Admin'],
        ];
        
        $config = $roleConfig[$user->role] ?? ['color' => 'blue', 'label' => 'Utilisateur'];
    @endphp

    {{-- Badge de Session Dynamique (Inchangé) --}}
    <div class="flex items-center space-x-3 bg-gradient-to-r from-{{ $config['color'] }}-100/80 to-white px-5 py-2 rounded-2xl border border-{{ $config['color'] }}-200/60 shadow-md">
        <div class="w-2.5 h-2.5 bg-{{ $config['color'] }}-500 rounded-full animate-pulse shadow-lg"></div>
        <span class="text-[11px] font-black uppercase tracking-[0.15em] text-{{ $config['color'] }}-700/60">Espace</span>
        <span class="text-[11px] font-black uppercase tracking-[0.15em] text-{{ $config['color'] }}-700">{{ $config['label'] }}</span>
    </div>
</div>

            {{-- PARTIE DROITE : Actions & Profil --}}
            <div class="flex items-center space-x-4">
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="group flex items-center space-x-3 p-1 pr-3 rounded-2xl hover:bg-blue-50/60 transition-all duration-300 focus:outline-none shadow-sm">
                            {{-- Avatar avec Initiales (Remplace la photo) --}}
                           
                            <div class="flex flex-col text-left hidden md:flex">
                                <span class="text-sm font-bold text-blue-900 leading-tight group-hover:text-{{ $config['color'] }}-600 transition-colors">
                                    {{ $user->name }}
                                </span>
                                <span class="text-[10px] text-{{ $config['color'] }}-500 font-black uppercase tracking-tighter italic">
                                    {{ $config['label'] }} Connecté
                                </span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[11px] text-slate-300 group-hover:text-{{ $config['color'] }}-500 transition-colors ml-1"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-4 border-b border-blue-50 bg-blue-50/60">
                            <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Session active</p>
                            <p class="text-xs font-semibold text-blue-900 truncate">{{ $user->email }}</p>
                        </div>

                        <div class="p-1">
                           
                            <hr class="my-1 border-blue-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-100 transition-colors">
                                    <i class="fa-solid fa-power-off mr-2 opacity-50"></i>{{ __('Déconnexion') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>