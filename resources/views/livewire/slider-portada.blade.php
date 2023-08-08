<div wire:init="loadSlider">
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />        
    @endpush
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
                // Marcar los eventos táctiles y de la rueda del mouse como pasivos
                var swiperContainer = document.querySelector(".mySwiper");
                swiperContainer.addEventListener('touchstart', function(event) {
                    // Marcar el evento táctil como pasivo
                    event.preventDefault();
                }, { passive: true });

                swiperContainer.addEventListener('wheel', function(event) {
                    // Marcar el evento de la rueda del mouse como pasivo
                    event.preventDefault();
                }, { passive: true });
            });
        </script>
    @endpush
    
</div>
