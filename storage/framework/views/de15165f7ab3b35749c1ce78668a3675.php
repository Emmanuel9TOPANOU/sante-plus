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
    
    <div class="min-h-screen bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-slate-50 via-white to-blue-50/30">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
            <div class="space-y-10 md:space-y-14">

                
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 border-b border-slate-100 pb-10">
                    <div class="flex items-center gap-8">
                        <a href="<?php echo e(route('admin.dashboard')); ?>"
                           class="group px-8 py-4 bg-white border border-slate-200 rounded-2xl text-xs font-black uppercase tracking-widest text-slate-500 hover:text-blue-600 hover:border-blue-200 shadow-sm hover:shadow-xl hover:shadow-blue-50 transition-all duration-500">
                           ← Retour
                        </a>
                        
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="h-px w-10 bg-blue-600 rounded-full"></span>
                                <span class="text-blue-600 font-black text-xs uppercase tracking-[0.3em]">Console Admin</span>
                            </div>
                            <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight italic">
                                Gestion des <span class="relative inline-block">
                                    <span class="relative z-10 text-blue-600">Comptes</span>
                                    <span class="absolute bottom-2 left-0 w-full h-4 bg-blue-100/50 -z-0"></span>
                                </span>
                            </h2>
                        </div>
                    </div>
                </div>

                
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-[3rem] blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                    
                    <div class="relative bg-white/90 backdrop-blur-xl rounded-[2.5rem] border border-white shadow-2xl shadow-slate-200/50 overflow-hidden admin-table-wrapper">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[900px]">
                                <thead>
                                    <tr class="bg-slate-50/50">
                                        <th class="px-10 py-10 text-xs font-black uppercase tracking-[0.2em] text-slate-500">Membre Identifié</th>
                                        <th class="px-10 py-10 text-xs font-black uppercase tracking-[0.2em] text-slate-500">Niveau d'accès</th>
                                        <th class="px-10 py-10 text-xs font-black uppercase tracking-[0.2em] text-slate-500 text-center">Statut</th>
                                        <th class="px-10 py-10 text-xs font-black uppercase tracking-[0.2em] text-slate-500 text-right">Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-slate-100">
                                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-blue-50/40 transition-all duration-500 group/row">
                                        
                                        <td class="px-10 py-8">
                                            <div class="flex flex-col gap-1">
                                                <span class="font-black text-slate-900 text-base uppercase tracking-wide group-hover/row:text-blue-600 transition-colors">
                                                    <?php echo e($user->name); ?>

                                                </span>
                                                <span class="text-sm font-medium text-slate-400 lowercase">
                                                    <?php echo e($user->email); ?>

                                                </span>
                                            </div>
                                        </td>

                                        <td class="px-10 py-8">
                                            <span class="text-xs font-black uppercase tracking-widest text-slate-600 bg-slate-100 px-3 py-1 rounded-lg">
                                                <?php echo e($user->role); ?>

                                            </span>
                                        </td>

                                        <td class="px-10 py-8 text-center">
                                            <?php if($user->role === 'medecin'): ?>
                                                <div class="flex items-center justify-center gap-2">
                                                    <span class="relative flex h-2 w-2">
                                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full <?php echo e($user->medecin?->est_valide ? 'bg-emerald-400' : 'bg-amber-400'); ?> opacity-75"></span>
                                                        <span class="relative inline-flex rounded-full h-2 w-2 <?php echo e($user->medecin?->est_valide ? 'bg-emerald-500' : 'bg-amber-500'); ?>"></span>
                                                    </span>
                                                    <span class="<?php echo e($user->medecin?->est_valide ? 'text-emerald-600' : 'text-amber-600'); ?> text-xs font-black uppercase tracking-widest">
                                                        <?php echo e($user->medecin?->est_valide ? 'Actif' : 'En attente'); ?>

                                                    </span>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-slate-300">—</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="px-10 py-8 text-right">
                                            <div class="flex items-center justify-end gap-4">
                                                <?php if($user->role === 'medecin' && $user->medecin): ?>
                                                    <form action="<?php echo e(route('admin.medecins.validate', ['id' => $user->medecin->id])); ?>" method="POST">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                        <button type="submit" 
                                                                class="px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest transition-all duration-300 shadow-sm
                                                                <?php echo e($user->medecin->est_valide ? 'bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white hover:shadow-amber-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white hover:shadow-emerald-100'); ?>">
                                                            <?php echo e($user->medecin->est_valide ? 'Suspendre' : 'Valider le profil'); ?>

                                                        </button>
                                                    </form>
                                                <?php endif; ?>

                                                <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" 
                                                            class="px-6 py-3 rounded-xl bg-rose-50 text-rose-600 font-black text-[10px] uppercase tracking-widest hover:bg-rose-600 hover:text-white hover:shadow-lg hover:shadow-rose-100 transition-all duration-300">
                                                        Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="px-10 py-20 text-center text-slate-400 font-medium italic">
                                            Aucun utilisateur trouvé dans la base de données.
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-12 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <?php echo e($users->links()); ?>

                </div>
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 1023px) {
            .admin-table-wrapper { overflow-x: auto; width: 100%; }
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/admin/users/index.blade.php ENDPATH**/ ?>