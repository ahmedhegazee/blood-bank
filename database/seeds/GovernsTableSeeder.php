<?php

use App\Models\Government;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $governs
            = ['القاهرة',  'الجيزة',  'الأسكندرية',  'الدقهلية',  'البحر الأحمر',  'البحيرة',  'الفيوم',  'الغربية',  'الإسماعلية',   'المنوفية',   'المنيا',   'القليوبية',   'الوادي الجديد',   'السويس',   'اسوان',   'اسيوط',   'بني سويف',   'بورسعيد',   'دمياط',   'الشرقية',   'جنوب سيناء',   'كفر الشيخ',   'مطروح',   'الأقصر',   'قنا',   'شمال سيناء',   'سوهاج'];
        for ($i = 0; $i < sizeof($governs); $i++) {
            Government::create(['name' => $governs[$i]]);
        }
    }
}
