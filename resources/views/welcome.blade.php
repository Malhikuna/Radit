@extends('components.layout')

@section('title', 'Home')

@section('content')

    <div class="flex gap-4 mb-4">
        <span class="px-3 py-1 bg-yellow-200 rounded-full text-sm">🆕 New</span>
        <span class="px-3 py-1 bg-orange-200 rounded-full text-sm">🔥 Best</span>
    </div>

    {{-- POST 1 --}}
    @include('components.card', [
        'author' => 'Traveller',
        'time' => '5 hours ago',
        'title' => 'Cinta Ala Wifi',
        'content' => "Kau seperti Wifi tetangga,\nkuharap gratis, ternyata pakai password.\nKau bilang aku spesial,\ntapi ternyata semua orang juga kau bilang begitu di kolom komentar.\n\nAku rela menunggu sinyal cintamu,\nmeski kadang cuma buffering.\nKau bilang hubungan kita stabil,\npadahal tiap malam kau reconnect dengan yang lain.",
        'likes' => 50,
        'comments' => 7
    ])

    {{-- POST 2 --}}
    @include('components.card', [
        'author' => 'Jomokers',
        'time' => '3 hours ago',
        'title' => 'Viral!!',
        'image' => 'https://i.ibb.co/M2XkdnM/meme-jomok.jpg',
        'likes' => 50,
        'comments' => 7
    ])

@endsection
