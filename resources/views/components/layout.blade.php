<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @stack('styles')

        @vite([
            'resources/sass/app.scss',
            'resources/css/app.css',
            'resources/js/app.js',
        ])

        @stack('scripts')


    </head>
    <body class="font-sans antialiased">

        <x-navbar/>

        <div class="container py-2">

            @session('message')
                <div class="alert alert-{{session("message_type") ?? 'success'}}" role="alert">
                    {{session('message')}}
                </div>
            @endsession

            {{ $slot }}
        </div>
    </body>
</html>
