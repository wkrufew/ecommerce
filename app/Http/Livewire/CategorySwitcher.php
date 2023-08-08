<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategorySwitcher extends Component
{
    public function render()
    {
        return view('livewire.category-switcher');
    }
}
