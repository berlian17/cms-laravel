<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>@yield('title') | {{ config('app.name') }}</title>

        {{-- Styles / Scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="antialiased">
        <div class="flex h-screen overflow-hidden">
            <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-20 lg:hidden hidden transition-opacity"></div>
            @include('layouts.partials.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                @include('layouts.partials.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    @yield('content')
                </main>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
