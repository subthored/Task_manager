@extends('layouts.app')

@section('content')
    <x-h1 class="text-white">{{ __('Create lable') }}</x-h1>
    {{ html()->modelForm($label, 'POST', route('labels.store', $label))->open() }}
    @include('labels.form')
    {{ html()->submit( __('Create'))->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
