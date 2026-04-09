<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-50 via-white to-white backdrop-blur-xl border-b border-blue-100 sticky top-0 z-40 shadow-lg">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            
            
          <div class="flex items-center">
    
    
    <a href="<?php echo e(url('/')); ?>" class="flex items-center justify-center mr-10 group no-underline border-none">
        
        <div class="w-12 h-12 flex items-center justify-center overflow-hidden transform group-hover:scale-105 transition duration-500">
            
            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" 
                 alt="SANTÉ+ Logo" 
                 class="w-full h-full object-contain">
        </div>
    </a>

    <?php
        $user = Auth::user();
        $roleConfig = [
            'patient'    => ['color' => 'black',  'label' => 'Patient'],
            'medecin'    => ['color' => 'indigo', 'label' => 'Médecin'],
            'secretaire' => ['color' => 'sky',    'label' => 'Secrétaire'],
            'admin'      => ['color' => 'blue',   'label' => 'Admin'],
        ];
        
        $config = $roleConfig[$user->role] ?? ['color' => 'blue', 'label' => 'Utilisateur'];
    ?>

    
    <div class="flex items-center space-x-3 bg-gradient-to-r from-<?php echo e($config['color']); ?>-100/80 to-white px-5 py-2 rounded-2xl border border-<?php echo e($config['color']); ?>-200/60 shadow-md">
        <div class="w-2.5 h-2.5 bg-<?php echo e($config['color']); ?>-500 rounded-full animate-pulse shadow-lg"></div>
        <span class="text-[11px] font-black uppercase tracking-[0.15em] text-<?php echo e($config['color']); ?>-700/60">Espace</span>
        <span class="text-[11px] font-black uppercase tracking-[0.15em] text-<?php echo e($config['color']); ?>-700"><?php echo e($config['label']); ?></span>
    </div>
</div>

            
            <div class="flex items-center space-x-4">
                <?php if (isset($component)) { $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown','data' => ['align' => 'right','width' => '64']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'right','width' => '64']); ?>
                     <?php $__env->slot('trigger', null, []); ?> 
                        <button class="group flex items-center space-x-3 p-1 pr-3 rounded-2xl hover:bg-blue-50/60 transition-all duration-300 focus:outline-none shadow-sm">
                            
                           
                            <div class="flex flex-col text-left hidden md:flex">
                                <span class="text-sm font-bold text-blue-900 leading-tight group-hover:text-<?php echo e($config['color']); ?>-600 transition-colors">
                                    <?php echo e($user->name); ?>

                                </span>
                                <span class="text-[10px] text-<?php echo e($config['color']); ?>-500 font-black uppercase tracking-tighter italic">
                                    <?php echo e($config['label']); ?> Connecté
                                </span>
                            </div>
                            <i class="fa-solid fa-chevron-down text-[11px] text-slate-300 group-hover:text-<?php echo e($config['color']); ?>-500 transition-colors ml-1"></i>
                        </button>
                     <?php $__env->endSlot(); ?>

                     <?php $__env->slot('content', null, []); ?> 
                        <div class="p-4 border-b border-blue-50 bg-blue-50/60">
                            <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-1">Session active</p>
                            <p class="text-xs font-semibold text-blue-900 truncate"><?php echo e($user->email); ?></p>
                        </div>

                        <div class="p-1">
                           
                            <hr class="my-1 border-blue-50">
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php if (isset($component)) { $__componentOriginal68cb1971a2b92c9735f83359058f7108 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal68cb1971a2b92c9735f83359058f7108 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dropdown-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-100 transition-colors']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dropdown-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault(); this.closest(\'form\').submit();','class' => 'rounded-lg text-xs font-bold text-rose-600 hover:bg-rose-100 transition-colors']); ?>
                                    <i class="fa-solid fa-power-off mr-2 opacity-50"></i><?php echo e(__('Déconnexion')); ?>

                                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $attributes = $__attributesOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__attributesOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal68cb1971a2b92c9735f83359058f7108)): ?>
<?php $component = $__componentOriginal68cb1971a2b92c9735f83359058f7108; ?>
<?php unset($__componentOriginal68cb1971a2b92c9735f83359058f7108); ?>
<?php endif; ?>
                            </form>
                        </div>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $attributes = $__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__attributesOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe)): ?>
<?php $component = $__componentOriginaldf8083d4a852c446488d8d384bbc7cbe; ?>
<?php unset($__componentOriginaldf8083d4a852c446488d8d384bbc7cbe); ?>
<?php endif; ?>
            </div>
        </div>
    </div>
</nav><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/layouts/navigation.blade.php ENDPATH**/ ?>