<div class="cursor-pointer">
    @if ($user->avatar)
    <img
        src="{{ asset('storage/' . $user->avatar) }}"
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full object-cover border-4 border-yellow-400">
    @else
    <div
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full bg-blue-600 text-white flex items-center justify-center font-semibold border-4 border-yellow-400">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
    @endif
</div>