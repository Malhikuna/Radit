<nav class="fixed top-0 left-0 right-0 h-20 bg-white ring ring-gray-200 z-50">
    <div class="max-w-7xl mx-auto h-full flex items-center gap-6 px-6">

        {{-- LOGO --}}
        <a  
            href="{{ route('home') }}"
            class="flex items-center gap-2 font-bold text-purple-600 text-xl">
            <img src="{{ asset('storage/icon/logo.png') }}" alt="Logo" class="h-14 -mx-7">
            RADIT
        </a>

        {{-- SEARCH --}}
        <form action="{{ route('search') }}" method="GET" class="flex-1">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari disini..."
                class="w-full bg-gray-100 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500"
            >
        </form>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">

            @auth
                {{-- NOTIFICATION ICON --}}
                <a 
                    href="/"
                    class="flex items-center gap-3 px-2 py-2 rounded-full font-medium text-gray-700 hover:bg-gray-100 hover:text-purple-600">
                    <x-heroicon-o-bell class="w-6 h-6" />
                </a>
                
                {{-- CREATE POST --}}
                <a  
                    href="{{ route('posts.create') }}"
                    class="flex gap-2 items-center px-3 py-1 rounded-full bg-purple-600 text-white font-semibold hover:bg-purple-700 transition">
                    <x-heroicon-o-plus-circle class="w-5 h-5" />
                    Create
                </a>

                {{-- UPGRADE PREMIUM --}}
<button id="pay-premium">Upgrade Premium</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
document.getElementById('pay-premium').addEventListener('click', async () => {
    const res = await fetch('/premium/pay', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    });

    const data = await res.json();

    if (!data.token) {
        alert('Terjadi kesalahan saat membuat pembayaran.');
        return;
    }

    snap.pay(data.token, {
        onSuccess: function () {
            window.location.href = '/checkout/success';
        },
        onPending: function () {
            window.location.href = '/checkout/unfinish';
        },
        onError: function () {
            window.location.href = '/checkout/error';
        }
    });
});
</script>


                {{-- USER DROPDOWN --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="w-8 h-8 rounded-full bg-purple-500 text-white flex items-center justify-center font-bold cursor-pointer hover:outline-none hover:ring-4 hover:ring-purple-600 hover:border-purple-600">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>

                    <div 
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">

                       <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Profile
                        </a>

                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Settings
                        </a>

                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">
                            Dark Mode
                        </a>

                        <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 text-blue-400">
                            Radit+
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 text-red-600">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <a 
                    href="{{ route('login') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-purple-600">
                    Login
                </a>

                <a 
                    href="{{ route('register') }}"
                    class="px-4 py-2 rounded-full border font-semibold hover:bg-gray-100">
                    Register
                </a>
            @endguest

        </div>
    </div>
</nav>