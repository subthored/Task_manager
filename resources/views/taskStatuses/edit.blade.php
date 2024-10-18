@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Change of status') }}</x-h1>
    {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->open() }}
    @include('taskStatuses.form')
    {{ html()->submit( __('Update') )->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
