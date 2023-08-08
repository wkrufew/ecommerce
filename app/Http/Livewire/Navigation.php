<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Navigation extends Component
{
    public $loaded = false;
    public $categories;

    protected $listeners = ['switchingCategoryEvent' => 'loadCategories'];

    public function render()
    {
        return view('livewire.navigation');
    }

    public function loadCategories() {   

        if (!$this->loaded) {
            $this->categories = Cache::remember('categories', 60*60*24, function () {
                return Category::with('subcategories')->get();
            });
            $this->loaded = true;
            
            $this->emit('switchingCategoryEvent');
        }
    }
}
