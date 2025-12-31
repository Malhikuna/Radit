@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-red-50">
    <div class="bg-white w-[360px] p-8 rounded-xl border border-gray-300 shadow-sm text-center">
        <h1 class="text-2xl font-bold text-red-700 mb-4">Pembayaran Gagal!</h1>
        <p class="mb-6">Terjadi kesalahan saat memproses pembayaran Anda. Silakan coba lagi.</p>
        <a href="{{ route('premium.buys') }}" class="w-full block py-2 px-4 bg-red-600 text-white rounded-full hover:bg-red-700 transition">Coba Lagi</a>
    </div>
</div>
@endsection
