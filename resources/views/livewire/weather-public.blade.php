<div 
    class="max-w-sm space-y-4"
    wire:loading.class="pointer-events-none opacity-60"
    wire:target="getWeather"
>
    <div 
        wire:loading.flex 
        wire:target="getWeather" 
        class="absolute w-full h-full rounded-xl inset-0 z-50 bg-white/90 backdrop-blur-md flex items-center justify-center"
    >
        <img
            src="{{ asset('icon/logo.png') }}"
            alt="Logo"
            class="h-20 animate-logo-bounce-fade"
        />
    </div>

    {{-- INPUT + CARI --}}
    <div class="flex gap-2">
        <div class="flex items-center w-full bg-gray-100 rounded-full relative">
            <input
                type="text"
                wire:model.defer="city"
                wire:keydown.enter="getWeather"
                placeholder="Cari daerah..."
                class="flex-1 w-full bg-gray-100 dark:bg-gray-800 rounded-full border border-gray-200 dark:border-gray-500 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 dark:placeholder-gray-500 dark:text-gray-200"
            />
            <button 
                wire:click="getWeather"
                wire:loading.attr="disabled"
                wire:target="getWeather"
                class="cursor-pointer bg-[#6395ee] text-white px-2 py-2 rounded-full shadow
                        hover:bg-[#4b6eab] transition
                        disabled:opacity-50 disabled:cursor-not-allowed absolute right-1 t ">
                    <x-lucide-search class="w-4"
            />
        </div>
    </button>
    </div>

    {{-- Tombol Favorit --}}
    <div class="flex justify-end">
        <button wire:click="addFavorite"
        class="bg-[#9966CC] text-white px-3 py-2 rounded-lg shadow hover:bg-[#7A49A6] transition shrink-0 flex">
        <x-lucide-star class="w-5 flex text-[#FFEE8C]"/>
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

    {{-- ERROR --}}
    @if ($error)
        <p class="text-red-500 text-sm">{{ $error }}</p>
    @endif

    {{-- CURRENT WEATHER --}}
    @if ($weather)
    <div class="max-w-sm rounded-2xl p-5 shadow-xl
                bg-linear-to-b from-sky-100 via-blue-100 to-indigo-100">

        <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
            <x-lucide-map-pin class="w-4 h-4"/>
            <span>{{ $city }}</span>
        </div>

        <div class="flex items-center justify-between">
            <div>
                <p class="text-5xl font-bold text-gray-800">
                    {{ $weather['temperature'] }}°
                </p>
                <p class="text-gray-600 mt-1">
                    {{ $weatherText }}
                </p>
            </div>

            <div class="text-6xl">
                {{ $weatherIcon }}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3 mt-5 text-sm">
            <div class="bg-white/70 backdrop-blur rounded-xl p-3 shadow">
                <p class="text-gray-500 text-xs">Angin</p>
                <p class="font-semibold text-gray-800">
                    {{ $weather['windspeed'] }} km/h
                </p>
            </div>

            <div class="bg-white/70 backdrop-blur rounded-xl p-3 shadow">
                <p class="text-gray-500 text-xs">Update</p>
                <p class="font-semibold text-gray-800">
                    {{ $lastUpdated }} WIB
                </p>
            </div>
        </div>
    </div>
    @endif


    {{-- FORECAST --}}
    @if ($forecast)
    <div class="grid grid-cols-3 gap-3 mt-4">
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

            <div class="rounded-2xl p-3 text-center shadow-md
                        bg-white/70  dark:bg-gray-400 backdrop-blur
                        hover:shadow-xl hover:-translate-y-1 transition-all">

                <p class="text-xs font-semibold text-gray-700 dark:text-white">
                    {{ \Carbon\Carbon::parse($day)->format('D, d M') }}
                </p>

                <div class="flex justify-center my-3">
                    @switch($type)
                        @case('sun')
                            <x-lucide-sun class="w-8 h-8 text-yellow-500 dark:text-yellow-100"/>
                            @break
                        @case('sun-cloud')
                            <x-lucide-cloud-sun class="w-8 h-8 text-yellow-400"/>
                            @break
                        @case('cloud')
                            <x-lucide-cloud class="w-8 h-8 text-gray-500"/>
                            @break
                        @case('fog')
                            <x-lucide-cloud-fog class="w-8 h-8 text-gray-400"/>
                            @break
                        @case('drizzle')
                            <x-lucide-cloud-drizzle class="w-8 h-8 text-blue-400"/>
                            @break
                        @case('rain')
                            <x-lucide-cloud-rain class="w-8 h-8 text-blue-500"/>
                            @break
                        @case('snow')
                            <x-lucide-cloud-snow class="w-8 h-8 text-sky-300"/>
                            @break
                        @case('storm')
                            <x-lucide-cloud-lightning class="w-8 h-8 text-purple-500"/>
                            @break
                        @default
                            <x-lucide-help-circle class="w-8 h-8 text-gray-400"/>
                    @endswitch
                </div>

                <div class="flex justify-center gap-3 text-sm font-semibold">
                    <span class="text-blue-600 dark:text-blue-100">
                        ↑ {{ $forecast['temperature_2m_max'][$i] }}°
                    </span>
                    <span class="text-blue-400 dark:text-blue-200">
                        ↓ {{ $forecast['temperature_2m_min'][$i] }}°
                    </span>
                </div>

                <p class="mt-2 text-xs text-gray-500  dark:text-gray-200">
                    {{ $text }}
                </p>
            </div>
        @endforeach
    </div>
    @endif

</div>