@props([
    'name',
    'label' => '',
    'type' => 'text',
    'value' => '',
])

<div>
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-pink-500']) }}
    >
</div>
