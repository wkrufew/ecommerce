<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class FeaturedProduct extends Component
{
    public $productsd = [];

    public function loadProductD()
    {
        $this->productsd = Cache::remember('products-featured', 60 * 60 * 24, function () {
            return Product::select('id','slug','name','price','discount')
                            ->with('images')
                            ->where('status', 2)
                            ->where('destacado', 1)
                            ->take(10)
                            ->get();
        });
        
        $this->emit('swiper2');
    }

    public function render()
    {
        return view('livewire.featured-product');
    }
}
