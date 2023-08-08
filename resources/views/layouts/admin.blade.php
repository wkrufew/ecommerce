<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=heebo:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css') }}"integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.css" integrity="sha512-YM6sLXVMZqkCspZoZeIPGXrhD9wxlxEF7MzniuvegURqrTGV2xTfqq1v9FJnczH+5OGFl5V78RgHZGaK34ylVg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js') }}" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/glider-js/1.7.8/glider.min.js" integrity="sha512-AZURF+lGBgrV0WM7dsCFwaQEltUV5964wxMv+TSzbb6G1/Poa9sFxaCed8l8CcFRTiP7FsCgCyOm/kf1LARyxA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
    

    <style>
        .border-b-1 {
            border-bottom-width: 1px;
        }
        
        .border-l-1 {
            border-left-width: 1px;
        }
        
        hover\:border-none:hover {
            border-style: none;
        }
        
        #sidebar {
            transition: ease-in-out all .3s;
            z-index: 9999;
        }
        
        #sidebar span {
            opacity: 0;
            position: absolute;
            transition: ease-in-out all .1s;
        }
        
        #sidebar:hover {
            width: 200px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            /*shadow-2xl*/
        }
        
        #sidebar:hover span {
            opacity: 1;
        }
    </style>

    @livewireStyles
</head>

{{-- <body class="font-heebo antialiased overflow-x-hidden scroll-smooth">
    <x-banner/>
    <div class="min-h-screen bg-gray-100">
        
        @livewire('navigation-menu')
        
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between">
                    {{$header}}
                </div>
            </header>
        @endif
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('script')
    <script>
        Livewire.on('errorSize', mensaje => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: mensaje,
            }) /*  */
        });
    </script>
</body> --}}

<body class="font-heebo antialiased flex h-screen bg-gray-100">

    <!-- Side bar-->
    <div id="sidebar" class="h-screen w-16 menu bg-white text-white px-4  items-center nunito fixed shadow font-heebo hidden md:flex">
        <ul class="list-reset ">
            <li class="my-2 md:my-0">
                <a href="{{ route('admin.dashboard.index') }}" class="{{request()->routeIs('admin.dashboard.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline">
                    <i class="fas fa-chart-area fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Dashboard</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.index') }}"  class=" {{request()->routeIs('admin.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fas fa-tasks fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Productos</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.categories.index') }}"  class=" {{request()->routeIs('admin.categories.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-network-wired mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Categorias</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.brands.index') }}"  class=" {{request()->routeIs('admin.brands.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-clone mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Marcas</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.orders.index') }}"  class=" {{request()->routeIs('admin.orders.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-hand-holding-dollar mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Ordenes</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.departments.index') }}"  class=" {{request()->routeIs('admin.departments.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-map-location-dot mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Provincias</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.sliders.index') }}"  class=" {{request()->routeIs('admin.sliders.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-panorama mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Sliders</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.settings.index') }}"  class=" {{request()->routeIs('admin.settings.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-gears mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Configuraciones</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.services.index') }}"  class=" {{request()->routeIs('admin.services.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-file-signature mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Servicios</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('admin.users.index') }}"  class=" {{request()->routeIs('admin.users.index') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-users mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Usuarios</span>
                </a>
            </li>
            <li class="my-2 md:my-0 ">
                <a href="{{ route('home') }}"  class=" {{request()->routeIs('home') ? 'text-[#60A3BD]' : 'text-gray-600'}} block py-1 md:py-3 pl-1 align-middle no-underline">
                    <i class="fa-solid fa-shop mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Tienda</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="flex flex-row flex-wrap flex-1 flex-grow pl-0 md:pl-16 h-14">
        <nav x-data="{ open: false }" class="sticky top-0 left-0 w-full bg-white border-b border-gray-100 z-50 shadow">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.index') }}">
                                <x-application-mark class="block h-9 w-auto" />
                            </a>
                        </div>        
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}
        
                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>
        
                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>
        
                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
        
                                    <div class="border-t border-gray-200"></div>
        
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
        
                                        <x-dropdown-link href="{{ route('logout') }}"
                                                 @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
        
                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        
            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('admin.dashboard.index') }}" :active="request()->routeIs('admin.dashboard.index')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                        {{ __('Productos') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.*')">
                        {{ __('Categorias') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.brands.index') }}" :active="request()->routeIs('admin.brands.index')">
                        {{ __('Marcas') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.orders.index') }}" :active="request()->routeIs('admin.orders.index')">
                        {{ __('Ordenes') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.departments.index') }}" :active="request()->routeIs('admin.departments.index')">
                        {{ __('Provincias') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.sliders.index') }}" :active="request()->routeIs('admin.sliders.index')">
                        {{ __('Slider') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.settings.index') }}" :active="request()->routeIs('admin.settings.index')">
                        {{ __('Configuracion') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.services.index') }}" :active="request()->routeIs('admin.services.index')">
                        {{ __('Servicios') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">
                        {{ __('Usuarios') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="/">
                        {{ __('Tienda') }}
                    </x-responsive-nav-link>
                </div>
        
                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="flex items-center px-4">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 mr-3">
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                        @endif
        
                        <div>
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
        
                    <div class="mt-3 space-y-1">
                        <!-- Account Management -->
                        <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
        
                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                {{ __('API Tokens') }}
                            </x-responsive-nav-link>
                        @endif
        
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
        
                            <x-responsive-nav-link href="{{ route('logout') }}"
                                           @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        
        <!--CONTENIDO PRINCIPAL -->
        <div id="main-content" class="w-full flex-1">
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between">
                        {{$header}}
                    </div>
                </header>
            @endif
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('script')
    
    <script>
        
        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    </script>

</body>

</html>
