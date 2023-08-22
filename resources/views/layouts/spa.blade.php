<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="overflow-x: hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/main.sass', 'resources/spa/app.js'])
    <link href="{{ url('css/prism.css') }}" rel="stylesheet">
</head>
<body style="overflow-x: hidden">

@yield('content')

<script src="{{ url('/js/prism.js') }}" type="text/javascript"></script>
</body>
</html>
