@extends('layouts.app')

@section('content')
    <x-h1 class="text-white">{{ __('Создать статус') }}</x-h1>
    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store', $taskStatus))->open() }}
    @include('taskStatuses.form')
    {{ html()->submit( __('Создать'))->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
