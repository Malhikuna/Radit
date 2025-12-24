{{-- resources/views/components/community-icon.blade.php --}}
@props([
    'community',
    'size' => 32,
])

@php
    $initial = strtoupper(substr($community->name, 0, 1));

    // pseudo-random gradient based on community name
    $gradients = [
        'from-purle-500 to-purple-400',
        'from-purple-400 to-amber-400',
        'from-amber-500 to-purple-500',
        'from-purple-500 to-yellow-400',
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
                   ring-2 ring-purple-400/60
                   shadow-sm"
        >
    @else
        <div
             class="w-full h-full rounded-full
                   bg-purple-600
                   text-white font-bold
                   flex items-center justify-center
                   ring-2 ring-purple-900
                   shadow-sm select-none"
            style="font-size: {{ $size / 2.2 }}px"
        >
            {{ $initial }}
        </div>
    @endif
</div>
