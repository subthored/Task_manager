@extends('layouts.app')
@section('content')
    <div class="grid col-span-full">
        <x-h1 class="text-white">{{ __('Labels') }}</x-h1>

        @auth
            <div>
                <x-primary-a-button :route="route('labels.create')" :method="'GET'" class="mt-4">
                    {{ __('Create label') }}
                </x-primary-a-button>
            </div>

            <x-table.table class="text-gray-500"
                :headers="['ID', __('Name'), __('Description'), __('Date of creation'), __('Action')]"
                :items="$labels"
                :routes="['delete'=> 'labels.destroy',
                               'update'=> 'labels.edit']"
                :fields="['id', 'name', 'description', 'created_at', 'action']">
                >
            </x-table.table>
        @endauth
        @guest
            <x-table.table class="text-gray-500"
                :headers="['ID', __('Name'), __('Description'), __('Date of creation')]"
                :items="$labels"
                :fields="['id', 'name', 'description', 'created_at']">
                >
            </x-table.table>
        @endguest
    </div>
@endsection
