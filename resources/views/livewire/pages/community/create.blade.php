<div class="max-w-xl mx-auto mt-10">
    <h1 class="text-xl font-bold mb-4">Create Community</h1>

    @if (session()->has('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block mb-1">Name Community</label>
            <input type="text" wire:model="name"
                class="w-full border rounded p-2">

            @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block mb-1">Description</label>
            <textarea wire:model="description"
                class="w-full border rounded p-2"></textarea>

            @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button class="bg-orange-500 text-white px-4 py-2 rounded">
            Create
        </button>
    </form>
</div>