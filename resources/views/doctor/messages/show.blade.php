<x-app-layout>
<div class="flex h-screen bg-[#F8FAFC] font-sans overflow-hidden" x-data="{ sidebarOpen: false, search: '' }">

    {{-- Sidebar (Contacts) --}}
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-50 w-80 bg-white lg:static lg:flex lg:flex-col border-r border-gray-100 transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none">
        
        <div class="flex flex-col h-full">
            {{-- Header Sidebar Mobile --}}
            <div class="flex items-center justify-between px-6 py-6 lg:hidden bg-blue-600 text-white">
                <h2 class="font-black text-xl italic uppercase tracking-tighter">Contacts</h2>
                <button @click="sidebarOpen = false" class="text-white p-2">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            {{-- Barre de Recherche --}}
            <div class="px-6 py-6 border-b border-gray-50">
                <div class="relative group">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-300 group-focus-within:text-blue-500 transition-colors"></i>
                    <input type="text" x-model="search" placeholder="Rechercher un patient..." 
                           class="w-full pl-11 pr-4 py-3.5 rounded-[1.2rem] border-none bg-slate-50 text-sm font-bold placeholder-gray-300 focus:ring-4 focus:ring-blue-500/10 transition shadow-inner">
                </div>
            </div>

            {{-- Liste des Contacts --}}
            <div class="flex-1 overflow-y-auto px-4 py-4 space-y-2 scrollbar-hide">
                


                @foreach($secretaires as $secretaire)
                <a href="{{ route('doctor.messages.show', $secretaire->id) }}" 
                   x-show="'{{ strtolower($secretaire->name) }}'.includes(search.toLowerCase())"
                   class="flex items-center p-3.5 rounded-[1.2rem] transition-all duration-200 {{ isset($activeContact) && $activeContact->id == $secretaire->id ? 'bg-blue-600 text-white shadow-lg shadow-blue-200 active-contact' : 'hover:bg-slate-50 text-gray-700' }}">
                    <div class="w-12 h-12 rounded-xl {{ isset($activeContact) && $activeContact->id == $secretaire->id ? 'bg-white/20' : 'bg-slate-100 text-slate-500' }} flex items-center justify-center font-black text-lg">
                        {{ strtoupper(substr($secretaire->name,0,1)) }}
                    </div>
                    <div class="ml-3 flex-1 truncate">
                        <h4 class="font-black text-sm truncate uppercase tracking-tighter">Secr. {{ $secretaire->name }}</h4>
                        <p class="{{ isset($activeContact) && $activeContact->id == $secretaire->id ? 'text-blue-100' : 'text-emerald-500' }} text-[9px] font-black uppercase tracking-widest">Ligne Directe</p>
                    </div>
                </a>
                @endforeach


                @foreach($contacts as $contact)
                    @if($contact->role !== 'secretaire')
                    <a href="{{ route('doctor.messages.show', $contact->id) }}" 
                       x-show="'{{ strtolower($contact->name) }}'.includes(search.toLowerCase())"
                       class="flex items-center p-3.5 rounded-[1.2rem] transition-all duration-200 {{ isset($activeContact) && $activeContact->id == $contact->id ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'hover:bg-slate-50 text-gray-700' }}">
                        <div class="relative w-12 h-12 rounded-xl {{ isset($activeContact) && $activeContact->id == $contact->id ? 'bg-white/20 text-white' : 'bg-blue-50 text-blue-600' }} flex items-center justify-center font-black text-lg">
                            {{ strtoupper(substr($contact->name,0,1)) }}
                            @if(($contact->unread ?? 0) > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-black px-1.5 py-0.5 rounded-lg ring-2 ring-white animate-bounce">{{ $contact->unread }}</span>
                            @endif
                        </div>
                        <div class="ml-3 flex-1 truncate">
                            <h4 class="font-black text-sm truncate uppercase tracking-tighter">{{ $contact->name }}</h4>
                            <p class="{{ isset($activeContact) && $activeContact->id == $contact->id ? 'text-blue-100' : 'text-gray-400' }} text-[10px] italic truncate">
                                {{ $contact->last_message_time ?? 'Patient' }}
                            </p>
                        </div>
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </aside>

    {{-- Main Chat Section --}}
    <main class="flex-1 flex flex-col h-full bg-[#FBFBFF] relative overflow-hidden main-chat-section">
        
        {{-- Header Chat --}}
        <header class="h-20 flex items-center justify-between px-6 bg-white/80 backdrop-blur-md border-b border-gray-100 z-30">
            <div class="flex items-center space-x-3">
                <button @click="sidebarOpen = true" class="lg:hidden mr-4 p-2 bg-slate-50 rounded-xl text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="{{ route('doctor.messages.index') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-50 text-gray-400 hover:text-blue-600 transition-colors flex items-center gap-2 text-xs md:text-sm font-bold">
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
        </header>

        {{-- Zone des Messages --}}
        <div class="flex-1 overflow-y-auto p-4 md:p-8 space-y-6 scrollbar-thin scroll-smooth" id="chat-window">
            @if(isset($activeContact))
                @forelse($messages as $message)
                    @php $isMe = $message->sender_id === auth()->id(); @endphp
                    <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }} animate-fade-in-up">
                        <div class="max-w-[85%] md:max-w-[70%] p-4 rounded-2xl shadow-sm {{ $isMe ? 'bg-blue-600 text-white rounded-tr-none shadow-blue-100' : 'bg-white text-gray-700 border border-gray-100 rounded-tl-none' }}">
                            <p class="text-sm font-medium leading-relaxed">{{ $message->content }}</p>
                            @if($message->file_path)
                                <div class="mt-3 flex items-center p-3 rounded-xl {{ $isMe ? 'bg-white/10 border border-white/20' : 'bg-slate-50 border border-gray-100' }}">
                                    <i class="fas fa-file-pdf {{ $isMe ? 'text-white' : 'text-blue-600' }} text-lg"></i>
                                    <div class="ml-3 overflow-hidden">
                                        <a href="{{ asset('storage/' . $message->file_path) }}" target="_blank" class="block text-[10px] font-black uppercase tracking-widest underline truncate {{ $isMe ? 'text-white' : 'text-blue-600' }}">
                                            Voir le document
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center mt-2 space-x-2">
                            <span class="text-[9px] font-black text-gray-300 uppercase tracking-tighter">{{ $message->created_at->format('H:i') }}</span>
                            @if($isMe)
                                <i class="fas fa-check-double text-[9px] {{ $message->is_read ? 'text-blue-400' : 'text-gray-200' }}"></i>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-40">
                        <div class="w-20 h-20 bg-slate-100 rounded-[2.5rem] flex items-center justify-center mb-4">
                            <i class="fas fa-comment-dots text-3xl text-blue-600"></i>
                        </div>
                        <p class="font-black text-[10px] uppercase tracking-[0.3em] text-gray-400">Aucun message</p>
                        <p class="text-xs font-bold text-gray-300 mt-1">Envoyez le premier message pour lancer la discussion.</p>
                    </div>
                @endforelse
            @else
                {{-- Ecran vide --}}
                <div class="h-full flex flex-col items-center justify-center text-center px-10">
                    <div class="relative mb-8">
                        <div class="absolute inset-0 bg-blue-100 blur-3xl rounded-full opacity-30"></div>
                        <i class="fas fa-comments text-7xl text-blue-600/20 relative"></i>
                    </div>
                    <h2 class="font-black text-gray-800 text-xl uppercase tracking-widest mb-2">Centre de Messagerie</h2>
                    <p class="max-w-xs text-gray-400 font-bold text-xs leading-relaxed uppercase tracking-tighter">
                        Sélectionnez un membre de votre équipe ou un patient pour démarrer une conversation sécurisée.
                    </p>
                </div>
            @endif
        </div>

        {{-- Formulaire d'envoi --}}
        @if(isset($activeContact))
            <div class="p-4 md:p-6 bg-white border-t border-gray-100 shadow-2xl">
                {{-- Preview du fichier --}}
                <div id="file-preview" class="hidden mb-3 p-3 bg-blue-50 border border-blue-100 rounded-xl text-blue-600 text-[10px] font-black uppercase flex items-center">
                    <i class="fas fa-file-paperclip mr-2"></i>
                    <span id="file-name"></span>
                    <button onclick="clearFile()" class="ml-auto text-red-500"><i class="fas fa-times"></i></button>
                </div>
                <form action="{{ route('doctor.messages.store') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-3 message-input-row">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $activeContact->id }}">
                    <label class="group cursor-pointer flex-shrink-0">
                        <div class="w-12 h-12 bg-slate-50 group-hover:bg-blue-50 rounded-2xl flex items-center justify-center text-gray-400 group-hover:text-blue-600 transition-all border border-gray-100">
                            <i class="fas fa-paperclip text-lg"></i>
                        </div>
                        <input type="file" name="attachment" id="attachment" class="hidden" onchange="handleFileSelect(this)">
                    </label>
                    <input type="text" name="content" required placeholder="Votre message..." 
                           class="flex-1 bg-slate-50 border-none rounded-2xl py-3.5 px-5 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-blue-500/10 placeholder-gray-300 transition">
                    <button type="submit" class="w-12 h-12 bg-blue-600 hover:bg-slate-900 rounded-2xl flex items-center justify-center text-white shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 flex-shrink-0">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        @endif
    </main>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .animate-fade-in-up {
        animation: fadeInUp 0.4s ease-out forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 1023px) {
        aside.w-80 {
            width: 100vw !important;
            min-width: 0 !important;
            max-width: 100vw !important;
            border-radius: 0 0 2rem 2rem !important;
        }
        .main-chat-section {
            padding-top: 0 !important;
        }
    }
    @media (max-width: 767px) {
        #chat-window {
            padding: 0.5rem !important;
        }
        .message-input-row {
            flex-direction: column !important;
            gap: 0.5rem !important;
        }
        .message-input-row input[type="text"] {
            width: 100% !important;
        }
        .max-w-\[85\%\] { max-width: 98vw !important; }
    }
</style>

<script>
    // Scroll auto vers le bas
    const chatWindow = document.getElementById('chat-window');
    if(chatWindow) chatWindow.scrollTop = chatWindow.scrollHeight;

    // Gestion de l'aperçu du fichier
    function handleFileSelect(input) {
        const preview = document.getElementById('file-preview');
        const fileName = document.getElementById('file-name');
        if(input.files && input.files[0]) {
            preview.classList.remove('hidden');
            fileName.textContent = input.files[0].name.toUpperCase();
        }
    }

    function clearFile() {
        document.getElementById('attachment').value = '';
        document.getElementById('file-preview').classList.add('hidden');
    }
</script>
</x-app-layout>