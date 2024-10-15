<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'card_number' => $this->faker->creditCardNumber,
            'card_holder' => $this->faker->name,
            'expiry_date' => $this->faker->creditCardExpirationDate,
            'cvv' => $this->faker->randomNumber(3),
        ];
    }
}
