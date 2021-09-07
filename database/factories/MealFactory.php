<?php

namespace Database\Factories;
use Faker\Generator as Faker;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker =  new Faker();
        return [
            'category_id'=>1,
            'status'=>'created',
        ];
    }
}
