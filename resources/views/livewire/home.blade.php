<div>
    <div class="flex gap-4 mb-4">
        <span class="px-3 py-1 bg-yellow-200 rounded-full text-sm">🆕 New</span>
        <span class="px-3 py-1 bg-orange-200 rounded-full text-sm">🔥 Best</span>
    </div>

    {{-- POST 1 --}}
    <livewire:card/><livewire:card
        author="Traveller"
        time="5 hours ago"
        title="Cinta Ala Wifi"
        content="Kau seperti Wifi tetangga..."
        :likes="50"
        :comments="7"
    />

        {{-- POST 2 --}}
    <livewire:card
        author="Jomokers"
        time="3 hours ago"
        title="Viral!!"
        image="https://i.ibb.co/M2XkdnM/meme-jomok.jpg"
        :likes="50"
        :comments="7"
    />
</div>
