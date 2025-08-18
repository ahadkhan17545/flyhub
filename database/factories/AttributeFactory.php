<?php

namespace Database\Factories;

use App\Models\Tenant\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->slug,
            'name' => $this->faker->words(2, true),
            'input_type' => $this->faker->randomElement(['text', 'textarea', 'select', 'multiselect', 'boolean', 'date', 'datetime']),
            'is_required' => $this->faker->boolean,
            'value_per_channel' => $this->faker->boolean,
            'is_configurable' => $this->faker->boolean,
            'is_user_defined' => $this->faker->boolean,
            'default_value' => $this->faker->optional()->sentence,
        ];
    }
}
