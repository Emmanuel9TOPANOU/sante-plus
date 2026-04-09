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
    <div class="py-6 md:py-12 bg-[#F8FAFC] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-8">
                <a href="<?php echo e(route('dashboard')); ?>" class="group inline-flex items-center text-gray-400 hover:text-slate-900 transition-all">
                    <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-100 group-hover:shadow-md transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <span class="ml-4 text-[9px] md:text-[10px] uppercase font-black tracking-[0.2em]">Tableau de bord</span>
                </a>

                <a href="<?php echo e(route('doctor.prescriptions.create')); ?>" 
                   class="w-full sm:w-auto bg-blue-600 text-white px-8 py-4 rounded-2xl md:rounded-[1.5rem] font-black text-[10px] md:text-[11px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-xl shadow-blue-200 hover:-translate-y-1 text-center">
                    <span class="flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        Nouvelle Ordonnance
                    </span>
                </a>
            </div>

            
            <?php if(session('success')): ?>
                <div class="mb-8 p-5 md:p-6 bg-white border-l-4 border-emerald-500 rounded-2xl shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center">
                        <div class="bg-emerald-100 p-2.5 rounded-full mr-4 text-emerald-600 flex-shrink-0">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[9px] uppercase font-black text-emerald-500 tracking-widest">Confirmation</p>
                            <span class="font-bold text-gray-800 text-sm"><?php echo e(session('success')); ?></span>
                        </div>
                    </div>
                    
                    <?php if(session('download')): ?>
                        <script>
                            if (!window.pdfDownloaded) {
                                window.location.href = "<?php echo e(session('download')); ?>";
                                window.pdfDownloaded = true;
                            }
                        </script>
                        <a href="<?php echo e(session('download')); ?>" class="w-full md:w-auto text-center bg-emerald-50 text-emerald-600 px-5 py-2.5 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-emerald-600 hover:text-white transition border border-emerald-100">
                            Relancer le PDF
                        </a>
                        <?php session()->forget('download'); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            
            <div class="bg-white shadow-2xl shadow-slate-200/50 rounded-[1.5rem] md:rounded-[2.5rem] overflow-hidden border border-gray-100">
                <div class="p-6 md:p-10 border-b border-gray-50 bg-white">
                    <h2 class="text-2xl md:text-3xl font-black text-gray-800 tracking-tight leading-tight">
                        Gestion des <span class="text-blue-600 italic">Ordonnances</span>
                    </h2>
                    <p class="text-gray-400 font-bold text-[10px] md:text-[11px] uppercase tracking-widest mt-2">Archives et suivi des prescriptions</p>
                </div>

                
                <div class="block lg:hidden divide-y divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="p-6 bg-white hover:bg-blue-50/20 transition-all">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1.5 bg-slate-50 border border-gray-100 text-blue-600 rounded-lg font-black text-[10px]">
                                    #<?php echo e($p->reference); ?>

                                </span>
                                <span class="text-[10px] font-bold text-gray-400">
                                    <?php echo e(\Carbon\Carbon::parse($p->date_emission)->translatedFormat('d M Y')); ?>

                                </span>
                            </div>
                            
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mr-3 text-slate-500 text-xs font-black ring-2 ring-slate-50">
                                    <?php echo e(strtoupper(substr($p->patient->name, 0, 2))); ?>

                                </div>
                                <span class="text-sm font-black text-gray-700 uppercase"><?php echo e($p->patient->name); ?></span>
                            </div>

                            <a href="<?php echo e(route('doctor.prescriptions.download', $p->id)); ?>" 
                               class="flex items-center justify-center w-full bg-slate-900 text-white px-5 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg">
                                <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                                Télécharger le document
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        
                    <?php endif; ?>
                </div>

                
                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-gray-400 text-[10px] uppercase tracking-[0.2em]">
                                <th class="py-6 px-10 font-black">Référence</th>
                                <th class="py-6 px-6 font-black">Patient</th>
                                <th class="py-6 px-6 font-black">Émission</th>
                                <th class="py-6 px-10 font-black text-right">Document</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="group hover:bg-blue-50/30 transition-all">
                                    <td class="py-8 px-10">
                                        <span class="px-4 py-2 bg-white border border-gray-100 text-blue-600 rounded-xl font-black text-xs shadow-sm group-hover:border-blue-200 transition-all">
                                            #<?php echo e($p->reference); ?>

                                        </span>
                                    </td>
                                    <td class="py-8 px-6">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center mr-4 text-slate-500 text-xs font-black ring-4 ring-slate-50">
                                                <?php echo e(strtoupper(substr($p->patient->name, 0, 2))); ?>

                                            </div>
                                            <span class="text-sm font-black text-gray-700 uppercase tracking-tight"><?php echo e($p->patient->name); ?></span>
                                        </div>
                                    </td>
                                    <td class="py-8 px-6">
                                        <div class="text-sm font-bold text-gray-500">
                                            <?php echo e(\Carbon\Carbon::parse($p->date_emission)->translatedFormat('d M Y')); ?>

                                        </div>
                                    </td>
                                    <td class="py-8 px-10 text-right">
                                        <a href="<?php echo e(route('doctor.prescriptions.download', $p->id)); ?>" 
                                           class="inline-flex items-center bg-slate-900 text-white px-5 py-2.5 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg shadow-slate-100 group-hover:scale-105">
                                            <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                                            Télécharger
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <?php if($prescriptions->isEmpty()): ?>
                    <div class="py-20 md:py-32 text-center bg-white">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 md:w-20 md:h-20 bg-slate-50 rounded-[1.5rem] md:rounded-[2rem] flex items-center justify-center mb-6 text-slate-200">
                                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] md:text-xs px-6">Aucune archive disponible pour le moment</p>
                        </div>
                    </div>
                <?php endif; ?>
                
                
                <?php if($prescriptions->hasPages()): ?>
                    <div class="p-6 md:p-8 border-t border-gray-50 bg-slate-50/30">
                        <?php echo e($prescriptions->links()); ?>

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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/prescriptions/index.blade.php ENDPATH**/ ?>