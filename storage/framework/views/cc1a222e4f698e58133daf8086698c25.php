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
<div class="flex h-screen bg-[#F8FAFC] font-sans overflow-hidden" x-data="{ sidebarOpen: false, search: '' }">

    
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-50 w-80 bg-white lg:static lg:flex lg:flex-col border-r border-gray-100 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">
        
        <div class="flex flex-col h-full">
            
            <div class="flex items-center justify-between px-6 py-6 lg:hidden bg-blue-600 text-white">
                <h2 class="font-black text-xl italic uppercase tracking-tighter">Contacts</h2>
                <button @click="sidebarOpen = false" class="text-white p-2">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            
            <div class="px-6 py-6 border-b border-gray-50">
                <div class="relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" x-model="search" placeholder="Rechercher un patient..." 
                           class="w-full pl-11 pr-4 py-3.5 rounded-[1.2rem] border-none bg-slate-50 text-sm font-bold placeholder-gray-300 focus:ring-4 focus:ring-blue-500/10 transition shadow-inner">
                </div>
            </div>

            
            <div class="flex-1 overflow-y-auto px-4 py-4 space-y-2 scrollbar-hide">
                


                <?php $__currentLoopData = $secretaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secretaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('doctor.messages.show', $secretaire->id)); ?>" 
                   x-show="'<?php echo e(strtolower($secretaire->name)); ?>'.includes(search.toLowerCase())"
                   class="flex items-center p-3.5 rounded-[1.2rem] transition-all duration-200 <?php echo e(isset($activeContact) && $activeContact->id == $secretaire->id ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 active-contact' : 'hover:bg-slate-50 text-gray-700'); ?>">
                    <div class="w-12 h-12 rounded-xl <?php echo e(isset($activeContact) && $activeContact->id == $secretaire->id ? 'bg-white/20' : 'bg-slate-100 text-slate-500'); ?> flex items-center justify-center font-black text-lg">
                        <?php echo e(strtoupper(substr($secretaire->name,0,1))); ?>

                    </div>
                    <div class="ml-3 flex-1 truncate">
                        <h4 class="font-black text-sm truncate uppercase tracking-tighter">Secr. <?php echo e($secretaire->name); ?></h4>
                        <p class="<?php echo e(isset($activeContact) && $activeContact->id == $secretaire->id ? 'text-blue-100' : 'text-emerald-500'); ?> text-[9px] font-black uppercase tracking-widest">Ligne Directe</p>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($contact->role !== 'secretaire'): ?>
                    <a href="<?php echo e(route('doctor.messages.show', $contact->id)); ?>" 
                       x-show="'<?php echo e(strtolower($contact->name)); ?>'.includes(search.toLowerCase())"
                       class="flex items-center p-3.5 rounded-[1.2rem] transition-all duration-200 <?php echo e(isset($activeContact) && $activeContact->id == $contact->id ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'hover:bg-slate-50 text-gray-700'); ?>">
                        <div class="relative w-12 h-12 rounded-xl <?php echo e(isset($activeContact) && $activeContact->id == $contact->id ? 'bg-white/20 text-white' : 'bg-blue-50 text-blue-600'); ?> flex items-center justify-center font-black text-lg">
                            <?php echo e(strtoupper(substr($contact->name,0,1))); ?>

                            <?php if(($contact->unread ?? 0) > 0): ?>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-lg ring-2 ring-white animate-bounce"><?php echo e($contact->unread); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="ml-3 flex-1 truncate">
                            <h4 class="font-black text-sm truncate uppercase tracking-tighter"><?php echo e($contact->name); ?></h4>
                            <p class="<?php echo e(isset($activeContact) && $activeContact->id == $contact->id ? 'text-blue-100' : 'text-gray-400'); ?> text-[10px] italic truncate">
                                <?php echo e($contact->last_message_time ?? 'Patient'); ?>

                            </p>
                        </div>
                    </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </aside>

    
    <main class="flex-1 flex flex-col h-full bg-[#FBFBFF] relative overflow-hidden main-chat-section">
        
        
        <header class="h-20 flex items-center justify-between px-6 bg-white/80 backdrop-blur-md border-b border-gray-100 z-30">
            <div class="flex items-center">
                
                <button @click="sidebarOpen = true" class="lg:hidden mr-4 p-2 bg-slate-50 rounded-xl text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>

                <?php if(isset($activeContact)): ?>
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center text-white font-black text-sm shadow-lg shadow-blue-100 mr-3">
                            <?php echo e(strtoupper(substr($activeContact->name,0,1))); ?>

                        </div>
                        <div>
                            <h2 class="text-sm font-black text-gray-800 uppercase tracking-tight"><?php echo e($activeContact->name); ?></h2>
                        </div>
                    </div>
                <?php else: ?>
                    <h1 class="text-xl font-black text-gray-800 italic tracking-tighter">Santé<span class="text-blue-600">+</span> <span class="text-xs uppercase not-italic text-gray-400 ml-2 tracking-widest font-black">Messagerie</span></h1>
                <?php endif; ?>
            </div>
        </header>

        
        <div class="flex-1 overflow-y-auto p-4 md:p-8 space-y-6 scrollbar-thin scroll-smooth" id="chat-window">
            <?php if(isset($activeContact)): ?>
                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php $isMe = $message->sender_id === auth()->id(); ?>
                    <div class="flex flex-col <?php echo e($isMe ? 'items-end' : 'items-start'); ?> animate-fade-in-up">
                        <div class="max-w-[85%] md:max-w-[70%] p-4 rounded-2xl shadow-sm <?php echo e($isMe ? 'bg-blue-600 text-white rounded-tr-none shadow-blue-100' : 'bg-white text-gray-700 border border-gray-100 rounded-tl-none'); ?>">
                            <p class="text-sm font-medium leading-relaxed"><?php echo e($message->content); ?></p>
                            <?php if($message->file_path): ?>
                                <div class="mt-3 flex items-center p-3 rounded-xl <?php echo e($isMe ? 'bg-white/10 border border-white/20' : 'bg-slate-50 border border-gray-100'); ?>">
                                    <i class="fas fa-file-pdf <?php echo e($isMe ? 'text-white' : 'text-blue-600'); ?> text-lg"></i>
                                    <div class="ml-3 overflow-hidden">
                                        <a href="<?php echo e(asset('storage/' . $message->file_path)); ?>" target="_blank" class="block text-[10px] font-black uppercase tracking-widest underline truncate <?php echo e($isMe ? 'text-white' : 'text-blue-600'); ?>">
                                            Voir le document
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center mt-2 space-x-2">
                            <span class="text-[9px] font-black text-gray-300 uppercase tracking-tighter"><?php echo e($message->created_at->format('H:i')); ?></span>
                            <?php if($isMe): ?>
                                <i class="fas fa-check-double text-[9px] <?php echo e($message->is_read ? 'text-blue-400' : 'text-gray-200'); ?>"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-40">
                        <div class="w-20 h-20 bg-slate-100 rounded-[2.5rem] flex items-center justify-center mb-4">
                            <i class="fas fa-comment-dots text-3xl text-blue-600"></i>
                        </div>
                        <p class="font-black text-[10px] uppercase tracking-[0.3em] text-gray-400">Aucun message</p>
                        <p class="text-xs font-bold text-gray-300 mt-1">Envoyez le premier message pour lancer la discussion.</p>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                
                <div class="h-full flex flex-col items-center justify-center text-center px-10">
                    <div class="relative mb-8">
                        <div class="absolute inset-0 bg-blue-100 blur-3xl rounded-full opacity-30"></div>
                        <i class="fas fa-comments text-7xl text-blue-600/20 relative"></i>
                    </div>
                    <h2 class="font-black text-gray-800 text-xl uppercase tracking-widest mb-2">Centre de Messagerie</h2>
                    <p class="max-w-xs text-gray-400 font-bold text-xs leading-relaxed uppercase tracking-tighter">
                        Sélectionnez un membre de votre équipe ou un patient pour démarrer une conversation sécurisée.
                    </p>
                </div>
            <?php endif; ?>
        </div>

        
        <?php if(isset($activeContact)): ?>
            <div class="p-4 md:p-6 bg-white border-t border-gray-100 shadow-2xl">
                
                <div id="file-preview" class="hidden mb-3 p-3 bg-blue-50 border border-blue-100 rounded-xl text-blue-600 text-[10px] font-black uppercase flex items-center">
                    <i class="fas fa-file-paperclip mr-2"></i>
                    <span id="file-name"></span>
                    <button onclick="clearFile()" class="ml-auto text-red-500"><i class="fas fa-times"></i></button>
                </div>
                <form action="<?php echo e(route('doctor.messages.store')); ?>" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 message-input-row">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="receiver_id" value="<?php echo e($activeContact->id); ?>">
                    <label class="group cursor-pointer flex-shrink-0">
                        <div class="w-12 h-12 bg-slate-50 group-hover:bg-blue-50 rounded-2xl flex items-center justify-center text-gray-400 group-hover:text-blue-600 transition-all border border-gray-100">
                            <i class="fas fa-paperclip text-lg"></i>
                        </div>
                        <input type="file" name="attachment" id="attachment" class="hidden" onchange="handleFileSelect(this)">
                    </label>
                    <input type="text" name="content" required placeholder="Votre message..." 
                           class="flex-1 bg-slate-50 border-none rounded-2xl py-3.5 px-5 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-blue-500/10 placeholder-gray-300 transition">
                    <button type="submit" class="w-12 h-12 bg-blue-600 hover:bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex-shrink-0">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </main>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .animate-fade-in-up {
        animation: fadeInUp 0.4s ease-out forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 1023px) {
        aside.w-80 {
            width: 100vw !important;
            min-width: 0 !important;
            max-width: 100vw !important;
            border-radius: 0 0 2rem 2rem !important;
        }
        .main-chat-section {
            padding-top: 0 !important;
        }
    }
    @media (max-width: 767px) {
        #chat-window {
            padding: 0.5rem !important;
        }
        .message-input-row {
            flex-direction: column !important;
            gap: 0.5rem !important;
        }
        .message-input-row input[type="text"] {
            width: 100% !important;
        }
        .max-w-\[85\%\] { max-width: 98vw !important; }
    }
</style>

<script>
    // Scroll auto vers le bas
    const chatWindow = document.getElementById('chat-window');
    if(chatWindow) chatWindow.scrollTop = chatWindow.scrollHeight;

    // Gestion de l'aperçu du fichier
    function handleFileSelect(input) {
        const preview = document.getElementById('file-preview');
        const fileName = document.getElementById('file-name');
        if(input.files && input.files[0]) {
            preview.classList.remove('hidden');
            fileName.textContent = input.files[0].name.toUpperCase();
        }
    }

    function clearFile() {
        document.getElementById('attachment').value = '';
        document.getElementById('file-preview').classList.add('hidden');
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/messages/show.blade.php ENDPATH**/ ?>