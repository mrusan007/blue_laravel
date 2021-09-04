<?php

namespace Database\Factories;

use App\Models\IngredientTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


class IngredientTranslationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IngredientTranslations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = new Faker();
        return [
            'ingredient_id'=>1,
            'title'=>$this->faker->name,
            'locale'=>'en'
            
        ];
    }
}
