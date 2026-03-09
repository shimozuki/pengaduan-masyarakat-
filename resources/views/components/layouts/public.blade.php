<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.public-head')
    </head>
    <body class="min-h-screen bg-white text-zinc-900 antialiased">
        {{ $slot }}

        @livewireScripts
    </body>
</html>
