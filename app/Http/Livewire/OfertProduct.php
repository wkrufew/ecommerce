<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class OfertProduct extends Component
{
    public $productso = [];

    public function loadProductO()
    {
        $this->productso = Cache::remember('oferts-featured', 60*60*24, function () {
            return Product::select('id','slug','name','price','discount')->with('images')->where('status', 2)->where('discount', '>', 0)->take(10)->get();
        });
    
        $this->emit('swiper3');
    }
    
    public function render()
    {
        return view('livewire.ofert-product');
    }
}
