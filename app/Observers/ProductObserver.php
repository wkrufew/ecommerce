<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subcategory;

class ProductObserver
{
    public function updated(Product $product): void 
    {
        $subcategory_id = $product->subcategory_id;
        $subcategory = Subcategory::find($subcategory_id);

        if ($subcategory->size) {

            if ($product->colors->count()) {
                $product->colors()->detach();
            }
            
        }elseif ($subcategory->color) {
            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }else{
            if ($product->colors->count()) {
                $product->colors()->detach();
            }

            if ($product->sizes->count()) {
                foreach ($product->sizes as $size) {
                    $size->delete();
                }
            }
        }

        /* verificar este codigo optimizado */
        /* 
        $subcategory = Subcategory::find($product->subcategory_id);

        if ($subcategory) {
            // Verificar si la subcategoría tiene detalles de talla y/o color
            if ($subcategory->size) {
                $product->colors()->detach();

                // No necesitas verificar si hay tallas, ya que se eliminarán de todos modos
                $product->sizes()->delete();
            } elseif ($subcategory->color) {
                $product->sizes()->delete();

                // No necesitas verificar si hay colores, ya que se eliminarán de todos modos
                $product->colors()->detach();
            } else {
                // Si la subcategoría no tiene detalles de talla ni color
                $product->colors()->detach();
                $product->sizes()->delete();
            }
        }
        */
    }
}
