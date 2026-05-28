<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<div x-data="{ mobileMenuOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-100 to-white font-sans antialiased">

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        
        .glass-effect { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); }
        [x-cloak] { display: none !important; }
        
        .nav-item {
            transition: all 0.2s ease;
            position: relative;
        }
        .nav-item:hover {
            transform: translateY(-2px);
        }
        .nav-item.active {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2), 0 4px 6px -2px rgba(37, 99, 235, 0.1);
        }
        .nav-item.active svg {
            color: white;
        }
        
        .agenda-row {
            transition: all 0.2s ease;
        }
        .agenda-row:hover {
            background-color: rgba(37, 99, 235, 0.04);
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .animate-pulse-slow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>

    
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden" x-cloak>
    </div>

    
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg border-b border-slate-100 z-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex justify-between items-center h-20">
                
                
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                        <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo MonEspaceSanté" class="w-full h-full object-contain">
                    </div>
                </div>

                
                <div class="hidden lg:flex items-center gap-1">
                    <a href="<?php echo e(route('doctor.dashboard')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.dashboard') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="<?php echo e(route('doctor.patients.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.patients*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Patients
                    </a>

                    <a href="<?php echo e(route('doctor.rendezvous.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.rendezvous*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Agenda
                    </a>

                    <a href="<?php echo e(route('doctor.analyses.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.analyses*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        Analyses
                    </a>

                 

                    <a href="<?php echo e(route('doctor.availabilities.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.availabilities*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Horaires
                    </a>

                    <a href="<?php echo e(route('doctor.messages.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.messages*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Messages
                    </a>
                </div>

                
                <div class="flex items-center gap-4">
                    <?php if(auth()->guard()->check()): ?>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-red-700 transition-all duration-300 shadow-md cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="hidden sm:inline">Déconnexion</span>
                            </button>
                        </form>
                    <?php endif; ?>

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-700 hover:bg-slate-100 rounded-xl transition-all">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        
        <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="lg:hidden bg-white border-t border-slate-100 px-4 py-4 space-y-2 shadow-xl">
            <a href="<?php echo e(route('doctor.dashboard')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Dashboard</a>
            <a href="<?php echo e(route('doctor.patients.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.patients*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Mes Patients</a>
            <a href="<?php echo e(route('doctor.rendezvous.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.rendezvous*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Agenda</a>
            <a href="<?php echo e(route('doctor.analyses.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.analyses*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Analyses</a>
            <a href="<?php echo e(route('doctor.availabilities.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.availabilities*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Mes Horaires</a>
            <a href="<?php echo e(route('doctor.messages.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Messagerie</a>
        </div>
    </nav>

    
    <main class="flex-1 p-4 md:p-8 pt-24 transition-all duration-300">
        <div class="max-w-7xl mx-auto space-y-6 md:space-y-8 animate-fade-in-up">
            
            
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-wider">
                <a href="<?php echo e(route('doctor.dashboard')); ?>" class="text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <span class="text-slate-300">/</span>
                <span class="text-blue-600">Agenda</span>
            </nav>

            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Agenda du <span class="text-blue-600">Jour</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm"><?php echo e(\Carbon\Carbon::today()->translatedFormat('l d F Y')); ?></p>
                </div>
                
                <div class="glass-effect px-6 py-3.5 rounded-2xl shadow-sm text-sm font-medium text-slate-600 border border-white/50 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Total: <span class="font-black text-blue-600"><?php echo e($rendezvous->count()); ?></span> rendez-vous</span>
                </div>
            </div>

            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Total</p>
                    <p class="text-2xl font-black text-slate-800"><?php echo e($rendezvous->count()); ?></p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Confirmés</p>
                    <p class="text-2xl font-black text-emerald-600"><?php echo e($rendezvous->where('statut', 'confirme')->count()); ?></p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">En attente</p>
                    <p class="text-2xl font-black text-amber-600"><?php echo e($rendezvous->where('statut', 'en_attente')->count()); ?></p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Terminés</p>
                    <p class="text-2xl font-black text-blue-600"><?php echo e($rendezvous->where('statut', 'termine')->count()); ?></p>
                </div>
            </div>

          
<div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-100">
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-wider text-slate-500">Heure & Patient</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-wider text-slate-500">Contact</th>
                    <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-wider text-slate-500">Statut</th>
                    <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-wider text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__empty_1 = true; $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="agenda-row transition-all duration-200">
                        
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-md">
                                    <?php echo e(substr($rdv->patient->name ?? 'P', 0, 1)); ?><?php echo e(substr($rdv->patient->name ?? 'P', 1, 1) ?? ''); ?>

                                </div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-black text-slate-800"><?php echo e($rdv->patient->name ?? 'Patient'); ?></span>
                                        <span class="px-2 py-0.5 bg-slate-100 text-slate-500 rounded text-[9px] font-black uppercase">ID: #<?php echo e($rdv->patient_id); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-lg"><?php echo e($rdv->heure_rdv); ?></span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        
                        <td class="px-6 py-5">
                            <div class="flex flex-col gap-0.5">
                                <div class="flex items-center gap-1 text-slate-600 text-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <?php echo e($rdv->patient->email ?? 'Non renseigné'); ?>

                                </div>
                                <div class="flex items-center gap-1 text-slate-600 text-xs">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                    <?php echo e($rdv->patient->patient?->telephone ?? 'Non renseigné'); ?>

                                </div>
                            </div>
                        </td>

                        
                        <td class="px-6 py-5">
                            <?php if($rdv->statut === 'attente'): ?> 
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 text-amber-600 rounded-xl text-[10px] font-black border border-amber-200">
                                    <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                                    En attente
                                </span>
                            <?php elseif($rdv->statut === 'confirme'): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-xl text-[10px] font-black border border-emerald-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Confirmé
                                </span>
                            <?php elseif($rdv->statut === 'termine'): ?>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-500 rounded-xl text-[10px] font-black border border-slate-200">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Terminé
                                </span>
                            <?php else: ?>
                                <span class="px-3 py-1.5 bg-rose-50 text-rose-600 rounded-xl text-[10px] font-black border border-rose-200">
                                    Annulé
                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-6 py-5 text-right">
                            <div class="flex justify-end items-center gap-2">
                                
                                
                                <?php if($rdv->statut !== 'annule' && $rdv->statut !== 'termine'): ?>
                                    <form action="<?php echo e(route('doctor.rendezvous.envoyerMail', $rdv->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" 
                                                onclick="return confirm('Envoyer un rappel par email au patient ?')"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-all"
                                                title="Envoyer un rappel">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </button>
                                    </form>
                                <?php endif; ?>

                                
                                <?php if($rdv->statut === 'attente'): ?> 
                                    <form action="<?php echo e(route('doctor.rendezvous.confirmer', $rdv->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" 
                                                onclick="return confirm('Confirmer ce rendez-vous ? Un email sera envoyé au patient.')"
                                                class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-emerald-700 transition-all shadow-md shadow-emerald-200">
                                            Confirmer
                                        </button>
                                    </form>
                                <?php endif; ?>

                                
                                <?php if($rdv->statut === 'attente' || $rdv->statut === 'confirme'): ?> 
                                    <form action="<?php echo e(route('doctor.rendezvous.annuler', $rdv->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" 
                                                onclick="return confirm('⚠️ Attention : Annuler ce rendez-vous ? Cette action est irréversible.')"
                                                class="px-4 py-2 bg-white border border-rose-200 text-rose-600 rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-rose-600 hover:text-white transition-all">
                                            Annuler
                                        </button>
                                    </form>
                                <?php endif; ?>

                                
                                <?php if($rdv->statut === 'confirme'): ?>
                                    <a href="<?php echo e(route('doctor.consultations.create', $rdv->id)); ?>" 
                                       class="px-4 py-2 bg-blue-600 text-white rounded-xl text-[10px] font-black uppercase tracking-wider hover:bg-blue-700 transition-all shadow-md shadow-blue-200 flex items-center gap-1">
                                        Démarrer
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-16 h-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-slate-400 font-black uppercase text-sm tracking-widest">Aucun rendez-vous aujourd'hui</p>
                                <p class="text-slate-300 text-xs mt-1">Profitez de cette accalmie !</p>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
            
        </div>
    </main>
</div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/rendezvous/index.blade.php ENDPATH**/ ?>