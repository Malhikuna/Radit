<div class="cursor-pointer">
@php
    $seed = urlencode($user->name);
    $style = 'avataaars'; 
    // alternatif: adventurer | bottts | lorelei | fun-emoji

    $avatarUrl = "https://api.dicebear.com/7.x/{$style}/svg?seed={$seed}";
@endphp

@if ($user->avatar)
    <img
        src="{{ asset('storage/' . $user->avatar) }}"
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full object-cover
               border-4 border-purple-400"
    >
@else
    <img
        src="{{ $avatarUrl }}"
        alt="{{ $user->name }}"
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full
               border-4 border-purple-400
               bg-white object-cover"
    >
@endif
</div>
