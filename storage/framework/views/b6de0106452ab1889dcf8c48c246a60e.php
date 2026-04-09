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

<div class="flex min-h-screen bg-[#FDFDFD]" x-data="{ mobileMenuOpen: false }">

    
    <div class="lg:hidden fixed top-4 left-4 z-[60]">
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-3 bg-white rounded-2xl shadow-sm border border-gray-100 text-blue-600 outline-none">
            <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-slate-900/30 backdrop-blur-sm z-[40] lg:hidden" x-cloak>
    </div>

    
<aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
       class="w-72 bg-gradient-to-b from-blue-50 via-white to-white flex flex-col fixed h-full z-50 shadow-lg overflow-hidden transition-transform duration-300 ease-in-out">

    
    <div class="p-8 flex items-center justify-center border-b border-blue-50">
        <span class="text-2xl font-black text-blue-800 tracking-tighter">Espace<span class="text-blue-500">Santé</span></span>
    </div>

    <nav class="flex-1 px-4 overflow-y-auto space-y-8 [scrollbar-width:none] pt-6">
        
        
        <div>
            <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-blue-500 mb-4 ml-4">Menu Principal</p>
            <div class="flex flex-col gap-1">
                <a href="<?php echo e(route('patient.dashboard')); ?>"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline <?php echo e(request()->routeIs('patient.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <svg class="w-6 h-6 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    <span class="font-bold text-base">Vue d'ensemble</span>
                </a>

                <a href="<?php echo e(route('patient.rendezvous.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline <?php echo e(request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <svg class="w-6 h-6 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="font-bold text-base">Mes Rendez-vous</span>
                </a>

                <a href="<?php echo e(route('patient.lab_results.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline <?php echo e(request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <svg class="w-6 h-6 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    <span class="font-bold text-base">Résultats Labo</span>
                </a>

                <a href="<?php echo e(route('patient.messages.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline <?php echo e(request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <svg class="w-6 h-6 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    <span class="font-bold text-base">Messagerie</span>
                </a>
            </div>
        </div>

        <div class="border-b border-blue-100 my-2"></div>

        
        <div>
            <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-blue-500 mb-4 ml-4">Ma Santé</p>
            <div class="flex flex-col gap-1">
                <a href="<?php echo e(route('patient.medical_record.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline <?php echo e(request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <svg class="w-6 h-6 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span class="font-bold text-base">Dossier Médical</span>
                </a>

                <a href="<?php echo e(route('patient.prescriptions.index')); ?>"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-300 no-underline <?php echo e(request()->routeIs('patient.prescriptions*') ? 'bg-blue-600 text-white shadow-md' : 'text-blue-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <svg class="w-6 h-6 mr-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span class="font-bold text-base">Ordonnances</span>
                </a>
            </div>
        </div>
    </nav>

    
    <div class="p-6 mt-auto border-t border-blue-100 bg-gradient-to-r from-blue-50 to-white mb-16">
        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="group w-full flex items-center justify-center gap-3 py-4 rounded-2xl text-white bg-gradient-to-r from-red-600 to-red-400 shadow-lg border-none hover:from-red-700 hover:to-red-500 transition-all duration-300 font-black uppercase text-[12px] tracking-[0.15em] cursor-pointer">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <?php echo e(__('Déconnexion')); ?>

                </button>
            </form>
        <?php endif; ?>
    </div>
</aside>

   

<main class="flex-1 lg:ml-72 p-4 md:p-10 bg-[#FDFDFD] min-h-screen">
    <div class="max-w-7xl mx-auto space-y-8 md:space-y-12">

        
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-10 pt-12 lg:pt-0">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-slate-800 leading-tight tracking-tighter">
                        Bonjour, <span class="text-blue-600"><?php echo e(explode(' ', Auth::user()->name)[0]); ?></span>
                    </h1>
                    <p class="text-slate-500 mt-1 font-bold text-sm md:text-base uppercase tracking-wider opacity-70">Bienvenue dans votre tableau de bord santé</p>
                </div>
            </div>
            <div class="w-full md:w-auto flex flex-col items-end">
                <span class="bg-gradient-to-r from-blue-600 to-blue-400 text-white px-8 py-4 rounded-2xl shadow-lg text-base font-black tracking-tight border-none">
                    <?php echo e(\Carbon\Carbon::now()->locale('fr')->translatedFormat('l d F Y')); ?>

                </span>
            </div>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            
            <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-gray-100 border-t-4 border-t-blue-600 flex flex-col items-start hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-center gap-2.5 mb-2.5">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">Rendez-vous</span>
                </div>
                <h3 class="text-4xl font-black text-slate-900"><?php echo e($prochainsRendezVous->count()); ?></h3>
            </div>
            
            <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-gray-100 border-t-4 border-t-blue-500 flex flex-col items-start hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-center gap-2.5 mb-2.5">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">Ordonnances</span>
                </div>
                <h3 class="text-4xl font-black text-slate-900"><?php echo e($dernieresOrdonnances->count()); ?></h3>
            </div>
            
            <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-gray-100 border-t-4 border-t-blue-400 flex flex-col items-start hover:shadow-xl transition-all duration-300 group">
                <div class="flex items-center gap-2.5 mb-2.5">
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-400 group-hover:bg-blue-400 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">Analyses</span>
                </div>
                <h3 class="text-4xl font-black text-slate-900"><?php echo e($analyses ?? 0); ?></h3>
            </div>
            
            <div class="bg-white p-7 rounded-[2rem] shadow-sm border border-gray-100 border-t-4 border-t-slate-800 flex flex-col items-start hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-2.5 mb-2.5">
                    <div class="p-2 bg-slate-100 rounded-lg text-slate-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <span class="text-slate-400 text-[10px] font-black uppercase tracking-[0.15em]">ID Patient</span>
                </div>
                <h3 class="text-lg font-black mt-2 text-white bg-slate-800 px-4 py-1 rounded-xl shadow-inner">
                    #HS-<?php echo e(str_pad($patient->id ?? 0, 4, '0', STR_PAD_LEFT)); ?>

                </h3>
            </div>
        </div>

        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="<?php echo e(route('patient.rendezvous.create')); ?>" class="group flex flex-col items-center justify-center p-6 bg-white border border-blue-50 text-blue-700 rounded-[2rem] font-black hover:bg-blue-600 hover:text-white transition-all shadow-md no-underline text-center">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-blue-500 transition-colors">
                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <span class="text-[11px] uppercase tracking-widest">Prendre RDV</span>
            </a>
            <a href="<?php echo e(route('patient.prescriptions.index')); ?>" class="group flex flex-col items-center justify-center p-6 bg-white border border-blue-50 text-blue-700 rounded-[2rem] font-black hover:bg-blue-600 hover:text-white transition-all shadow-md no-underline text-center">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-blue-500 transition-colors">
                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2.5" stroke-linecap="round"/></svg>
                </div>
                <span class="text-[11px] uppercase tracking-widest">Ordonnances</span>
            </a>
            <a href="<?php echo e(route('patient.lab_results.index')); ?>" class="group flex flex-col items-center justify-center p-6 bg-white border border-blue-50 text-blue-700 rounded-[2rem] font-black hover:bg-blue-600 hover:text-white transition-all shadow-md no-underline text-center">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-blue-500 transition-colors">
                    <svg class="w-6 h-6 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-width="2.5" stroke-linecap="round"/></svg>
                </div>
                <span class="text-[11px] uppercase tracking-widest">Analyses Labo</span>
            </a>
            <a href="<?php echo e(route('patient.history.index')); ?>" class="group flex flex-col items-center justify-center p-6 bg-white border border-slate-200 text-slate-700 rounded-[2rem] font-black hover:bg-slate-800 hover:text-white transition-all shadow-md no-underline text-center">
                <div class="w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-slate-700 transition-colors">
                    <svg class="w-6 h-6 text-slate-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2.5" stroke-linecap="round"/></svg>
                </div>
                <span class="text-[11px] uppercase tracking-widest">Historique</span>
            </a>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 overflow-hidden">
                <div class="bg-white rounded-[2.5rem] p-8 shadow-lg border border-gray-50">
                    <div class="flex justify-between items-center mb-10">
                        <h2 class="font-black uppercase text-blue-800 text-[12px] tracking-[0.2em]">Prochains Rendez-vous</h2>
                        <span class="bg-blue-600 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase shadow-md">
                            <?php echo e($prochainsRendezVous->count()); ?> RDV planifiés
                        </span>
                    </div>

                    <div class="overflow-x-auto -mx-6 md:mx-0">
                        <table class="w-full text-left min-w-[500px] md:min-w-full">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] border-b border-blue-50">
                                    <th class="pb-6 px-6 md:px-0 font-black">Date & Heure</th>
                                    <th class="pb-6 font-black">Médecin</th>
                                    <th class="pb-6 font-black">Spécialité</th>
                                    <th class="pb-6 font-black text-right px-6 md:px-0">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-50/50">
                                <?php $__empty_1 = true; $__currentLoopData = $prochainsRendezVous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="group hover:bg-blue-50/50 transition-all">
                                        <td class="py-6 px-6 md:px-0">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-black text-slate-800 tracking-tight"><?php echo e(\Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d M Y')); ?></span>
                                                <span class="text-[11px] text-white font-black uppercase bg-blue-500 px-3 py-1 rounded-lg self-start mt-2 shadow-sm"><?php echo e($rdv->heure_rdv); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-6">
                                            <div class="flex items-center">
                                                <div class="w-11 h-11 rounded-[1rem] bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mr-4 text-xs font-black text-blue-600 border border-blue-100 group-hover:bg-blue-600 group-hover:text-white transition-all">
                                                    <?php echo e(substr($rdv->medecin->name ?? 'M', 0, 1)); ?>

                                                </div>
                                                <span class="text-sm font-bold text-slate-800">Dr. <?php echo e($rdv->medecin->name ?? 'Médecin'); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-6">
                                            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1.5 rounded-xl border border-blue-100">
                                                <?php echo e($rdv->medecin->specialite->nom_specialite ?? 'Généraliste'); ?>

                                            </span>
                                        </td>
                                        <td class="py-6 text-right px-6 md:px-0">
                                            <span class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded-xl font-black text-[9px] uppercase tracking-widest shadow-md">
                                                Confirmé
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
            <div class="lg:col-span-4">
                <div class="bg-gradient-to-b from-blue-600 to-blue-800 text-white rounded-[3rem] p-8 shadow-2xl h-full flex flex-col">
                    <h2 class="text-[11px] font-black uppercase mb-8 tracking-[0.25em] text-blue-100 opacity-80">Suivi Médical</h2>
                    
                    <div class="space-y-8 flex-1">
                        
                        <div class="p-6 bg-white/10 backdrop-blur-md rounded-[2rem] border border-white/20 shadow-xl">
                            <p class="text-[10px] font-black text-blue-100 uppercase tracking-widest mb-5">Dernière Ordonnance</p>
                            <?php if($dernieresOrdonnances->count() > 0): ?>
                                <div class="flex items-center gap-5">
                                    <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center text-blue-700 shadow-lg">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="text-base font-black text-white block leading-tight">Prescription</span>
                                        <span class="text-[11px] font-black text-blue-800 bg-white px-3 py-1 rounded-lg uppercase mt-2 inline-block shadow-sm">
                                            <?php echo e(\Carbon\Carbon::parse($dernieresOrdonnances->first()->created_at)->translatedFormat('d F Y')); ?>

                                        </span>
                                    </div>
                                </div>
                            <?php else: ?>
                                <p class="text-xs italic font-bold text-blue-100 opacity-60">Aucune ordonnance disponible.</p>
                            <?php endif; ?>
                        </div>

                        
                        <div class="pt-4">
                            <div class="h-px bg-white/20 w-full mb-8"></div>
                            <div class="flex gap-4">
                                <div class="w-1.5 h-auto bg-blue-300 rounded-full"></div>
                                <p class="text-xs text-blue-50 leading-relaxed font-bold uppercase tracking-wide opacity-90">
                                    Consultez vos rapports d'analyses et documents médicaux via le menu.
                                </p>
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
    /* Optionnel : adoucir la police globale si nécessaire */
    body { font-feature-settings: "cv02", "cv03", "cv04", "cv11"; }
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