<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Support\Arr;
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
            'brand' => $this->faker->sentence(2),
            'serial' => $this->faker->numberBetween(10000,99999),
            'stock' => 1,
            'description' => $this->faker->text(),
            'location' => Arr::random(['catastro', 'rpp']),
            'origin' => Arr::random(['compra', 'donación']),
            'comment' => $this->faker->text(),
            'category_id' => $this->faker->randomElement($categories),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
