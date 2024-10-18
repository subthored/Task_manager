@props(['messages'])

@if (!empty($messages))
    <span {{ $attributes->merge(['class' => 'text-red-600 space-y-1 mb-5 error-list block']) }} >{{ $messages[0] }}</span>
@endif
