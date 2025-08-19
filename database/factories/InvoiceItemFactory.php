<?php

namespace Database\Factories;

use App\Models\Tenant\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = InvoiceItem::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->optional()->words(2, true),
            'sku' => $this->faker->optional()->regexify('[A-Z0-9]{8}'),
            'qty' => $this->faker->optional()->numberBetween(1, 10),
            'price' => $this->faker->randomFloat(4, 10, 1000),
            'total' => $this->faker->randomFloat(4, 10, 1000),
            'tax_amount' => $this->faker->optional()->randomFloat(4, 0, 100),
            'discount_percent' => $this->faker->optional()->randomFloat(4, 0, 20),
            'discount_amount' => $this->faker->optional()->randomFloat(4, 0, 50),
            'note' => $this->faker->optional()->sentence,
            'product_id' => null, // Will be set by the test if needed
            'order_item_id' => null, // Will be set by the test if needed
            'invoice_id' => null, // Will be set by the test if needed
            'parent_id' => null, // Will be set by the test if needed
        ];
    }
}
