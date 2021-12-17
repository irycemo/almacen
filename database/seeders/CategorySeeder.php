<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Papeleria',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Category::create([
            'name' => 'Equipo de computo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Category::create([
            'name' => 'Mobiliario',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Category::create([
            'name' => 'Equipo de comunicaciones y telecomunicaciones',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
