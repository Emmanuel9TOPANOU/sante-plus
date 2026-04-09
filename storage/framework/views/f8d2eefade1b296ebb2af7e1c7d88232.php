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
    
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-slate-50 via-white to-blue-50/40">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-14">
            <div class="space-y-10">

                
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 border-b border-slate-100 pb-10">
                    <div class="space-y-4">
                        <nav class="flex items-center space-x-3 text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="hover:text-blue-600 transition-colors no-underline">Dashboard</a>
                            <span class="text-slate-200">/</span>
                            <span class="text-blue-600">Corps Médical</span>
                        </nav>
                        
                        <h2 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight italic">
                            Répertoire <span class="text-blue-600 relative">Praticiens
                                <span class="absolute -bottom-1.5 left-0 w-full h-1 bg-blue-600/10 rounded-full"></span>
                            </span>
                        </h2>
                        <p class="text-slate-500 font-medium text-base max-w-xl">
                            Gestion et supervision des <span class="text-slate-900 font-black"><?php echo e($medecins->total()); ?></span> experts de la plateforme Santé+.
                        </p>
                    </div>

                    <div class="flex gap-4">
                        <div class="bg-white/80 backdrop-blur-md px-8 py-5 rounded-[2rem] border border-white shadow-xl shadow-slate-200/50 text-center min-w-[160px]">
                            <p class="text-[9px] font-black uppercase text-slate-400 tracking-widest mb-1">Total Actifs</p>
                            <p class="text-3xl font-black text-slate-900"><?php echo e($medecins->total()); ?></p>
                        </div>
                    </div>
                </div>

                
                <div class="relative">
                    <div class="relative bg-white/70 backdrop-blur-2xl p-7 md:p-9 rounded-[2.5rem] border border-white shadow-2xl shadow-slate-200/40">
                        <form action="<?php echo e(route('admin.medecins.index')); ?>" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-6 items-end">
                            
                            <div class="md:col-span-5 space-y-3">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Identification</label>
                                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Nom ou email..." 
                                       class="w-full px-6 py-4 rounded-2xl border-none bg-slate-100/50 text-slate-700 font-bold focus:ring-4 focus:ring-blue-500/10 transition-all placeholder:text-slate-400">
                            </div>

                            <div class="md:col-span-4 space-y-3">
                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 ml-4">Spécialité</label>
                                <select name="specialite" class="w-full px-6 py-4 rounded-2xl border-none bg-slate-100/50 text-slate-700 font-bold focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer">
                                    <option value="">Toutes les spécialités</option>
                                    <?php $__currentLoopData = $specialites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($spec->id); ?>" <?php echo e(request('specialite') == $spec->id ? 'selected' : ''); ?>>
                                            <?php echo e($spec->nom_specialite); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="md:col-span-3 flex gap-3">
                                <button type="submit" class="flex-1 py-4 bg-blue-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-900 shadow-xl shadow-blue-200 transition-all">
                                    Filtrer
                                </button>
                                <?php if(request()->anyFilled(['search', 'specialite'])): ?>
                                    <a href="<?php echo e(route('admin.medecins.index')); ?>" class="px-6 py-4 bg-rose-50 text-rose-500 rounded-2xl hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center">
                                        <span class="font-black text-[10px] uppercase tracking-widest">RAZ</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>

                
                <?php if($medecins->count() > 0): ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
                        <?php $__currentLoopData = $medecins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medecin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/20 hover:shadow-blue-200/40 transition-all duration-700 hover:-translate-y-2 relative overflow-hidden">
                            
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50/50 rounded-full -mr-16 -mt-16 transition-transform duration-700 group-hover:scale-[3]"></div>

                            <div class="relative flex flex-col items-center text-center">
                                <div class="w-full flex justify-between items-start mb-6">
                                    <span class="px-4 py-2 bg-slate-50 text-slate-400 text-[8px] font-black uppercase tracking-widest rounded-xl border border-slate-100">
                                        ID: <?php echo e($medecin->medecin?->matricule ?? 'N/A'); ?>

                                    </span>
                                    <span class="px-4 py-2 bg-blue-50 text-blue-600 text-[8px] font-black uppercase tracking-widest rounded-xl border border-blue-100">
                                        <?php echo e($medecin->specialite?->nom_specialite ?? 'Généraliste'); ?>

                                    </span>
                                </div>

                                
                                <div class="relative mb-6">
                                    <div class="w-20 h-20 bg-gradient-to-br from-slate-50 to-slate-100 rounded-[2rem] flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform duration-700 shadow-inner border border-white">
                                        <span class="text-2xl font-black italic">
                                            <?php echo e(substr($medecin->name, 0, 1)); ?>

                                        </span>
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-5 h-5 <?php echo e($medecin->medecin?->est_valide ? 'bg-emerald-500' : 'bg-rose-500'); ?> border-4 border-white rounded-full shadow-sm"></div>
                                </div>
                                
                                <h3 class="font-black text-slate-900 text-lg uppercase tracking-tight mb-1">
                                    <?php echo e($medecin->name); ?>

                                </h3>
                                <p class="text-xs font-bold text-slate-400 lowercase tracking-wide mb-8">
                                    <?php echo e($medecin->email); ?>

                                </p>

                                
                                <div class="w-full border-t border-slate-50 pt-8">
                                    <form action="<?php echo e(route('admin.medecins.destroy', $medecin->id)); ?>" method="POST" onsubmit="return confirm('Révoquer définitivement ce praticien ?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="w-full py-4 bg-rose-50 text-rose-600 text-[9px] font-black uppercase tracking-widest rounded-2xl hover:bg-rose-600 hover:text-white transition-all shadow-sm">
                                            Révoquer le compte
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="py-32 text-center bg-white/30 backdrop-blur-md rounded-[4rem] border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 font-black uppercase tracking-[0.4em] text-xs">Aucun expert trouvé</p>
                    </div>
                <?php endif; ?>
                
                
                <div class="mt-20">
                    <?php echo e($medecins->links()); ?>

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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/admin/medecins/index.blade.php ENDPATH**/ ?>