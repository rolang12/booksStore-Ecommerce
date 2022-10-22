<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DenominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $denomination = \App\Models\Denomination::factory()
        ->count(20)
        ->create();
    }
}
