<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Request;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntrieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $requests = Request::All();
        $request = $requests->random();

        $date1 = Carbon::now()->subDays(rand(1, 620));
        $date2 = $date1->addDays(rand(1, 360));

        return [
            'article_id' => $request->id,
            'quantity' => 1,
            'price' => $this->faker->numberBetween(500,99999),
            'location' => $request->location,
            'origin' => Arr::random(['donación', 'compra']),
            'description' => $this->faker->text(),
            'created_at' =>$date1,
            'updated_at' => $date2,
        ];
    }
}
