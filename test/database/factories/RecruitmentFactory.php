<?php

namespace Database\Factories;

use App\Models\Recruitmemt;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $position = fake()->jobTitle();

        return [
            'position' => $position,
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
            'work_time' => fake()->sentence(),
            'thumbnail' => 'services/default-thumbnail.jpg',
            'thumbnail_alt' => $position,
            'status' => 'open',
            'application_deadline' => fake()->optional()->dateTimeBetween('now', '1 month'),
            'slug' => Str::slug($position . '-' . fake()->unique()->numberBetween(1, 9999)),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'is_visible' => true,
        ];
    }
}
