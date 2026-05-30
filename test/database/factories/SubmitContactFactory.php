<?php

namespace Database\Factories;

use App\Models\SubmitContact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubmitContact>
 */
class SubmitContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'company' => fake()->optional()->company(),
            'message' => fake()->paragraphs(3, true),
            'status' => fake()->randomElement([
                'new',
                'seen',
                'processing',
                'processed'
            ]),
            'internal_note' => fake()->optional()->sentence(),
        ];
    }
}
