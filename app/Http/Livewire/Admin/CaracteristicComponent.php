<?php

namespace App\Http\Livewire\Admin;

use App\Models\Characteristic;
use App\Models\Product;
use Livewire\Component;

class CaracteristicComponent extends Component
{ 
    public $product, $caracteristicas,$caracteristica;

    protected $listeners = ['delete'];
    
    public $createForm = [
        'title' => '',
        'name' => null
    ];

    public $editForm = [
        'open' => false,
        'title' => '',
        'name' => ''
    ];

    protected $validationAttributes = [
        'createForm.title' => 'title',
        'createForm.name' => 'name'
    ];

    public function mount(Product $product){
        $this->product = $product;
        $this->getCaracteristicas();
    }

    public function getCaracteristicas(){
        $this->caracteristicas = Characteristic::where('product_id', $this->product->id)->get();
    }

    public function save(){

        $this->validate([
            "createForm.title" => 'required',
            "createForm.name" => 'required',
        ]);

        $this->product->characteristics()->create($this->createForm);
        $this->reset('createForm');
        $this->getCaracteristicas();
        $this->emit('saved');
    }

    public function edit(Characteristic $caracteristica){
        $this->caracteristica = $caracteristica;
        $this->editForm['open'] = true;
        $this->editForm['title'] = $caracteristica->title;
        $this->editForm['name'] = $caracteristica->name;
    }

    public function update(){
        $this->caracteristica->title = $this->editForm['title'];
        $this->caracteristica->name = $this->editForm['name'];
        $this->caracteristica->save();

        $this->reset('editForm');
        $this->getCaracteristicas();
    }


    public function delete(Characteristic $caracteristica){
        $caracteristica->delete();
        $this->getCaracteristicas();
    }


    public function render()
    {
        return view('livewire.admin.caracteristic-component')->layout('layouts.admin');
    }
}
