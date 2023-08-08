<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>
    @endpush
    <div class="contenedor py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class=" order-1">
                <div class="my-3.5 hidden md:flex text-sm font-medium text-gray-500">
                    <span class="mx-1">
                        <a class="hover:text-[#60A3BD]" href="{{route('home') }}">
                            Inicio
                        </a>    
                    </span> /
                    <span class="mx-1"> 
                        <a class="hover:text-[#60A3BD]" href="{{route('services.index' ) }}">
                            Nuestros Servicios
                        </a>
                    </span> / 
                    <span class="text-[#60A3BD] ml-1"> {{ $service->title }}</span>
                </div>
                {{-- div de imagenes --}}
                <div class="sticky top-16">
                    <div class="bg-white rounded-md overflow-hidden">
                        <div class="">
                            <figure class="relative overflow-hidden rounded-b-lg">
                                @if ($service->images->isNotEmpty())
                                    <img id="MainImg" loading="lazy" class="w-full h-56 md:h-80 object-cover" src="{{ Storage::url($service->featuredImage()) }}" alt="{{$service->name}}">  
                                    @foreach ($service->images as $img)
                                        <a data-fancybox="gallery" data-src="{{ Storage::url($img->url) }}" data-caption="{{$service->title}}" class=" {{$loop->first ? 'block' : 'hidden'}} {{-- {{$loop->last ? 'rounded-b-md' : ''}} --}}">
                                            <div class="absolute top-2 right-2 h-10 w-10 bg-[#60A3BD]/50 text-white rounded-full flex justify-center items-center cursor-pointer">
                                                <svg class="fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <img loading="lazy" class=" w-full h-36 object-cover" src="https://www.pexels.com/es-es/foto/iphone-7-dorado-encima-de-un-libro-al-lado-de-una-macbook-583848/" alt="{{$product->name}}">  
                                @endif
                            </figure>
                        </div>     
                        <div class="h-auto flex overflow-x-auto touch-pan-x ml-0 md:ml-0.5 items-center">
                            <ul class="flex my-1 mr-0 md:ml-1 space-x-1 flex-shrink-0 overflow-hidden">
                                 @foreach ($service->images as $img)
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
                </div>
            </div>
            <div class="mt-0 md:mt-12 group order-2">
                <div class="bg-white p-4 rounded-md mb-4 relative overflow-hidden">
                    <div class="flex text-sm justify-between text-gray-500">
                        <span>
                            @if (($service->created_at >= $service->updated_at) || ($service->updated_at == NULL))
                                Creado el {{$service->created_at->isoFormat('dddd D MMMM YYYY')}}
                            @else
                                Actualizado el  {{$service->updated_at->isoFormat('dddd D MMMM YYYY')}}
                            @endif
                        </span>
                        <div>
                           <span class="font-semibold">CEO: </span> {{$settings['ceo']}}
                        </div>
                    </div>
                    <h1 class="mt-4 font-semibold text-lg uppercase text-center text-[#60A3BD]">{{ $service->title }}</h1>
                    <h2 class="mt-4 text-base font-medium text-[#3E3E66]">{{ $service->subtitle }}</h2>
                    <p class="my-4 text-sm text-[#3E3E66]">{!! $service->description !!}</p>

                    @php
                        $mensaje = "Hola deseo mas informacion sobre el servicio *" . $service->title . "* ";
                        $mensajeReemplazado = str_replace(' ', '%20', $mensaje);
                    @endphp 
                    <a class="px-4 py-2 w-48 mt-6 mx-auto flex justify-center items-center rounded-full border border-[#60A3BD] text-[#60A3BD] hover:text-white hover:bg-[#60A3BD]" href="https://api.whatsapp.com/send?phone={{$settings['phone2']}}&text={{$mensajeReemplazado}}" target="_blank" rel="noopener noreferrer">
                        Solicitar Información
                    </a>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script>

        Fancybox.bind("[data-fancybox]", {
                    contentClick: "iterateZoom",
                    Images: {
                        Panzoom: {
                        maxScale: 2,
                        },
                    },
                });
        </script>
    @endpush
</x-app-layout>