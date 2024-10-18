@extends('layouts.app')

@section('content')
    <x-h1 class="text-white">{{ __('Create status') }}</x-h1>
    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store', $taskStatus))->open() }}
    @include('taskStatuses.form')
    {{ html()->submit( __('Create'))->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
