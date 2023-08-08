<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    @endpush

    {{-- INICIO SEO --}}
        @section('title', '- ' . $product->name)
        @section('description', $product->description)
        @section('url', route('products.show', $product))
        @section('img', Storage::url($product->featuredImage()))
    
        @section('og-tags')
            @if ($product->discount)
            <meta property="og:price:amount" content="{{$product->discount}}">
            @else
            <meta property="og:price:amount" content="{{$product->price}}">
            @endif
            <meta property="og:price:currency" content="USD">
            <meta property="og:availability" content="in_stock">
        @endsection
    {{-- FIN SEO --}}

    <div class="contenedor pt-4 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class=" order-1">
                <div class="my-3.5 hidden md:flex text-sm font-medium text-gray-500">
                    <span class="mx-1">
                        <a class="hover:text-[#60A3BD]" href="{{route('home') }}">
                            Inicio
                        </a>    
                    </span> /
                    <span class="mx-1"> 
                        <a class="hover:text-[#60A3BD]" href="{{route('categories.show', $product->subcategory->category) }}">
                            {{$product->subcategory->category->name}}
                        </a>
                    </span> / 
                    <span class="mx-1"> 
                        <a class="hover:text-[#60A3BD]" href="{{route('categories.show', $product->subcategory->category) . '?subcategoria=' . $product->subcategory->slug }}">
                            {{$product->subcategory->name}}
                        </a>
                    </span> / 
                    <span class="text-[#60A3BD] ml-1"> {{ $product->name }}</span>
                </div>
                {{-- div de imagenes --}}
                <div class="sticky top-16">
                    <div class="bg-white rounded-md overflow-hidden">
                        <div class="">
                            <figure class="relative overflow-hidden rounded-b-lg">
                                @if ($product->images->isNotEmpty())
                                    <img id="MainImg" loading="lazy" class="w-full h-56 md:h-80 object-cover" src="{{ Storage::url($product->featuredImage()) }}" alt="{{$product->name}}">  
                                    <div class="absolute top-2 right-2 h-10 w-10 bg-[#60A3BD]/50 text-white rounded-full flex justify-center items-center cursor-pointer">
                                        @foreach ($product->images as $img)
                                            <a data-fancybox="gallery" data-src="{{ Storage::url($img->url) }}" data-caption="{{$product->name}}" class=" {{$loop->first ? 'block' : 'hidden'}} {{-- {{$loop->last ? 'rounded-b-md' : ''}} --}}">
                                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                                            </a>
                                        @endforeach
                                    </div>
                                @elseIf ($product->destacado)
                                @else
                                    <img loading="lazy" class=" w-full h-36 object-cover" src="https://www.pexels.com/es-es/foto/iphone-7-dorado-encima-de-un-libro-al-lado-de-una-macbook-583848/" alt="{{$product->name}}">  
                                @endif
                            </figure>
                        </div>     
                        <div class="h-auto flex overflow-x-auto touch-pan-x ml-0 md:ml-0.5 items-center">
                            <ul class="flex my-1 mr-0 md:ml-1 space-x-1 flex-shrink-0 overflow-hidden">
                                 @foreach ($product->images as $img)
                                    <li class="rounded-md overflow-hidden cursor-pointer">
                                            <img loading="lazy" class="w-36 h-20 border-[#60A3BD] object-cover object-center rounded-md small-img" src="{{ Storage::url($img->url) }}" alt="{{$img->id}}" onclick="changeMainImage(this)">  
                                    </li>
                                 @endforeach
                            </ul>
                         </div>
                    </div>
                    <script>
                        function changeMainImage(img) {
                            var mainImg = document.getElementById("MainImg");
                            mainImg.src = img.src;

                            var smallImgs = document.getElementsByClassName("small-img");
                            for (var i = 0; i < smallImgs.length; i++) {
                                smallImgs[i].classList.remove("border-2");
                            }

                            img.classList.add("border-2");
                        }
                    </script>
                    @if ($product->characteristics->count())
                        <div class=" bg-white rounded-md p-4 mt-4 hidden md:block">
                            <h3 class="font-semibold text-lg mb-2">Detalles</h3>
                            <ul class="divide-x  rounded-md">
                                @forelse ($product->characteristics as $caracteristica)
                                    <li class="grid grid-cols-3 text-sm mb-1 overflow-hidden {{$loop->first ? 'rounded-t-md' : ''}} {{$loop->last ? 'rounded-b-md' : ''}}">
                                        <div class="bg-[#74B0CB] p-2 flex items-center text-white">
                                            <span class="font-semibold">{{ $caracteristica->title }}:</span>
                                        </div>
                                        <div class="col-span-2 bg-gray-100  p-2">
                                            <span>{{ $caracteristica->name }}</span>
                                        </div>
                                    </li>
                                @empty
                                    <li>Este articulo no cuenta con caracteristicas</li>
                                @endforelse
                            </ul>
                        </div>
                    @endif
                    {{-- CUENTA DE ESTRELLAS --}}
                    <div class="bg-white rounded-md p-3 mt-4 pl-4 hidden md:block">
                        @php
                            $ratings = $product->reviews->groupBy('rating');
                            $totalRatings = $product->reviews->count();
                        @endphp

                        @for ($i = 5; $i >= 1; $i--)
                            @php
                                $starsCount = isset($ratings[$i]) ? $ratings[$i]->count() : 0;
                                $percentage = ($totalRatings > 0) ? ($starsCount / $totalRatings) * 100 : 0;
                            @endphp

                            <div class="">
                                <span class="font-medium text-sm">{{ $i }} </span>
                                <span>
                                    @for ($j = 1; $j <= 5; $j++)
                                        @if ($j <= $i)
                                            <i class="fas fa-star text-yellow-500"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="font-medium text-sm">{{ $starsCount }} calificaciones ({{ number_format($percentage, 1) }}%)</span>
                            </div>
                        @endfor

                    </div>
                    {{-- CAJA PARA CREAR LA RESEÑA --}}
                    <div id="review" class="hidden md:block">
                        @can('review', $product)
                            <div class=" bg-white rounded-md p-4 mt-4 hidden md:block">
                                <h3 class="font-semibold text-lg mb-2">Reseñas</h3>
                                <form action="{{route('reviews.store', $product)}}" method="POST">
                                    @csrf
                                    
                                    <textarea placeholder="Escriba su reseña..." class="border border-gray-200 rounded-md w-full text-sm" name="comment" id="comment" rows="2"></textarea>
                                    <x-input-error for="comment"/>
                                    <div class="flex items-center justify-between space-x-2" x-data="{rating: 5}">
                                        <div class="flex">
                                            <p class="pr-2 text-sm font-medium">Puntaje</p>
                                            <ul class="flex space-x-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li class="hover:-translate-y-0.5 transition" x-bind:class="rating >= {{$i}} ? 'text-yellow-500' : ''">
                                                        <button type="button" class="focus:outline-none" x-on:click="rating = {{$i}}">
                                                            <i class="fa-solid fa-star"></i>
                                                        </button>
                                                    </li>
                                                @endfor
                                            </ul>
                                            <input type="number" x-model="rating" name="rating" class="hidden">
                                        </div>
                                        <button type="submit" class="mr-auto rounded-full border border-[#60A3BD] text-[#60A3BD] hover:bg-[#60A3BD] hover:text-white transition text-sm px-4 py-2">
                                            Calificar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            @can('verify', $product)
                                <div class="w-full py-3 px-3 bg-white rounded-md mt-4">
                                    <p class="text-sm text-[#60A3BD] text-center text">Gracias por calificar este producto!</p>
                                </div>
                            @else
                                <div class="w-full py-3 px-3 bg-white rounded-md mt-4">
                                    <p class="text-sm text-[#60A3BD]">Debes comprar el producto para poder realizar una calificacion.</p>
                                </div>
                            @endcan
                        @endcan
                    </div>
                    {{-- LISTADO DE RESEÑAS --}}
                    <div class="hidden md:block">
                        @if ($product->reviews->isNotEmpty())
                            <div class=" mt-4">
                                <div class="py-2 px-2 md:py-4 md:px-4 rounded-md bg-white">
                                    {{-- <p class="text-gray-800 text-xs md:text-sm mb-2 font-semibold">Calificaciones: &nbsp;{{ $product->reviews->count() }}</p> --}}
                                    @forelse ($product->reviews->reverse() as $review)
                                        <article class="flex {{$loop->last ? '' : 'mb-4'}} text-gray-800 select-none items-center">
                                            <figure>
                                                <img class="rounded-full h-12 w-12 object-cover shadow-lg border-2 border-white" src="{{$review->user->profile_photo_url}}" alt="">
                                            </figure>
                                            <div class="border border-gray-200 rounded-md overflow-hidden shadow-md flex-1 ml-1">
                                                <div class="px-2 py-2 md:px-4 md:py-3 bg-white relative">
                                                    <p class="text-xs md:text-sm"><b>{{$review->user->name}}</b> <i class="fas fa-star text-yellow-500 ml-2 mr-1"></i>({{$review->rating}})</p>
                                                    <p class="text-xs md:text-sm py-1">{{$review->comment}}</p>
                                                    
                                                    <p class="flex-1 text-gray-500 text-xs"><i class="fas fa-clock text-gray-500 mr-1"></i> {{$review->created_at->diffForHumans() }} </p>
                                                    
                                                    @if ($review->user_id ==  Auth::id())
                                                        <div class="flex absolute right-0 top-0 cursor-pointer">
                            
                                                            <div x-data="{ isOpen: false }" class="relative inline-block">
                                                                <button @click="isOpen = !isOpen" class="relative z-10 block p-1.5 text-nutral-800 border border-transparent rounded-md dark:text-nutral-800 focus:outline-none">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="#000">
                                                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                                    </svg>
                                                                </button>
                                                                <div x-show="isOpen" 
                                                                    @click.away="isOpen = false"
                                                                    x-transition:enter="transition ease-out duration-100"
                                                                    x-transition:enter-start="opacity-0 scale-90"
                                                                    x-transition:enter-end="opacity-100 scale-100"
                                                                    x-transition:leave="transition ease-in duration-100"
                                                                    x-transition:leave-start="opacity-100 scale-100"
                                                                    x-transition:leave-end="opacity-0 scale-90"
                                                                    class="absolute right-0 z-50 w-40 py-1 mt-0.5 origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800 hidden" :class="{'block': isOpen, 'hidden': ! isOpen}">
                                                                    
                                                                    <form class="formulario_eliminar" action="{{ route('reviews.delete', $review) }}" method="POST">
                                                                        @method('delete')
                                                                        @csrf

                                                                        <button type="submit" title="Eliminar" class="w-full px-4 py-1 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                                                            <span  class="text-sm md:text-base font-bold text-gray-400 items-center pr-2"><i class="fas fa-trash-alt text-sm md:text-base"></i></span>
                                                                            Eliminar
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </article>
                                    @empty
                                        
                                    @endforelse
                                </div>
                            </div>
                        @else
                            <div class="w-full p-2 rounded-md bg-white text-sm mt-4">
                                Sin calificaciones por el momento
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-0 md:mt-12 group order-2">
                <div class="bg-white p-4 rounded-md mb-4 relative overflow-hidden">
                    <div class="flex font-semibold text-sm">
                        <div class="font-semibold text-[#60A3BD] uppercase">{{ $product->brand->name }}</div>
                        <div class="ml-4 flex">
                            <span class="pr-1">
                                @if ($product->reviews->avg('rating') == 0)
                                    5
                                @else
                                    {{ round($product->reviews->avg('rating'), 2) }}
                                @endif
                            </span>
                            <svg class="fill-yellow-500 text-sm mt-0.5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            
                            <a href="#review"><span class="ml-4 hover:text-[#60A3BD] text-sm font-medium">{{$product->reviews->count()}} Reseñas</span></a>
                        </div>
                    </div>
                    <h1 class="mt-4 font-semibold text-lg text-[#3E3E66] uppercase">{{ $product->name }}</h1>
                    <p class="my-4 text-sm text-[#3E3E66]">{{ $product->description }}</p>
                    <div class="flex">
                        <p class="text-center font-semibold">
                            @if ($product->discount > 0)
                                <span class="mr-4 text-green-600">$ {{number_format($product->discount, 2, '.', ' ')}}</span>
                                <span class="text-sm text-red-500 line-through">
                                    $ {{number_format($product->price, 2, '.', ' ')}}
                                    
                                </span>
                            @else
                                <span class="text-green-600">$ {{number_format($product->price, 2, '.', ' ')}}</span>
                            @endif
                        </p>
                        <div class="ml-4">
                            @if ($product->discount > 0)
                                @php
                                    $monto = $product->price - $product->discount;
                                    $discount = ($monto / $product->price) * 100;
                                @endphp
                                <div class="px-2 py-1 bg-red-500 text-white text-xs md:text-sm -translate-y-1 rounded-full w-auto">
                                    Ahorras un - {{ intval($discount) }} % 
                                </div>
                            @elseIf ($product->destacado)
                                <div class="px-2 py-1 bg-[#60A3BD] text-white text-xs md:text-sm rounded-full w-auto">
                                    Destacado</div>
                            @elseIf($product->nuevo)
                                <div class="px-2 py-1 bg-[#60A3BD] text-white text-xs md:text-sm rounded-full w-auto">
                                    Nuevo</div>
                            @endif
                        </div>
                    </div>
                    <?php
                        /* function calcularFechaEntrega($dias) {
                            $fechaEntrega = now()->addDay($dias);
                            $diasAdicionales = 0;

                             Si la fecha de entrega cae en un sábado (día 6) o domingo (día 0)
                             agregamos días adicionales para saltar el fin de semana
                            while ($fechaEntrega->dayOfWeek === 0 || $fechaEntrega->dayOfWeek === 6) {
                                $diasAdicionales++;
                                $fechaEntrega = $fechaEntrega->addDay(1);
                            }

                             Agregar días adicionales para saltar el fin de semana
                            $fechaEntrega = $fechaEntrega->addDay($diasAdicionales);

                            return $fechaEntrega->isoFormat('dddd D MMMM')->locale('es')->format('l j F');
                        } */
                    ?> 
                    <div id="myDiv" class="absolute top-0 right-0 bg-[#60A3BD] rounded-l-full transform translate-x-72 transition-transform duration-500 hidden md:block">
                        <div class="px-3 flex items-center">
                            <span class="flex items-center justify-center h-10 w-10 fill-white">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><path d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"/></svg>
                            </span>
                            <div class="ml-1 text-xs">
                                <p class="text-white font-medium"> ENVÍOS A TODO EL ECUADOR</p>
                                {{-- <p class="text-white"><span>Compra hoy y recibe el</span> <span class=" font-semibold">{{ now()->addDay(4)->isoFormat('dddd D MMMM') }} {{ calcularFechaEntrega(4) }}</span></p> --}}
                            </div>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            var myDiv = document.getElementById("myDiv");
                            myDiv.classList.add("translate-x-0");
                            myDiv.classList.remove("translate-x-72");
                        }, 2000);
                    </script>
                </div>
                
                <div class="mt-4 bg-white rounded-md p-4 order-3">
                    @if ($product->subcategory->size)
                        @livewire('add-cart-item-size', ['product' => $product])
                    @elseIf($product->subcategory->color)
                        @livewire('add-cart-item-color', ['product' => $product])
                    @else
                        @livewire('add-cart-item', ['product' => $product])
                    @endif
                </div>
                <div class="mt-4 bg-white rounded-md p-3 flex justify-center select-none order-4 md:hidden">
                    <div class="p-1 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 flex-shrink-0 rounded-full bg-[#60A3BD] fill-white">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><path d="M112 0C85.5 0 64 21.5 64 48V96H16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 272c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 48c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 240c8.8 0 16 7.2 16 16s-7.2 16-16 16H64 16c-8.8 0-16 7.2-16 16s7.2 16 16 16H64 208c8.8 0 16 7.2 16 16s-7.2 16-16 16H64V416c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H112zM544 237.3V256H416V160h50.7L544 237.3zM160 368a48 48 0 1 1 0 96 48 48 0 1 1 0-96zm272 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0z"/></svg>
                        </span>
                        <div class="ml-4 font-semibold text-sm">
                            <p class="text-[#60A3BD] font-medium">SE REALIZA ENVÍOS A TODO EL ECUADOR</p>
                            {{-- <p>Si compras hoy lo recibes el <span class="text-[#60A3BD]"> {{ calcularFechaEntrega(4) }} {{ now()->addDay(4)->locale('es')->format('l j F') }} </span></p> --}}
                        </div>
                    </div>
                </div>
                <div class="mt-4 bg-white rounded-md p-4 text-sm flex">
                    <svg class="fill-[#60A3BD] text-2xl h-full w-12" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><path d="M535 41c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l64 64c4.5 4.5 7 10.6 7 17s-2.5 12.5-7 17l-64 64c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l23-23L384 112c-13.3 0-24-10.7-24-24s10.7-24 24-24l174.1 0L535 41zM105 377l-23 23L256 400c13.3 0 24 10.7 24 24s-10.7 24-24 24L81.9 448l23 23c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L7 441c-4.5-4.5-7-10.6-7-17s2.5-12.5 7-17l64-64c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9zM96 64H337.9c-3.7 7.2-5.9 15.3-5.9 24c0 28.7 23.3 52 52 52l117.4 0c-4 17 .6 35.5 13.8 48.8c20.3 20.3 53.2 20.3 73.5 0L608 169.5V384c0 35.3-28.7 64-64 64H302.1c3.7-7.2 5.9-15.3 5.9-24c0-28.7-23.3-52-52-52l-117.4 0c4-17-.6-35.5-13.8-48.8c-20.3-20.3-53.2-20.3-73.5 0L32 342.5V128c0-35.3 28.7-64 64-64zm64 64H96v64c35.3 0 64-28.7 64-64zM544 320c-35.3 0-64 28.7-64 64h64V320zM320 352a96 96 0 1 0 0-192 96 96 0 1 0 0 192z"/></svg>
                    <span class="pl-4 flex-1 text-gray-700">Se aceptan depositos o transferencias, si se requiere alguna otra forma de pago contactarnos mediante whatsapp.</span>
                </div>
                @if ($product->video)
                    <div class="mt-4 bg-white rounded-md p-4 text-sm">
                        <h3 class="font-semibold text-lg mb-2">Video Instructivo</h3>
                    <iframe class="rounded-md w-full aspect-video" src="{{ $product->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                @endif
                
                @if ($product->ficha)
                    @auth
                        <div class="mt-4 bg-white rounded-md p-4 text-sm">
                            <h3 class="font-semibold text-lg mb-2">Ficha Tecnica</h3>
                            <a class="bg-[#60A3BD] text-white rounded-full py-2 text-center flex justify-center items-center" href="{{$product->ficha}}" target="_blank" rel="noopener noreferrer">
                                <svg class="fill-white pr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                                <span>Descargar</span>
                            </a>
                        </div>
                    @else
                        <div class="mt-4 bg-white rounded-md p-4 text-sm">
                            <h3 class="font-semibold text-lg mb-2">Ficha Tecnica</h3>
                            <a class="bg-[#60A3BD] text-white rounded-full py-2 text-center flex justify-center items-center" href="{{ route('login') }}" target="_blank" rel="noopener noreferrer">
                                <svg class="fill-white pr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                                <span>Descargar</span>
                            </a>
                        </div>
                    @endauth
                @endif       
            </div>
            <div class="block md:hidden order-last">
                <div class=" bg-white rounded-md p-4">
                    <h3 class="font-semibold text-lg mb-2">Detalles</h3>
                    <ul class="divide-x  rounded-md">
                        @forelse ($product->characteristics as $caracteristica)
                            <li class="grid grid-cols-3 text-sm mb-1 overflow-hidden {{$loop->first ? 'rounded-t-md' : ''}} {{$loop->last ? 'rounded-b-md' : ''}}">
                                <div class="bg-[#74B0CB] p-2 flex items-center text-white">
                                    <span class="font-semibold">{{ $caracteristica->title }}:</span>
                                </div>
                                <div class="col-span-2 bg-gray-100  p-2">
                                    <span>{{ $caracteristica->name }}</span>
                                </div>
                            </li>
                        @empty
                            <li>Este articulo no cuenta con caracteristicas</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- CUENTA DE ESTRELLAS --}}
            <div class="bg-white rounded-md p-3 pl-4 block md:hidden order-last">
                @php
                    $ratings = $product->reviews->groupBy('rating');
                    $totalRatings = $product->reviews->count();
                @endphp
                @for ($i = 5; $i >= 1; $i--)
                    @php
                        $starsCount = isset($ratings[$i]) ? $ratings[$i]->count() : 0;
                        $percentage = ($totalRatings > 0) ? ($starsCount / $totalRatings) * 100 : 0;
                    @endphp

                    <div class="">
                        <span class="font-medium text-xs md:text-sm">{{ $i }} </span>
                        <span>
                            @for ($j = 1; $j <= 5; $j++)
                                @if ($j <= $i)
                                    <i class="fas fa-star text-yellow-500"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </span>
                        <span class="font-medium text-xs md:text-sm">{{ $starsCount }} calificaciones ({{ number_format($percentage, 1) }}%)</span>
                    </div>
                @endfor
            </div>
            {{-- caja de de escribir un comentario --}}
            <div id="review" class="block md:hidden order-last">
                @can('review', $product)
                    <div class=" bg-white rounded-md p-4 mt-2  hidden md:block">
                        <h3 class="font-semibold text-lg mb-2">Reseñas</h3>
                        <form action="{{route('reviews.store', $product)}}" method="POST">
                            @csrf
                            
                            <textarea placeholder="Escriba su reseña..." class="border border-gray-200 rounded-md w-full text-sm" name="comment" id="comment" rows="2"></textarea>
                            <x-input-error for="comment"/>
                            <div class="flex items-center justify-between space-x-2" x-data="{rating: 5}">
                                <div class="flex">
                                    <p class="pr-2">Puntaje</p>
                                    <ul class="flex space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <li class="hover:-translate-y-0.5 transition" x-bind:class="rating >= {{$i}} ? 'text-yellow-500' : ''">
                                                <button type="button" class="focus:outline-none" x-on:click="rating = {{$i}}">
                                                    <i class="fa-solid fa-star"></i>
                                                </button>
                                            </li>
                                        @endfor
                                    </ul>
                                    <input type="number" x-model="rating" name="rating" class="hidden">
                                </div>
                                <button type="submit" class="mr-auto rounded-full border border-[#60A3BD] text-[#60A3BD] hover:bg-[#60A3BD] hover:text-white transition text-sm px-4 py-2">
                                    Calificar
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    @can('verify', $product)
                        <div class="w-full py-3 px-3 bg-white rounded-md">
                            <p class="text-sm text-[#60A3BD] text-center text">Gracias por calificar este producto!</p>
                        </div>
                    @else
                        <div class="w-full py-3 px-3 bg-white rounded-md">
                            <p class="text-sm text-[#60A3BD]">Debes comprar el producto para poder realizar una calificacion.</p>
                        </div>
                    @endcan
                @endcan
            </div>
            {{-- listado de comentarios --}}
            <div class="block md:hidden order-last">
                @if ($product->reviews->isNotEmpty())
                    <div class="">
                        <div class="py-2 px-2 md:py-3 md:px-4 bg-white">
                            <p class="text-gray-800 text-xs md:text-sm mb-2 font-semibold">Calificaciones: &nbsp;{{ $product->reviews->count()}}</p>
                            @forelse ($product->reviews as $review)
                                <article class="flex mb-4 text-gray-800 select-none items-center">
                                    <figure>
                                        <img class="rounded-full h-12 w-12 object-cover shadow-lg border-2 border-white" src="{{$review->user->profile_photo_url}}" alt="">
                                    </figure>
                                    <div class="border border-gray-200 rounded-md overflow-hidden shadow-md flex-1 ml-1">
                                        <div class="px-2 py-2 md:px-4 md:py-3 bg-white relative">
                                            <p class="text-xs md:text-sm"><b>{{$review->user->name}}</b> <i class="fas fa-star text-yellow-500 ml-2 mr-1"></i>({{$review->rating}})</p>
                                            <p class="text-xs md:text-sm py-1">{{$review->comment}}</p>
                                            
                                            <p class="flex-1 text-gray-500 text-xs"><i class="fas fa-clock text-gray-500 mr-1"></i> {{$review->created_at->diffForHumans() }} </p>
                                            
                                            @if ($review->user_id ==  Auth::id())
                                                <div class="flex absolute right-0 top-0 cursor-pointer">
                    
                                                    <div x-data="{ isOpen: false }" class="relative inline-block">
                                                        <button @click="isOpen = !isOpen" class="relative z-10 block p-1.5 text-nutral-800 border border-transparent rounded-md dark:text-nutral-800 focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="#000">
                                                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                                            </svg>
                                                        </button>
                                                        <div x-show="isOpen" 
                                                            @click.away="isOpen = false"
                                                            x-transition:enter="transition ease-out duration-100"
                                                            x-transition:enter-start="opacity-0 scale-90"
                                                            x-transition:enter-end="opacity-100 scale-100"
                                                            x-transition:leave="transition ease-in duration-100"
                                                            x-transition:leave-start="opacity-100 scale-100"
                                                            x-transition:leave-end="opacity-0 scale-90"
                                                            class="absolute right-0 z-50 w-40 py-1 mt-0.5 origin-top-right bg-white rounded-md shadow-xl dark:bg-gray-800 hidden" :class="{'block': isOpen, 'hidden': ! isOpen}">
                                                            
                                                            <form class="formulario_eliminar" action="{{ route('reviews.delete', $review) }}" method="POST">
                                                                @method('delete')
                                                                @csrf

                                                                <button type="submit" title="Eliminar" class="w-full px-4 py-1 text-sm text-gray-600 capitalize transition-colors duration-300 transform dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">
                                                                    <span  class="text-sm md:text-base font-bold text-gray-400 items-center pr-2"><i class="fas fa-trash-alt text-sm md:text-base"></i></span>
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @empty
                                
                            @endforelse
                        </div>
                    </div>
                @else
                    <div class="w-full p-2 rounded-md bg-white text-sm">
                        Sin calificaciones por el momento
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>

        Fancybox.bind("[data-fancybox]", {
                    contentClick: "iterateZoom",
                    Images: {
                        Panzoom: {
                        maxScale: 2,
                        },
                    },
                });
            
            @if (Session::has('exito'))
                Swal.fire({
                    position: 'top-end',
                    width: 400,
                    /* background: '#333333', */
                    toast: true,
                    timerProgressBar: true,
                    icon: 'success',
                    title: '{{ session('exito') }}',
                    showConfirmButton: false,
                    timer: 4000
                })
            @endif

            $('.formulario_eliminar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Esta seguro eliminar este comentario?',
                    text: "El comentario será eliminado permanentemente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar esto!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            })
        </script>
    @endpush
</x-app-layout>
