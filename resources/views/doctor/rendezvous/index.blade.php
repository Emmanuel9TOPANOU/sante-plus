<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
          

            {{-- HEADER --}}
            <div class="mb-8 flex justify-between items-end">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tight">
                        Agenda du <span class="text-indigo-600">Jour</span>
                    </h2>
                    <p class="text-gray-500 text-sm font-bold">
                        {{ \Carbon\Carbon::today()->translatedFormat('l d F Y') }}
                    </p>
                </div>
                <div class="text-right">
                    <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block mb-1">Total rdv</span>
                    <span class="bg-white border border-gray-200 text-gray-900 px-4 py-1 rounded-xl font-black shadow-sm">
                        {{ $rendezvous->count() }}
                    </span>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="bg-white shadow-xl shadow-gray-200/50 sm:rounded-[2.5rem] overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-400 text-[10px] uppercase tracking-[0.2em]">
                                <th class="py-5 px-8 font-bold">Heure & Patient</th>
                                <th class="py-5 px-4 font-bold">Statut</th>
                                <th class="py-5 px-8 font-bold text-right">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50">
                            @forelse($rendezvous as $rdv)
                                <tr class="group hover:bg-indigo-50/20 transition-all duration-300">
                                    
                                    {{-- PATIENT --}}
                                    <td class="py-6 px-8">
                                        <div class="flex items-center space-x-4">
                                            <div class="text-indigo-600 font-black text-sm bg-indigo-50 px-3 py-1 rounded-lg">
                                                {{ $rdv->heure_rdv }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-black text-gray-800">
                                                    {{ $rdv->patient->name }}
                                                </div>
                                                <div class="text-[10px] text-gray-400 font-bold uppercase">
                                                    ID: #{{ $rdv->patient->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- STATUT --}}
                                    <td class="py-6 px-4">
                                        @if($rdv->statut === 'en_attente')
                                            <span class="px-2 py-1 text-[10px] font-black bg-amber-50 text-amber-600 rounded-full animate-pulse border border-amber-100 uppercase">
                                                En attente
                                            </span>
                                        @elseif($rdv->statut === 'confirme')
                                            <span class="px-2 py-1 text-[10px] font-black bg-green-50 text-green-600 rounded-full border border-green-100 uppercase">
                                                Confirmé
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-[10px] font-black bg-gray-100 text-gray-500 rounded-full uppercase">
                                                {{ $rdv->statut }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="py-6 px-8 text-right">
                                        <div class="flex justify-end items-center gap-2">

                                            {{-- BOUTON RAPPEL --}}
                                            @if($rdv->statut !== 'annule')
                                                <form action="{{ route('doctor.rendezvous.envoyerMail', $rdv->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        onclick="this.innerHTML='Envoi...'; this.classList.add('opacity-50');"
                                                        class="px-4 py-2 bg-white border border-indigo-200 text-indigo-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-600 hover:text-white transition-all shadow-sm">
                                                        Rappel
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- BOUTON CONFIRMER (CORRIGÉ) --}}
                                            @if($rdv->statut === 'en_attente')
                                                <form action="{{ route('doctor.rendezvous.confirmer', $rdv->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-md shadow-emerald-100">
                                                        Confirmer
                                                    </button>
                                                </form>

                                                {{-- BOUTON ANNULER --}}
                                                <form action="{{ route('doctor.rendezvous.annuler', $rdv->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 bg-white border border-red-100 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                                                        Annuler
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- BOUTON DÉMARRER --}}
                                            @if($rdv->statut === 'confirme')
                                                <a href="{{ route('doctor.consultations.create', $rdv->id) }}"
                                                   class="bg-indigo-600 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">
                                                    Démarrer
                                                </a>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-20 text-center">
                                        <p class="text-gray-400 font-bold text-sm italic">
                                            Aucun rendez-vous aujourd'hui.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>