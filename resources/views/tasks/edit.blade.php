@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Change of task') }}</x-h1>

    {{ html()->modelForm($task, 'PATCH', route('tasks.update', $task))->open() }}
    @include('tasks.form')
    {{ html()->submit( __('Update') )->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    {{ html()->closeModelForm() }}

@endsection
