@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-gray-700 mb-3']) }}>
    {{ $value ?? $slot }}
</label>
