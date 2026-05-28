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
<div x-data="{ mobileMenuOpen: false }" class="flex min-h-screen bg-gradient-to-br from-slate-100 to-white font-sans antialiased">

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        
        .glass-effect { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(12px); }
        [x-cloak] { display: none !important; }
        
        .nav-item {
            transition: all 0.2s ease;
            position: relative;
        }
        .nav-item:hover {
            transform: translateY(-2px);
        }
        .nav-item.active {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2), 0 4px 6px -2px rgba(37, 99, 235, 0.1);
        }
        .nav-item.active svg {
            color: white;
        }
        
        .admin-table-wrapper::-webkit-scrollbar {
            height: 6px;
        }
        .admin-table-wrapper::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .admin-table-wrapper::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        
        .status-badge {
            transition: all 0.2s ease;
        }
    </style>

    
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden" x-cloak>
    </div>

 
   <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg border-b border-slate-100 z-50">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex justify-between items-center h-20">
            
            
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                    <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo MonEspaceSanté" class="w-full h-full object-contain">
                </div>
            </div>

            
            <div class="hidden lg:flex items-center gap-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="<?php echo e(route('admin.users.index')); ?>" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('admin.users.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Utilisateurs
                    <?php if($stats['new_users_month'] > 0): ?>
                        <span class="text-[10px] font-black bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full ml-1">+<?php echo e($stats['new_users_month']); ?></span>
                    <?php endif; ?>
                </a>

                <a href="<?php echo e(route('admin.medecins.index')); ?>" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('admin.medecins.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Médecins
                </a>

                <a href="<?php echo e(route('admin.specialites.index')); ?>" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('admin.specialites.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                    Spécialités
                </a>

                
                <a href="<?php echo e(route('admin.services.index')); ?>" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('admin.services.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Services
                </a>

               

                <a href="<?php echo e(route('admin.settings.index')); ?>" 
                   class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('admin.settings.*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Paramètres
                </a>
            </div>

            
            <div class="flex items-center gap-4">
                <?php if(auth()->guard()->check()): ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-red-700 transition-all duration-300 shadow-md cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span class="hidden sm:inline">Déconnexion</span>
                        </button>
                    </form>
                <?php endif; ?>

                
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-700 hover:bg-slate-100 rounded-xl transition-all">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    
    <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="lg:hidden bg-white border-t border-slate-100 px-4 py-4 space-y-2 shadow-xl">
        <a href="<?php echo e(route('admin.dashboard')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">
            Dashboard
        </a>
        <a href="<?php echo e(route('admin.users.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">
            Utilisateurs
        </a>
        <a href="<?php echo e(route('admin.medecins.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('admin.medecins.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">
            Médecins
        </a>
        <a href="<?php echo e(route('admin.specialites.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('admin.specialites.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">
            Spécialités
        </a>
        
        <a href="<?php echo e(route('admin.services.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('admin.services.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">
            Services
        </a>
       
        <a href="<?php echo e(route('admin.settings.index')); ?>" 
           class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('admin.settings.*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">
            Paramètres
        </a>
    </div>
</nav>

    
    <main class="flex-1 p-4 md:p-8 pt-24 transition-all duration-300">
        <div class="max-w-7xl mx-auto space-y-6 md:space-y-8 animate-fade-in-up">
            
            
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-wider">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <span class="text-slate-300">/</span>
                <span class="text-blue-600">Rendez-vous</span>
            </nav>

            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
                
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Gestion des <span class="text-blue-600">Rendez-vous</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">
                        Supervision de tous les rendez-vous de la clinique
                    </p>
                </div>
            </div>

            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Total</p>
                    <p class="text-2xl font-black text-slate-800"><?php echo e($rendezvous->total()); ?></p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Confirmés</p>
                    <p class="text-2xl font-black text-emerald-600"><?php echo e($rendezvous->where('status', 'confirmé')->count()); ?></p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">En attente</p>
                    <p class="text-2xl font-black text-amber-600"><?php echo e($rendezvous->where('status', 'en_attente')->count()); ?></p>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400">Annulés</p>
                    <p class="text-2xl font-black text-rose-600"><?php echo e($rendezvous->where('status', 'annulé')->count()); ?></p>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-5">
                <form action="<?php echo e(route('admin.rendezvous.index')); ?>" method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[180px]">
                        <label class="block text-[9px] font-black uppercase tracking-wider text-slate-500 mb-2 ml-1">Médecin</label>
                        <select name="medecin_id" class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                            <option value="">Tous les médecins</option>
                            <?php $__currentLoopData = $medecins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medecin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($medecin->id); ?>" <?php echo e(request('medecin_id') == $medecin->id ? 'selected' : ''); ?>>
                                    Dr. <?php echo e($medecin->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    
                    <div class="flex-1 min-w-[160px]">
                        <label class="block text-[9px] font-black uppercase tracking-wider text-slate-500 mb-2 ml-1">Date</label>
                        <input type="date" name="date" value="<?php echo e(request('date')); ?>" 
                               class="w-full rounded-xl border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>
                    
                    <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-blue-700 transition-all shadow-md shadow-blue-200">
                        Filtrer
                    </button>
                    
                    <?php if(request()->anyFilled(['medecin_id', 'date'])): ?>
                        <a href="<?php echo e(route('admin.rendezvous.index')); ?>" class="px-5 py-2.5 bg-rose-50 text-rose-600 rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-rose-600 hover:text-white transition-all">
                            Réinitialiser
                        </a>
                    <?php endif; ?>
                </form>
            </div>

            
            <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden admin-table-wrapper">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/80 border-b border-slate-100">
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-slate-500">Date & Heure</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-slate-500">Patient</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-slate-500">Médecin</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-slate-500">Spécialité</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-slate-500">Statut</th>
                                <th class="px-6 py-4 text-[10px] font-black uppercase tracking-wider text-slate-500 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php $__empty_1 = true; $__currentLoopData = $rendezvous; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rdv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800"><?php echo e(\Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y')); ?></div>
                                    <div class="text-xs text-blue-600 font-semibold"><?php echo e(\Carbon\Carbon::parse($rdv->heure_rdv)->format('H:i')); ?></div>
                                </tr>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                                            <?php echo e(strtoupper(substr($rdv->patient->user->name ?? 'P', 0, 1))); ?>

                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-slate-700"><?php echo e($rdv->patient->user->name ?? 'N/A'); ?></div>
                                            <div class="text-[10px] text-slate-400"><?php echo e($rdv->patient->user->email ?? ''); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-700">Dr. <?php echo e($rdv->medecin->name ?? 'N/A'); ?></div>
                                 </div>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 bg-slate-100 text-slate-600 rounded-lg text-[9px] font-bold uppercase">
                                        <?php echo e($rdv->medecin->specialite->nom_specialite ?? 'Généraliste'); ?>

                                    </span>
                                 </div>
                                <td class="px-6 py-4">
                                    <?php
                                        $statusClasses = [
                                            'confirmé' => 'bg-emerald-50 text-emerald-600 border-emerald-200',
                                            'en_attente' => 'bg-amber-50 text-amber-600 border-amber-200',
                                            'annulé' => 'bg-rose-50 text-rose-600 border-rose-200',
                                            'termine' => 'bg-slate-100 text-slate-500 border-slate-200',
                                        ];
                                        $statusLabels = [
                                            'confirmé' => 'Confirmé',
                                            'en_attente' => 'En attente',
                                            'annulé' => 'Annulé',
                                            'termine' => 'Terminé',
                                        ];
                                    ?>
                                    <span class="status-badge px-3 py-1 rounded-full text-[10px] font-black uppercase border <?php echo e($statusClasses[$rdv->status] ?? 'bg-slate-100 text-slate-500'); ?>">
                                        <?php echo e($statusLabels[$rdv->status] ?? $rdv->status); ?>

                                    </span>
                                 </div>
                                <td class="px-6 py-4 text-right">
                                    <form action="<?php echo e(route('admin.rendezvous.update_status', $rdv->id)); ?>" method="POST" class="inline-block">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                        <select name="status" onchange="this.form.submit()" 
                                                class="text-[10px] font-bold border border-slate-200 bg-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 cursor-pointer transition-all">
                                            <option value="en_attente" <?php echo e($rdv->status == 'en_attente' ? 'selected' : ''); ?>>📋 En attente</option>
                                            <option value="confirmé" <?php echo e($rdv->status == 'confirmé' ? 'selected' : ''); ?>>✅ Confirmer</option>
                                            <option value="annulé" <?php echo e($rdv->status == 'annulé' ? 'selected' : ''); ?>>❌ Annuler</option>
                                            <option value="termine" <?php echo e($rdv->status == 'termine' ? 'selected' : ''); ?>>🏁 Terminé</option>
                                        </select>
                                    </form>
                                 </div>
                             </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                             <tr>
                                <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-3 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="font-medium">Aucun rendez-vous trouvé</p>
                                        <p class="text-xs mt-1">Modifiez vos critères de recherche</p>
                                    </div>
                                 </div>
                             </tr>
                            <?php endif; ?>
                        </tbody>
                     </table>
                </div>
            </div>

            
            <?php if($rendezvous->hasPages()): ?>
                <div class="bg-white rounded-xl p-4 border border-slate-100 shadow-sm">
                    <?php echo e($rendezvous->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </main>
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/admin/rendezvous/index.blade.php ENDPATH**/ ?>