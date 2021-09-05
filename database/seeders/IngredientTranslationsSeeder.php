<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IngredientTranslations;
class IngredientTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<6;$i++){

            IngredientTranslations::factory()->create([
                 'ingredient_id' => $i,
                 'title'=> "Sastojak $i hr",
                 'locale'=> 'hr'
             ]);
 
             IngredientTranslations::factory()->create([
                 'ingredient_id' => $i,
                 'title'=> "Ingredient $i en",
                 'locale'=> 'en'
             ]);
 
             IngredientTranslations::factory()->create([
                 'ingredient_id' => $i,
                 'title'=> "Le Ingredie $i fr",
                 'locale'=> 'fr'
             ]);
 
         }
    }
}
