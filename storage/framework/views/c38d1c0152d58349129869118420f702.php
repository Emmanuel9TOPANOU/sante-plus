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
     <?php $__env->slot('title', null, []); ?> 
        Configuration Système | HospitConnect
     <?php $__env->endSlot(); ?>

    <style>
        /* Animation d'entrée pour les éléments */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        
        /* Micro-interaction sur les inputs */
        .premium-input {
            transition: all 0.3s border-color, box-shadow 0.3s;
        }
        .premium-input:focus {
            box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.1), 0 8px 10px -6px rgba(59, 130, 246, 0.1);
        }

        /* Style bouton Shimmer */
        .btn-premium {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-premium::after {
            content: '';
            position: absolute;
            top: -50%; left: -50%; width: 200%; height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            transform: rotate(45deg);
            transition: 0.8s;
        }
        .btn-premium:hover::after { left: 120%; }
        .btn-premium:hover { transform: translateY(-3px); box-shadow: 0 20px 40px rgba(59, 130, 246, 0.3); }
    </style>

    <style>
        @media (max-width: 1023px) {
            .admin-table-wrapper { overflow-x: auto; width: 100%; }
        }
    </style>

    <div class="max-w-5xl mx-auto py-10 px-6 space-y-12">

        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 mb-4">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                    </span>
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest">Panneau de Contrôle</span>
                </div>
                <h2 class="text-5xl font-black text-slate-900 tracking-tight leading-none">
                    Configuration <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Système</span>
                </h2>
                <p class="text-slate-500 font-medium mt-3 text-lg">
                    Ajustez les paramètres fondamentaux de l'expérience <span class="text-slate-900 font-bold">HospitConnect</span>.
                </p>
            </div>
        </div>

        
        <?php if(session('success')): ?>
            <div class="animate-fade-in p-5 bg-emerald-500 rounded-3xl flex items-center gap-4 text-white shadow-xl shadow-emerald-500/20 border border-emerald-400">
                <div class="w-10 h-10 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md">
                    <i class="fa-solid fa-check text-lg"></i>
                </div>
                <div>
                    <p class="font-black text-xs uppercase tracking-widest">Succès</p>
                    <p class="text-sm font-medium opacity-90"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        <?php endif; ?>

        
        <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-8 animate-fade-in" style="animation-delay: 0.1s">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="group relative">
                
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-[3rem] blur opacity-5 group-hover:opacity-10 transition duration-1000"></div>
                
                <div class="relative bg-white p-10 rounded-[3rem] shadow-[0_30px_100px_rgba(0,0,0,0.04)] border border-slate-100">
                    
                    
                    <div class="flex items-center justify-between mb-12">
                        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-slate-400 flex items-center gap-3">
                            <span class="w-8 h-[2px] bg-blue-600"></span>
                            Identité de la Clinique
                        </h3>
                        <i class="fa-solid fa-shield-halved text-slate-200 text-2xl"></i>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">

                        
                        <div class="md:col-span-2 space-y-3">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-slate-500 ml-2">
                                <i class="fa-solid fa-hospital text-blue-500/50"></i> Nom de l'établissement
                            </label>
                            <input type="text" name="clinic_name" 
                                value="<?php echo e(old('clinic_name', $settings['clinic_name'] ?? '')); ?>"
                                class="premium-input w-full rounded-2xl border-slate-100 bg-slate-50/50 p-5 focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 focus:bg-white outline-none font-bold text-slate-700 transition-all text-lg"
                                placeholder="ex: Clinique du Soleil" required>
                            <?php $__errorArgs = ['clinic_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-rose-500 text-[10px] font-bold uppercase ml-2 tracking-tighter"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-slate-500 ml-2">
                                <i class="fa-solid fa-envelope text-blue-500/50"></i> Contact Officiel
                            </label>
                            <input type="email" name="clinic_email" 
                                value="<?php echo e(old('clinic_email', $settings['clinic_email'] ?? '')); ?>"
                                class="premium-input w-full rounded-2xl border-slate-100 bg-slate-50/50 p-5 focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 focus:bg-white outline-none font-bold text-slate-700 transition-all"
                                required>
                        </div>

                        
                        <div class="space-y-3">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-slate-500 ml-2">
                                <i class="fa-solid fa-phone text-blue-500/50"></i> Ligne Directe
                            </label>
                            <input type="text" name="clinic_phone" 
                                value="<?php echo e(old('clinic_phone', $settings['clinic_phone'] ?? '')); ?>"
                                class="premium-input w-full rounded-2xl border-slate-100 bg-slate-50/50 p-5 focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 focus:bg-white outline-none font-bold text-slate-700 transition-all">
                        </div>

                        
                        <div class="md:col-span-2 space-y-3">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-widest text-slate-500 ml-2">
                                <i class="fa-solid fa-location-dot text-blue-500/50"></i> Localisation Siège
                            </label>
                            <textarea name="clinic_address" rows="3"
                                class="premium-input w-full rounded-2xl border-slate-100 bg-slate-50/50 p-5 focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 focus:bg-white outline-none font-bold text-slate-700 transition-all shadow-inner"
                                ><?php echo e(old('clinic_address', $settings['clinic_address'] ?? '')); ?></textarea>
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="flex items-center justify-between bg-slate-900 p-6 rounded-[2.5rem] shadow-2xl overflow-hidden relative">
                
                <div class="absolute right-0 top-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
                
                <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em] ml-6 hidden md:block">
                    Vérifiez vos données avant de sauvegarder.
                </p>

                <button type="submit" 
                    class="btn-premium w-full md:w-auto px-10 py-5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl flex items-center justify-center gap-4 group">
                    <span>Mettre à jour le système</span>
                    <i class="fa-solid fa-arrow-right-long group-hover:translate-x-2 transition-transform"></i>
                </button>
            </div>

        </form>

        
        <div class="text-center pb-10">
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.5em]">Santé + — 2026</p>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>