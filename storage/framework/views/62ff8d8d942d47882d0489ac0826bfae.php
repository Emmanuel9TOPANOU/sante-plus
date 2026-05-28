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
<div class="flex min-h-screen bg-gradient-to-br from-blue-50 to-white" x-data="{ mobileMenuOpen: false }">

    
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
                    <a href="<?php echo e(route('patient.prescriptions.index')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.prescriptions*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Ordonnances
                    </a>
                    <a href="<?php echo e(route('patient.lab_results.index')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.lab_results*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Analyses
                    </a>
                    
                    <a href="<?php echo e(route('patient.medical_record.index')); ?>" 
                       class="px-5 py-2.5 rounded-xl text-sm font-semibold transition-all <?php echo e(request()->routeIs('patient.medical_record*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-600 hover:bg-blue-50'); ?>">
                       Dossier Médical
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
            <a href="<?php echo e(route('patient.prescriptions.index')); ?>" 
               class="block px-4 py-3 rounded-xl font-semibold transition-all <?php echo e(request()->routeIs('patient.prescriptions*') ? 'bg-blue-600 text-white' : 'text-slate-700 hover:bg-blue-50 hover:text-blue-600'); ?>">
               Ordonnances
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

    
    <main class="flex-1 p-4 md:p-8 min-h-screen pt-24 lg:pt-20">
        <div class="max-w-3xl mx-auto">
            
            
            <div class="mb-6">
                <a href="<?php echo e(route('patient.rendezvous.index')); ?>" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition font-bold text-sm group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Retour à mes rendez-vous
                </a>
            </div>

            
            <div class="bg-white rounded-2xl shadow-xl border border-blue-100 overflow-hidden">
                
                
                <div class="bg-blue-700 p-8 text-white">
                    <h1 class="text-2xl md:text-3xl font-black tracking-tight">
                        Prendre <span class="text-blue-200">Rendez-vous</span>
                    </h1>
                    <p class="text-blue-100 mt-2 font-medium">Planifiez votre consultation en quelques clics.</p>
                </div>

                
                <form action="<?php echo e(route('patient.rendezvous.store')); ?>" method="POST" id="rdvForm" class="p-6 md:p-8 space-y-8">
                    <?php echo csrf_field(); ?>

                    <?php if(session('error') || $errors->any()): ?>
                        <div class="bg-rose-50 border-l-4 border-rose-500 p-5 rounded-xl text-rose-700 text-xs font-bold space-y-1">
                            <?php if(session('error')): ?> <p><?php echo e(session('error')); ?></p> <?php endif; ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <p><?php echo e($error); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-slate-500">
                                <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px]">1</span>
                                Spécialité
                            </label>
                            <select id="specialite_filter" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none">
                                <option value="">Toutes les spécialités</option>
                                <?php $__currentLoopData = $specialites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($spe->id); ?>"><?php echo e($spe->nom_specialite); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-slate-500">
                                <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px]">2</span>
                                Praticien
                            </label>
                            <select name="medecin_id" id="medecin_id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none">
                                <option value="" disabled selected>Choisir un médecin...</option>
                                <?php $__currentLoopData = $medecins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medecin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($medecin->id); ?>" 
                                            data-specialite="<?php echo e($medecin->specialite_id); ?>"
                                            data-is-specialist="<?php echo e($medecin->specialite_id != 1 ? 'true' : 'false'); ?>"
                                            data-user="<?php echo e($medecin->user_id); ?>">
                                        Dr. <?php echo e($medecin->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-slate-500">
                                <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px]">3</span>
                                Dates disponibles
                            </label>
                            <div id="dates_container" class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto pr-2">
                                <!-- Dates will appear here -->
                            </div>
                            <input type="hidden" name="date_rdv" id="date_rdv_hidden" required>
                        </div>

                        
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 text-[11px] font-black uppercase tracking-wider text-slate-500">
                                <span class="w-5 h-5 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-[10px]">4</span>
                                Créneaux disponibles
                            </label>
                            <div id="heures_container" class="grid grid-cols-3 gap-2">
                                <!-- Hours will appear here -->
                            </div>
                            <input type="hidden" name="heure_rdv" id="heure_rdv_hidden" required>
                            
                            <div id="msg_select" class="text-[11px] text-slate-400 font-medium bg-slate-50 p-5 rounded-xl border border-dashed border-slate-200 text-center">
                                Sélectionnez un médecin pour voir ses disponibilités.
                            </div>
                        </div>
                    </div>

                    
                    <div class="space-y-2">
                        <label class="text-[11px] font-black uppercase tracking-wider text-slate-500 ml-1">Motif (Optionnel)</label>
                        <textarea name="motif" rows="2" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition outline-none placeholder:text-slate-300" placeholder="Ex: Consultation de suivi..."></textarea>
                    </div>

                    
                    <button type="submit" id="submitBtn" disabled class="w-full py-4 bg-slate-200 text-white rounded-xl font-black uppercase tracking-wider text-sm shadow-md transition-all duration-300 flex items-center justify-center gap-3 cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Confirmer le rendez-vous
                    </button>
                </form>
            </div>
        </div>
    </main>

</div>

<script>
    const specialiteSelect = document.getElementById('specialite_filter');
    const medecinSelect = document.getElementById('medecin_id');
    const datesContainer = document.getElementById('dates_container');
    const dateHidden = document.getElementById('date_rdv_hidden');
    const heuresContainer = document.getElementById('heures_container');
    const heureHidden = document.getElementById('heure_rdv_hidden');
    const msgSelect = document.getElementById('msg_select');
    const submitBtn = document.getElementById('submitBtn');

    const disponibilites = <?php echo json_encode($disponibilites, 15, 512) ?>;

    // Format date FR
    function formatDateFr(dateStr) {
        const d = new Date(dateStr);
        return d.toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' });
    }

    // 1. Filtre Spécialité -> Médecins
    specialiteSelect.addEventListener('change', function() {
        const speId = this.value; 
        medecinSelect.value = ""; 
        resetAll();

        Array.from(medecinSelect.options).forEach(opt => {
            if (opt.value === "") return;
            const isMatch = speId === "" || opt.dataset.specialite === speId;
            opt.style.display = isMatch ? "block" : "none";
            opt.disabled = !isMatch;
        });
    });

    // 2. Sélection Médecin -> Affichage immédiat des Dates
    medecinSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const userId = selectedOption.dataset.user;
        
        resetAll();

        if (disponibilites[userId] && Object.keys(disponibilites[userId]).length > 0) {
            msgSelect.classList.add('hidden');
            
            Object.keys(disponibilites[userId]).forEach(dateStr => {
                const btnDate = document.createElement('button');
                btnDate.type = "button";
                btnDate.innerText = formatDateFr(dateStr);
                btnDate.className = "py-3 bg-white border border-slate-200 rounded-xl text-[11px] font-semibold text-slate-600 shadow-sm transition-all hover:border-blue-400 hover:bg-blue-50";
                
                btnDate.onclick = function() {
                    datesContainer.querySelectorAll('button').forEach(b => b.className = "py-3 bg-white border border-slate-200 rounded-xl text-[11px] font-semibold text-slate-600 shadow-sm transition-all");
                    this.className = "py-3 bg-blue-600 text-white rounded-xl text-[11px] font-bold shadow-md transition-all";
                    
                    dateHidden.value = dateStr;
                    showHeures(userId, dateStr);
                };
                datesContainer.appendChild(btnDate);
            });
        } else {
            msgSelect.classList.remove('hidden');
            msgSelect.innerText = "Aucune date disponible pour ce praticien.";
            msgSelect.className = "text-[11px] font-medium p-5 rounded-xl border border-rose-200 bg-rose-50 text-rose-500 text-center";
        }
    });

    function showHeures(userId, dateStr) {
        heuresContainer.innerHTML = "";
        heureHidden.value = "";
        disableSubmit();

        const slots = disponibilites[userId][dateStr];
        slots.forEach(heure => {
            const btn = document.createElement('button');
            btn.type = "button";
            btn.innerText = heure.substring(0, 5);
            btn.className = "py-3 bg-white border border-slate-200 rounded-xl text-[11px] font-semibold text-slate-600 transition-all hover:border-blue-400 hover:bg-blue-50";
            
            btn.onclick = function() {
                heuresContainer.querySelectorAll('button').forEach(b => b.className = "py-3 bg-white border border-slate-200 rounded-xl text-[11px] font-semibold text-slate-600 transition-all");
                this.className = "py-3 bg-blue-600 text-white rounded-xl text-[11px] font-bold shadow-md transition-all";
                
                heureHidden.value = heure;
                enableSubmit();
            };
            heuresContainer.appendChild(btn);
        });
    }

    function resetAll() {
        datesContainer.innerHTML = "";
        heuresContainer.innerHTML = "";
        dateHidden.value = "";
        heureHidden.value = "";
        disableSubmit();
        msgSelect.classList.remove('hidden');
        msgSelect.className = "text-[11px] text-slate-400 font-medium bg-slate-50 p-5 rounded-xl border border-dashed border-slate-200 text-center";
        msgSelect.innerText = "Sélectionnez un médecin pour voir ses disponibilités.";
    }

    function enableSubmit() {
        submitBtn.disabled = false;
        submitBtn.classList.remove('bg-slate-200', 'cursor-not-allowed');
        submitBtn.classList.add('bg-blue-600', 'cursor-pointer', 'hover:bg-blue-700');
    }

    function disableSubmit() {
        submitBtn.disabled = true;
        submitBtn.classList.remove('bg-blue-600', 'cursor-pointer', 'hover:bg-blue-700');
        submitBtn.classList.add('bg-slate-200', 'cursor-not-allowed');
    }
</script>

<style>
    [x-cloak] { display: none !important; }
    body { 
        font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
    }
    select, textarea {
        appearance: none;
        -webkit-appearance: none;
    }
    #dates_container::-webkit-scrollbar,
    #heures_container::-webkit-scrollbar {
        width: 4px;
    }
    #dates_container::-webkit-scrollbar-track,
    #heures_container::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    #dates_container::-webkit-scrollbar-thumb,
    #heures_container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/rendezvous/create.blade.php ENDPATH**/ ?>