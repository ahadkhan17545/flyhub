<?php

namespace Database\Factories;

use App\Models\Tenant\ChannelSync;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelSyncFactory extends Factory
{
	/**
	 * @var string
	 */
	protected $model = ChannelSync::class;

	/**
	 * @return array
	 */
	public function definition()
	{
		return [
			'channel' => $this->faker->randomElement(['bling', 'woocommerce']),
			'resource' => $this->faker->randomElement(['products', 'orders', 'customers']),
			'resource_id' => $this->faker->optional()->numberBetween(1, 1000),
			'message' => $this->faker->optional()->sentence,
			'status' => $this->faker->randomElement(['in_queue', 'pending', 'in_progress', 'complete', 'failed']),
			'processed' => $this->faker->numberBetween(0, 10),
			'failed' => $this->faker->numberBetween(0, 5),
			'total' => $this->faker->numberBetween(0, 10),
			'current_page' => $this->faker->numberBetween(0, 5),
			'total_pages' => $this->faker->numberBetween(0, 5),
			'last_received_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
		];
	}
}
