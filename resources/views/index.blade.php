@extends('layouts.app')
@section('content')
    <div class="mr-auto place-self-center lg:col-span-7">
        <h1 class="font-extrabold text-white xl:text-6xl">Hello from Hexlet!</h1>
        <p class="max-w-2xl mb-6 font-light text-gray-500 text-xl mt-4">
            This is a simple task manager working on Laravel </p>
        <div class="space-y-4">
            <a href="/"
               class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
               target="_blank">
                Push me! </a>
        </div>
    </div>
@endsection
