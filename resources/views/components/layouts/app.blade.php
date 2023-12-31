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
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/darkmode_switcher.js'
    ])
</head>

<body class="font-sans antialiased bg-white dark:bg-slate-900">
        <!-- resize window watcher data: app.js -->
    <div
        x-data="resize_window_watcher"
        class="max-h-screen bg-inherit" id="app">
        @include('components.layouts.header')
        <x-layouts.sidebar />
        <main>
            <div class="sm:p-2 sm:ml-64 sm:mt-[64px] min-h-[90dvh] max-h-[calc(100dvh-64px)]">
                <x-toast />
                <x-session-toast />
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
