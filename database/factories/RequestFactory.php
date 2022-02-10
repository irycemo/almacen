<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $users = User::pluck('id');

        $rand = random_int(1,10);

        $array = array();

        for($i = 1; $i <= $rand; $i++){

            $array[] = array(
                            'id' => random_int(1,100),
                            'article' => $this->faker->sentence(2),
                            'quantity' =>  random_int(1,10),
                            'brand' => $this->faker->sentence(1),
                            'serial' => random_int(1000,10000),
                        );
        }

        return [
            'number' => $this->faker->unique()->numberBetween(1,100),
            'content' => json_encode($array, JSON_FORCE_OBJECT),
            'comment' => $this->faker->text(),
            'status'=> $this->faker->randomElement(['rechazada','aceptada','entregada','solicitada']),
            'created_by' => $this->faker->randomElement($users),
            'updated_by' => $this->faker->randomElement($users)
        ];
    }
}
