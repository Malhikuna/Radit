<div class="max-w-2xl mx-auto mt-8 px-4"> {{-- Lebih sempit dari max-w-2xl --}}
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- HEADER --}}
        <div class="px-5 py-4 border-b bg-gradient-to-r from-gray-50 to-white flex items-center justify-between">
            <h1 class="font-semibold text-lg text-gray-800">Create a post</h1>
        </div>

        {{-- BODY --}}
        <div class="p-5 space-y-6">

            {{-- COMMUNITY SELECTOR --}}
            <div class="relative">
                <label class="text-xs font-medium text-gray-500 mb-1 block">Community</label>
                <div class="flex items-center gap-2 w-full rounded-xl px-3 py-2.5 bg-white
                            border transition
                            {{ $community_id ? 'border-purple-500 ring-1 ring-purple-200' : 'border-gray-200 hover:border-gray-300' }}
                            focus-within:ring-1 focus-within:ring-purple-500">
                    @if ($community_id)
                        <x-community-icon :community="\App\Models\Community::find($community_id)" size="32" />
                    @endif
                    <input type="text"
                           wire:model.live.debounce.300ms="communitySearch"
                           placeholder="Choose a community"
                           autocomplete="off"
                           class="flex-1 bg-transparent border-0 p-0 text-sm placeholder-gray-400 focus:outline-none focus:ring-0">
                </div>

                @if (count($communities) > 0)
                    <div class="absolute z-30 w-full mt-2 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                        @foreach ($communities as $community)
                            <button type="button" wire:click="selectCommunity({{ $community->id }})"
                                    class="group flex items-center gap-3 w-full px-4 py-3 text-sm text-left
                                           transition border-l-4
                                           {{ $community_id === $community->id ? 'border-purple-500 bg-purple-50' : 'border-transparent hover:border-purple-400 hover:bg-gray-50' }}">
                                <x-community-icon :community="$community" size="32" />
                                <span class="font-medium text-gray-700">{{ $community->name }}</span>
                            </button>
                        @endforeach
                    </div>
                @endif

                @error('community_id')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TABS --}}
            <div class="flex flex-wrap bg-gray-50 rounded-xl p-1 text-sm gap-1"> {{-- flex-wrap supaya tombol tidak melebihi lebar --}}
                @foreach (['text'=>'pencil-square','image'=>'photo','video'=>'video-camera','link'=>'link','poll'=>'chart-bar'] as $key=>$icon)
                    <button type="button" wire:click="setType('{{ $key }}')"
                        class="flex-1 flex items-center justify-center gap-2 px-3 py-2 rounded-lg transition
                               {{ $type === $key ? 'bg-white shadow text-blue-600 font-medium' : 'text-gray-500 hover:text-gray-700' }}">
                        <x-dynamic-component :component="'heroicon-s-' . $icon" class="w-4 h-4" />
                        <span>{{ ucfirst($key) }}</span>
                    </button>
                @endforeach
            </div>

            {{-- TITLE --}}
            <div>
                <input wire:model.defer="title" placeholder="Title"
                       class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-200 focus:outline-none focus:ring-1 focus:ring-purple-500">
                @error('title')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- TEXT --}}
            @if($type === 'text')
                <div wire:ignore>
                    <label class="text-xs font-medium text-gray-600 mb-1 block">Content</label>
                    <x-trix-input id="content" name="content" wire:model.defer="content" />
                    @error('content')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                </div>
            @endif

            {{-- LINK --}}
            @if ($type === 'link')
                <input wire:model.defer="url" placeholder="https://example.com"
                       class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-200 focus:outline-none focus:ring-1 focus:ring-purple-500">
                @error('url')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
            @endif

            {{-- IMAGE --}}
            @if ($type === 'image')
                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center relative">
                    <input type="file" wire:model="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="flex flex-col items-center justify-center pointer-events-none">
                        <x-heroicon-s-photo class="w-10 h-10 text-gray-300" />
                        <p class="text-sm text-gray-400 mt-2">Upload your image</p>
                        <p class="text-xs text-gray-400">JPG, PNG, WEBP • Maks 2 MB</p>
                    </div>
                    @error('image')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                    @if ($image)
                        <div class="mt-4">
                            <img src="{{ $image->temporaryUrl() }}" class="rounded-2xl mx-auto max-h-72 shadow-lg border border-gray-200">
                            <p class="text-xs text-gray-500 mt-1">{{ number_format($image->getSize()/1024/1024,2) }} MB</p>
                        </div>
                    @endif
                </div>
            @endif

            {{-- VIDEO --}}
            @if ($type === 'video')
                <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center relative">
                    <input type="file" wire:model="video" accept="video/mp4,video/webm,video/ogg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div class="flex flex-col items-center justify-center pointer-events-none">
                        <x-heroicon-s-video-camera class="w-10 h-10 text-gray-300" />
                        <p class="text-sm text-gray-400 mt-2">Upload your video</p>
                        <p class="text-xs text-gray-400">MP4 / WebM / OGG • Maks 20 MB</p>
                    </div>
                    @error('video')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                    @if ($video)
                        <div class="mt-4 relative">
                            <video controls class="rounded-2xl mx-auto max-h-72 shadow-lg border border-gray-200">
                                <source src="{{ $video->temporaryUrl() }}">
                            </video>
                            <p class="text-xs text-gray-500 mt-1">{{ number_format($video->getSize()/1024/1024,2) }} MB</p>
                        </div>
                    @endif
                </div>
            @endif

            {{-- POLL --}}
            @if ($type === 'poll')
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-gray-600">Poll Question</label>
                        <input type="text" wire:model.live="pollQuestion" placeholder="Ask a question…"
                               class="mt-1 w-full rounded-xl px-4 py-2.5 text-sm border border-gray-200 focus:outline-none focus:ring-1 focus:ring-purple-500">
                        @error('pollQuestion')<p class="text-xs text-red-500 mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-medium text-gray-600">Options</label>
                        @foreach ($pollOptions as $i => $option)
                            <div class="flex items-center gap-2 group">
                                <input type="text" wire:model.live="pollOptions.{{ $i }}" placeholder="Option {{ $i+1 }}"
                                       class="flex-1 rounded-xl px-4 py-2 text-sm border border-gray-200 focus:outline-none focus:ring-1 focus:ring-purple-500">
                                @if($i>=2)
                                    <button type="button" wire:click="removePollOption({{ $i }})"
                                            class="opacity-0 group-hover:opacity-100 text-gray-400 hover:text-red-500 transition">✕</button>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <button type="button" wire:click="addPollOption" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-700">
                        <x-heroicon-s-plus-circle class="w-4 h-4" /> Add option
                    </button>

                    <p class="text-xs text-gray-500">• Maksimal 6 opsi<br>• User hanya bisa memilih satu opsi</p>
                </div>
            @endif

        </div>

        {{-- FOOTER --}}
        <div class="px-5 py-4 border-t bg-gray-50 flex justify-end">
            <button wire:click="post"
                    class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-sm font-medium px-6 py-2.5 rounded-full transition">
                Post
            </button>
        </div>

    </div>
</div>
