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
    <div class="py-12 bg-blue-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-3xl font-black text-blue-900 tracking-tight">
                        Mes <span class="text-blue-600">Ordonnances</span>
                    </h2>
                    <p class="text-blue-500/80 font-medium mt-1">Consultez et téléchargez vos prescriptions médicales sécurisées.</p>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] shadow-xl shadow-blue-100/50 overflow-hidden border border-blue-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-blue-50/50 border-b border-blue-100">
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-blue-400">Date</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-blue-400">Médecin</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-blue-400">Référence</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-blue-400 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-blue-50">
                            <?php $__empty_1 = true; $__currentLoopData = $ordonnances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ordonnance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="px-6 py-5 font-bold text-blue-900">
                                        <?php echo e($ordonnance->created_at->format('d/m/Y')); ?>

                                    </td>
<td class="px-6 py-5">
    <span class="block font-bold text-blue-900">
        Dr. <?php echo e($ordonnance->medecin->name ?? 'Médecin non assigné'); ?>

    </span>
    <span class="text-[10px] uppercase font-black text-blue-400 tracking-tighter">
        <?php echo e($ordonnance->medecin->specialite->nom ?? 'Médecine Générale'); ?>

    </span>
</td>

                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-xs font-mono font-bold border border-blue-100">
                                            #ORD-<?php echo e(str_pad($ordonnance->id, 5, '0', STR_PAD_LEFT)); ?>

                                        </span>
                                    </td>

                                    <td class="px-6 py-5 text-right">
                                        <div class="flex justify-end items-center space-x-2">
                                            
                                            <a href="<?php echo e(route('patient.prescriptions.show', $ordonnance->id)); ?>" 
                                               class="p-2 text-blue-400 hover:text-blue-600 transition-all hover:scale-110"
                                               title="Voir les détails">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>

                                            
                                            <a href="<?php echo e(route('patient.prescriptions.download', $ordonnance->id)); ?>" 
                                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black rounded-xl transition-all shadow-md shadow-blue-200 group-hover:scale-105 active:scale-95">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                PDF
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="p-4 bg-blue-50 rounded-full mb-4">
                                                <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-blue-900 font-bold text-lg">Aucune ordonnance trouvée</p>
                                            <p class="text-blue-400 text-sm">Vos prescriptions apparaîtront ici après vos consultations.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($ordonnances->hasPages()): ?>
                    <div class="px-6 py-4 bg-blue-50/30 border-t border-blue-50">
                        <?php echo e($ordonnances->links()); ?>

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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/prescriptions/index.blade.php ENDPATH**/ ?>