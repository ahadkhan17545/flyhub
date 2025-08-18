<?php

namespace Database\Factories;

use App\Models\Tenant\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = State::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'country_code' => $this->faker->regexify('[A-Z]{2}'),
            'code' => $this->faker->regexify('[A-Z]{2}'),
            'name' => $this->faker->state,
            'ibge_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'lat' => round($this->faker->latitude, 2),
            'lng' => round($this->faker->longitude, 2),
        ];
    }
}
