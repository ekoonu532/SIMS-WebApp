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
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.5/dist/cdn.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-white">
        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Main Content  -->
        <div class="flex-1 flex flex-col">


            <!-- Page Content -->
            <main class="flex-1 p-4">
                {{ $slot }}
            </main>
        </div>
    </div>
    @if (session('success'))
    <div
        x-data="{ show: true, timeout: null }"
        x-show="show"
        x-init="timeout = setTimeout(() => show = false, 3000)"
        @mouseenter="clearTimeout(timeout)"
        @mouseleave="timeout = setTimeout(() => show = false, 3000)"
        class="fixed top-4 right-4 bg-green-500 text-white px-4 py-4 rounded-lg shadow-lg flex items-center justify-between space-x-4">
        <span>{{ session('success') }}</span>
        <button
            @click="show = false"
            class="text-white hover:text-gray-200 focus:outline-none">
            ✕
        </button>
    </div>
    @endif

    @if (session('error'))
    <div
        x-data="{ show: true, timeout: null }"
        x-show="show"
        x-init="timeout = setTimeout(() => show = false, 3000)"
        @mouseenter="clearTimeout(timeout)"
        @mouseleave="timeout = setTimeout(() => show = false, 3000)"
        class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg flex items-center justify-between space-x-4">
        <span>{{ session('error') }}</span>
        <button
            @click="show = false"
            class="text-white hover:text-gray-200 focus:outline-none">
            ✕
        </button>
    </div>
    @endif
</body>

</html>