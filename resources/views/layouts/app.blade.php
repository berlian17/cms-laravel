<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | {{ config('app.name') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/CMS_LOGO.webp') }}">

        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.css">

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
                    <div class="max-w-5xl mx-auto">
                        @include('layouts.partials.alert')

                        @yield('content')

                        <p class="text-end text-xs text-slate-400 mt-8">
                            © {{ date('Y') }} Admin Panel
                        </p>
                    </div>
                </main>
            </div>
        </div>
        
        <script src="https://cdn.ckeditor.com/ckeditor5/43.3.1/ckeditor5.umd.js"></script>

        @stack('scripts')
    </body>
</html>
