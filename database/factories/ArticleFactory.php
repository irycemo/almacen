<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $categories = Category::pluck('id');

        return [
            'name' => $this->faker->sentence(2),
            'stock' => $this->faker->numberBetween(1,100),
            'description' => $this->faker->text(),
            'category_id' => $this->faker->randomElement($categories),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
