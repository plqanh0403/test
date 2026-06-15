<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\SubmitContact;
use App\Models\SubmitEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Recruitment;
use App\Models\Service;
use App\Models\ServiceCategory;
use Database\Factories;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            "name"=> "Super Admin 123",
            "username"=> "superadmin123",
            "password"=> bcrypt('12345678'),
            "role"=> "superAdmin",
            'slug' => Str::slug('Super Admin 123' . '-' . Str::random(6)),
        ]);

        User::create([
            "name"=> "Admin 123",
            "username"=> "admin123",
            "password"=> bcrypt('12345678'),
            "role"=> "admin",
            'slug' => Str::slug('Admin 123' . '-' . Str::random(6)),
        ]);

        User::create([
            "name"=> "Editor 123",
            "username"=> "editor123",
            "password"=> bcrypt('12345678'),
            "role"=> "editor",
            'slug' => Str::slug('Editor 123' . '-' . Str::random(6)),
        ]);

        // Category::create([
        //     "name"=> "Technology",
        //     "slug"=> Str::slug("Technology")
        // ]);

        // Category::create([
        //     "name"=> "AI",
        //     "slug"=> Str::slug("AI")
        // ]);

        // Category::create([
        //     "name"=> "Company Activity",
        //     "slug"=> Str::slug("Company Activity")
        // ]);

        // SubmitContact::create([
        //     "name"=> "Contact Một",
        //     "email"=> "contact1@gmail.com",
        //     "message"=> "Test contact 1"
        // ]);

        // SubmitContact::create([
        //     "name"=> "Contact Hai",
        //     "email"=> "contact2@gmail.com",
        //     "message"=> "Test contact 2"
        // ]);

        // SubmitContact::create([
        //     "name"=> "Contact Ba",
        //     "email"=> "contact3@gmail.com",
        //     "message"=> "Test contact 3"
        // ]);

        // SubmitEmail::create([
        //     "email"=> "email1@gmail.com",
        //     "source"=> "Test email 1"
        // ]);

        // SubmitEmail::create([
        //     "email"=> "email2@gmail.com",
        //     "source"=> "Test email 2"
        // ]);

        // SubmitEmail::create([
        //     "email"=> "email3@gmail.com",
        //     "source"=> "Test email 3"
        // ]);

        // Recruitment::create([
        //     "position" => "Software Engineer",
        //     "description" => "We are looking for a skilled Software Engineer to join our team.",
        //     "requirements" => "Bachelor's degree in Computer Science or related field, 3+ years of experience in software development.",
        //     "benefits" => "Competitive salary, health insurance, flexible working hours.",
        //     "location" => "Hanoi, Vietnam",
        //     "work_type" => "full-time",
        //     "work_time" => "Mon - Sat 8:00 - 17:30",
        //     "application_deadline" => now()->addMonth(),
        //     "status" => "open",
        //     "slug" => Str::slug('Software Engineer' . '-' . Str::random(6))
        // ]);

        // Recruitment::create([
        //     "position" => "Product Manager",
        //     "description" => "We are seeking an experienced Product Manager to lead our product development efforts.",
        //     "requirements" => "Bachelor's degree in Business or related field, 5+ years of experience in product management.",
        //     "benefits" => "Competitive salary, health insurance, stock options.",
        //     "location" => "Hanoi, Vietnam",
        //     "work_type" => "full-time",
        //     "work_time" => "Mon - Sat 8:00 - 17:30",
        //     "application_deadline" => now()->addMonth(),
        //     "status" => "open",
        //     "slug" => Str::slug('Product Manager' . '-' . Str::random(6))
        // ]);

        // Recruitment::create([
        //     "position" => "UX/UI Designer",
        //     "description" => "We are looking for a creative UX/UI Designer to design user-friendly interfaces for our products.",
        //     "requirements" => "Bachelor's degree in Design or related field, 3+ years of experience in UX/UI design.",
        //     "benefits" => "Competitive salary, health insurance, flexible working hours.",

        //     "location" => "Hanoi, Vietnam",
        //     "work_type" => "full-time",
        //     "work_time" => "Mon - Sat 8:00 - 17:30",
        //     "application_deadline" => now()->addMonth(),
        //     "status" => "open",
        //     "slug" => Str::slug('UX/UI Designer' . '-' . Str::random(6))
        // ]);

        // ServiceCategory::create([
        //     "name" => "IT Services",
        //     "slug" => Str::slug("IT Services"),
        //     "seo_title" => "IT Services - Our Company",
        //     "seo_description" => "Explore our range of IT services designed to help your business thrive in the digital age.",
        //     "is_visible" => true,
        //     "sort_order" => 1,
        // ]);

        // ServiceCategory::create([
        //     "name" => "Consulting",
        //     "slug" => Str::slug("Consulting"),
        //     "seo_title" => "Consulting Services - Our Company",
        //     "seo_description" => "Discover our consulting services that provide expert guidance to help your business succeed.",
        //     "is_visible" => true,
        //     "sort_order" => 2,
        // ]);

        // ServiceCategory::create([
        //     "name" => "Cloud Solutions",
        //     "slug" => Str::slug("Cloud Solutions"),
        //     "seo_title" => "Cloud Solutions - Our Company",
        //     "seo_description" => "Learn about our cloud solutions that offer scalable and secure options for your business.",
        //     "is_visible" => true,
        //     "sort_order" => 3,
        // ]);

        // Service::create([
        //     "name" => "Web Development",
        //     "category_id" => 1,
        //     "thumbnail" => null,
        //     "thumbnail_alt" => "Web Development Service",
        //     "overview" => "We offer professional web development services to create stunning and functional websites.",
        //     "details" => "Our web development services include custom website design, responsive development, e-commerce solutions, and content management systems.",
        //     "slug" => Str::slug("Web Development"),
        //     "banner_image" => null,
        //     "seo_title" => "Web Development Services - Our Company",
        //     "seo_description" => "Explore our web development services that help you build a strong online presence with a stunning website.",
        //     "seo_keywords" => "web development, website design, e-commerce solutions, responsive development",
        //     "sort_order" => 1,
        // ]);

        // Service::create([
        //     "name" => "IT Consulting",
        //     "category_id" => 2,
        //     "thumbnail" => null,
        //     "thumbnail_alt" => "IT Consulting Service",
        //     "overview" => "Our IT consulting services provide expert guidance to help your business leverage technology effectively.",
        //     "details" => "We offer IT strategy development, technology assessment, and implementation support to ensure your business stays ahead in the digital landscape.",
        //     "slug" => Str::slug("IT Consulting"),
        //     "banner_image" => null,
        //     "seo_title" => "IT Consulting Services - Our Company",
        //     "seo_description" => "Discover our IT consulting services that provide expert guidance to help your business succeed in the digital age.",
        //     "seo_keywords" => "IT consulting, technology strategy, IT assessment, implementation support",
        //     "sort_order" => 2,
        // ]);

        // Service::create([
        //     "name" => "Cloud Migration",
        //     "category_id" => 3,
        //     "thumbnail" => null,
        //     "thumbnail_alt" => "Cloud Migration Service",
        //     "overview" => "Our cloud migration services help you seamlessly transition your applications and data to the cloud.",
        //     "details" => "We provide comprehensive cloud migration solutions, including assessment, planning, and execution to ensure a smooth transition to the cloud.",
        //     "slug" => Str::slug("Cloud Migration"),
        //     "banner_image" => null,
        //     "seo_title" => "Cloud Migration Services - Our Company",
        //     "seo_description" => "Learn about our cloud migration services that offer scalable and secure options for your business to transition to the cloud.",
        //     "seo_keywords" => "cloud migration, cloud solutions, IT services, technology consulting",
        //     "sort_order" => 3,
        // ]);

        // SubmitEmail::factory(50)->create();
        // SubmitContact::factory(50)->create();
        // Category::factory(5)->create();
        // Blog::factory(100)->create();
        // ServiceCategory::factory(5)->create();
        // Service::factory(50)->create();
        // Recruitment::factory(10)->create();
         AboutUs::factory()->create();
    }
}
