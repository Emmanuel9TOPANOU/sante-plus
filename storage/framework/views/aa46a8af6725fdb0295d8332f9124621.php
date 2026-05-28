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
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 to-white" x-data="{ mobileMenuOpen: false, openSidebar: false }">

    
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="mobileMenuOpen = false" 
         class="fixed inset-0 bg-blue-900/40 backdrop-blur-sm z-[40] lg:hidden" x-cloak>
    </div>

    
    <nav class="fixed top-0 left-0 right-0 bg-white shadow-md border-b border-blue-100 z-50">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="flex justify-between items-center h-20">
                
                
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center">
                        <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo MonEspaceSanté" class="w-full h-full object-contain">
                    </div>
                </div>

                
                <div class="hidden lg:flex items-center gap-1">
                    <a href="<?php echo e(route('patient.dashboard')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Tableau de bord
                    </a>
                    <a href="<?php echo e(route('patient.rendezvous.index')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Rendez-vous
                    </a>
                 
                    <a href="<?php echo e(route('patient.lab_results.index')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Analyses
                    </a>
                  
                    <a href="<?php echo e(route('patient.medical_record.index')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Dossier Medical
                    </a>
                    <a href="<?php echo e(route('patient.messages.index')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Messagerie
                    </a>
                </div>

                
                <div class="flex items-center gap-4">
                    <?php if(auth()->guard()->check()): ?>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-[11px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-700 transition-all duration-300 shadow-md cursor-pointer">
                                <span>Quitter</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                            </button>
                        </form>
                    <?php endif; ?>

                    
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-700 hover:bg-blue-50 rounded-xl transition-all">
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

        
        <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false" class="lg:hidden bg-white border-t border-blue-100 px-4 py-4 space-y-2 shadow-xl">
            <a href="<?php echo e(route('patient.dashboard')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
                Tableau de bord
            </a>
            <a href="<?php echo e(route('patient.rendezvous.index')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.rendezvous*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
               Rendez-vous
            </a>
        
            <a href="<?php echo e(route('patient.lab_results.index')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
              Analyses
            </a>
            
            <a href="<?php echo e(route('patient.medical_record.index')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
               Dossier Médical
            </a>
            <a href="<?php echo e(route('patient.messages.index')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.messages*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
               Messagerie
            </a>
        </div>
    </nav>

  
<main class="flex-1 h-full min-h-screen ">
    <div class="flex h-full min-h-[calc(100vh-5rem)] bg-gradient-to-br from-slate-50 via-white to-blue-50/30 font-sans">

        
        <aside 
            class="fixed inset-y-0 left-0 w-80 max-w-full bg-white/95 backdrop-blur-xl border-r border-slate-200/60 shadow-2xl transform transition-all duration-500 ease-out rounded-r-3xl
            z-40 md:z-30 lg:static lg:translate-x-0"
            :class="openSidebar ? 'translate-x-0' : '-translate-x-full'"
            style="top: 80px; height: calc(100dvh - 80px);">

            
            <div class="flex items-center justify-between p-5 lg:hidden border-b border-slate-100">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-500 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h2 class="font-black text-slate-700 uppercase text-xs tracking-widest">Messages</h2>
                </div>
                <button @click="openSidebar = false" class="p-2 bg-slate-100 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-200 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            
            <div class="p-5 border-b border-slate-100">
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="contactSearch" placeholder="Rechercher un médecin..." 
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-sm font-medium focus:ring-2 focus:ring-blue-200 focus:border-blue-300 placeholder:text-slate-400 focus:outline-none transition-all">
                </div>
            </div>

            
            <div id="contactList" class="flex-1 overflow-y-auto p-3 space-y-1.5 scrollbar-thin scrollbar-thumb-slate-200 scrollbar-track-transparent" style="height: calc(100% - 130px);">
                <h3 class="px-3 pt-2 pb-1 text-[10px] font-black text-slate-400 uppercase tracking-widest">Vos Praticiens</h3>

                <?php $__currentLoopData = $medecins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medecin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $unread = $unreadCounts[$medecin->id] ?? 0;
                    $isActive = (isset($receiver) && $receiver->id == $medecin->id);
                ?>

                <a href="<?php echo e(route('patient.messages.show', $medecin->id)); ?>"
                    data-name="<?php echo e(strtolower($medecin->name)); ?>"
                    class="contact-item flex items-center p-3 rounded-xl transition-all duration-300 relative group
                    <?php echo e($isActive 
                        ? 'bg-gradient-to-r from-blue-50 to-white shadow-md border border-blue-200/50' 
                        : 'hover:bg-slate-50 hover:shadow-sm'); ?>">
                    
                    <div class="relative">
                        <div class="w-12 h-12 <?php echo e($isActive ? 'bg-gradient-to-br from-blue-600 to-blue-500 text-white shadow-lg shadow-blue-200' : 'bg-slate-100 text-slate-600 group-hover:bg-blue-100 group-hover:text-blue-600'); ?> flex items-center justify-center rounded-xl font-black transition-all duration-300">
                            <?php echo e(strtoupper(substr($medecin->name, 0, 1))); ?>

                        </div>
                        <?php if($unread > 0): ?>
                            <span class="absolute -top-1 -right-1 bg-gradient-to-br from-red-500 to-rose-500 text-white text-[9px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-white shadow-lg animate-pulse">
                                <?php echo e($unread); ?>

                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="ml-3 flex-1 truncate">
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-black <?php echo e($isActive ? 'text-blue-700' : 'text-slate-700 group-hover:text-blue-700'); ?> truncate">
                                Dr. <?php echo e($medecin->name); ?>

                            </h4>
                            <?php if($isActive): ?>
                                <span class="w-2 h-2 bg-blue-500 rounded-full shadow-sm shadow-blue-200"></span>
                            <?php endif; ?>
                        </div>
                        <p class="text-[10px] <?php echo e($isActive ? 'text-blue-400' : 'text-slate-400 group-hover:text-blue-400'); ?> font-semibold uppercase tracking-tight truncate mt-0.5">
                            <?php if($medecin->specialite): ?>
                                <?php echo e($medecin->specialite->nom); ?>

                            <?php else: ?>
                                <span class="text-amber-500">Spécialité non définie</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if($medecins->isEmpty()): ?>
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <p class="text-[11px] text-slate-400 font-bold uppercase italic">Aucun médecin disponible</p>
                    </div>
                <?php endif; ?>
            </div>
        </aside>

        
        <div x-show="openSidebar" x-transition.opacity.duration.300 @click="openSidebar = false"
            class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-30 md:z-20 lg:hidden"></div>

        
        <div class="flex-1 flex flex-col h-full relative min-w-0">

            
            <div class="flex items-center justify-between p-5 border-b border-slate-100 bg-white/80 backdrop-blur-md">
                <div class="flex items-center space-x-3">
                    <button @click="openSidebar = true" class="lg:hidden p-2.5 bg-white rounded-xl shadow-md border border-slate-100 text-blue-600 hover:bg-blue-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>

                    <a href="<?php echo e(route('patient.dashboard')); ?>" class="p-2.5 bg-white rounded-xl shadow-md border border-slate-100 text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                    </a>

                    <div class="ml-2">
                        <h1 class="text-base md:text-lg font-black text-slate-800 tracking-tight">
                            Ma <span class="bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">Messagerie</span>
                        </h1>
                        <p class="text-[9px] text-slate-400 font-semibold uppercase tracking-widest mt-0.5">Communication sécurisée</p>
                    </div>
                </div>

                <?php if(isset($receiver)): ?>
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-emerald-50 rounded-full">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Connecté</span>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="flex-1 flex flex-col bg-gradient-to-b from-slate-50 to-white">

                <?php if(isset($receiver)): ?>

                    
                    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100 bg-white/40 backdrop-blur-sm">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-500 text-white rounded-2xl flex items-center justify-center font-black text-lg shadow-lg shadow-blue-200 mr-4">
                                <?php echo e(strtoupper(substr($receiver->name, 0, 1))); ?>

                            </div>
                            <div>
                                <h3 class="font-black text-slate-800 text-base">
                                    Dr. <?php echo e($receiver->name); ?>

                                </h3>
                              
                            </div>
                        </div>
                        <div class="hidden md:flex items-center gap-2 text-xs text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span>Messagerie chiffrée</span>
                        </div>
                    </div>

                    
                    <div id="message-container" class="flex-1 overflow-y-auto p-6 space-y-4 scroll-smooth">
                        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $isMe = $message->sender_id == Auth::id(); ?>

                            <div class="flex <?php echo e($isMe ? 'justify-end' : 'justify-start'); ?> animate-fade-in-up">
                                <div class="max-w-[85%] md:max-w-[65%] lg:max-w-[55%]">
                                    <div class="relative px-5 py-3 shadow-sm transition-all duration-200
                                        <?php echo e($isMe 
                                            ? 'bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-2xl rounded-br-md' 
                                            : 'bg-white border border-slate-100 text-slate-700 rounded-2xl rounded-bl-md shadow-md'); ?>">
                                        
                                        <p class="text-sm leading-relaxed <?php echo e($isMe ? 'text-white' : 'text-slate-700'); ?>">
                                            <?php echo e($message->content); ?>

                                        </p>
                                    </div>
                                    <div class="mt-1.5 px-2 <?php echo e($isMe ? 'text-right' : 'text-left'); ?> text-[10px] font-medium text-slate-400">
                                        <?php echo e($message->created_at->translatedFormat('H:i')); ?>

                                        <?php if($isMe): ?>
                                            <span class="ml-1">
                                                <svg class="w-3 h-3 inline text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    
                    <div class="p-5 bg-white/90 backdrop-blur-sm border-t border-slate-100">
                        <form action="<?php echo e(route('patient.messages.store')); ?>" method="POST"
                            class="relative max-w-4xl mx-auto">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="receiver_id" value="<?php echo e($receiver->id); ?>">

                            <div class="relative flex items-center bg-slate-50 rounded-2xl border border-slate-200 focus-within:border-blue-300 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                                <textarea name="content" required rows="1"
                                    placeholder="Écrivez votre message au Dr. <?php echo e(explode(' ', $receiver->name)[0]); ?>..."
                                    class="flex-1 bg-transparent border-none text-sm font-medium focus:ring-0 placeholder:text-slate-400 px-5 py-3.5 resize-none focus:outline-none"
                                    style="min-height: 48px; max-height: 120px;"
                                    oninput="this.style.height = 'auto'; this.style.height = Math.min(this.scrollHeight, 120) + 'px'"></textarea>

                                <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-r from-blue-600 to-blue-500 text-white h-9 w-9 flex items-center justify-center rounded-xl shadow-md shadow-blue-200 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 active:scale-95">
                                    <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-[9px] text-slate-400 mt-2 text-center">
                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Messages confidentiels et sécurisés
                            </p>
                        </form>
                    </div>

                <?php else: ?>
                    
                    <div class="flex-1 flex flex-col items-center justify-center text-center p-8">
                        <div class="relative">
                            <div class="w-28 h-28 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                          
                        </div>
                        <h2 class="text-slate-800 font-black text-xl uppercase tracking-tight">Votre messagerie médicale</h2>
                        <p class="text-slate-400 text-sm max-w-sm mt-2 font-medium">Sélectionnez un médecin dans la liste pour démarrer une conversation sécurisée.</p>
                        
                        <div class="mt-8 flex items-center gap-4 text-xs text-slate-300">
                            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-emerald-400 rounded-full"></span> Confidentiel</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-blue-400 rounded-full"></span> Chiffré</span>
                            <span class="flex items-center gap-1"><span class="w-2 h-2 bg-amber-400 rounded-full"></span> Sécurisé</span>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.3s ease-out;
    }
    textarea {
        overflow-y: hidden;
    }
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }
    .scrollbar-thumb-slate-200::-webkit-scrollbar-thumb {
        background-color: #e2e8f0;
        border-radius: 9999px;
    }
    .scrollbar-track-transparent::-webkit-scrollbar-track {
        background-color: transparent;
    }
</style>


</div>

<script>
    // Scroll automatique vers le bas
    const container = document.getElementById('message-container');
    if(container) {
        container.scrollTop = container.scrollHeight;
    }

    // Moteur de recherche simple
    const searchInput = document.getElementById('contactSearch');
    if(searchInput) {
        searchInput.addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.contact-item').forEach(c => {
                const name = c.dataset.name;
                c.style.display = name && name.includes(term) ? 'flex' : 'none';
            });
        });
    }
</script>

<style>
    [x-cloak] { display: none !important; }
    body { 
        font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
    }
    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
    }
    .scrollbar-thumb-blue-100::-webkit-scrollbar-thumb {
        background-color: #dbeafe;
        border-radius: 9999px;
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/messages/index.blade.php ENDPATH**/ ?>