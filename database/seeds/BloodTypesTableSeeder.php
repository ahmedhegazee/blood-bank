<?php

use App\Models\BloodType;
use Illuminate\Database\Seeder;

class BloodTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BloodType::create(['name' => 'A+']);
        BloodType::create(['name' => 'A-']);
        BloodType::create(['name' => 'B+']);
        BloodType::create(['name' => 'B-']);
        BloodType::create(['name' => 'AB+']);
        BloodType::create(['name' => 'AB']);
        BloodType::create(['name' => 'O+']);
        BloodType::create(['name' => 'O-']);
    }
}
