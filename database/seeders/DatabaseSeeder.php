<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\EntrieSeeder;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        /* $this->call(ArticleSeeder::class);
        $this->call(RequestSeeder::class);
        $this->call(EntrieSeeder::class); */
    }
}
