<?php

namespace Database\Seeders;

use App\Models\admins;
use App\Models\User;
use App\Models\categories;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\admin;
use Database\Seeders\categorySeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            admin::class,
            categorySeeder::class
        ]);
    }
}
