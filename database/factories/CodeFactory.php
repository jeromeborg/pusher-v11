<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Code>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $admin = User::where('role', 'admin')->first();

        return [
            'title' => fake()->title(),
            'code' => fake()->paragraph($nbSentences = 3, $variableNbSentences = true),
            'user_id' => $admin->id
        ];
    }
}
