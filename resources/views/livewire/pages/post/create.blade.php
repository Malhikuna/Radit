<div class="max-w-2xl mx-auto mt-6">

    <div class="bg-white rounded-lg shadow border">

        {{-- HEADER --}}
        <div class="px-4 py-3 border-b flex items-center justify-between">
            <h1 class="font-semibold text-base">Create a post</h1>
        </div>

        {{-- BODY --}}
        <div class="p-4 space-y-4">

            {{-- COMMUNITY SELECTOR --}}
            <div class="relative">
                <input
                    wire:model="communitySearch"
                    placeholder="Choose a community"
                    class="w-full border rounded-md px-3 py-2 text-sm focus:outline-none focus:ring"
                >

                @if (count($communities))
                    <div class="absolute z-20 bg-white border rounded-md w-full mt-1 shadow">
                        @foreach ($communities as $community)
                            <button
                                type="button"
                                wire:click="selectCommunity({{ $community->id }})"
                                class="flex items-center gap-2 w-full px-3 py-2 text-sm hover:bg-gray-100"
                            >
                                <x-community-icon :community="$community" size="18" />
                                {{ $community->name }}
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
                @foreach (['text' => '📝', 'image' => '🖼️', 'video' => '🎬', 'link' => '🔗', 'poll' => '📊'] as $key => $icon)
                    <button
                        type="button"
                        wire:click="setType('{{ $key }}')"
                        class="flex-1 py-2 text-center {{ $type === $key
                            ? 'border-b-2 border-blue-600 font-medium text-blue-600'
                            : 'text-gray-500 hover:text-gray-700' }} "
                    >
                        {{ $icon }} {{ ucfirst($key) }}
                    </button>
                @endforeach
            </div>

            {{-- TITLE --}}
            <input
                wire:model.defer="title"
                placeholder="Title"
                class="w-full border rounded-md px-3 py-2 text-sm"
            >
            @error('title')
                <p class="text-xs text-red-500">{{ $message }}</p>
            @enderror

            {{-- TEXT --}}
            @if ($type === 'text')
                <textarea
                    wire:model.defer="content"
                    placeholder="What are your thoughts?"
                    class="w-full h-32 border rounded-md px-3 py-2 text-sm resize-none"
                ></textarea>
            @endif

            {{-- LINK --}}
            @if ($type === 'link')
                <input
                    wire:model.defer="url"
                    placeholder="https://example.com"
                    class="w-full border rounded-md px-3 py-2 text-sm"
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
                    class="w-full border rounded-md px-3 py-2 text-sm mb-2"
                >
                @foreach ($pollOptions as $i => $option)
                    <div class="flex gap-2 items-center mb-2">
                        <input
                            type="text"
                            wire:model.defer="pollOptions.{{ $i }}"
                            placeholder="Option {{ $i + 1 }}"
                            class="flex-1 border rounded-md px-3 py-2 text-sm"
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
        <div class="px-4 py-3 border-t flex justify-end bg-gray-50">
            <button
                wire:click="post"
                class="bg-blue-600 text-white text-sm px-5 py-2 rounded-full hover:bg-blue-700"
            >
                Post
            </button>
        </div>

    </div>
</div>
