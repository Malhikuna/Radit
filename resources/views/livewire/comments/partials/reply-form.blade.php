<div class="ml-11 mt-2">

    {{-- INFO BALAS (HANYA INFO, BUKAN ISI KOMENTAR) --}}
    @if ($replyToUser)
        <div
            class="mb-1 flex items-center justify-between
                   text-xs text-purple-600 bg-purple-50
                   px-2 py-1 rounded-md"
        >
            <span>
                Membalas <strong>{{ $replyToUser }}</strong>
            </span>

            <button
                wire:click="cancelReply"
                class="text-purple-400 hover:text-purple-600"
                type="button"
            >
                ✕
            </button>
        </div>
    @endif

    {{-- TEXTAREA (TANPA MENTION) --}}
    <textarea
        wire:model.defer="content"
        rows="2"
        class="w-full border rounded-lg p-2 text-sm focus:ring-1 focus:ring-purple-500"
        placeholder="Tulis balasan..."
    ></textarea>

    {{-- ACTION --}}
    <div class="flex justify-end mt-1">
        <button
            wire:click="store"
            class="bg-purple-600 text-white px-3 py-1 rounded-md text-xs hover:bg-purple-700"
            type="button"
        >
            Kirim
        </button>
    </div>

</div>
