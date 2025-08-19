<?php

namespace Database\Factories;

use App\Models\Tenant\Shipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Shipment::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->optional()->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'carrier' => $this->faker->optional()->randomElement(['fedex', 'ups', 'usps', 'dhl']),
            'method' => $this->faker->optional()->randomElement(['ground', 'express', 'overnight', 'standard']),
            'track_number' => $this->faker->optional()->regexify('[A-Z0-9]{10,15}'),
            'email_sent' => $this->faker->boolean,
            'price' => $this->faker->randomFloat(4, 5, 100),
            'weight' => $this->faker->optional()->randomFloat(2, 0.1, 50.0),
            'width' => $this->faker->optional()->randomFloat(2, 1, 100),
            'height' => $this->faker->optional()->randomFloat(2, 1, 100),
            'depth' => $this->faker->optional()->randomFloat(2, 1, 100),
            'customer_id' => null, // Will be set by the test if needed
            'order_id' => null, // Will be set by the test if needed
            'inventory_source_id' => null, // Will be set by the test if needed
        ];
    }
}
