<div class="bg-white rounded-xl shadow-sm p-6 space-y-4">

    <h2 class="text-xl font-bold text-[#7A49A6]">PDF Reports</h2>

    <div class="flex items-center gap-4">
        <select wire:model="reportType"
                class="border rounded-lg px-3 py-2 focus:ring-[#9966CC]">
            <option value="users">Users</option>
            <option value="posts">Posts</option>
            <option value="communities">Communities</option>
        </select>

        <button wire:click="generatePdf"
                class="bg-[#9966CC] text-white px-5 py-2 rounded-lg
                       hover:bg-[#7A49A6] transition">
            Generate PDF
        </button>
    </div>

</div>
