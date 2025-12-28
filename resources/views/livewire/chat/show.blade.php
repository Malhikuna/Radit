<div class="flex w-screen h-screen bg-white pt-20 overflow-hidden">
    <div 
        class="flex w-full h-full bg-white border border-gray-200 rounded-2xl shadow-xl overflow-hidden relative"
        x-data
        @scroll-bottom.window="
            setTimeout(() => {
                const container = document.getElementById('page-message-container');
                if(container) container.scrollTop = container.scrollHeight;
            }, 100);
        "
    >
        <div class="w-1/3 border-r border-gray-100 flex flex-col bg-gray-50/50">
            <div class="px-4 h-16 flex items-center justify-between border-b border-gray-100 bg-white">
                <h3 class="font-bold text-gray-800 text-lg">Chats</h3>
                <div class="flex gap-2">
                    <button wire:click="$set('view', 'new_chat')" class="cursor-pointer p-2 hover:bg-gray-200 rounded-full text-gray-500 hover:text-black transition">
                        <x-lucide-plus class="w-5 h-5"/>
                    </button>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto p-2 space-y-1">
                <div class="px-2 py-2 flex items-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-wide">
                    <x-lucide-undo-2 class="w-3 h-3"/> Threads
                </div>

                @foreach($this->conversations as $chat)
                    <button 
                        wire:click="openRoom({{ $chat->id == auth()->id() ? $chat->sender_id : $chat->id }})" 
                        class="cursor-pointer w-full text-left flex gap-3 px-3 py-3 rounded-xl hover:bg-gray-200 transition group 
                        {{ $activeUserId == ($chat->id == auth()->id() ? $chat->sender_id : $chat->id) ? 'bg-purple-50 ring-1 ring-purple-100' : '' }}"
                    >
                        <div class="relative flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-sm">
                                {{ substr($chat->name, 0, 2) }}
                            </div>
                            @if(!$chat->read_at && $chat->sender_id != auth()->id())
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0 overflow-hidden">
                            <div class="flex justify-between items-baseline">
                                <span class="text-sm font-bold text-gray-900 truncate">{{ $chat->name }}</span>
                                <span class="text-[11px] text-gray-400">{{ $chat->created_at->format('H:i') }}</span>
                            </div>
                            <p class="text-xs text-gray-500 truncate {{ !$chat->read_at && $chat->sender_id != auth()->id() ? 'font-bold text-gray-900' : '' }}">
                                {{ $chat->sender_id == auth()->id() ? 'You: ' : '' }}{{ $chat->message }}
                            </p>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>

        <div class="flex-1 flex flex-col bg-white relative">
            
            @if(!$activeConversationId && $view !== 'new_chat')
                <div class="h-full flex flex-col items-center justify-center text-center p-6 space-y-4">
                    <div class="w-24 h-24 bg-[#9966CC] rounded-full flex items-center justify-center mb-2 shadow-lg">
                        <img src="{{ asset('storage/icon/logo.png') }}" alt="Logo" class="w-16">
                    </div>
                    
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Welcome to chat!</h2>
                        <p class="text-gray-500 mt-2 max-w-sm mx-auto">Start a direct or group chat with other redditors.</p>
                    </div>

                    <button 
                        wire:click="$set('view', 'new_chat')"
                        class="cursor-pointer px-8 py-3 bg-[#9966CC] hover:bg-[#7A49A6] text-white rounded-full font-bold transition shadow-md flex items-center gap-2">
                        <x-lucide-message-square-plus class="w-5 h-5"/>
                        Start new chat
                    </button>
                </div>
            @endif

            @if($view === 'new_chat')
                <div class="h-full flex flex-col">
                    <div class="px-6 h-16 flex items-center justify-between border-b border-gray-100">
                        <h3 class="font-bold text-gray-800 text-lg">New Chat</h3>
                        <button wire:click="$set('view', 'welcome')" class="p-2 hover:bg-gray-100 rounded-full text-gray-500">
                            <x-lucide-x class="w-5 h-5"/>
                        </button>
                    </div>

                    <div class="p-6">
                        <div class="relative max-w-lg mx-auto">
                            <div class="flex items-center border rounded-xl px-4 py-3 focus-within:ring-2 focus-within:ring-purple-500 focus-within:border-purple-500 bg-gray-50">
                                <span class="text-gray-400 mr-2 font-medium">To:</span>
                                <input 
                                    wire:model.live="searchQuery"
                                    type="text" 
                                    placeholder="Type username..." 
                                    class="bg-transparent border-none focus:ring-0 w-full text-sm placeholder-gray-400 text-gray-900 focus:outline-none"
                                    autofocus
                                >
                            </div>
                            
                            @if(strlen($searchQuery) > 0)
                                <div class="mt-2 border border-gray-100 rounded-xl shadow-lg bg-white max-h-96 overflow-y-auto">
                                    @forelse($this->searchResults as $user)
                                        <button 
                                            wire:click="openRoom({{ $user->id }})"
                                            class="w-full text-left px-4 py-3 hover:bg-gray-50 text-sm flex items-center gap-3 border-b border-gray-50 last:border-none"
                                        >
                                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-sm">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                        </button>
                                    @empty
                                        <div class="px-4 py-4 text-sm text-gray-500 text-center">User not found.</div>
                                    @endforelse
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if($activeUserId && $view === 'room')
                <div class="h-full flex flex-col">
                    <div class="px-6 h-16 flex items-center justify-between border-b border-gray-100 bg-white">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold text-sm">
                                {{ substr($this->activeUser->name ?? 'U', 0, 2) }}
                            </div>
                            <div>
                                <div class="font-bold text-gray-800">{{ $this->activeUser->name ?? 'User' }}</div>
                                {{-- <div class="text-xs text-green-500 flex items-center gap-1">● Online</div> --}}
                            </div>
                        </div>
                        <div class="flex gap-2 text-gray-500">
                            <button 
                                wire:click="clearChat"
                                wire:confirm="Bersihkan chat? Pesan akan hilang dari tampilan Anda."
                                class="cursor-pointer hover:bg-red-50 hover:text-red-600 p-2 rounded-full transition"
                                title="Delete for Me"
                            >
                                <x-lucide-trash-2 class="w-5 h-5"/>
                            </button>
                        </div>
                    </div>

                    {{-- Isi Chat --}}
                    <div 
                        id="page-message-container"
                        class="flex-1 bg-white p-6 overflow-y-auto flex flex-col gap-3 scrollbar-hide"
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
                    
                    <div class="p-4 border-t border-gray-100 bg-white">
                        <form wire:submit.prevent="sendMessage" class="flex gap-2 items-end max-w-4xl mx-auto w-full">
                            <div class="w-full flex bg-gray-100 rounded-2xl relative">
                                <textarea 
                                    wire:model="messageBody"
                                    rows="1"
                                    placeholder="Message..." 
                                    class="w-full bg-gray-100 rounded-2xl pl-4 pr-12 py-3 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500 resize-none overflow-y-auto max-h-32"
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