<div wire:init="loadSlider">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
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
                width: 11px;
                height: 11px;
                background-color: #3E3E66;
            }
    </style>
    @if (count($sliders))
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide">
                        <a href="{{$slider->url}}">
                            <img src="{{ Storage::url($slider->imagen) }}" loading="lazy" />
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
        <div class="swiper bg-gray-400 animate-pulse">

        </div>
    @endif

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <!-- Initialize Swiper -->
        <script>
            Livewire.on('swiper', function() {
                var swiper = new Swiper(".mySwiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                spaceBetween: 30,
                loop: true,
                effect: "fade",
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    type: 'bullets',
                    clickable: true,
                },
            });
        });
        </script>
    @endpush
    
</div>
