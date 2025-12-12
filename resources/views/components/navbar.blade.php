<nav class="w-full border-b bg-white px-6 py-4 flex justify-between items-center">
    <div class="flex items-center gap-3">
        <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png" class="w-10" />
        <span class="font-bold text-xl text-orange-500 leading-none">RADIT</span>
    </div>

    <div class="flex-1 px-10">
        <input type="text" placeholder="Cari disini..."
            class="w-full px-4 py-2 rounded-full border focus:outline-none focus:ring-2 focus:ring-orange-400">
    </div>

    <div class="flex items-center gap-4">
        <button class="flex items-center gap-1 border px-4 py-2 rounded-full hover:bg-gray-100" onclick="window.location='{{ url('/create-thread') }}'">
            <span>⚙️</span> Create
        </button>
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
             class="w-10 rounded-full border-yellow-400 border-4" />
    </div>
</nav>
