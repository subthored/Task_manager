@extends('layouts.app')

@section('content')
    <x-h1>{{ __('Изменение статуса') }}</x-h1>
    {{ html()->modelForm($taskStatus, 'PATCH', route('task_statuses.update', $taskStatus))->open() }}
    @include('taskStatuses.form')
    {{ html()->submit( __('Обновить') )->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
