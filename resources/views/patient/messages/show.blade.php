<x-app-layout>
<div x-data="{ openSidebar: false }" class="flex h-screen bg-[#F8FAFC] overflow-hidden">

    {{-- OVERLAY MOBILE --}}
    <div x-show="openSidebar" x-cloak @click="openSidebar = false"
        class="fixed inset-0 bg-black/30 z-30 lg:hidden"></div>

    {{-- SIDEBAR --}}
    <aside 
        class="fixed lg:static inset-y-0 left-0 z-40 w-72 bg-slate-50/90 backdrop-blur-xl border-r border-gray-100 transform transition-transform duration-300"
        :class="openSidebar ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

        {{-- Header mobile --}}
        <div class="flex items-center justify-between p-4 lg:hidden">
            <h2 class="font-black text-blue-600 text-sm">Contacts</h2>
            <button @click="openSidebar = false" class="p-2 bg-white rounded-lg shadow">✕</button>
        </div>

        {{-- Search --}}
        <div class="p-4 border-b border-gray-100">
            <input type="text" id="contactSearch" placeholder="Rechercher un contact..." 
                class="w-full bg-white border-none rounded-xl px-4 py-3 text-xs font-bold shadow-sm focus:ring-2 focus:ring-blue-500/10">
        </div>

        {{-- Contacts List --}}
        <div id="contactList" class="flex-1 overflow-y-auto px-3 py-4 space-y-2">
            
            <h3 class="text-[9px] font-black text-gray-400 uppercase px-2 mb-2">Médecins</h3>
            @isset($medecins)
                @foreach($medecins as $medecin)
                <a href="{{ route('patient.messages.show', $medecin->id) }}" 
                    data-name="{{ strtolower($medecin->name) }}"
                    class="contact-item flex items-center p-3 rounded-xl transition-all hover:bg-white hover:shadow group
                    {{ (isset($receiver) && $receiver->id == $medecin->id) ? 'bg-white shadow border-l-4 border-blue-600' : '' }}">

                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black shrink-0
                        {{ (isset($receiver) && $receiver->id == $medecin->id) ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600' }}">
                        {{ strtoupper(substr($medecin->name, 0, 1)) }}
                    </div>

                    <div class="ml-3 truncate">
                        <h4 class="text-sm font-black text-gray-800 truncate">{{ $medecin->name }}</h4>
                        <p class="text-[10px] text-gray-400 uppercase truncate">
                            {{ $medecin->specialite->nom ?? 'Généraliste' }}
                        </p>
                    </div>
                </a>
                @endforeach
            @endisset

            {{-- Section Admin/Secrétariat --}}
            <h3 class="text-[9px] font-black text-gray-400 uppercase mt-6 px-2 mb-2">Administration</h3>
            @isset($secretaires)
                @foreach($secretaires as $secretaire)
                <a href="{{ route('patient.messages.show', $secretaire->id) }}" 
                    data-name="{{ strtolower($secretaire->name) }}"
                    class="contact-item flex items-center p-3 rounded-xl transition-all hover:bg-white hover:shadow group
                    {{ (isset($receiver) && $receiver->id == $secretaire->id) ? 'bg-white shadow border-l-4 border-blue-600' : '' }}">

                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-black shrink-0 bg-slate-100 text-slate-500">
                        {{ strtoupper(substr($secretaire->name, 0, 1)) }}
                    </div>

                    <div class="ml-3 truncate">
                        <h4 class="text-sm font-black text-gray-700 truncate">{{ $secretaire->name }}</h4>
                        <p class="text-[10px] text-gray-400 uppercase truncate font-bold">Secrétariat</p>
                    </div>
                </a>
                @endforeach
            @else
                <p class="text-[10px] text-gray-400 italic px-2">Aucun agent disponible</p>
            @endisset
        </div>
    </aside>

    {{-- MAIN CHAT AREA --}}
    <main class="flex-1 flex flex-col min-w-0">

        {{-- HEADER --}}
        <div class="flex items-center justify-between p-4 border-b bg-white z-20">
            <div class="flex items-center space-x-3">
                <button @click="openSidebar = true" class="lg:hidden p-2 bg-slate-50 rounded-lg">
                    <span class="text-xl">☰</span>
                </button>

                <a href="{{ route('patient.messages.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-50 text-gray-400 hover:text-blue-600 transition-colors flex items-center gap-2 text-xs md:text-sm font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Retour à la liste des conversations
                </a>

                <h1 class="text-base md:text-xl font-black text-gray-800 italic">
                    Ma <span class="text-blue-600">Messagerie</span>
                </h1>
            </div>

            <div class="hidden md:flex items-center space-x-2 text-[10px] font-black text-gray-400 uppercase">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <span>Serveur sécurisé Santé+</span>
            </div>
        </div>

        {{-- CHAT CONTENT --}}
        <div class="flex-1 flex flex-col bg-[#FBFBFF] relative overflow-hidden">

            @if(isset($receiver))

                {{-- CHAT HEADER --}}
                <div class="flex items-center p-4 border-b bg-white/80 backdrop-blur-md">
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center font-black mr-3 shadow-lg shadow-blue-200">
                        {{ strtoupper(substr($receiver->name, 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="font-black text-gray-800 text-sm">
                            {{ in_array($receiver->role, ['doctor', 'medecin']) ? 'Dr.' : '' }} {{ $receiver->name }}
                        </h3>
                      
                    </div>
                </div>

                {{-- MESSAGES CONTAINER --}}
                <div id="message-container" class="flex-1 overflow-y-auto p-4 space-y-6 scroll-smooth">
                    @foreach($messages as $message)
                        @php $isMe = $message->sender_id == Auth::id(); @endphp

                        <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}">
                            <div class="max-w-[85%] md:max-w-[65%] px-4 py-3 rounded-2xl shadow-sm text-sm
                                {{ $isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white border border-gray-100 text-gray-700 rounded-bl-none' }}">
                                <p class="font-semibold leading-relaxed">{{ $message->content }}</p>
                            </div>
                            <span class="text-[9px] text-gray-400 mt-1 font-bold uppercase">
                                {{ $message->created_at->format('H:i') }}
                            </span>
                        </div>
                    @endforeach
                </div>

                {{-- INPUT FORM --}}
                <div class="p-4 bg-white border-t">
                    <form action="{{ route('patient.messages.store') }}" method="POST" class="flex items-center space-x-2">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

                        <input type="text" name="content" required autocomplete="off"
                            placeholder="Écrivez votre message ici..."
                            class="flex-1 px-5 py-3 rounded-xl bg-slate-50 border-none text-sm focus:ring-2 focus:ring-blue-500/20 transition">

                        <button type="submit" class="bg-blue-600 text-white p-3.5 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 hover:-translate-y-0.5 transition-all">
                            ➤
                        </button>
                    </form>
                </div>

            @else
                {{-- EMPTY STATE --}}
                <div class="flex-1 flex flex-col items-center justify-center text-center p-6">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl">💬</span>
                    </div>
                    <h3 class="font-black text-gray-800">Vos conversations</h3>
                    <p class="text-gray-400 text-xs mt-1 max-w-[200px]">Sélectionnez un contact pour démarrer une discussion sécurisée.</p>
                </div>
            @endif

        </div>
    </main>
</div>

<script>
    // Scroll auto vers le bas
    const scrollToBottom = () => {
        const container = document.getElementById('message-container');
        if(container) {
            container.scrollTop = container.scrollHeight;
        }
    };

    window.onload = scrollToBottom;

    // Filtre de recherche
    document.getElementById('contactSearch').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.contact-item').forEach(c => {
            const name = c.dataset.name;
            c.style.display = name.includes(term) ? 'flex' : 'none';
        });
    });
</script>

<style>
    [x-cloak] { display: none !important; }
    #message-container::-webkit-scrollbar { width: 4px; }
    #message-container::-webkit-scrollbar-track { bg: transparent; }
    #message-container::-webkit-scrollbar-thumb { background: #E2E8F0; border-radius: 10px; }
</style>
</x-app-layout>