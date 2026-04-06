<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annulation confirmée - Santé+</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-[2.5rem] shadow-2xl shadow-blue-900/5 border border-slate-100 p-10 text-center animate-fade-in">
        {{-- Icône de succès d'annulation --}}
        <div class="w-24 h-24 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-8">
            <svg class="w-12 h-12 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>

        <h1 class="text-3xl font-black text-slate-900 mb-4 tracking-tight italic">Rendez-vous <span class="text-rose-500 uppercase">Annulé</span></h1>
        
        <p class="text-slate-500 mb-8 leading-relaxed font-medium">
            Votre rendez-vous avec le <strong class="text-slate-900">Dr. {{ $rendezvous->medecin->name ?? 'le médecin' }}</strong> a bien été retiré du planning.
        </p>

        {{-- Badge Récapitulatif --}}
        <div class="bg-slate-50 rounded-[2rem] p-6 mb-10 text-left border border-dashed border-slate-200">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-2 h-2 rounded-full bg-rose-400"></div>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Détails de l'annulation</span>
            </div>
            <p class="text-sm text-slate-700 font-bold">
                @php
                    $date = \Carbon\Carbon::parse($rendezvous->date_rdv);
                    $heure = \Carbon\Carbon::parse($rendezvous->heure_rdv);
                @endphp
                {{ $date->translatedFormat('l d F Y') }} <br>
                <span class="text-rose-500 italic">à {{ $heure->format('H:i') }}</span>
            </p>
        </div>

        <div class="space-y-4">
            <a href="{{ route('patient.rendezvous.create') }}" 
               class="block w-full py-5 bg-slate-900 hover:bg-blue-600 text-white font-black uppercase tracking-[0.2em] text-[10px] rounded-2xl transition-all shadow-xl shadow-slate-200 transform hover:-translate-y-1">
                Prendre un nouveau rendez-vous
            </a>
            
            <a href="{{ route('patient.rendezvous.index') }}" class="block text-[10px] text-slate-400 font-black uppercase tracking-widest hover:text-blue-600 transition-colors">
                Consulter mes autres rendez-vous
            </a>
        </div>
    </div>

</body>
</html>