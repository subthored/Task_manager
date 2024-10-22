@extends('layouts.app')

@section('content')
    <x-h1 class="text-white">{{ __('Create task') }}</x-h1>
    {{ html()->modelForm($task, 'POST', route('tasks.store', $task))->open() }}
    @include('tasks.form')
    {{ html()->submit( __('Create'))->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
