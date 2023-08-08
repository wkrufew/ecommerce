<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemColor extends Component
{
    public $product; 
    public $colors;
    public $precioventa;
    public $color_id="";
    public $qty = 1;
    public $quantity = 0;
    public $options = [
        'size_id' => null
    ];  

    public function mount()
    {
        /* $this->colors = $this->product->colors; */
        $this->colors = $this->product->colors->filter(function ($color) {
            return $color->pivot->quantity > 0;
        });

        //dd($this->colors);
        $this->options['image'] = Storage::url($this->product->featuredImage());
        
        if ($this->product->discount) {
            $this->precioventa = $this->product->discount;
            $this->options['price'] = $this->product->price;
        } else {
            $this->precioventa = $this->product->price;
        }
    }
    
    public function updatedColorId($value){
        $color = $this->product->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
    }

    public function decrement(){
        if ($this->qty > 1) {
            $this->qty--;
        }
        /* $this->qty = $this->qty - 1; */
    }

    public function increment(){
       if ($this->qty < $this->quantity) {
            $this->qty++;
       }
       /* $this->qty = $this->qty + 1; */
    }

    public function addItem(){
        //Cart::destroy();
        Cart::add([
            'id' => $this->product->id, 
            'name' => $this->product->name, 
            'qty' => $this->qty, 
            'price' => $this->precioventa, 
            'weight' => 550,
            'options' => $this->options
        ]);

        $this->quantity = qty_available($this->product->id, $this->color_id);

        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item-color');
    }
}
