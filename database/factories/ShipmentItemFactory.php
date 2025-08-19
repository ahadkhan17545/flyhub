<?php

namespace Database\Factories;

use App\Models\Tenant\ShipmentItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentItemFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = ShipmentItem::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->optional()->regexify('[A-Z0-9]{8}'),
            'name' => $this->faker->optional()->words(2, true),
            'qty' => $this->faker->optional()->numberBetween(1, 10),
            'weight' => $this->faker->optional()->randomFloat(2, 0.1, 10.0),
            'width' => $this->faker->optional()->randomFloat(2, 1, 100),
            'height' => $this->faker->optional()->randomFloat(2, 1, 100),
            'depth' => $this->faker->optional()->randomFloat(2, 1, 100),
            'price' => $this->faker->optional()->randomFloat(4, 10, 1000),
            'total' => $this->faker->optional()->randomFloat(4, 10, 2000),
            'product_id' => null, // Will be set by the test if needed
            'order_item_id' => null, // Will be set by the test if needed
            'shipment_id' => $this->faker->numberBetween(1, 100), // Will be overridden by test
            'note' => $this->faker->optional()->sentence,
        ];
    }
}
