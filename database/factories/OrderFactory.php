<?php

namespace Database\Factories;

use App\Models\Tenant\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Order::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->word,
            'channel_name' => $this->faker->word,
            'is_guest' => $this->faker->boolean,
            'customer_email' => $this->faker->word,
            'customer_name' => $this->faker->word,
            'shipping_method' => $this->faker->word,
            'coupon_code' => $this->faker->word,
            'is_gift' => $this->faker->boolean,
            'total_item_count' => $this->faker->randomDigitNotNull,
            'total_qty_ordered' => $this->faker->randomDigitNotNull,
            'grand_total' => $this->faker->optional()->randomFloat(4, 10, 500),
            'grand_total_invoiced' => $this->faker->optional()->randomFloat(4, 0, 500),
            'grand_total_refunded' => $this->faker->optional()->randomFloat(4, 0, 500),
            'sub_total' => $this->faker->optional()->randomFloat(4, 10, 400),
            'sub_total_invoiced' => $this->faker->optional()->randomFloat(4, 0, 400),
            'sub_total_refunded' => $this->faker->optional()->randomFloat(4, 0, 400),
            'discount_percent' => $this->faker->optional()->randomFloat(4, 0, 100),
            'discount_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'discount_invoiced' => $this->faker->optional()->randomFloat(4, 0, 100),
            'discount_refunded' => $this->faker->optional()->randomFloat(4, 0, 100),
            'tax_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'tax_amount_invoiced' => $this->faker->optional()->randomFloat(4, 0, 100),
            'tax_amount_refunded' => $this->faker->optional()->randomFloat(4, 0, 100),
            'shipping_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'shipping_invoiced' => $this->faker->optional()->randomFloat(4, 0, 100),
            'shipping_refunded' => $this->faker->optional()->randomFloat(4, 0, 100),
            'customer_id' => null,
            'channel_id' => null,
        ];
    }
}
