<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;

class Search extends Component
{
    public $search;

    public $open = false;

    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        }else{
            $this->open = false;
        }
    }

    /* public function getResultsProperty()
    {
        if ( Str::length($this->search) > 2) {
            return Product::where('name', 'LIKE' ,'%' . $this->search . '%')
                                ->where('status', 2)
                                ->take(8)
                                ->get();
        }
    } */

    public function render()
    {
        if ( Str::length($this->search) > 2) {
            $products = Product::with(['images','subcategory.category'])
                                ->where('name', 'LIKE' ,'%' . $this->search . '%')
                                ->where('status', 2)
                                ->take(8)
                                ->get();
        } else {
            $products = [];
        }
        
        return view('livewire.search', compact('products'));
    }
}
