<?php

namespace Database\Factories;

use App\Models\Tenant\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Channel::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->slug,
            'name' => $this->faker->company,
        ];
    }
}
