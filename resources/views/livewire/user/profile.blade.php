<div class="max-w-6xl mx-auto py-6">

    {{-- ================= HEADER ================= --}}
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold text-xl relative">

            {{-- Foto Profil / Inisial --}}
            @if ($photo)
            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full rounded-full object-cover">
            @elseif ($user->avatar && file_exists(public_path($user->avatar)))
            <img src="{{ asset($user->avatar) }}" class="w-full h-full rounded-full object-cover">
            @else
            {{ strtoupper(substr($user->name, 0, 1)) }}
            @endif

            {{-- Tombol Upload --}}
            <label class="flex items-center justify-center cursor-pointer absolute h-7 w-7 rounded-full -bottom-0.5 -right-1 bg-gray-400 hover:bg-gray-300 transition">
                <x-lucide-image class="w-4 text-white" />
                <input type="file"
                    wire:model="photo"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="hidden"
                    wire:loading.attr="disabled">
            </label>

            {{-- Loading Indicator --}}
            <div wire:loading wire:target="photo" class="absolute inset-0 bg-black bg-opacity-30 rounded-full flex items-center justify-center">
                <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            </div>

            {{-- Pesan Error --}}
            @error('photo')
            <span class="absolute top-full left-0 text-[10px] text-red-500 whitespace-nowrap mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Info Nama & Karma --}}
        <div>
            <h1 class="text-xl font-bold dark:text-white">{{ $user->name }}</h1>
            <p class="text-sm text-gray-500 dark:text-gray-300">
                u/{{ $user->username ?? 'user'.$user->id }} • {{ $karma }} Karma
            </p>

            {{-- Feedback sukses --}}
            @if (session()->has('success'))
            <p class="text-green-500 text-sm mt-1">{{ session('success') }}</p>
            @endif
        </div>
    </div>

    {{-- ================= TABS ================= --}}
    <div x-data="{ tab: 'posts' }">

        {{-- TAB NAV --}}
        <div class="flex gap-6 border-b dark:border-gray-600 mb-4 text-sm font-semibold">
            <button @click="tab='posts'"
                :class="tab==='posts'
                    ? 'border-b-2 border-black dark:border-white text-black dark:text-white'
                    : 'text-gray-500 dark:text-gray-300'"
                class="pb-3 cursor-pointer">
                Posts
            </button>

            <button @click="tab='comments'"
                :class="tab==='comments'
                    ? 'border-b-2 border-black dark:border-white text-black dark:text-white'
                    : 'text-gray-500 dark:text-gray-300'"
                class="pb-3 cursor-pointer">
                Comments
            </button>
        </div>

        {{-- CREATE POST --}}
        <div class="mb-6">
            <a href="{{ route('posts.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full
                        border text-sm font-semibold hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                ➕ Create Post
            </a>
        </div>

        {{-- ================= POSTS ================= --}}
        <div x-show="tab==='posts'">

            @if ($posts->count())
            <div class="space-y-4">

                @foreach ($posts as $post)
                {{-- ===== POST CARD ===== --}}
                <livewire:post.post-list :user-id="$user->id" />
                @endforeach

            </div>
            @else
            {{-- EMPTY --}}
            <div class="flex flex-col items-center py-20 text-center">
                <h2 class="text-xl font-bold mb-2 dark:text-white">
                    You don't have any posts yet
                </h2>
                <p class="text-gray-500 mb-6 dark:text-gray-400">
                    Once you post to a community, it’ll show up here.
                </p>
                <a href="{{ route('posts.create') }}"
                    class="px-6 py-2 bg-blue-600 text-white rounded-full
                                text-sm font-semibold hover:bg-blue-700">
                    Create Your First Post
                </a>
            </div>
            @endif
        </div>

        {{-- ================= COMMENTS ================= --}}
        <div x-show="tab==='comments'">
            @if ($comments->count())
            <div class="divide-y">
                @foreach ($comments as $comment)
                <div class="py-4">
                    <p class="text-xs text-gray-500 mb-1">
                        Commented {{ $comment->created_at->diffForHumans() }}
                        on
                        <a href="{{ route('posts.show', $comment->post->id) }}"
                            class="text-blue-600 hover:underline">
                            {{ $comment->post->title }}
                        </a>
                    </p>
                    <p class="text-sm text-gray-800">
                        {{ $comment->content }}
                    </p>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-xl font-bold py-20 text-center text-gray-500 dark:text-white">
                You haven't commented yet
            </div>
            @endif
        </div>

    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</div>