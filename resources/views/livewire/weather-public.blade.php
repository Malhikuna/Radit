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
            class="bg-[#6395ee] text-white px-4 py-2 rounded-lg shadow hover:bg-[#4b6eab] transition flex-shrink-0 flex">
            <x-lucide-search class="w-5"/>
    </button>
    </div>

    {{-- Tombol Favorit --}}
    <div class="flex justify-end">
        <button wire:click="addFavorite"
        class="bg-[#9966CC] text-white px-3 py-2 rounded-lg shadow hover:bg-[#7A49A6] transition flex-shrink-0 flex">
        <x-lucide-star class="w-5 flex"/>
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
            <p class="text-gray-700 flex items-center gap-1"><x-lucide-map-pin class="w-5"/>{{ $city }}</p>
            <p class="text-gray-700 flex items-center gap-1"><x-lucide-thermometer class="w-5"/>{{ $weather['temperature'] }}°C</p>
            <p class="text-gray-700 flex items-center gap-1"><x-lucide-wind class="w-5"/>{{ $weather['windspeed'] }} km/h</p>
            <p class="text-xs text-gray-500">Update {{ $lastUpdated }} WIB</p>
        </div>
    @endif

    {{-- FORECAST --}}
   @if ($forecast)
    <div class="grid grid-cols-3 gap-2 text-xs">
        @foreach ($forecast['time'] as $i => $day)
            @php
                $code = $forecast['weathercode'][$i] ?? 0;

                $type = match (true) {
                    $code === 0 => 'sun',
                    in_array($code, [1,2]) => 'sun-cloud',
                    $code === 3 => 'cloud',
                    in_array($code, [45,48]) => 'fog',
                    in_array($code, [51,53,55]) => 'drizzle',
                    in_array($code, [61,63,65]) => 'rain',
                    in_array($code, [71,73,75]) => 'snow',
                    in_array($code, [95,96,99]) => 'storm',
                    default => 'unknown',
                };

                $text = match ($type) {
                    'sun' => 'Cerah',
                    'sun-cloud' => 'Cerah Berawan',
                    'cloud' => 'Berawan',
                    'fog' => 'Berkabut',
                    'drizzle' => 'Gerimis',
                    'rain' => 'Hujan',
                    'snow' => 'Salju',
                    'storm' => 'Badai',
                    default => 'Tidak diketahui',
                };
            @endphp

            <div class="bg-gradient-to-b from-blue-50 to-white border rounded-xl p-2 text-center shadow hover:scale-105 transition">

                <p class="font-semibold">
                    {{ \Carbon\Carbon::parse($day)->format('D, d M') }}
                </p>

                {{-- ICON LUCIDE --}}
                <div class="flex justify-center my-1">
                    @switch($type)
                        @case('sun')
                            <x-lucide-sun class="w-6 h-6 text-yellow-500"/>
                            @break

                        @case('sun-cloud')
                            <x-lucide-cloud-sun class="w-6 h-6 text-yellow-400"/>
                            @break

                        @case('cloud')
                            <x-lucide-cloud class="w-6 h-6 text-gray-500"/>
                            @break

                        @case('fog')
                            <x-lucide-cloud-fog class="w-6 h-6 text-gray-400"/>
                            @break

                        @case('drizzle')
                            <x-lucide-cloud-drizzle class="w-6 h-6 text-blue-400"/>
                            @break

                        @case('rain')
                            <x-lucide-cloud-rain class="w-6 h-6 text-blue-500"/>
                            @break

                        @case('snow')
                            <x-lucide-cloud-snow class="w-6 h-6 text-sky-300"/>
                            @break

                        @case('storm')
                            <x-lucide-cloud-lightning class="w-6 h-6 text-purple-500"/>
                            @break

                        @default
                            <x-lucide-help-circle class="w-6 h-6 text-gray-400"/>
                    @endswitch
                </div>

                <p class="text-blue-500 font-bold">
                    ⬆ {{ $forecast['temperature_2m_max'][$i] }}°C
                </p>

                <p class="text-blue-400">
                    ⬇ {{ $forecast['temperature_2m_min'][$i] }}°C
                </p>

                <p class="text-gray-500 text-xs">
                    {{ $text }}
                </p>
            </div>
        @endforeach
    </div>
@endif
</div>