<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            "role"=> "superAdmin"
        ]);

        User::create([
            "name"=> "Admin 123",
            "username"=> "admin123",
            "password"=> bcrypt('12345678'),
            "role"=> "admin"
        ]);

        User::create([
            "name"=> "Editor 123",
            "username"=> "editor123",
            "password"=> bcrypt('12345678'),
            "role"=> "editor"
        ]);

        Category::create([
            "name"=> "Technology",
            "slug"=> "technology"
        ]);

        Category::create([
            "name"=> "AI",
            "slug"=> "ai"
        ]);

        Category::create([
            "name"=> "Company Activity",
            "slug"=> "company_activity"
        ]);
    }
}
