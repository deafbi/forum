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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    @livewireStyles

</head>

<body class="font-sans antialiased">

    <div id="page-container" x-data="{ userDropdownOpen: false, mobileSidebarOpen: false, desktopSidebarOpen: true }"
        x-bind:class="{
            'flex flex-col mx-auto w-full min-h-screen bg-gray-100': true,
            'lg:pl-64': desktopSidebarOpen
        }">
        @include('layouts._admin.sidebar')
        @include('layouts._admin.navigation')
        <!-- Page Content -->
        <main id="page-content" class="flex flex-auto flex-col max-w-full pt-16">
            <!-- Page Section -->
            <div class="max-w-10xl mx-auto p-4 lg:p-8 w-full">
                {{ $slot }}
            </div>
            <!-- END Page Section -->
        </main>
        <!-- END Page Content -->

    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
