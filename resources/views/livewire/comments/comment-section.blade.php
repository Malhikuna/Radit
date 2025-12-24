<div class="mt-6">

    {{-- CREATE COMMENT --}}
    @auth
        <div class="bg-white border rounded-lg p-4 mb-6">
            <textarea
                wire:model.defer="content"
                rows="3"
                class="w-full border rounded-md p-2 text-sm focus:outline-none focus:ring"
                placeholder="Tambahkan komentar..."
            ></textarea>

            <div class="flex items-center justify-between mt-2">
                @if ($parentId)
                    <span class="text-sm text-gray-500">
                        Membalas komentar
                        <button wire:click="cancelReply" class="text-red-500 ml-2">Batal</button>
                    </span>
                @endif

                <button
                    wire:click="store"
                    class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-1.5 rounded-md text-sm"
                >
                    Kirim
                </button>
            </div>
        </div>
    @endauth

    {{-- COMMENT LIST --}}
    <div class="space-y-4">
        @foreach ($comments as $comment)
            @include('livewire.comments.partials.comment', [
                'comment' => $comment,
                'level' => 0
            ])
        @endforeach
    </div>

</div>
