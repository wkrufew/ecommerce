<footer class="bg-[#3E3E66] relative rounded-t-lg -mt-3">
    <div class="container px-6 py-8 mx-auto">
        <div class="flex flex-col items-center text-center">
            <div class="shrink-0 flex items-center">
                <a aria-label="Enlace al inicio de la pagina" href="/">
                    {{-- <x-application-mark class="block h-9 w-auto fill-red-500"/> --}}
                    <span class="font-bold text-xl text-white ">
                        CONSISTELEC
                    </span>
                </a>
            </div>

            <p class="max-w-xl mx-auto mt-4 text-white text-sm">
                Empresa dedicada a la venta, diseño e implementación de sistemas eléctricos-electrónicos
            </p>
            
            <div class="flex sm:items-center sm:justify-center space-x-4 mt-4">
                @if (isset($settings['facebook']))
                    <span class="flex items-center justify-center">
                        <a aria-label="Enlace a facebook" href="{{ $settings['facebook']}}" target="_blank" rel="noopener noreferrer" >
                            <svg class="fill-white hover:fill-[#60A3BD] w-6 h-6" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"/></svg>
                        </a>
                    </span>
                @endif

                @if (isset($settings['instagram']))
                    <span class="flex items-center justify-center">
                        <a aria-label="Enlace a instagram" href="{{ $settings['instagram']}}" target="_blank" rel="noopener noreferrer">
                            <svg class="fill-white hover:fill-[#60A3BD] w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224,202.66A53.34,53.34,0,1,0,277.36,256,53.38,53.38,0,0,0,224,202.66Zm124.71-41a54,54,0,0,0-30.41-30.41c-21-8.29-71-6.43-94.3-6.43s-73.25-1.93-94.31,6.43a54,54,0,0,0-30.41,30.41c-8.28,21-6.43,71.05-6.43,94.33S91,329.26,99.32,350.33a54,54,0,0,0,30.41,30.41c21,8.29,71,6.43,94.31,6.43s73.24,1.93,94.3-6.43a54,54,0,0,0,30.41-30.41c8.35-21,6.43-71.05,6.43-94.33S357.1,182.74,348.75,161.67ZM224,338a82,82,0,1,1,82-82A81.9,81.9,0,0,1,224,338Zm85.38-148.3a19.14,19.14,0,1,1,19.13-19.14A19.1,19.1,0,0,1,309.42,189.74ZM400,32H48A48,48,0,0,0,0,80V432a48,48,0,0,0,48,48H400a48,48,0,0,0,48-48V80A48,48,0,0,0,400,32ZM382.88,322c-1.29,25.63-7.14,48.34-25.85,67s-41.4,24.63-67,25.85c-26.41,1.49-105.59,1.49-132,0-25.63-1.29-48.26-7.15-67-25.85s-24.63-41.42-25.85-67c-1.49-26.42-1.49-105.61,0-132,1.29-25.63,7.07-48.34,25.85-67s41.47-24.56,67-25.78c26.41-1.49,105.59-1.49,132,0,25.63,1.29,48.33,7.15,67,25.85s24.63,41.42,25.85,67.05C384.37,216.44,384.37,295.56,382.88,322Z"/></svg>    
                        </a>
                    </span>
                @endif

                @if (isset($settings['phone2']))
                    <span class="flex items-center justify-center">
                        @php
                            $mensaje = "Hola deseo saber mas...";
                            $mensajeReemplazado = str_replace(' ', '%20', $mensaje);
                        @endphp
                        <a aria-label="Enlace a whatsapp" href="https://api.whatsapp.com/send?phone={{ $settings['phone2']}}&text={{$mensajeReemplazado}}" target="_blank" rel="noopener noreferrer">
                            <svg class="fill-white hover:fill-[#60A3BD] w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 122.8c-72.7 0-131.8 59.1-131.9 131.8 0 24.9 7 49.2 20.2 70.1l3.1 5-13.3 48.6 49.9-13.1 4.8 2.9c20.2 12 43.4 18.4 67.1 18.4h.1c72.6 0 133.3-59.1 133.3-131.8 0-35.2-15.2-68.3-40.1-93.2-25-25-58-38.7-93.2-38.7zm77.5 188.4c-3.3 9.3-19.1 17.7-26.7 18.8-12.6 1.9-22.4.9-47.5-9.9-39.7-17.2-65.7-57.2-67.7-59.8-2-2.6-16.2-21.5-16.2-41s10.2-29.1 13.9-33.1c3.6-4 7.9-5 10.6-5 2.6 0 5.3 0 7.6.1 2.4.1 5.7-.9 8.9 6.8 3.3 7.9 11.2 27.4 12.2 29.4s1.7 4.3.3 6.9c-7.6 15.2-15.7 14.6-11.6 21.6 15.3 26.3 30.6 35.4 53.9 47.1 4 2 6.3 1.7 8.6-1 2.3-2.6 9.9-11.6 12.5-15.5 2.6-4 5.3-3.3 8.9-2 3.6 1.3 23.1 10.9 27.1 12.9s6.6 3 7.6 4.6c.9 1.9.9 9.9-2.4 19.1zM400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zM223.9 413.2c-26.6 0-52.7-6.7-75.8-19.3L64 416l22.5-82.2c-13.9-24-21.2-51.3-21.2-79.3C65.4 167.1 136.5 96 223.9 96c42.4 0 82.2 16.5 112.2 46.5 29.9 30 47.9 69.8 47.9 112.2 0 87.4-72.7 158.5-160.1 158.5z"/></svg>    
                        </a>
                    </span>
                @endif

                @if (isset($settings['whatsapp']))
                    <span class="flex items-center justify-center">
                        <a aria-label="Enlace a tiktok" href="{{ $settings['whatsapp']}}" target="_blank" rel="noopener noreferrer">
                            <svg class="fill-white hover:fill-[#60A3BD] w-5 h-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                        </a>
                    </span>
                @endif                
            </div>
        </div>

        <hr class="my-5 md:my-10 border-gray-200" />

        <div class="flex flex-col items-center sm:flex-row sm:justify-between">
            <p class="text-xs md:text-sm text-white">© Copyright {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>

            <div class="flex mt-3 -mx-2 sm:mt-0">
                <a aria-label="Enlace a facebook ded desarrollador del sitio web Smith Aviles" href="https://www.facebook.com/smith.aviles3" target="_blank" class="mx-2 text-xs md:text-sm text-white transition-colors duration-300 hover:text-[#60A3BD]" aria-label="Reddit"> <b>Desarrollador:</b> Ing. Smith Aviles </a>
            </div>
        </div>
    </div>
</footer>