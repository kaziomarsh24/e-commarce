@extends('layouts.app')

@section('title', 'Admin Sign In — Bangla Puzzle')

@section('content')
<div class="max-w-md mx-auto py-16 px-4 space-y-6">

    <!-- Header -->
    <div class="text-center space-y-2">
        <h1 class="text-2xl font-bold text-dark">Admin Portal Sign In</h1>
        <p class="text-xs text-dark-3">Enter your credentials to manage products and categories</p>
    </div>

    <!-- Auth Card -->
    <div class="bg-white rounded-2xl border border-gray-3 p-8 shadow-xs space-y-6">

        @if(session('error'))
            <div class="p-3.5 rounded-lg bg-red/10 border border-red/20 text-red text-xs font-semibold">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-xs font-semibold text-dark mb-1.5">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="admin@banglapuzzle.com"
                    class="w-full bg-white border border-gray-3 rounded-lg px-3.5 py-2.5 text-xs text-dark focus:outline-none focus:border-blue transition @error('email') border-red @enderror"
                >
                @error('email')
                    <p class="text-[11px] text-red mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-xs font-semibold text-dark mb-1.5">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="••••••••"
                    class="w-full bg-white border border-gray-3 rounded-lg px-3.5 py-2.5 text-xs text-dark focus:outline-none focus:border-blue transition @error('password') border-red @enderror"
                >
                @error('password')
                    <p class="text-[11px] text-red mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-3 text-blue focus:ring-0">
                    <span class="text-xs text-dark-3">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-2.5 px-4 rounded-lg bg-blue hover:bg-blue-dark text-white text-xs font-semibold transition shadow-xs flex items-center justify-center gap-2">
                <span>Sign In</span>
                <span>&rarr;</span>
            </button>
        </form>

        <!-- Demo Credentials Helper for Examiner -->
        <div class="pt-4 border-t border-gray-3">
            <div class="bg-gray-1 border border-gray-3 rounded-lg p-3 text-xs text-dark-3 space-y-1">
                <span class="font-semibold text-dark text-[11px] block uppercase tracking-wider">Demo Credentials</span>
                <div class="flex justify-between font-mono text-[11px]">
                    <span>Email:</span>
                    <span class="text-dark font-semibold">admin@banglapuzzle.com</span>
                </div>
                <div class="flex justify-between font-mono text-[11px]">
                    <span>Password:</span>
                    <span class="text-dark font-semibold">password</span>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
