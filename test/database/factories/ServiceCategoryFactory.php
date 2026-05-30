<?php

namespace Database\Factories;

use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends Factory<ServiceCategory>
 */
class ServiceCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(2, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),

            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),

            'is_visible' => fake()->boolean(90),
            'sort_order' => fake()->numberBetween(1, 20),
        ];
    }
}
