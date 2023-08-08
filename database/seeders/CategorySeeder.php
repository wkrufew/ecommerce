<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Asistentes Virtuales',
                'slug' => Str::slug('Asistentes Virtuales'),
                'icon' => '<i class="fab fa-amazon"></i>'
            ],
            [
                'name' => 'Dispositivos Inteligentes',
                'slug' => Str::slug('Dispositivos Inteligentes'),
                'icon' => '<i class="fas fa-lightbulb"></i>'
            ],
            [
                'name' => 'Seguridad Domestica',
                'slug' => Str::slug('Seguridad Domestica'),
                'icon' => '<i class="fas fa-lightbulb"></i>'
            ],
            [
                'name' => 'Domotica',
                'slug' => Str::slug('Domotica'),
                'icon' => '<i class="fas fa-lightbulb"></i>'
            ],
            [
                'name' => 'Ropa',
                'slug' => Str::slug('Ropa'),
                'icon' => '<i class="fas fa-lightbulb"></i>'
            ]
        ];

        foreach ($categories as $category) {
            $category = Category::factory(1)->create($category)->first();
            
            $brands = Brand::factory(4)->create();

            foreach ($brands as $brand) {
                $brand->categories()->attach($category->id);
            }
        }
    }
}
