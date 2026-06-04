<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),


            'category_id' => Category::query()->inRandomOrder()->value('id'),

            'slug' => Str::slug($title . '-' . fake()->unique()->numberBetween(1, 9999)),

            'type' => fake()->randomElement([
                'tech-service',
                'EGEAD-activity',
            ]),

            'title' => $title,

            'seo_title' => $title,

            'seo_description' => fake()->paragraph(),

            'status' => fake()->randomElement([
                'draft',
                'published'
            ]),

            'is_visible' => fake()->boolean(90),

            'content' => fake()->paragraphs(8, true),

            'excerpt' => fake()->sentence(20),

            'thumbnail' => 'blogs/default.jpg',

            'thumbnail_alt' => $title,

            'sort_order' => fake()->numberBetween(1, 100),

            'published_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
