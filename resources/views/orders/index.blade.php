<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css') }}"integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @endpush
    <div class="max-w-5xl mx-auto px-4 pt-6 mb-10">
        <section class="grid grid-cols-3 md:grid-cols-5 gap-4 md:gap-6 text-white">
            <a href="{{ route('orders.index') . "?status=1" }}" class="bg-gray-500 bg-opacity-75 rounded-lg px-2 md:px-12 pt-4 md:pt-6 pb-2 md:pb-4">
                <p class="text-center text-lg">
                    {{$pendiente}}
                </p>
                <p class="uppercase text-sm font-semibold text-center">Pendiente</p>
                <p class="text-center text-lg mt-2">
                    <i class="fas fa-business-time"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=2" }}" class="bg-[#60A3BD] bg-opacity-75 rounded-lg px-2 md:px-12 pt-4 md:pt-6 pb-2 md:pb-4">
                <p class="text-center text-lg">
                    {{$recibido}}
                </p>
                <p class="uppercase text-sm font-semibold text-center">Recibido</p>
                <p class="text-center text-lg mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=3" }}" class="bg-green-500 bg-opacity-75 rounded-lg px-2 md:px-12 pt-4 md:pt-6 pb-2 md:pb-4">
                <p class="text-center text-lg">
                    {{$enviado}}
                </p>
                <p class="uppercase text-sm font-semibold text-center">Enviado</p>
                <p class="text-center text-lg mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=4" }}" class="bg-blue-500 bg-opacity-75 rounded-lg px-2 md:px-12 pt-4 md:pt-6 pb-2 md:pb-4">
                <p class="text-center text-lg">
                    {{$entregado}}
                </p>
                <p class="uppercase text-sm font-semibold text-center">Entregado</p>
                <p class="text-center text-lg mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('orders.index') . "?status=5" }}" class="bg-red-500 bg-opacity-75 rounded-lg px-2 md:px-12 pt-4 md:pt-6 pb-2 md:pb-4">
                <p class="text-center text-lg">
                    {{$anulado}}
                </p>
                <p class="uppercase text-sm font-semibold text-center">Anulado</p>
                <p class="text-center text-lg mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        @if ($orders->count())
            <section class="bg-white shadow-lg rounded-lg px-4 md:px-12 py-8 mt-6 text-gray-700">
                <h1 class="text-lg mb-4 font-semibold text-center">Pedidos recientes</h1>
                <ul>
                    @foreach ($orders as $order)
                        <li>
                            <a href="{{route('orders.show', $order)}}" class="flex items-center justify-between py-2 px-0 md:px-4 hover:bg-gray-100 rounded-md">
                                <div class="flex">
                                    <span class="w-auto text-center mr-2">
                                        @switch($order->status)
                                            @case(1)
                                                <i class="fas fa-business-time text-gray-500 opacity-50"></i>
                                                @break
                                            @case(2)
                                                <i class="fas fa-credit-card text-[#60A3BD] opacity-50"></i>
                                                @break
                                            @case(3)
                                                <i class="fas fa-truck text-blue-500 opacity-50"></i>
                                                @break
                                            @case(4)
                                                <i class="fas fa-check-circle text-green-500 opacity-50"></i>
                                                @break
                                            @case(5)
                                                <i class="fas fa-times-circle text-red-500 opacity-50"></i>
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </span>
                                    <div class="">
                                        <span class="font-semibold text-sm">
                                            Orden: {{ formatOrderNumber($order->id) }}
                                        </span>
                                        <br>
                                        <span class="text-sm">
                                            {{$order->created_at->isoFormat('dddd D MMMM YYYY, HH:mm')}}
                                        </span>
                                    </div>
                                </div>
                                <div class="hidden sm:flex">
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
                                        <i class="fas fa-angle-right ml-2 md:ml-6"></i>
                                    </span>
                                </div>
                                <div class="flex sm:hidden">
                                    <span class="ml-2">
                                        <svg class="fill-[#60A3BD] text-xl" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                                    </span>
                                </div>
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
    @push('script')
        <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js') }}" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    @endpush
</x-app-layout>