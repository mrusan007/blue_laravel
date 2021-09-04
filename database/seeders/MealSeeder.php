<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;
use App\Models\Tag;
use App\Models\Ingredient;


class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        for($i=0;$i<9;$i++)
        {
            Meal::factory()
                ->create([
                    'category_id'=>rand(1,5),
                    ]);
        }

        $tags = Tag::all();
        $ingredients = Ingredient::all();
        $meals = Meal::all();

        foreach($meals as $meal){
            $meal->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());
            $meal->ingredients()->attach($ingredients->random(rand(1, 3))->pluck('id')->toArray());
        }


    }
}
