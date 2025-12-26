@auth
    @if(!auth()->user()->hasPremium())
        <div class="my-4 p-4 rounded-lg bg-yellow-100 border border-yellow-300">
            <p class="text-sm text-yellow-800 font-medium">
                📢 Iklan Sponsor
            </p>

            {{-- contoh iklan --}}
            <div class="mt-2">
                <a href="#" class="text-blue-600 underline">
                    Upgrade ke Premium — Bebas Iklan 🚀
                </a>
            </div>
        </div>
    @endif
@endauth

@guest
    <div class="my-4 p-4 rounded-lg bg-yellow-100 border border-yellow-300">
        <p class="text-sm text-yellow-800 font-medium">
            📢 Iklan Sponsor
        </p>

        <div class="mt-2">
            <a href="{{ route('login') }}" class="text-blue-600 underline">
                Login & Upgrade ke Premium 🚀
            </a>
        </div>
    </div>
@endguest
