@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 space-y-6">

    {{-- POST --}}
    <div class="bg-white border rounded-xl p-5">
        <div class="flex items-center gap-3 text-sm text-gray-500">
            <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
            <span class="font-semibold text-gray-800">
                u/{{ $post->user->name }}
            </span>
            <span>•</span>
            <span>{{ $post->created_at->diffForHumans() }}</span>
        </div>

        <h1 class="text-xl font-bold mt-3">
            {{ $post->title }}
        </h1>

        <p class="mt-2 text-gray-800 whitespace-pre-line">
            {{ $post->content }}
        </p>
    </div>

    {{-- COMMENTS --}}
    <livewire:community.comments :post="$post" />

</div>
@endsection
