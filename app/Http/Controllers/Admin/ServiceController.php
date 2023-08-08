<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function files(Service $service, Request $request){

        $request->validate([
            'file' => 'required|image|max:2048'
        ]);
        
        $url = Storage::put('services', $request->file('file'));

        $service->images()->create([
            'url' => $url
        ]);
    }
}
