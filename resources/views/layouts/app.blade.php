<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=heebo:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css') }}"integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css') }}" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @stack('css')
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js') }}" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js') }}" integrity="sha512-AZURF+lGBgrV0WM7dsCFwaQEltUV5964wxMv+TSzbb6G1/Poa9sFxaCed8l8CcFRTiP7FsCgCyOm/kf1LARyxA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-heebo antialiased overflow-x-hidden selection:bg-[#60A3BD] selection:text-white">
        <x-banner/>
        <div class="min-h-screen bg-gray-100">
            <!-- menu -->
            @livewire('navigation')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <x-footer/>
        </div>
        @stack('modals')
        @livewireScripts
        @stack('script')
    </body>
</html>

    {{-- <script>        
        function toggleScrollLock(open) {
            if (open) {
            document.documentElement.style.overflow = 'hidden';
            } else {
            document.documentElement.style.overflow = 'auto';
            }
        }
    </script> --}}
