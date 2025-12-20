@extends('components.layouts.auth')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white w-[360px] p-8 rounded-xl border shadow-sm">

        {{-- Logo --}}
        <div class="flex flex-col items-center mb-6">
            <img src="https://cdn-icons-png.flaticon.com/512/888/888879.png"
                 class="w-16 mb-2" alt="logo">
            <span class="text-orange-500 font-bold text-xl">ENABLE 404</span>
        </div>

        {{-- Form Login --}}
        <form>
            <div class="mb-4">
                <input
                    type="text"
                    placeholder="Email or Username *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none">
            </div>

            <div class="mb-2 relative">
                <input
                    type="password"
                    placeholder="Password *"
                    class="w-full px-4 py-2 border rounded-full focus:outline-none"
                >
            </div>


            <p
                class="text-sm font-semibold mb-4 text-blue-400 cursor-pointer hover:text-blue-700 transition-colors">
                Lupa Password
            </p>
            <button
                type="submit"
                class="w-full border rounded-full py-2 font-bold hover:bg-gray-100">
                Login
            </button>
            <br>
            <br>
            <p class="text-center">
                Don't have an account? <a href="" class="font-bold text-blue-400 cursor-pointer hover:text-blue-700 transition-colors">Register now</a> 
            </p>
        </form>

    </div>

</div>
@endsection

