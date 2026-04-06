<x-app-layout>
    <x-slot name="header">
        @php
            // Logique de redirection et style selon le rôle
            $userRole = Auth::user()->role;
            
            $dashboardConfig = match($userRole) {
                'admin'      => ['route' => route('admin.dashboard'), 'label' => 'Admin Panel', 'color' => 'blue'],
                'medecin'    => ['route' => route('doctor.dashboard'), 'label' => 'Espace Médecin', 'color' => 'indigo'],
                'patient'    => ['route' => route('patient.dashboard'), 'label' => 'Mon Espace Santé', 'color' => 'sky'],
                'secretaire' => ['route' => route('secretaire.dashboard'), 'label' => 'Secrétariat', 'color' => 'blue'],
                default      => ['route' => route('dashboard'), 'label' => 'Dashboard', 'color' => 'slate'],
            };
        @endphp

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 leading-tight uppercase tracking-tight">
                    {{ __('Gestion du Profil') }}
                </h2>
                <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">
                    {{ $dashboardConfig['label'] }} — {{ Auth::user()->name }}
                </p>
            </div>
            
            {{-- Bouton Retour Dynamique --}}
            <a href="{{ $dashboardConfig['route'] }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-slate-50 hover:text-{{ $dashboardConfig['color'] }}-600 transition-all shadow-sm hover:shadow-md active:scale-95">
                <i class="fa-solid fa-arrow-left-long"></i>
                {{ __('Quitter les paramètres') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            {{-- Section : Informations Personnelles (Photo, Tel, Adresse) --}}
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-[3rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Section : Sécurité (Mot de passe) --}}
            <div class="relative">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Section : Zone de danger (Suppression) --}}
            <div class="mt-16 pt-8 border-t border-slate-200">
                <div class="bg-rose-50/30  border border-rose-100/50 overflow-hidden">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>