<?php

namespace Database\Factories;

use App\Models\Tenant\Refund;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Refund::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'state' => $this->faker->optional()->randomElement(['pending', 'approved', 'rejected']),
            'email_sent' => $this->faker->boolean,
            'total_qty' => $this->faker->optional()->numberBetween(1, 10),
            'adjustment_refund' => $this->faker->optional()->randomFloat(4, 0, 100),
            'adjustment_fee' => $this->faker->optional()->randomFloat(4, 0, 100),
            'sub_total' => $this->faker->optional()->randomFloat(4, 10, 500),
            'grand_total' => $this->faker->optional()->randomFloat(4, 10, 600),
            'shipping_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'tax_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'discount_percent' => $this->faker->optional()->randomFloat(4, 0, 100),
            'discount_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'order_id' => null,
        ];
    }
}
