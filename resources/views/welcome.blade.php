<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Santé+ | Solution Digitale pour Cliniques d'Excellence</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .hero-gradient {
            background: radial-gradient(circle at top right, rgba(37, 99, 235, 0.08), transparent),
                        radial-gradient(circle at bottom left, rgba(37, 99, 235, 0.03), transparent);
        }
        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        /* Smooth scroll pour la navigation */
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="font-sans antialiased text-slate-900 bg-white hero-gradient overflow-x-hidden">

    {{-- NAVIGATION PREMIUM --}}
   <nav class="fixed w-full z-50 bg-white backdrop-blur-xl border-b border-slate-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 lg:h-24 items-center py-4">
            
            {{-- ZONE LOGO --}}
            <div class="flex items-center">
                {{-- Lien incluant l'icône et le texte --}}
               {{-- Lien incluant l'icône et le texte --}}
<a href="{{ url('/') }}" class="flex items-center gap-3 lg:gap-4 group no-underline border-none">
    
    {{-- Conteneur de l'Image du Logo --}}
    <div class="w-12 h-12 lg:w-14 lg:h-14 flex items-center justify-center overflow-hidden transform group-hover:scale-105 transition duration-500">
        <img src="{{ asset('assets/images/logo.png') }}" 
             alt="Logo SANTÉ+" 
             class="w-full h-full object-contain">
    </div>

  
</a>
            </div>

            {{-- Menu Desktop --}}
            <div class="hidden lg:flex space-x-10 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                <a href="#hero" class="hover:text-blue-600 transition">Accueil</a>
                <a href="#solutions" class="hover:text-blue-600 transition">Nos Solutions</a>
                <a href="#mission" class="hover:text-blue-600 transition">Expertise</a>
                <a href="#features" class="hover:text-blue-600 transition">Fonctionnalités</a>
            </div>

            {{-- Zone Boutons d'Action --}}
            <div class="flex items-center space-x-3 lg:space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="bg-slate-900 text-white px-5 lg:px-8 py-3 lg:py-4 rounded-xl lg:rounded-2xl text-[10px] lg:text-xs font-black uppercase tracking-widest shadow-xl hover:scale-105 transition">Espace Clinique</a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:block text-slate-600 text-[11px] font-black uppercase tracking-widest hover:text-blue-600 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 lg:px-8 py-3 lg:py-4 rounded-xl lg:rounded-2xl text-[10px] lg:text-xs font-black uppercase tracking-widest hover:bg-blue-700 transition shadow-lg shadow-blue-200">Prendre RDV</a>
                @endauth
            </div>
            
        </div>
    </div>
</nav>

    {{-- HERO SECTION --}}
    <section id="hero" class="relative min-h-screen flex items-center pt-24 lg:pt-32 pb-16 overflow-hidden">
        {{-- Vidéo en Arrière-plan de la section --}}
        <div class="absolute inset-0 w-full h-full -z-10">
            <video autoplay muted loop playsinline class="w-full h-full object-cover brightness-90">
                <source src="{{ asset('assets/videos/vid2.mp4') }}" type="video/mp4">
            </video>
            {{-- Overlay pour assombrir légèrement et rendre le texte plus lisible --}}
    <div class="fixed inset-0 bg-gradient-to-tr from-slate-900/80 via-transparent to-blue-900/80 -z-10"></div>
        </div>

        <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-24">
              {{-- Colonne Texte --}}
<div class="flex-1 text-left"> {{-- Forcé à gauche --}}
    
    {{-- Titre --}}
    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white drop-shadow-lg leading-[1.1] lg:leading-[0.95] mb-8 lg:mb-10" data-aos="fade-up" data-aos-delay="100">
        Modernisez la gestion de votre <br>
        <span class="text-blue-400 rounded" data-aos="fade-up" data-aos-delay="300">établissement de santé.</span>
    </h1>

    {{-- Paragraphe : supprimé mx-auto pour qu'il reste collé à gauche --}}
    <p class="text-lg lg:text-xl text-slate-100 max-w-xl leading-relaxed font-medium mb-10 lg:mb-12 drop-shadow" data-aos="fade-right" data-aos-delay="500">
        Optimisez la gestion de vos patients et la productivité de vos praticiens avec une interface conçue pour l'excellence médicale.
    </p>

    {{-- Conteneur Boutons : items-start pour aligner les boutons à gauche sur mobile --}}
    <div class="flex flex-col sm:flex-row items-start justify-start gap-4 lg:gap-6">
        
        {{-- Bouton Prendre RDV --}}
        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 lg:px-12 py-5 lg:py-6 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl lg:rounded-3xl hover:-translate-y-1 transition-all uppercase tracking-widest text-[10px] lg:text-xs flex items-center justify-center gap-3">
            <i class="fa-solid fa-calendar-check text-sm"></i>
            Prendre RDV
        </a>

        {{-- Bouton Connexion --}}
        <a href="{{ route('login') }}" class="w-full sm:w-auto flex items-center justify-center gap-4 px-10 py-5 bg-white backdrop-blur-md rounded-2xl lg:rounded-3xl border border-slate-100 shadow-sm hover:bg-white transition group">
            <i class="fa-solid fa-user-lock text-blue-600 text-lg group-hover:scale-110 transition"></i>
            <span class="text-[10px] font-black uppercase tracking-widest text-slate-700">Connexion</span>
        </a>
        
    </div>
</div>
            
            </div>
        </div>
    </section>

    {{-- SECTION ARGUMENTS --}}
    <section id="solutions" class="py-20 lg:py-24 bg-white w-full overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            {{-- Titre de la section --}}
            <div class="text-center max-w-4xl mx-auto mb-16 lg:mb-24" data-aos="fade-down">
                <h2 class="text-3xl lg:text-5xl font-black text-slate-900  mb-6 leading-tight uppercase">
                    Pourquoi choisir <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Santé+</span> ?
                </h2>
                <div class="w-20 lg:w-24 h-2 bg-blue-600 mx-auto mb-6"></div>
                <p class="text-base lg:text-lg text-slate-500 font-medium max-w-2xl mx-auto">
                    La solution de référence pour moderniser la gestion hospitalière et optimiser le parcours de soin au Bénin.
                </p>
            </div>

            {{-- LIGNE 1 : IMAGE GAUCHE + 4 ARGUMENTS --}}
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-24 mb-24 lg:mb-40">
                <div class="w-full lg:w-[45%] flex-shrink-0" data-aos="fade-right">
                    <img src="{{ asset('assets/images/img3.jpg') }}" 
                        alt="Gestion Santé+" 
                        class="w-full h-[350px] lg:h-[550px] object-cover rounded-3xl ">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 lg:gap-x-12 gap-y-12 lg:gap-y-16 w-full" data-aos="fade-left">
                    @foreach([
                        ['n'=>'01', 't'=>'Rentabilité', 'd'=>'Réduction des rendez-vous non honorés via rappels automatiques.'],
                        ['n'=>'02', 't'=>'Sécurité', 'd'=>'Chiffrement total conforme aux normes de santé en vigueur.'],
                        ['n'=>'03', 't'=>'Rapidité', 'd'=>'Accès instantané au dossier patient en moins de 2 secondes.'],
                        ['n'=>'04', 't'=>'Suivi', 'd'=>'Historique complet des consultations et prescriptions archivé.']
                    ] as $arg)
                    <div class="space-y-3 lg:space-y-4 text-center sm:text-left">
                        <div class="text-blue-600 font-black text-3xl lg:text-4xl mb-2">{{ $arg['n'] }}</div>
                        <h4 class="font-black text-slate-900 uppercase text-lg lg:text-2xl tracking-tight">{{ $arg['t'] }}</h4>
                        <p class="text-slate-500 text-base lg:text-xl leading-relaxed">{{ $arg['d'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- LIGNE 2 : IMAGE DROITE + 4 ARGUMENTS --}}
            <div class="flex flex-col flex-col-reverse lg:flex-row-reverse items-center gap-12 lg:gap-24">
                <div class="w-full lg:w-[45%] flex-shrink-0" data-aos="fade-left">
                    <img src="{{ asset('assets/images/img4.jpg') }}" 
                        alt="Soin Patient" 
                        class="w-full h-[350px] lg:h-[550px] object-cover rounded-3xl ">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 lg:gap-x-12 gap-y-12 lg:gap-y-16 w-full" data-aos="fade-right">
                    @foreach([
                        ['n'=>'05', 't'=>'Fidélisation', 'd'=>'Améliorez l\'expérience globale pour garder vos patients.'],
                        ['n'=>'06', 't'=>'Mobilité', 'd'=>'Interface responsive accessible sur tablette et mobile.'],
                        ['n'=>'07', 't'=>'Analyse', 'd'=>'Statistiques précises sur l\'activité de votre clinique.'],
                        ['n'=>'08', 't'=>'Support', 'd'=>'Assistance technique disponible 24h/24 au Bénin.']
                    ] as $arg)
                    <div class="space-y-3 lg:space-y-4 text-center sm:text-left">
                        <div class="text-indigo-600 font-black text-3xl lg:text-4xl mb-2">{{ $arg['n'] }}</div>
                        <h4 class="font-black text-slate-900 uppercase text-lg lg:text-2xl tracking-tight">{{ $arg['t'] }}</h4>
                        <p class="text-slate-500 text-base lg:text-xl leading-relaxed">{{ $arg['d'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION MISSION --}}
  <section id="mission" class="py-20 lg:py-24 bg-slate-50 w-full overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 mb-20 lg:mb-24">
            
            {{-- Conteneur Image équilibré --}}
            <div class="w-full lg:w-[45%] group flex justify-center lg:justify-start" data-aos="fade-right">
                <div class="relative transition-transform duration-700 ease-in-out group-hover:scale-105 w-full flex justify-center items-center">
                    
                    {{-- Hauteur ajustée à 600px pour un meilleur impact visuel --}}
                    <img src="{{ asset('assets/images/pexels-taiyesalawu-36450260.jpg') }}" 
                         alt="Interface Santé+" 
                         class="w-full lg:w-auto h-auto max-h-[400px] sm:max-h-[500px] lg:max-h-[600px] rounded-[2.5rem] shadow-2xl animate-float object-cover border-[12px] border-white">
                    
                    {{-- Lueur d'arrière-plan plus diffuse --}}
                    <div class="absolute -z-10 inset-0 bg-blue-500/10 blur-[100px] rounded-full scale-90 group-hover:scale-110 transition-transform duration-700"></div>
                </div>
            </div>

            {{-- Colonne Texte --}}
            <div class="w-full lg:w-[55%] space-y-6 lg:space-y-8 text-center lg:text-left" data-aos="fade-left">
                <div class="inline-block px-4 py-2 bg-white shadow-sm border border-blue-100 ">
                    <span class="text-blue-600 text-xs lg:text-sm rounded-sm font-black uppercase tracking-[0.2em]">Notre Mision</span>
                </div>
                
                <h2 class="text-4xl lg:text-5xl font-black text-[#003366] leading-[1.1] uppercase">
                    Une mission claire : <br>
                    <span class="text-blue-600">Révolutionner les soins</span>
                </h2>

                <div class="space-y-6 text-base lg:text-xl text-slate-600 leading-relaxed text-justify">
                    <p>
                        <span class="font-bold text-slate-900">Santé+</span> a été conçu pour répondre aux défis majeurs de la gestion hospitalière dans vos établissements.
                         Notre objectif est de fournir une solution digitale complète qui optimise les processus, améliore la communication et 
                         garantit la sécurité
                    </p>
                    <p>
                        Notre plateforme est une <span class="font-bold text-slate-900">suite d'outils digitaux</span> qui simplifie l'organisation afin de réduire les coûts de gestion.
                    </p>
                    <p>
                        Aujourd'hui, nous accompagnons les professionnels pour améliorer la satisfaction des patients à travers tout le pays.
                    </p>
                </div>
            </div>
        </div>

        {{-- Points Clés --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12 border-t border-slate-200 pt-16">
            @foreach([
                ['n' => '1', 't' => 'Simplifier le parcours de soins'],
                ['n' => '2', 't' => 'Accroître les collaborations'],
                ['n' => '3', 't' => 'Améliorer la qualité des soins']
            ] as $key => $point)
            <div class="group text-center space-y-6 p-8 rounded-[2rem] transition-all duration-500 hover:bg-white hover:shadow-2xl hover:shadow-blue-900/5" 
                data-aos="zoom-in" data-aos-delay="{{ 100 * ($key + 1) }}">
                <div class="relative inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-slate-50 border-2 border-slate-900 text-2xl font-black text-slate-900 group-hover:bg-blue-600 group-hover:border-blue-600 group-hover:text-white transition-all duration-500 shadow-sm">
                    {{ $point['n'] }}
                </div>
                <h3 class="text-lg lg:text-xl font-black text-[#003366] leading-snug uppercase tracking-tighter transition-colors">
                    {{ $point['t'] }}
                </h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

    {{-- SECTION FONCTIONNALITÉS --}}
    <section id="features" class="py-20 lg:py-24 bg-white w-full overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="text-center max-w-3xl mx-auto mb-16 lg:mb-20" data-aos="fade-down">
                <h2 class="text-2xl lg:text-4xl font-black text-slate-900 leading-tight uppercase tracking-tighter">
                    Une architecture pensée pour <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">l'efficacité opérationnelle</span>
                </h2>
                <div class="w-20 lg:w-24 h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 mx-auto mt-6 lg:mt-8 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach([
                    ['i'=>'fa-calendar-plus', 'c'=>'blue', 't'=>'Gestion des Consultations', 'd'=>'Planification intelligente par spécialité pour un flux patient optimisé.'],
                    ['i'=>'fa-filter', 'c'=>'indigo', 't'=>'Recherche & Filtres', 'd'=>'Moteur multicritères ultra-rapide pour un accès instantané aux dossiers.'],
                    ['i'=>'fa-envelope-circle-check', 'c'=>'emerald', 't'=>'Rappels par Email', 'd'=>'Automatisation des relances à 24h pour réduire les absences.'],
                    ['i'=>'fa-comments', 'c'=>'orange', 't'=>'Messagerie Interne', 'd'=>'Espace collaboratif sécurisé facilitant la coordination des équipes.'],
                    ['i'=>'fa-folder-tree', 'c'=>'red', 't'=>'Traçabilité des Soins', 'd'=>'Historique chronologique complet garantissant un suivi patient sans perte.'],
                    ['i'=>'fa-user-shield', 'c'=>'slate-900', 't'=>'Gestion des Rôles', 'd'=>'Contrôle d\'accès granulaire assurant le secret médical absolu.']
                ] as $feat)
                <div class="group relative bg-white p-8 lg:p-10 rounded-3xl border border-slate-100 transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl" data-aos="fade-up">
                    <div class="w-12 lg:w-14 h-12 lg:h-14 bg-{{ $feat['c'] == 'slate-900' ? 'slate-900' : $feat['c'].'-50' }} text-{{ $feat['c'] == 'slate-900' ? 'white' : $feat['c'].'-600' }} rounded-2xl flex items-center justify-center mb-6 lg:mb-8 group-hover:scale-110 transition-all duration-500 shadow-sm">
                        <i class="fa-solid {{ $feat['i'] }} text-xl lg:text-2xl"></i>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-black text-slate-900 mb-4 tracking-tight group-hover:text-blue-600 transition-colors uppercase">{{ $feat['t'] }}</h3>
                    <p class="text-slate-500 leading-relaxed text-base lg:text-lg">
                        {{ $feat['d'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

{{-- FOOTER --}}
<footer class="bg-slate-900 pt-16 lg:pt-20 pb-10 w-full overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16 mb-16">
            
            {{-- Branding avec Logo --}}
            <div class="space-y-8 text-center md:text-left">
                <div class="flex flex-col items-center md:items-start gap-5">
                    
                    {{-- Logo Image (WhatsApp Image 2026-03-21) --}}
                    <div class="relative w-16 h-16 lg:w-20 lg:h-20 rounded-2xl overflow-hidden shadow-2xl shadow-blue-500/10">
                        <img src="{{ asset('assets/images/logo.png') }}" 
                             alt="SANTÉ+ Logo" 
                             class="w-full h-full object-cover">
                    </div>
                    
            
                </div>

                <p class="text-slate-400 leading-relaxed text-sm max-w-sm mx-auto md:mx-0">
                    La première suite logicielle hospitalière 100% béninoise conçue pour l'excellence opérationnelle.
                </p>

                <div class="flex justify-center md:justify-start gap-4">
                    @foreach(['instagram', 'linkedin-in', 'facebook-f'] as $social)
                    <a href="#" class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-white hover:bg-blue-600 transition-all duration-300 group">
                        <i class="fa-brands fa-{{ $social }} text-sm group-hover:scale-110 transition-transform"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Navigation --}}
            <div class="text-center md:text-left">
                <h4 class="text-white font-black uppercase tracking-widest text-xs mb-6 lg:mb-8 italic border-b lg:border-b-0 lg:border-l-2 border-blue-500 pb-2 lg:pb-0 lg:pl-4">Navigation</h4>
                <ul class="space-y-3 lg:space-y-4">
                    <li><a href="#hero" class="text-slate-400 hover:text-blue-500 transition-all text-sm font-medium">Accueil</a></li>
                    <li><a href="#mission" class="text-slate-400 hover:text-blue-500 transition-all text-sm font-medium">Notre Mission</a></li>
                    <li><a href="#features" class="text-slate-400 hover:text-blue-500 transition-all text-sm font-medium">Fonctionnalités</a></li>
                    <li><a href="#" class="text-slate-400 hover:text-blue-500 transition-all text-sm font-medium">Support Technique</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div class="text-center md:text-left">
                <h4 class="text-white font-black uppercase tracking-widest text-xs mb-6 lg:mb-8 italic border-b lg:border-b-0 lg:border-l-2 border-blue-500 pb-2 lg:pb-0 lg:pl-4">Contact Bénin</h4>
                <ul class="space-y-4 lg:space-y-6 text-sm">
                    <li class="flex items-center md:items-start justify-center md:justify-start gap-4 text-slate-400">
                        <i class="fa-solid fa-location-dot text-blue-500 mt-1"></i>
                        <span>Cotonou, République du Bénin</span>
                    </li>
                    <li class="flex items-center justify-center md:justify-start gap-4 text-slate-400">
                        <i class="fa-solid fa-envelope text-blue-500"></i>
                        <span>contact@sante-plus.bj</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright Bar --}}
        <div class="pt-8 lg:pt-10 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-[9px] lg:text-[10px] text-slate-600 font-black uppercase tracking-[0.3em] text-center">
                © 2026 SANTÉ+ • TOUS DROITS RÉSERVÉS
            </div>
            <div class="flex items-center gap-4 lg:gap-8">
                <a href="#" class="text-[9px] lg:text-[10px] text-slate-600 hover:text-white font-black uppercase tracking-widest transition-colors">Politique</a>
                <a href="#" class="text-[9px] lg:text-[10px] text-slate-600 hover:text-white font-black uppercase tracking-widest transition-colors">Conditions</a>
            </div>
        </div>
    </div>
</footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            disable: 'mobile' // Optionnel : désactiver sur mobile si les perfs sont basses, mais ici c'est fluide
        });
    </script>
</body>
</html>