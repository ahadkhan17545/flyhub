<?php

namespace Database\Factories;

use App\Models\Tenant\ChannelSyncResult;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelSyncResultFactory extends Factory
{
	/**
	 * @var string
	 */
	protected $model = ChannelSyncResult::class;

	/**
	 * @return array
	 */
	public function definition()
	{
		return [
			'channel_sync_id' => fn () => \App\Models\Tenant\ChannelSync::factory()->create()->id,
			'status' => $this->faker->randomElement(['pending', 'complete', 'failed']),
			'data' => $this->faker->optional()->sentence,
			'result' => $this->faker->optional()->sentence,
			'error' => $this->faker->optional()->sentence,
			'processed' => $this->faker->optional()->numberBetween(0, 5),
			'failed' => $this->faker->optional()->numberBetween(0, 5),
		];
	}
}
