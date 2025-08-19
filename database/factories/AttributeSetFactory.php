<?php

namespace Database\Factories;

use App\Models\Tenant\AttributeSet;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeSetFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = AttributeSet::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'status' => $this->faker->boolean,
            'is_user_defined' => $this->faker->boolean,
        ];
    }
}
