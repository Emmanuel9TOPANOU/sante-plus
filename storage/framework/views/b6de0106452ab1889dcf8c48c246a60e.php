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
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 to-white" x-data="{ mobileMenuOpen: false }">

    
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-blue-900/40 backdrop-blur-sm z-[40] lg:hidden" x-cloak>
    </div>

 
<nav class="fixed top-0 left-0 right-0 bg-white shadow-md border-b border-blue-100 z-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex justify-between items-center h-20">
            
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo MonEspaceSanté" class="w-full h-full object-contain">
                </div>
            </div>

            
            <div class="hidden lg:flex items-center gap-1">
                <a href="<?php echo e(route('patient.dashboard')); ?>" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                   Tableau de bord
                </a>
                <a href="<?php echo e(route('patient.rendezvous.index')); ?>" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                   Rendez-vous
                </a>
              
                <a href="<?php echo e(route('patient.lab_results.index')); ?>" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                   Analyses
                </a>

               
                <a href="<?php echo e(route('patient.medical_record.index')); ?>" 
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                   Dossier Médical
                </a>

                  <a href="<?php echo e(route('patient.messages.index')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
              Messagerie
            </a>
            </div>

            
            <div class="flex items-center gap-4">
                <?php if(auth()->guard()->check()): ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-md cursor-pointer">
                            <span>Quitter</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                <?php endif; ?>

                
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-700 hover:bg-blue-50 rounded-xl transition-all">
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

    
    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="lg:hidden bg-white border-t border-blue-100 px-4 py-4 space-y-2 shadow-xl">
        <a href="<?php echo e(route('patient.dashboard')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
           Tableau de bord
        </a>
        <a href="<?php echo e(route('patient.rendezvous.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
           Rendez-vous
        </a>
    
        <a href="<?php echo e(route('patient.lab_results.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
           Analyses
        </a>
       
        <a href="<?php echo e(route('patient.medical_record.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
           Dossier Médical
        </a>

          <a href="<?php echo e(route('patient.messages.index')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
              Messagerie
            </a>
    </div>
</nav>

    
    <main class="flex-1 p-4 md:p-8 min-h-screen pt-24 lg:pt-20">
        <div class="max-w-7xl mx-auto space-y-6 md:space-y-8">

            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-2">
                <div>
                    <p class="text-xs font-semibold text-blue-600 uppercase tracking-widest mb-1">Tableau de bord patient</p>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight">
                        Bonjour, <span class="text-blue-600"><?php echo e(explode(' ', Auth::user()->name)[0]); ?></span>
                    </h1>
                    <p class="text-slate-500 mt-1 text-sm">Bienvenue dans votre espace de santé personnalisé</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 bg-white border border-blue-100 text-slate-600 px-5 py-3 rounded-2xl shadow-sm text-sm font-medium">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <?php echo e(\Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y')); ?>

                    </div>
                </div>
            </div>

            
           
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:border-blue-200 border-l-4 border-l-blue-600 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-blue-50 rounded-xl group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-tight text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md">Actif</span>
        </div>
        <h3 class="text-3xl font-bold text-black mb-1"><?php echo e($prochainsRendezVous->count()); ?></h3>
        <p class="text-slate-400 text-[11px] font-bold uppercase tracking-widest">Rendez-vous</p>
    </div>

    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 hover:border-blue-200 border-l-4 border-l-amber-500 transition-all duration-300 group">
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-amber-50 rounded-xl group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-tight text-amber-600 bg-amber-50 px-2 py-1 rounded-md">Labo</span>
        </div>
        <h3 class="text-3xl font-bold text-black mb-1"><?php echo e($analyses ?? 0); ?></h3>
        <p class="text-slate-400 text-[11px] font-bold uppercase tracking-widest">Analyses</p>
    </div>

    
    <div class="bg-black rounded-2xl shadow-lg border border-black p-6 hover:bg-gray-900 transition-all duration-300 relative overflow-hidden group">
        
        <div class="absolute top-0 right-0 w-16 h-16 bg-blue-600/10 rounded-bl-full"></div>
        
        <div class="flex items-center justify-between mb-4">
            <div class="p-3 bg-white/10 rounded-xl">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <span class="text-[10px] font-bold uppercase tracking-tight text-blue-400 bg-white/10 px-2 py-1 rounded-md">Profil</span>
        </div>
        <h3 class="text-xl font-bold text-white mb-1 font-mono tracking-wider">
            ID-<?php echo e(str_pad($patient->id ?? 0, 4, '0', STR_PAD_LEFT)); ?>

        </h3>
        <p class="text-gray-400 text-[11px] font-bold uppercase tracking-widest">ID Patient</p>
    </div>
</div>
            
            <div>
                <h2 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">Actions rapides</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <a href="<?php echo e(route('patient.rendezvous.create')); ?>" class="group flex flex-col items-center justify-center p-5 bg-white border border-blue-100 text-slate-600 rounded-2xl font-semibold hover:bg-blue-600 hover:text-white hover:border-blue-600 hover:shadow-md transition-all duration-300 no-underline text-center">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-2.5 group-hover:bg-white/20 transition-all">
                            <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wider">Prendre RDV</span>
                    </a>
                    <a href="<?php echo e(route('patient.lab_results.index')); ?>" class="group flex flex-col items-center justify-center p-5 bg-white border border-blue-100 text-slate-600 rounded-2xl font-semibold hover:bg-blue-600 hover:text-white hover:border-blue-600 hover:shadow-md transition-all duration-300 no-underline text-center">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-2.5 group-hover:bg-white/20 transition-all">
                            <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-width="2.5" stroke-linecap="round"/></svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wider">Analyses Labo</span>
                    </a>
                    <a href="<?php echo e(route('patient.history.index')); ?>" class="group flex flex-col items-center justify-center p-5 bg-white border border-blue-100 text-slate-600 rounded-2xl font-semibold hover:bg-blue-600 hover:text-white hover:border-blue-600 hover:shadow-md transition-all duration-300 no-underline text-center">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center mb-2.5 group-hover:bg-white/20 transition-all">
                            <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5" stroke-linecap="round"/></svg>
                        </div>
                        <span class="text-[11px] uppercase tracking-wider">Dossier médical</span>
                    </a>
                </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <div class="lg:col-span-8 overflow-hidden">
                    <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">
                        <div class="flex justify-between items-center px-6 pt-6 pb-0 mb-4">
                            <div>
                                <h2 class="font-bold text-slate-800 text-base">Prochains Rendez-vous</h2>
                                <p class="text-slate-400 text-xs mt-0.5">Vos consultations planifiées</p>
                            </div>
                            <span class="bg-blue-600 text-white px-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                <?php echo e($prochainsRendezVous->count()); ?> RDV
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left min-w-[500px] md:min-w-full">
                                <thead>
                                    <tr class="text-slate-400 text-[10px] uppercase tracking-[0.18em] bg-slate-50/80">
                                        <th class="py-3.5 px-6 font-bold">Date & Heure</th>
                                        <th class="py-3.5 px-3 font-bold">Médecin</th>
                                        <th class="py-3.5 px-3 font-bold">Spécialité</th>
                                        <th class="py-3.5 px-6 font-bold text-right">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <?php $__empty_1 = true; $__currentLoopData = $prochainsRendezVous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="group hover:bg-blue-50/30 transition-all">
                                            <td class="py-4 px-6">
                                                <div class="flex flex-col gap-1">
                                                    <span class="text-sm font-semibold text-slate-800"><?php echo e(\Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d M Y')); ?></span>
                                                    <span class="text-[10px] text-white font-bold uppercase bg-blue-600 px-2.5 py-1 rounded-lg self-start shadow-sm"><?php echo e($rdv->heure_rdv); ?></span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-3">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center text-xs font-bold text-blue-700 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all flex-shrink-0">
                                                        <?php echo e(substr($rdv->medecin->name ?? 'M', 0, 1)); ?>

                                                    </div>
                                                    <span class="text-sm font-semibold text-slate-700">Dr. <?php echo e($rdv->medecin->name ?? 'Médecin'); ?></span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-3">
                                                <span class="text-[11px] font-semibold text-blue-700 bg-blue-50 px-3 py-1.5 rounded-lg border border-blue-100">
                                                    <?php echo e($rdv->medecin->specialite->nom_specialite ?? 'Généraliste'); ?>

                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-right">
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg font-semibold text-[10px] uppercase tracking-wider">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span>
                                                    Confirmé
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="4" class="py-12 text-center text-slate-500">
                                                <div class="flex flex-col items-center gap-2">
                                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <p>Aucun rendez-vous à venir</p>
                                                    <a href="<?php echo e(route('patient.rendezvous.create')); ?>" class="mt-2 text-sm text-blue-600 font-semibold underline">Prendre un rendez-vous</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                
                <div class="lg:col-span-4">
                    <div class="bg-gradient-to-br from-blue-700 to-blue-800 text-white rounded-2xl p-6 shadow-md h-full flex flex-col">
                        
                        
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-sm font-bold text-white">Suivi Médical</h2>
                                <p class="text-[10px] text-blue-200 uppercase tracking-widest">Aperçu</p>
                            </div>
                        </div>
                        
                        <div class="space-y-4 flex-1">
                            
                            <div class="p-4 bg-white/10 rounded-xl">
                                <div class="flex gap-3 items-start">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="w-4 h-4 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-xs text-blue-100 leading-relaxed font-medium">
                                        Consultez vos rapports d'analyses et documents médicaux via le menu pour un suivi complet.
                                    </p>
                                </div>
                            </div>

                            
                            <div class="p-4 bg-emerald-500/20 rounded-xl">
                                <div class="flex gap-3 items-center">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-500/30 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-emerald-300">Profil à jour</p>
                                        <p class="text-[10px] text-blue-200">Toutes vos informations sont vérifiées</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>

<style>
    [x-cloak] { display: none !important; }
    body { 
        font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
    }
</style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/dashboard.blade.php ENDPATH**/ ?>