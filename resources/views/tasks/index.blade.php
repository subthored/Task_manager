@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1 class="text-white">{{ __('Задачи') }}</x-h1>

        <div class="w-full flex justify-between">
            @include('tasks.filter-form')
            @auth
                <div class="flex">
                    <x-primary-a-button :route="route('tasks.create')" :method="'GET'">
                        {{__('Создать задачу')}}
                    </x-primary-a-button>
                </div>
            @endauth
        </div>

        @auth
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Статус'), __('Имя'), __('Автор'), __('Исполнитель'), __('Дата создания'), __('Действия')]"
                :items="$tasks"
                :routes="['update'=> 'tasks.edit', 'delete' => 'tasks.destroy']"
                :fields="['id', 'status_name', 'name', 'author_name', 'executor_name', 'created_at', 'action']">
            </x-table.table>
        @endauth
        @guest
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Статус'), __('Имя'), __('Автор'), __('Исполнитель'),__('Дата создания')]"
                :items="$tasks"
                :fields="['id', 'status_name', 'name', 'author_name', 'executor_name', 'created_at']">
            </x-table.table>
        @endguest
        <div class="mt-10">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
