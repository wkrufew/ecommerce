<x-app-layout>
    @push('css')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css" rel="stylesheet">
    @endpush
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8  pt-6 mb-10">
        <div class="bg-white rounded-md px-12 py-8 mb-4 flex items-center">
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
        <div class="bg-white rounded-md px-6 py-4 mb-4 flex items-center">
            <p class="text-gray-700 text-sm"><span class="font-semibold">Número de orden:</span> {{ formatOrderNumber($order->id) }}</p>
            <div class="ml-auto">
                @switch($order->status)
                    @case(1)
                        <form class="formulario_cancelar" action="{{route('orders.cancel', $order)}}" method="POST">
                            @csrf
                            <button class="text-sm px-3 py-2 rounded-full border border-red-500 hover:bg-red-500 text-red-500 hover:text-white transition" type="submit">Cancelar Orden</button>
                        </form>

                        @break
                    @case(2)
                        <div>
                            <div class="rounded-full px-2 py-1  bg-[#60A3BD] text-gray-50">
                                <p class="font-bold text-center">Recibido</p>
                            </div>
                        </div>

                        @break
                    @case(3)
                        <div>
                            <div class="rounded-full px-2 py-1  bg-green-600 text-gray-50">
                                <p class="font-bold text-center">Enviado</p>
                            </div>
                        </div>

                        @break
                    @case(4)
                        <div>
                            <div class="rounded-full px-2 py-1  bg-blue-600 text-gray-50">
                                <p class="font-bold text-center">Entregado</p>
                            </div>
                        </div>

                        @break
                    @case(5)
                        <div>
                            <div class="rounded-full px-2 md:px-3 py-2 text-xs md:text-sm bg-gray-500 text-gray-50">
                                <p class="font-bold text-center">Orden cancelada</p>
                            </div>
                        </div>

                        @break
                    @default      
                @endswitch
            </div>
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
        <div class="bg-white rounded-md p-3 md:p-6 text-gray-700 mb-4">
            <p class="font-semibold mb-2">Resumen de la orden</p>
            {{-- <div class="overflow-auto touch-auto">
                <table class="table-auto w-full touch-auto">
                    <thead>
                        <tr class="text-sm">
                            <th class="min-w-[60px]"></th>
                            <th class="text-left min-w-[200px]">PRODUCTO</th>
                            <th class="min-w-[100px]">PRECIO</th>
                            <th class="min-w-[100px]">CANTIDAD</th>
                            <th class="min-w-[100px]">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
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
                                <td class="text-center text-sm">
                                    ${{ $item->price }}
                                </td>
                                <td class="text-center text-sm">
                                    {{ $item->qty }}
                                </td>
                                <td class="text-center text-sm">
                                    ${{ $item->price * $item->qty }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
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
                    <div class="grid grid-cols-3">
                        <span class="font-semibold col-span-2"> Costo de envío: </span> 
                        <span class="pl-2 md:pl-6"> $ {{ number_format($order->shipping_cost, 2, ',', ' ') }}</span>
                    </div>
                @else
                    
                @endif
                <div class="grid grid-cols-3">
                    <span class="font-semibold col-span-2">Incluye IVA:</span> 
                    <span class="pl-2 md:pl-6"> ............</span>
                </div>
                <div class="grid grid-cols-3">
                    <span class="font-semibold col-span-2">Subtotal:</span>
                    @if ($order->shipping_cost)
                            <span class="pl-2 md:pl-6"> $ {{ number_format($order->total - $order->shipping_cost, 2, ',', ' ') }}</span>
                    @else
                            <span class="pl-2 md:pl-6"> $ {{ number_format($order->total, 2, ',', ' ') }}</span>
                    @endif
                </div>
                <hr>
                <div class="grid grid-cols-3">
                    <span class="font-semibold col-span-2">Total de la orden:</span> 
                    <span class="pl-6"> $ {{ number_format($order->total, 2, ',', ' ') }}</span>
                </div>
                
            </div>
        </div>
    </div>


    @push('script')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
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