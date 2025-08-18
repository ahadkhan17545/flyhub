<?php

namespace Database\Factories;

use App\Models\Tenant\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'status' => $this->faker->boolean,
            'remote_id' => $this->faker->optional()->uuid,
            'parent_id' => null, // Will be set by the test if needed
        ];
    }
}
