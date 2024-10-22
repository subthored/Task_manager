@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1 class="text-white">{{ __('Метки') }}</x-h1>

        @auth
            <div>
                <x-primary-a-button :route="route('labels.create')" :method="'GET'" class="mt-4">
                    {{ __('Создать метку') }}
                </x-primary-a-button>
            </div>

            <x-table.table class="text-gray-500"
                :headers="['ID', __('Имя'), __('Описание'), __('Дата создания'), __('Действия')]"
                :items="$labels"
                :routes="['delete'=> 'labels.destroy',
                               'update'=> 'labels.edit']"
                :fields="['id', 'name', 'description', 'created_at', 'action']">
                >
            </x-table.table>
        @endauth
        @guest
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Имя'), __('Описание'), __('Дата создания')]"
                :items="$labels"
                :fields="['id', 'name', 'description', 'created_at']">
                >
            </x-table.table>
        @endguest
    </div>
@endsection
