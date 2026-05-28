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
<div class="max-w-2xl mx-auto py-12">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="bg-indigo-600 px-6 py-5">
            <h3 class="text-white font-black text-sm uppercase tracking-wider">Modifier le service</h3>
            <p class="text-indigo-100 text-[10px] mt-1">Modifier les informations du service</p>
        </div>
        
        <form action="<?php echo e(route('admin.services.update', $service)); ?>" method="POST" class="p-6 space-y-5">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Nom du service</label>
                <input type="text" name="nom" value="<?php echo e(old('nom', $service->nom)); ?>" 
                       class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none" required>
            </div>
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Téléphone</label>
                <input type="tel" name="telephone" value="<?php echo e(old('telephone', $service->telephone)); ?>" 
                       class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                <p class="text-[8px] text-slate-400 mt-1 ml-2">Format: +229 01 23 45 67</p>
            </div>
        
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Étage / Aile (optionnel)</label>
                <input type="text" name="etage" value="<?php echo e(old('etage', $service->etage)); ?>" 
                       class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
                <p class="text-[8px] text-slate-400 mt-1 ml-2">Ex: 1er étage, Aile A, Rez-de-chaussée</p>
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="<?php echo e(route('admin.services.index')); ?>" 
                   class="px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-slate-200 transition-all duration-300">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-indigo-700 transition-all duration-300 shadow-md shadow-indigo-200">
                    Mettre à jour
                </button>
            </div>
        </form>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>