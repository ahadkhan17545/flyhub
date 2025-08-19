<?php

namespace Database\Factories;

use App\Models\Tenant\Attribute;
use Illuminate\Support\Str;
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
            'name' => $this->faker->words(2, true),
            'code' => function (array $attrs) { return Str::slug($attrs['name']); },
            'input_type' => $this->faker->randomElement(['text', 'textarea', 'select', 'multiselect', 'boolean', 'date', 'datetime']),
            'is_required' => $this->faker->boolean,
            'value_per_channel' => $this->faker->boolean,
            'is_configurable' => $this->faker->boolean,
            'is_user_defined' => true,
            'default_value' => $this->faker->optional()->sentence,
        ];
    }
}
