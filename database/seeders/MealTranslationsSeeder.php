<?php

namespace Database\Seeders;
use App\Models\MealTranslation;
use Illuminate\Database\Seeder;

class MealTranslationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<10;$i++){

            MealTranslation::factory()->create([
                 'meal_id'=>$i,
                 'description' => "Opis jela $i hr",
                 'title'=> "Naziv jela $i hr",
                 'locale'=> 'hr'
             ]);
 
             MealTranslation::factory()->create([
                 'meal_id'=>$i,
                 'description' => "Description of meal $i",
                 'title'=> "Title of meal $i en",
                 'locale'=> 'en'
             ]);
 
             MealTranslation::factory()->create([
                 'meal_id'=>$i,
                 'description' => "Le descriptione $i",
                 'title'=> "Le nome mealez $i fr",
                 'locale'=> 'fr'
             ]);
 
         }
    }
}
