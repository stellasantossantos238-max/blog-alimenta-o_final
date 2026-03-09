<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            FoodCategorySeeder::class,
            OmsRecommendationSeeder::class,
            FoodSeeder::class,
            AuthorSeeder::class,
            PostSeeder::class,
        ]);
    }
}
