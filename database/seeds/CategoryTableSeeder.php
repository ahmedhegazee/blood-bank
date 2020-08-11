<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'امراض'
        ]);
        Category::create([
            'name' => 'ادوية'
        ]);
        Category::create([
            'name' => 'اغذية'
        ]);
    }
}
