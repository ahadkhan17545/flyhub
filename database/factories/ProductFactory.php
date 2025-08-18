<?php

namespace Database\Factories;

use App\Models\Tenant\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Product::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['simple', 'configurable', 'virtual', 'downloadable']),
            'description' => $this->faker->text,
            'short_description' => $this->faker->text,
            'new' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'thumbnail' => null,
            'cost' => $this->faker->randomFloat(2, 10, 1000),
            'price' => $this->faker->randomFloat(2, 20, 2000),
            'min_price' => $this->faker->randomFloat(2, 15, 1500),
            'max_price' => $this->faker->randomFloat(2, 25, 2500),
            'special_price' => $this->faker->optional()->randomFloat(2, 15, 1800),
            'special_price_from' => null,
            'special_price_to' => null,
            'color' => $this->faker->colorName,
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'brand' => $this->faker->company,
            'gross_weight' => $this->faker->randomFloat(2, 0.1, 10),
            'net_weight' => $this->faker->randomFloat(2, 0.1, 8),
            'width' => $this->faker->randomFloat(2, 10, 100),
            'height' => $this->faker->randomFloat(2, 10, 100),
            'depth' => $this->faker->randomFloat(2, 10, 100),
            'unit' => $this->faker->randomElement(['kg', 'g', 'lb', 'oz']),
            'ncm' => $this->faker->optional()->numerify('########'),
            'gtin' => $this->faker->optional()->numerify('##########'),
            'mpn' => $this->faker->optional()->bothify('???-####'),

            'remote_id' => $this->faker->optional()->numerify('####'),
            'parent_id' => null,
            'attribute_set_id' => null,
            'main_category_id' => null,
        ];
    }
}
