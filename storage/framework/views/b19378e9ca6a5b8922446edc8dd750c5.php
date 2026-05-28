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
<div x-data="{ mobileMenuOpen: false, openSidebar: false }" class="flex min-h-screen bg-gradient-to-br from-slate-100 to-white font-sans antialiased">

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
        
        .contact-item {
            transition: all 0.2s ease;
        }
        .contact-item:hover {
            transform: translateX(4px);
        }
        
        .message-bubble {
            transition: all 0.2s ease;
        }
        
        .scrollbar-thin::-webkit-scrollbar {
            width: 4px;
        }
        .scrollbar-thumb-blue-100::-webkit-scrollbar-thumb {
            background-color: #dbeafe;
            border-radius: 9999px;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-2px); }
        }
        .animate-bounce-slow {
            animation: bounce 1s ease-in-out infinite;
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
                <span class="text-blue-600">Messagerie</span>
            </nav>

            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
               
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Ma <span class="text-blue-600">Messagerie</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">Échangez en toute confidentialité avec vos patients et l'administration</p>
                </div>
                
                <div class="glass-effect px-6 py-3.5 rounded-2xl shadow-sm text-sm font-medium text-slate-600 border border-white/50 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <?php echo e(now()->translatedFormat('l d F Y')); ?>

                </div>
            </div>

   

            
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="flex flex-col lg:flex-row min-h-[600px]">
                    
                    
                    <div class="w-full lg:w-80 border-r border-slate-100 bg-slate-50/30">
                        <div class="p-4 border-b border-slate-100">
                            <div class="relative">
                                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" id="contactSearch" placeholder="Rechercher un contact..." 
                                       class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                            </div>
                        </div>
                        
                        <div id="contactList" class="overflow-y-auto h-[500px] lg:h-[540px] p-2 space-y-1">
                            
                            <h3 class="px-3 pt-2 pb-1 text-[10px] font-black text-slate-400 uppercase tracking-wider">Administration</h3>
                            <?php $__currentLoopData = $secretaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secretaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $isActive = (isset($activeContact) && $activeContact->id == $secretaire->id); ?>
                            <a href="<?php echo e(route('doctor.messages.show', $secretaire->id)); ?>"
                                data-name="<?php echo e(strtolower($secretaire->name)); ?>"
                                class="contact-item flex items-center gap-3 p-3 rounded-xl transition-all duration-200 <?php echo e($isActive ? 'bg-blue-50 border-l-4 border-blue-600' : 'hover:bg-slate-100'); ?>">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 font-bold">
                                    <?php echo e(strtoupper(substr($secretaire->name, 0, 1))); ?>

                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-slate-800 text-sm truncate"><?php echo e($secretaire->name); ?></p>
                                    <p class="text-[10px] text-slate-400 font-medium">Secrétariat</p>
                                </div>
                                <?php if($isActive): ?>
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                <?php endif; ?>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <h3 class="px-3 pt-4 pb-1 text-[10px] font-black text-slate-400 uppercase tracking-wider">Patients</h3>
                            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $isActive = (isset($activeContact) && $activeContact->id == $patient->id); ?>
                            <a href="<?php echo e(route('doctor.messages.show', $patient->id)); ?>"
                                data-name="<?php echo e(strtolower($patient->name)); ?>"
                                class="contact-item flex items-center gap-3 p-3 rounded-xl transition-all duration-200 <?php echo e($isActive ? 'bg-blue-50 border-l-4 border-blue-600' : 'hover:bg-slate-100'); ?>">
                                <div class="relative">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                        <?php echo e(strtoupper(substr($patient->name, 0, 1))); ?>

                                    </div>
                                    <?php if($patient->unread > 0): ?>
                                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center"><?php echo e($patient->unread); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-slate-800 text-sm truncate"><?php echo e($patient->name); ?></p>
                                    <p class="text-[10px] text-slate-400 font-medium">Patient</p>
                                </div>
                                <?php if($patient->unread > 0): ?>
                                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                                <?php endif; ?>
                                <?php if($isActive): ?>
                                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span>
                                <?php endif; ?>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    
                    <div class="flex-1 flex flex-col">
                        <?php if(isset($activeContact)): ?>
                            
                            <div class="flex items-center gap-3 p-4 border-b border-slate-100 bg-white">
                                <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-md">
                                    <?php echo e(strtoupper(substr($activeContact->name, 0, 1))); ?>

                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800"><?php echo e($activeContact->name); ?></h3>
                                    <div class="flex items-center gap-1.5">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-bounce-slow"></span>
                                        <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-wider">En ligne</p>
                                    </div>
                                </div>
                            </div>

                            
                            <div id="message-container" class="flex-1 overflow-y-auto p-5 space-y-4 bg-gradient-to-b from-slate-50 to-white">
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $isMe = $message->sender_id == Auth::id(); ?>
                                    <div class="flex <?php echo e($isMe ? 'justify-end' : 'justify-start'); ?>">
                                        <div class="max-w-[80%]">
                                            <div class="px-4 py-2.5 rounded-2xl <?php echo e($isMe ? 'bg-blue-600 text-white rounded-br-sm' : 'bg-white border border-slate-200 text-slate-700 rounded-bl-sm shadow-sm'); ?>">
                                                <p class="text-sm leading-relaxed"><?php echo e($message->content); ?></p>
                                            </div>
                                            <p class="text-[9px] text-slate-400 mt-1 px-2 <?php echo e($isMe ? 'text-right' : 'text-left'); ?>">
                                                <?php echo e($message->created_at->translatedFormat('H:i')); ?>

                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            
                            <div class="p-4 border-t border-slate-100 bg-white">
                                <form action="<?php echo e(route('doctor.messages.store')); ?>" method="POST" class="flex gap-2">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="receiver_id" value="<?php echo e($activeContact->id); ?>">
                                    <input type="text" name="content" required autocomplete="off"
                                           placeholder="Écrivez votre message..."
                                           class="flex-1 px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                    <button type="submit" class="px-4 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all shadow-md shadow-blue-200">
                                        <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            
                            <div class="flex-1 flex flex-col items-center justify-center p-8">
                                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-5">
                                    <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </div>
                                <h3 class="text-slate-800 font-black text-lg">Aucune conversation</h3>
                                <p class="text-slate-400 text-sm max-w-xs text-center mt-2">Sélectionnez un contact dans la liste pour démarrer une discussion sécurisée</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    // Scroll automatique vers le bas
    const container = document.getElementById('message-container');
    if(container) {
        container.scrollTop = container.scrollHeight;
    }
    
    // Moteur de recherche
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
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/messages/index.blade.php ENDPATH**/ ?>