<?php

namespace App\Http\Livewire\Admin;

use App\Models\Image;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;

class EditService extends Component
{
    public $service, $slug;

    protected $rules = [
        'service.title' => 'required',
        'slug' => 'required|unique:products,slug',
        'service.description' => 'required',
        'service.subtitle' => 'required',
        'service.status' => 'required',
        'service.otro' => 'nullable'
    ];

    protected $listeners = ['refreshService', 'delete'];

    public function mount(Service $service){
        $this->service = $service;

        $this->slug = $this->service->slug;
    }


    public function refreshService(){
        $this->service = $this->service->fresh();
    }

    public function updatedProductTitle($value){
        $this->slug = Str::slug($value);
    }

    public function save(){
        $rules = $this->rules;
        $rules['slug'] = 'required|unique:services,slug,' . $this->service->id;

        $this->validate($rules);

        $this->service->slug = $this->slug;

        $this->service->save();
        
        $this->emit('saved');
    }

    public function deleteImage(Image $image){
        Storage::delete([$image->url]);
        $image->delete();
        
        $this->service = $this->service->fresh();
    }

    public function delete(){

        $images = $this->service->images;

        if ($images) {
            foreach ($images as $image) {
                Storage::delete($image->url);
                $image->delete();
            }
        }

        $this->service->delete();

        return redirect()->route('admin.services.index');

    }

    public function render()
    {
        return view('livewire.admin.edit-service')->layout('layouts.admin');
    }
}
