<?php

namespace Database\Factories;

use App\Models\Tenant\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductAttributeFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = ProductAttribute::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'channel' => $this->faker->optional()->randomElement(['web', 'mobile', 'api']),
            'text_value' => $this->faker->optional()->sentence,
            'boolean_value' => $this->faker->optional()->boolean,
            'integer_value' => $this->faker->optional()->numberBetween(1, 100),
            'float_value' => $this->faker->optional()->randomFloat(2, 0.1, 100.0),
            'datetime_value' => null,
            'date_value' => null,
            'json_value' => $this->faker->optional()->text,
            'product_id' => null, // Will be set by the test if needed
            'attribute_id' => null, // Will be set by the test if needed
        ];
    }
}
