<div class="w-full md:w-72 h-full rounded-full relative">
    <div class="">
        <form action="{{ route('search') }}" autocomplete="off">
            <input name="name" wire:model.debounce.500ms="search" type="text" placeholder="Busque un producto por su nombre ..." class="placeholder:text-gray-400 w-full text-sm md:text-xs bg-white border border-[#60A3BD] rounded-full focus:outline-none  focus:border-[#60A3BD]">
            <div class="absolute inset-y-0 right-0 flex items-center pointer-events-auto cursor-pointer">
                <svg class="h-7 w-7 p-1.5 mr-0.5 flex justify-center items-center text-[#60A3BD] bg-gray-200 rounded-full" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"stroke-linejoin="round"></path>
                </svg>
            </div>
        </form>
    </div>
    <div class="absolute w-full mt-1 hidden z-50" :class="{ 'hidden' : !$wire.open }" x-on:click.away="$wire.open = false">
        <div class="bg-white rounded-lg shadow-lg">
            <ul class="px-4 py-3 space-y-1">
                <li  wire:loading wire:target="search">
                    <div class="flex rounded-full relative items-center">
                        <div class="w-12 h-12 bg-gray-400 rounded-full animate-pulse">
                        </div>
                        <div class="flex-1 ml-4 w-44 bg-gray-400 rounded-md h-10 animate-pulse">
                        </div>
                    </div>
                </li>
                @forelse ($products as $product)
                    <li wire:loading.remove>
                        <a aria-label="Abrir el producto {{$product->name}}" href="{{ route('products.show', $product) }}" class="flex hover:bg-gray-200 rounded-full">
                            <img loading="lazy" class="w-12 h-12 object-cover rounded-full" src="{{ Storage::url($product->featuredImage()) }}" alt="">
                            <div class="ml-4 text-xs flex flex-col justify-center">
                                <p class="font-semibold leading-5">{{$product->name}}</p>
                                <p> {{$product->subcategory->category->name}}</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <p class="h-6 rounded-lg w-full text-[#3E3E66] text-sm">
                        Sin coincidencias
                    </p>
                @endforelse
                </ul>
        </div>
    </div>
</div>
