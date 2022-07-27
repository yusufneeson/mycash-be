<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_id' => 1,
            'type' => $this->faker->randomElement(['in', 'out', 'conv']),
            'amount' => random_int(135000, 7730000),
            'description' => $this->faker->sentence
        ];
    }
}
