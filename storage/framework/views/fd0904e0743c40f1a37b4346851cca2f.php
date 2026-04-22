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
    <div class="py-6 md:py-12 bg-blue-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-black text-blue-900 tracking-tight">
                    Mon <span class="text-blue-600">Dossier Médical</span>
                </h2>
                <p class="text-blue-500/80 font-medium mt-1 text-sm md:text-base">Consultez vos alertes santé et l'historique de vos soins.</p>
            </div>

            
            <?php if($infosSante->allergies || $infosSante->antecedents): ?>
                <div class="mb-8 p-5 md:p-6 bg-white border-l-4 md:border-l-8 border-red-500 rounded-3xl md:rounded-[2rem] shadow-xl shadow-red-100/50 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex items-start md:items-center">
                        <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center text-red-600 mr-4 shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[10px] md:text-[11px] font-black uppercase tracking-[0.15em] text-red-500/60 leading-none mb-2">Alertes Médicales</h4>
                            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-y-2 gap-x-4">
                                <?php if($infosSante->allergies): ?>
                                    <span class="text-red-900 font-black text-sm italic">
                                        <span class="text-red-500/50 not-italic mr-1">Allergies:</span><?php echo e($infosSante->allergies); ?>

                                    </span>
                                <?php endif; ?>
                                <?php if($infosSante->antecedents): ?>
                                    <span class="text-red-900 font-black text-sm italic sm:border-l-2 sm:border-red-100 sm:pl-4">
                                        <span class="text-red-500/50 not-italic mr-1">Antécédents:</span><?php echo e($infosSante->antecedents); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 bg-red-50/50 p-3 rounded-2xl lg:bg-transparent lg:p-0">
                        <span class="text-[10px] font-black uppercase text-gray-400">Groupe Sanguin</span>
                        <div class="bg-red-600 px-4 py-2 rounded-xl text-xs font-black text-white shadow-md shadow-red-200">
                            <?php echo e($infosSante->groupe_sanguin ?? 'N/A'); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="space-y-4 md:space-y-6">
                <?php $__empty_1 = true; $__currentLoopData = $historique; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white rounded-3xl md:rounded-[2rem] shadow-xl shadow-blue-100/40 border border-blue-100 overflow-hidden hover:border-blue-300 transition-all duration-300">
                        <div class="p-5 md:p-8">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-blue-600 flex flex-col items-center justify-center text-white shadow-lg shadow-blue-200 shrink-0">
                                        <span class="text-[10px] font-bold uppercase"><?php echo e(\Carbon\Carbon::parse($consultation->date_rdv)->translatedFormat('M')); ?></span>
                                        <span class="text-lg md:text-xl font-black leading-none"><?php echo e(\Carbon\Carbon::parse($consultation->date_rdv)->format('d')); ?></span>
                                    </div>
                                    <div>
                                        <h3 class="text-base md:text-lg font-black text-blue-900 leading-tight">
                                            Dr. <?php echo e($consultation->medecin->name ?? 'Médecin'); ?>

                                        </h3>
                                        <p class="text-blue-500 text-xs md:text-sm font-medium">
                                            <?php echo e($consultation->medecin->specialite->nom_specialite ?? 'Ophtalmologie'); ?> 
                                            • <?php echo e(\Carbon\Carbon::parse($consultation->heure_rdv)->format('H:i')); ?>

                                        </p>
                                    </div>
                                </div>
                                
                                <div class="self-start sm:self-center">
                                    <span class="px-3 py-1.5 rounded-lg <?php echo e($consultation->statut === 'termine' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-blue-50 text-blue-600 border-blue-100'); ?> text-[9px] md:text-[10px] font-black uppercase tracking-widest border">
                                        <?php echo e($consultation->statut); ?>

                                    </span>
                                </div>
                            </div>

                            <hr class="my-5 md:my-6 border-blue-50">

                            
                            <div class="bg-blue-50/30 rounded-2xl p-4 md:p-6 mb-4">
                                <h4 class="text-[10px] md:text-[11px] font-black uppercase tracking-widest text-blue-400 mb-2">Observations Médicales</h4>
                                <p class="text-blue-900/80 text-sm leading-relaxed italic">
                                    "<?php echo e($consultation->consultation->observations ?? 'Aucune observation rédigée pour ce rendez-vous.'); ?>"
                                </p>
                            </div>

                            
                            <?php if($consultation->consultation && $consultation->consultation->analyses->count() > 0): ?>
                                <div class="border border-blue-100 rounded-2xl p-4 md:p-6">
                                    <h4 class="text-[10px] md:text-[11px] font-black uppercase tracking-widest text-blue-400 mb-3 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                        Analyses & Examens Complémentaires
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <?php $__currentLoopData = $consultation->consultation->analyses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $analyse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="flex items-center justify-between p-3 bg-white border border-blue-50 rounded-xl">
                                                <div class="flex items-center">
                                                    <div class="w-8 h-8 rounded-lg <?php echo e($analyse->statut === 'termine' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600'); ?> flex items-center justify-center mr-3">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-bold text-blue-900"><?php echo e($analyse->type_analyse); ?></p>
                                                        <p class="text-[10px] text-gray-400 font-medium uppercase"><?php echo e($analyse->statut); ?></p>
                                                    </div>
                                                </div>
                                                <?php if($analyse->statut === 'termine' && $analyse->pdf_path): ?>
                                                    <a href="<?php echo e(asset('storage/' . $analyse->pdf_path)); ?>" target="_blank" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="bg-white rounded-3xl md:rounded-[2rem] py-16 md:py-24 px-6 text-center border-2 border-dashed border-blue-100">
                        <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-blue-50 text-blue-400 rounded-full mb-4">
                            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-blue-900 font-black text-lg md:text-xl text-balance">Aucun historique disponible</h3>
                        <p class="text-blue-400 mt-2 font-medium text-sm">Vos consultations terminées apparaîtront ici.</p>
                    </div>
                <?php endif; ?>

                <div class="mt-8">
                    <?php echo e($historique->links()); ?>

                </div>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/history/index.blade.php ENDPATH**/ ?>