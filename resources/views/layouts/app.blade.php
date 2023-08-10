<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#60A3BD"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link rel="shortcut icon" href="{{ asset('fotos/favicon.webp') }}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=heebo:400&display=swap" rel="stylesheet" />
        @stack('css')
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        @livewireStyles
        <!-- SEO -->
            <link rel="canonical" href="@yield('url', config('app.url'))">
            <title>{{ config('app.name', 'CONSISTELEC') }} @yield('title')</title>
            <meta name="robots" content="index, follow">
            <meta name="author" content="Jose Coba">
            <meta name="description" content="@yield('description', '')">
            <meta property="og:title" content="{{ config('app.name', 'CONSISTELEC') }} @yield('title', 'Inicio')">
            <meta property="og:type" content="@yield('type', 'product')">
            <meta property="og:description" content="@yield('description', '')">
            <meta property="og:url" content="@yield('url', config('app.url'))">
            <meta property="og:image" content="@yield('img', asset('img/home/sports.jpg'))">{{-- falta definir la imagen de la empresa --}}
            <meta property="og:site_name" content="{{ config('app.name', 'CONSISTELEC') }}" />
            <!-- PARA PRODUCTOS -->
            @yield('og-tags')
            <meta name="keywords" content="Sistemas eléctricos-electrónicos, Diseño de sistemas eléctricos, Implementación de sistemas electrónicos, Venta de sistemas eléctricos, Soluciones eléctricas y electrónicas, Ingeniería eléctrica y electrónica, Automatización industrial, Control de procesos eléctricos, Componentes eléctricos y electrónicos, Servicios eléctricos especializados, Soluciones personalizadas eléctricas, Equipos electrónicos industriales, Consultoría en sistemas eléctricos, Integración de sistemas electrónicos, Diseño de circuitos eléctricos, Electrónica de potencia, Eficiencia energética eléctrica, Automatización y control eléctrico, Proyectos eléctricos y electrónicos, Innovación en sistemas eléctricos">
        <!-- SEO -->
    </head>
    <body class="font-heebo antialiased overflow-x-hidden selection:bg-[#60A3BD] selection:text-white">
        <x-banner/>
        <div class="min-h-screen bg-gray-100 select-none">
            @livewire('navigation')
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
