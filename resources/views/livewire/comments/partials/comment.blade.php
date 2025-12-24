@php
    $indent = $level * 24;
@endphp

<div class="bg-white border rounded-lg p-3 text-sm mb-2"
     style="margin-left: {{ $indent }}px">

    {{-- AUTHOR --}}
    <div class="flex items-center gap-2 text-xs text-gray-500 mb-1">
        <span class="font-semibold text-gray-800">
            u/{{ $comment->user->name }}
        </span>
        • {{ $comment->created_at->diffForHumans() }}
    </div>

    {{-- CONTENT --}}
    @if ($editId === $comment->id)
        <textarea
            wire:model.defer="editContent"
            rows="3"
            class="w-full border rounded-md p-2 mb-2"
        ></textarea>

        <div class="flex gap-3 text-xs">
            <button wire:click="update" class="text-green-600 hover:underline">
                Simpan
            </button>
            <button wire:click="cancelEdit" class="text-red-600 hover:underline">
                Batal
            </button>
        </div>
    @else
        <p class="text-gray-800 whitespace-pre-line mb-2">
            {{ $comment->deleted_at ? '[komentar dihapus]' : $comment->content }}
        </p>
    @endif

    {{-- FOOTER ACTIONS --}}
    @if (!$comment->deleted_at)
        <div class="flex items-center gap-4 text-xs text-gray-500">

            {{-- VOTE --}}
            <div class="flex items-center gap-1">
                <button
                    wire:click="voteComment({{ $comment->id }}, 1)"
                    class="hover:text-orange-500"
                >▲</button>

                <span class="font-semibold text-gray-700">
                    {{ $comment->votes->sum('value') }}
                </span>

                <button
                    wire:click="voteComment({{ $comment->id }}, -1)"
                    class="hover:text-blue-500"
                >▼</button>
            </div>

            @auth
                <button
                    wire:click="reply({{ $comment->id }})"
                    class="hover:underline"
                >
                    Reply
                </button>

                @can('update', $comment)
                    <button
                        wire:click="edit({{ $comment->id }})"
                        class="hover:underline"
                    >
                        Edit
                    </button>
                @endcan

                @can('delete', $comment)
                    <button
                        wire:click="delete({{ $comment->id }})"
                        class="hover:underline text-red-600"
                    >
                        Delete
                    </button>
                @endcan
            @endauth
        </div>
    @endif
</div>

{{-- REPLIES --}}
@if ($comment->replies->count())
    <div class="space-y-2">
        @foreach ($comment->replies as $reply)
            @include('livewire.comments.partials.comment', [
                'comment' => $reply,
                'level' => $level + 1
            ])
        @endforeach
    </div>
@endif
