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
<div x-data="{ mobileMenuOpen: false, prescriptionForm() }" class="flex min-h-screen bg-gradient-to-br from-slate-100 to-white font-sans antialiased">

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
        
        .prescription-card {
            transition: all 0.3s ease;
        }
        .prescription-card:hover {
            transform: translateY(-4px);
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
        <div class="max-w-4xl mx-auto space-y-6 md:space-y-8 animate-fade-in-up">
            
            
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-wider">
                <a href="<?php echo e(route('doctor.dashboard')); ?>" class="text-slate-400 hover:text-blue-600 transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <span class="text-slate-300">/</span>
                <a href="<?php echo e(route('doctor.prescriptions.index')); ?>" class="text-slate-400 hover:text-blue-600 transition-colors">Ordonnances</a>
                <span class="text-slate-300">/</span>
                <span class="text-blue-600">Nouvelle</span>
            </nav>

            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-slate-200">
                <div>
                   
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Rédiger une <span class="text-blue-600">Ordonnance</span>
                    </h2>
                    <p class="text-slate-500 mt-2 text-sm">Nouvelle prescription médicale pour votre patient</p>
                </div>
                
                <div class="glass-effect px-6 py-3.5 rounded-2xl shadow-sm text-sm font-medium text-slate-600 border border-white/50 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <?php echo e(now()->translatedFormat('d F Y')); ?>

                </div>
            </div>

            
            <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <form action="<?php echo e(route('doctor.prescriptions.store')); ?>" method="POST" class="p-6 md:p-8 space-y-6" x-data="prescriptionForm()">
                    <?php echo csrf_field(); ?>
                    
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2 ml-1">Patient ciblé</label>
                            <select name="patient_id" x-model="selectedPatientId" @change="updatePatientData" required 
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                <option value="">Choisir un patient...</option>
                                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($patient->id); ?>"><?php echo e($patient->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2 ml-1">Date d'émission</label>
                            <input type="date" name="date_emission" required value="<?php echo e(date('Y-m-d')); ?>" 
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2 ml-1">Âge calculé</label>
                            <input type="text" name="age" x-model="patientAge" readonly
                                   class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-3 text-slate-500 font-medium cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2 ml-1">Poids (kg)</label>
                            <input type="number" step="0.1" name="poids" x-model="patientWeight" max="500"
                                   class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                                   placeholder="Ex: 75.5">
                        </div>
                    </div>

                    
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2 ml-1">Lier à une consultation récente</label>
                        <select name="consultation_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                            <option value="">Aucune consultation spécifique</option>
                            <?php $__currentLoopData = $consultations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($consultation->id); ?>">Session du <?php echo e($consultation->created_at->translatedFormat('d F Y')); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    
                    <div x-show="selectedPatientId && patientAllergies !== 'Aucune'" 
                         class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-xl flex items-center gap-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="text-[10px] font-black text-amber-700 uppercase tracking-wider">Allergies connues</p>
                            <p class="text-sm text-amber-800 font-medium" x-text="patientAllergies"></p>
                        </div>
                    </div>

                    
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Médicaments & Posologie</label>
                            <span class="text-[9px] font-bold text-blue-600" x-show="selectedPatientId && patientAllergies === 'Aucune'">✓ Aucune allergie connue</span>
                        </div>
                        <textarea name="contenu" rows="8" required
                                  class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all resize-none"
                                  placeholder="Ex: PARACETAMOL 500mg - 1 comprimé matin, midi et soir pendant 5 jours&#10;&#10;AMOXICILLINE 1g - 1 comprimé matin et soir pendant 7 jours"></textarea>
                        <p class="text-[9px] text-slate-400 mt-2 ml-1">Séparez les médicaments par des lignes pour plus de clarté</p>
                    </div>

                    
                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">
                        <a href="<?php echo e(route('doctor.prescriptions.index')); ?>" 
                           class="flex-1 text-center px-6 py-3.5 bg-slate-100 text-slate-700 rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-slate-200 transition-all duration-300">
                            Annuler
                        </a>
                        <button type="submit" 
                                class="flex-1 px-6 py-3.5 bg-blue-600 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-blue-700 transition-all duration-300 shadow-md shadow-blue-200 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            Enregistrer & Générer l'ordonnance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    function prescriptionForm() {
        return {
            selectedPatientId: '',
            patientAge: 'Sélectionnez un patient',
            patientWeight: '',
            patientAllergies: 'Aucune',
            allPatients: <?php echo json_encode($patients); ?>,
            
            updatePatientData() {
                const patient = this.allPatients.find(p => String(p.id) === String(this.selectedPatientId));
                if (patient) {
                    this.patientAge = patient.date_naissance ? this.calculateAge(patient.date_naissance) + ' ans' : 'Non renseigné';
                    this.patientWeight = patient.poids || '';
                    this.patientAllergies = (patient.allergies && patient.allergies.trim() !== '') ? patient.allergies : 'Aucune';
                } else {
                    this.resetData();
                }
            },
            
            resetData() {
                this.patientAge = 'Sélectionnez un patient';
                this.patientWeight = '';
                this.patientAllergies = 'Aucune';
            },
            
            calculateAge(birthDate) {
                const today = new Date();
                const birth = new Date(birthDate);
                let age = today.getFullYear() - birth.getFullYear();
                const m = today.getMonth() - birth.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
                return age;
            }
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
<?php endif; ?><?php /**PATH C:\Users\POSTE DETRAVAIL\Desktop\Soutenance\Santé+\resources\views/doctor/prescriptions/create.blade.php ENDPATH**/ ?>