@php
    $user = Auth::user();
    // Définition de la couleur d'accentuation selon le rôle pour la cohérence visuelle
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
            <i class="fa-solid fa-user-gear"></i>
        </div>
        <div>
            <h2 class="text-xl font-black text-slate-900 leading-none uppercase tracking-tight">
                {{ __('Informations du Profil') }}
            </h2>
            <p class="mt-2 text-sm text-slate-500 font-medium italic">
                {{ __("Mettez à jour vos coordonnées personnelles et votre identité visuelle.") }}
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Formulaire principal avec support de fichiers OBLIGATOIRE (enctype) --}}
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8 max-w-3xl">
        @csrf
        @method('patch')

  

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- NOM --}}
            <div class="space-y-2">
                <x-input-label for="name" :value="__('Nom complet')" class="ml-1 text-xs font-black uppercase tracking-widest text-slate-400" />
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-{{ $accentColor }}-600 transition-colors">
                        <i class="fa-solid fa-signature text-sm"></i>
                    </div>
                    <x-text-input id="name" name="name" type="text" 
                        class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent focus:bg-white focus:border-{{ $accentColor }}-500 focus:ring-4 focus:ring-{{ $accentColor }}-500/10 rounded-2xl transition-all duration-300 font-medium" 
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            {{-- EMAIL --}}
            <div class="space-y-2">
                <x-input-label for="email" :value="__('Adresse Email')" class="ml-1 text-xs font-black uppercase tracking-widest text-slate-400" />
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-{{ $accentColor }}-600 transition-colors">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </div>
                    <x-text-input id="email" name="email" type="email" 
                        class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent focus:bg-white focus:border-{{ $accentColor }}-500 focus:ring-4 focus:ring-{{ $accentColor }}-500/10 rounded-2xl transition-all duration-300 font-medium" 
                        :value="old('email', $user->email)" required autocomplete="username" />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            {{-- TÉLÉPHONE --}}
            <div class="space-y-2">
                <x-input-label for="telephone" :value="__('Numéro de téléphone')" class="ml-1 text-xs font-black uppercase tracking-widest text-slate-400" />
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-{{ $accentColor }}-600 transition-colors">
                        <i class="fa-solid fa-phone text-sm"></i>
                    </div>
                    <x-text-input id="telephone" name="telephone" type="text" 
                        class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent focus:bg-white focus:border-{{ $accentColor }}-500 focus:ring-4 focus:ring-{{ $accentColor }}-500/10 rounded-2xl transition-all duration-300 font-medium" 
                        :value="old('telephone', $user->telephone)" placeholder="+229 ..." />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
            </div>

            {{-- ADRESSE --}}
            <div class="space-y-2">
                <x-input-label for="adresse" :value="__('Adresse de résidence')" class="ml-1 text-xs font-black uppercase tracking-widest text-slate-400" />
                <div class="relative group">
                    <div class="absolute top-4 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-{{ $accentColor }}-600 transition-colors">
                        <i class="fa-solid fa-location-dot text-sm"></i>
                    </div>
                    <textarea id="adresse" name="adresse" rows="1" 
                        class="block w-full pl-11 pr-4 py-4 bg-slate-50 border-transparent focus:bg-white focus:border-{{ $accentColor }}-500 focus:ring-4 focus:ring-{{ $accentColor }}-500/10 rounded-2xl transition-all duration-300 font-medium resize-none"
                        placeholder="Votre adresse...">{{ old('adresse', $user->adresse) }}</textarea>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
            </div>
        </div>

        {{-- ACTIONS --}}
        <div class="flex flex-col sm:flex-row items-center gap-6 pt-6 border-t border-slate-50">
            <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-{{ $accentColor }}-600 hover:bg-{{ $accentColor }}-700 text-white rounded-2xl shadow-xl shadow-{{ $accentColor }}-100 uppercase tracking-[0.15em] text-[11px] font-black transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i>
                {{ __('Enregistrer les modifications') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)"
                    class="flex items-center gap-2 text-emerald-600 font-black text-xs uppercase tracking-widest">
                    <i class="fa-solid fa-check-double"></i>
                    {{ __('Profil mis à jour avec succès') }}
                </div>
            @endif
        </div>
    </form>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('photo');
        const previewImg = document.getElementById('profile-preview');
        
        if (fileInput && previewImg) {
            fileInput.onchange = evt => {
                const file = fileInput.files[0];
                if (file) {
                    // Création de l'URL temporaire pour la prévisualisation
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            };
        }
    });
</script>