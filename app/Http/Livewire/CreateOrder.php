<?php

namespace App\Http\Livewire;

use App\Mail\OrderCreate;
use App\Models\City;
use App\Models\Department;
use App\Models\District;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Mail;

class CreateOrder extends Component
{
    use HandlesAuthorization;

    public $envio_type = 1;

    public $contact, $phone, $address, $references, $shipping_cost = 0;

    public $departments, $cities = [], $districts = [];

    public $department_id = "", $city_id = "", $district_id = "";
    public $carrito;

    public $rules = [
        'contact' => 'required',
        'phone' => 'required',
        'envio_type' => 'required'
    ];

    public function mount()
    {
        $this->departments = Department::all();
        $this->contact = auth()->user()->name;
    }

    public function updatedEnvioType($value)
    {
        if ($value == 1) {
            $this->resetValidation([
                'department_id', 'city_id', 'district_id', 'address', 'references'
            ]);
        }
    }

    public function updatedDepartmentId($value)
    {
        $this->cities = City::where('department_id', $value)->get();

        $this->reset(['city_id', 'district_id']);
    }


    public function updatedCityId($value)
    {

        $city = City::find($value);

        $this->shipping_cost = $city->cost;

        $this->districts = District::where('city_id', $value)->get();

        $this->reset('district_id');
    }


    public function create_order()
    {
        $this->validateOrder(); // Extraer la validación a un método separado

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->contact = $this->contact;
        $order->phone = $this->phone;
        $order->envio_type = $this->envio_type;
        $order->shipping_cost = $this->envio_type == 2 ? $this->shipping_cost : 0; // Simplificar la asignación
        $order->total = $this->shipping_cost + Cart::subtotal();
        $order->content = Cart::content()->toJson(); // Convertir a JSON directamente

        $envio = null; // Inicializar la variable $envio

        if ($this->envio_type == 2) {
            $envio = json_encode([
                'department' => Department::find($this->department_id)->name,
                'city' => City::find($this->city_id)->name,
                'district' => District::find($this->district_id)->name,
                'address' => $this->address,
                'references' => $this->references
            ]);
        }

        $order->envio = $envio; // Asignar el valor de $envio
        $order->save();

        foreach (Cart::content() as $item) {
            discount($item);
        }

        Cart::destroy();

        return redirect()->route('orders.show', $order);
    }



    private function validateOrder()
    {
        $rules = $this->rules;

        if ($this->envio_type == 2) {
            $rules['department_id'] = 'required';
            $rules['city_id'] = 'required';
            $rules['district_id'] = 'required';
            $rules['address'] = 'required';
            $rules['references'] = 'required';
        }

        $this->validate($rules);
    }

    public function render()
    {
        return view('livewire.create-order');
    }
}
