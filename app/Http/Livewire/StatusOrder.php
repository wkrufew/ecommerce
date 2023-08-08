<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StatusOrder extends Component
{
    public $order, $status;

    protected $listeners = ['refreshOrder', 'estado'];

    public function mount(){
        $this->status = $this->order->status;
    }

    public function estado(){

        /* if (($this->status != 5 && $this->status != 1) && $this->order->status != $this->status) {
            $this->order->status = $this->status;
            $this->order->save();
            $this->emit('saved');
        } elseif ($this->status == 5 && $this->order->status != $this->status) {
            $items = json_decode($this->order->content);
            foreach ($items as $item) {
                increase($item);
            }
            $this->order->status = 5;
            $this->order->save();
            $this->emit('saved');
        } elseif ($this->status == 1 && $this->order->status != $this->status) {
            $this->emit('estadoError1');
        }elseif ($this->order->status == $this->status) {
            $this->emit('estadoError');
        }   */

        if ($this->order->status != $this->status) {
            if ($this->status == 5) {
                $items = json_decode($this->order->content);
                foreach ($items as $item) {
                    increase($item);
                }
            }
        
            if ($this->status != 1) {
                $this->order->status = $this->status;
                $this->order->save();
                $this->emit('saved');
            } else {
                $this->emit('estadoError1');
            }
        } else {
            $this->emit('estadoError');
        }     
         
    }

    public function render()
    {
        $items = json_decode($this->order->content);
        $envio = json_decode($this->order->envio);

        return view('livewire.status-order', compact('items', 'envio'));
    }
}
