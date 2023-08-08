<div x-data class="flex items-center justify-evenly">
    <button class="bg-[#60A3BD] w-8 h-8 md:w-6 md:h-6 text-white rounded-full disabled:bg-gray-300 disabled:cursor-not-allowed"
        disabled
        x-bind:disabled="$wire.qty <= 1"
        wire:loading.attr="disabled"
        wire:target="decrement"
        wire:click="decrement">
        -
    </button>

    <span class="mx-4 text-gray-700 select-none font-semibold">{{$qty}}</span>
    
    <button class="bg-[#60A3BD] w-8 h-8 md:w-6 md:h-6 text-white rounded-full disabled:bg-gray-300 disabled:cursor-not-allowed"
        x-bind:disabled="$wire.qty >= $wire.quantity"
        wire:loading.attr="disabled"
        wire:target="increment"
        wire:click="increment">
        +
    </button>
</div>
