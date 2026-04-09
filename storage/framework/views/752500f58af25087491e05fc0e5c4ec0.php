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
<div x-data="{ openSidebar: false }" class="flex h-screen bg-[#F8FAFC] overflow-hidden">

    
    <div x-show="openSidebar" x-cloak @click="openSidebar = false"
        class="fixed inset-0 bg-black/30 z-30 lg:hidden"></div>

    
    <aside 
        class="fixed lg:static inset-y-0 left-0 z-40 w-72 bg-slate-50/90 backdrop-blur-xl border-r border-gray-100 transform transition-transform duration-300"
        :class="openSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

        
        <div class="flex items-center justify-between p-4 lg:hidden">
            <h2 class="font-black text-blue-600 text-sm">Contacts</h2>
            <button @click="openSidebar = false" class="p-2 bg-white rounded-lg shadow">✕</button>
        </div>

        
        <div class="p-4 border-b border-gray-100">
            <input type="text" id="contactSearch" placeholder="Rechercher un contact..." 
                class="w-full bg-white border-none rounded-xl px-4 py-3 text-xs font-bold shadow-sm focus:ring-2 focus:ring-blue-500/10">
        </div>

        
        <div id="contactList" class="flex-1 overflow-y-auto px-3 py-4 space-y-2">
            
            <h3 class="text-[9px] font-black text-gray-400 uppercase px-2 mb-2">Médecins</h3>
            <?php if(isset($medecins)): ?>
                <?php $__currentLoopData = $medecins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medecin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('patient.messages.show', $medecin->id)); ?>" 
                    data-name="<?php echo e(strtolower($medecin->name)); ?>"
                    class="contact-item flex items-center p-3 rounded-xl transition-all hover:bg-white hover:shadow group
                    <?php echo e((isset($receiver) && $receiver->id == $medecin->id) ? 'bg-white shadow border-l-4 border-blue-600' : ''); ?>">

                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black shrink-0
                        <?php echo e((isset($receiver) && $receiver->id == $medecin->id) ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600'); ?>">
                        <?php echo e(strtoupper(substr($medecin->name, 0, 1))); ?>

                    </div>

                    <div class="ml-3 truncate">
                        <h4 class="text-sm font-black text-gray-800 truncate"><?php echo e($medecin->name); ?></h4>
                        <p class="text-[10px] text-gray-400 uppercase truncate">
                            <?php echo e($medecin->specialite->nom ?? 'Généraliste'); ?>

                        </p>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            
            <h3 class="text-[9px] font-black text-gray-400 uppercase mt-6 px-2 mb-2">Administration</h3>
            <?php if(isset($secretaires)): ?>
                <?php $__currentLoopData = $secretaires; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $secretaire): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('patient.messages.show', $secretaire->id)); ?>" 
                    data-name="<?php echo e(strtolower($secretaire->name)); ?>"
                    class="contact-item flex items-center p-3 rounded-xl transition-all hover:bg-white hover:shadow group
                    <?php echo e((isset($receiver) && $receiver->id == $secretaire->id) ? 'bg-white shadow border-l-4 border-blue-600' : ''); ?>">

                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black shrink-0 bg-slate-100 text-slate-500">
                        <?php echo e(strtoupper(substr($secretaire->name, 0, 1))); ?>

                    </div>

                    <div class="ml-3 truncate">
                        <h4 class="text-sm font-black text-gray-700 truncate"><?php echo e($secretaire->name); ?></h4>
                        <p class="text-[10px] text-gray-400 uppercase truncate font-bold">Secrétariat</p>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <p class="text-[10px] text-gray-400 italic px-2">Aucun agent disponible</p>
            <?php endif; ?>
        </div>
    </aside>

    
    <main class="flex-1 flex flex-col min-w-0">

        
        <div class="flex items-center justify-between p-4 border-b bg-white z-20">
            <div class="flex items-center space-x-3">
                <button @click="openSidebar = true" class="lg:hidden p-2 bg-slate-50 rounded-lg">
                    <span class="text-xl">☰</span>
                </button>

                <a href="<?php echo e(route('patient.dashboard')); ?>" class="p-2 bg-white rounded-lg shadow-sm border text-gray-400 hover:text-blue-600 transition">
                    ←
                </a>

                <h1 class="text-base md:text-xl font-black text-gray-800 italic">
                    Ma <span class="text-blue-600">Messagerie</span>
                </h1>
            </div>

            <div class="hidden md:flex items-center space-x-2 text-[10px] font-black text-gray-400 uppercase">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <span>Serveur sécurisé Santé+</span>
            </div>
        </div>

        
        <div class="flex-1 flex flex-col bg-[#FBFBFF] relative overflow-hidden">

            <?php if(isset($receiver)): ?>

                
                <div class="flex items-center p-4 border-b bg-white/80 backdrop-blur-md">
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center font-black mr-3 shadow-lg shadow-blue-200">
                        <?php echo e(strtoupper(substr($receiver->name, 0, 1))); ?>

                    </div>

                    <div>
                        <h3 class="font-black text-gray-800 text-sm">
                            <?php echo e(in_array($receiver->role, ['doctor', 'medecin']) ? 'Dr.' : ''); ?> <?php echo e($receiver->name); ?>

                        </h3>
                      
                    </div>
                </div>

                
                <div id="message-container" class="flex-1 overflow-y-auto p-4 space-y-6 scroll-smooth">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $isMe = $message->sender_id == Auth::id(); ?>

                        <div class="flex flex-col <?php echo e($isMe ? 'items-end' : 'items-start'); ?>">
                            <div class="max-w-[85%] md:max-w-[65%] px-4 py-3 rounded-2xl shadow-sm text-sm
                                <?php echo e($isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white border border-gray-100 text-gray-700 rounded-bl-none'); ?>">
                                <p class="font-semibold leading-relaxed"><?php echo e($message->content); ?></p>
                            </div>
                            <span class="text-[9px] text-gray-400 mt-1 font-bold uppercase">
                                <?php echo e($message->created_at->format('H:i')); ?>

                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="p-4 bg-white border-t">
                    <form action="<?php echo e(route('patient.messages.store')); ?>" method="POST" class="flex items-center space-x-2">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="receiver_id" value="<?php echo e($receiver->id); ?>">

                        <input type="text" name="content" required autocomplete="off"
                            placeholder="Écrivez votre message ici..."
                            class="flex-1 px-5 py-3 rounded-xl bg-slate-50 border-none text-sm focus:ring-2 focus:ring-blue-500/20 transition">

                        <button type="submit" class="bg-blue-600 text-white p-3.5 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 hover:-translate-y-0.5 transition-all">
                            ➤
                        </button>
                    </form>
                </div>

            <?php else: ?>
                
                <div class="flex-1 flex flex-col items-center justify-center text-center p-6">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl">💬</span>
                    </div>
                    <h3 class="font-black text-gray-800">Vos conversations</h3>
                    <p class="text-gray-400 text-xs mt-1 max-w-[200px]">Sélectionnez un contact pour démarrer une discussion sécurisée.</p>
                </div>
            <?php endif; ?>

        </div>
    </main>
</div>

<script>
    // Scroll auto vers le bas
    const scrollToBottom = () => {
        const container = document.getElementById('message-container');
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    };

    window.onload = scrollToBottom;

    // Filtre de recherche
    document.getElementById('contactSearch').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.contact-item').forEach(c => {
            const name = c.dataset.name;
            c.style.display = name.includes(term) ? 'flex' : 'none';
        });
    });
</script>

<style>
    [x-cloak] { display: none !important; }
    #message-container::-webkit-scrollbar { width: 4px; }
    #message-container::-webkit-scrollbar-track { bg: transparent; }
    #message-container::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/messages/show.blade.php ENDPATH**/ ?>