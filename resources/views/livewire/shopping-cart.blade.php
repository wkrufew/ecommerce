<div>
    <div class="max-w-5xl mx-auto pt-6 pb-16 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-2">
            <div class="px-6 py-4 bg-white rounded-t-md">
                <div class="flex justify-center items-center">
                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                     <span class="text-sm font-semibold text-gray-700 text-center">
                        CARRO DE COMPRAS
                    </span>   
                </div>
            </div>
            @if (Cart::count())
                <div class="overflow-x-auto touch-pan-x">
                    <table class="min-w-full divide-y divide-gray-200 rounded-b-md p-1 overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nombre
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 rounded-md">
                            @foreach (Cart::content() as $key => $item)    
                                <tr>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full object-cover object-center" src="{{ $item->options->image }}" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-xs font-medium text-gray-900 uppercase">
                                                    {{$item->name}}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    @if ($item->options->color)
                                                        <span class="text-xs">
                                                            Color: {{ __($item->options->color) }}
                                                        </span>    
                                                    @endif
                                                    @if ($item->options->size)
                                                        <span class="mx-1">-</span>
                                                        <span class="text-xs">
                                                            {{ $item->options->size }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-xs text-gray-500 flex flex-col">
                                            @if ($item->options->price)
                                                <span class="line-through text-red-500">{{$item->options->price}}</span>
                                                <span class="text-[#60A3BD] font-medium">{{$item->price}}</span>
                                            @else
                                                <span class="text-[#60A3BD] font-medium">{{$item->price}}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm w-full text-gray-500 flex justify-center py-0 md:py-1.5 rounded-full border">
                                            @if ($item->options->size)
                                                @livewire('update-cart-item-size', ['rowId' => $item->rowId], key($item->rowId))
                                            @elseif($item->options->color)
                                                @livewire('update-cart-item-color', ['rowId' => $item->rowId], key($item->rowId)) 
                                            @else
                                                @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="text-xs text-gray-500 flex-col">
                                            <span class="font-medium">
                                                $ {{number_format($item->price * $item->qty, 2, ',', ' ')}}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-sm">
                                        <button class="flex items-center cursor-pointer"
                                                wire:click="delete('{{$item->rowId}}')"
                                                wire:loading.class="text-red-600 opacity-25"
                                                wire:target="delete('{{$item->rowId}}')">
                                                <svg class="fill-gray-500 hover:fill-red-500" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                                            </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 flex justify-around mt-3 text-white bg-white rounded-md">
                    <button class="text-xs cursor-pointer flex items-center bg-red-500 rounded-full px-5 py-3" wire:click="destroy">
                        <svg class="mr-2 fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                        <span>
                            Vaciar el carrito
                        </span>
                    </button>
                    <a href="/" class="text-xs cursor-pointer flex items-center bg-[#60A3BD] rounded-full px-5 py-3">
                        <span>
                            Seguir comprando
                        </span>
                    </a>
                </div>
            @else
                <div class="flex flex-col items-center bg-white rounded-md">
                        <p class="text-sm text-gray-500 my-4">Tu carrito de compras está vacío</p>
                        <a href="/" class="my-4 px-4 py-2 rounded-full text-xs bg-[#60A3BD] text-white">
                            Ir a comprar
                        </a>
                </div>
            @endif
        </div>
        <div>
            @if (Cart::count())
                <div class="bg-white rounded-md px-6 py-4">
                    <div class="">
                        <div class="space-y-2 text-xs ">
                            <p class="text-gray-600 flex justify-between">
                                <span class="font-semibold">Total de productos:</span>
                                 {{ Cart::count() }}
                            </p>
                            @php  
                            $count = 0;     
                            foreach  (Cart::content() as $descuento){
                                if ($descuento->options->price) {
                                    $resultado = ($descuento->options->price - $descuento->price) * $descuento->qty;
                                    $count = $count + $resultado;
                                }     
                            }
                            @endphp
                            <p class="text-gray-600 flex justify-between">
                                <span class="font-semibold">Descuentos:</span>
                                @if ($count > 0)
                                    $ -{{$count}}
                                @endif
                            </p>
                            <p class="text-gray-600 flex justify-between">
                                <span class="font-semibold">Subtotal:</span>
                                $ {{$count + Cart::subTotal()}}
                            </p>
                            <hr>
                            <p class="text-gray-600 flex justify-between text-lg font-semibold">
                                <span>Total:</span>
                                <span  class="text-[#60A3BD]">$ {{ Cart::subTotal()}}</span>
                            </p>
                        </div>
                        <div class="mt-4">
                            <a class="block py-3 bg-[#60A3BD] rounded-full text-white text-center text-xs" href="{{ route('orders.create') }}">
                                Comprar
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
