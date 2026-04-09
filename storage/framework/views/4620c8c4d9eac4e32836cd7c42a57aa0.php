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
    <div x-data="{ mobileMenu: false }" class="flex min-h-screen bg-[#F8FAFC] font-sans antialiased text-slate-900">

        <style>
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
            
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up { animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
            
            .glass-effect { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); }
            [x-cloak] { display: none !important; }
        </style>

        
        <div class="lg:hidden fixed top-4 left-4 z-[70]">
            <button @click="mobileMenu = true" class="p-3 bg-white rounded-2xl shadow-xl border border-blue-50 text-blue-600 focus:outline-none active:scale-95 transition-transform">
                <i class="fa-solid fa-bars-staggered text-xl"></i>
            </button>
        </div>

        
        <aside 
    :class="mobileMenu ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="w-72 bg-gradient-to-b from-blue-50 via-white to-white flex flex-col fixed h-full z-[80] shadow-2xl lg:shadow-none overflow-hidden transition-transform duration-500 ease-in-out border-r border-blue-50">

    
    <div class="p-4 flex-shrink-0 flex items-center justify-between">
        
        <button @click="mobileMenu = false" class="lg:hidden p-2 text-slate-400 hover:text-red-500 transition-colors ml-auto">
            <i class="fa-solid fa-xmark text-2xl"></i>
        </button>
    </div>

    
    <nav class="flex-1 px-4 pt-0 overflow-y-auto space-y-6 no-scrollbar pb-10">
        
        <div>
            
            <div class="flex mt-0 flex-col gap-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                   class="flex items-center px-4 py-3 rounded-2xl transition-all duration-300 no-underline 
                   <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white scale-[1.02]' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <div class="w-6 flex justify-center"><i class="fa-solid fa-chart-pie text-lg"></i></div>
                    <span class="font-bold text-sm ml-2">Dashboard</span>
                </a>

                <a href="<?php echo e(route('admin.users.index')); ?>"
                   class="flex items-center px-4 py-3 rounded-2xl transition-all duration-300 no-underline 
                   <?php echo e(request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-[1.02]' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <div class="w-6 flex justify-center"><i class="fa-solid fa-users text-lg"></i></div>
                    <span class="font-bold text-sm ml-2">Utilisateurs</span>
                </a>
            </div>
        </div>

        
        <div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-500 mb-3 ml-4 opacity-70">Ressources</p>
            <div class="flex flex-col gap-1">
                <a href="<?php echo e(route('admin.medecins.index')); ?>" 
                   class="group flex items-center px-4 py-3 rounded-2xl font-bold text-sm transition-all duration-300 no-underline
                   <?php echo e(request()->routeIs('admin.medecins.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-[1.02]' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center transition-all group-hover:scale-110 <?php echo e(request()->routeIs('admin.medecins.*') ? 'bg-white/20 text-white' : 'bg-emerald-50 text-emerald-600'); ?>">
                        <i class="fa-solid fa-user-doctor text-xs"></i>
                    </div>
                    <span class="ml-2">Médecins</span>
                </a>

                <a href="<?php echo e(route('admin.specialites.index')); ?>" 
                   class="group flex items-center px-4 py-3 rounded-2xl font-bold text-sm transition-all duration-300 no-underline
                   <?php echo e(request()->routeIs('admin.specialites.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-[1.02]' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center transition-all group-hover:scale-110 <?php echo e(request()->routeIs('admin.specialites.*') ? 'bg-white/20 text-white' : 'bg-purple-50 text-purple-600'); ?>">
                        <i class="fa-solid fa-stethoscope text-xs"></i>
                    </div>
                    <span class="ml-2">Spécialités</span>
                </a>
            </div>
        </div>

        
        <div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-500 mb-3 ml-4 opacity-70">Maintenance</p>
            <div class="flex flex-col gap-1">
                <a href="<?php echo e(route('admin.settings.index')); ?>" 
                   class="group flex items-center px-4 py-3 rounded-2xl font-bold text-sm transition-all duration-300 no-underline
                   <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 scale-[1.02]' : 'text-slate-500 hover:bg-blue-50 hover:text-blue-600'); ?>">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center transition-all group-hover:scale-110 <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600'); ?>">
                        <i class="fa-solid fa-gear text-xs"></i>
                    </div>
                    <span class="ml-2">Paramètres</span>
                </a>
            </div>
        </div>
    </nav>

    
    <div class="p-6 mb-16 mt-auto border-t border-blue-50 bg-white">
        <?php if(auth()->guard()->check()): ?>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="group w-full flex items-center justify-center gap-3 py-4 rounded-2xl text-white bg-gradient-to-r from-red-600 to-red-400 shadow-lg border-none hover:from-red-700 transition-all duration-300 font-black uppercase text-[11px] tracking-widest cursor-pointer">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Déconnexion
                </button>
            </form>
        <?php endif; ?>
    </div>
</aside>

        
        <main class="flex-1 lg:ml-72 p-4 md:p-8 lg:p-10 pt-24 lg:pt-10 transition-all duration-300">
            <div class="max-w-7xl mx-auto space-y-8 md:space-y-10 animate-fade-in-up">
                
                
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
                    <div class="text-left">
                        <h1 class="text-2xl md:text-4xl font-black text-blue-700 leading-tight">
                            Dashboard <span class="text-blue-500">Admin</span>
                        </h1>
                        <p class="text-gray-500 mt-1 font-medium text-xs md:text-base">Gestion globale de la plateforme Santé +</p>
                    </div>
                    <div class="w-full sm:w-auto">
                        <span class="inline-block w-full sm:w-auto text-center bg-white text-blue-600 px-6 py-3.5 rounded-2xl shadow-sm text-xs md:text-sm font-bold border border-blue-50">
                            <?php echo e(now()->translatedFormat('l d F Y')); ?>

                        </span>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-400 p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] shadow-xl hover:scale-[1.02] transition-transform relative overflow-hidden group">
                        <div class="flex items-center gap-2 mb-2 relative z-10">
                            <i class="fa-solid fa-users text-white/80 text-xl"></i>
                            <span class="text-white text-[10px] font-black uppercase tracking-widest text-left">Total Utilisateurs</span>
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black text-white relative z-10 text-left"><?php echo e($stats['total_users']); ?></h3>
                        <div class="mt-4 relative z-10 text-left">
                            <span class="px-2 py-1 bg-white/20 rounded-lg text-[10px] font-black text-white italic">+<?php echo e($stats['new_users_month']); ?> ce mois</span>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-600 to-emerald-400 p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] shadow-xl hover:scale-[1.02] transition-transform relative overflow-hidden group">
                        <div class="flex items-center gap-2 mb-2 relative z-10 text-left">
                            <i class="fa-solid fa-user-md text-white/80 text-xl"></i>
                            <span class="text-white text-[10px] font-black uppercase tracking-widest">Médecins Actifs</span>
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black text-white relative z-10 text-left"><?php echo e($stats['total_medecins']); ?></h3>
                    </div>

                    <div class="bg-gradient-to-br from-indigo-600 to-indigo-400 p-6 md:p-8 rounded-[2rem] md:rounded-[2.5rem] shadow-xl hover:scale-[1.02] transition-transform relative overflow-hidden group sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center gap-2 mb-2 relative z-10 text-left">
                            <i class="fa-solid fa-hospital-user text-white/80 text-xl"></i>
                            <span class="text-white text-[10px] font-black uppercase tracking-widest">Total Patients</span>
                        </div>
                        <h3 class="text-4xl md:text-5xl font-black text-white relative z-10 text-left"><?php echo e($stats['total_patients']); ?></h3>
                    </div>
                </div>

                
                <div class="bg-white rounded-[2rem] md:rounded-[3rem] p-5 md:p-8 shadow-sm border border-gray-100">
                    <div class="flex flex-row justify-between items-center mb-8 md:mb-10">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-6 bg-blue-600 rounded-full"></div>
                            <h2 class="font-black uppercase text-gray-400 text-[10px] md:text-sm tracking-widest">Dernières Inscriptions</h2>
                        </div>
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-[9px] md:text-[10px] font-black uppercase tracking-widest hover:bg-blue-600 hover:text-white transition-colors no-underline">
                            Voir tout
                        </a>
                    </div>

                    <div class="overflow-x-auto -mx-5 md:mx-0">
                        <div class="inline-block min-w-full align-middle px-5 md:px-0">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="text-gray-400 text-[10px] uppercase tracking-[0.2em] border-b border-gray-50">
                                        <th class="pb-5 font-black">Utilisateur</th>
                                        <th class="pb-5 font-black hidden sm:table-cell">Rôle</th>
                                        <th class="pb-5 font-black hidden md:table-cell">Date</th>
                                        <th class="pb-5 font-black text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <?php $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="group hover:bg-gray-50/50 transition-colors">
                                        <td class="py-5">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-xl bg-blue-50 flex-shrink-0 flex items-center justify-center mr-3 md:mr-4 text-sm font-black text-blue-600">
                                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                                </div>
                                                <div class="flex flex-col min-w-0">
                                                    <span class="text-sm font-bold text-gray-800 truncate"><?php echo e($user->name); ?></span>
                                                    <span class="text-[10px] text-gray-400 font-medium truncate max-w-[120px] md:max-w-none"><?php echo e($user->email); ?></span>
                                                    <span class="sm:hidden mt-1 px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-[9px] font-black w-fit uppercase"><?php echo e($user->role); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-5 hidden sm:table-cell">
                                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-wider">
                                                <?php echo e($user->role); ?>

                                            </span>
                                        </td>
                                        <td class="py-5 hidden md:table-cell">
                                            <div class="flex flex-col text-left">
                                                <span class="text-xs font-bold text-gray-600"><?php echo e($user->created_at->translatedFormat('d M Y')); ?></span>
                                                <span class="text-[10px] text-gray-400"><?php echo e($user->created_at->format('H:i')); ?></span>
                                            </div>
                                        </td>
                                        <td class="py-5 text-right">
                                            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="inline-flex items-center justify-center w-9 h-9 bg-white border border-gray-100 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        
        <div x-show="mobileMenu" 
             x-transition:enter="transition opacity-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition opacity-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileMenu = false" 
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[75] lg:hidden" x-cloak></div>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>