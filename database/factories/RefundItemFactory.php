<?php

namespace Database\Factories;

use App\Models\Tenant\RefundItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundItemFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = RefundItem::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->optional()->words(2, true),
            'description' => $this->faker->optional()->sentence,
            'sku' => $this->faker->optional()->regexify('[A-Z0-9]{8}'),
            'qty' => $this->faker->optional()->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(4, 1, 1000),
            'total' => $this->faker->randomFloat(4, 1, 2000),
            'tax_amount' => $this->faker->optional()->randomFloat(4, 0, 200),
            'discount_percent' => $this->faker->optional()->randomFloat(4, 0, 50),
            'discount_amount' => $this->faker->optional()->randomFloat(4, 0, 200),
            'product_id' => null,
            'order_item_id' => null,
            'refund_id' => null,
            'parent_id' => null,
            'note' => $this->faker->optional()->sentence,
        ];
    }
}
