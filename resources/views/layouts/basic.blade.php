<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title',config('app.name'))
    </title>

    @vite('resources/js/app.js')

</head>
<body class="antialiased dark:bg-gray-900">
<main>
    @include('components.global.navbar')
    @yield('content')
</main>
</body>
</html>
