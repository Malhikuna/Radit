@php
    $indent = $level === 0 ? 0 : 24;
    $initial = strtoupper(substr($comment->user->name, 0, 1));
@endphp

<div style="margin-left: {{ $indent }}px" class="group">

    {{-- COMMENT CARD --}}
    <div class="flex gap-3 text-sm items-start rounded-lg p-2 hover:bg-gray-50 transition">

        {{-- AVATAR --}}
        <div
            class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-purple-600
                   flex items-center justify-center
                   text-xs font-semibold text-white shrink-0"
        >
            {{ $initial }}
        </div>

        {{-- BODY --}}
        <div class="flex-1 min-w-0">

            {{-- USER + TIME --}}
            <div class="flex items-center gap-2 text-xs text-gray-500 flex-wrap">
                <span class="font-semibold text-gray-900 truncate">
                    {{ $comment->user->name }}
                </span>

                @if ($comment->parent)
                    <span class="text-gray-400">→</span>
                    <span class="text-purple-600 font-medium truncate">
                        {{ $comment->parent->user->name }}
                    </span>
                @endif

                <span class="text-gray-400">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
            </div>

            {{-- CONTENT --}}
            <p class="text-gray-800 leading-snug mt-0.5">
                {{ $comment->deleted_at ? 'Komentar dihapus' : $comment->content }}
            </p>

            {{-- ACTIONS --}}
            @if (!$comment->deleted_at)
                <div class="flex items-center gap-4 mt-1 text-xs text-gray-400 opacity-0 group-hover:opacity-100 transition">
                    @auth
                        <button
                            wire:click="reply({{ $comment->id }})"
                            class="hover:text-purple-600"
                        >
                            Balas
                        </button>
                    @endauth

                    @can('delete', $comment)
                        <button
                            wire:click="delete({{ $comment->id }})"
                            class="hover:text-red-500"
                        >
                            Hapus
                        </button>
                    @endcan
                </div>
            @endif

            {{-- TOGGLE REPLIES --}}
            @if ($comment->replies->count())
                <button
                    wire:click="toggleReplies({{ $comment->id }})"
                    class="mt-1 text-xs text-purple-600 hover:underline"
                >
                    {{ ($openReplies[$comment->id] ?? false)
                        ? 'Sembunyikan balasan'
                        : 'Lihat ' . $comment->replies->count() . ' balasan'
                    }}
                </button>
            @endif
        </div>

        {{-- VOTE (UJUNG KANAN FIX) --}}
        <div
            class="flex flex-col items-center gap-0.5 px-1 py-1
                   rounded-md bg-gray-100 text-gray-500 shrink-0"
        >
            <button
                wire:click="voteComment({{ $comment->id }}, 1)"
                class="hover:text-green-600 transition"
            >
                <x-heroicon-s-chevron-up class="w-4 h-4"/>
            </button>

            <span class="text-[11px] font-semibold text-gray-700 leading-none">
                {{ $comment->votes->sum('value') }}
            </span>

            <button
                wire:click="voteComment({{ $comment->id }}, -1)"
                class="hover:text-red-600 transition"
            >
                <x-heroicon-s-chevron-down class="w-4 h-4"/>
            </button>
        </div>
    </div>

    {{-- REPLY FORM --}}
    @includeWhen(
        $parentId === $comment->id,
        'livewire.comments.partials.reply-form',
        ['level' => $level]
    )

    {{-- REPLIES --}}
    @if ($comment->replies->count() && ($openReplies[$comment->id] ?? false))
        <div class="mt-2 pl-4 space-y-2 relative">
            <div class="absolute left-1 top-0 bottom-0 w-px bg-gray-200"></div>

            @include('livewire.comments.partials.comment-list', [
                'comments' => $comment->replies,
                'level' => $level + 1
            ])
        </div>
    @endif
</div>
