<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(200)->create()->each(function (Product $product){
            Characteristic::factory(4)->create([
                'product_id' => $product->id
            ]);

            Image::factory(4)->create([
                'imageable_id' => $product->id,
                'imageable_type' => Product::class
            ]);
        });
    }
}
