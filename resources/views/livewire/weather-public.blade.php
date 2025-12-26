<div class="max-w-sm space-y-4">

    {{-- INPUT + CARI --}}
    <div class="flex gap-2">
        <input
            type="text"
            wire:model.debounce.500ms="city"
            wire:keydown.enter="getWeather"
            placeholder="Cari daerah..."
            class="flex-1 border rounded-lg px-3 py-2 text-sm shadow focus:ring-2 focus:ring-blue-400"
        />
        <button wire:click="getWeather"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition flex-shrink-0">
            Cari
        </button>
    </div>

    {{-- Tombol Favorit --}}
    <div class="flex justify-end">
        <button wire:click="addFavorite"
                class="bg-yellow-400 text-white px-3 py-2 rounded-lg shadow hover:bg-yellow-500 transition flex-shrink-0">
            ⭐ Tambah Favorit
        </button>
    </div>

    {{-- SUGGESTIONS --}}
    @if ($suggestions)
        <ul class="border rounded-lg bg-white text-sm shadow-md max-h-48 overflow-y-auto">
            @foreach ($suggestions as $item)
                <li wire:click="selectSuggestion('{{ $item }}')"
                    class="px-3 py-2 hover:bg-gray-100 cursor-pointer transition">
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    @endif

    {{-- FAVORITES --}}
    @if ($favorites)
        <div class="flex flex-wrap gap-2 text-xs">
            @foreach ($favorites as $fav)
                <div class="flex items-center gap-1 bg-yellow-100 px-3 py-1 rounded-full shadow-sm">
                    <button wire:click="selectFavorite('{{ $fav }}')" class="hover:underline text-gray-700 transition">
                        {{ $fav }}
                    </button>
                    <button wire:click="removeFavorite('{{ $fav }}')" class="text-red-500 font-bold hover:text-red-600 transition">
                        ×
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    {{-- LOADING --}}
    @if ($loading)
        <div class="bg-gray-50 p-3 text-sm text-gray-500 rounded shadow animate-pulse">
            Memuat cuaca...
        </div>
    @endif

    {{-- ERROR --}}
    @if ($error)
        <p class="text-red-500 text-sm">{{ $error }}</p>
    @endif

    {{-- CURRENT WEATHER --}}
    @if ($weather)
        <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-4 rounded-xl shadow-lg space-y-1 text-sm">
            <p class="font-bold text-lg">{{ $weatherIcon }} {{ $weatherText }}</p>
            <p class="text-gray-700 flex items-center gap-1"><x-heroicon-o-map-pin class="h-5"/>{{ $city }}</p>
            <p class="text-gray-700 flex items-center gap-1"><x-heroicon-o-eye-dropper class="h-5"/>{{ $weather['temperature'] }}°C</p>
            <p class="text-gray-700 flex items-center gap-1"><x-heroicon-o-paper-airplane class="h-5"/>{{ $weather['windspeed'] }} km/h</p>
            <p class="text-xs text-gray-500">Update {{ $lastUpdated }} WIB</p>
        </div>
    @endif

    {{-- FORECAST --}}
    @if ($forecast)
        <div class="grid grid-cols-3 gap-2 text-xs">
            @foreach ($forecast['time'] as $i => $day)
                @php
                    $code = $forecast['weathercode'][$i] ?? 0;
                    [$text, $icon] = match (true) {
                        $code === 0 => ['Cerah', '☀️'],
                        in_array($code, [1,2]) => ['Cerah Berawan','🌤'],
                        $code === 3 => ['Berawan','p'],
                        in_array($code, [45,48]) => ['Berkabut','🌫'],
                        in_array($code, [51,53,55]) => ['Gerimis','🌦'],
                        in_array($code, [61,63,65]) => ['Hujan','🌧'],
                        in_array($code, [71,73,75]) => ['Salju','❄️'],
                        in_array($code, [95,96,99]) => ['Badai','⛈'],
                        default => ['Tidak diketahui','❓'],
                    };
                @endphp
                <div class="bg-gradient-to-b from-blue-50 to-white border rounded-xl p-2 text-center shadow hover:scale-105 transform transition">
                    <p class="font-semibold">{{ \Carbon\Carbon::parse($day)->format('D, d M') }}</p>
                    <p class="text-xl">{{ $icon }}</p>
                    <p class="text-blue-500 font-bold">⬆ {{ $forecast['temperature_2m_max'][$i] }}°C</p>
                    <p class="text-blue-400">⬇ {{ $forecast['temperature_2m_min'][$i] }}°C</p>
                    <p class="text-gray-500 text-xs">{{ $text }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>