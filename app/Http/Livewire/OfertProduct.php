<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class OfertProduct extends Component
{
    public $products = [];

    public function loadProduct()
    {
        $this->products = Cache::remember('oferts-featured', 60*60*24, function () {
            return Product::with('images')->where('status', 2)->where('discount', '>', 0)->take(15)->get();
        });
        
        $this->emit('glider-2');
    }
    
    public function render()
    {
        return view('livewire.ofert-product');
    }
}
