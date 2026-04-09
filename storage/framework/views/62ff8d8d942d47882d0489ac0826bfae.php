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
    <div class="py-12 bg-[#F8FAFC] min-h-screen montserrat">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <a href="<?php echo e(route('patient.rendezvous.index')); ?>" class="inline-flex items-center text-slate-500 hover:text-blue-600 transition font-bold text-sm group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Retour à mes rendez-vous
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-slate-100 overflow-hidden">
                <div class="bg-gradient-to-br from-slate-900 to-blue-900 p-10 text-white relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <h1 class="text-3xl font-black tracking-tight italic">Prendre <span class="text-blue-400 uppercase">Rendez-vous</span></h1>
                        <p class="text-slate-300 mt-2 font-medium opacity-80">Planifiez votre consultation en quelques clics.</p>
                    </div>
                </div>

                <form action="<?php echo e(route('patient.rendezvous.store')); ?>" method="POST" id="rdvForm" class="p-10 space-y-10">
                    <?php echo csrf_field(); ?>

                    <?php if(session('error') || $errors->any()): ?>
                        <div class="bg-rose-50 border-l-4 border-rose-500 p-5 rounded-2xl text-rose-700 text-xs font-bold space-y-1">
                            <?php if(session('error')): ?> <p><?php echo e(session('error')); ?></p> <?php endif; ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <p><?php echo e($error); ?></p> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[8px]">1</span>
                                Spécialité
                            </label>
                            <select id="specialite_filter" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition shadow-sm cursor-pointer outline-none">
                                <option value="">Toutes les spécialités</option>
                                <?php $__currentLoopData = $specialites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($spe->id); ?>"><?php echo e($spe->nom_specialite); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="space-y-4">
                            <label class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[8px]">2</span>
                                Praticien
                            </label>
                            <select name="medecin_id" id="medecin_id" required class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition shadow-sm cursor-pointer outline-none">
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-4">
                            <label class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[8px]">3</span>
                                Date du rendez-vous
                            </label>
                            <input type="date" name="date_rdv" id="date_rdv" min="<?php echo e(date('Y-m-d')); ?>" required
                                class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition shadow-sm outline-none">
                            
                            
                            <div id="info_jours" class="hidden">
                                <p class="text-[9px] font-black text-blue-600 uppercase italic mt-2 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-info"></i> Ce spécialiste ne consulte que 2 jours / semaine
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <label class="flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <span class="w-5 h-5 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-[8px]">4</span>
                                Créneaux disponibles
                            </label>
                            <div id="heures_container" class="grid grid-cols-3 gap-2"></div>
                            <input type="hidden" name="heure_rdv" id="heure_rdv_hidden" required>
                            <div id="msg_select" class="text-[11px] text-slate-400 font-bold italic bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200 text-center transition-all">
                                Sélectionnez un médecin et une date.
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-1">Motif (Optionnel)</label>
                        <textarea name="motif" rows="2" class="w-full bg-slate-50 border-none rounded-[1.5rem] px-6 py-4 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500 transition outline-none placeholder-slate-300" placeholder="Ex: Consultation de suivi..."></textarea>
                    </div>

                    <button type="submit" id="submitBtn" disabled class="w-full py-6 bg-slate-200 text-white rounded-[2rem] font-black uppercase tracking-[0.3em] text-xs shadow-lg transition-all duration-500 flex items-center justify-center gap-3 cursor-not-allowed">
                        <i class="fa-solid fa-calendar-check"></i>
                        Confirmer le rendez-vous
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const specialiteSelect = document.getElementById('specialite_filter');
        const medecinSelect = document.getElementById('medecin_id');
        const dateInput = document.getElementById('date_rdv');
        const infoJours = document.getElementById('info_jours');
        const heuresContainer = document.getElementById('heures_container');
        const heureHidden = document.getElementById('heure_rdv_hidden');
        const msgSelect = document.getElementById('msg_select');
        const submitBtn = document.getElementById('submitBtn');

        const disponibilites = <?php echo json_encode($disponibilites, 15, 512) ?>;

        // 1. Filtrage par spécialité
        specialiteSelect.addEventListener('change', function() {
            const speId = this.value; 
            medecinSelect.value = ""; 
            resetHeures();
            infoJours.classList.add('hidden');

            Array.from(medecinSelect.options).forEach(opt => {
                if (opt.value === "") return;
                const isMatch = speId === "" || opt.dataset.specialite === speId;
                opt.style.display = isMatch ? "block" : "none";
                opt.disabled = !isMatch;
            });
        });

        // 2. Gestion du changement de médecin
        medecinSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const isSpecialist = selectedOption.dataset.isSpecialist === "true";
            
            // Afficher ou cacher l'info sur les jours
            if(isSpecialist) {
                infoJours.classList.remove('hidden');
            } else {
                infoJours.classList.add('hidden');
            }
            
            dateInput.value = ""; // Reset date pour forcer un nouveau choix cohérent
            updateHeures();
        });

        // 3. Mise à jour des créneaux
        dateInput.addEventListener('change', updateHeures);

        function updateHeures() {
            const selectedOption = medecinSelect.options[medecinSelect.selectedIndex];
            if (!selectedOption || !dateInput.value) {
                resetHeures();
                return;
            }

            const userId = selectedOption.dataset.user;
            const dateStr = dateInput.value;
            
            heuresContainer.innerHTML = "";
            heureHidden.value = "";
            disableSubmit();

            if (disponibilites[userId] && disponibilites[userId][dateStr]) {
                const slots = disponibilites[userId][dateStr];
                if (slots.length > 0) {
                    msgSelect.classList.add('hidden');
                    slots.forEach(heure => {
                        const btn = document.createElement('button');
                        btn.type = "button";
                        btn.innerText = heure.substring(0, 5);
                        btn.className = "py-3 bg-white border border-slate-100 rounded-xl text-[11px] font-black text-slate-600 hover:border-blue-500 hover:text-blue-600 transition-all shadow-sm";
                        
                        btn.onclick = function() {
                            heuresContainer.querySelectorAll('button').forEach(b => {
                                b.className = "py-3 bg-white border border-slate-100 rounded-xl text-[11px] font-black text-slate-600 transition-all shadow-sm";
                            });
                            this.className = "py-3 bg-blue-600 border border-blue-600 rounded-xl text-[11px] font-black text-white shadow-lg shadow-blue-200 scale-105 transition-all";
                            heureHidden.value = heure;
                            enableSubmit();
                        };
                        heuresContainer.appendChild(btn);
                    });
                    return;
                }
            }
            
            msgSelect.classList.remove('hidden');
            msgSelect.innerText = "Aucun créneau disponible. (Les spécialistes ne consultent que certains jours).";
            msgSelect.className = "text-[11px] font-bold italic p-4 rounded-2xl border border-rose-100 bg-rose-50 text-rose-500 text-center";
        }

        function resetHeures() {
            heuresContainer.innerHTML = "";
            heureHidden.value = "";
            disableSubmit();
            msgSelect.classList.remove('hidden');
            msgSelect.className = "text-[11px] text-slate-400 font-bold italic bg-slate-50 p-6 rounded-2xl border border-dashed border-slate-200 text-center";
            msgSelect.innerText = "Sélectionnez un médecin et une date.";
        }

        function enableSubmit() {
            submitBtn.disabled = false;
            submitBtn.classList.replace('bg-slate-200', 'bg-slate-900');
            submitBtn.classList.replace('cursor-not-allowed', 'cursor-pointer');
            submitBtn.classList.add('hover:bg-blue-600', 'hover:-translate-y-1');
        }

        function disableSubmit() {
            submitBtn.disabled = true;
            submitBtn.classList.replace('bg-slate-900', 'bg-slate-200');
            submitBtn.classList.replace('cursor-pointer', 'cursor-not-allowed');
            submitBtn.classList.remove('hover:bg-blue-600', 'hover:-translate-y-1');
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/patient/rendezvous/create.blade.php ENDPATH**/ ?>