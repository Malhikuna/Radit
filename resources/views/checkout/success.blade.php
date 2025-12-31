@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-green-50">
    <div class="bg-white w-[360px] p-8 rounded-xl border border-gray-300 shadow-sm text-center">
        <h1 class="text-2xl font-bold text-green-700 mb-4">Pembayaran Berhasil!</h1>
        <p class="mb-6">Terima kasih, akun premium Anda sudah aktif.</p>
        <a href="{{ route('home') }}" class="w-full block py-2 px-4 bg-green-600 text-white rounded-full hover:bg-green-700 transition">Kembali ke Home</a>
    </div>
</div>
@endsection
