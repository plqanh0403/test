<?php

namespace Database\Factories;

use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AboutUs>
 */
class AboutUsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Company
            'name' => fake()->company(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'address' => fake()->address(),

            // Logo & Favicon
            'light_logo' => 'logos/light-logo.png',
            'dark_logo' => 'logos/dark-logo.png',
            'favicon' => 'logos/favicon.ico',

            // Social
            'facebook' => fake()->url(),
            'youtube' => fake()->url(),
            'linkedin' => fake()->url(),
            'tiktok' => fake()->url(),

            // Description
            'short_description' => fake()->paragraph(),
            'footer_text' => fake()->sentence(),

            // Google Map
            'google_map' => '<iframe src="https://maps.google.com/..."></iframe>',
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),

            // SEO
            'seo_title' => fake()->sentence(6),
            'seo_description' => fake()->paragraph(),
            'seo_keywords' => implode(',', fake()->words(10)),

            'og_image' => 'seo/og-image.jpg',
            'og_title' => fake()->sentence(),

            'og_description' => fake()->paragraph(),

            'canonical_url' => fake()->url(),

            'google_site_verification' => fake()->sha1(),

            'google_analytics' => '
                <script>
                    console.log("Google Analytics");
                </script>
            ',

            'meta_pixel' => '
                <script>
                    console.log("Meta Pixel");
                </script>
            ',
        ];
    }
}
