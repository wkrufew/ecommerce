<div {{-- x-data="{ slideOut: false }" @keydown.window.escape="slideOut = false" --}}>
    {{-- <x-dropdown align="right" width="96">
        <x-slot name="trigger">
            <span class="relative flex items-center justify-center">
                <svg class="text-white text-5xl h-9 w-9 p-1 cursor-pointer" fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                    <path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64v48H160V112zm-48 48H48c-26.5 0-48 21.5-48 48V416c0 53 43 96 96 96H352c53 0 96-43 96-96V208c0-26.5-21.5-48-48-48H336V112C336 50.1 285.9 0 224 0S112 50.1 112 112v48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z" />
                </svg>
                <span class="absolute top-1 right-1 inline-flex items-center justify-center px-1 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                    99
                </span>
            </span>
        </x-slot>
        <x-slot name="content">
            <div class="p-4">
                <p>Carrito de compras vacio</p>
            </div>
        </x-slot>
    </x-dropdown> --}}

    <div x-data="{ slideOut: false }" @keydown.window.escape="slideOut = false" x-init="() => { $watch('slideOut', value => toggleScrollLock(value)) }">
        <span @click="slideOut = !slideOut" class="relative flex items-center justify-center">
            {{-- <svg class="fill-[#60A3BD] text-5xl h-9 w-9 p-1 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path d="M160 112c0-35.3 28.7-64 64-64s64 28.7 64 64v48H160V112zm-48 48H48c-26.5 0-48 21.5-48 48V416c0 53 43 96 96 96H352c53 0 96-43 96-96V208c0-26.5-21.5-48-48-48H336V112C336 50.1 285.9 0 224 0S112 50.1 112 112v48zm24 48a24 24 0 1 1 0 48 24 24 0 1 1 0-48zm152 24a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z" />
            </svg> --}}
            <svg class="fill-[#60A3BD] text-5xl h-9 w-9 p-1 cursor-pointer" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                    
            @if (Cart::count())
                <span class="absolute top-0.5 right-0.5 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                    {{Cart::count()}}
                </span>  
            @else
            @endif
        </span>
        <div x-cloak x-show="slideOut" x-transition.opacity class="fixed inset-0 w-full h-full bg-white bg-opacity-5 backdrop-blur-sm"></div>
        <div x-cloak x-show="slideOut" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
                x-transition:leave-end="translate-x-full" @click.away="slideOut = false"
                class="fixed inset-y-0 right-0 z-50 w-80 md:w-96 max-w-lg bg-white border border-l-2 border-gray-200 h-full overflow-hidden">
            <div class="w-full h-96 relative bg-white z-50" style="z-index: 9999">
                <div class="flex flex-col h-screen">
                    <!-- Encabezado -->
                    <div class="bg-[#60A3BD] py-4">
                        <div class="container mx-auto flex items-center justify-center px-4 relative">
                            <div class="flex items-center justify-center ">
                                <div class="absolute top-0.5 md:top-1 left-3">
                                    <svg @click="slideOut = false" class="fill-white cursor-pointer w-6 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 15"><path d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414Z"/></svg>
                                </div>
                            </div>
                            <h1 class="text-center text-md md:text-xl text-white">Carrito de compras</h1>
                          </div>
                    </div>
                    <!-- Contenedor central con desplazamiento -->
                    <div class="flex-1 overflow-y-auto py-2">
                        <ul class="space-y-1">
                            @forelse (Cart::content() as $item)
                                <li class="flex rounded-md overflow-hidden border mx-1">
                                    <img class="h-15 w-20 object-cover" src="{{$item->options->image}}" alt="">
                                    <article class="pl-2">
                                        <h2 class="text-sm">{{$item->name}}</h2>
                                        <div class="flex justify-between text-sm">
                                            <p class=""><span class="font-semibold text-sm">Cant.:</span> {{$item->qty}}</p>
                                            @isset($item->options['color'])
                                                <p><span class="font-semibold text-sm ml-2 md:ml-4">Color: </span> {{$item->options['color']}}</p>
                                            @endisset
                                            @isset($item->options['size'])
                                            <p class="font-semibold text-sm ml-2 md:ml-4"> {{$item->options['size']}}</p>
                                            @endisset
                                        </div>
                                        <p class="text-sm"><span class="font-semibold text-sm">Precio:</span> $ {{$item->price}}</p>
                                    </article>
                                </li>
                            @empty
                                <li class="flex justify-center items-center">
                                    Sin elementos por el momento
                                </li>
                            @endforelse
                        </ul>
                    </div>
                    <!-- Pie de página -->
                    <div class="bg-white">
                        @if (Cart::count())
                            <div class="py-4 border px-2 rounded-md">
                                <p class="font-semibold text-center text-[#3E3E66]">Total: $ {{ Cart::subtotal() }}</p>
                                <div class="mt-2">
                                    <a href="{{ route('shopping-cart') }}" class="w-full flex justify-center items-center border border-[#60A3BD] text-[#60A3BD] hover:bg-[#60A3BD] fill-[#60A3BD] hover:fill-white rounded-full px-3 py-2 hover:text-white">
                                        <span class="mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                                        </span> 
                                        <span>
                                            Ir al carrito de compras
                                        </span>
                                    </a>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('orders.create') }}" class="w-full flex justify-center items-center border border-[#3E3E66] text-[#3E3E66] hover:bg-[#3E3E66] fill-[#3E3E66] hover:fill-white rounded-full px-3 py-2 hover:text-white">
                                        <span class="mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zM272 192H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16s7.2-16 16-16zM256 304c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16zM164 152v13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9V360c0 11-9 20-20 20s-20-9-20-20V345.4c-10.3-2.2-20-5.5-28.2-8.4l0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5V152c0-11 9-20 20-20s20 9 20 20z"/></svg>
                                        </span> 
                                        <span>
                                            Comprar Ahora
                                        </span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
