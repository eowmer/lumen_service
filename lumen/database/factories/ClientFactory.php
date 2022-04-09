<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' =>$this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$OqqUkaNwWPcVQU0kNpZWYedKWi9sxrTYEJkmdohfKdVub9l2Kic8y',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'post_code' => $this->faker->phoneNumber,
            'contact_number' => $this->faker->phoneNumber
        ];
    }
}
