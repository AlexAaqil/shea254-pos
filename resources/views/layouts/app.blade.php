<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts / Styles -->
        @vite('resources/css/app-layout.css')

        @isset($extra_head)
            {{ $extra_head }}
        @else
            <title>Shea254 POS | Login</title>
        @endisset
    </head>
    <body class="antialiased font-sans">
        <livewire:partials.app-navbar />

        <main class="app_layout">
            {{ $slot }}
        </main>

        @isset($javascript)
            {{ $javascript }}
        @endisset
    </body>
</html>
