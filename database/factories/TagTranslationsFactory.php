<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\TagTranslations;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagTranslationsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagTranslations::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = new Faker();
        return [
            'tag_id'=>1,
            'title'=>$this->faker->name,
            'locale'=>'en'
        ];
    }
}
