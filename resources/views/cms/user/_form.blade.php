<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <x-form.input name="first_name" label="First Name" :value="old('first_name', $record->first_name ?? '')" />
    <x-form.input name="last_name" label="Last Name" :value="old('last_name', $record->last_name ?? '')" />
    <x-form.input name="middle_name" label="Middle Name" :value="old('middle_name', $record->middle_name ?? '')" />
    <x-form.input name="email" label="Email" type="email" :value="old('email', $record->email ?? '')" />
    <x-form.input name="contact_number" label="Contact Number" :value="old('contact_number', $record->contact_number ?? '')" />
    <x-form.input name="password" label="Password" type="password" />
    <x-form.input name="date_of_birth" label="Date of Birth" type="date" :value="old('date_of_birth', $record->date_of_birth ?? '')" />
    <x-form.select name="gender" label="Gender" :options="['Male' => 'Male', 'Female' => 'Female']" :selected="old('gender', $record->gender ?? '')" />
    <x-form.input name="address" label="Address" :value="old('address', $record->address ?? '')" />
</div>
