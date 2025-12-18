<div>
@php
    $initial = strtoupper(substr($community->name, 0, 1));
@endphp

@if ($community->icon)
    <img
        src="{{ asset('storage/' . $community->icon) }}"
        alt="{{ $community->name }}"
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full object-cover"
    >
@else
    <div
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full bg-gray-200 text-gray-700 flex items-center justify-center font-semibold"
    >
        {{ $initial }}
    </div>
@endif
</div>