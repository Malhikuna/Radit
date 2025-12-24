<div class="max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">Edit Community</h1>

    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label class="block">Name Community</label>
            <input type="text" wire:model="name"
                class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block">Description</label>
            <textarea wire:model="description"
                class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <button class="bg-orange-500 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>
</div>
