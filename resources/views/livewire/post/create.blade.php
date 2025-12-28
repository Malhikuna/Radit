<div class="max-w-2xl mx-auto mt-6">

    <div class="bg-white rounded-lg shadow border border-gray-100">

        {{-- HEADER --}}
        <div class="px-4 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
            <h1 class="font-semibold text-base">Create a post</h1>
        </div>

        {{-- BODY --}}
        <div class="p-4 space-y-4">

        {{-- COMMUNITY SELECTOR --}}
<div class="relative">

    {{-- INPUT WRAPPER --}}
    <div
        class="
            flex items-center gap-2 w-full rounded-md px-3 py-2 bg-white
            border transition
            {{ $community_id
                ? 'border-purple-500 ring-1 ring-purple-200'
                : 'border-gray-100' }}
            focus-within:ring-1 focus-within:ring-purple-500
        "
    >

        {{-- ICON --}}
        @if ($community_id)
            <x-community-icon
                :community="\App\Models\Community::find($community_id)"
                size="30"
            />
        @endif

        {{-- INPUT --}}
        <input
            type="text"
            wire:model.live.debounce.300ms="communitySearch"
            placeholder="Choose a community"
            autocomplete="off"
            class="flex-1 border-0 p-0 text-sm bg-transparent focus:outline-none focus:ring-0"
        >
    </div>

    {{-- DROPDOWN --}}
    @if (count($communities) > 0)
        <div
            class="absolute z-20 w-full mt-1 bg-white rounded-md shadow border border-gray-100 overflow-hidden"
        >
            @foreach ($communities as $community)
                <button
                    type="button"
                    wire:click="selectCommunity({{ $community->id }})"
                    class="
                        group flex items-center gap-2 w-full px-3 py-2 text-sm text-left
                        border-l-4 transition
                        {{ $community_id === $community->id
                            ? 'border-purple-500 bg-purple-50'
                            : 'border-transparent hover:border-purple-400 hover:bg-gray-50' }}
                    "
                >
                    <x-community-icon :community="$community" size="30" />
                    <span>{{ $community->name }}</span>
                </button>
            @endforeach
        </div>
    @endif
</div>

            @error('community_id')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror

            {{-- TABS --}}
            <div class="flex border-b text-sm">
                @foreach ([
                    'text'  => 'pencil-square',
                    'image' => 'photo',
                    'video' => 'video-camera',
                    'link'  => 'link',
                    'poll'  => 'chart-bar',
                ] as $key => $icon)
                    <button
                        type="button"
                        wire:click="setType('{{ $key }}')"
                        class="cursor-pointer flex-1 py-2 flex items-center justify-center gap-2
                            {{ $type === $key
                                ? 'border-b-2 border-blue-600 font-medium text-blue-600'
                                : 'text-gray-500 hover:text-gray-700' }}"
                    >
                        <x-dynamic-component
                            :component="'heroicon-s-' . $icon"
                            class="w-4 h-4"
                        />
                        <span>{{ ucfirst($key) }}</span>
                    </button>
                @endforeach
            </div>


            {{-- TITLE --}}
            <input
                wire:model.defer="title"
                placeholder="Title"
                class="w-full border border-gray-100 focus:outline-none focus:ring-1 focus:ring-purple-500 rounded-md px-3 py-2 text-sm"
            >
            @error('title')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror

            {{-- TEXT --}}
            @if ($type === 'text')
                <textarea
                    wire:model.defer="content"
                    placeholder="What are your thoughts?"
                    class="w-full h-32 border border-gray-100 focus:outline-none focus:ring-1 focus:ring-purple-500 rounded-md px-3 py-2 text-sm resize-none"
                ></textarea>
            @endif

            {{-- LINK --}}
            @if ($type === 'link')
                <input
                    wire:model.defer="url"
                    placeholder="https://example.com"
                    class="w-full border border-gray-100 focus:outline-none focus:ring-1 focus:ring-purple-500 rounded-md px-3 py-2 text-sm"
                >
                @error('url')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror
            @endif

            {{-- IMAGE --}}
            @if ($type === 'image')
                <input type="file" wire:model="image" class="text-sm">
                @error('image')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}" class="rounded-md max-h-64 mx-auto mt-2">
                @endif
            @endif

            {{-- VIDEO --}}
            @if ($type === 'video')
                <input type="file" wire:model="video" class="text-sm">
                @error('video')
                    <p class="text-xs text-red-500">{{ $message }}</p>
                @enderror

                @if ($video)
                    <video controls class="rounded-md max-h-64 mx-auto mt-2">
                        <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
            @endif

            {{-- POLL --}}
            @if ($type === 'poll')
                <input
                    type="text"
                    wire:model.defer="pollQuestion"
                    placeholder="Poll question"
                    class="w-full border border-gray-100 focus:outline-none focus:ring-1 focus:ring-purple-500 rounded-md px-3 py-2 text-sm mb-2"
                >
                @foreach ($pollOptions as $i => $option)
                    <div class="flex gap-2 items-center mb-2">
                        <input
                            type="text"
                            wire:model.defer="pollOptions.{{ $i }}"
                            placeholder="Option {{ $i + 1 }}"
                            class="flex-1 border border-gray-100 rounded-md px-3 py-2 text-sm"
                        >
                        @if ($i >= 2)
                            <button type="button" wire:click="removePollOption({{ $i }})" class="text-red-500">✖</button>
                        @endif
                    </div>
                @endforeach
                <button type="button" wire:click="addPollOption" class="text-blue-600 text-sm">+ Add option</button>
            @endif

        </div>

        {{-- FOOTER --}}
        <div class="px-4 py-3 border-t border border-gray-100 flex justify-end bg-gray-50">
            <button
                wire:click="post"
                class="cursor-pointer bg-[#6395ee] hover:bg-[#4b6eab] text-white text-sm px-5 py-2 rounded-full"
            >
                Post
            </button>
        </div>

    </div>
</div>
