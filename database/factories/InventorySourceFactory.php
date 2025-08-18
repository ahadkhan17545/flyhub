<?php

namespace Database\Factories;

use App\Models\Tenant\InventorySource;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventorySourceFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = InventorySource::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->optional()->sentence,
            'contact_name' => $this->faker->name,
            'contact_email' => $this->faker->safeEmail,
            'contact_number' => $this->faker->phoneNumber,
            'contact_fax' => $this->faker->optional()->phoneNumber,
            'country' => $this->faker->country,
            'state' => $this->faker->state,
            'city' => $this->faker->city,
            'street' => $this->faker->streetAddress,
            'number' => $this->faker->optional()->buildingNumber,
            'complement' => $this->faker->optional()->secondaryAddress,
            'neighborhood' => $this->faker->optional()->citySuffix,
            'postcode' => $this->faker->postcode,
            'priority' => $this->faker->numberBetween(1, 10),
            'latitude' => round($this->faker->latitude, 5),
            'longitude' => round($this->faker->longitude, 5),
            'status' => $this->faker->boolean,
        ];
    }
}
