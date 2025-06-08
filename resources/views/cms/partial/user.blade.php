<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
        <input type="text" name="first_name" id="first_name" required
            value="{{ old('first_name', $record->first_name ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle Name</label>
        <input type="text" name="middle_name" id="middle_name"
            value="{{ old('first_name', $record->first_name ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
        <input type="text" name="last_name" id="last_name" required
            value="{{ old('first_name', $record->last_name ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" required value="{{ old('first_name', $record->email ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="contact_number" class="block text-sm font-medium text-gray-700">Contact Number</label>
        <input type="text" name="contact_number" id="contact_number" required
            value="{{ old('first_name', $record->contact_number ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
        <input type="date" name="date_of_birth" id="date_of_birth"
            value="{{ old('first_name', $record->date_of_birth ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
        <select name="gender" id="gender" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
            <option value="" disabled {{ old('gender', $record->gender ?? '') == '' ? 'selected' : '' }}>Choose gender
            </option>
            <option value="male" {{ old('gender', $record->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $record->gender ?? '') == 'female' ? 'selected' : '' }}>Female
            </option>
        </select>
    </div>
    <div>
        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
        <input type="text" name="address" id="address" required value="{{ old('first_name', $record->address ?? '') }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-pink-500 focus:border-pink-500">
    </div>
</div>
