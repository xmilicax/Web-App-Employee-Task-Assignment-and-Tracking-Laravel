<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('../resources/css/img/logo_krug.png') }}">
    <link rel="stylesheet" href="{{ asset('../resources/css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        #naslov {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 3px;
            text-decoration: underline;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PPP2 Projekat II - Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<header class="header1">
    <a @yield('link-naslov') class="ikonica"><i class="fas fa-arrow-left"></i></a>
</header>
<body class="font-sans text-gray-900 antialiased">
<div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0  dark:bg-gray-900">
    @yield('naslov')

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
<footer>
    Milica Lazić I011-41/2020<br>Copyright © 2024
</footer>
</html>
