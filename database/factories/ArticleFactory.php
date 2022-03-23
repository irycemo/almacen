<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Article;
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

        $number = $this->faker->numberBetween(10000,99999);

        $serial =  $number % 2 == 0 ? $number : null;

        return [
            'name' => $this->faker->sentence(2),
            'brand' => $this->faker->sentence(2),
            'serial' => $serial,
            'stock' => $serial ? 1 :  $this->faker->numberBetween(1,50),
            'description' => $this->faker->text(),
            'location' => Arr::random(Article::UBICACIONES),
            'category_id' => $this->faker->randomElement($categories),
            'created_at' =>$date1,
            'updated_at' => $date2,
        ];
    }
}
