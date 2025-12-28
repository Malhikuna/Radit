<div class="w-full max-w-5xl mx-auto px-4 py-4">

    <div class="flex items-center gap-3 mb-6 overflow-x-auto">
        @php
            $tabs = [
                'all' => 'All',
                'posts' => 'Posts',
                'communities' => 'Communities',
                'people' => 'People'
            ];
        @endphp

        @foreach($tabs as $key => $label)
            <button 
                wire:click="setFilter('{{ $key }}')"
                class="px-4 py-2 rounded-full text-sm font-medium transition-colors duration-200
                {{ $filter === $key 
                    ? 'bg-blue-100 text-blue-700 font-semibold' 
                    : 'bg-gray-100 hover:bg-gray-200 text-gray-700' 
                }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <div class="space-y-6">

        {{-- SECTION: COMMUNITIES / PEOPLE (Tampil jika filter All atau People) --}}
        @if(in_array($filter, ['all', 'people']) && !empty($users))
            <div>
                <h2 class="text-lg font-semibold mb-3">People</h2>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 space-y-4">
                    @foreach($users as $user)
                        <div class="flex items-center gap-4">
                            <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.$user->name }}" 
                                    class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-500">u/{{ $user->username ?? $user->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- SECTION: POSTS --}}
        @if(in_array($filter, ['all', 'posts']))
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-lg font-semibold">Posts</h2>
                </div>

                @if(empty($query))
                    <div class="text-center py-10 text-gray-500">
                        Ketik sesuatu untuk mencari...
                    </div>
                @elseif($posts->isEmpty())
                    <div class="text-center py-10 text-gray-500 bg-gray-50 rounded-lg">
                        Tidak ada postingan ditemukan untuk "{{ $query }}".
                    </div>
                @else
                    <div class="space-y-4">
                        {{-- Loop Postingan --}}
                        @foreach ($posts as $post)
                            {{-- Gunakan Component Card agar rapi --}}
                            <livewire:components.card 
                                :post="$post" 
                                :key="'post-'.$post->id" 
                            />
                        @endforeach
                    </div>
                @endif
            </div>
        @endif
        
    </div>
</div>