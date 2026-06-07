<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->words(3, true);

        return [
            'category_id' => ServiceCategory::inRandomOrder()->first()->id,
            'name' => ucfirst($name),
            'thumbnail' => 'services/default-thumbnail.jpg',
            'thumbnail_alt' => $name,
            'overview' => fake()->paragraph(3),
            'details' => fake()->paragraphs(5, true),
            'slug' => Str::slug($name),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'seo_keywords' => implode(',', fake()->words(8)),
            'is_visible' => fake()->boolean(90),
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
