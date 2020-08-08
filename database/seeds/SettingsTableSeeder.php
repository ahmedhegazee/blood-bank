<?php

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name' => 'email',
            'value' => 'mazenanwar47@yahoo.com',
        ]);
        Settings::create([
            'name' => 'phone',
            'value' => '01006383877',
        ]);
        Settings::create([
            'name' => 'youtube',
            'value' => 'http://youtube.com/bloodbank',
        ]);
        Settings::create([
            'name' => 'facebook',
            'value' => 'http://facebook.com/bloodbank',
        ]);
        Settings::create([
            'name' => 'instagram',
            'value' => 'http://instagram.com/bloodbank',
        ]);
        Settings::create([
            'name' => 'twitter',
            'value' => 'http://twitter.com/bloodbank',
        ]);
    }
}
