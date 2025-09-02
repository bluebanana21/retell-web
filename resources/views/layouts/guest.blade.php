<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&family=joan:400&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter text-gray-900 antialiased bg-gray-50">
    <!-- Include Navbar -->
    @include('layouts.retell-navbar')

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-20 sm:pt-24 pb-6"
        style="background: linear-gradient(135deg, rgba(110, 180, 192, 0.1) 0%, rgba(0, 107, 131, 0.05) 100%);">
        <div
            class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/95 backdrop-blur-xl shadow-2xl overflow-hidden rounded-2xl border border-white/20">
            {{ $slot }}
        </div>
    </div>
</body>

</html>