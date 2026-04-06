<x-app-layout>
<div class="flex h-screen bg-[#F8FAFC] font-sans">

    {{-- Sidebar / Contacts --}}
    <aside 
        class="fixed inset-y-0 left-0 w-80 max-w-full bg-white/90 backdrop-blur-xl border-r border-blue-100 shadow-xl transform transition-transform duration-300 rounded-r-3xl
        z-40 md:z-30 lg:static lg:translate-x-0 hidden lg:flex"
        style="top: 0; height: 100dvh;">
        <div class="p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Contacts</h2>
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                <input type="text" placeholder="Rechercher..." id="contactSearch" 
                    class="w-full pl-10 pr-4 py-3 rounded-xl bg-gray-50 shadow-sm border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500/30 transition-all">
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-4 py-2 space-y-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
            {{-- Admins --}}
            <div>
                <h3 class="text-xs font-bold text-blue-500 uppercase mb-2">Administration</h3>
                @foreach($secretaires as $secretaire)
                <a href="{{ route('doctor.messages.show', $secretaire->id) }}"
                    class="flex items-center p-3 rounded-xl transition-all hover:bg-blue-50 {{ isset($activeContact) && $activeContact->id == $secretaire->id ? 'bg-blue-50 shadow-inner ring-1 ring-blue-200' : '' }}">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 font-bold flex items-center justify-center">
                        {{ strtoupper(substr($secretaire->name,0,1)) }}
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-semibold text-gray-700 truncate">{{ $secretaire->name }}</p>
                        <p class="text-[10px] text-blue-400 font-bold uppercase">Ligne Directe</p>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Patients --}}
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase mb-2">Patients</h3>
                @foreach($contacts as $patient)
                <a href="{{ route('doctor.messages.show', $patient->id) }}"
                    class="flex items-center p-3 rounded-xl transition-all hover:bg-blue-50 {{ isset($activeContact) && $activeContact->id == $patient->id ? 'bg-blue-50 shadow-inner ring-1 ring-blue-200' : '' }}">
                    
                    <div class="relative">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center">
                            {{ strtoupper(substr($patient->name,0,1)) }}
                        </div>
                        @if($patient->unread > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full shadow-md">{{ $patient->unread }}</span>
                        @endif
                    </div>

                    <div class="ml-4 flex-1 overflow-hidden">
                        <p class="text-sm font-bold text-gray-800 truncate">{{ $patient->name }}</p>
                        <p class="text-[10px] text-gray-400 truncate mt-0.5">Dernier échange</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </aside>

    {{-- Main Chat --}}
    <main class="flex-1 flex flex-col min-w-0">
        {{-- Header --}}
        <header class="flex justify-between items-center p-6 border-b border-gray-100 bg-white/80 backdrop-blur-md">
            <div class="flex items-center space-x-3">
                <a href="{{ route('doctor.dashboard') }}" class="p-2.5 bg-white rounded-xl shadow-sm border border-gray-50 text-gray-400 hover:text-blue-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <h1 class="text-sm md:text-base font-black text-gray-800 uppercase tracking-tighter">
                        Ma <span class="text-blue-600">Messagerie</span> <span class="text-gray-300 font-light ml-1">| Praticien</span>
                    </h1>
                </div>
            </div>
        </header>

        {{-- Chat area --}}
        <div class="flex-1 flex overflow-hidden">
            @if(isset($activeContact))
            <div class="flex-1 flex flex-col">
                {{-- Chat header --}}
                <div class="flex items-center p-6 border-b border-gray-100 bg-white shadow-sm">
                    <div class="flex items-center">
                        <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 font-bold flex items-center justify-center">
                            {{ strtoupper(substr($activeContact->name,0,1)) }}
                        </div>
                        <div class="ml-4">
                            <p class="font-bold text-gray-800">{{ $activeContact->name }}</p>
                            <span class="text-[10px] text-blue-500 uppercase tracking-wider">Canal: {{ $activeContact->role == 'secretaire' ? 'Admin' : 'Patient' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Messages --}}
                <div id="chat-window" class="flex-1 p-6 overflow-y-auto space-y-4 bg-gray-50">
                    @foreach($messages as $message)
                        @php $isMe = $message->sender_id === auth()->id(); @endphp
                        <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] px-5 py-3 rounded-2xl shadow-sm {{ $isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-white text-gray-800 rounded-bl-none border border-gray-100' }}">
                                {{ $message->content }}
                            </div>
                        </div>
                        <div class="{{ $isMe ? 'text-right' : 'text-left' }} text-[10px] text-gray-400 uppercase mt-1">
                            {{ $message->created_at->format('H:i') }} • {{ $isMe ? 'Envoyé' : 'Réception' }}
                        </div>
                    @endforeach
                </div>

                {{-- Input --}}
                <div class="p-4 bg-white border-t border-gray-100 flex items-center space-x-4">
                    <form action="{{ route('doctor.messages.store') }}" method="POST" class="flex flex-1 items-center space-x-3">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $activeContact->id }}">
                        <input type="text" name="content" placeholder="Rédiger un message..." required
                            class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/30 text-gray-700 placeholder-gray-400">
                        <button type="submit" class="bg-blue-600 text-white px-5 py-3 rounded-xl hover:bg-blue-700 shadow transition-all">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
                <i class="fas fa-comments text-6xl mb-4"></i>
                <p class="uppercase font-bold tracking-wider">Sélectionnez une discussion</p>
            </div>
            @endif
        </div>
    </main>
</div>
</x-app-layout>