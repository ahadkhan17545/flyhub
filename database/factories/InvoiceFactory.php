<?php

namespace Database\Factories;

use App\Models\Tenant\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'state' => $this->faker->optional()->randomElement(['pending', 'paid', 'cancelled', 'refunded']),
            'email_sent' => $this->faker->boolean,
            'total_qty' => $this->faker->optional()->numberBetween(1, 10),
            'sub_total' => $this->faker->optional()->randomFloat(4, 10, 1000),
            'grand_total' => $this->faker->optional()->randomFloat(4, 10, 1000),
            'shipping_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'tax_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'discount_amount' => $this->faker->optional()->randomFloat(4, 0, 50),
            'order_id' => null, // Will be set by the test if needed
            'transaction_id' => $this->faker->optional()->uuid,
        ];
    }
}
