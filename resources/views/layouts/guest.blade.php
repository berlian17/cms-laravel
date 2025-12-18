<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield('title') | {{ config('app.name') }}</title>

        {{-- Styles / Scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="bg-gradient-to-br from-blue-100 via-white to-cyan-100 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center py-6 px-4">
            <div class="card w-full sm:max-w-md rounded-3xl shadow-2xl p-8 border border-gray-100">
                {{ $slot }}
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
