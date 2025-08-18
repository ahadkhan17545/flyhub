<?php

namespace Database\Factories;

use App\Models\Tenant\OrderPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderPaymentFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = OrderPayment::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'method' => $this->faker->randomElement(['credit_card', 'debit_card', 'bank_transfer', 'cash']),
            'status' => $this->faker->randomElement(['pending', 'completed', 'failed', 'cancelled']),
            'transaction_id' => $this->faker->optional()->uuid,
            'installments' => $this->faker->numberBetween(1, 12),
            'total_paid' => $this->faker->randomFloat(4, 10, 1000),
            'notes' => $this->faker->optional()->sentence,
            'issued_date' => $this->faker->optional()->date(),
            'due_date' => $this->faker->optional()->date(),
            'order_id' => null // Will be set by the test
        ];
    }
}
