<?php

namespace Database\Factories;

use App\Models\Tenant\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->optional()->regexify('[A-Z0-9]{8}'),
            'name' => $this->faker->optional()->words(2, true),
            'unit' => $this->faker->optional()->randomElement(['piece', 'kg', 'g', 'm', 'cm']),
            'weight' => $this->faker->optional()->randomFloat(4, 0.1, 10.0),
            'total_weight' => $this->faker->optional()->randomFloat(4, 0.1, 10.0),
            'qty_ordered' => $this->faker->numberBetween(1, 10),
            'qty_shipped' => $this->faker->optional()->numberBetween(0, 10),
            'qty_invoiced' => $this->faker->optional()->numberBetween(0, 10),
            'qty_canceled' => $this->faker->optional()->numberBetween(0, 5),
            'qty_refunded' => $this->faker->optional()->numberBetween(0, 5),
            'price' => $this->faker->randomFloat(4, 10, 1000),
            'total' => null, // Will be calculated by observer
            'total_invoiced' => $this->faker->randomFloat(4, 0, 1000),
            'amount_refunded' => $this->faker->randomFloat(4, 0, 100),
            'coupon_code' => $this->faker->optional()->regexify('[A-Z0-9]{6}'),
            'discount_percent' => $this->faker->optional()->randomFloat(4, 0, 20),
            'discount_amount' => $this->faker->optional()->randomFloat(4, 0, 50),
            'discount_invoiced' => $this->faker->optional()->randomFloat(4, 0, 50),
            'discount_refunded' => $this->faker->optional()->randomFloat(4, 0, 50),
            'tax_percent' => $this->faker->optional()->randomFloat(4, 0, 25),
            'tax_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'tax_amount_invoiced' => $this->faker->optional()->randomFloat(4, 0, 100),
            'tax_amount_refunded' => $this->faker->optional()->randomFloat(4, 0, 100),
            'product_id' => null, // Will be set by the test if needed
            'order_id' => null, // Will be set by the test if needed
            'parent_id' => null, // Will be set by the test if needed
        ];
    }
}
