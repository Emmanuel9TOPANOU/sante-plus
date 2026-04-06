<x-app-layout>
    <div class="py-6 md:py-12 bg-[#F8FAFC] min-h-screen" x-data="prescriptionForm()">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Bouton Retour --}}
            <div class="mb-6">
                <a href="{{ route('doctor.prescriptions.index') }}" class="group inline-flex items-center text-gray-400 hover:text-blue-600 transition-all">
                    <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 group-hover:shadow-md group-hover:border-blue-100 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <span class="ml-4 text-[9px] md:text-[10px] uppercase font-black tracking-[0.2em]">Retour à la liste</span>
                </a>
            </div>

            {{-- Affichage des erreurs de validation --}}
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl shadow-sm">
                    <p class="font-bold text-xs uppercase mb-2">Erreurs détectées :</p>
                    <ul class="text-sm">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

          
            <div class="bg-white shadow-2xl shadow-blue-900/5 rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-10 border border-gray-100">
                <div class="mb-8 md:mb-10">
                    <h2 class="text-2xl md:text-3xl font-black text-gray-800 italic leading-tight">Rédiger une <span class="text-blue-600">Ordonnance</span></h2>
                    <p class="text-[9px] md:text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mt-2">Nouvelle prescription médicale</p>
                </div>

                <form action="{{ route('doctor.prescriptions.store') }}" method="POST" class="space-y-6 md:space-y-8">
                    @csrf
                    
                    <div class="bg-slate-50/50 p-6 md:p-8 rounded-[2rem] border border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-3">Patient ciblé</label>
                            <select name="patient_id" x-model="selectedPatientId" @change="updatePatientData" required 
                                class="w-full border-none bg-white rounded-xl py-3 px-4 focus:ring-4 focus:ring-blue-500/10 font-bold text-gray-700 shadow-sm text-sm">
                                <option value="">Choisir un patient...</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-3">Date d'émission</label>
                            <input type="date" name="date_emission" required value="{{ date('Y-m-d') }}" 
                                class="w-full border-none bg-white rounded-xl py-3 px-4 focus:ring-4 focus:ring-blue-500/10 font-bold text-gray-700 shadow-sm text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 px-1">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-3">Âge calculé</label>
                            <input type="text" name="age" x-model="patientAge" readonly
                                class="w-full border-gray-100 bg-gray-50 rounded-xl py-3 px-4 font-bold text-gray-500 shadow-sm cursor-not-allowed text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-3">Poids (kg)</label>
                            <input type="number" step="0.1" name="poids" x-model="patientWeight" max="500"
                                class="w-full border-gray-100 rounded-xl py-3 px-4 focus:ring-4 focus:ring-blue-500/10 font-bold text-gray-700 shadow-sm text-sm"
                                placeholder="Ex: 75.5">
                        </div>
                    </div>

                    <div class="px-1">
                        <label class="block text-[10px] uppercase tracking-widest font-black text-gray-400 mb-3">Lier à une consultation récente</label>
                        <select name="consultation_id" class="w-full border-gray-100 rounded-xl py-3 px-4 focus:ring-4 focus:ring-blue-500/10 font-bold text-gray-700 shadow-sm text-sm">
                            <option value="">Aucune consultation spécifique</option>
                            <template x-for="consult in filteredConsultations" :key="consult.id">
                                <option :value="consult.id" x-text="'Session du ' + formatDate(consult.created_at)"></option>
                            </template>
                        </select>
                    </div>

                    <div class="px-1">
                        <div class="flex justify-between items-center mb-3">
                            <label class="block text-[10px] uppercase tracking-widest font-black text-gray-400">Médicaments & Posologie</label>
                            <span class="text-[9px] text-blue-500 font-black italic uppercase" x-show="selectedPatientId">
                                Allergies : <span x-text="patientAllergies" :class="patientAllergies !== 'Aucune' ? 'text-red-500' : 'text-emerald-500'"></span>
                            </span>
                        </div>
                        <textarea name="contenu" rows="8" required
                            class="w-full border-gray-100 rounded-[1.5rem] focus:ring-4 focus:ring-blue-500/10 font-medium text-gray-600 p-5 shadow-sm text-sm"
                            placeholder="Ex: PARACETAMOL 500mg..."></textarea>
                    </div>

                    <div class="flex justify-end pt-6 border-t border-gray-50">
                        <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-[2rem] font-black text-[11px] uppercase tracking-widest hover:bg-slate-900 transition-all shadow-2xl shadow-blue-200">
                             <i class="fas fa-save mr-3"></i> Enregistrer & Générer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function prescriptionForm() {
            return {
                selectedPatientId: '',
                patientAge: 'Sélectionnez un patient',
                patientWeight: '',
                patientAllergies: 'Aucune',
                allPatients: {!! json_encode($patients) !!},
                allConsultations: {!! json_encode($consultations) !!},
                filteredConsultations: [],

                updatePatientData() {
                    const patient = this.allPatients.find(p => String(p.id) === String(this.selectedPatientId));
                    if (patient) {
                        this.patientAge = patient.date_naissance ? this.calculateAge(patient.date_naissance) + ' ans' : 'Non renseigné';
                        this.patientWeight = patient.poids || '';
                        this.patientAllergies = (patient.allergies && patient.allergies.trim() !== '') ? patient.allergies : 'Aucune';
                        this.filteredConsultations = this.allConsultations.filter(c => String(c.patient_id) === String(this.selectedPatientId));
                    } else {
                        this.resetData();
                    }
                },

                resetData() {
                    this.patientAge = 'Sélectionnez un patient';
                    this.patientWeight = '';
                    this.patientAllergies = 'Aucune';
                    this.filteredConsultations = [];
                },

                calculateAge(birthDate) {
                    const today = new Date();
                    const birth = new Date(birthDate);
                    let age = today.getFullYear() - birth.getFullYear();
                    const m = today.getMonth() - birth.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
                    return age;
                },

                formatDate(dateString) {
                    if (!dateString) return '';
                    return new Date(dateString).toLocaleDateString('fr-FR', { year: 'numeric', month: 'long', day: 'numeric' });
                }
            }
        }
    </script>
</x-app-layout>