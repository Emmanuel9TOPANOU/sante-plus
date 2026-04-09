@extends('layout.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Planning Global</h2>
            <p class="text-sm text-slate-500">Supervision de tous les rendez-vous de la clinique.</p>
        </div>

        <form action="{{ route('admin.rendezvous.index') }}" method="GET" class="flex flex-wrap gap-3">
            <select name="medecin_id" class="rounded-xl border-slate-200 text-sm focus:ring-blue-500">
                <option value="">Tous les médecins</option>
                @foreach($medecins as $medecin)
                    <option value="{{ $medecin->id }}" {{ request('medecin_id') == $medecin->id ? 'selected' : '' }}>
                        {{ $medecin->name }}
                    </option>
                @endforeach
            </select>
            <input type="date" name="date" value="{{ request('date') }}" class="rounded-xl border-slate-200 text-sm focus:ring-blue-500">
            <button type="submit" class="px-4 py-2 bg-slate-800 text-white rounded-xl font-bold hover:bg-slate-700 transition-all">
                Filtrer
            </button>
        </form>
    </div>

    <div class="admin-table-wrapper">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400">Date & Heure</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400">Patient</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400">Médecin</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400">Statut</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($rendezvous as $rdv)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($rdv->date_rdv)->format('d/m/Y') }}</div>
                        <div class="text-xs text-blue-600 font-medium">{{ $rdv->heure_rdv }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-slate-700">{{ $rdv->patient->user->name ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-slate-600 italic">Dr. {{ $rdv->medecin->name ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $statusClasses = [
                                'confirmé' => 'bg-emerald-50 text-emerald-600',
                                'en_attente' => 'bg-amber-50 text-amber-600',
                                'annulé' => 'bg-red-50 text-red-600',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClasses[$rdv->status] ?? 'bg-slate-100 text-slate-500' }}">
                            {{ $rdv->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <form action="{{ route('admin.rendezvous.update_status', $rdv->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-[10px] font-bold border-none bg-slate-100 rounded-lg focus:ring-0 cursor-pointer">
                                <option value="en_attente" {{ $rdv->status == 'en_attente' ? 'selected' : '' }}>Attente</option>
                                <option value="confirmé" {{ $rdv->status == 'confirmé' ? 'selected' : '' }}>Confirmer</option>
                                <option value="annulé" {{ $rdv->status == 'annulé' ? 'selected' : '' }}>Annuler</option>
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-slate-400 py-10">Aucun rendez-vous trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $rendezvous->links() }}
    </div>
</div>
@endsection