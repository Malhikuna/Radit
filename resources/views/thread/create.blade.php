@extends('components.layout')

@section('title', 'Home')

@section('content')

    <div class="w-full px-10 py-8">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Create post</h1>
    </div>

    <!-- Select Community -->
    <div class="mb-6">
        <button class="border border-gray-300 rounded-lg px-4 py-2 flex items-center gap-2 hover:bg-gray-100">
            <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" class="w-5 h-5 opacity-70" />
            <span class="text-sm font-medium">Select a community</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>

    <!-- Tabs -->
    <div class="flex gap-6 border-b pb-2 text-sm mb-5">
        <button class="font-medium border-b-2 border-blue-600 pb-2 text-blue-600">Text</button>
        <button class="text-gray-600 hover:text-gray-800">Images & Video</button>
        <button class="text-gray-600 hover:text-gray-800">Link</button>
        <button class="text-gray-600 hover:text-gray-800">Poll</button>
    </div>

    <!-- Title Input -->
    <div class="mb-4">
        <input 
            type="text" 
            placeholder="Title*" 
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
        />
        <div class="text-right text-xs text-gray-500 mt-1">1/300</div>
    </div>

    <!-- Add Tags -->
    <div class="mb-4">
        <div class="text-sm text-gray-600 mb-2">Add tags</div>
        <input 
            type="text"
            placeholder="+ Add tags"
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
        />
    </div>

    <!-- Body Editor -->
    <div class="border border-gray-300 rounded-lg overflow-hidden">
        
        <!-- Toolbar -->
        <div class="flex items-center gap-3 px-3 py-2 border-b bg-gray-50 text-gray-600 text-sm">

            <button class="hover:text-black font-semibold">B</button>
            <button class="italic hover:text-black">I</button>
            <button class="hover:text-black">•</button>
            <button class="hover:text-black">≡</button>

            <button class="hover:text-black">T</button>
            <button class="hover:text-black">|</button>
            <button class="hover:text-black">O</button>
            <button class="hover:text-black">[]</button>
            <button class="hover:text-black">&lt;/&gt;</button>
            <button class="hover:text-black">""</button>
        </div>

        <!-- Textarea -->
        <textarea 
            placeholder="Body text (optional)"
            class="w-full h-40 px-4 py-3 focus:outline-none resize-none"
        ></textarea>
    </div>

    <!-- Buttons -->
    <div class="flex justify-end mt-4 gap-3">
        <button class="px-5 py-2 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-50">
            Save Draft
        </button>
        <button class="px-6 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700">
            Post
        </button>
    </div>

</div>


@endsection
