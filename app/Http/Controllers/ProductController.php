<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Product $product): View {

        $product->load('characteristics', 'images', 'reviews');
        return view('products.show', compact('product'));
    }
}
