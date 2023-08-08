<?php

namespace App\Http\Livewire;

use App\Models\Size;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCartItemSize extends Component
{
    public $qty = 1;
    public $quantity = 0;
    public $size_id="";
    public $product;
    public $precioventa;
    public $sizes;
    public $color_id = "";
    public $colors = [];
    public $options = [];

    public function mount()
    {
        $this->sizes = $this->product->sizes;
        $this->options['image'] = Storage::url($this->product->featuredImage());

        if ($this->product->discount) {
            $this->precioventa = $this->product->discount;
            $this->options['price'] = $this->product->price;
        } else {
            $this->precioventa = $this->product->price;
        }
    }

    public function updatedSizeId($value)
    {
        $size = Size::find($value);
        /* $this->colors = $size->colors; */
        $this->colors = $size->colors->filter(function ($color) {
            return $color->pivot->quantity > 0;
        });
       
        $this->options['size'] = $size->name;
        $this->options['size_id'] = $size->id;
    }

    public function updatedColorId($value)
    {
        $size = Size::find($this->size_id);
        $color = $size->colors->find($value);
        $this->quantity = qty_available($this->product->id, $color->id, $size->id);
        $this->options['color'] = $color->name;
        $this->options['color_id'] = $color->id;
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
        
        $this->quantity = qty_available($this->product->id, $this->color_id, $this->size_id);

        $this->reset('qty');

        $this->emitTo('dropdown-cart', 'render');
    }

    public function render()
    {
        return view('livewire.add-cart-item-size');
    }
}
