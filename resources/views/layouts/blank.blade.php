<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- // TODO: make it accessible --}}
    <title>{{ config('app.name') }}</title>

    @vite('resources/css/app.css')

</head>
<body class="antialiased dark:bg-gray-900">
<main>
    @yield('content')
</main>
</body>
</html>
