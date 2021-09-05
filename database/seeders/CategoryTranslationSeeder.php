<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryTranslations;

class CategoryTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        for($i=1;$i<6;$i++){

           CategoryTranslations::factory()->create([
                'category_id' => $i,
                'title'=> "Kategorija $i hr",
                'locale'=> 'hr'
            ]);

            CategoryTranslations::factory()->create([
                'category_id' => $i,
                'title'=> "Category $i en",
                'locale'=> 'en'
            ]);

            CategoryTranslations::factory()->create([
                'category_id' => $i,
                'title'=> "Categorie $i fr",
                'locale'=> 'fr'
            ]);

        }
    }
}
