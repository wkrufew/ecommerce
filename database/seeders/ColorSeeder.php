<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = ['Blanco','Negro', 'Gris', 'Azul', 'Rojo', 'Amarillo', 'Cafe', 'Verde', 'Celeste', 'Rosado','Morado'];

        foreach ($colors as $color) {
            Color::create([
                'name' => $color
            ]);
        }
    }
}
