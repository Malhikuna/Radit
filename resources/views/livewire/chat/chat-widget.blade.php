<div 
    x-data="{ 
        open: @entangle('isOpen'), 
    }" 
    class="relative"
    @scroll-bottom.window="
        if(open) {
            setTimeout(() => {
                const container = document.getElementById('message-container');
                if(container) container.scrollTop = container.scrollHeight;
            }, 100);
        }
    "
>
    {{-- TRIGGER BUTTON --}}
    <button 
        @click="open = !open; $dispatch('scroll-bottom')"
        class="cursor-pointer flex items-center gap-3 px-2 py-2 rounded-full font-medium transition focus:outline-none dark:text-white dark:hover:text-white
                {{ request('sort') === 'chat' ? 'bg-purple-50 text-purple-600' : 'text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-400 hover:text-purple-600' }}"
    >
        <x-lucide-message-circle-more class="w-5"/>
        
        {{-- Indikator Merah --}}
        @php
            $hasUnread = \App\Models\Message::where('is_read', false)
                ->where('user_id', '!=', auth()->id())
                ->whereHas('conversation', function ($query) {
                    $query->where('sender_id', auth()->id())
                        ->orWhere('receiver_id', auth()->id());
                })
                ->exists();
        @endphp
        @if($hasUnread)
            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
        @endif
    </button>

    {{-- WINDOW CHAT --}}
    <div
        x-show="open"
        @click.outside="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed right-5 bottom-0 w-162.5 h-125 bg-white border border-gray-200 dark:border-gray-600 rounded-t-lg shadow-2xl overflow-hidden z-50 flex"
        style="display: none;"
    >
        
        {{-- KOLOM KIRI --}}
        <div class="w-1/3 border-r border-gray-100 dark:border-gray-700 flex flex-col bg-gray-50/50 dark:bg-gray-800">
            <div class="px-4 h-12 flex items-center justify-between border-b border-gray-100 dark:border-gray-700 bg-white dark:bg-gray-600">
                <h3 class="font-bold text-gray-800 dark:text-white">Chats</h3>
                <div class="flex gap-2">
                    {{-- Tombol New Chat --}}
                    <button wire:click="openNewChat" class="p-1 hover:bg-gray-200 rounded text-gray-500 hover:text-black transition cursor-pointer dark:text-white">
                        <x-lucide-plus class="w-4 h-4"/>
                    </button>
                    <a href="{{ route('chat') }}">
                        <button class="p-1 hover:bg-gray-200 rounded text-gray-500 dark:text-white hover:text-black transition cursor-pointer">
                            <x-lucide-maximize-2 class="w-3 h-3"/>
                        </button>
                    </a>
                </div>
            </div>

            {{-- LIST USER CHAT --}}
            <div class="flex-1 overflow-y-auto p-2 space-y-1">
                <div class="px-2 py-2 flex items-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-wide">
                    <x-lucide-undo-2 class="w-3 h-3"/> Threads
                </div>

                {{-- Loop Data Conversation --}}
                @foreach($this->conversations as $chat)
                    <button 
                        wire:click="openRoom({{ $chat->id == auth()->id() ? $chat->sender_id : $chat->id }})" 
                        class="cursor-pointer w-full text-left flex gap-3 px-2 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition group 
                        {{ $activeUserId == ($chat->id == auth()->id() ? $chat->sender_id : $chat->id) ? 'bg-purple-50 dark:bg-gray-600' : '' }}"
                    >
                        <div class="relative shrink-0">
                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-xs">
                                {{ substr($chat->name, 0, 2) }}
                            </div>
                            @if(!$chat->read_at && $chat->sender_id != auth()->id())
                                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0 overflow-hidden dark:hover:text-gray-700 dark:text-white">
                            <div class="flex justify-between items-baseline ">
                                <span class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ $chat->name }}</span>
                                <span class="text-[10px] text-gray-400 dark:text-white">{{ $chat->created_at->format('H:i') }}</span>
                            </div>
                            <p class="text-xs text-gray-500 truncate {{ !$chat->read_at && $chat->sender_id != auth()->id() ? 'font-bold text-gray-900' : '' }}">
                                {{ $chat->sender_id == auth()->id() ? 'You: ' : '' }}{{ $chat->message }}
                            </p>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div class="flex-1 flex flex-col bg-white dark:bg-gray-600 relative">
            
            {{-- WELCOME SCREEN --}}
            @if($view === 'welcome')
                <div class="h-full flex flex-col items-center justify-center text-center p-6 space-y-4">
                    <div class="w-24 h-24 bg-[#9966CC] rounded-full flex items-center justify-center mb-2">
                        <img src="{{ asset('icon/logo.png') }}" alt="Logo" class="w-16">
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Welcome to chat!</h2>
                        <p class="text-sm text-gray-500 mt-1 max-w-50 mx-auto dark:text-gray-200">Start a direct or group chat with other redditors.</p>
                    </div>

                    <button 
                        wire:click="openNewChat"
                        class="cursor-pointer px-6 py-2 bg-[#9966CC] hover:bg-[#7A49A6] text-white rounded-full font-bold text-sm transition shadow-sm flex items-center gap-2">
                        <x-lucide-message-square-plus class="w-4 h-4"/>
                        Start new chat
                    </button>
                </div>
            @endif

            {{-- NEW CHAT SCREEN --}}
            @if($view === 'new_chat')
                <div class="h-full flex flex-col">
                    <div class="px-4 h-12 flex items-center justify-between border-b border-gray-100 dark:border-gray-700">
                        <h3 class="font-bold text-gray-800 dark:text-white">New Chat</h3>
                        <button wire:click="cancelNewChat" class="p-1 hover:bg-gray-100 rounded text-gray-500">
                            <x-lucide-x class="w-5 h-5"/>
                        </button>
                    </div>

                    <div class="p-4">
                        <div class="relative">
                            <div class="flex items-center border rounded-lg px-3 py-2 focus-within:ring-2 focus-within:ring-purple-500 focus-within:border-purple-500 bg-gray-50">
                                <span class="text-gray-400 mr-2">To:</span>
                                <input 
                                    wire:model.live="searchQuery"
                                    type="text" 
                                    placeholder="Type username..." 
                                    class="bg-transparent border-none focus:ring-0 w-full text-sm placeholder-gray-400 text-gray-900 focus:outline-none"
                                    autofocus
                                >
                            </div>
                            
                            @if(strlen($searchQuery) > 0)
                                <div class="mt-2 border border-gray-100 rounded-lg shadow-sm bg-white max-h-60 overflow-y-auto">
                                    @forelse($this->searchResults as $user)
                                        <button 
                                            wire:click="openRoom({{ $user->id }})"
                                            class="w-full text-left px-4 py-2 hover:bg-gray-50 text-sm flex items-center gap-3"
                                        >
                                            <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-xs">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            {{ $user->name }}
                                        </button>
                                    @empty
                                        <div class="px-4 py-2 text-sm text-gray-500">User not found.</div>
                                    @endforelse
                                </div>
                            @else
                                <p class="text-xs text-gray-400 mt-2 px-1">Search for people by username to chat with them.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            {{-- ROOM CHAT --}}
            @if($view === 'room' && $activeUserId)
                <div class="h-full flex flex-col">
                    {{-- Header Room --}}
                    <div class="px-4 h-12 flex items-center justify-between border-b border-gray-100 bg-white dark:bg-gray-600 dark:border-gray-700">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold text-xs">
                                {{ substr($this->activeUser->name ?? 'U', 0, 2) }}
                            </div>
                            <span class="font-bold text-sm text-gray-800 dark:text-white">{{ $this->activeUser->name ?? 'User' }}</span>
                        </div>
                        <div class="flex gap-2 text-gray-500">
                            <button 
                                wire:click="clearChat"
                                wire:confirm="Bersihkan chat? Pesan akan hilang dari tampilan Anda."
                                class="cursor-pointer hover:bg-red-50 hover:text-red-600 p-1.5 rounded transition dark:text-white"
                                title="Delete for Me"
                            >
                                <x-lucide-trash-2 class="w-4 h-4"/>
                            </button>

                            <button wire:click="closeRoom" class="cursor-pointer hover:bg-gray-100 p-1 rounded transition dark:text-white dark:hover:text-gray-700"><x-lucide-x class="w-4 h-4"/></button>
                        </div>
                    </div>

                    {{-- Isi Chat --}}
                    <div 
                        id="message-container"
                        class="flex-1 bg-white dark:bg-gray-700 p-4 overflow-y-auto flex flex-col gap-3 scrollbar-hide"
                    >
                        @foreach($this->activeMessages as $msg)
                            <div class="{{ $msg->sender_id == auth()->id() ? 'self-end' : 'self-start' }} max-w-[80%]">
                                <div class="px-3 py-2 text-sm rounded-xl {{ $msg->sender_id == auth()->id() ? 'bg-purple-600 text-white rounded-tr-none' : 'bg-gray-100 text-gray-800 rounded-tl-none' }}">
                                    {{ $msg->message }}
                                </div>
                                <div class="text-[10px] text-gray-400 mt-1 {{ $msg->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                                    {{ $msg->created_at->format('H:i') }}
                                    @if($msg->sender_id == auth()->id())
                                        <span class="ml-1">{{ $msg->read_at ? '✓✓' : '✓' }}</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    {{-- Input Chat --}}
                    <div class="p-3 border-t border-gray-100 dark:bg-gray-700 dark:border-gray-900">
                        <form wire:submit.prevent="sendMessage" class="flex gap-2 items-end">
                            <div class="w-full flex bg-gray-100 rounded-2xl relative">
                                <textarea 
                                    wire:model="messageBody"
                                    rows="1"
                                    placeholder="Message..." 
                                    class="w-full bg-gray-100 dark:bg-gray-400 rounded-2xl pl-4 pr-12 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500 resize-none overflow-y-auto max-h-32"
                                    x-data="{ 
                                        resize() { 
                                            $el.style.height = 'auto'; 
                                            $el.style.height = Math.min($el.scrollHeight, 128) + 'px'; 
                                        } 
                                    }"
                                    x-init="resize()"
                                    @input="resize()"
                                    @keydown.enter.prevent="if(!$event.shiftKey) { $wire.sendMessage(); $el.value = ''; $el.style.height = 'auto'; } else { $el.value += '\n'; resize(); }"
                                ></textarea>

                                <button 
                                    type="submit" 
                                    class="cursor-pointer absolute right-2 bottom-1.5 bg-purple-600 text-white p-2 rounded-full hover:bg-purple-700 transition w-8 h-8 flex items-center justify-center shrink-0"
                                >
                                    <x-lucide-send class="w-4 h-4" /> 
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>