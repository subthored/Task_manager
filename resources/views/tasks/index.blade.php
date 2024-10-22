@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1 class="text-white">{{ __('Tasks') }}</x-h1>

        <div class="w-full flex justify-between">
            @include('tasks.filter-form')
            @auth
                <div class="flex">
                    <x-primary-a-button :route="route('tasks.create')" :method="'GET'">
                        {{__('Create task')}}
                    </x-primary-a-button>
                </div>
            @endauth
        </div>

        @auth
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Status'), __('Name'), __('Author'), __('Executor'), __('Date of creation'), __('Action')]"
                :items="$tasks"
                :routes="['update'=> 'tasks.edit', 'delete' => 'tasks.destroy']"
                :fields="['id', 'status_name', 'name', 'author_name', 'executor_name', 'created_at', 'action']">
            </x-table.table>
        @endauth
        @guest
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Status'), __('Name'), __('Author'), __('Executor'),__('Date of creation')]"
                :items="$tasks"
                :fields="['id', 'status_name', 'name', 'author_name', 'executor_name', 'created_at']">
            </x-table.table>
        @endguest
        <div class="mt-10">
            {{ $tasks->links() }}
        </div>
    </div>
@endsection
