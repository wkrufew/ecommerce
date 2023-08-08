<?php

namespace App\Http\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class ShowService extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $services = Service::where('title', 'like', '%' . $this->search . '%')->latest()->paginate(10);

        return view('livewire.admin.show-service', compact('services'))->layout('layouts.admin');
    }
}
