@extends('layouts.app')

@section('content')
    <x-h1 class="text-white">{{ __('Создать метку') }}</x-h1>
    {{ html()->modelForm($label, 'POST', route('labels.store', $label))->open() }}
    @include('labels.form')
    {{ html()->submit( __('Создать'))->class('btn-primary') }}
    {{ html()->closeModelForm() }}
@endsection
