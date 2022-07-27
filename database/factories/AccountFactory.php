<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->randomElement(['Tunai', 'BCA', 'BRI', 'BNI', 'Mandiri', 'OVO', 'DANA']),
            'description' => $this->faker->sentence,
            'icon' => ''
        ];
    }
}
