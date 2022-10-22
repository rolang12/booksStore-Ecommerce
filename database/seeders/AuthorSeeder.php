<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Category = \App\Models\Author::factory()
        ->count(20)
        ->create();
    }
}
