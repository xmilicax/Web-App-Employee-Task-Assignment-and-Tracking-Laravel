<head>
    <link rel="stylesheet" href="{{ asset('../resources/css/styles.css') }}">
    @yield('title')
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @yield('naslov_stranice')
        </h2>
    </x-slot>

   <div class="text-center py-12">
       @yield('content')
   </div>
    <footer>
        Milica Lazić I011-41/2020<br>Copyright © 2024
    </footer>
</x-app-layout>
