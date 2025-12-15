<div class="bg-white p-6 rounded-xl shadow-sm border mb-6">
    <div class="flex items-center gap-3 mb-3">
        <div class="w-10 h-10 bg-black rounded-full"></div>
        <div>
            <p class="font-semibold">
                {{ $author }}
                <span class="ml-1 text-xs bg-blue-500 text-white px-2 py-0.5 rounded">Follow</span>
            </p>
            <span class="text-xs text-gray-500">{{ $time }}</span>
        </div>
    </div>

    <h2 class="font-bold text-lg mb-2">{{ $title }}</h2>

    @if(($content))
        <p class="text-sm text-gray-700 leading-relaxed mb-4">{{$content}}</p>
    @endif

    @if(($image))
        <img src="{{ $image }}" class="rounded-xl w-full mb-4" />
    @endif

    <div class="flex items-center gap-4 text-gray-700">
        <button
            wire:click="like"
            class="hover:text-red-500 transition"
        >
            ❤️ {{ $likes }}
        </button>
        <div class="flex items-center gap-1">💬 {{ $comments }}</div>
        <div class="flex items-center gap-1">🔁</div>
    </div>
</div>
