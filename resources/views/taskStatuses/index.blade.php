@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1 class="text-white">{{ __('Статусы') }}</x-h1>

        @auth
            <div>
                <x-primary-a-button :route="route('task_statuses.create')" :method="'GET'" class="mt-4">
                    {{__('Создать статус')}}
                </x-primary-a-button>
            </div>
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Имя'), __('Дата создания'), __('Действия')]"
                :items="$taskStatuses"
                :routes="['delete'=>'task_statuses.destroy',
                            'update'=>'task_statuses.edit']"
                :fields="['id', 'name', 'created_at', 'action']">
            </x-table.table>
        @endauth
        @guest
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Имя'), __('Дата создания')]"
                :items="$taskStatuses"
                :fields="['id', 'name', 'created_at']">
            </x-table.table>
        @endguest
    </div>
@endsection
