<div class="space-y-6">

    {{-- COMMENT FORM --}}
    <div class="bg-white border rounded-xl p-4">
        <textarea
            wire:model.defer="content"
            rows="3"
            class="w-full border rounded-lg p-3 text-sm focus:ring focus:ring-orange-200"
            placeholder="{{ $parentId ? 'Balas komentar…' : 'Apa pendapatmu?' }}"
        ></textarea>

        <div class="flex items-center justify-between mt-3">
            <span class="text-xs text-gray-500">
                Markdown supported
            </span>

            <div class="flex gap-2">
                @if($parentId)
                    <button
                        wire:click="$set('parentId', null)"
                        class="text-xs px-3 py-1 rounded-full bg-gray-200 hover:bg-gray-300">
                        Cancel
                    </button>
                @endif

                <button
                    wire:click="store"
                    class="text-xs px-4 py-1.5 rounded-full bg-orange-600 text-white hover:bg-orange-700">
                    Comment
                </button>
            </div>
        </div>
    </div>

    {{-- COMMENT LIST --}}
    <div class="space-y-4">
        @foreach($comments as $comment)
            <div class="flex gap-3">

                {{-- THREAD LINE --}}
                <div class="w-6 flex justify-center">
                    <div class="w-px bg-gray-300"></div>
                </div>

                {{-- COMMENT CARD --}}
                <div class="flex-1">

                    <div class="bg-white border rounded-xl p-4">

                        {{-- HEADER --}}
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <div class="w-6 h-6 rounded-full bg-gray-300"></div>
                            <span class="font-semibold text-gray-800">
                                u/{{ $comment->user->name }}
                            </span>
                            <span>•</span>
                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                        </div>

                        {{-- EDIT MODE --}}
                        @if($editId === $comment->id)
                            <textarea
                                wire:model.defer="editContent"
                                rows="3"
                                class="w-full border rounded-lg p-2 text-sm mt-3"
                            ></textarea>

                            <div class="flex gap-3 text-xs mt-2">
                                <button wire:click="update" class="text-orange-600 hover:underline">
                                    Save
                                </button>
                                <button wire:click="cancelEdit" class="text-gray-500 hover:underline">
                                    Cancel
                                </button>
                            </div>
                        @else
                            <p class="text-sm text-gray-800 mt-2 whitespace-pre-line">
                                {{ $comment->content }}
                            </p>

                            {{-- ACTION --}}
                            <div class="flex gap-4 text-xs text-gray-500 mt-3">
                                <button
                                    wire:click="reply({{ $comment->id }})"
                                    class="hover:underline">
                                    Reply
                                </button>

                                @can('update', $comment)
                                    <button
                                        wire:click="edit({{ $comment->id }})"
                                        class="hover:underline">
                                        Edit
                                    </button>
                                @endcan

                                @can('delete', $comment)
                                    <button
                                        wire:click="delete({{ $comment->id }})"
                                        class="hover:underline text-red-500">
                                        Delete
                                    </button>
                                @endcan
                            </div>
                        @endif
                    </div>

                    {{-- REPLIES --}}
                    <div class="ml-6 mt-4 space-y-3">
                        @foreach($comment->replies as $reply)
                            <div class="flex gap-3">

                                <div class="w-4 flex justify-center">
                                    <div class="w-px bg-gray-300"></div>
                                </div>

                                <div class="bg-gray-50 border rounded-lg p-3 flex-1">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <div class="w-5 h-5 bg-gray-300 rounded-full"></div>
                                        <span class="font-semibold text-gray-800">
                                            u/{{ $reply->user->name }}
                                        </span>
                                        <span>•</span>
                                        <span>{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>

                                    <p class="text-sm mt-1">
                                        {{ $reply->content }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>
