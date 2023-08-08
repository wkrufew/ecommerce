<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItem extends Component
{
    public $qty = 1;
    public $product; 
    public $quantity;
    public $precioventa;
    public $options = [
        'color_id' => null,
        'size_id' => null
    ];

    public function mount()
    {
        $this->quantity = qty_available($this->product->id);
        $this->options['image'] = Storage::url($this->product->featuredImage());
        

        if ($this->product->discount) {
            $this->precioventa = $this->product->discount;
            $this->options['price'] = $this->product->price;
        } else {
            $this->precioventa = $this->product->price;
        }        
    }

    public function decrement(){
        if ($this->qty > 1) {
            $this->qty--;
        }
    }

    public function increment(){
       if ($this->qty < $this->quantity) {
           $this->qty++;
       }
    }

    public function addItem(){
        Cart::add([
            'id' => $this->product->id, 
            'name' => $this->product->name, 
            'qty' => $this->qty, 
            'price' => $this->precioventa, 
            'weight' => 550,
            'options' => $this->options
        ]);

        $this->quantity = qty_available($this->product->id);

        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
