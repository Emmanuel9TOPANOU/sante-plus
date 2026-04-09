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
     <?php $__env->slot('header', null, []); ?> 
        <?php
            // Logique de redirection et style selon le rôle
            $userRole = Auth::user()->role;
            
            $dashboardConfig = match($userRole) {
                'admin'      => ['route' => route('admin.dashboard'), 'label' => 'Admin Panel', 'color' => 'blue'],
                'medecin'    => ['route' => route('doctor.dashboard'), 'label' => 'Espace Médecin', 'color' => 'indigo'],
                'patient'    => ['route' => route('patient.dashboard'), 'label' => 'Mon Espace Santé', 'color' => 'sky'],
                'secretaire' => ['route' => route('secretaire.dashboard'), 'label' => 'Secrétariat', 'color' => 'blue'],
                default      => ['route' => route('dashboard'), 'label' => 'Dashboard', 'color' => 'slate'],
            };
        ?>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-slate-800 leading-tight uppercase tracking-tight">
                    <?php echo e(__('Gestion du Profil')); ?>

                </h2>
                <p class="text-xs font-bold text-slate-400 mt-1 uppercase tracking-widest">
                    <?php echo e($dashboardConfig['label']); ?> — <?php echo e(Auth::user()->name); ?>

                </p>
            </div>
            
            
            <a href="<?php echo e($dashboardConfig['route']); ?>" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-2xl text-[10px] font-black uppercase tracking-[0.15em] hover:bg-slate-50 hover:text-<?php echo e($dashboardConfig['color']); ?>-600 transition-all shadow-sm hover:shadow-md active:scale-95">
                <i class="fa-solid fa-arrow-left-long"></i>
                <?php echo e(__('Quitter les paramètres')); ?>

            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-slate-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-[3rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative">
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            
            <div class="relative">
                <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            
            <div class="mt-16 pt-8 border-t border-slate-200">
                <div class="bg-rose-50/30  border border-rose-100/50 overflow-hidden">
                    <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/profile/edit.blade.php ENDPATH**/ ?>