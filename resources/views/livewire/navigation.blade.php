<nav style="z-index: 999" class="bg-white w-full sticky top-0 z-50 rounded-b-xl shadow" x-data="{ open: false }" @keydown.window.escape="open = false" {{-- x-init="() => { $watch('open', value => toggleScrollLock(value)) }" --}}>
    <div class="contenedor flex justify-between items-center h-14 space-x-6">
        <!-- Logo -->
        <div class="flex items-center space-x-4 h-full">
            <a aria-label="Abrir el menu de categorias" wire:click="$emit('switchingCategoryEvent')" :class="{'md:bg-opacity-100 text-[#3E3E66]': open, 'md:bg-opacity-10 text-[#60A3BD]': !open }" class="flex flex-col overflow-hidden select-none cursor-pointer px-2 items-center justify-center my-auto md:bg-white  md:bg-opacity-25 text-[#60A3BD] h-full"
                @click="open = !open">
                <div class="space-y-1">
                    <span :class="{ 'translate-y-2 rotate-45 bg-[#3E3E66]': open, 'bg-[#60A3BD]': !open }"
                        class="block bg-[#60A3BD] h-0.5 w-6 origin-center rounded-full transition-transform duration-500 ease-in-out"></span>
                    <span :class="{ 'translate-x-28 bg-[#3E3E66]': open, 'bg-[#60A3BD]': !open }"
                        class="block bg-[#60A3BD] w-5 h-0.5 origin-center rounded-full transition-transform duration-500 ease-in-out"></span>
                    <span :class="{ '-translate-y-1 -rotate-45 bg-[#3E3E66]': open, 'bg-[#60A3BD]': !open }"
                        class="block bg-[#60A3BD] h-0.5 w-6 origin-center rounded-full transition-transform duration-500 ease-in-out"></span>
                </div>
                <span class="text-sm pt-1 hidden md:block font-medium">Categorias</span>
            </a>
            <div class="hidden md:block">
                <div class="shrink-0 flex items-center">
                    <a aria-label="Ir al inicio de la pagina" href="/">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
            </div>
        </div>
        <div class="block md:hidden">
            <div class="shrink-0 flex items-center">
                <a aria-label="Ir al inicio de la pagina" href="/">
                    <x-application-mark class="block h-9 w-auto" />
                </a>
            </div>
        </div>
        <!-- Opciones menu central -->
        <div class="hidden md:flex justify-center space-x-4">
            {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"> --}}
                <x-nav-link href="{{route('home') }}" class="text-[#60A3BD] hover:text-[#3E3E66]" :active="request()->routeIs('home')">
                    {{ __('Inicio') }}
                </x-nav-link>
                <x-nav-link class="text-[#60A3BD]" href="{{ route('services.index') }}" :active="request()->routeIs('services.index')">
                    {{ __('Servicios') }}
                </x-nav-link>
                <x-nav-link class="text-[#60A3BD]" href="{{ route('about') }}" :active="request()->routeIs('about')">
                    {{ __('Nosotros') }}
                </x-nav-link>
                <x-nav-link class="text-[#60A3BD]" href="{{ route('form-contact') }}" :active="request()->routeIs('form-contact')">
                    {{ __('Contactanos') }}
                </x-nav-link>
            {{-- </div> --}}
        </div>
        <!-- Opciones menu derecho -->
        <div class="flex items-center justify-center space-x-0 md:space-x-4">
            <div class="hidden lg:flex justify-end w-full">
                @livewire('search')
            </div>
            <div class="flex items-center relative">
                @livewire('dropdown-cart')
            </div>
            <div class="hidden md:flex w-9 relative shrink-0">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button  aria-label="Opciones del usuario"
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-7 w-7 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                    alt="{{ Auth::user()->name }}" />
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link aria-label="Abrir la opcion del perfil" href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            @auth
                                <x-dropdown-link aria-label="Abrir mis ordenes" href="{{ route('orders.index') }}">
                                    Mis ordenes
                                </x-dropdown-link>
                            @endauth
    
                            @role('admin')
                                <x-dropdown-link  aria-label="Abrir la opcion de administrador" href="{{ route('admin.index') }}">
                                    Administrador
                                </x-dropdown-link>
                            @endrole

                            <div class="border-t border-gray-200"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link aria-label="Cerrar sesion" href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button aria-label="Opciones de inicio" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition bg-gray-200">
                                <svg class="h-7 w-7 p-0.5 rounded-full fill-[#60A3BD]" xmlns="http://www.w3.org/2000/svg" fill="#273C99" height="1em"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Opciones de inicio') }}
                            </div>
                            <x-dropdown-link aria-label="Login" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </x-dropdown-link>
                            <x-dropdown-link  aria-label="Registrarse" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>
        </div>
    </div>

    
    <!-- Menu Escritorio -->
    <div class="hidden md:block">
        <nav style="z-index: 100" id="navigation-menu" x-cloak  x-show="open"  x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="transform opacity-0 scale-90" x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-90"
            class="absolute w-full origin-top-left bg-white bg-opacity-5 backdrop-blur-sm">
            <div class="contenedor h-full">

                @if ($loaded)
                    <div class="grid grid-cols-4 relative h-auto" @click.away="open = false" @close.stop="open = false">
                        <ul class="bg-white py-6 rounded-bl-md h-auto overflow-auto">
                            @forelse ($categories as $category)
                                <li class="navigation-link text-gray-700 font-semibold hover:bg-[#3E3E66] hover:text-white ">
                                    <a aria-label="Abrir la categoria {{$category->name}}" href="{{ route('categories.show', $category) }}"
                                        class="px-3 py-1 text-sm flex items-center z-40">
                                        <span class="flex justify-center w-9">
                                            {!! $category->icon !!}
                                        </span>
                                        {{ $category->name }}
                                    </a>
                                    <div class="navigation-submenu bg-white text-gray-700 rounded-br-md absolute top-0 right-0 hidden z-30">
                                        <x-navigation-subcategories :category="$category" />
                                    </div>
                                </li>
                            @empty
                                <li>
                                    No se encuentran categorias por el momento
                                </li>
                            @endforelse
                        </ul>
                        <div class="col-span-3 font-semibold bg-white rounded-br-md text-gray-700">
                            <x-navigation-subcategories :category="$categories->first()" />
                        </div>
                    </div>
                @else
                    <div class="relative h-auto">
                        <ul class="bg-white py-4 rounded-b-md h-auto px-6 grid grid-cols-4">
                            <li class="w-full h-48 mr-6 bg-gray-400 animate-pulse rounded-md text-white flex justify-center items-center">
                            </li>
                            <li class="mx-6 h-48 bg-gray-400 animate-pulse rounded-md text-white flex justify-center items-center"> 
                            </li>
                            <li class="col-span-2 h-48 w-96 py-4 ml-auto  bg-gray-400 animate-pulse rounded-md text-white flex justify-center items-center">
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </nav>
    </div>
    {{-- menu laateral movil --}}
    <div class="block md:hidden" style="z-index: 100">
        <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/75"></div>
        <div x-cloak x-show="open" {{-- x-init="() => { $watch('open', value => toggleScrollLock(value)) }" --}}
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="-translate-x-full" 
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300" 
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full" @click.away="open = false"
                class="left-0 fixed inset-y-0 z-50 w-80 md:w-96 max-w-lg bg-white border border-l-2 border-gray-200 h-full overflow-x-hidden">
            <div class="w-full relative bg-white z-50">
                <div class="flex flex-col h-screen">
                    <div class="bg-[#60A3BD] py-4">
                        <div class="container mx-auto flex items-center justify-center px-4 relative">
                            <div class="flex items-center justify-center ">
                                <div class="absolute top-0 right-3">
                                    <svg @click="open = false" class="fill-white cursor-pointer rotate-180 w-7 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"><path d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>
                                </div>
                            </div>
                            <h1 class="text-center text-white text-xl">Menu</h1>
                        </div>
                    </div>
                    <div class="flex-1 overflow-y-auto py-2">
                        <div class="flex justify-center w-full pt-2 pb-6">
                            @livewire('search')
                        </div>
                        <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                            {{ __('Inicio') }}
                        </x-responsive-nav-link>
                        <div class="py-2" x-data="{ openCat: false }">
                            <x-responsive-nav-link @click="openCat = !openCat" class="flex">
                                {{ __('Categorias') }}
                                <span>
                                    <svg :class="{ 'rotate-180': openCat}" class="transform transition-all z-20" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m12 13.171l4.95-4.95l1.414 1.415L12 16L5.636 9.636L7.05 8.222l4.95 4.95Z"/></svg>
                                </span>
                            </x-responsive-nav-link>
                            <div x-cloak x-show="openCat" x-collapse>
                                @if ($loaded)
                                    <ul class="py-2 bg-[#60A3BD]/10 mx-2 rounded-md">
                                        @forelse ($categories as $category)
                                            <li class="navigation-link text-gray-700 font-semibold hover:bg-sky-500 hover:text-white rounded-sm">
                                                <a aria-label="Abrir la categoria {{$category->name}}" href="{{route('categories.show', $category)}}" class="px-3 py-1 text-base flex items-center">
                                                    <span class="flex justify-center w-9">
                                                        {!! $category->icon !!}
                                                    </span>
                                                    <span class="" >
                                                        {{ $category->name }}
                                                    </span>
                                                </a>
                                            </li>
                                        @empty
                                            <li>
                                                No se encuentran categorias por el momento
                                            </li>
                                        @endforelse
                                    </ul>
                                @else
                                    <ul>
                                        <li>
                                            Cargando categorias...
                                        </li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="space-y-2">
                            <x-responsive-nav-link aria-label="Abrir servicios" href="{{route('services.index') }}" :active="request()->routeIs('services.index')">
                                {{ __('Servicios') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link aria-label="Abrir nosotros" href="{{ route('about') }}" :active="request()->routeIs('about')">
                                {{ __('Nosotros') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link aria-label="Abrir contactanos" href="{{ route('form-contact') }}" :active="request()->routeIs('form-contact')">
                                {{ __('Contactanos') }}
                            </x-responsive-nav-link>
                        </div>
                    </div>
                    <div class="bg-white py-2">
                        @auth
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
                                <x-responsive-nav-link aria-label="Abrir perfil" href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                    {{ __('Profile') }}
                                </x-responsive-nav-link>
                                <x-responsive-nav-link aria-label="Abrir mis ordenes" href="{{ route('orders.index') }}" :active="request()->routeIs('orders.index')">
                                    {{ __('Mis ordenes') }}
                                </x-responsive-nav-link>
                                @role('admin')
                                    <x-responsive-nav-link aria-label="Abrir opcion para administrador" href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
                                        {{ __('Administrador') }}
                                    </x-responsive-nav-link>
                                @endrole
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-responsive-nav-link aria-label="Cerrar sesion" href="{{ route('logout') }}"
                                                @click.prevent="$root.submit();">
                                                {{ __('Log Out') }}
                                    </x-responsive-nav-link>
                                </form>
                            </div>
                        @else
                            <hr>
                            <x-responsive-nav-link aria-label="Login" href="{{ route('login') }}" :active="request()->routeIs('login')">
                                {{ __('Login') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link aria-label="Registrarse" href="{{ route('register') }}" :active="request()->routeIs('register')">
                                {{ __('Register') }}
                            </x-responsive-nav-link>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
