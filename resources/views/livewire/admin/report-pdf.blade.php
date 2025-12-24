<div class="p-4 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">PDF Reporting</h2>

    {{-- Filter contoh: role --}}
    <div class="mb-4">
        <label class="block mb-1 font-semibold">Filter Users by Role:</label>
        <select wire:model="filterRole" class="border rounded px-2 py-1">
            <option value="">All Roles</option>
            <option value="admin">Admin</option>
            <option value="member">Member</option>
        </select>
    </div>

    <div>
        <button wire:click="downloadPdf" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Download PDF Report
        </button>
    </div>
</div>
