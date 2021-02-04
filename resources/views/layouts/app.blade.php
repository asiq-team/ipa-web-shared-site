<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Solusi Media Data (SMD), Solusi Tunas Pratama (STP)">
        <meta name="keywords" content="ASIQ Application, STP ASIQ, STP PMTools">
        <meta name="author" content="Mustkenters">

        <title>{{$title ?? config('app.name', 'ASIQ') }}</title>

        <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
        {{ $style }}
        <style>
            .bg-logo-white{
                background-color: white;
            }
            html {
            --bg-opacity: 1;
            background-image: linear-gradient(180deg, #3c4b64, #3c4b64);
            }

        </style>
    </head>
    <body class="app">
        {{ $body }}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js" integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ==" crossorigin="anonymous"></script>
        {{ $script }}
    </body>
</html>
