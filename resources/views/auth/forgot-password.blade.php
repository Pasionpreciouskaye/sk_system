@extends('layouts.welcome')
@section('content')
<div class="flex items-center justify-center min-h-screen ml-5 mr-5">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <img class="w-30 mx-auto block" src="{{ asset('images/logo/sk-logo.png') }}" alt="">
        <h2 class="text-2xl font-bold mb-2 text-center text-gray-800">Barangay Lower Bicutan SK Portal</h2>
        <p class="mb-4 text-center text-gray-600 text-sm">
            Enter your registered email address and we'll send you instructions to reset your password.
        </p>
        @include('components.alert')
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-700"
                    required>
            </div>
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-pink-600 text-white py-2 rounded-md hover:bg-pink-700 border border-pink-700 transition-colors">
                    Send Reset Link
                </button>
            </div>
            <div class="text-center">
                <a href="{{ route('login') }}" class="inline-block text-sm text-pink-600 hover:underline transition">
                    &larr; Back to login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection