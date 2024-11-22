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
       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
       <!-- Scripts -->
       @vite(['resources/css/app.css', 'resources/js/app.js'])

       <style>
           .probabilidad-impacto-table {
               table-layout: fixed;
               width: 100%;
               background-color: #2d3748;
           }

           .probabilidad-impacto-table td {
               padding: 1rem;
               border: 1px solid #444;
               text-align: center;
           }

           .probabilidad-impacto-table th {
               padding: 0.5rem;
               text-align: center;
               font-weight: bold;
               background-color: #2d3748;
               color: #fff;
           }

           .low-risk {
               background-color: #00ff00;
           }

           .moderate-risk {
               background-color: #ffff00;
           }

           .high-risk {
               background-color: #ffa500;
           }

           .very-high-risk {
               background-color: #ff0000;
           }
   
           .techniques-table {
               display: grid;
               grid-template-columns: repeat(2, 1fr);
               grid-template-rows: repeat(2, 1fr);
               width: 100%;
               max-width: 200px;
               margin: auto;
               border-collapse: collapse;
               border: 2px solid #444;
           }
   
           .techniques-table div {
               display: flex;
               align-items: center;
               justify-content: center;
               font-weight: bold;
               border: 1px solid #444;
               padding: 20px;
               text-align: center;
               font-size: 14px;
           }
   
           .technique-accept {
               background-color: #fff;
               color: #000;
           }
   
           .technique-transfer {
               background-color: #ffcc00;
           }
   
           .technique-reduce {
               background-color: #ff9933;
           }
   
           .technique-avoid {
               background-color: #ff3300;
           }

           .vertical-text {
               writing-mode: vertical-rl;
               text-orientation: mixed;
           }
   
       </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="pt-16 bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var swiper = new Swiper(".mySwiper-2", {
              slidesPerView: 1,
              spaceBetween: 30,
              grabCursor: true,
              loop: true,
              pagination: {
                clickable: true,
              },
              breakpoints: {
                1024: {
                slidesPerView: 2,
                spaceBetween: 50,
                },
              },
            });
        </script>
    </body>
</html>
