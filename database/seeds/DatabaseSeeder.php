<?php

use App\Models\BloodType;
use App\Models\Category;
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
        $this->call(GovernsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(BloodTypesTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}
