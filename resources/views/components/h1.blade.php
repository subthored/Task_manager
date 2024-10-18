@props(['value'])

<h1 {{ $attributes->merge(
    ['class' => 'max-w-2xl mb-6 mt-10 text-5xl leading-none tracking-tight']) }}>
    {{$value ?? $slot}}
</h1>
