<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">
        <div class="relative">
            <div class="{{ ($order->status >= 1 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fa-solid fa-money-bill-transfer text-white"></i>
            </div>

            <div class="absolute -left-1.5 mt-0.5">
                <p>Pendiente</p>
            </div>
        </div>
        <div class="{{ ($order->status >= 2 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>
        <div class="relative">
            <div class="{{ ($order->status >= 2 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>

            <div class="absolute -left-1.5 mt-0.5">
                <p>Recibido</p>
            </div>
        </div>

        <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

        <div class="relative">
            <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-truck text-white"></i>
            </div>

            <div class="absolute -left-1 mt-0.5">
                <p>Enviado</p>
            </div>
        </div>

        <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>
        <div class="relative">
            <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-blue-400' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                <i class="fas fa-check text-white"></i>
            </div>

            <div class="absolute -left-2 mt-0.5">
                <p>Entregado</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
        <p class="text-gray-700 uppercase"><span class="font-semibold">Número de orden:</span>
            {{ formatOrderNumber($order->id) }}
        </p>

        <form wire:submit.prevent="estado">
            <div class="flex space-x-3 mt-2">
                <x-label>
                    <input type="radio" wire:model="status" value="1" class="mr-2">
                    PENDIENTE
                </x-label>

                <x-label>
                    <input type="radio" wire:model="status" value="2" class="mr-2">
                    RECIBIDO
                </x-label>

                <x-label>
                    <input type="radio" wire:model="status" value="3" class="mr-2">
                    ENVIADO
                </x-label>

                <x-label>
                    <input type="radio" wire:model="status" value="4" class="mr-2">
                    ENTREGADO
                </x-label>
                @if ($order->status != 4)
                    <x-label>
                        <input type="radio" wire:model="status" value="5" class="mr-2">
                        ANULADO
                    </x-label>
                @endif
            </div>

            <div class="flex mt-2">
                <x-action-message class="mr-3" on="saved">
                    Actualizado
                </x-action-message>
                
                @if ($order->status != 5)
                    <div class="ml-auto">
                        <div class="font-medium text-sm" wire:loading wire:target="estado">
                            Cambiando de estado...
                        </div>
                        <x-button class="ml-auto" wire:loading.remove wire:target="estado">
                            Actualizar
                        </x-button>
                    </div>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-md p-6 mb-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <div>
                @if ($order->envio_type == 1)
                    <p class="text-sm font-semibold uppercase text-[#60A3BD]">Recoger en tienda</p>
                    <p class="text-sm"><span class="font-semibold">Direccion: </span> {{ $settings['address']}}</p>
                @else
                    <p class="text-sm font-semibold uppercase text-[#60A3BD]">Dirección de envío</p>
                    <p class="text-sm">{{ $envio->department }} - {{ $envio->city }} - {{ $envio->district }} </p>
                    <p class="text-sm"><span class="font-semibold">Dirección: </span> {{ $envio->address }}</p>
                    <p class="text-sm"><span class="font-semibold">Referencia: </span> {{ $envio->references }}</p>
                @endif
            </div>
            <div>
                <p class="text-sm font-semibold uppercase text-[#60A3BD]">Datos de contacto</p>
                <p class="text-sm"><span class="font-semibold">Persona: </span> {{ $order->contact }}</p>
                <p class="text-sm"><span class="font-semibold">Teléfono: </span> {{ $order->phone }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 text-gray-700 mb-6 overflow-x-auto touch-pan-x">
        <p class="text-xl font-semibold mb-4">Resumen</p>
        <table class="min-w-full divide-y divide-gray-200 overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">foto</span>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Precio
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Cantidad
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total
                    </th>   

                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <img class="h-15 w-20 object-cover mr-4 rounded-md" src="{{ $item->options->image }}"
                                    alt="">
                                <article>
                                    <h1 class="font-bold">{{ $item->name }}</h1>
                                    <div class="flex text-xs">

                                        @isset($item->options->color)
                                            Color: {{ __($item->options->color) }}
                                        @endisset

                                        @isset($item->options->size)
                                            - {{ $item->options->size }}
                                        @endisset
                                    </div>
                                </article>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                $ {{ $item->price }} 
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                {{ $item->qty }} 
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                $ {{ $item->qty * $item->price }} 
                            </div>
                        </td>
                    </tr>

                @endforeach
                <!-- More people... -->
            </tbody>
        </table>

        <div class="py-2">
            <hr>
        </div>
        <div class="py-2 w-2/3 md:w-1/3 mx-auto mt-2 border border-gray-200 rounded-md flex flex-col justify-between px-4 text-sm space-y-2">
            @if ($order->shipping_cost)
                <div class="grid grid-cols-3">
                    <span class="font-semibold col-span-2"> Costo de envío: </span> 
                    <span class="pl-6"> $ {{ number_format($order->shipping_cost, 2, '.', ' ') }}</span>
                </div>
            @else
                
            @endif
            <div class="grid grid-cols-3">
                <span class="font-semibold col-span-2">Incluye IVA:</span> 
                <span class="pl-6"> ............</span>
            </div>
            <div class="grid grid-cols-3">
                <span class="font-semibold col-span-2">Subtotal:</span>
                @if ($order->shipping_cost)
                        <span class="pl-6"> $ {{ number_format($order->total - $order->shipping_cost, 2, '.', ' ') }}</span>
                @else
                        <span class="pl-6"> $ {{ number_format($order->total, 2, ',', ' ') }}</span>
                @endif
            </div>
            <hr>
            <div class="grid grid-cols-3">
                <span class="font-semibold col-span-2">Total de la orden:</span> 
                <span class="pl-6"> $ {{ number_format($order->total, 2, '.', ' ') }}</span>
            </div>
            
        </div>
    </div>

    @push('script')
        <script>
            Livewire.on('estadoError', () => {
                 Swal.fire(
                    'Detente!',
                    'Para actualizar debes elegir un estado diferente!',
                    'warning'
                    )
            })

            Livewire.on('estadoError1', () => {
                 Swal.fire(
                    'Detente!',
                    'No puedes regresar una orden a pendiente luego de haber aceptado el pago!',
                    'warning'
                    )
            })
            
            Livewire.on('saved', () => {
                 Swal.fire(
                    'Buen trabajo!',
                    'El estado de la orden ha sido actualizada con exito!',
                    'success'
                    )
            })
        </script>
    @endpush
</div>