<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #preloader {
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: #39b49a;
    z-index: 11000;
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
}
.preloader {
    width: 350px;
}
    </style>

</head>

    <body class="font-sans antialiased">
        {{-- <div id="preloader">
            <a href="{{ url('/') }}"><img class="preloader" src="{{ config('app.url') }}images/loaders/heart-loading2.gif" alt=""></a>
        </div> --}}
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
            $(document).ready(function() {
                          // Once the window is fully loaded, fade out the preloader
                          $(window).on('load', function() {
                              $('#preloader').fadeOut(500); // Fade out the preloader div
                              $('.preloader').fadeOut(600); // Fade out the loader image
                          });
                      });
          </script>
    </body>
</html>