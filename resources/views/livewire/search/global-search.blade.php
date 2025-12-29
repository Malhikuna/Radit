<div 
    x-data="{ 
        open: false, 
        search: @entangle('search').live
    }" 
    @click.away="open = false"
    class="relative w-full max-w-2xl mx-auto" 
>
    {{-- INPUT SEARCH BAR --}}
    <div class="relative group">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x-lucide-search class="h-5 w-5 text-gray-400 group-focus-within:text-gray-600" />
        </div>
        
        <input 
            type="text"
            name="q"
            value="{{ request('q') }}"
            wire:model.live.debounce.300ms="search"
            @focus="open = true"
            @keydown.escape="open = false"
            class="shadow-[0_0_3px_#9966CC] block w-full pl-10 pr-3 py-2 border border-purple-500 rounded-full leading-5 bg-gray-100 text-gray-900 placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-1 focus:ring-purple-500 focus:border-purple-500 sm:text-sm transition duration-150 ease-in-out h-10"
            placeholder="Find Anything"
            autocomplete="off"
        >
        
        {{-- Tombol Clear (X) di input --}}
        <div x-show="search.length > 0" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" @click="$wire.set('search', ''); open = true">
            <x-lucide-x-circle class="h-5 w-5 text-gray-400 hover:text-gray-600" />
        </div>
    </div>

    {{-- DROPDOWN RESULT --}}
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 w-full bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden max-h-[80vh] overflow-y-auto"
        style="display: none;"
    >
        
        {{-- STATE 1: KETIKA SEARCH KOSONG (Show Recent & Trending) --}}
        @if(strlen($search) < 2)
            
            {{-- Recent Searches --}}
            @if(count($recentSearches) > 0)
                <div class="py-2">
                    <div class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">
                        Recent
                    </div>
                    @foreach($recentSearches as $history)
                        <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer group">
                            <div class="flex items-center gap-3 w-full" wire:click="$set('search', '{{ $history->keyword }}')">
                                <x-lucide-clock class="w-5 h-5 text-gray-400"/>
                                <span class="text-sm text-gray-700">{{ $history->keyword }}</span>
                            </div>
                            <button wire:click.stop="deleteHistory({{ $history->id }})" class="text-gray-400 hover:text-red-500 p-1 rounded-full hover:bg-gray-200">
                                <x-lucide-x class="w-4 h-4"/>
                            </button>
                        </div>
                    @endforeach
                </div>
                <hr class="border-gray-100">
            @endif

            {{-- Trending --}}
            <div class="py-2">
                <div class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">
                    Trending Today
                </div>
                @foreach($trendingSearches as $trend)
                    <div class="flex items-start gap-3 px-4 py-3 hover:bg-gray-100 cursor-pointer" wire:click="$set('search', '{{ $trend['title'] }}')">
                        <x-lucide-trending-up class="w-5 h-5 text-purple-500 mt-0.5"/>
                        <div>
                            <div class="text-sm font-medium text-gray-800">{{ $trend['title'] }}</div>
                            <div class="text-xs text-gray-500">{{ $trend['desc'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            {{-- STATE 2: KETIKA MENGETIK (Show Results) --}}
            
            {{-- Jika Loading --}}
            <div wire:loading class="w-full text-center py-4 text-gray-500">
                <img
                    src="{{ asset('storage/icon/logo.png') }}"
                    alt="Logo"
                    class="m-auto h-20 animate-logo-bounce-fade"
                />
                Searching...
            </div>

            <div wire:loading.remove>
                {{-- Communities Section --}}
                @if(!empty($results['communities']) && count($results['communities']) > 0)
                    <div class="py-2">
                        <div class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Communities
                        </div>
                        @foreach($results['communities'] as $community)
                            <a 
                                href="{{ route('communities.show', $community->id) }}" 
                                @click="$wire.saveHistory('{{ $community->name }}')"
                                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100"
                            >
                                <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center font-bold text-xs border border-gray-200">
                                    r/{{ substr($community->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-800">r/{{ $community->name }}</div>
                                    <div class="text-xs text-gray-500">{{ number_format($community->users_count ?? 0) }} members</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Posts Section --}}
                @if(!empty($results['posts']) && count($results['posts']) > 0)
                    <div class="py-2 border-t border-gray-100">
                        <div class="px-4 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">
                            Posts
                        </div>
                        @foreach($results['posts'] as $post)
                            <a 
                                href="{{ route('posts.show', $post->id) }}" 
                                @click="$wire.saveHistory('{{ $post->title }}')"
                                class="block px-4 py-2 hover:bg-gray-100"
                            >
                                <div class="text-sm text-gray-800 font-medium truncate">{{ $post->title }}</div>
                                <div class="text-xs text-gray-500">
                                    in r/{{ $post->community->name ?? 'general' }} • Posted by u/{{ $post->user->name }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Not Found --}}
                @if(empty($results['communities']) && empty($results['posts']))
                    <div class="py-8 text-center">
                        <x-lucide-search-x class="w-12 h-12 text-gray-300 mx-auto mb-2"/>
                        <p class="text-gray-500">No results found for "{{ $search }}"</p>
                    </div>
                @endif
            </div>

        @endif

    </div>
</div>