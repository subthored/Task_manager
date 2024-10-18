@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1 class="text-white">{{ __('Statuses') }}</x-h1>

        @auth
            <div>
                <x-primary-a-button :route="route('task_statuses.create')" :method="'GET'" class="mt-4">
                    {{__('Create status')}}
                </x-primary-a-button>
            </div>
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Name'), __('Date of creation'), __('Action')]"
                :items="$taskStatuses"
                :routes="['delete'=>'task_statuses.destroy',
                            'edit'=>'task_statuses.edit']"
                :fields="['id', 'name', 'created_at', 'action']">
            </x-table.table>
        @endauth
        @guest
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Name'), __('Date of creation')]"
                :items="$taskStatuses"
                :fields="['id', 'name', 'created_at']">
            </x-table.table>
        @endguest
    </div>
@endsection
