@props(['item', 'route', 'name'])

@php
    $styles = [
        'delete' => [
            'class' => 'text-red-600 mr-4',
            'confirm' => 'Вы уверены?',
            'method' => 'delete',
            'text' => 'Delete',
        ],
        'update' => [
            'class' => 'text-blue-600',
            'method' => 'get',
            'text' => 'Change',
        ],
    ];
@endphp

@can($name, $item)
    <a {{ $attributes->merge(['class' => $styles[$name]['class']]) }}
       href="{{ route($route, $item) }}"
       @isset($styles[$name]['confirm'])
           data-confirm="{{ $styles[$name]['confirm'] }}"
       @endisset
       data-method="{{ $styles[$name]['method']}}"
       rel="nofollow">
        {{ __($styles[$name]['text'] ) }}
    </a>
@endcan
