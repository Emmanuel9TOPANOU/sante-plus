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

    <div class="min-h-screen bg-[#F8FAFC] montserrat">
        <main class="p-4 md:p-8 lg:p-10">
            <div class="max-w-7xl mx-auto space-y-6 md:space-y-10">

                
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <a href="<?php echo e(route('doctor.dashboard')); ?>" class="p-2 bg-white rounded-lg border border-gray-100 text-gray-400 hover:text-blue-600 transition-colors shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            </a>
                            <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-blue-600/50">Espace Docteur</span>
                        </div>
                        <h1 class="text-2xl md:text-4xl font-black text-gray-800">Gestion des <span class="text-blue-600">Disponibilités</span></h1>
                        <p class="text-sm md:text-base text-gray-500 font-medium">Configurez vos jours et heures de consultation.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8">
                    
                    <div class="lg:col-span-5 order-1">
                        <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 lg:sticky lg:top-24">
                            <h2 class="text-[10px] font-black uppercase text-gray-400 mb-6 tracking-widest">Générateur de créneaux</h2>
                            
                            <form action="<?php echo e(route('doctor.availabilities.store')); ?>" method="POST" id="generateForm" class="space-y-6">
                                <?php echo csrf_field(); ?>
                                
                                
                                
                                <?php if(Auth::user()->specialty && strtolower(Auth::user()->specialty) !== 'généraliste'): ?>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black uppercase text-gray-400 ml-2 italic">Jours de consultation</label>
                                        <div class="grid grid-cols-4 sm:grid-cols-7 lg:grid-cols-4 gap-2">
                                            <?php
                                                $jours = [
                                                    1 => 'Lun', 2 => 'Mar', 3 => 'Mer', 
                                                    4 => 'Jeu', 5 => 'Ven', 6 => 'Sam', 0 => 'Dim'
                                                ];
                                            ?>
                                            <?php $__currentLoopData = $jours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $nom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label class="cursor-pointer group">
                                                    <input type="checkbox" name="days[]" value="<?php echo e($val); ?>" class="hidden peer" <?php echo e(in_array($val, [1,2,3,4,5]) ? 'checked' : ''); ?>>
                                                    <div class="py-3 text-center rounded-xl bg-gray-50 text-[10px] font-black uppercase transition-all border border-transparent peer-checked:bg-blue-600 peer-checked:text-white peer-checked:shadow-lg peer-checked:shadow-blue-200 group-hover:border-blue-200">
                                                        <?php echo e($nom); ?>

                                                    </div>
                                                </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    
                                    <input type="hidden" name="days[]" value="1">
                                    <input type="hidden" name="days[]" value="2">
                                    <input type="hidden" name="days[]" value="3">
                                    <input type="hidden" name="days[]" value="4">
                                    <input type="hidden" name="days[]" value="5">
                                    <div class="p-4 bg-blue-50 rounded-2xl border border-blue-100">
                                        <p class="text-[10px] font-bold text-blue-600 uppercase italic">Information</p>
                                        <p class="text-[11px] text-blue-800">En tant que médecin généraliste, votre planning est généré du lundi au vendredi.</p>
                                    </div>
                                <?php endif; ?>

                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase text-gray-400 ml-2 italic">Du</label>
                                        <input type="date" name="start_date" value="<?php echo e(date('Y-m-d')); ?>" min="<?php echo e(date('Y-m-d')); ?>" required class="w-full border-none bg-gray-50 rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-600 transition outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase text-gray-400 ml-2 italic">Au</label>
                                        <input type="date" name="end_date" value="<?php echo e(date('Y-m-d', strtotime('+1 month'))); ?>" min="<?php echo e(date('Y-m-d')); ?>" required class="w-full border-none bg-gray-50 rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-600 transition outline-none">
                                    </div>
                                </div>

                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase text-gray-400 ml-2 italic">Début</label>
                                        <input type="time" name="start_time" value="08:00" required class="w-full border-none bg-gray-50 rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-600 transition outline-none">
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-[10px] font-black uppercase text-gray-400 ml-2 italic">Fin</label>
                                        <input type="time" name="end_time" value="17:00" required class="w-full border-none bg-gray-50 rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-600 transition outline-none">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase text-gray-400 ml-2 italic">Durée par patient</label>
                                    <select name="duration" class="w-full border-none bg-gray-50 rounded-2xl p-4 text-xs font-bold focus:ring-2 focus:ring-blue-600 transition outline-none cursor-pointer">
                                        <option value="15">15 minutes</option>
                                        <option value="30" selected>30 minutes</option>
                                        <option value="45">45 minutes</option>
                                        <option value="60">1 heure</option>
                                    </select>
                                </div>

                                <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl hover:bg-blue-600 hover:-translate-y-1 transition-all cursor-pointer">
                                    Générer le planning
                                </button>
                            </form>
                        </div>
                    </div>

                    
                    <div class="lg:col-span-7 order-2">
                        <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 min-h-[600px]">
                            <div class="flex items-center justify-between mb-8 border-b border-gray-50 pb-6">
                                <div>
                                    <h2 class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Planning Actuel</h2>
                                    <p class="text-[11px] text-slate-400 font-medium">Vos disponibilités visibles par les patients</p>
                                </div>
                                <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase">
                                    <?php echo e($availabilities->total()); ?> créneaux
                                </span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <?php $__empty_1 = true; $__currentLoopData = $availabilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="group relative flex items-center justify-between p-5 rounded-[1.5rem] border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-2xl hover:shadow-blue-900/10 transition-all duration-300">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex flex-col items-center justify-center bg-white border border-gray-100 w-14 h-14 rounded-2xl shadow-sm group-hover:border-blue-100 transition-colors">
                                                <span class="text-sm font-black text-blue-600"><?php echo e($item->date->format('d')); ?></span>
                                                <span class="text-[9px] font-bold uppercase text-gray-400 leading-none"><?php echo e($item->date->translatedFormat('M')); ?></span>
                                            </div>

                                            <div>
                                                <p class="text-xs font-black text-slate-400 uppercase tracking-tighter mb-1">
                                                    <?php echo e($item->date->translatedFormat('l')); ?>

                                                </p>
                                                <p class="text-sm font-black text-gray-800">
                                                    <?php echo e(Carbon\Carbon::parse($item->start_time)->format('H:i')); ?>

                                                    <span class="text-blue-300 px-1">→</span>
                                                    <?php echo e(Carbon\Carbon::parse($item->end_time)->format('H:i')); ?>

                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex flex-col items-end gap-2">
                                            <?php if($item->is_booked): ?>
                                                <span class="text-[8px] font-black uppercase text-emerald-600 bg-emerald-100 px-2 py-1 rounded-lg">Réservé</span>
                                            <?php else: ?>
                                                <form action="<?php echo e(route('doctor.availabilities.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Supprimer ce créneau ?')">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="p-2.5 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all border-none bg-transparent cursor-pointer">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-span-full py-32 text-center">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-dashed border-slate-200">
                                            <i class="fa-solid fa-calendar-plus text-slate-200 text-2xl"></i>
                                        </div>
                                        <p class="text-sm text-slate-400 italic font-medium">Aucun créneau généré.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="mt-8">
                                <?php echo e($availabilities->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('generateForm').addEventListener('submit', function(e) {
            const checkboxes = document.querySelectorAll('input[name="days[]"]:checked');
            if (checkboxes.length === 0) {
                e.preventDefault();
                alert('Veuillez sélectionner au moins un jour de la semaine.');
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/availabilities/index.blade.php ENDPATH**/ ?>