<div class="cursor-pointer">
    @if ($user->avatar)
    <img
        src="{{ asset('storage/' . $user->avatar) }}"
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full object-cover border-4 border-purple-400"
    >
@else
    <div
        style="width: {{ $size }}px; height: {{ $size }}px"
        class="rounded-full bg-purple-600 text-purple flex items-center justify-center font-semibold border-4 border-purple-600"
    >
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>
    @endif
</div>