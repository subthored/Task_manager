@extends('layouts.app')

@section('content')
    <h2 class="my-8 text-3xl text-white">{{__('Просмотр задачи')}}: {{ $task->name }}
        @auth
            <a href="{{ route('tasks.edit', $task->id) }}">⚙</a>
        @endauth
    </h2>
    <p class="text-white"><span class="font-bold">{{__('Имя')}}: </span>{{ $task->name }}</p>
    <p class="text-white"><span class="font-bold">{{__('Статус')}}: </span>{{ $task->status_name }}</p>
    <p class="text-white"><span class="font-bold">{{__('Описание')}}: </span>{{ $task->description }}</p>
    <p class="text-white"><span class="font-bold">{{ __('Метки') }}: </span></p>
    <div>
        @foreach($task->labels as $label)
            <span class="labelspan">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                {{ $label->name }}</span>

        @endforeach
    </div>
@endsection
