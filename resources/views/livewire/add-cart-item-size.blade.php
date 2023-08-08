<div x-data>
    <div>
        <p class="font-semibold text-sm">Stock Disponible: <span class="text-[#60A3BD]"> 
            {{-- {{$quantity ? $quantity : 'Seleccione una talla y color'}} --}}
        {{-- @if ($quantity)
            {{$quantity}}
        @else
            {{$product->stock}}
        @endif --}}

        @if ($color_id && $size_id)
            {{ ($quantity > 0) ? $quantity : 'color y talla sin stock'}}
        @else
            {{$product->stock}}
        @endif

        </span></p>
        <div class="flex mt-2">
            <div class="flex items-center mr-2 md:mr-5 w-full">
                <select wire:model="size_id"  class="border-gray-300 focus:border-[#60A3BD] focus:ring-[#60A3BD] rounded-full shadow-sm w-full text-sm">
                    <option value="" selected disabled>Seleccione talla</option>
                    @foreach ($sizes as $size)
                        <option value="{{$size->id}}">{{$size->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center w-full">
                <select wire:model="color_id"  class="border-gray-300 focus:border-[#60A3BD] focus:ring-[#60A3BD] rounded-full shadow-sm w-full text-sm">
                    <option value="" selected disabled>Seleccione color</option>
                    @foreach ($colors as $color)
                        <option value="{{$color->id}}">{{$color->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex mt-4">
            <div class="flex items-center mr-5">
                <button  disabled x-bind:disabled="$wire.qty <= 1 " wire:loading.attr="disabled" wire:target="decrement" wire:click="decrement"  class="disabled:bg-gray-200 disabled:cursor-not-allowed border-[#60A3BD] disabled:text-gray-500 disabled:fill-gray-400 disabled:border-gray-400 border w-10 h-10  rounded-full hover:bg-[#60A3BD] hover:text-white text-[#60A3BD]">
                    -
                </button>
                <span class="mx-4 font-semibold text-[#60A3BD]">
                    {{ $qty }}
                </span>
                <button x-bind:disabled="$wire.qty >= $wire.quantity" wire:loading.attr="disabled" wire:target="increment" wire:click="increment" class="border disabled:bg-gray-300 disabled:cursor-not-allowed disabled:text-gray-400 disabled:fill-gray-400 disabled:border-gray-400 w-10 h-10 border-[#60A3BD] rounded-full hover:bg-[#60A3BD] hover:text-white text-[#60A3BD]">
                    +
                </button>
            </div>
            <div class="flex-1 items-center">
                <button wire:loading.remove wire:loading.attr="disabled" wire:target="addItem" wire:click="addItem" x-bind:disabled="!$wire.quantity" class="disabled:bg-gray-300 disabled:cursor-not-allowed disabled:text-gray-400 disabled:fill-gray-400 disabled:border-gray-400 w-full flex justify-center items-center border border-[#60A3BD] text-[#60A3BD] hover:bg-[#60A3BD] fill-[#60A3BD] hover:fill-white rounded-full px-3 py-2 hover:text-white">
                    <span class="mr-2">
                        <svg class="" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                    </span> 
                    <span>
                        Agregar al carrito
                    </span>
                </button>
            </div>
            <div wire:loading wire:target="addItem">
                <x-loading message="Agregando al carrito..."/>
            </div>
        </div>
    </div>
</div>
