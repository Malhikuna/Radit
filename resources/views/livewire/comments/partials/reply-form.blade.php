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
        class="w-full border-2 dark:text-gray-200 border-gray-300 dark:border-gray-600 focus:outline-none rounded-lg p-2 text-sm dark:focus:border-white dark:placeholder-gray-500"
        placeholder="Tulis balasan..."
    ></textarea>

    {{-- ACTION --}}
    <div class="flex justify-end mt-1">
        <button
            wire:click="store"
            class="cursor-pointer bg-[#6395ee] rounded-full text-sm text-white px-3 py-1 hover:bg-[#6395ee]/90"
            type="button"
        >
            Kirim
        </button>
    </div>

</div>
