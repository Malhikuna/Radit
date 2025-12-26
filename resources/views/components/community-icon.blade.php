{{-- resources/views/components/community-icon.blade.php --}}
@props([
    'community',
    'size' => 32,
])

@php
    $initial = strtoupper(substr($community->name, 0, 1));

    // pseudo-random gradient based on community name
    $gradients = [
        'from-orange-500 to-orange-400',
        'from-orange-400 to-amber-400',
        'from-amber-500 to-orange-500',
        'from-orange-500 to-yellow-400',
    ];

    $gradient = $gradients[crc32($community->name) % count($gradients)];
@endphp

<div
    style="width: {{ $size }}px; height: {{ $size }}px"
    class="relative shrink-0"
>
    @if ($community->icon)
        <img
            src="{{ asset('storage/' . $community->icon) }}"
            alt="{{ $community->name }}"
            class="w-full h-full rounded-full object-cover
                   ring-2 ring-orange-400/60
                   shadow-sm"
        >
    @else
        <div
            class="w-full h-full rounded-full
                   bg-[#9966CC]
                   text-white font-bold
                   flex items-center justify-center
                   ring-2 ring-[#7A49A6]
                   shadow-sm select-none"
            style="font-size: {{ $size / 2.2 }}px"
        >
            {{ $initial }}
        </div>
    @endif
</div>