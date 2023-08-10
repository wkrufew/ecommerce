<div wire:init="loadSlider">
    <style>
        .swiper {
            width: 1216px;
            height: 420px;
        }

        @media (max-width: 768px) {
        .swiper {
            width: 100%;
            height: auto; /* Ajusta la altura para pantallas más pequeñas */
        }
        }

        /* Consulta de medios para pantallas de 1024px o menos */
        @media (max-width: 1024px) {
        .swiper {
            width: 100%;
            height: auto; /* Ajusta la altura para pantallas más pequeñas */
        }
        }

        /* Consulta de medios para pantallas de 1216px o menos */
        @media (max-width: 1216px) {
        .swiper {
            width: 100%;
            height: auto; /* Ajusta la altura para pantallas más pequeñas */
        }
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
        }
        .swiper-pagination-bullet-active{
                width: 10px;
                height: 10px;
                background-color: #60A3BD;
            }
    </style>
    @if (count($sliders))
        <div class="swiper mySwiper1">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide">
                        <a href="{{$slider->url}}" aria-label="Abrir enalce del slider {{$slider->id}}">
                            <img class="w-full md:w-[1216px] h-auto md:h-[425px] object-cover" src="{{ Storage::url($slider->imagen) }}"  alt="{{$slider->url}}" loading="auto" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="">
                <div class="swiper-pagination"></div>
            </div>
        </div>
    @else
        <div class="swiper bg-gray-400 animate-pulse"></div>
    @endif
</div>
