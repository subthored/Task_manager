@extends('layouts.app')

@section('content')
    <x-h1 class="text-white">{{ __('Создать задачу') }}</x-h1>
    {{ html()->modelForm($task, 'POST', route('tasks.store', $task))->open() }}
    @include('tasks.form')
    {{ html()->submit( __('Создать'))->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
