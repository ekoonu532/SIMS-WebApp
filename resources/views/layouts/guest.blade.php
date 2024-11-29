<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        .logo-red {
            filter: brightness(0) saturate(100%) invert(26%) sepia(94%) saturate(746%) hue-rotate(338deg) brightness(97%) contrast(105%);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-50">
    <div class="min-h-screen flex flex-row items-center">
        <!-- Left Section -->
        <div class="w-1/2 flex flex-col justify-center items-center px-10">
            <div class="flex items-center mb-4">
                <img src="{{ asset('assets/Handbag.png') }}" alt="Logo" class="w-12 h-12 me-4 logo-red">
                <h1 class="text-3xl font-bold text-gray-900">SIMS Web App</h1>
            </div>
            <p class="text-lg mb-6">Masuk atau buat akun untuk memulai</p>
            {{ $slot }}
        </div>

        <!-- Right Section -->
        <div class="w-1/2 bg-red-500 flex justify-center items-center relative">
            <img src="{{ asset('assets/Frame 98699.png') }}" alt="Illustration" class="w-3/4">
        </div>
    </div>
</body>

</html>