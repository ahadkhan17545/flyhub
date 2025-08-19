<?php

namespace Database\Factories;

use App\Models\Tenant\Tax;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Tax::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'tag' => $this->faker->unique()->regexify('[A-Z0-9]{4,8}'),
            'name' => $this->faker->words(2, true),
            'type' => $this->faker->randomElement(['percentage', 'fixed', 'compound']),
            'size' => $this->faker->randomElement(['small', 'medium', 'large']),
            'description' => $this->faker->optional()->sentence,
            'tax_rate' => $this->faker->randomFloat(4, 0, 25),
            'formula' => $this->faker->optional()->regexify('[A-Z0-9_]{5,15}'),
            'required' => $this->faker->boolean,
            'visible' => $this->faker->boolean,
            'default_value' => $this->faker->optional()->randomFloat(4, 0, 100),
        ];
    }
}
