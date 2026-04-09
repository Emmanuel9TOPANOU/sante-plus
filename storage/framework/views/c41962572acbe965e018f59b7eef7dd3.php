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
    <div class="py-6 md:py-12 bg-[#F8FAFC] min-h-screen montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <?php
                $prescriptionsEnAttente = $analyses->where('statut', 'en_attente');
                // Protection : Un patient n'est pas un spécialiste, on initialise à false par défaut
                $isSpecialist = false;
                if(Auth::user()->role === 'medecin' && Auth::user()->specialty) {
                    $isSpecialist = strtolower(Auth::user()->specialty) !== 'généraliste';
                }
            ?>

            <?php if($prescriptionsEnAttente->count() > 0): ?>
                <div class="mb-8 animate-in fade-in slide-in-from-top-4 duration-700">
                    <div class="bg-blue-600 rounded-[1.5rem] md:rounded-[2rem] p-1 shadow-xl shadow-blue-100 border border-blue-400">
                        <div class="bg-white rounded-[1.3rem] md:rounded-[1.8rem] p-5 flex flex-col md:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-4 text-center md:text-left flex-col md:flex-row">
                                <div class="flex-shrink-0 w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 relative">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                    </svg>
                                    <span class="absolute -top-1 -right-1 block h-4 w-4 rounded-full bg-red-500 border-2 border-white animate-ping"></span>
                                </div>
                                <div>
                                    <h3 class="text-sm md:text-base font-black text-gray-900 uppercase tracking-tight">Nouvelle Prescription</h3>
                                    <p class="text-xs text-gray-500 font-medium leading-relaxed">
                                        Une analyse a été prescrite. <br class="hidden md:block"> 
                                        Veuillez vous présenter au laboratoire pour les prélèvements.
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-4 py-2 rounded-full uppercase tracking-widest border border-blue-100">
                                    Action Requise
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="mb-6 md:mb-8">
                <a href="<?php echo e(route('patient.dashboard')); ?>" class="inline-flex items-center p-2.5 bg-white rounded-xl shadow-sm border border-gray-50 text-gray-400 hover:text-blue-600 transition-colors gap-2 text-xs md:text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour au tableau de bord
                </a>
            </div>
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600/50">Laboratoire Central</span>
                    </div>
                    <h2 class="text-2xl md:text-4xl font-black text-gray-800 tracking-tight">
                        Mes Analyses <span class="text-blue-600">&</span> Bilans
                    </h2>
                    <p class="text-gray-500 mt-1 font-medium text-xs md:text-sm italic">
                        Suivi en temps réel de vos résultats médicaux.
                    </p>
                </div>
                <div class="bg-slate-900 text-white px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-slate-200 self-start sm:self-auto flex items-center gap-3">
                    <span class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></span>
                    <?php echo e($analyses->total()); ?> Analyse(s) au total
                </div>
            </div>

            
            <div class="bg-white shadow-sm rounded-3xl md:rounded-[2.5rem] border border-gray-100 overflow-hidden">
                
                
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Détails de l'Analyse</th>
                                <?php if($isSpecialist): ?>
                                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Interprétation</th>
                                <?php endif; ?>
                                <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Valeur / Norme</th>
                                <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Statut</th>
                                <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Documents</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php $__empty_1 = true; $__currentLoopData = $analyses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analyse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $status = $analyse->statut ?? 'en_attente';
                                    $statusClasses = [
                                        'termine' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                        'en_attente' => 'bg-amber-100 text-amber-700 border-amber-200',
                                        'annule' => 'bg-red-100 text-red-700 border-red-200'
                                    ][$status] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                                ?>
                                <tr class="hover:bg-blue-50/30 transition-all group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center space-x-4">
                                            <div class="w-12 h-12 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center text-blue-600 group-hover:text-white group-hover:bg-blue-600 group-hover:rotate-6 transition-all duration-300">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-black text-gray-800 leading-none mb-1"><?php echo e($analyse->type_analyse); ?></p>
                                                <p class="text-[10px] font-bold text-blue-500 uppercase tracking-widest"><?php echo e($analyse->created_at->translatedFormat('d M Y')); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <?php if($isSpecialist): ?>
                                        <td class="px-8 py-6 text-center">
                                            <span class="text-[9px] font-black text-slate-400 bg-slate-50 px-3 py-1 rounded-lg border border-slate-100 uppercase tracking-tighter">
                                                Vue Spécialiste Activée
                                            </span>
                                        </td>
                                    <?php endif; ?>

                                    <td class="px-8 py-6 text-center">
                                        <?php if($status == 'termine' && $analyse->valeur): ?>
                                            <div class="inline-block px-4 py-2 bg-gray-50 rounded-2xl border border-gray-100">
                                                <span class="text-sm font-black text-gray-900"><?php echo e($analyse->valeur); ?> <span class="text-blue-500 text-[10px]"><?php echo e($analyse->unite); ?></span></span>
                                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">Norme: <?php echo e($analyse->norme ?? 'N/A'); ?></p>
                                            </div>
                                        <?php else: ?>
                                            <div class="flex flex-col items-center gap-1 opacity-40">
                                                <div class="w-8 h-1 bg-gray-200 rounded-full"></div>
                                                <span class="text-[9px] font-bold uppercase text-gray-400">Traitement en cours</span>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border <?php echo e($statusClasses); ?> shadow-sm">
                                            <?php echo e(str_replace('_', ' ', $status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <?php if($status == 'termine'): ?>
                                            
                                            <a href="<?php echo e(route('patient.lab_results.download', $analyse->id)); ?>" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-[9px] font-black uppercase transition-all transform hover:-translate-y-1 shadow-lg shadow-slate-100 active:scale-95">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                                <span>Télécharger PDF</span>
                                            </a>
                                        <?php else: ?>
                                            <button disabled class="px-5 py-2.5 rounded-xl text-[9px] font-black uppercase bg-gray-50 text-gray-300 cursor-not-allowed border border-gray-100 italic">
                                                En attente
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="<?php echo e($isSpecialist ? 5 : 4); ?>" class="px-8 py-32 text-center">
                                        <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                            <svg class="w-10 h-10 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </div>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Aucun dossier d'analyse trouvé</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="md:hidden divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $analyses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analyse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $status = $analyse->statut ?? 'en_attente';
                            $statusClasses = [
                                'termine' => 'bg-emerald-50 text-emerald-600',
                                'en_attente' => 'bg-amber-50 text-amber-600',
                                'annule' => 'bg-red-50 text-red-600'
                            ][$status] ?? 'bg-gray-50 text-gray-600';
                        ?>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-black text-gray-800 leading-tight"><?php echo e($analyse->type_analyse); ?></h4>
                                        <p class="text-[10px] font-bold text-blue-500 uppercase"><?php echo e($analyse->created_at->translatedFormat('d F Y')); ?></p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 rounded-lg text-[8px] font-black uppercase <?php echo e($statusClasses); ?>">
                                    <?php echo e(str_replace('_', ' ', $status)); ?>

                                </span>
                            </div>

                            <div class="bg-gray-50/50 rounded-2xl p-4 flex justify-between items-center border border-gray-100 mb-4">
                                <?php if($status == 'termine'): ?>
                                    <div>
                                        <p class="text-[8px] text-gray-400 font-bold uppercase">Résultat</p>
                                        <p class="text-xs font-black text-gray-900"><?php echo e($analyse->valeur); ?> <span class="text-[9px] text-gray-400 font-normal"><?php echo e($analyse->unite); ?></span></p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[8px] text-gray-400 font-bold uppercase">Norme</p>
                                        <p class="text-[10px] font-bold text-gray-700"><?php echo e($analyse->norme ?? 'N/A'); ?></p>
                                    </div>
                                <?php else: ?>
                                    <p class="text-[10px] text-gray-400 italic font-medium mx-auto">Traitement en cours...</p>
                                <?php endif; ?>
                            </div>

                            <?php if($status == 'termine'): ?>
                                
                                <a href="<?php echo e(route('patient.lab_results.download', $analyse->id)); ?>" class="w-full flex items-center justify-center space-x-2 bg-slate-900 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl active:scale-95 transition-transform">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    <span>Bilan PDF</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="p-12 text-center text-gray-300 font-black uppercase text-[10px] italic">Aucun résultat</div>
                    <?php endif; ?>
                </div>

                
                <?php if($analyses->hasPages()): ?>
                    <div class="px-8 py-6 bg-gray-50/30 border-t border-gray-100">
                        <?php echo e($analyses->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/lab_results/index.blade.php ENDPATH**/ ?>