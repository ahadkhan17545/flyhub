<?php

namespace Database\Factories;

use App\Models\Tenant\ProductInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductInventoryFactory extends Factory
{
	/**
	 * @var string
	 */
	protected $model = ProductInventory::class;

	/**
	 * @return array
	 */
	public function definition()
	{
		return [
			'qty' => $this->faker->numberBetween(0, 1000),
			'product_id' => null, // Will be set by test
			'inventory_source_id' => null, // Will be set by test
		];
	}
}
