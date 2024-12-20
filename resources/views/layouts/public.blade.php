<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <style>
            [x-cloak] {
                display: none;
            }
        </style>


        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/css/simplefolio/main.css',
            'resources/css/simplefolio/media.css',
            'resources/js/app.js'
        ])
    </head>

    <body>
        {{ $slot }}
    </body>
</html>
