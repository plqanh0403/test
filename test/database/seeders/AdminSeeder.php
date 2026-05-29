<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

        Category::create([
            "name"=> "Technology",
            "slug"=> Str::slug("Technology")
        ]);

        Category::create([
            "name"=> "AI",
            "slug"=> Str::slug("AI")
        ]);

        Category::create([
            "name"=> "Company Activity",
            "slug"=> Str::slug("Company Activity")
        ]);
    }
}
