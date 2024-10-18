@props(['method', 'route', 'confirm' => null, 'type'=>null])

<a rel="nofollow"
   data-method="{{ $method }}"
   href="{{ $route }}"
   type="{{ $type }}"
   @if($confirm) data-confirm="{{ $confirm }}" @endif
    {{ $attributes->merge(['class' => 'btn-primary']) }}
>{{ $slot }}</a>
