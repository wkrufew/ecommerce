<x-admin-layout>

    <div class="contenedor py-12">

        <section class="grid grid-cols-5 gap-6 text-white">

            <a href="{{ route('admin.orders.index') . "?status=1" }}" class="bg-gray-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$pendiente}}
                </p>
                <p class="uppercase text-center">Pendiente</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fa-solid fa-exclamation"></i>
                </p>
            </a>
           
            <a href="{{ route('admin.orders.index') . "?status=2" }}" class="bg-[#60A3BD] bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$recibido}}
                </p>
                <p class="uppercase text-center">Recibido</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . "?status=3" }}" class="bg-green-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$enviado}}
                </p>
                <p class="uppercase text-center">Enviado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . "?status=4" }}" class="bg-blue-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$entregado}}
                </p>
                <p class="uppercase text-center">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . "?status=5" }}" class="bg-red-500 bg-opacity-75 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{$anulado}}
                </p>
                <p class="uppercase text-center">Anulado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        @if ($orders->count())
        
            <section class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <h1 class="text-2xl mb-4">Pedidos recientes</h1>

                <ul>
                    @foreach ($orders as $order)
                        <li>
                            <a href="{{route('admin.orders.show', $order)}}" class="flex items-center py-2 px-4 hover:bg-gray-100">
                                <span class="w-12 text-center">
                                    @switch($order->status)
                                        @case(1)
                                            <i class="fas fa-business-time text-gray-500 opacity-50"></i>
                                            @break
                                        @case(2)
                                            <i class="fas fa-credit-card text-[#60A3BD] opacity-50"></i>
                                            @break
                                        @case(3)
                                            <i class="fas fa-truck text-green-500 opacity-50"></i>
                                            @break
                                        @case(4)
                                            <i class="fas fa-check-circle text-blue-500 opacity-50"></i>
                                            @break
                                        @case(5)
                                            <i class="fas fa-times-circle text-red-500 opacity-50"></i>
                                            @break
                                        @default
                                            
                                    @endswitch
                                </span>

                                <span>
                                    Orden: {{ formatOrderNumber($order->id) }}
                                    <br>
                                    {{$order->created_at->format('d/m/Y')}}
                                </span>


                                <div class="ml-auto">
                                    <span class="font-bold">
                                        @switch($order->status)
                                            @case(1)
                                                
                                                Pendiente

                                                @break
                                            @case(2)
                                                
                                                Recibido

                                                @break
                                            @case(3)
                                                
                                                Enviado

                                                @break
                                            @case(4)
                                                
                                                Entregado

                                                @break
                                            @case(5)
                                                
                                                Anulado

                                                @break
                                            @default
                                                
                                        @endswitch
                                    </span>

                                    <br>

                                    <span class="text-sm">
                                        $ {{$order->total}}
                                    </span>
                                </div>

                                <span>
                                    <i class="fas fa-angle-right ml-6"></i>
                                </span>

                            </a>
                        </li>
                    @endforeach
                </ul>
            </section>

        @else
            <div class="bg-white shadow-lg rounded-lg px-12 py-8 mt-12 text-gray-700">
                <span class="font-bold text-lg">
                    No existe registros de ordenes
                </span>
            </div>
        @endif

    </div>

</x-admin-layout>