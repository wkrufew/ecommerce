<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            /* Asistentes Virtuales */
            [
                'category_id' => 1,
                'name' => 'Altavoz Echo Dot 3',
                'slug' => Str::slug('Altavoz Echo Dot 3'),
                'color' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Altavoz Echo Dot 4',
                'slug' => Str::slug('Altavoz Echo Dot 4'),
                'color' => true
            ],
            /* Dispositivos Inteligentes */
            [
                'category_id' => 2,
                'name' => 'Foco Inteligente',
                'slug' => Str::slug('Foco Inteligente'),
                
            ],
            [
                'category_id' => 2,
                'name' => 'Interruptores Inteligentes',
                'slug' => Str::slug('Interruptores Inteligentes'),
                'color' => true
            ],
            [
                'category_id' => 2,
                'name' => 'Tomacorrientes Inteligentes',
                'slug' => Str::slug('Tomacorrientes Inteligentes'),
                
            ],
            [
                'category_id' => 2,
                'name' => 'Cintas Led Inteligentes',
                'slug' => Str::slug('Cintas Led Inteligentes'),
                
            ],
            /* Seguridad Domestica */
            [
                'category_id' => 3,
                'name' => 'Camaras',
                'slug' => Str::slug('Camaras'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 3,
                'name' => 'Sirenas',
                'slug' => Str::slug('Sirenas'),
                'color' => true,
                'size' => true
            ],
            /* Domotica */
            [
                'category_id' => 4,
                'name' => 'Cintas Led',
                'slug' => Str::slug('Cintas Led'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 4,
                'name' => 'Alarmas inteligentes',
                'slug' => Str::slug('Alarmas inteligentes'),
                'color' => true
            ],
            /* Ropa */
            [
                'category_id' => 5,
                'name' => 'Camisetas',
                'slug' => Str::slug('Camisetas'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Pantalones',
                'slug' => Str::slug('Pantalones'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Busos',
                'slug' => Str::slug('Busos'),
                'color' => true,
                'size' => true
            ]

        ];

        foreach ($subcategories as $subcategory) {
                Subcategory::create($subcategory);
        }
    }
}
