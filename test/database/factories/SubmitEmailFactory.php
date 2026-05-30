<?php

namespace Database\Factories;

use App\Models\SubmitEmail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SubmitEmail>
 */
class SubmitEmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'source' => fake()->randomElement([
                'Homepage',
                'Footer',
                'Blog',
                'Contact Form',
                'Landing Page',
                null,
            ]),
            'status' => fake()->randomElement([
                'pending',
                'processing',
                'processed',
            ]),
        ];
    }
}
