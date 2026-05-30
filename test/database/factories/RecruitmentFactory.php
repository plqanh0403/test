<?php

namespace Database\Factories;

use App\Models\Recruitmemt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recruitmemt>
 */
class RecruitmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'position' => fake()->jobTitle(),
            'description' => fake()->paragraph(),
            'requirements' => fake()->paragraph(),
            'benefits' => fake()->paragraph(),
            'location' => fake()->city(),
            'work_type' => fake()->randomElement([
                'full-time',
                'part-time',
                'remote',
                'hybrid'
            ]),
            'status' => 'open',
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'is_visible' => true,
        ];
    }
}
