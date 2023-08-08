<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SortableController extends Controller
{
    public function slider(Request $request)
    {
        $orden = 1;
        $sorts = $request->get('sorts');

        foreach ($sorts as $sort) {
            $slider = Slider::find($sort);
            $slider->orden = $orden;
            $slider->save();
            $orden++;
        }

        Cache::forget('sliders');
    }
}
