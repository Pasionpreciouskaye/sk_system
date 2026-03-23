@props([
    'name',
    'label' => '',
    'options' => [],
    'selected' => ''
])

<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}"
        {{ $attributes->merge(['class' => 'w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-pink-500']) }}>
        <option value="">-- Select --</option>
        @foreach ($options as $key => $option)
            <option value="{{ $key }}" {{ old($name, $selected) == $key ? 'selected' : '' }}>{{ $option }}</option>
        @endforeach
    </select>
</div>
