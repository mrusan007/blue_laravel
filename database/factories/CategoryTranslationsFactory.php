<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\CategoryTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryTranslationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CategoryTranslations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = new Faker();
        return [
            'category_id'=>1,
            'title'=>$this->faker->name,
            'locale'=>'en'
            
        ];
    }
}
