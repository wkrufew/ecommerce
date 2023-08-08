<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {   
        $sliders = Slider::orderBy('orden', 'asc')->get();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        
        $rules = [
            'file' => 'required|image',
            'url' => 'required|url',
        ];
        
        $validatedData = $request->validate($rules);
        
        $slider = new Slider();
        
        if ($request->hasFile('file')) {
            $imagen = $request->file('file')->store('sliders');
            $slider->imagen = $imagen;
        }
        
        $slider->url = $request->input('url');
        
        $slider->save();
        
        Cache::forget('sliders');

        return redirect()->route('admin.sliders.index')->with('mensaje','Slider guardado con exito');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit',compact('slider'));
    }

    public function update(Slider $slider, Request $request)
    {

        $request->validate([
            'file' => 'nullable|image',
            'url' => 'required|url',
        ]);
    
        if ($request->hasFile('file')) {
            $imagen = $request->file('file')->store('sliders');
    
            if ($slider->imagen) {
                Storage::delete($slider->imagen);
            }
    
            $slider->imagen = $imagen;
        }
    
        $slider->url = $request->input('url');
    
        $slider->update();

        Cache::forget('sliders');

        return redirect()->route('admin.sliders.index')->with('mensaje','Slider actualizado con exito');
    }

    public function destroy(Slider $slider)
    {
        Storage::delete($slider->imagen);
        $slider->delete();
        Cache::forget('sliders');
        return redirect()->route('admin.sliders.index')->with('mensaje','Slider eliminado exitosaente');
    }
}
