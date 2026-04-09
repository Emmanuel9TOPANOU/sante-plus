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
    <div class="py-6 md:py-12 bg-slate-50 min-h-screen" 
         x-data="{ 
            search: '', 
            filterSexe: '', 
            filterGroupe: '',
            showFilters: false 
         }">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-black text-slate-900 italic tracking-tighter text-blue-600">Ma Patientèle</h1>
                    <p class="text-slate-500 font-bold text-[10px] uppercase tracking-[0.2em] mt-2">Gestion des dossiers médicaux</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    
                    <div class="relative flex-grow">
                        <input type="text" x-model="search" placeholder="Nom du patient..." 
                               class="w-full md:w-64 pl-10 pr-4 py-3 bg-white border-none rounded-2xl shadow-sm text-sm font-bold focus:ring-2 focus:ring-blue-500/20 transition-all">
                        <svg class="w-4 h-4 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>

                    
                    <button @click="showFilters = !showFilters" 
                            :class="showFilters ? 'bg-blue-600 text-white' : 'bg-white text-slate-600'"
                            class="px-4 py-3 rounded-2xl shadow-sm font-bold text-xs flex items-center justify-center gap-2 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        Filtres
                    </button>
                </div>
            </div>

            
            <div x-show="showFilters" x-collapse x-cloak class="mb-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Genre</label>
                    <select x-model="filterSexe" class="w-full bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-blue-500/20">
                        <option value="">Tous les genres</option>
                        <option value="Masculin">Masculin</option>
                        <option value="Féminin">Féminin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Groupe Sanguin</label>
                    <select x-model="filterGroupe" class="w-full bg-slate-50 border-none rounded-xl text-xs font-bold focus:ring-blue-500/20">
                        <option value="">Tous les groupes</option>
                        <?php $__currentLoopData = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($gp); ?>"><?php echo e($gp); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex items-end">
                    <button @click="search = ''; filterSexe = ''; filterGroupe = ''" class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:underline ml-1">
                        Réinitialiser
                    </button>
                </div>
            </div>

            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8" id="patients-grid">
                <?php $__empty_1 = true; $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div 
                        x-show="(search === '' || '<?php echo e(strtolower($patient->name)); ?>'.includes(search.toLowerCase())) && 
                                (filterSexe === '' || '<?php echo e($patient->patient?->sexe); ?>' === filterSexe) &&
                                (filterGroupe === '' || '<?php echo e($patient->patient?->groupe_sanguin); ?>' === filterGroupe)"
                        x-transition
                        class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/40 border border-slate-100 hover:-translate-y-2 transition-all duration-300 group flex flex-col h-full"
                    >
                        
                        <div class="flex items-start justify-between mb-6">
                            <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-100 uppercase">
                                <?php echo e(substr($patient->name, 0, 2)); ?>

                            </div>
                            <span class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest">
                                <?php echo e($patient->rendezvous_count); ?> Consultation(s)
                            </span>
                        </div>

                        
                        <div class="mb-8 flex-grow">
                            <h3 class="text-xl font-black text-slate-900 italic mb-1"><?php echo e($patient->name); ?></h3>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <?php echo e($patient->patient?->sexe ?? 'N/D'); ?> • <?php echo e(\Carbon\Carbon::parse($patient->patient?->date_naissance)->age ?? '?'); ?> ans
                            </p>
                        </div>

                        
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100">
                                <p class="text-[9px] font-black text-slate-400 uppercase mb-1 text-center">Groupe</p>
                                <p class="text-xs font-bold text-red-600 text-center"><?php echo e($patient->patient?->groupe_sanguin ?? 'N/A'); ?></p>
                            </div>
                            <div class="bg-slate-50 p-3 rounded-2xl border border-slate-100">
                                <p class="text-[9px] font-black text-slate-400 uppercase mb-1 text-center">Tél</p>
                                <p class="text-[10px] font-bold text-slate-700 text-center truncate"><?php echo e($patient->patient?->telephone ?? 'Aucun'); ?></p>
                            </div>
                        </div>

                        <a href="<?php echo e(route('doctor.patients.show', $patient->id)); ?>" 
                           class="block w-full text-center bg-slate-900 text-white py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] shadow-xl group-hover:bg-blue-600 transition-all">
                            Voir le dossier
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 font-bold uppercase text-xs tracking-widest text-center">Aucun patient trouvé.</p>
                    </div>
                <?php endif; ?>
            </div>

            
            <div x-show="document.querySelectorAll('#patients-grid > div[style*=\'display: none\']').length === document.querySelectorAll('#patients-grid > div').length && search !== ''" 
                 class="text-center py-20 text-slate-400 font-black uppercase text-xs tracking-widest">
                Aucun patient ne correspond à vos critères.
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/patients/index.blade.php ENDPATH**/ ?>