<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <x-form.input name="first_name" label="First Name" :value="old('first_name', $record->first_name ?? '')" />
    <x-form.input name="last_name" label="Last Name" :value="old('last_name', $record->last_name ?? '')" />
    <x-form.input name="middle_name" label="Middle Name" :value="old('middle_name', $record->middle_name ?? '')" />
    <x-form.input name="email" label="Email" type="email" :value="old('email', $record->email ?? '')" />
    <x-form.input name="contact_number" label="Contact Number" :value="old('contact_number', $record->contact_number ?? '')" />
    <x-form.input name="password" label="Password" type="password" />
    <x-form.input name="password_confirmation" label="Confirm Password" type="password" />
    <x-form.input name="date_of_birth" label="Date of Birth" type="date" :value="old('date_of_birth', $record->date_of_birth ?? '')" />
    <x-form.select name="gender" label="Gender" :options="['Male' => 'Male', 'Female' => 'Female']" :selected="old('gender', $record->gender ?? '')" />
    <x-form.input name="address" label="Address" :value="old('address', $record->address ?? '')" />
    <div>
        <label class="block text-sm font-medium mb-1" style="color:var(--color-text-secondary)">Role</label>
        <select name="role"
            class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2"
            style="background:var(--color-base);color:var(--color-text-primary);border-color:var(--color-border);">
            @foreach(\App\Models\User::ROLE_PERMISSIONS as $role => $perms)
                <option value="{{ $role }}" {{ old('role', $record->role ?? 'member') === $role ? 'selected' : '' }}>
                    {{ ucwords(str_replace('_', ' ', $role)) }}
                </option>
            @endforeach
        </select>
    </div>
</div>
