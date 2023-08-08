<div class="min-h-screen bg-cover " style="background-image: url('https://images.pexels.com/photos/577517/pexels-photo-577517.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1')">
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    @endpush
    {{-- INICIO SEO --}}
        @section('title', '- CONTACTANOS')
        @section('description', 'Explora nuestra tienda de sistemas eléctricos y electrónicos. Ofrecemos productos, servicios y soluciones innovadoras para tus necesidades eléctricas y electrónicas!')
        @section('url', route('form-contact'))
        @section('img', asset('https://images.pexels.com/photos/577517/pexels-photo-577517.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'))
        @section('type', 'article')
    {{-- FIN SEO --}}
    <div class="min-h-screen bg-black/60">
        <div class="contenedor px-0 md:px-6 pt-4 pb-10 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 mx-4">
                <div class="mt-8 w-full">
                    <h1 class="text-2xl font-semibold capitalize lg:text-3xl text-white">CONSISTELEC</h1>
                    <p class="max-w-xl mt-6 text-gray-200">
                        Te brindamos nuestros datos para que puedas contactarnos cuando gustes.
                    </p>
                    <div class="mt-6 space-y-6 md:mt-8">
                        <p class="flex items-start -mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="mx-2 text-white truncate w-72">
                                {{$settings['address']}}
                            </span>
                        </p>
    
                        <p class="flex items-start -mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="mx-2 text-white truncate w-72">{{$settings['phone1']}}
                                @if ($settings['phone2'])
                                    - {{$settings['phone2']}}
                                @endif
                            </span>
                        </p>
    
                        <p class="flex items-start -mx-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="mx-2 text-white truncate w-72">{{$settings['email1']}}
                                @if ($settings['email2'])
                                    <br>{{$settings['email2']}}
                                @endif
                            </span>
                        </p>
                    </div>
                    <div class="mt-6 md:mt-8">
                        <h3 class="text-gray-300 ">Siguenos</h3>
    
                        <div class="flex mt-4 -mx-1.5 ">
                            @if ($settings['phone2'])
                                @php
                                    $mensaje = "Hola deseo saber mas...";
                                    $mensajeReemplazado = str_replace(' ', '%20', $mensaje);
                                @endphp 
                                <a class="mx-1.5 " href="https://api.whatsapp.com/send?phone={{ $settings['phone2']}}&text={{$mensajeReemplazado}}" target="_blank">
                                    <svg class="w-7 mt-0.5 h-7 fill-white transition-colors duration-300 transform hover:fill-[#60A3BD]"  fill="none" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                </a>
                            @endif
    
                            @if ($settings['facebook'])
                                <a target="_blank" class="mx-1.5 text-white transition-colors duration-300 transform hover:text-[#60A3BD]" href="{{$settings['facebook']}}">
                                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 10.2222V13.7778H9.66667V20H13.2222V13.7778H15.8889L16.7778 10.2222H13.2222V8.44444C13.2222 8.2087 13.3159 7.9826 13.4826 7.81591C13.6493 7.64921 13.8754 7.55556 14.1111 7.55556H16.7778V4H14.1111C12.9324 4 11.8019 4.46825 10.9684 5.30175C10.1349 6.13524 9.66667 7.2657 9.66667 8.44444V10.2222H7Z" fill="currentColor" />
                                    </svg>
                                </a>
                            @endif
    
                            @if ($settings['instagram'])
                                <a target="_blank" class="mx-1.5 text-white transition-colors duration-300 transform hover:text-[#60A3BD]" href="{{$settings['instagram']}}">
                                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.9294 7.72275C9.65868 7.72275 7.82715 9.55428 7.82715 11.825C7.82715 14.0956 9.65868 15.9271 11.9294 15.9271C14.2 15.9271 16.0316 14.0956 16.0316 11.825C16.0316 9.55428 14.2 7.72275 11.9294 7.72275ZM11.9294 14.4919C10.462 14.4919 9.26239 13.2959 9.26239 11.825C9.26239 10.354 10.4584 9.15799 11.9294 9.15799C13.4003 9.15799 14.5963 10.354 14.5963 11.825C14.5963 13.2959 13.3967 14.4919 11.9294 14.4919ZM17.1562 7.55495C17.1562 8.08692 16.7277 8.51178 16.1994 8.51178C15.6674 8.51178 15.2425 8.08335 15.2425 7.55495C15.2425 7.02656 15.671 6.59813 16.1994 6.59813C16.7277 6.59813 17.1562 7.02656 17.1562 7.55495ZM19.8731 8.52606C19.8124 7.24434 19.5197 6.10901 18.5807 5.17361C17.6453 4.23821 16.51 3.94545 15.2282 3.88118C13.9073 3.80621 9.94787 3.80621 8.62689 3.88118C7.34874 3.94188 6.21341 4.23464 5.27444 5.17004C4.33547 6.10544 4.04628 7.24077 3.98201 8.52249C3.90704 9.84347 3.90704 13.8029 3.98201 15.1238C4.04271 16.4056 4.33547 17.5409 5.27444 18.4763C6.21341 19.4117 7.34517 19.7045 8.62689 19.7687C9.94787 19.8437 13.9073 19.8437 15.2282 19.7687C16.51 19.708 17.6453 19.4153 18.5807 18.4763C19.5161 17.5409 19.8089 16.4056 19.8731 15.1238C19.9481 13.8029 19.9481 9.84704 19.8731 8.52606ZM18.1665 16.5412C17.8881 17.241 17.349 17.7801 16.6456 18.0621C15.5924 18.4799 13.0932 18.3835 11.9294 18.3835C10.7655 18.3835 8.26272 18.4763 7.21307 18.0621C6.51331 17.7837 5.9742 17.2446 5.69215 16.5412C5.27444 15.488 5.37083 12.9888 5.37083 11.825C5.37083 10.6611 5.27801 8.15832 5.69215 7.10867C5.97063 6.40891 6.50974 5.8698 7.21307 5.58775C8.26629 5.17004 10.7655 5.26643 11.9294 5.26643C13.0932 5.26643 15.596 5.17361 16.6456 5.58775C17.3454 5.86623 17.8845 6.40534 18.1665 7.10867C18.5843 8.16189 18.4879 10.6611 18.4879 11.825C18.4879 12.9888 18.5843 15.4916 18.1665 16.5412Z" fill="currentColor" />
                                    </svg>
                                </a>
                            @endif
                            
                            @if ($settings['whatsapp'])
                                <a class="mx-1.5 pt-1.5" href="{{$settings['whatsapp']}}" target="_blank">
                                    <svg class="fill-white hover:fill-[#60A3BD] w-5 h-5" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- formulario --}}
                <div class="mt-8 w-full">
                    <div class="w-full px-4 md:px-8 py-5 md:py-10 mx-auto overflow-hidden bg-white shadow-2xl rounded-xl lg:max-w-xl">
                        <h1 class="text-xl font-medium text-gray-700">Formulario de Contacto</h1>
                        <p class="mt-2 text-gray-600 ">
                            Pregúntanos todo y nos encantaría saber de ti
                        </p>

                        <form wire:submit.prevent="saveContact" class="mt-6">
                            <div class="flex-1">
                                <label class="block mb-1 text-sm text-gray-600 font-medium">Nombre completos</label>
                                <input wire:model.defer="name" type="text" placeholder="Edson Vinicio" class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" />
                                @error('name') <span class="text-xs text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex-1 mt-2">
                                <label class="block mb-1 text-sm text-gray-600 font-medium">Correo</label>
                                <input wire:model.defer="email" type="email" placeholder="edson@example.com" class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" />
                                @error('email') <span class="text-xs text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex-1 mt-2">
                                <label class="block mb-1 text-sm text-gray-600 font-medium">Teléfono/Celular</label>
                                <input wire:model.defer="phone" type="text" placeholder="0983935029" class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" />
                                @error('phone') <span class="text-xs text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <div class="w-full mt-2">
                                <label for="mensaje" class="block mb-1 text-sm text-gray-600 font-medium">Mensaje</label>
                                <textarea wire:model.defer="message" id="mensaje" class="text-sm mt-1 w-full rounded-lg border-gray-200 align-top shadow-sm sm:text-sm focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 focus:outline-none focus:ring" rows="3"
                                    placeholder="Mensaje..." >
                                </textarea>
                                @error('message') <span class="text-xs text-red-500 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <button wire:loading.remove type="submit" class="w-full px-6 py-3 mt-6 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-[#60A3BD] rounded-md hover:bg-[#60A3BD]/75 focus:outline-none focus:ring focus:ring-[#60A3BD] focus:ring-opacity-50">
                                Enviar
                            </button>
                            <div wire:loading wire:target="saveContact">
                                <div class="loader" id="loader-6">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="flex justify-center items-center absolute mt-32">
                                        <p class="text-[#3e3e66] text-sm font-semibold text-center relative">Enviando el formulario...</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="max-w-7xl mx-auto bg-white rounded-md mt-6 md:mx-4">
                <div class="text-center py-2 hidden md:block">
                    <span class="font-semibold">Nuestra Ubicación</span>
                </div>
                <iframe class="w-full h-72 rounded-none md:rounded-md rounded-t-none object-cover" src="{{$settings['maps']}}" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
        <script>
            Livewire.on('saved', () => {
                 /* Swal.fire(
                    'Buen trabajo!',
                    'El estado de la orden ha sido actualizada con exito!',
                    'success'
                    ) */
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Formulario enviado exitosamente!',
                    showConfirmButton: false,
                    timer: 2000
                    })
            })
        </script>
    @endpush
</div>