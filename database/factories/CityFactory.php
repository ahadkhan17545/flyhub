<?php

namespace Database\Factories;

use App\Models\Tenant\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = City::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'state_ibge_id' => $this->faker->numberBetween(1, 100),
            'state_code' => $this->faker->regexify('[A-Z]{2}'),
            'name' => $this->faker->city,
            'lat' => round($this->faker->latitude, 2),
            'lng' => round($this->faker->longitude, 2),
            'capital' => $this->faker->boolean,
            'ibge_id' => $this->faker->unique()->numberBetween(1000000, 9999999),
        ];
    }
}
