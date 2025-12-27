@php
    $user = auth()->user();
@endphp

@if(!$user || !$user->hasPremium())
    <div class="my-4 p-4 rounded-lg bg-yellow-100 border border-yellow-300">
        <p class="flex gap-2 text-sm font-semibold text-yellow-800">
            <x-lucide-megaphone class="w-4 y-4" /> 
            Iklan Sponsor
        </p>

        <div class="mt-2 text-sm">
            <a href="#" class="text-blue-600 underline">
                Upgrade ke Premium — Bebas Iklan
            </a>
        </div>
    </div>
@endif
