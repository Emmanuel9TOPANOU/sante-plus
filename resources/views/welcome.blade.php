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
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-xl border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 lg:h-22 items-center py-4">
                <div class="flex items-center">
                    <a href="#" class="text-xl lg:text-2xl font-black text-blue-600 tracking-tighter italic">
                        SANTÉ<span class="text-slate-800">+</span>
                    </a>
                </div>

                {{-- Menu Desktop --}}
                <div class="hidden lg:flex space-x-10 text-[11px] font-black text-slate-500 uppercase tracking-widest">
                    <a href="#hero" class="hover:text-blue-600 transition">Accueil</a>
                    <a href="#solutions" class="hover:text-blue-600 transition">Nos Solutions</a>
                    <a href="#mission" class="hover:text-blue-600 transition">Expertise</a>
                    <a href="#features" class="hover:text-blue-600 transition">Fonctionnalités</a>
                </div>

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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-24">
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 leading-[1.1] lg:leading-[0.95] tracking-tighter mb-8 lg:mb-10" data-aos="fade-up" data-aos-delay="100">
                        Modernisez la gestion de votre <br>
                        <span class="text-blue-600" data-aos="fade-up" data-aos-delay="300">établissement de santé.</span>
                    </h1>
                    <p class="text-lg lg:text-xl text-slate-500 max-w-xl mx-auto lg:mx-0 leading-relaxed font-medium mb-10 lg:mb-12" data-aos="fade-right" data-aos-delay="500">
                        Optimisez la gestion de vos patients et la productivité de vos praticiens avec une interface conçue pour l'excellence médicale au Bénin.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 lg:gap-6">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 lg:px-12 py-5 lg:py-6 bg-blue-600 text-white font-black rounded-2xl lg:rounded-3xl shadow-2xl shadow-blue-200 hover:-translate-y-1 transition-all uppercase tracking-widest text-[10px] lg:text-xs flex items-center justify-center gap-3">
                            <i class="fa-solid fa-calendar-check text-sm"></i>
                            Prendre RDV
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto flex items-center justify-center gap-4 px-10 py-5 bg-white rounded-2xl lg:rounded-3xl border border-slate-100 shadow-sm hover:bg-slate-50 transition group">
                            <i class="fa-solid fa-user-lock text-blue-600 text-lg group-hover:scale-110 transition"></i>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">Connexion</span>
                        </a>
                    </div>
                </div>

                <div class="flex-1 relative animate-float w-full max-w-2xl lg:max-w-none">
                    <div class="rounded-3xl lg:rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white">
                        <img src="{{ asset('assets/images/pexels-vidalbalielojrfotografia-3376799.jpg') }}" 
                        alt="Interface Santé+ pour Cliniques" 
                        class="w-full h-[300px] sm:h-[450px] lg:h-full object-cover">
                    </div>
                    {{-- Badge Performance --}}
                    <div class="absolute -top-6 lg:-top-10 -right-4 lg:-right-10 bg-blue-600 text-white p-6 lg:p-10 rounded-3xl lg:rounded-[3.5rem] shadow-2xl z-20">
                        <p class="text-2xl lg:text-4xl font-black mb-1">98%</p>
                        <p class="text-[8px] lg:text-[9px] font-black uppercase tracking-widest opacity-80">Satisfaction Gestion</p>
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
                <h2 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tighter mb-6 leading-tight uppercase">
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
                    <img src="{{ asset('assets/images/pexels-tima-miroshnichenko-5355927.jpg') }}" 
                        alt="Gestion Santé+" 
                        class="w-full h-[350px] lg:h-[550px] object-cover rounded-3xl shadow-2xl">
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
                    <img src="{{ asset('assets/images/pexels-cottonbro-7579836.jpg') }}" 
                        alt="Soin Patient" 
                        class="w-full h-[350px] lg:h-[550px] object-cover rounded-3xl shadow-2xl">
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
                <div class="w-full lg:w-[42%] group" data-aos="fade-right">
                    <div class="relative transition-transform duration-700 ease-in-out group-hover:scale-105">
                        <img src="{{ asset('assets/images/pexels-taiyesalawu-36450260.jpg') }}" 
                            alt="Interface Santé+" 
                            class="w-full h-auto rounded-3xl drop-shadow-2xl animate-float">
                        <div class="absolute -z-10 inset-0 bg-blue-400/10 blur-3xl rounded-full scale-75 group-hover:scale-110 transition-transform duration-700"></div>
                    </div>
                </div>

                <div class="w-full lg:w-[58%] space-y-6 lg:space-y-8 text-center lg:text-left" data-aos="fade-left">
                    <div class="inline-block px-4 py-1.5 bg-blue-50 border border-blue-100 rounded-full">
                        <span class="text-blue-600 text-xs lg:text-sm font-bold uppercase tracking-widest italic">Notre Vision</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-black text-[#003366] leading-tight uppercase">
                        Une mission claire : <br>
                        <span class="relative inline-block text-blue-600 group">
                            Révolutionner l'accès aux soins
                        </span>
                    </h2>
                    <div class="space-y-6 text-base lg:text-lg text-slate-600 leading-relaxed lg:text-justify">
                        <p><span class="font-bold text-slate-900">Santé+</span> a été conçu pour répondre aux défis majeurs de la gestion hospitalière au <span class="text-blue-600 font-semibold">Bénin</span>.</p>
                        <p>Notre plateforme est une <span class="font-bold text-slate-900">suite d'outils digitaux</span> qui simplifie l'organisation afin de réduire les coûts de gestion.</p>
                        <p>Aujourd'hui, nous accompagnons les professionnels pour améliorer la satisfaction des patients à travers tout le pays.</p>
                    </div>
                </div>
            </div>

            {{-- 3 Points Clés --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12 border-t border-slate-200 pt-16">
                @foreach([
                    ['n' => '1', 't' => 'Simplifier le parcours de soins'],
                    ['n' => '2', 't' => 'Accroître les collaborations'],
                    ['n' => '3', 't' => 'Améliorer la qualité des soins']
                ] as $key => $point)
                <div class="group text-center space-y-4 lg:space-y-6 p-6 rounded-2xl transition-all duration-300 hover:bg-white hover:shadow-xl" 
                    data-aos="zoom-in" data-aos-delay="{{ 100 * ($key + 1) }}">
                    <div class="relative inline-flex items-center justify-center w-12 lg:w-14 h-12 lg:h-14 rounded-full border-2 border-slate-900 text-xl lg:text-2xl font-black text-slate-900 group-hover:bg-slate-900 group-hover:text-white transition-all duration-500 transform group-hover:rotate-[360deg]">
                        {{ $point['n'] }}
                    </div>
                    <h3 class="text-base lg:text-xl font-bold text-[#003366] leading-snug uppercase tracking-tighter group-hover:text-blue-600 transition-colors">
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
                {{-- Branding --}}
                <div class="space-y-6 text-center md:text-left">
                    <h3 class="text-2xl lg:text-3xl font-black text-white italic tracking-tighter">
                        SANTÉ<span class="text-blue-500">+</span>
                    </h3>
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