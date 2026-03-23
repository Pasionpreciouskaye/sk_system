<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @php
        $inputClass =
            'mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-[#2A3B55] rounded-md bg-white dark:bg-[#162338] text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-[#E91E63] focus:border-[#E91E63] transition-all duration-200';
        $labelClass = 'block text-sm font-medium text-gray-700 dark:text-gray-300';
    @endphp

    <div>
        <label for="first_name" class="{{ $labelClass }}">First Name</label>
        <input type="text" name="first_name" id="first_name" required
            value="{{ old('first_name', $record->first_name ?? '') }}" class="{{ $inputClass }}">
    </div>
    <div>
        <label for="middle_name" class="{{ $labelClass }}">Middle Name</label>
        <input type="text" name="middle_name" id="middle_name"
            value="{{ old('middle_name', $record->middle_name ?? '') }}" class="{{ $inputClass }}">
    </div>
    <div>
        <label for="last_name" class="{{ $labelClass }}">Last Name</label>
        <input type="text" name="last_name" id="last_name" required
            value="{{ old('last_name', $record->last_name ?? '') }}" class="{{ $inputClass }}">
    </div>
    <div>
        <label for="email" class="{{ $labelClass }}">Email</label>
        <input type="email" name="email" id="email" required value="{{ old('email', $record->email ?? '') }}"
            class="{{ $inputClass }}">
    </div>
    <div>
        <label for="contact_number" class="{{ $labelClass }}">Contact Number</label>
        <input type="text" name="contact_number" id="contact_number" required
            value="{{ old('contact_number', $record->contact_number ?? '') }}" class="{{ $inputClass }}">
    </div>
    <div>
        <label for="date_of_birth" class="{{ $labelClass }}">Date of Birth</label>
        <input type="date" name="date_of_birth" id="date_of_birth"
            value="{{ old('date_of_birth', $record->date_of_birth ?? '') }}" class="{{ $inputClass }}">
    </div>
    <div>
        <label for="gender" class="{{ $labelClass }}">Gender</label>
        <select name="gender" id="gender" required class="{{ $inputClass }}">
            <option value="" disabled {{ old('gender', $record->gender ?? '') == '' ? 'selected' : '' }}>Choose
                gender</option>
            <option value="male" {{ old('gender', $record->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $record->gender ?? '') == 'female' ? 'selected' : '' }}>Female
            </option>
        </select>
    </div>
    <div>
        <label for="address" class="{{ $labelClass }}">Address</label>
        <input type="text" name="address" id="address" required
            value="{{ old('address', $record->address ?? '') }}" class="{{ $inputClass }}">
    </div>
    <div>
        <label for="password" class="{{ $labelClass }}">Password</label>
        <input type="password" name="password" id="password" class="{{ $inputClass }}">
    </div>
    <div>
        <label for="password_confirmation" class="{{ $labelClass }}">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="{{ $inputClass }}">
    </div>
</div>
