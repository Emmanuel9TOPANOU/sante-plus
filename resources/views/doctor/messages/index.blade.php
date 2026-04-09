<x-app-layout>
<div x-data="{ openSidebar: false }" class="flex h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 font-sans overflow-hidden">

    {{-- SIDEBAR --}}
    <aside 
        class="fixed inset-y-0 left-0 w-72 max-w-full bg-white/90 backdrop-blur-xl border-r border-blue-100 shadow-xl transform transition-transform duration-300 rounded-r-3xl
        z-40 md:z-30 lg:static lg:translate-x-0"
        :class="openSidebar ? 'translate-x-0' : '-translate-x-full'"
        style="top: 0; height: 100dvh;">

        {{-- Header mobile --}}
        <div class="flex items-center justify-between p-4 lg:hidden">
            <h2 class="font-black text-blue-600 uppercase text-xs tracking-widest">Contacts</h2>
            <button @click="openSidebar = false" class="p-2 bg-white rounded-lg shadow text-gray-400">
                &#10005;
            </button>
        </div>

        {{-- Search --}}
        <div class="p-4 border-b border-blue-100">
            <input type="text" id="contactSearch" placeholder="Rechercher..." 
                class="w-full bg-white border border-blue-100 rounded-xl px-4 py-2.5 text-xs font-bold shadow focus:ring-2 focus:ring-blue-200 placeholder-gray-400 focus:outline-none">
        </div>

        {{-- Liste des contacts --}}
        <div id="contactList" class="flex-1 overflow-y-auto p-3 space-y-2 scrollbar-thin scrollbar-thumb-blue-100 scrollbar-track-white">
            <h3 class="px-3 text-[10px] font-black text-blue-400 uppercase tracking-widest mb-2">Administration</h3>
            @foreach($secretaires as $secretaire)
            @php $isActive = (isset($activeContact) && $activeContact->id == $secretaire->id); @endphp
            <a href="{{ route('doctor.messages.show', $secretaire->id) }}"
                data-name="{{ strtolower($secretaire->name) }}"
                class="contact-item flex items-center p-3 rounded-2xl transition-all duration-300 relative focus:outline-none focus:ring-2 focus:ring-blue-300 group
                {{ $isActive ? 'bg-blue-50 shadow-md border-l-4 border-blue-600' : 'hover:bg-blue-100/60 hover:shadow-lg' }}">
                <div class="relative">
                    <div class="w-11 h-11 {{ $isActive ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }} flex items-center justify-center rounded-2xl font-black transition-colors shadow">
                        {{ strtoupper(substr($secretaire->name, 0, 1)) }}
                    </div>
                </div>
                <div class="ml-3 flex-1 truncate">
                    <h4 class="text-[13px] font-black {{ $isActive ? 'text-blue-700' : 'text-gray-700 group-hover:text-blue-700' }} truncate">
                        {{ $secretaire->name }}
                    </h4>
                    <p class="text-[10px] {{ $isActive ? 'text-blue-400' : 'text-gray-400 group-hover:text-blue-400' }} font-bold uppercase tracking-tight truncate">
                        Secrétariat
                    </p>
                </div>
                @if($isActive)
                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
            @endforeach

            <h3 class="px-3 text-[10px] font-black text-blue-400 uppercase tracking-widest mt-4 mb-2">Patients</h3>
            @foreach($contacts as $patient)
            @php $isActive = (isset($activeContact) && $activeContact->id == $patient->id); @endphp
            <a href="{{ route('doctor.messages.show', $patient->id) }}"
                data-name="{{ strtolower($patient->name) }}"
                class="contact-item flex items-center p-3 rounded-2xl transition-all duration-300 relative focus:outline-none focus:ring-2 focus:ring-blue-300 group
                {{ $isActive ? 'bg-blue-50 shadow-md border-l-4 border-blue-600' : 'hover:bg-blue-100/60 hover:shadow-lg' }}">
                <div class="relative">
                    <div class="w-11 h-11 {{ $isActive ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white' }} flex items-center justify-center rounded-2xl font-black transition-colors shadow">
                        {{ strtoupper(substr($patient->name, 0, 1)) }}
                    </div>
                    @if($patient->unread > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-black w-5 h-5 flex items-center justify-center rounded-full border-2 border-white animate-bounce shadow-lg">
                            {{ $patient->unread }}
                        </span>
                    @endif
                </div>
                <div class="ml-3 flex-1 truncate">
                    <h4 class="text-[13px] font-black {{ $isActive ? 'text-blue-700' : 'text-gray-700 group-hover:text-blue-700' }} truncate">
                        {{ $patient->name }}
                    </h4>
                    <p class="text-[10px] {{ $isActive ? 'text-blue-400' : 'text-gray-400 group-hover:text-blue-400' }} font-bold uppercase tracking-tight truncate mt-0.5">
                        Dernier échange
                    </p>
                </div>
                @if($isActive)
                    <div class="w-1.5 h-1.5 bg-blue-600 rounded-full"></div>
                @endif
            </a>
            @endforeach
        </div>
    </aside>

    {{-- OVERLAY MOBILE --}}
    <div x-show="openSidebar" x-transition.opacity @click="openSidebar = false"
        class="fixed inset-0 bg-slate-900/40 z-30 md:z-20 lg:hidden backdrop-blur-sm"></div>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col h-full relative min-w-0">
        {{-- HEADER --}}
        <div class="flex items-center justify-between p-4 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center space-x-3">
                <button @click="openSidebar = true" class="lg:hidden p-2.5 bg-white rounded-xl shadow-sm border border-gray-50 text-blue-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                </button>
                <a href="{{ route('doctor.dashboard') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-50 text-gray-400 hover:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <h1 class="text-sm md:text-base font-black text-gray-800 uppercase tracking-tighter">
                        Ma <span class="text-blue-600">Messagerie</span> <span class="text-gray-300 font-light ml-1">| Praticien</span>
                    </h1>
                </div>
            </div>
        </div>
        {{-- ZONE DE CHAT --}}
        <div class="flex-1 flex flex-col bg-[#F8FAFC]">
            @if(isset($activeContact))
                {{-- CHAT HEADER --}}
                <div class="flex items-center px-6 py-3 border-b bg-white/50">
                    <div class="w-10 h-10 bg-white shadow-sm border border-gray-100 text-blue-600 rounded-xl flex items-center justify-center font-black mr-4">
                        {{ strtoupper(substr($activeContact->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-black text-gray-800 text-sm">
                            {{ $activeContact->name }}
                        </h3>
                        <p class="text-[10px] text-emerald-500 font-black uppercase tracking-widest flex items-center">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5"></span>
                            Prêt à répondre
                        </p>
                    </div>
                </div>
                {{-- MESSAGES --}}
                <div id="message-container" class="flex-1 overflow-y-auto p-6 space-y-6 scroll-smooth">
                    @foreach($messages as $message)
                        @php $isMe = $message->sender_id == Auth::id(); @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} group">
                            <div class="max-w-[85%] md:max-w-[70%]">
                                <div class="px-5 py-3 rounded-2xl shadow-sm transition-all
                                    {{ $isMe 
                                        ? 'bg-blue-600 text-white rounded-tr-none font-medium' 
                                        : 'bg-white border border-gray-100 text-gray-700 rounded-tl-none' }}">
                                    <p class="text-sm leading-relaxed">{{ $message->content }}</p>
                                </div>
                                <div class="mt-1.5 px-1 {{ $isMe ? 'text-right' : 'text-left' }} text-[9px] font-bold text-gray-400 uppercase tracking-tighter">
                                    {{ $message->created_at->translatedFormat('H:i') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- INPUT --}}
                <div class="p-4 bg-white border-t border-gray-100">
                    <form action="{{ route('doctor.messages.store') }}" method="POST"
                        class="max-w-4xl mx-auto flex items-center space-x-3 bg-slate-50 p-2 rounded-2xl border border-gray-100 focus-within:border-blue-300 transition-all">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $activeContact->id }}">
                        <input type="text" name="content" required autocomplete="off"
                            placeholder="Écrivez votre message à {{ explode(' ', $activeContact->name)[0] }}..."
                            class="flex-1 bg-transparent border-none text-sm font-medium focus:ring-0 placeholder-gray-400 px-3">
                        <button type="submit" class="bg-blue-600 text-white h-10 w-10 flex items-center justify-center rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 hover:-translate-y-0.5 transition-all active:scale-95">
                            <svg class="w-5 h-5 transform rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </form>
                </div>
            @else
                {{-- EMPTY STATE --}}
                <div class="flex-1 flex flex-col items-center justify-center text-center p-8">
                    <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <h2 class="text-gray-800 font-black text-lg uppercase italic">Votre espace de discussion</h2>
                    <p class="text-gray-400 text-sm max-w-xs font-medium">Sélectionnez un contact dans la liste de gauche pour démarrer une conversation sécurisée.</p>
                </div>
            @endif
        </div>
    </main>
</div>
<script>
    // Scroll automatique vers le bas
    const container = document.getElementById('message-container');
    if(container) {
        container.scrollTop = container.scrollHeight;
    }
    // Moteur de recherche simple
    document.getElementById('contactSearch').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.contact-item').forEach(c => {
            const name = c.dataset.name;
            c.style.display = name.includes(term) ? 'flex' : 'none';
        });
    });
</script>
</x-app-layout>