<?php

namespace Database\Factories;

use App\Models\Tenant\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Customer::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'cpf_cnpj' => $this->faker->optional()->numerify('###########'),
            'ie' => $this->faker->optional()->numerify('########'),
            'rg' => $this->faker->optional()->numerify('########'),
            'gender' => $this->faker->optional()->randomElement(['M', 'F']),
            'birthdate' => $this->faker->optional()->date(),
            'email' => $this->faker->unique()->safeEmail,
            'status' => $this->faker->boolean,
            'subscribed_to_news_letter' => $this->faker->boolean,
            'phone' => $this->faker->optional()->phoneNumber,
            'cellphone' => $this->faker->optional()->phoneNumber,
            'notes' => $this->faker->optional()->sentence,
            'remote_id' => $this->faker->optional()->uuid,
        ];
    }
}
