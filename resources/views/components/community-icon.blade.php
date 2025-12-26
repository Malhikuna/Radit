@props([
    'community',
    'size' => 32,
])

@php
    $seed = urlencode($community->name);

    // style avatar kartun
    $style = 'adventurer';

    $avatarUrl = "https://api.dicebear.com/7.x/{$style}/svg?seed={$seed}";
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
        <img
            src="{{ $avatarUrl }}"
            alt="{{ $community->name }}"
            class="w-full h-full rounded-full
                   ring-2 ring-purple-400/60
                   bg-white shadow-sm"
        >
    @endif
</div>
