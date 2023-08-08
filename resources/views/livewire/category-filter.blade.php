<div>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-x-0 md:gap-x-6 gap-y-6 mt-0">
        <div class="rounded-md h-full w-full">
            <div class="w-full bg-white sticky top-16 rounded-md py-3 border border-gray-200" x-data="{ openFiltro: false }">
                <div class="flex justify-between items-center">
                    <span class="text-center font-bold text-sm pl-2"><i class="fa-solid fa-filter pr-1"></i> {{ __('FILTROS') }}</span>
                    <button x-on:click="openFiltro = !openFiltro" class="block sm:hidden">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': openFiltro, 'inline-flex': !openFiltro }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !openFiltro, 'inline-flex': openFiltro }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-col hidden sm:block select-none mx-2" :class="{ 'block': openFiltro, 'hidden': !openFiltro }">
                    <div class="py-1 md:py-2">
                        <span class="text-xs font-semibold bg-[#3E3E66] w-full text-white block py-2 px-2 rounded-md">
                            {{-- <i class="fa-solid fa-up-down pr-1"></i> --}} {{ __('Orden') }}
                        </span>
                        <div class="pt-2 flex-col space-y-2 px-3">
                            <div class="first:w-full flex justify-between items-center">
                                <span class="text-xs {{ $orden == 'desc' ? 'text-[#60A3BD] font-semibold' : ''}}">{{ __('Recientes') }}</span>
                                <input class="rounded-full checked:bg-[#60A3BD] checked:text-[#60A3BD] cursor-pointer" type="radio" wire:model="orden" value="desc">
                            </div>
                            <div class="w-full flex justify-between items-center">
                                <span class="text-xs {{ $orden == 'asc' ? 'text-[#60A3BD] font-semibold' : ''}}">{{ __('Anteriores') }}</span>
                                <input class="rounded-full checked:bg-[#60A3BD] checked:text-[#60A3BD] cursor-pointer" type="radio" wire:model="orden" value="asc">
                            </div>
                        </div>
                    </div>
                    <div class="py-2 w-full">
                        <span class="text-xs font-semibold bg-[#3E3E66] w-full text-white block py-2 px-2 rounded-md">
                            {{-- <i class="fa-solid fa-filter-circle-dollar pr-1"></i>--}} {{ __('Precio') }}
                        </span>
                        <div class="pt-2 flex-col space-y-2 px-3">
                            <div class="first:w-full flex justify-between items-center">
                                <span class="text-xs {{ $precio == 'mayor' ? 'text-[#60A3BD] font-semibold' : ''}}">{{ __('Mayor precio') }}</span>
                                <input class="rounded-full checked:bg-[#60A3BD] checked:text-[#60A3BD] cursor-pointer" type="radio" wire:model="precio" value="mayor">
                            </div>
                            <div class="w-full flex justify-between items-center">
                                <span class="text-xs {{ $precio == 'menor' ? 'text-[#60A3BD] font-semibold' : ''}}">{{ __('Menor precio') }}</span>
                                <input class="rounded-full checked:bg-[#60A3BD] checked:text-[#60A3BD] cursor-pointer" type="radio" wire:model="precio" value="menor">
                            </div>
                        </div>
                    </div>
                    <div class="py-1">
                        <span class="text-xs font-semibold bg-[#3E3E66] w-full text-white block py-2 px-2 rounded-md">
                            {{-- <i class="fa-solid fa-layer-group pr-1"></i> --}} {{ __('Subcategorias') }}
                        </span>
                        <div class="pt-2 space-y-2 px-3">
                            @forelse ($category->subcategories as $subcategory)
                                <div class="w-full flex justify-between items-center">
                                    <span class="text-xs {{ $subcategoria == $subcategory->slug ? 'text-[#60A3BD] font-semibold' : ''}}">{{ $subcategory->name }}</span>
                                    <input class="checked:bg-[#60A3BD] checked:text-[#60A3BD] cursor-pointer" wire:model="subcategoria" type="radio" name="subcategoria" value="{{ $subcategory->slug }}">
                                </div>
                            @empty
                                {{ __('No tiene opciones') }}
                            @endforelse
                        </div>
                    </div>
                    <div class="py-2">
                        <span class="text-xs font-semibold bg-[#3E3E66] w-full text-white block py-2 px-2 rounded-md">
                            {{-- <i class="fa-solid fa-clone pr-1"></i> --}} {{ __('Marcas') }}
                        </span>
                        <div class="pt-2 space-y-2 px-3">
                            @forelse ($category->brands as $brand)
                                <div class="w-full flex justify-between items-center">
                                    <span class="text-xs {{ $marca == $brand->name ? 'text-[#60A3BD] font-semibold' : ''}}">{{ $brand->name }}</span>
                                    <input class="checked:bg-[#60A3BD] checked:text-[#60A3BD] cursor-pointer" wire:model="marca" type="radio" name="marca" value="{{ $brand->name }}">
                                </div>
                            @empty
                                {{ __('No tiene opciones') }}
                            @endforelse
                        </div>
                    </div>
                    <div>
                        @if ($subcategoria || $marca || $precio)
                        <button wire:click="limpiar" class="bg-[#3E3E66] py-2 rounded-md w-full text-white text-xs mt-3 hover:bg-neutral-700 transition duration-500 ease-in-out transform hover:scale-105">
                            <i class="fa-solid fa-trash-can pr-1"></i> {{ __('Borrar Filtros') }}
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1 md:col-span-2 lg:col-span-3">
            {{-- barra de titulo --}}
            <figure class="relative overflow-hidden rounded-md mb-6">
                <img loading="lazy" class="w-full h-60 object-cover transform hover:scale-105 transition duration-300 ease-in-out" src="{{Storage::url($category->image)}}" alt="{{$category->name}}">
            </figure>
            <div class=" bg-white rounded-md p-3 flex justify-between items-center border border-gray-200">
                <div class="uppercase font-semibold">{{$category->name}}</div>
                <div class="grid grid-cols-2 border border-gray-300 divide-x divide-gray-300 rounded-md">
                    <span wire:click="$set('view', 'grid')" class="p-2 cursor-pointer {{$view == 'grid' ? 'bg-[#60A3BD] fill-white' : ''}} active:scale-95 rounded-md rounded-r-none">
                        <svg class="" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M384 96V224H256V96H384zm0 192V416H256V288H384zM192 224H64V96H192V224zM64 288H192V416H64V288zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
                    </span>
                    <span wire:click="$set('view', 'list')" class="p-2 cursor-pointer {{$view == 'list' ? 'bg-[#60A3BD] fill-white' : ''}} active:scale-95 rounded-md rounded-l-none">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z"/></svg>
                    </span>
                </div>
            </div>
            {{-- contenido de los productos --}}
            <div class="bg-white mt-6 rounded-md p-3 border border-gray-200">
               @if ($view == 'grid')
                    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-4 md:gap-y-0 mt-6 md:mt-0">
                        @forelse ($products as $product)
                            <li class="h-72 md:h-64 w-72 md:w-52 mx-auto md:flex md:items-center md:justify-center overflow-hidden">
                                <article class="bg-white hover:border border-gray-300 hover:shadow-md rounded-lg overflow-hidden cursor-pointer w-full">
                                    <figure class="relative overflow-hidden rounded-b-lg">
                                        @if ($product->images->isNotEmpty())
                                            <img loading="lazy" class="w-full h-40 md:h-32 object-cover" src="{{ Storage::url($product->featuredImage()) }}" alt="{{$product->name}}">  
                                        @else
                                            <img loading="lazy" class="w-full h-32 object-cover" src="https://www.pexels.com/es-es/foto/iphone-7-dorado-encima-de-un-libro-al-lado-de-una-macbook-583848/" alt="{{$product->name}}">  
                                        @endif
                                        @if ($product->discount > 0)
                                            <div class="absolute top-0 right-0 px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded-bl-lg w-auto">
                                                @php
                                                    $monto = $product->price - $product->discount;
                                                    $discount = ($monto / $product->price) * 100;
                                                @endphp
                                                - {{ intval($discount) }}%
                                            </div>
                                            <div class="absolute bottom-0 left-0 px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded-tr-lg w-auto">Oferta</div>
                                        @elseIf ($product->destacado)
                                            <div class="absolute bottom-0 left-0 px-2 py-1 bg-[#60A3BD]/50 text-white text-xs rounded-tr-lg w-auto">Destacado</div>
                                        @elseIf($product->nuevo)
                                            <div class="absolute bottom-0 left-0 px-2 py-1 bg-[#60A3BD]/50 text-white text-xs rounded-tr-lg w-auto">Nuevo</div>
                                        @endif
                                    </figure>
                                    <div class="pt-3 px-2">
                                        <h2 class="text-sm font-semibold text-center text-[#60A3BD] line-clamp-1">
                                            {{ Str::limit($product->name, 25) }}
                                        </h2>
                                        <p class="text-center mt-2 font-semibold">
                                            @if ($product->discount > 0)
                                                <span class="mr-4">$ {{$product->discount}}</span>
                                                <span class="text-sm text-red-500 line-through">
                                                    $ {{$product->price}}
                                                </span>
                                            @else
                                                <span class="">$ {{$product->price}}</span>
                                            @endif
                                        </p>
                                        <a href="{{route('products.show', $product)}}" class="border border-[#60A3BD]  font-semibold mb-2 text-xs md:text-sm text-[#60A3BD] text-center rounded-lg shadow px-3 py-2 block mt-2 items-center justify-center">
                                            Ver Producto
                                        </a>
                                    </div>
                                </article>
                            </li>
                        @empty
                            <li class="w-full py-4">Sin resultados</li>
                        @endforelse
                    </ul>
               @else
                   <ul class="space-y-3">
                    @forelse ($products as $product)
                        <li>
                            <article class="grid grid-cols-2 md:grid-cols-4 border border-gray-300 rounded-md overflow-hidden hover:shadow-md group select-none">
                                <figure class="relative overflow-hidden rounded-r-md md:rounded-r-none order-1 md:order-1">
                                    @if ($product->images->isNotEmpty())
                                        <img loading="lazy" class="w-full h-32 object-cover group-hover:scale-110 transition duration-300 ease-in-out" src="{{ Storage::url($product->featuredImage()) }}" alt="{{$product->name}}">  
                                    @else
                                        <img loading="lazy" class=" h-full object-cover" src="https://www.pexels.com/es-es/foto/iphone-7-dorado-encima-de-un-libro-al-lado-de-una-macbook-583848/" alt="{{$product->name}}">  
                                    @endif
                                    @if ($product->discount > 0)
                                        <div class="absolute top-0 right-0 px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded-bl-lg w-auto">
                                            @php
                                                $monto = $product->price - $product->discount;
                                                $discount = ($monto / $product->price) * 100;
                                            @endphp
                                            - {{ intval($discount) }}%
                                        </div>
                                        <div class="absolute bottom-0 left-0 px-2 py-1 bg-red-500 text-white text-xs font-semibold rounded-tr-lg w-auto">Oferta</div>
                                    @elseIf ($product->destacado)
                                        <div class="absolute bottom-0 left-0 px-2 py-1 bg-[#60A3BD] text-white text-xs rounded-tr-lg w-auto">Destacado</div>
                                    @elseIf($product->nuevo)
                                        <div class="absolute bottom-0 left-0 px-2 py-1 bg-[#60A3BD] text-white text-xs rounded-tr-lg w-auto">Nuevo</div>
                                    @endif
                                </figure>
                                <div class="col-span-2 p-2 order-3 md:order-2">
                                    <article class="">
                                        <span class="font-semibold text-[#60A3BD] uppercase">{{$product->name}}</span>
                                        <p class="text-sm pt-2 line-clamp-2 md:line-clamp-4">
                                            {{ $product->description }}
                                        </p>
                                    </article>
                                </div>
                                <div class="p-2 flex flex-col justify-center order-2 md:order-3">
                                    <div class="flex justify-center">
                                        @if ($product->discount > 0)
                                            <span class="mr-4 font-semibold">$ {{$product->discount}}</span>
                                            <span class="text-sm text-red-500 line-through mt-0.5">
                                                $ {{$product->price}}
                                            </span>
                                        @else
                                            <span class="font-semibold">$ {{$product->price}}</span>
                                        @endif
                                    </div>
                                    <div class="pt-2">
                                        <a href="{{route('products.show', $product)}}" class="border border-[#60A3BD]  font-semibold mb-2 text-xs md:text-sm text-[#60A3BD] text-center rounded-lg shadow px-3 py-2 block mt-2 items-center justify-center">
                                            Ver Producto
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </li>
                    @empty
                        <li class="w-full py-4">Sin resultados</li>
                    @endforelse
                   </ul>
               @endif
                @if ($products->hasPages())
                    <div class="pt-3">
                        <hr>
                        <div class="pt-3">
                            <span class="mt-2">{{ $products->links() }}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
                               