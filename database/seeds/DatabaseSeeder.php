<?php

use App\Models\BloodType;
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
    }
}
