<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Santé+ | Authentification</title>

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800;900&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Montserrat', sans-serif !important; }
</style>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        
      

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            
            {{-- On affiche le slot qui contient ta "glass-card" --}}
            <div class="w-full flex justify-center px-4">
                {{ $slot }}
            </div>

        </div>


     <script>
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.querySelector('.video-background');
        
        if (video) {
            // Définit la vitesse à 25% de la vitesse normale (très lent)
            video.playbackRate = 0.5;

            // Sécurité : s'assure que la vitesse reste la même après un loop
            video.addEventListener('play', function() {
                video.playbackRate = 0.5;
            });
        }
    });
</script>
    </body>
</html>