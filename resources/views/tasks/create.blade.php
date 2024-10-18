@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Create task') }}</x-h1>
    {{ html()->modelForm($task, 'POST', route('tasks.store', $task))->open() }}
    @include('tasks.form')
    {{ html()->submit( __('Create'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    {{ html()->closeModelForm() }}
@endsection
