<div wire:init="loadProductO">
    <style>
        .swiper {
            width: 100%;
            height: 100%;
        }
    </style>
    <h2 class="text-lg font-semibold text-center pb-6 text-white">
        MEJORES OFERTAS
    </h2>
    @if (count($productso))
        <div class="swiper mySwiper3">
            <div class="swiper-wrapper pb-2">
                @forelse ($productso as $product)
                    <div class="swiper-slide group hover:shadow-[#60A3BD]/50 rounded-lg object-cover my-2 overflow-hidden {{$loop->last ? '' : 'mr-4'}}">
                        <article class="overflow-hidden">
                            <figure class="relative rounded-b-lg overflow-hidden z-40">
                                <img loading="lazy" class="w-full h-36 object-cover" src="{{Storage::url($product->featuredImage())}}" alt="{{$product->name}}">
                                @if ($product->discount > 0)
                                    <div class="absolute top-0 right-0 px-2 py-1 bg-red-500 text-white text-xs font-bold rounded-bl-lg w-auto">
                                        @php
                                            $monto = $product->price - $product->discount;
                                            $discount = ($monto / $product->price) * 100;
                                        @endphp
                                        - {{ intval($discount) }} %
                                    </div>
                                @endif
                                <div class="absolute bottom-0 left-0 px-2 py-1 bg-red-500 text-white text-xs rounded-tr-lg w-auto">Oferta</div>
                            </figure>
                            <div class="-translate-y-2 bg-white h-full z-30 rounded-b-lg flex flex-col ">
                                <div class="h-full mt-3">
                                    <h2 class="text-sm font-semibold text-center text-[#3E3E66]">
                                        {{ Str::limit($product->name, 25) }}
                                    </h2>
                                    <p class="text-center mt-2 font-semibold">
                                        @if ($product->discount > 0)
                                            <span class="mr-4 text[#3E3E66]">$ {{$product->discount}}</span>
                                            <span class="text-sm text-red-500 line-through">
                                                $ {{$product->price}}
                                            </span>
                                        @else
                                            <span class="text-[#3E3E66]">$ {{$product->price}}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="rounded-b-lg">
                                    <a aria-label="Enlace al producto {{$product->name}}" href="{{route('products.show', $product)}}" class="group-hover:bg-[#3E3E66] group-hover:text-white mx-2 transition-all border border-[#3E3E66] mb-2 text-xs md:text-sm text-[#3E3E66] text-center rounded-lg shadow px-3 py-2 block mt-2 items-center justify-center">
                                        Comprar Producto
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <div>Sin productos por el momento.</div>
                @endforelse
            </div>
            <div class="swiper-pagination translate-y-3.5"></div>
        </div>
    @else 
        <div class="altura-loading">
            <div class="hidden lg:block">
                <div class="flex flex-nowrap">
                    @for ($i = 1; $i <= 5; $i++)
                        <article class=" w-[227px] h-[270px] mr-4 bg-gray-300 rounded-lg">
                            <figure class="relative overflow-hidden rounded-lg">
                                <div class="bg-gray-400 animate-pulse w-full h-36">
                                </div>
                            </figure>
                            <div class="pt-3 px-2">
                                <div class="text-sm font-semibold text-center bg-gray-400 animate-pulse py-2 mx-4">
                                </div>
                                <div class="text-center mt-4 mb-2 font-semibold bg-gray-400 animate-pulse py-2 mx-6">
                                </div>
                                <div class="bg-gray-400 animate-pulse mt-4 h-10 rounded-lg px-3 py-2 items-center justify-center">
                                </div>
                            </div>
                        </article>
                    @endfor
                </div>
            </div>
            <div class="block md:hidden">
                <div class="flex flex-nowrap">
                    <article class=" w-[226px] h-[253px] mr-4 bg-gray-300 rounded-lg">
                        <figure class="relative overflow-hidden rounded-lg">
                            <div class="bg-gray-400 animate-pulse w-full h-32">
                            </div>
                        </figure>
                        <div class="pt-3 px-2">
                            <div class="text-sm font-semibold text-center bg-gray-400 animate-pulse py-2 mx-4">
                            </div>
                            <div class="text-center mt-4 mb-2 font-semibold bg-gray-400 animate-pulse py-2 mx-6">
                            </div>
                            <div class="bg-gray-400 animate-pulse mt-4 h-10 rounded-lg px-3 py-2 items-center justify-center">
                            </div>
                        </div>
                    </article>
                    <article class=" w-[126px] h-[253px] bg-gray-300 rounded-lg">
                        <figure class="relative overflow-hidden rounded-lg">
                            <div class="bg-gray-400 animate-pulse w-full h-32">
                            </div>
                        </figure>
                        <div class="pt-3 pl-2">
                            <div class="text-sm font-semibold text-center bg-gray-400 animate-pulse py-2 ml-4">
                            </div>
                            <div class="text-center mt-4 mb-2 font-semibold bg-gray-400 animate-pulse py-2 ml-6">
                            </div>
                            <div class="bg-gray-400 animate-pulse mt-4 h-10 rounded-l-lg px-3 py-2 items-center justify-end">
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    @endif
</div>
