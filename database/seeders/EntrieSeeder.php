<?php

namespace Database\Seeders;

use App\Models\Entrie;
use Illuminate\Database\Seeder;

class EntrieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Entrie::factory(100)->create();
    }
}
