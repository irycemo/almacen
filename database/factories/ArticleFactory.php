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
        $date1 = Carbon::now()->subDays(rand(1, 620));
        $date2 = $date1->addDays(rand(1, 360));

        return [
            'name' => $this->faker->sentence(2),
            'brand' => $this->faker->sentence(2),
            'serial' => $this->faker->numberBetween(10000,99999),
            'stock' => 1,
            'description' => $this->faker->text(),
            'location' => Arr::random(['catastro', 'rpp']),
            'category_id' => $this->faker->randomElement($categories),
            'created_at' =>$date1,
            'updated_at' => $date2,
        ];
    }
}
