<?php

namespace App\Http\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateService extends Component
{
    public $title, $slug, $description, $subtitle, $otro;


    protected $rules = [
        'title' => 'required',
        'subtitle' => 'required',
        'slug' => 'required|unique:services',
        'description' => 'required',
        'otro' => 'nullable'
    ];

   
    public function updatedTitle($value){
        $this->slug = Str::slug($value);
    }

    public function save(){

        $rules = $this->rules;


        $this->validate($rules);

        $service = new Service();

        $service->title = $this->title;
        $service->subtitle = $this->subtitle;
        $service->description = $this->description;
        $service->slug = $this->slug;
        $service->otro = $this->otro;

        $service->save();

        return redirect()->route('admin.services.edit', $service);
    }
    public function render()
    {
        return view('livewire.admin.create-service')->layout('layouts.admin');
    }
}
