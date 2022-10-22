<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            AuthorSeeder::class,
            ProductSeeder::class,
            SaleSeeder::class,
            SaleDetailSeeder::class,
            CommentSeeder::class,
            DenominationSeeder::class,
        ]);
    }
}
