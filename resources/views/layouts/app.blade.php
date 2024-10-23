<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="//fonts.bunny.net">
    <link rel="stylesheet" href="//fonts.bunny.net/css?family=figtree:400,500,600&display=swap">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Nunito">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
@include('layouts.header')
@include('flash::message')
<a>Привет от хекслета!</a>
<main>
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto">
            @yield('content')
        </div>
    </section>
</main>
</body>
</html>
