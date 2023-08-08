<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        $services = Service::where('status', 2)->get();
        return view('livewire.services', compact('services'));
    }
}
