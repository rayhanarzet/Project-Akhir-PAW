<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create categories
        $categories = [
            ['name' => 'Korean Beauty', 'slug' => 'korean-beauty'],
            ['name' => 'Korean Fashion', 'slug' => 'korean-fashion'],
            ['name' => 'K-Pop Merch', 'slug' => 'k-pop-merch'],
            ['name' => 'Korean Food', 'slug' => 'korean-food'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products with random categories
        Product::factory(20)->create();
    }
}
