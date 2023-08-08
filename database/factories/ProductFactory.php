<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    
    public function definition(): array
    {
        $name = $this->faker->sentence(2);
        $subcategory = Subcategory::all()->random();
        $category = $subcategory->category;

        $brand = $category->brands->random(); 

        if ($subcategory->color) {
            $quantity = null;
        }else {
            $quantity = 15;
        }
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->text(), 
            'price' => $this->faker->randomElement([19.99, 49.99, 99.99]),
            'discount' => $this->faker->randomElement([0.00,9.99, 12.99, 15.99]),
            'destacado' => $this->faker->randomElement([0,1]),
            'subcategory_id' => $subcategory->id,
            'brand_id' => $brand->id,
            'quantity' => $quantity,
            'status' => 2  
        ];
    }
}
