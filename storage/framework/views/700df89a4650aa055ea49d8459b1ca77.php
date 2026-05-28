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
        <div class="max-w-7xl mx-auto">
            
            
            <div class="mb-6 md:mb-8">
                <a href="<?php echo e(route('patient.dashboard')); ?>" class="inline-flex items-center p-2.5 bg-white rounded-xl shadow-sm border border-blue-100 text-slate-400 hover:text-blue-600 transition-colors gap-2 text-xs md:text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour au tableau de bord
                </a>
            </div>

            
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-8 md:mb-12 gap-6">
                <div>
                    <h2 class="text-2xl md:text-4xl font-black text-slate-800 tracking-tight uppercase">
                        Suivi <span class="text-blue-600">Médical</span>
                    </h2>
                    <p class="text-slate-400 text-[9px] md:text-[11px] font-bold uppercase tracking-[0.2em] mt-2 md:mt-3 italic flex items-center">
                        <span class="w-6 md:w-8 h-[2px] bg-blue-600 mr-3"></span>
                        Historique des consultations
                    </p>
                </div>
                
                <a href="<?php echo e(route('patient.rendezvous.create')); ?>" 
                   class="w-full lg:w-auto inline-flex items-center justify-center px-8 py-4 md:py-5 bg-blue-600 text-white rounded-2xl md:rounded-[1.8rem] font-black uppercase tracking-widest text-[10px] md:text-[11px] shadow-xl shadow-blue-200 hover:bg-blue-700 transform lg:hover:-translate-y-1 transition-all duration-300">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouveau Rendez-vous
                </a>
            </div>

            
            <div class="bg-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-blue-900/5 overflow-hidden border border-blue-100">
                
                
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left border-separate border-spacing-0">
                        <thead>
                            <tr class="bg-blue-50/30">
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Praticien</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Date & Heure</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Motif</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Statut</th>
                                <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            <?php $__empty_1 = true; $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-blue-50/20 transition-all duration-200 group <?php echo e($rdv->statut === 'annule' ? 'opacity-60 bg-slate-50/30' : ''); ?>">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center text-blue-600 font-black mr-4 border border-blue-200 transition-transform group-hover:scale-110">
                                                <?php echo e(strtoupper(substr($rdv->medecin->name, 0, 1))); ?>

                                            </div>
                                            <div>
                                                <span class="block font-black text-slate-700 text-sm leading-tight group-hover:text-blue-600">Dr. <?php echo e($rdv->medecin->name); ?></span>
                                                <span class="text-[9px] text-blue-400 font-black uppercase tracking-[0.1em] mt-1 block italic"><?php echo e($rdv->medecin->specialite->nom_specialite ?? 'Généraliste'); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-xs font-black text-slate-700 uppercase">
                                        <?php echo e(\Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d F Y')); ?>

                                        <span class="block text-blue-500 mt-1 font-bold italic">
                                            <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <?php echo e(\Carbon\Carbon::parse($rdv->heure_rdv)->format('H\hi')); ?>

                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-xs font-bold text-slate-400 italic">
                                        <?php echo e(Str::limit($rdv->motif ?? 'Consultation de routine', 30)); ?>

                                    </td>
                                    <td class="px-8 py-6">
                                        <?php
                                            $statusColors = [
                                                'attente'  => 'bg-amber-50 text-amber-600 border-amber-200',
                                                'confirme' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                                'annule'   => 'bg-rose-50 text-rose-600 border-rose-200',
                                                'termine'  => 'bg-slate-100 text-slate-500 border-slate-200',
                                            ][$rdv->statut] ?? 'bg-slate-50 text-slate-400';
                                        ?>
                                        <span class="px-3 py-1.5 rounded-xl text-[9px] font-black uppercase tracking-widest border <?php echo e($statusColors); ?>">
                                            <?php echo e($rdv->statut === 'attente' ? 'En attente' : str_replace('_', ' ', $rdv->statut)); ?>

                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-3">
                                            <?php if($rdv->statut === 'attente' || $rdv->statut === 'confirme'): ?>
                                                <a href="<?php echo e(route('patient.rendezvous.edit', $rdv->id)); ?>" 
                                                   class="px-4 py-2 bg-slate-100 text-slate-600 hover:bg-blue-600 hover:text-white rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300 border border-slate-200 hover:border-blue-500 shadow-sm">
                                                    Modifier
                                                </a>
                                                <a href="<?php echo e(route('patient.rendezvous.annulation_rapide', $rdv->id)); ?>" 
                                                   onclick="return confirm('Voulez-vous vraiment annuler ce rendez-vous ?');"
                                                   class="px-4 py-2 bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl text-[9px] font-black uppercase tracking-widest transition-all duration-300 border border-rose-100 hover:border-rose-600 shadow-sm">
                                                    Annuler
                                                </a>
                                            <?php else: ?>
                                                <span class="text-[9px] text-slate-300 font-black uppercase italic tracking-widest flex items-center bg-slate-50 px-4 py-2 rounded-xl border border-slate-100">
                                                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                    </svg>
                                                    Archivé
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-10 py-32 text-center text-slate-300 font-black uppercase text-xs tracking-widest italic">
                                        Aucun rendez-vous trouvé
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="lg:hidden divide-y divide-blue-50">
                    <?php $__empty_1 = true; $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $statusColors = [
                                'attente'  => 'bg-amber-50 text-amber-600 border-amber-200',
                                'confirme' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                'annule'   => 'bg-rose-50 text-rose-600 border-rose-200',
                                'termine'  => 'bg-slate-100 text-slate-500 border-slate-200',
                            ][$rdv->statut] ?? 'bg-slate-50 text-slate-400';
                        ?>
                        <div class="p-6 md:p-8 flex flex-col gap-5 <?php echo e($rdv->statut === 'annule' ? 'bg-slate-50/50' : ''); ?>">
                            <div class="flex justify-between items-start">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-black mr-4 border border-blue-100">
                                        <?php echo e(strtoupper(substr($rdv->medecin->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <h4 class="font-black text-slate-700 text-sm">Dr. <?php echo e($rdv->medecin->name); ?></h4>
                                        <span class="text-[9px] text-blue-400 font-black uppercase italic tracking-wider"><?php echo e($rdv->medecin->specialite->nom_specialite ?? 'Généraliste'); ?></span>
                                    </div>
                                </div>
                                <span class="px-2 py-1 rounded-lg text-[8px] font-black uppercase border <?php echo e($statusColors); ?>">
                                    <?php echo e($rdv->statut === 'attente' ? 'En attente' : str_replace('_', ' ', $rdv->statut)); ?>

                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 py-4 border-y border-blue-50 border-dashed">
                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Date & Heure</p>
                                    <p class="text-[10px] font-black text-slate-700 uppercase tracking-tighter">
                                        <?php echo e(\Carbon\Carbon::parse($rdv->date_rdv)->translatedFormat('d M Y')); ?>

                                    </p>
                                    <p class="text-[10px] font-bold text-blue-500"><?php echo e(\Carbon\Carbon::parse($rdv->heure_rdv)->format('H\hi')); ?></p>
                                </div>
                                <div>
                                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Motif</p>
                                    <p class="text-[10px] font-bold text-slate-400 italic leading-tight"><?php echo e($rdv->motif ?? 'N/A'); ?></p>
                                </div>
                            </div>

                            <div class="flex justify-end gap-3">
                                <?php if($rdv->statut === 'attente' || $rdv->statut === 'confirme'): ?>
                                    <a href="<?php echo e(route('patient.rendezvous.edit', $rdv->id)); ?>" class="flex-1 flex items-center justify-center py-3 bg-slate-100 text-slate-600 rounded-xl text-[10px] font-black uppercase border border-slate-200 transition-all active:bg-blue-600 active:text-white">
                                        Modifier
                                    </a>
                                    <a href="<?php echo e(route('patient.rendezvous.annulation_rapide', $rdv->id)); ?>" 
                                       onclick="return confirm('Annuler ce rendez-vous ?');"
                                       class="flex-1 flex items-center justify-center py-3 bg-rose-50 text-rose-600 rounded-xl text-[10px] font-black uppercase border border-rose-100 transition-all active:bg-rose-600 active:text-white">
                                        Annuler
                                    </a>
                                <?php else: ?>
                                    <div class="w-full text-center py-3 bg-slate-50 rounded-xl text-[9px] font-black text-slate-300 uppercase italic border border-slate-100">
                                        Dossier Archivé
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="py-20 text-center px-6">
                            <svg class="w-12 h-12 text-slate-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            <p class="text-slate-400 font-black uppercase text-[10px] tracking-widest">Aucun historique</p>
                        </div>
                    <?php endif; ?>
                </div>

                
                <?php if($rendezvous->hasPages()): ?>
                    <div class="px-6 md:px-10 py-6 md:py-8 bg-blue-50/30 border-t border-blue-100">
                        <?php echo e($rendezvous->links()); ?>

                    </div>
                <?php endif; ?>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/rendezvous/index.blade.php ENDPATH**/ ?>