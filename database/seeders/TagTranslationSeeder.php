<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TagTranslations;
class TagTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<6;$i++){

            TagTranslations::factory()->create([
                 'tag_id' => $i,
                 'title'=> "Teg $i hr",
                 'locale'=> 'hr'
             ]);
 
             TagTranslations::factory()->create([
                 'tag_id' => $i,
                 'title'=> "Tag $i en",
                 'locale'=> 'en'
             ]);
 
             TagTranslations::factory()->create([
                 'tag_id' => $i,
                 'title'=> "Le Tag $i en",
                 'locale'=> 'fr'
             ]);
 
         }
    }
}
