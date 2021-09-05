<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            CategoryTranslationSeeder::class,
            TagSeeder::class,
            TagTranslationSeeder::class,
            IngredientSeeder::class,
            IngredientTranslationsSeeder::class,
            MealSeeder::class,
            MealTranslationsSeeder::class
        ]);
    }
}
