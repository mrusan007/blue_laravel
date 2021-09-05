<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\MealTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealTranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MealTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = new Faker();
        return [
            'meal_id'=>1,
            'title'=>"title",
            'description'=>$this->faker->text,
            'locale'=>'en'
            
        ];
    }
}
