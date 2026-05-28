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
        
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-15px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .animate-slide-in { animation: slideIn 0.3s ease-out forwards; }
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
                    <a href="<?php echo e(route('doctor.dashboard')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.dashboard') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                        </svg>
                        Dashboard
                    </a>

                    <a href="<?php echo e(route('doctor.patients.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.patients*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Patients
                    </a>

                    <a href="<?php echo e(route('doctor.rendezvous.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.rendezvous*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Agenda
                    </a>

                    <a href="<?php echo e(route('doctor.analyses.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.analyses*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                        Analyses
                    </a>

                    <a href="<?php echo e(route('doctor.prescriptions.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.prescriptions*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Ordonnances
                    </a>

                    <a href="<?php echo e(route('doctor.availabilities.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.availabilities*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Horaires
                    </a>

                    <a href="<?php echo e(route('doctor.messages.index')); ?>" 
                       class="nav-item px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 flex items-center gap-2 <?php echo e(request()->routeIs('doctor.messages*') ? 'active' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'); ?>">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Messages
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
            <a href="<?php echo e(route('doctor.dashboard')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Dashboard</a>
            <a href="<?php echo e(route('doctor.patients.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.patients*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Mes Patients</a>
            <a href="<?php echo e(route('doctor.rendezvous.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.rendezvous*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Agenda</a>
            <a href="<?php echo e(route('doctor.analyses.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.analyses*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Analyses</a>
            <a href="<?php echo e(route('doctor.prescriptions.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.prescriptions*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Ordonnances</a>
            <a href="<?php echo e(route('doctor.availabilities.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.availabilities*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Mes Horaires</a>
            <a href="<?php echo e(route('doctor.messages.index')); ?>" class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('doctor.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-slate-50 hover:text-blue-600'); ?>">Messagerie</a>
        </div>
    </nav>

    
    <main class="flex-1 p-4 md:p-8 pt-24 transition-all duration-300">
        <div class="max-w-7xl mx-auto space-y-6 md:space-y-8 animate-fade-in-up">
            
            
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-wider">
                <a href="<?php echo e(route('doctor.dashboard')); ?>" class="text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <span class="text-slate-300">/</span>
                <a href="<?php echo e(route('doctor.rendezvous.index')); ?>" class="text-slate-400 hover:text-blue-600 transition-colors">Agenda</a>
                <span class="text-slate-300">/</span>
                <span class="text-blue-600">Nouvelle consultation</span>
            </nav>

            
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                
                
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-6 md:px-8 md:py-7">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div>
                            <h2 class="text-xl md:text-2xl font-black text-white tracking-tight">Examen Médical</h2>
                            <p class="text-blue-200 text-[10px] font-black uppercase tracking-wider mt-1">
                                Patient : <?php echo e($rendezvous->patient->name); ?> | ID: #<?php echo e($rendezvous->patient->id); ?>

                            </p>
                        </div>
                        <div class="text-left sm:text-right">
                            <span class="block text-[9px] font-black text-blue-200 uppercase tracking-wider">Date de session</span>
                            <span class="font-bold text-sm text-white"><?php echo e(now()->translatedFormat('d F Y')); ?></span>
                        </div>
                    </div>
                </div>

                <form action="<?php echo e(route('doctor.consultations.store')); ?>" method="POST" class="p-6 md:p-8">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="rendezvous_id" value="<?php echo e($rendezvous->id); ?>">
                    <input type="hidden" name="patient_id" value="<?php echo e($rendezvous->patient_id); ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        
                        <div class="space-y-5 bg-slate-50/50 p-5 rounded-xl border border-slate-100 h-fit lg:sticky lg:top-28">
                            <h3 class="text-[10px] font-black uppercase text-blue-600 tracking-wider flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                Infos & Antécédents
                            </h3>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-black text-slate-500 mb-1 uppercase">Sexe</label>
                                    <select name="sexe" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                        <option value="M" <?php echo e($rendezvous->patient->sexe == 'M' ? 'selected' : ''); ?>>Masculin</option>
                                        <option value="F" <?php echo e($rendezvous->patient->sexe == 'F' ? 'selected' : ''); ?>>Féminin</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[9px] font-black text-slate-500 mb-1 uppercase">Groupe sanguin</label>
                                    <select name="groupe_sanguin" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                        <option value="">Non défini</option>
                                        <?php $__currentLoopData = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($gp); ?>" <?php echo e($rendezvous->patient->groupe_sanguin == $gp ? 'selected' : ''); ?>><?php echo e($gp); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[9px] font-black text-slate-500 mb-1 uppercase">Âge</label>
                                <div id="age_display" class="w-full bg-blue-100 rounded-xl p-3 font-black text-blue-700 text-sm text-center mb-2">
                                    <?php echo e($rendezvous->patient->date_naissance ? \Carbon\Carbon::parse($rendezvous->patient->date_naissance)->age . ' ans' : 'Non renseigné'); ?>

                                </div>
                                <input type="date" name="date_naissance" id="birth_date" value="<?php echo e($rendezvous->patient->date_naissance ? \Carbon\Carbon::parse($rendezvous->patient->date_naissance)->format('Y-m-d') : ''); ?>" 
                                       class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                            </div>

                            <div>
                                <label class="block text-[9px] font-black text-slate-500 mb-1 uppercase">Antécédents médicaux</label>
                                <textarea name="antecedents_medicaux" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-3 py-2.5 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none" placeholder="Diabète, Hypertension, etc..."><?php echo e($rendezvous->patient->antecedents_medicaux); ?></textarea>
                            </div>

                            <div>
                                <label class="block text-[9px] font-black text-rose-500 mb-1 uppercase">Allergies</label>
                                <textarea name="allergies" rows="2" class="w-full bg-white border border-rose-200 rounded-xl px-3 py-2.5 text-xs font-medium text-rose-600 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 outline-none transition-all resize-none" placeholder="Aucune allergie connue"><?php echo e($rendezvous->patient->allergies); ?></textarea>
                            </div>
                        </div>

                        
                        <div class="lg:col-span-2 space-y-6">
                            
                            
                            <div class="grid grid-cols-3 gap-4">
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <label class="block text-[8px] font-black text-slate-400 mb-1 uppercase">Tension</label>
                                    <input type="text" name="tension" placeholder="12/8" class="w-full bg-transparent border-none p-0 font-black text-slate-800 text-lg focus:ring-0">
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <label class="block text-[8px] font-black text-slate-400 mb-1 uppercase">Temp. (°C)</label>
                                    <input type="number" step="0.1" name="temperature" placeholder="37.2" class="w-full bg-transparent border-none p-0 font-black text-slate-800 text-lg focus:ring-0">
                                </div>
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                                    <label class="block text-[8px] font-black text-slate-400 mb-1 uppercase">Poids (kg)</label>
                                    <input type="number" step="0.1" name="poids" placeholder="70" class="w-full bg-transparent border-none p-0 font-black text-slate-800 text-lg focus:ring-0">
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-[9px] font-black uppercase text-slate-500 tracking-wider mb-2">Motif de consultation</label>
                                    <textarea name="motif" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none" placeholder="Pourquoi le patient consulte ?"></textarea>
                                </div>
                                <div>
                                    <label class="block text-[9px] font-black uppercase text-slate-500 tracking-wider mb-2">Examen physique</label>
                                    <textarea name="examen_physique" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none" placeholder="Résultats de l'auscultation..."></textarea>
                                </div>
                            </div>

                            
                            <div>
                                <label class="block text-[9px] font-black uppercase text-blue-600 tracking-wider mb-2">Diagnostic final <span class="text-rose-500">*</span></label>
                                <input type="text" name="diagnostic" required class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 font-bold text-slate-800 text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="Saisir le diagnostic précis...">
                            </div>

                            
                            <div class="bg-white rounded-xl border-2 border-dashed border-blue-100 p-5">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="text-[10px] font-black uppercase text-slate-600 tracking-wider flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                        </svg>
                                        Analyses (Si nécessaire)
                                    </h4>
                                    <button type="button" onclick="addAnalyseRow()" class="px-3 py-1.5 bg-blue-600 text-white rounded-lg text-[9px] font-black uppercase tracking-wider hover:bg-blue-700 transition-all">
                                        + Prescrire
                                    </button>
                                </div>
                                <div id="analyses-container" class="space-y-2"></div>
                                <div id="no-analyse-msg" class="text-center py-4 text-[9px] font-bold text-slate-300 uppercase tracking-wider">Aucune analyse pour le moment</div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 border-t border-slate-100 mt-8 pt-8">
                        <a href="<?php echo e(route('doctor.dashboard')); ?>" class="text-[10px] font-black uppercase text-slate-400 hover:text-rose-500 tracking-wider py-2 transition-colors">Annuler</a>
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 bg-slate-800 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-blue-600 hover:-translate-y-0.5 transition-all duration-300 shadow-md">
                            Enregistrer la consultation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    // Calcul d'âge automatique
    document.getElementById('birth_date').addEventListener('change', function() {
        const birthDate = new Date(this.value);
        const today = new Date();
        if (!isNaN(birthDate.getTime())) {
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) age--;
            document.getElementById('age_display').innerHTML = age + " ans";
        }
    });

    // Analyses dynamiques
    function addAnalyseRow() {
        const container = document.getElementById('analyses-container');
        const noMsg = document.getElementById('no-analyse-msg');
        if (noMsg) noMsg.style.display = 'none';

        const div = document.createElement('div');
        div.className = "flex items-center gap-2 animate-slide-in";
        div.innerHTML = `
            <input type="text" name="analyses[]" required
                class="flex-1 bg-blue-50 border border-blue-100 rounded-xl px-3 py-2.5 text-xs font-bold text-blue-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                placeholder="Nom de l'analyse (ex: NFS, Glycémie...)">
            <button type="button" onclick="removeRow(this)" class="p-2.5 bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-500 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        `;
        container.appendChild(div);
    }

    function removeRow(btn) {
        btn.closest('.animate-slide-in').remove();
        const container = document.getElementById('analyses-container');
        if (container.children.length === 0) {
            document.getElementById('no-analyse-msg').style.display = 'block';
        }
    }
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/consultations/create.blade.php ENDPATH**/ ?>