-- -------------------------------------------------------------
-- TablePlus 3.7.1(332)
--
-- https://tableplus.com/
--
-- Database: bloodbank
-- Generation Time: 2020-08-24 08:36:13.7620
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


INSERT INTO permissions
    (id, name, display_name, description, created_at, updated_at, group, routes)
VALUES
    ('1', 'add-post', 'اضافة مقال', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'مقالات', 'post.create,post.store'),
    ('2', 'edit-post', 'تعديل مقال', NULL, '2020-08-23 09:06:15', '2020-08-23 09:07:55', 'مقالات', 'post.edit,post.update'),
    ('3', 'delete-post', 'حذف مقال', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مقالات', 'post.destroy'),
    ('4', 'add-users', 'اضافة مستخدمين', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مستخدمين', 'user.create,user.store'),
    ('5', 'edit-user', 'تعديل مستخدم', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'مستخدمين', 'user.edit,user.update'),
    ('7', 'delete-user', 'حذف مستخدم', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مستخدمين', 'user.destroy'),
    ('8', 'show-users', 'عرض مستخدمين', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مستخدمين', 'user.index'),
    ('15', 'add-category', 'اضافة تصنيف', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'تصنيفات', 'category.create,category.store'),
    ('16', 'edit-category', 'تعديل تصنيف', NULL, '2020-08-23 09:06:15', '2020-08-23 09:07:55', 'تصنيفات', 'category.edit,category.update'),
    ('17', 'delete-category', 'حذف تصنيف', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'تصنيفات', 'category.destroy'),
    ('18', 'add-role', 'اضافة رتبة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'رتب', 'role.create,role.store'),
    ('19', 'edit-role', 'تعديل رتبه', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'رتب', 'role.edit,role.update'),
    ('20', 'show-categories', 'عرض تصنيفات', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'تصنيفات', 'category.index'),
    ('21', 'delete-role', 'حذف رتبة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'رتب', 'role.destroy'),
    ('22', 'show-roles', 'عرض رتب', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'رتب', 'role.index'),
    ('23', 'edit-government', 'تعديل محافظة', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'محافظة', 'govern.edit,govern.update'),
    ('24', 'show-governments', 'عرض محافظة', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'محافظة', 'govern.index'),
    ('25', 'delete-government', 'حذف محافظة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'محافظة', 'govern.destroy'),
    ('26', 'add-government', 'اضافة محافظة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'محافظة', 'govern.store,govern.create'),
    ('27', 'edit-city', 'تعديل مدينة', NULL, '2020-08-23 09:07:34', '2020-08-23 09:07:34', 'مدن', 'city.edit,city.update'),
    ('28', 'show-cities', 'عرض مدن', NULL, '2020-08-23 09:06:15', '2020-08-23 09:08:02', 'مدن', 'city.index'),
    ('29', 'delete-city', 'حذف مدينة', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مدن', 'city.destroy'),
    ('30', 'add-city', 'اضافة مدينة', NULL, '2020-08-23 09:07:07', '2020-08-23 09:07:41', 'مدن', 'city.store,city.create'),
    ('31', 'show-posts', 'عرض مقالات', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'مقالات', 'post.index'),
    ('32', 'delete-client', 'حذف عميل', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء', 'client.destroy'),
    ('33', 'show-clients', 'عرض عملاء', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'عملاء', 'client.index'),
    ('34', 'delete-request', 'حذف طلب تبرع', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'طلبات تبرع', 'request.destroy'),
    ('35', 'show-requests', 'عرض طلبات التبرع', NULL, '2020-08-23 09:06:45', '2020-08-23 09:07:48', 'طلبات تبرع', 'request.index');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
