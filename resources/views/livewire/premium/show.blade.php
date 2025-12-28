<div class="min-h-screen bg-[#FAF7F5]">

    {{-- NAVBAR --}}
    <header class="bg-white shadow-sm relative z-20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <h1 class="text-xl font-extrabold bg-gradient-to-r from-[#007BA7] to-[#00B4D8] bg-clip-text text-transparent">
                Radit<span class="text-sm align-super font-bold">+</span>
            </h1>

            <a href="{{ route('home') ?? '#' }}"
               class="text-sm font-medium text-gray-600 hover:text-black transition">
                Kembali
            </a>
        </div>
    </header>

    {{-- HERO --}}
    <section
        class="relative min-h-[calc(100vh-64px)]
               w-full overflow-hidden
               bg-gradient-to-r from-[#06799B] via-[#0A87A8] to-[#0A7F9F]
               text-white flex items-center">

        <!-- SOFT OVERLAY (HALUS, SESUAI FOTO) -->
        <div class="absolute inset-0 bg-gradient-to-b from-white/5 to-black/10"></div>

        <!-- FULL WIDTH WRAPPER -->
        <div class="relative z-10 w-full py-24">
            <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

                {{-- TEXT --}}
                <div>
                    <!-- RADIT+ PREMIUM BADGE -->
                    <span
                        class="inline-flex items-center gap-3 mb-7 px-6 py-2.5
                               rounded-full bg-white/20 backdrop-blur-md
                               ring-1 ring-white/20
                               shadow-lg shadow-[#7CFFB2]/30">

                        <span
                            class="text-base md:text-lg font-extrabold
                                   bg-gradient-to-r from-[#7CFFB2] via-[#5BC0EB] to-[#00E5FF]
                                   bg-clip-text text-transparent
                                   drop-shadow-[0_0_8px_rgba(124,255,178,0.6)]">
                            Radit+
                        </span>

                        <span
                            class="text-sm md:text-base font-bold uppercase tracking-widest text-white/90">
                            Premium
                        </span>
                    </span>

                    <h2 class="text-4xl md:text-5xl font-extrabold mb-6 leading-tight">
                        Pengalaman Lebih
                        <br class="hidden md:block">
                        Nyaman & Modern
                    </h2>

                    <p class="text-lg text-white/80 mb-10 max-w-xl">
                        Akses premium tanpa iklan dengan performa lebih cepat
                        dan tampilan bersih yang nyaman di mata.
                    </p>

                    <div class="flex flex-wrap gap-5">
                        <button
                            class="px-8 py-3 bg-white text-[#06799B]
                                   font-semibold rounded-full shadow
                                   hover:bg-white/90 transition">
                            Rp 79.000 / Bulan
                        </button>

                        <div>
                            <button
                                class="px-8 py-3 bg-black text-white
                                       font-semibold rounded-full shadow-lg
                                       hover:bg-black/90 transition">
                                Rp 799.000 / Tahun
                            </button>
                            <p class="text-sm text-[#7CFFB2] mt-2 text-center">
                                Hemat 2 bulan
                            </p>
                        </div>
                    </div>
                </div>

                {{-- VISUAL --}}
                <div class="flex justify-center">
                    <div
                        class="relative w-80 h-80 rounded-3xl
                               bg-white/10 backdrop-blur-xl
                               flex items-center justify-center
                               shadow-2xl ring-1 ring-white/20">

                        <div
                            class="absolute inset-0 rounded-3xl
                                   bg-gradient-to-br from-white/20 to-transparent
                                   blur-xl">
                        </div>

                        <span
                            class="relative text-6xl font-extrabold
                                   bg-gradient-to-br from-white to-white/70
                                   bg-clip-text text-transparent">
                            R<span class="text-2xl align-super">+</span>
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- BENEFITS --}}
    <section class="max-w-7xl mx-auto px-6 py-20">
        <h3 class="text-3xl font-bold text-center mb-14">
            Keuntungan
            <span class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-400 relative z-10">
                Radit+
            </span>
        </h3>

        <div class="grid md:grid-cols-3 gap-10">
            @foreach ([
                'Tanpa Iklan' => 'Pengalaman fokus tanpa gangguan.',
                'Fitur Eksklusif' => 'Akses fitur khusus premium.',
                'Lebih Ringan' => 'Performa cepat & stabil.'
            ] as $title => $desc)
                <div
                    class="bg-white p-8 rounded-2xl shadow-md
                           hover:shadow-xl hover:-translate-y-1 transition">
                    <h4 class="text-lg font-semibold mb-3 text-[#007BA7]">
                        {{ $title }}
                    </h4>
                    <p class="text-gray-600">{{ $desc }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-[#0B1220] text-gray-400 py-10 text-sm">
        <div class="max-w-7xl mx-auto px-6
                    flex flex-col md:flex-row justify-between gap-6">
            <p>© 2025 Radit+. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition">Tentang</a>
                <a href="#" class="hover:text-white transition">Bantuan</a>
                <a href="#" class="hover:text-white transition">Kebijakan</a>
            </div>
        </div>
    </footer>

</div>
