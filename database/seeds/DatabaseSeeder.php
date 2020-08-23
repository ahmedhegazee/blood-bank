<?php

use App\Models\BloodType;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $this->call(ClientsTableSeeder::class);
        DB::statement("INSERT INTO `permissions` (`id`,`name`, `display_name`, `description`, `created_at`, `updated_at`, `group`) VALUES
('1', 'add-post', 'اضافة مقال', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'مقالات'),
('2', 'edit-post', 'تعديل مقال', NULL, '2020-08-23 09:06:15', '2020-08-23 09:07:55', 'مقالات'),
('3', 'delete-post', 'حذف مقال', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مقالات'),
('4', 'show-posts', 'عرض مقالات', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مقالات'),
('5', 'add-users', 'اضافة مستخدمين', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مستخدمين'),
('6', 'edit-user', 'تعديل مستخدم', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'مستخدمين'),
('6', 'delete-user', 'حذف مستخدم', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مستخدمين'),
('7', 'show-users', 'عرض مستخدمين', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مستخدمين'),
('8', 'add-category', 'اضافة تصنيف', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'تصنيفات'),
('9', 'edit-category', 'تعديل تصنيف', NULL, '2020-08-23 09:06:15', '2020-08-23 09:07:55', 'تصنيفات'),
('10', 'delete-category', 'حذف تصنيف', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'تصنيفات'),
('11', 'show-categories', 'عرض تصنيفات', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'تصنيفات'),
('12', 'add-role', 'اضافة رتبة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'رتب'),
('13', 'edit-role', 'تعديل رتبه', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'رتب'),
('14', 'delete-role', 'حذف رتبة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'رتب'),
('15', 'show-roles', 'عرض رتب', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'رتب'),
('16', 'edit-government', 'تعديل محافظة', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'محافظة'),
('17', 'show-governments', 'عرض محافظة', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'محافظة'),
('18', 'delete-government', 'حذف محافظة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'محافظة'),
('19', 'add-government', 'عرض محافظة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'محافظة'),
('20', 'edit-city', 'اضافة مدينة', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'مدن'),
('21', 'show-cities', 'عرض مدن', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'مدن'),
('22', 'delete-city', 'حذف مدينة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مدن'),
('23', 'add-city', 'اضافة مدينة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مدن'),
('25', 'delete-client', 'حذف عميل', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء'),
('26', 'show-clients', 'عرض عملاء', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء'),
('27', 'delete-request', 'حذف طلب تبرع', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء'),
('28', 'show-requests', 'عرض طلبات التبرع', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء');
");
    }
}