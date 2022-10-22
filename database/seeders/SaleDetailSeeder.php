<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SaleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $saledetail = \App\Models\SaleDetail::factory()
        ->count(50)
        ->create();
    }
}
