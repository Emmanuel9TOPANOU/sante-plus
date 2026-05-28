<x-app-layout>
<div class="max-w-2xl mx-auto py-12">
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="bg-indigo-600 px-6 py-5">
            <h3 class="text-white font-black text-sm uppercase tracking-wider">Nouveau service</h3>
            <p class="text-indigo-100 text-[10px] mt-1">Ajouter un service à l'établissement</p>
        </div>
        
        <form action="{{ route('admin.services.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Nom du service</label>
                <input type="text" name="nom" value="{{ old('nom') }}" 
                       class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none" required>
            </div>
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Téléphone</label>
                <input type="tel" name="telephone" value="{{ old('telephone') }}" 
                       class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
            </div>
      
            
            <div>
                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 ml-1">Étage / Aile (optionnel)</label>
                <input type="text" name="etage" value="{{ old('etage') }}" 
                       class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none">
            </div>
            
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="{{ route('admin.services.index') }}" 
                   class="px-6 py-3 bg-slate-100 text-slate-700 rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-slate-200 transition-all duration-300">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-black text-[11px] uppercase tracking-wider hover:bg-indigo-700 transition-all duration-300 shadow-md shadow-indigo-200">
                    Ajouter le service
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>