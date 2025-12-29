<div class="space-y-4">

    {{-- FORM KOMENTAR UTAMA --}}
    @auth
        <div class="flex gap-3">

            {{-- AVATAR --}}
            <div
                class="w-9 h-9 rounded-full bg-gray-300
                       flex items-center justify-center
                       text-xs font-semibold text-gray-700"
            >
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="flex-1">
                <textarea
                    wire:model.defer="content"
                    rows="2"
                    class="w-full border rounded-lg p-2 text-sm
                           focus:ring-2 focus:ring-purple-400 focus:border-purple-400"
                    placeholder="Tambahkan komentar..."
                ></textarea>

                <div class="flex justify-end mt-2 gap-2">
                    @if ($parentId)
                        <button
                            wire:click="cancelReply"
                            class="text-xs text-gray-400 hover:text-gray-600"
                        >
                            Batal
                        </button>
                    @endif

                    <button
                        wire:click="store"
                        class="bg-purple-600 text-white px-4 py-1.5
                               rounded-md text-xs hover:bg-purple-700"
                    >
                        Kirim
                    </button>
                </div>
            </div>
        </div>
    @endauth

    {{-- LIST KOMENTAR --}}
    @include('livewire.comments.partials.comment-list', [
        'comments' => $comments,
        'level' => 0
    ])
</div>
