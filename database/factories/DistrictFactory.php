<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\District>
 */
class DistrictFactory extends Factory
{
    protected $model = District::class;
    
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
