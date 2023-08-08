<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    protected $model = City::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'cost' => $this->faker->randomElement([5, 10, 15])
        ];
    }
}
