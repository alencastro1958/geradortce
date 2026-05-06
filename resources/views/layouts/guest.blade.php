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
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div style="min-height:100vh; display:flex; flex-direction:column; justify-content:center; align-items:center; padding: 12px 0; background-color:#f3f4f6;">
            <div style="margin-bottom: 8px;">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            <div style="width:100%; max-width:28rem; margin-top:8px; padding: 1rem 1.5rem; background:white; box-shadow:0 1px 3px rgba(0,0,0,.1); border-radius:.5rem; overflow:hidden;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
