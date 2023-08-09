<x-app-layout>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css') }}"integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @endpush
    
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 mb-10">
        <div class="bg-white rounded-md px-5 md:px-8 pt-4 pb-10 mb-4 flex items-center">
            <div class="relative">
                <div class="{{ ($order->status >= 2 && $order->status != 5) ? 'bg-[#60A3BD]' : 'bg-gray-400' }}  rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-1.5 mt-0.5">
                    <p class="text-sm pt-1 font-semibold">Recibido</p>
                </div>
            </div>
            <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-[#60A3BD]' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>
            <div class="relative">
                <div class="{{ ($order->status >= 3 && $order->status != 5) ? 'bg-[#60A3BD]' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="absolute -left-1 mt-0.5">
                    <p class="text-sm pt-1 font-semibold">Enviado</p>
                </div>
            </div>
            <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-[#60A3BD]' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>
            <div class="relative">
                <div class="{{ ($order->status >= 4 && $order->status != 5) ? 'bg-[#60A3BD]' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="absolute -left-2 mt-0.5">
                    <p class="text-sm pt-1 font-semibold">Entregado</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-md p-3 md:p-6 mb-4 flex items-center">
            <p class="text-gray-700 text-sm"><span class="font-semibold">Número de orden:</span> {{ formatOrderNumber($order->id) }}</p>
            <div class="ml-auto">
                @switch($order->status)
                    @case(1)
                        <form class="formulario_cancelar" action="{{route('orders.cancel', $order)}}" method="POST">
                            @csrf
                            <button class="text-xs md:text-sm px-3 py-2 rounded-full border border-red-500 hover:bg-red-500 text-red-500 hover:text-white transition" type="submit">Cancelar Orden</button>
                        </form>

                        @break
                    @case(2)
                        <div>
                            <div class="rounded-full px-2 py-1 text-xs md:text-sm bg-[#60A3BD] text-gray-50">
                                <p class="font-medium text-center">Recibido</p>
                            </div>
                        </div>

                        @break
                    @case(3)
                        <div>
                            <div class="rounded-full px-2 py-1 text-xs md:text-sm bg-green-600 text-gray-50">
                                <p class="font-medium text-center">Enviado</p>
                            </div>
                        </div>

                        @break
                    @case(4)
                        <div>
                            <div class="rounded-full px-2 py-1 text-xs md:text-sm bg-blue-600 text-gray-50">
                                <p class="font-medium text-center">Entregado</p>
                            </div>
                        </div>

                        @break
                    @case(5)
                        <div>
                            <div class="rounded-full px-2 md:px-3 py-2 text-xs md:text-sm bg-gray-500 text-gray-50">
                                <p class="font-medium text-center">Orden cancelada</p>
                            </div>
                        </div>

                        @break
                    @default      
                @endswitch
            </div>
        </div>
        <div class="bg-white rounded-md p-3 md:p-6 mb-4">
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
        <div class="bg-white rounded-md p-3 md:p-6 text-gray-700 mb-4">
            <p class="font-semibold mb-2">Resumen de la orden</p>
            {{-- nueva tabla adaptar --}}
            <div class="overflow-x-auto touch-pan-x">
                <table class="min-w-full divide-y divide-gray-200 rounded-b-md p-1 overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 rounded-md">
                        @foreach ($items as $item)    
                            <tr>
                                <td class="py-1">
                                    <img class="w-12 h-12 shrink-0 rounded-md object-cover mr-4" src="{{ $item->options->image }}" alt="">
                                </td>
                                <td>
                                    <div class="flex items-center">
                                        <article>
                                            <h1 class="font-semibold text-xs md:text-sm uppercase">{{ $item->name }}</h1>
                                            <div class="flex text-xs items-center h-full">
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
                                    <div class="text-xs text-gray-500 flex flex-col">
                                        $ {{ $item->price }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-gray-500 flex flex-col">
                                        {{ $item->qty }}
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="text-xs text-gray-500 flex-col">
                                        <span class="font-medium">
                                            $ {{number_format($item->price * $item->qty, 2, '.', ' ')}}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="py-2 w-full md:w-1/3 mx-auto mt-4 border border-gray-200 rounded-md flex flex-col justify-between px-4 text-sm space-y-2">
                @if ($order->shipping_cost)
                    <div class="flex justify-between">
                        <span class="font-semibold"> Costo de envío: </span> 
                        <span class=""> $ {{ number_format($order->shipping_cost, 2, ',', ' ') }}</span>
                    </div>
                @else
                    
                @endif
                <div class="flex justify-between">
                    <span class="font-semibold">Incluye IVA:</span> 
                    <span class=""> ............</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold">Subtotal:</span>
                    @if ($order->shipping_cost)
                            <span> $ {{ number_format($order->total - $order->shipping_cost, 2, ',', ' ') }}</span>
                    @else
                            <span> $ {{ number_format($order->total, 2, ',', ' ') }}</span>
                    @endif
                </div>
                <hr>
                <div class="flex justify-between">
                    <span class="font-semibold">Total de la orden:</span> 
                    <span> $ {{ number_format($order->total, 2, ',', ' ') }}</span>
                </div>
                
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js') }}" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
        <script>
            $('.formulario_cancelar').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Esta seguro de cancelar la orden?',
                    text: "El proceso es irreversible",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Cancelar esto!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();

                        Swal.fire(
                        'Exito!',
                        'La orden ha sido cancelada exitosamente!',
                        'success'
                        )
                    }
                })
            })
        </script>
    @endpush
</x-app-layout>