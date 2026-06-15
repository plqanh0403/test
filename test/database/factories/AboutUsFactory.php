<?php

namespace Database\Factories;

use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
            'name' => 'E-Gead',
            'phone' => '+84(77) 631 9999',
            'email' => 'contact@egeadcompany.com',
            'address' => '217/9 Ngo Quyen Street, Tan An Ward, Buon Ma Thuot City, Dak Lak Province',

            // Logo & Favicon
            'light_logo' => Storage::url('images/light_logo.png'),
            'favicon' => Storage::url('images/favicon.png'),

            'hr_phone' => fake()->phoneNumber(),
            'hr_email' => fake()->companyEmail(),

            // Social
            'facebook' => 'https://www.facebook.com/EGEADCompany?locale=vi_VN',

            // Description
            'footer_text' => fake()->sentence(),

            // Google Map
            'google_map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3892.314269098719!2d108.0552976757202!3d12.692899420926006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3171f72a19d5a35f%3A0xce576448846bf08f!2sC%C3%B4ng%20Ty%20TNHH%20E%20GEAD!5e0!3m2!1svi!2s!4v1780651468635!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',

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
