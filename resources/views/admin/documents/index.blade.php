@extends('layout.admin')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Archives Médicales</h2>
            <p class="text-slate-500 font-medium">Gestion et supervision de tous les documents générés sur la plateforme.</p>
        </div>

        <form action="{{ route('admin.documents.index') }}" method="GET" class="flex items-center gap-3">
            <div class="relative">
                <select name="type" onchange="this.form.submit()" 
                        class="appearance-none pl-4 pr-10 py-3 bg-white border-none rounded-2xl shadow-sm shadow-slate-200/50 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-blue-500 transition-all cursor-pointer">
                    <option value="">Tous les documents</option>
                    <option value="ordonnance" {{ request('type') == 'ordonnance' ? 'selected' : '' }}>Ordonnances</option>
                    <option value="analyse" {{ request('type') == 'analyse' ? 'selected' : '' }}>Analyses</option>
                    <option value="rapport" {{ request('type') == 'rapport' ? 'selected' : '' }}>Rapports</option>
                </select>
                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($documents as $doc)
        <div class="group bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 relative overflow-hidden">
            
            <div class="flex items-start justify-between mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl shadow-inner
                    @if($doc->type_document == 'ordonnance') bg-blue-50 text-blue-600 @elseif($doc->type_document == 'analyse') bg-emerald-50 text-emerald-600 @else bg-amber-50 text-amber-600 @endif">
                    @if($doc->type_document == 'ordonnance') 📝 @elseif($doc->type_document == 'analyse') 🧪 @else 📄 @endif
                </div>
                
                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="{{ route('admin.documents.download', $doc->id) }}" 
                       class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 hover:scale-110 transition-transform">
                        📥
                    </a>
                    <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Supprimer ce document ?')">
                        @csrf @method('DELETE')
                        <button class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                            🗑️
                        </button>
                    </form>
                </div>
            </div>

            <div class="space-y-1">
                <h4 class="font-bold text-slate-800 text-sm truncate pr-2" title="{{ $doc->nom_original }}">
                    {{ $doc->nom_original }}
                </h4>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-black uppercase tracking-[0.15em] 
                        @if($doc->type_document == 'ordonnance') text-blue-500 @elseif($doc->type_document == 'analyse') text-emerald-500 @else text-amber-500 @endif">
                        {{ $doc->type_document }}
                    </span>
                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                        {{ $doc->created_at->translatedFormat('d M Y') }}
                    </span>
                </div>
            </div>

            <div class="mt-6 pt-5 border-t border-slate-50 flex flex-col gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-500">
                        {{ strtoupper(substr($doc->patient->user->name ?? 'P', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Patient</p>
                        <p class="text-xs font-bold text-slate-700 truncate">{{ $doc->patient->user->name ?? 'Inconnu' }}</p>
                    </div>
                </div>
            </div>

            <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-slate-50 rounded-full scale-0 group-hover:scale-100 transition-transform duration-500 -z-10"></div>
        </div>
        @empty
        <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-slate-100 flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-3xl mb-4">📂</div>
            <h3 class="text-lg font-bold text-slate-800">Aucun document trouvé</h3>
            <p class="text-slate-400 text-sm">Les fichiers générés par le personnel médical apparaîtront ici.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $documents->links() }}
    </div>
</div>
@endsection