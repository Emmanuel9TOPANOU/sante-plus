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
    <div class="py-6 md:py-12 bg-[#f8fafc] min-h-screen">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="bg-white rounded-[2rem] md:rounded-[3rem] shadow-2xl shadow-blue-100/50 border border-slate-100 overflow-hidden">
                
                
                <div class="p-6 md:p-10 bg-blue-600 text-white flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-xl md:text-2xl font-black italic tracking-tighter uppercase">Examen Médical</h2>
                        <p class="text-blue-400 text-[9px] md:text-[10px] font-black uppercase tracking-[0.2em] mt-1">
                            Patient : <?php echo e($rendezvous->patient->name); ?> | Dossier N°: <?php echo e($rendezvous->patient->id); ?>

                        </p>
                    </div>
                    <div class="text-left sm:text-right border-t border-blue-500 sm:border-none pt-4 sm:pt-0 w-full sm:w-auto">
                        <span class="block text-[9px] font-black uppercase text-white tracking-widest">Date de session</span>
                        <span class="font-bold text-sm italic text-white"><?php echo e(now()->translatedFormat('d F Y')); ?></span>
                    </div>
                </div>

                <form action="<?php echo e(route('doctor.consultations.store')); ?>" method="POST" class="p-5 md:p-10">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="rendezvous_id" value="<?php echo e($rendezvous->id); ?>">
                    <input type="hidden" name="patient_id" value="<?php echo e($rendezvous->patient_id); ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">
                        
                        
                        <div class="space-y-6 bg-blue-50/50 p-6 md:p-8 rounded-[1.5rem] md:rounded-[2.5rem] border border-blue-100/50 h-fit lg:sticky lg:top-6">
                            <h3 class="text-[10px] font-black uppercase text-blue-600 tracking-[0.2em] mb-4 flex items-center">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-2"></span>
                                Infos & Antécédents
                            </h3>

                            
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-black text-slate-500 mb-2 uppercase">Sexe</label>
                                    <select name="sexe" class="w-full border-none bg-white rounded-xl shadow-sm font-bold text-xs p-3">
                                        <option value="M" <?php echo e($rendezvous->patient->sexe == 'M' ? 'selected' : ''); ?>>Masculin</option>
                                        <option value="F" <?php echo e($rendezvous->patient->sexe == 'F' ? 'selected' : ''); ?>>Féminin</option>
                                    </select>
                                </div>
                            <div>
    <label class="block text-[9px] font-black text-slate-500 mb-2 uppercase">Groupe Sanguin</label>
    <select name="groupe_sanguin" class="w-full border-none bg-white rounded-xl shadow-sm font-bold text-xs p-3 text-blue-600 focus:ring-2 focus:ring-blue-500">
        
        <option value="" <?php echo e(is_null($rendezvous->patient->groupe_sanguin) ? 'selected' : ''); ?>>Inconnu / Non défini</option>
        
        <?php $__currentLoopData = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($gp); ?>" <?php echo e($rendezvous->patient->groupe_sanguin == $gp ? 'selected' : ''); ?>>
                <?php echo e($gp); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
                            </div>

                            
                            <div>
                                <label class="block text-[9px] font-black text-slate-500 mb-2 uppercase">Naissance / Âge</label>
                                <div id="age_display" class="w-full bg-blue-600 rounded-xl p-3 font-black text-white text-xs text-center mb-2 shadow-lg shadow-blue-100">
                                    <?php echo e($rendezvous->patient->date_naissance ? $rendezvous->patient->date_naissance->age . ' ans' : 'N/A'); ?>

                                </div>
                                <input type="date" name="date_naissance" id="birth_date" value="<?php echo e($rendezvous->patient->date_naissance ? $rendezvous->patient->date_naissance->format('Y-m-d') : ''); ?>" class="w-full border-none bg-white rounded-xl shadow-sm text-xs p-3">
                            </div>

                            
                            <div>
                                <label class="block text-[9px] font-black text-slate-500 mb-2 uppercase">Antécédents Médicaux</label>
                                <textarea name="antecedents_medicaux" rows="3" class="w-full border-none bg-white rounded-xl shadow-sm text-xs p-4 font-medium" placeholder="Diabète, Hypertension, etc..."><?php echo e($rendezvous->patient->antecedents_medicaux); ?></textarea>
                            </div>

                            
                            <div>
                                <label class="block text-[9px] font-black text-red-500 mb-2 uppercase">Allergies</label>
                                <textarea name="allergies" rows="2" class="w-full border-none bg-white rounded-xl shadow-sm text-xs p-4 font-medium text-red-600"><?php echo e($rendezvous->patient->allergies); ?></textarea>
                            </div>
                        </div>

                        
                        <div class="lg:col-span-2 space-y-8">
                            
                            
                            <div class="grid grid-cols-3 gap-4">
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-inner">
                                    <label class="block text-[9px] font-black text-slate-400 mb-1 uppercase">Tension</label>
                                    <input type="text" name="tension" placeholder="12/8" class="w-full border-none bg-transparent p-0 font-black text-slate-800 focus:ring-0 text-lg">
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-inner">
                                    <label class="block text-[9px] font-black text-slate-400 mb-1 uppercase">Temp. (°C)</label>
                                    <input type="number" step="0.1" name="temperature" placeholder="37.2" class="w-full border-none bg-transparent p-0 font-black text-slate-800 focus:ring-0 text-lg">
                                </div>
                                <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-inner">
                                    <label class="block text-[9px] font-black text-slate-400 mb-1 uppercase">Poids (kg)</label>
                                    <input type="number" step="0.1" name="poids" placeholder="70" class="w-full border-none bg-transparent p-0 font-black text-slate-800 focus:ring-0 text-lg">
                                </div>
                            </div>

                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Motif de consultation</label>
                                    <textarea name="motif" rows="3" class="w-full border-none bg-slate-100 rounded-xl p-4 text-xs font-bold" placeholder="Pourquoi le patient consulte ?"></textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-3">Examen Physique</label>
                                    <textarea name="examen_physique" rows="3" class="w-full border-none bg-slate-100 rounded-xl p-4 text-xs font-bold" placeholder="Résultats de l'auscultation..."></textarea>
                                </div>
                            </div>

                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black uppercase text-blue-600 tracking-widest mb-3">Diagnostic Final <span class="text-red-500">*</span></label>
                                    <input type="text" name="diagnostic" required class="w-full border-none bg-slate-100 rounded-xl p-5 font-bold text-slate-800 shadow-inner text-lg" placeholder="Saisir le diagnostic précis...">
                                </div>

                                
                                <div class="bg-white p-6 rounded-[2rem] border-2 border-dashed border-blue-100">
                                    <div class="flex justify-between items-center mb-6">
                                        <h4 class="text-[10px] font-black uppercase text-slate-800 tracking-widest flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                                            Analyses (Si nécessaire)
                                        </h4>
                                        <button type="button" onclick="addAnalyseRow()" class="px-4 py-2 bg-blue-600 text-white rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg shadow-blue-200">
                                            + Prescrire
                                        </button>
                                    </div>
                                    <div id="analyses-container" class="space-y-3"></div>
                                    <div id="no-analyse-msg" class="text-center py-4 text-[9px] font-bold text-slate-300 uppercase tracking-widest">Aucune analyse pour le moment</div>
                                </div>
                            </div>

                         
                        </div>
                    </div>

                    
                    <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-6 border-t border-slate-100 mt-10 pt-10">
                        <a href="<?php echo e(route('doctor.dashboard')); ?>" class="text-[10px] font-black uppercase text-slate-400 hover:text-red-500 tracking-widest py-2 transition-colors">Annuler</a>
                        <button type="submit" class="w-full sm:w-auto bg-slate-900 text-white px-14 py-6 rounded-3xl font-black text-[11px] uppercase tracking-[0.3em] shadow-2xl hover:bg-blue-600 hover:-translate-y-1 transition-all duration-300">
                            Enregistrer la Consultation
                        </button>
                    </div>
                </form>
            </div>
        </div>
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
                document.getElementById('age_display').innerText = age + " ans";
            }
        });

        // Analyses dynamiques
        function addAnalyseRow() {
            const container = document.getElementById('analyses-container');
            const noMsg = document.getElementById('no-analyse-msg');
            if (noMsg) noMsg.style.display = 'none'; 

            const div = document.createElement('div');
            div.className = "flex items-center gap-3 animate-slideIn";
            div.innerHTML = `
                <input type="text" name="analyses[]" required
                    class="flex-1 border-none bg-blue-50/50 rounded-xl p-4 text-xs font-bold text-blue-700 shadow-sm" 
                    placeholder="Nom de l'analyse (ex: NFS, Glycémie...)">
                <button type="button" onclick="removeRow(this)" class="p-4 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            `;
            container.appendChild(div);
        }

        function removeRow(btn) {
            btn.parentElement.remove();
            const container = document.getElementById('analyses-container');
            if (container.children.length === 0) document.getElementById('no-analyse-msg').style.display = 'block';
        }
    </script>

    <style>
        @keyframes slideIn { from { opacity: 0; transform: translateX(-15px); } to { opacity: 1; transform: translateX(0); } }
        .animate-slideIn { animation: slideIn 0.3s ease-out forwards; }
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/consultations/create.blade.php ENDPATH**/ ?>