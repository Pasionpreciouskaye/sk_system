@extends('layouts.welcome')
@section('content')
<div class="flex items-center justify-center min-h-screen px-5">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <img class="w-28 mx-auto mb-4" src="{{ asset('images/logo/sk-logo.png') }}" alt="SK Logo">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-1">Reset Your Password</h2>
        <p class="text-center text-sm text-gray-600 mb-4">
            Enter your new password below to regain access to your account.
        </p>

        @include('components.alert')

        <form action="{{ route('password.update') }}" method="POST" x-data="{ show: false, showConfirm: false }">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            {{-- Password --}}
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" id="password" name="password" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600">
                        <svg x-show="!show" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="show" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.543-7a9.956 9.956 0 012.028-3.341m2.385-2.392A9.957 9.957 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.97 9.97 0 01-4.178 5.17" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                    Password</label>
                <div class="relative">
                    <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation"
                        name="password_confirmation" required
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                    <button type="button" @click="showConfirm = !showConfirm"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600">
                        <svg x-show="!showConfirm" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg x-show="showConfirm" x-cloak class="h-5 w-5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.543-7a9.956 9.956 0 012.028-3.341m2.385-2.392A9.957 9.957 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.97 9.97 0 01-4.178 5.17" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-pink-600 text-white py-2 rounded-md hover:bg-pink-700 transition">
                    Reset Password
                </button>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-pink-600 hover:underline transition">
                    &larr; Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection