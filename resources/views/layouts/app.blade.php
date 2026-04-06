<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    {{-- Le jeton CSRF est déjà ici, c'est l'emplacement idéal --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Correction : On utilise strip_tags pour éviter d'afficher du code HTML dans l'onglet --}}
    <title>{{ config('app.name', 'Santé+') }} | {{ isset($header) ? strip_tags($header) : 'Gestion Clinique' }}</title>

    <link rel="icon" type="image/png" href="{{ asset('logo-sante-plus.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
        .alert-fade-out { opacity: 0; transform: translateY(-20px) scale(0.95); transition: all 0.5s ease-in-out; }
    </style>
</head>
<body class="antialiased text-slate-900 bg-[#F8FAFC]"> 
    
    {{-- NOTIFICATION AUTO-SUPPRIMABLE --}}
    @if(session('success'))
        <div id="success-alert" class="fixed top-6 right-6 z-[100] transform transition-all duration-500 ease-out">
            <div class="bg-slate-900 text-white px-6 py-4 rounded-[2rem] shadow-2xl flex items-center space-x-4 border border-blue-500/30 backdrop-blur-xl">
                <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-500/40">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-400">Système</p>
                    <p class="text-sm font-bold tracking-tight text-slate-100">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="min-h-screen relative z-10">
        @include('layouts.navigation')

        {{-- Affichage du header uniquement s'il contient du texte --}}
        @isset($header)
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endisset

        <main>
            <div class="mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.add('alert-fade-out');
                    setTimeout(() => {
                        alert.remove();
                    }, 500); 
                }, 3000);
            }
        });
    </script>
</body>
</html>