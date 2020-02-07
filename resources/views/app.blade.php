<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link href="{{ mix('assets/css/app.css') }}" type="text/css" rel="stylesheet">
    <script src="{{ mix('assets/js/app.js') }}" defer></script>
</head>
<body>
<div id="app" class="p-3 md:p-4 lg:p-6 h-screen bg-gray-300 flex items-center w-full">
    <main class="container mx-auto">
        @yield('body')
    </main>
</div>
</body>
</html>
