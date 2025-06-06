@extends('layouts.dashboard')

@section('content')
@include('components.alert')
<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white border border-gray-200 rounded-xl shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-6">User Profile</h2>
        <form action="{{ route('profile.update', auth()->user()) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                        First Name
                    </label>
                    <input type="text" name="first_name" id="first_name"
                        value="{{ old('first_name', auth()->user()->first_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500"
                        required />
                </div>
                <div>
                    <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Middle Name
                    </label>
                    <input type="text" name="middle_name" id="middle_name"
                        value="{{ old('middle_name', auth()->user()->middle_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500" />
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Last Name
                    </label>
                    <input type="text" name="last_name" id="last_name"
                        value="{{ old('last_name', auth()->user()->last_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500"
                        required />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500"
                        required />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Contact Number
                    </label>
                    <input type="text" name="contact_number" id="contact_number"
                        value="{{ old('contact_number', auth()->user()->contact_number) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500" />
                </div>
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-1">
                        Date of Birth
                    </label>
                    <input type="date" name="date_of_birth" id="date_of_birth"
                        value="{{ old('date_of_birth', auth()->user()->date_of_birth) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500" />
                </div>
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">
                        Gender
                    </label>
                    <select name="gender" id="gender"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
                        <option value="">Choose...</option>
                        <option value="male" {{ old('gender', auth()->user()->gender) === 'male' ? 'selected' : '' }}>
                            Male</option>
                        <option value="female"
                            {{ old('gender', auth()->user()->gender) === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                        Address
                    </label>
                    <textarea name="address" id="address" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">{{ old('address', auth()->user()->address) }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        New Password
                    </label>
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500" />
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirm Password
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="••••••••"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500" />
                </div>
            </div>

            <div class="pt-4 border-t border-gray-200">
                <button type="submit"
                    class="w-full px-6 py-3 bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-colors">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
