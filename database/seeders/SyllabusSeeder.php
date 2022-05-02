<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Syllabus;

class SyllabusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $syllabusLists =[
            array(1, 'storage/syllabuscover/1645608162.jpg', 'storage/syllabuspdf/1645542812.pdf', 'Student', 271, 5, 1, NULL, '2022-02-22 08:43:32', '2022-02-23 02:52:42'),
            array(2, 'storage/syllabuscover/1645543426.jpg', 'storage/syllabuspdf/1645543426.pdf', 'Student', 272, 5, 1, NULL, '2022-02-22 08:53:46', '2022-02-22 08:53:46'),
            array(3, 'storage/syllabuscover/1645543473.jpg', 'storage/syllabuspdf/1645543473.pdf', 'Student', 273, 5, 1, NULL, '2022-02-22 08:54:33', '2022-02-22 08:54:33'),
            array(4, 'storage/syllabuscover/1645543489.jpg', 'storage/syllabuspdf/1645543489.pdf', 'Student', 274, 5, 1, NULL, '2022-02-22 08:54:49', '2022-02-22 08:54:49'),
            array(5, 'storage/syllabuscover/1645609117.png', 'storage/syllabuspdf/1645609117.pdf', 'Student', 1, 5, 1, NULL, '2022-02-23 03:08:37', '2022-02-23 03:10:17'),
            array(6, 'storage/syllabuscover/1645617212.png', 'storage/syllabuspdf/1645617212.pdf', 'Student', 2, 5, 1, NULL, '2022-02-23 05:23:32', '2022-02-23 05:23:32'),
            array(7, 'storage/syllabuscover/1645617299.png', 'storage/syllabuspdf/1645617299.pdf', 'Student', 3, 5, 1, NULL, '2022-02-23 05:24:59', '2022-02-23 05:24:59'),
            array(8, 'storage/syllabuscover/1645617322.png', 'storage/syllabuspdf/1645617322.pdf', 'Student', 4, 5, 1, NULL, '2022-02-23 05:25:22', '2022-02-23 05:25:22'),
            array(9, 'storage/syllabuscover/1645617407.png', 'storage/syllabuspdf/1645617407.pdf', 'Student', 5, 5, 1, NULL, '2022-02-23 05:26:47', '2022-02-23 05:26:47'),
            array(10, 'storage/syllabuscover/1645617519.png', 'storage/syllabuspdf/1645617519.pdf', 'Student', 6, 5, 1, NULL, '2022-02-23 05:28:39', '2022-02-23 05:28:39'),
            array(11, 'storage/syllabuscover/1645617563.png', 'storage/syllabuspdf/1645617563.pdf', 'Student', 7, 5, 1, NULL, '2022-02-23 05:29:23', '2022-02-23 05:29:23'),
            array(12, 'storage/syllabuscover/1645617716.png', 'storage/syllabuspdf/1645617716.pdf', 'Student', 9, 5, 1, NULL, '2022-02-23 05:31:56', '2022-02-23 05:31:56'),
            array(13, 'storage/syllabuscover/1645617735.png', 'storage/syllabuspdf/1645617735.pdf', 'Student', 10, 5, 1, NULL, '2022-02-23 05:32:15', '2022-02-23 05:32:15'),
            array(14, 'storage/syllabuscover/1645617813.png', 'storage/syllabuspdf/1645617813.pdf', 'Student', 12, 5, 1, NULL, '2022-02-23 05:33:33', '2022-02-23 05:33:33'),
            array(15, 'storage/syllabuscover/1645618727.png', 'storage/syllabuspdf/1645618727.pdf', 'Student', 13, 5, 1, NULL, '2022-02-23 05:48:47', '2022-02-23 05:48:47'),
            array(16, 'storage/syllabuscover/1645618931.png', 'storage/syllabuspdf/1645618931.pdf', 'Student', 14, 5, 1, NULL, '2022-02-23 05:52:11', '2022-02-23 05:52:11'),
            array(17, 'storage/syllabuscover/1645618969.png', 'storage/syllabuspdf/1645618969.pdf', 'Student', 15, 5, 1, NULL, '2022-02-23 05:52:49', '2022-02-23 05:52:49'),
            array(18, 'storage/syllabuscover/1645619025.png', 'storage/syllabuspdf/1645619025.pdf', 'Student', 16, 5, 1, NULL, '2022-02-23 05:53:45', '2022-02-23 05:53:45'),
            array(19, 'storage/syllabuscover/1645619045.png', 'storage/syllabuspdf/1645619045.pdf', 'Student', 17, 5, 1, NULL, '2022-02-23 05:54:05', '2022-02-23 05:54:05'),
            array(20, 'storage/syllabuscover/1645619381.png', 'storage/syllabuspdf/1645619381.pdf', 'Student', 18, 5, 1, NULL, '2022-02-23 05:59:41', '2022-02-23 05:59:41'),
            array(21, 'storage/syllabuscover/1645619512.png', 'storage/syllabuspdf/1645619512.pdf', 'Student', 19, 5, 1, NULL, '2022-02-23 06:01:52', '2022-02-23 06:01:52'),
            array(22, 'storage/syllabuscover/1645619593.png', 'storage/syllabuspdf/1645619593.pdf', 'Student', 26, 5, 1, NULL, '2022-02-23 06:03:13', '2022-02-23 06:03:13'),
            array(23, 'storage/syllabuscover/1645619639.png', 'storage/syllabuspdf/1645619639.pdf', 'Student', 24, 5, 1, NULL, '2022-02-23 06:03:59', '2022-02-23 06:03:59'),
            array(24, 'storage/syllabuscover/1645619682.png', 'storage/syllabuspdf/1645619682.pdf', 'Student', 22, 5, 1, NULL, '2022-02-23 06:04:42', '2022-02-23 06:04:42'),
            array(25, 'storage/syllabuscover/1645619714.png', 'storage/syllabuspdf/1645619714.pdf', 'Student', 21, 5, 1, NULL, '2022-02-23 06:05:14', '2022-02-23 06:05:14'),
            array(26, 'storage/syllabuscover/1645620948.png', 'storage/syllabuspdf/1645620948.pdf', 'Student', 25, 5, 1, NULL, '2022-02-23 06:25:48', '2022-02-23 06:25:48'),
            array(27, 'storage/syllabuscover/1645620984.png', 'storage/syllabuspdf/1645620984.pdf', 'Student', 27, 5, 1, NULL, '2022-02-23 06:26:24', '2022-02-23 06:26:24'),
            array(28, 'storage/syllabuscover/1645621087.png', 'storage/syllabuspdf/1645621087.pdf', 'Student', 28, 5, 1, NULL, '2022-02-23 06:28:07', '2022-02-23 06:28:07'),
            array(29, 'storage/syllabuscover/1645699226.png', 'storage/syllabuspdf/1645699226.pdf', 'Student', 29, 5, 1, NULL, '2022-02-24 04:10:26', '2022-02-24 04:10:26'),
            array(30, 'storage/syllabuscover/1645699267.png', 'storage/syllabuspdf/1645699267.pdf', 'Student', 30, 5, 1, NULL, '2022-02-24 04:11:07', '2022-02-24 04:11:07'),
            array(31, 'storage/syllabuscover/1645699318.png', 'storage/syllabuspdf/1645699318.pdf', 'Student', 31, 5, 1, NULL, '2022-02-24 04:11:58', '2022-02-24 04:11:58'),
            array(32, 'storage/syllabuscover/1645699499.png', 'storage/syllabuspdf/1645699499.pdf', 'Student', 32, 5, 1, NULL, '2022-02-24 04:14:59', '2022-02-24 04:14:59'),
            array(33, 'storage/syllabuscover/1645699555.png', 'storage/syllabuspdf/1645699555.pdf', 'Student', 33, 5, 1, NULL, '2022-02-24 04:15:55', '2022-02-24 04:15:55'),
            array(34, 'storage/syllabuscover/1645699606.png', 'storage/syllabuspdf/1645699606.pdf', 'Student', 34, 5, 1, NULL, '2022-02-24 04:16:46', '2022-02-24 04:16:46'),
            array(35, 'storage/syllabuscover/1645699829.png', 'storage/syllabuspdf/1645699829.pdf', 'Student', 36, 5, 1, NULL, '2022-02-24 04:20:29', '2022-02-24 04:20:29'),
            array(36, 'storage/syllabuscover/1645699867.png', 'storage/syllabuspdf/1645699867.pdf', 'Student', 37, 5, 1, NULL, '2022-02-24 04:21:07', '2022-02-24 04:21:07'),
            array(37, 'storage/syllabuscover/1645699909.png', 'storage/syllabuspdf/1645699909.pdf', 'Student', 43, 5, 1, NULL, '2022-02-24 04:21:49', '2022-02-24 04:21:49'),
            array(38, 'storage/syllabuscover/1645699966.png', 'storage/syllabuspdf/1645699966.pdf', 'Student', 39, 5, 1, NULL, '2022-02-24 04:22:46', '2022-02-24 04:22:46'),
            array(39, 'storage/syllabuscover/1645700226.jpg', 'storage/syllabuspdf/1645700135.pdf', 'Student', 45, 5, 1, NULL, '2022-02-24 04:25:35', '2022-02-24 04:27:06'),
            array(40, 'storage/syllabuscover/1645700213.jpg', 'storage/syllabuspdf/1645700213.pdf', 'Student', 46, 5, 1, NULL, '2022-02-24 04:26:53', '2022-02-24 04:26:53'),
            array(41, 'storage/syllabuscover/1645700322.png', 'storage/syllabuspdf/1645700322.pdf', 'Student', 47, 5, 1, NULL, '2022-02-24 04:28:42', '2022-02-24 04:28:42'),
            array(42, 'storage/syllabuscover/1645700346.png', 'storage/syllabuspdf/1645700346.pdf', 'Student', 48, 5, 1, NULL, '2022-02-24 04:29:06', '2022-02-24 04:29:06'),
            array(43, 'storage/syllabuscover/1645700445.png', 'storage/syllabuspdf/1645700750.pdf', 'Student', 49, 5, 1, NULL, '2022-02-24 04:30:45', '2022-02-24 04:35:50'),
            array(44, 'storage/syllabuscover/1645700543.png', 'storage/syllabuspdf/1645700543.pdf', 'Student', 50, 5, 1, NULL, '2022-02-24 04:32:23', '2022-02-24 04:32:23'),
            array(45, 'storage/syllabuscover/1645701102.png', 'storage/syllabuspdf/1645701102.pdf', 'Student', 94, 5, 1, NULL, '2022-02-24 04:41:42', '2022-02-24 04:41:42'),
            array(46, 'storage/syllabuscover/1645701149.png', 'storage/syllabuspdf/1645701149.pdf', 'Student', 52, 5, 1, NULL, '2022-02-24 04:42:29', '2022-02-24 04:42:29'),
            array(47, 'storage/syllabuscover/1645701184.jpg', 'storage/syllabuspdf/1645701184.pdf', 'Student', 53, 5, 1, NULL, '2022-02-24 04:43:04', '2022-02-24 04:43:04'),
            array(48, 'storage/syllabuscover/1645701235.png', 'storage/syllabuspdf/1645701236.pdf', 'Student', 93, 5, 1, NULL, '2022-02-24 04:43:56', '2022-02-24 04:43:56'),
            array(49, 'storage/syllabuscover/1645701271.png', 'storage/syllabuspdf/1645701271.pdf', 'Student', 59, 5, 1, NULL, '2022-02-24 04:44:31', '2022-02-24 04:44:31'),
            array(50, 'storage/syllabuscover/1645701391.png', 'storage/syllabuspdf/1645701391.pdf', 'Student', 61, 5, 1, NULL, '2022-02-24 04:46:31', '2022-02-24 04:46:31'),
            array(51, 'storage/syllabuscover/1645701449.png', 'storage/syllabuspdf/1645701449.pdf', 'Student', 62, 5, 1, NULL, '2022-02-24 04:47:29', '2022-02-24 04:47:29'),
            array(52, 'storage/syllabuscover/1645701520.png', 'storage/syllabuspdf/1645701520.pdf', 'Student', 64, 5, 1, NULL, '2022-02-24 04:48:40', '2022-02-24 04:48:40'),
            array(53, 'storage/syllabuscover/1645701795.png', 'storage/syllabuspdf/1645701795.pdf', 'Student', 63, 5, 1, NULL, '2022-02-24 04:53:15', '2022-02-24 04:53:15'),
            array(54, 'storage/syllabuscover/1645701832.png', 'storage/syllabuspdf/1645701832.pdf', 'Student', 64, 5, 1, NULL, '2022-02-24 04:53:52', '2022-02-24 04:53:52'),
            array(55, 'storage/syllabuscover/1645701856.png', 'storage/syllabuspdf/1645701856.pdf', 'Student', 95, 5, 1, NULL, '2022-02-24 04:54:16', '2022-02-24 04:54:16'),
            array(56, 'storage/syllabuscover/1645702069.png', 'storage/syllabuspdf/1645702069.pdf', 'Student', 76, 5, 1, NULL, '2022-02-24 04:57:49', '2022-02-24 04:57:49'),
            array(57, 'storage/syllabuscover/1645702152.png', 'storage/syllabuspdf/1645702152.pdf', 'Student', 77, 5, 1, NULL, '2022-02-24 04:59:12', '2022-02-24 04:59:12'),
            array(58, 'storage/syllabuscover/1645702182.png', 'storage/syllabuspdf/1645702182.pdf', 'Student', 78, 5, 1, NULL, '2022-02-24 04:59:42', '2022-02-24 04:59:42'),
            array(59, 'storage/syllabuscover/1645702243.png', 'storage/syllabuspdf/1645702243.pdf', 'Student', 79, 5, 1, NULL, '2022-02-24 05:00:43', '2022-02-24 05:00:43'),
            array(60, 'storage/syllabuscover/1645702273.png', 'storage/syllabuspdf/1645702273.pdf', 'Student', 80, 5, 1, NULL, '2022-02-24 05:01:13', '2022-02-24 05:01:13'),
            array(61, 'storage/syllabuscover/1645702327.png', 'storage/syllabuspdf/1645702327.pdf', 'Student', 81, 5, 1, NULL, '2022-02-24 05:02:07', '2022-02-24 05:02:07'),
            array(62, 'storage/syllabuscover/1645702347.png', 'storage/syllabuspdf/1645702347.pdf', 'Student', 82, 5, 1, NULL, '2022-02-24 05:02:27', '2022-02-24 05:02:27'),
            array(63, 'storage/syllabuscover/1645702389.png', 'storage/syllabuspdf/1645702389.pdf', 'Student', 132, 5, 1, NULL, '2022-02-24 05:03:09', '2022-02-24 05:03:09'),
            array(64, 'storage/syllabuscover/1645702424.png', 'storage/syllabuspdf/1645702424.pdf', 'Student', 133, 5, 1, NULL, '2022-02-24 05:03:44', '2022-02-24 05:03:44'),
            array(65, 'storage/syllabuscover/1645702461.png', 'storage/syllabuspdf/1645702461.pdf', 'Student', 136, 5, 1, NULL, '2022-02-24 05:04:21', '2022-02-24 05:04:21'),
            array(66, 'storage/syllabuscover/1645702502.png', 'storage/syllabuspdf/1645702502.pdf', 'Student', 134, 5, 1, NULL, '2022-02-24 05:05:02', '2022-02-24 05:05:02'),
            array(67, 'storage/syllabuscover/1645702530.png', 'storage/syllabuspdf/1645702530.pdf', 'Student', 135, 5, 1, NULL, '2022-02-24 05:05:30', '2022-02-24 05:05:30'),
            array(68, 'storage/syllabuscover/1645702698.jpg', 'storage/syllabuspdf/1645702698.pdf', 'Student', 143, 5, 1, NULL, '2022-02-24 05:08:18', '2022-02-24 05:08:18'),
            array(69, 'storage/syllabuscover/1645702738.jpg', 'storage/syllabuspdf/1645702738.pdf', 'Student', 100, 5, 1, NULL, '2022-02-24 05:08:58', '2022-02-24 05:08:58'),
            array(70, 'storage/syllabuscover/1645702776.jpg', 'storage/syllabuspdf/1645702776.pdf', 'Student', 101, 5, 1, NULL, '2022-02-24 05:09:36', '2022-02-24 05:09:36'),
            array(71, 'storage/syllabuscover/1645702829.jpg', 'storage/syllabuspdf/1645702829.pdf', 'Student', 103, 5, 1, NULL, '2022-02-24 05:10:29', '2022-02-24 05:10:29'),
            array(72, 'storage/syllabuscover/1645702850.jpg', 'storage/syllabuspdf/1645702850.pdf', 'Student', 104, 5, 1, NULL, '2022-02-24 05:10:50', '2022-02-24 05:10:50'),
            array(73, 'storage/syllabuscover/1645702884.jpg', 'storage/syllabuspdf/1645702884.pdf', 'Student', 105, 5, 1, NULL, '2022-02-24 05:11:24', '2022-02-24 05:11:24'),
            array(74, 'storage/syllabuscover/1645702959.jpg', 'storage/syllabuspdf/1645702959.pdf', 'Student', 137, 5, 1, NULL, '2022-02-24 05:12:39', '2022-02-24 05:12:39'),
            array(75, 'storage/syllabuscover/1645703003.jpg', 'storage/syllabuspdf/1645703003.pdf', 'Student', 138, 5, 1, NULL, '2022-02-24 05:13:23', '2022-02-24 05:13:23'),
            array(76, 'storage/syllabuscover/1645703068.jpg', 'storage/syllabuspdf/1645703068.pdf', 'Student', 139, 5, 1, NULL, '2022-02-24 05:14:28', '2022-02-24 05:14:28'),
            array(77, 'storage/syllabuscover/1645703173.jpg', 'storage/syllabuspdf/1645703173.pdf', 'Student', 140, 5, 1, NULL, '2022-02-24 05:16:13', '2022-02-24 05:16:13'),
            array(78, 'storage/syllabuscover/1645703263.jpg', 'storage/syllabuspdf/1645703263.pdf', 'Student', 141, 5, 1, NULL, '2022-02-24 05:17:43', '2022-02-24 05:17:43'),
            array(79, 'storage/syllabuscover/1645703378.png', 'storage/syllabuspdf/1645703378.pdf', 'Student', 115, 5, 1, NULL, '2022-02-24 05:19:38', '2022-02-24 05:19:38'),
            array(80, 'storage/syllabuscover/1645703488.png', 'storage/syllabuspdf/1645703488.pdf', 'Student', 116, 5, 1, NULL, '2022-02-24 05:21:28', '2022-02-24 05:21:28'),
            array(81, 'storage/syllabuscover/1645703508.png', 'storage/syllabuspdf/1645703508.pdf', 'Student', 142, 5, 1, NULL, '2022-02-24 05:21:48', '2022-02-24 05:21:48'),
            array(82, 'storage/syllabuscover/1645703606.png', 'storage/syllabuspdf/1645703606.pdf', 'Student', 117, 5, 1, NULL, '2022-02-24 05:23:26', '2022-02-24 05:23:26'),
            array(83, 'storage/syllabuscover/1645703725.png', 'storage/syllabuspdf/1645703725.pdf', 'Student', 118, 5, 1, NULL, '2022-02-24 05:25:25', '2022-02-24 05:25:25'),
            array(84, 'storage/syllabuscover/1645703755.png', 'storage/syllabuspdf/1645703755.pdf', 'Student', 119, 5, 1, NULL, '2022-02-24 05:25:55', '2022-02-24 05:25:55'),
            array(85, 'storage/syllabuscover/1645703789.png', 'storage/syllabuspdf/1645703789.pdf', 'Student', 120, 5, 1, NULL, '2022-02-24 05:26:29', '2022-02-24 05:26:29'),
            array(86, 'storage/syllabuscover/1645703826.png', 'storage/syllabuspdf/1645703826.pdf', 'Student', 121, 5, 1, NULL, '2022-02-24 05:27:06', '2022-02-24 05:27:06'),
            array(87, 'storage/syllabuscover/1645703845.png', 'storage/syllabuspdf/1645703845.pdf', 'Student', 122, 5, 1, NULL, '2022-02-24 05:27:25', '2022-02-24 05:27:25')
        ];

        foreach ($syllabusLists as $syllabusList) {
            $syllabus = new Syllabus;
            $syllabus->photo = $syllabusList[1];
            $syllabus->file = $syllabusList[2];
            $syllabus->type = $syllabusList[3];
            $syllabus->curriculum_id = $syllabusList[4];
            $syllabus->user_id = 2;
            $syllabus->school_id = $syllabusList[6];
            $syllabus->save();
        }
    }
}
