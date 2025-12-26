<div class="space-y-4">
    <h2 class="text-2xl font-bold mb-4">PDF Reports</h2>

    <div class="flex items-center gap-4">
        <select wire:model="reportType" class="border rounded p-2">
            <option value="users">Users</option>
            <option value="posts">Posts</option>
            <option value="communities">Communities</option>
        </select>

        <button wire:click="generatePdf" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Generate PDF
        </button>
    </div>
</div>
