<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <ul class="space-y-3">
            @forelse ($products as $product)
                <li>
                    <article class="grid grid-cols-2 md:grid-cols-4 border border-gray-300 rounded-md overflow-hidden hover:shadow-md group select-none">
                        <figure class="relative overflow-hidden rounded-r-md md:rounded-r-none order-1 md:order-1">
                            @if ($product->images->isNotEmpty())
                                <img loading="lazy" class="w-full h-36 object-cover group-hover:scale-110 transition duration-300 ease-in-out" src="{{ Storage::url($product->featuredImage()) }}" alt="{{$product->name}}">  
                            @else
                                <img loading="lazy" class=" h-full object-cover" src="https://www.pexels.com/es-es/foto/iphone-7-dorado-encima-de-un-libro-al-lado-de-una-macbook-583848/" alt="{{$product->name}}">  
                            @endif
                            @if ($product->discount > 0)
                                <div class="absolute top-0 right-0 px-2 py-1 bg-red-500 text-white text-xs md:text-sm rounded-bl-lg w-auto">
                                    @php
                                        $monto = $product->price - $product->discount;
                                        $discount = ($monto / $product->price) * 100;
                                    @endphp
                                    - {{ intval($discount) }}%
                                </div>
                                <div class="absolute bottom-0 left-0 px-2 py-1 bg-red-500 text-white text-xs md:text-sm rounded-tr-lg w-auto">Oferta</div>
                            @elseIf ($product->destacado)
                                <div class="absolute bottom-0 left-0 px-2 py-1 bg-[#273C99] text-white text-xs md:text-sm rounded-tr-lg w-auto">Destacado</div>
                            @elseIf($product->nuevo)
                                <div class="absolute bottom-0 left-0 px-2 py-1 bg-[#273C99] text-white text-xs md:text-sm rounded-tr-lg w-auto">Nuevo</div>
                            @endif
                        </figure>
                        <div class="col-span-2 p-2 order-3 md:order-2">
                            <span class="font-semibold">{{$product->name}}</span>
                            <p class="text-sm pt-2 block md:hidden">
                                {{ Str::limit($product->description , 50) }}
                            </p>

                            <p class="text-sm pt-2 hidden md:block">
                                {{ Str::limit($product->description , 230) }}
                            </p>
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
                                <a href="{{route('products.show', $product)}}" class="border border-[#273C99]  font-semibold mb-2 text-xs md:text-sm text-[#273C99] text-center rounded-lg shadow px-3 py-2 block mt-2 items-center justify-center">
                                    Ver Producto
                                </a>
                            </div>
                        </div>
                    </article>
                </li>
            @empty
                
            @endforelse
           </ul>
        @if ($products->hasPages())
            <div class="pt-3">
                <hr>
                <div class="pt-3">
                    <span class="mt-2">{{ $products->links() }}</span>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>