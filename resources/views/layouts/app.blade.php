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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-100">
        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Main Content  -->
        <div class="flex-1 flex flex-col">
            <!-- Page Heading
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset -->

            <!-- Page Content -->
            <main class="flex-1 p-4">
                <button
                    id="openSidebarBtn"
                    class="text-red-500 text-2xl mb-4 hover:text-red-700 focus:outline-none">
                    &#9776;
                </button>
                {{ $slot }}
            </main>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const closeSidebarBtn = document.getElementById("closeSidebarBtn");
            const openSidebarBtn = document.getElementById("openSidebarBtn");

            // Fungsi untuk menutup sidebar
            closeSidebarBtn.addEventListener("click", function () {
                sidebar.classList.add("-translate-x-full");
            });

            // Fungsi untuk membuka sidebar
            openSidebarBtn.addEventListener("click", function () {
                sidebar.classList.remove("-translate-x-full");
            });
        });
    </script>
</body>

</html>