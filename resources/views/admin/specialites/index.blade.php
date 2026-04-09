<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        
        {{-- BREADCRUMB --}}
        <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-[0.2em] mb-6">
            <a href="{{ route('admin.dashboard') }}" class="text-slate-400 hover:text-blue-600 transition-colors no-underline flex items-center">
                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <span class="text-slate-300">/</span>
            <span class="text-blue-600 tracking-widest">Spécialités</span>
        </nav>

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
            <div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight italic">
                    Spécialités <span class="text-blue-600 text-shadow-sm">Médicales</span>
                </h2>
                <p class="text-slate-500 font-medium text-sm mt-2 uppercase tracking-tighter flex items-center">
                    <span class="w-8 h-[2px] bg-blue-600 mr-3"></span>
                    Architecture des disciplines de la plateforme
                </p>
            </div>
            
            <form action="{{ route('admin.specialites.index') }}" method="GET" class="relative w-full md:w-72 group">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Rechercher une discipline..." 
                       class="w-full pl-12 pr-4 py-4 rounded-2xl border-none bg-white shadow-xl shadow-slate-200/50 text-xs font-bold text-slate-700 focus:ring-2 focus:ring-blue-600/10 transition-all group-hover:shadow-blue-100 outline-none">
                <svg class="w-4 h-4 absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- LISTE DES SPÉCIALITÉS --}}
            <div class="lg:col-span-8 space-y-6">
                <div class="flex items-center justify-between px-4">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Répertoire des compétences</h3>
                    <span class="px-3 py-1 bg-white text-blue-600 text-[10px] font-black uppercase rounded-lg border border-slate-100 shadow-sm">
                        Total: {{ $specialites->total() }}
                    </span>
                </div>

                <div class="admin-table-wrapper">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/40">
                                <th class="px-10 py-7 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Discipline</th>
                                <th class="px-10 py-7 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Description métier</th>
                                <th class="px-10 py-7 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($specialites as $spec)
                            <tr class="hover:bg-blue-50/30 transition-all duration-300 group">
                                <td class="px-10 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 font-black text-xs">
                                            {{ strtoupper(substr($spec->nom_specialite, 0, 2)) }}
                                        </div>
                                        <span class="font-bold text-slate-800">{{ $spec->nom_specialite }}</span>
                                    </div>
                                </td>
                                <td class="px-10 py-6 text-slate-500">{{ $spec->description }}</td>
                                <td class="px-10 py-6 text-right">
                                    <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <form action="{{ route('admin.specialites.destroy', $spec) }}" method="POST" onsubmit="return confirm('Supprimer définitivement cette discipline ?')">
                                            @csrf @method('DELETE')
                                            <button class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all duration-300 shadow-sm hover:shadow-red-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-slate-400 py-10">Aucune spécialité trouvée.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION INLINE PRO --}}
                <div class="mt-12 px-2">
                    @if ($specialites->hasPages())
                        <nav class="flex items-center justify-between">
                            <div class="hidden sm:block">
                                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                                    {{ $specialites->firstItem() }}-{{ $specialites->lastItem() }} <span class="mx-1 text-slate-200">/</span> {{ $specialites->total() }}
                                </p>
                            </div>
                            <div class="flex gap-2">
                                @if ($specialites->onFirstPage())
                                    <span class="p-4 bg-white border border-slate-100 text-slate-200 rounded-2xl cursor-not-allowed italic">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                                    </span>
                                @else
                                    <a href="{{ $specialites->previousPageUrl() }}" class="p-4 bg-white border border-slate-100 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-white transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/></svg>
                                    </a>
                                @endif

                                @if ($specialites->hasMorePages())
                                    <a href="{{ $specialites->nextPageUrl() }}" class="p-4 bg-white border border-slate-100 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-white transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @else
                                    <span class="p-4 bg-white border border-slate-100 text-slate-200 rounded-2xl cursor-not-allowed">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                                    </span>
                                @endif
                            </div>
                        </nav>
                    @endif
                </div>
            </div>

            {{-- FORMULAIRE D'AJOUT --}}
            <div class="lg:col-span-4 space-y-6">
                <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 ml-6">Nouvelle discipline</h3>
                <div class="bg-slate-900 p-8 rounded-[3rem] shadow-2xl shadow-blue-900/20 relative overflow-hidden group">
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-600/20 rounded-full blur-3xl group-hover:bg-blue-600/30 transition-colors"></div>
                    <form action="{{ route('admin.specialites.store') }}" method="POST" class="space-y-6 relative z-10">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-[9px] font-black uppercase tracking-[0.2em] text-blue-400/60 ml-2">Appellation</label>
                            <input type="text" name="nom_specialite" class="w-full px-6 py-4 rounded-2xl border-none bg-white/5 text-white font-bold placeholder-white/20 focus:ring-2 focus:ring-blue-500/50 transition-all outline-none" placeholder="ex: Cardiologie" required>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[9px] font-black uppercase tracking-[0.2em] text-blue-400/60 ml-2">Description du pôle</label>
                            <textarea name="description" rows="5" class="w-full px-6 py-4 rounded-2xl border-none bg-white/5 text-white font-bold placeholder-white/20 focus:ring-2 focus:ring-blue-500/50 transition-all outline-none" placeholder="Missions du pôle médical..."></textarea>
                        </div>
                        <button type="submit" class="w-full py-5 bg-blue-600 text-white rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-xl shadow-blue-900/40 hover:bg-blue-500 hover:-translate-y-1 transition-all duration-300">
                            Propulser la discipline
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    @media (max-width: 1023px) {
        .admin-table-wrapper { overflow-x: auto; width: 100%; }
    }
</style>