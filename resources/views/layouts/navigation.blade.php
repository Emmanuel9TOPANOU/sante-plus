<nav x-data="{ open: false }" class="bg-white backdrop-blur-xl border-b border-slate-100 sticky top-0 z-40 shadow-sm">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            {{-- PARTIE GAUCHE : Branding & Espace Rôle --}}
            <div class="flex items-center">
                <div class="flex items-center gap-2 mr-8">
                    <span class="text-xl font-black text-slate-800 tracking-tight hidden sm:block">Santé<span class="text-blue-500">+</span></span>
                </div>

                @php
                    $user = Auth::user();
                    $roleConfig = [
                        'patient'    => ['color' => 'black', 'label' => 'Patient'],
                        'medecin'    => ['color' => 'indigo',  'label' => 'Médecin'],
                        'secretaire' => ['color' => 'sky',     'label' => 'Secrétaire'],
                        'admin'      => ['color' => 'blue',    'label' => 'Admin'],
                    ];
                    
                    $config = $roleConfig[$user->role] ?? ['color' => 'blue', 'label' => 'Utilisateur'];
                @endphp

                {{-- Badge de Session Dynamique --}}
                <div class="flex items-center space-x-3 bg-{{ $config['color'] }}-50/80 px-4 py-2 rounded-xl border border-{{ $config['color'] }}-100/50 transition-all">
                    <div class="w-2 h-2 bg-{{ $config['color'] }}-500 rounded-full animate-pulse shadow-sm"></div>
                    <span class="text-[10px] font-black uppercase tracking-[0.15em] text-{{ $config['color'] }}-900/40">Espace</span>
                    <span class="text-[10px] font-black uppercase tracking-[0.15em] text-{{ $config['color'] }}-600">{{ $config['label'] }}</span>
                </div>
            </div>

            {{-- PARTIE DROITE : Actions & Profil --}}
            <div class="flex items-center space-x-4">
                <x-dropdown align="right" width="64">
                    <x-slot name="trigger">
                        <button class="group flex items-center space-x-3 p-1 pr-3 rounded-2xl hover:bg-slate-50 transition-all duration-300 focus:outline-none">
                            
                            {{-- Avatar avec Initiales (Remplace la photo) --}}
                            <div class="w-10 h-10 rounded-xl overflow-hidden shadow-md shadow-{{ $config['color'] }}-100 ring-2 ring-white bg-gradient-to-br from-{{ $config['color'] }}-400 to-{{ $config['color'] }}-600 flex items-center justify-center transition-transform group-hover:scale-105 duration-300">
                                <span class="text-blue font-black text-sm tracking-tighter">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}{{ strtoupper(substr(strrchr($user->name, " "), 1, 1)) ?: '' }}
                                </span>
                            </div>

                            <div class="flex flex-col text-left hidden md:flex">
                                <span class="text-xs font-bold text-slate-800 leading-tight group-hover:text-{{ $config['color'] }}-600 transition-colors">
                                    {{ $user->name }}
                                </span>
                                <span class="text-[9px] text-{{ $config['color'] }}-500 font-black uppercase tracking-tighter italic">
                                    {{ $config['label'] }} Connecté
                                </span>
                            </div>
                            
                            <i class="fa-solid fa-chevron-down text-[10px] text-slate-300 group-hover:text-{{ $config['color'] }}-500 transition-colors ml-1"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="p-4 border-b border-slate-50 bg-slate-50/50">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Session active</p>
                            <p class="text-xs font-semibold text-slate-700 truncate">{{ $user->email }}</p>
                        </div>

                        <div class="p-1">
                            <x-dropdown-link :href="route('profile.edit')" class="rounded-lg text-xs font-semibold text-slate-600 hover:bg-{{ $config['color'] }}-50">
                                <i class="fa-solid fa-circle-user mr-2 opacity-50"></i>{{ __('Mon Profil') }}
                            </x-dropdown-link>
                            
                            <hr class="my-1 border-slate-50">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" 
                                    onclick="event.preventDefault(); this.closest('form').submit();" 
                                    class="rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-50 transition-colors">
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