<div>
    <div class="contenedor pt-6 pb-10 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">
        <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="mb-4">
                    <x-label value="Nombre de contácto" />
                    <x-input type="text" wire:model.defer="contact"
                        placeholder="Ingrese el nombre de la persona que recibirá el producto" class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" />
                    <x-input-error for="contact" />
                </div>
                <div>
                    <x-label value="Teléfono de contacto" />
                    <x-input type="text" wire:model.defer="phone"
                        placeholder="Ingrese un número de telefono de contácto" class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" />
                    <x-input-error for="phone" />
                </div>
            </div>
            <div x-data="{ envio_type: @entangle('envio_type') }">
                <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>

                <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4 cursor-pointer">
                    <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Recojo en tienda ({{$settings['address']}})
                    </span>

                    <span class="font-semibold text-gray-700 ml-auto">
                        Gratis
                    </span>
                </label>

                <div class="bg-white rounded-lg shadow">
                    <label class="px-6 py-4 flex items-center cursor-pointer">
                        <input x-model="envio_type" type="radio" value="2" name="envio_type"
                            class="text-gray-600">
                        <span class="ml-2 text-gray-700">
                            Envío a domicilio
                        </span>

                    </label>

                    <div class="px-6 pb-6 grid grid-cols-2 gap-6" :class="{ 'hidden': envio_type != 2 }">

                        {{-- Provincia --}}
                        <div>
                            <x-label value="Departamento" />

                            <select class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" wire:model="department_id">

                                <option value="" disabled selected>Seleccione una Provincia</option>

                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>

                            <x-input-error for="department_id" />
                        </div>

                        {{-- Canton --}}
                        <div>
                            <x-label value="Ciudad" />

                            <select class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" wire:model="city_id">

                                <option value="" disabled selected>Seleccione un Cantón</option>

                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>

                            <x-input-error for="city_id" />
                        </div>


                        {{-- Parroquias --}}
                        <div>
                            <x-label value="Parroquia" />

                            <select class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 dark:focus:border-[#60A3BD] focus:outline-none focus:ring" wire:model="district_id">

                                <option value="" disabled selected>Seleccione una Parróquia</option>

                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>

                            <x-input-error for="district_id" />
                        </div>

                        <div>
                            <x-label value="Dirección" />
                            <x-input class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 focus:outline-none focus:ring" wire:model="address" type="text" />
                            <x-input-error for="address" />
                        </div>

                        <div class="col-span-2">
                            <x-label value="Referencia/Información adicional" />
                            <x-input class="text-sm block w-full px-5 py-3 mt-1 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-[#60A3BD] focus:ring-[#60A3BD] focus:ring-opacity-40 focus:outline-none focus:ring" wire:model="references" type="text" />
                            <x-input-error for="references" />
                        </div>

                    </div>
                </div>

            </div>
            <div>
                <hr>
                <p class="text-xs text-gray-500 mt-6">Las compras realizadas entran en un tipo de reserva hasta que ud cancele la orden mediente deposito o transferencia
                    pasos y detalles seran enviados automaticamente a su correo, gracias por preferirnos y confiar en nosotros. <a href=""
                        class="font-semibold text-[#60A3BD]">Políticas y privacidad</a></p>
            </div>

        </div>
        <div class="order-1 lg:order-2 lg:col-span-1 xl:col-span-2 h-full">
            <div class="bg-white rounded-lg shadow p-6 sticky top-16">
                <ul>
                    @forelse (Cart::content() as $item)
                        <li class="flex p-1 border border-gray-200 rounded-md">
                            <img class="h-16 w-24 object-cover rounded-md mr-4" src="{{ $item->options->image }}" alt="">

                            <article class="flex-1">
                                <h1 class="font-bold">{{ $item->name }}</h1>

                                <div class="flex text-sm">
                                    <p>Cant: {{ $item->qty }}</p>
                                    @isset($item->options['color'])
                                        <p class="mx-2 text-sm">- Color: {{ __($item->options['color']) }}</p>
                                    @endisset

                                    @isset($item->options['size'])
                                        <p class=" text-sm">- {{ $item->options['size'] }}</p>
                                    @endisset

                                </div>

                                <p class="font-semibold text-sm">$ {{ $item->price }}</p>
                            </article>
                        </li>
                    @empty
                        <li class="py-6 px-4">
                            <p class="text-center text-gray-700">
                                No tiene agregado ningún producto en el carrito
                            </p>
                        </li>
                    @endforelse
                </ul>
                <hr class="mt-4 mb-3">
                <div class="text-gray-700">
                    <p class="flex justify-between items-center">
                        Subtotal
                        <span class="font-semibold">$ {{ Cart::subtotal() }}</span>
                    </p>
                    <p class="flex justify-between items-center">
                        Envío
                        <span class="font-semibold">
                            @if ($envio_type == 1 || $shipping_cost == 0)
                                Gratis
                            @else
                                $ {{ $shipping_cost }} 
                            @endif
                        </span>
                    </p>
                    <hr class="mt-4 mb-3">
                    <p class="flex justify-between items-center font-semibold">
                        <span class="text-lg">Total</span>
                        <span class="text-[#60A3BD]">
                            @if ($envio_type == 1)
                                $ {{ Cart::subtotal() }}
                            @else
                                $ {{ Cart::subtotal() + $shipping_cost }}
                            @endif
                        </span>
                    </p>
                </div>
                <div>
                    <button wire:click="create_order" wire:loading.remove {{-- wire:loading.attr="disabled" --}} wire:target="create_order" class="mt-6 inline-block w-full rounded-full bg-[#60A3BD] text-white px-4 py-2">
                        Comprar Ahora
                    </button>
                    <div wire:loading wire:target="create_order">
                        <div class="loader" id="loader-6">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <div class="flex justify-center items-center absolute mt-32">
                                <p class="text-[#3e3e66] text-sm font-semibold text-center relative">Creando Orden...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
