@extends('layouts.app')
@section('content')
    <x-h1>{{ __('Label update') }}</x-h1>
    {{ html()->modelForm($label, 'PATCH', route('labels.update', $label))->open() }}
    @include('labels.form')
    {{ html()->submit( __('Update') )->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    {{ html()->closeModelForm() }}
@endsection
