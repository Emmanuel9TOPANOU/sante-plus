@php
    $user = Auth::user();
    // Cohérence avec le rôle pour le design Premium
    $accentColor = match($user->role) {
        'admin'      => 'blue',
        'medecin'    => 'indigo',
        'patient'    => 'emerald',
        'secretaire' => 'sky',
        default      => 'blue',
    };
@endphp

<section class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm transition-all duration-500 hover:shadow-xl hover:shadow-slate-200/50">
    <header class="flex items-center gap-4 mb-10">
        <div class="w-12 h-12 bg-{{ $accentColor }}-50 text-{{ $accentColor }}-600 rounded-2xl flex items-center justify-center text-xl shadow-sm transition-colors duration-500">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <div>
            <h2 class="text-xl font-black text-slate-900 leading-none uppercase tracking-tight">
                {{ __('Sécurité du Compte') }}
            </h2>
            <p class="mt-2 text-sm text-slate-500 font-medium italic">
                {{ __("Utilisez un mot de passe complexe pour protéger vos accès.") }}
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-8 max-w-3xl">
        @csrf
        @method('put')

        {{-- MOT DE PASSE ACTUEL --}}
        <div class="space-y-2">
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" class="ml-1 text-xs font-black uppercase tracking-widest text-slate-400" />
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-{{ $accentColor }}-600 transition-colors">
                    <i class="fa-solid fa-lock text-sm"></i>
                </div>
                <x-text-input id="update_password_current_password" name="current_password" type="password" 
                    class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent focus:bg-white focus:border-{{ $accentColor }}-500 focus:ring-4 focus:ring-{{ $accentColor }}-500/10 rounded-2xl transition-all duration-300 placeholder-slate-300 font-medium" 
                    autocomplete="current-password" 
                    placeholder="Tapez votre mot de passe actuel" />
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs font-bold" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- NOUVEAU MOT DE PASSE --}}
            <div class="space-y-2">
                <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" class="ml-1 text-xs font-black uppercase tracking-widest text-slate-400" />
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-{{ $accentColor }}-600 transition-colors">
                        <i class="fa-solid fa-key text-sm"></i>
                    </div>
                    <x-text-input id="update_password_password" name="password" type="password" 
                        class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent focus:bg-white focus:border-{{ $accentColor }}-500 focus:ring-4 focus:ring-{{ $accentColor }}-500/10 rounded-2xl transition-all duration-300 placeholder-slate-300 font-medium" 
                        autocomplete="new-password" 
                        placeholder="Nouveau" />
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs font-bold" />
            </div>

            {{-- CONFIRMATION --}}
            <div class="space-y-2">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" class="ml-1 text-xs font-black uppercase tracking-widest text-slate-400" />
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-{{ $accentColor }}-600 transition-colors">
                        <i class="fa-solid fa-check-double text-sm"></i>
                    </div>
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                        class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent focus:bg-white focus:border-{{ $accentColor }}-500 focus:ring-4 focus:ring-{{ $accentColor }}-500/10 rounded-2xl transition-all duration-300 placeholder-slate-300 font-medium" 
                        autocomplete="new-password" 
                        placeholder="Répétez le mot de passe" />
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs font-bold" />
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="flex flex-col sm:flex-row items-center gap-6 pt-6 border-t border-slate-50">
            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-{{ $accentColor }}-600 hover:bg-{{ $accentColor }}-700 text-white rounded-2xl shadow-xl shadow-{{ $accentColor }}-100 uppercase tracking-[0.15em] text-[11px] font-black transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                <i class="fa-solid fa-arrows-rotate"></i>
                {{ __('Mettre à jour la sécurité') }}
            </button>

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-init="setTimeout(() => show = false, 4000)"
                    class="flex items-center gap-2 text-emerald-600 font-black text-xs uppercase tracking-widest"
                >
                    <i class="fa-solid fa-circle-check"></i>
                    {{ __('Sécurité mise à jour') }}
                </div>
            @endif
        </div>
    </form>
</section>