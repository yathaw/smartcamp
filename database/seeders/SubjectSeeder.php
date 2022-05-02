<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Subjecttype;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjectLists = [
                        array(1, 'Myanmar', 'မြန်မာစာ', 1, NULL, '2022-02-21 01:22:29', '2022-02-21 01:25:11'),
                        array(2, 'English', 'အင်္ဂလိပ်', 1, NULL, '2022-02-21 01:25:25', '2022-02-21 01:25:25'),
                        array(3, 'Mathematics', 'သင်္ချာ', 1, NULL, '2022-02-21 01:26:14', '2022-02-21 01:26:14'),
                        array(4, 'Science', 'သိပ္ပံ', 1, NULL, '2022-02-21 01:26:27', '2022-02-21 01:26:27'),
                        array(5, 'Social Studies', 'လူမှုရေး', 1, NULL, '2022-02-21 01:26:40', '2022-02-21 01:26:40'),
                        array(6, 'Life Skills', 'ဘဝတွက်တာ', 1, NULL, '2022-02-21 01:26:54', '2022-02-21 01:26:54'),
                        array(7, 'Agriculture', 'စိုက်ပျိုးရေး', 1, NULL, '2022-02-21 01:27:07', '2022-02-21 01:27:07'),
                        array(8, 'Ethnic Language Teaching', 'ဒေသဆိုင်ရာ', 1, NULL, '2022-02-21 01:27:22', '2022-02-21 01:27:35'),
                        array(9, 'English Four Skills', 'English Four Skills', 1, NULL, '2022-02-21 01:28:03', '2022-02-21 01:28:03'),
                        array(10, 'Physical Education', 'အားကစား', 1, NULL, '2022-02-21 01:28:58', '2022-02-21 01:28:58'),
                        array(11, 'Thukhuma', 'သုခမ', 1, NULL, '2022-02-21 01:29:11', '2022-02-21 01:29:11'),
                        array(12, 'Painting', 'ပန်းချီ', 1, NULL, '2022-02-21 01:29:25', '2022-02-21 01:29:25'),
                        array(13, 'Moral and Civics', 'စာရိတ္တနှင့်ပြည်သူ့နီတိ', 1, NULL, '2022-02-21 01:29:38', '2022-02-21 01:29:38'),
                        array(14, 'Music', 'ဂီတ', 1, NULL, '2022-02-21 01:29:51', '2022-02-21 01:29:51'),
                        array(15, 'Design and Technology', 'D&T array( STEM )', 1, NULL, '2022-02-21 01:30:04', '2022-02-21 01:30:04'),
                        array(16, 'Computer', 'ICT array( နည်းပညာအခြေခံ )', 1, NULL, '2022-02-21 01:30:18', '2022-02-21 01:30:18'),
                        array(17, 'Chemistry', 'ဓာတုဗေဒ', 1, NULL, '2022-02-21 01:30:31', '2022-02-21 01:30:31'),
                        array(18, 'Physics', 'ရူပဗေဒ', 1, NULL, '2022-02-21 01:30:44', '2022-02-21 01:30:44'),
                        array(19, 'Biology', 'ဇီ၀ဗေဒ', 1, NULL, '2022-02-21 01:30:57', '2022-02-21 01:30:57'),
                        array(20, 'Economics', 'ဘောဂဗေဒ', 1, NULL, '2022-02-21 01:31:09', '2022-02-21 01:31:09'),
                        array(21, 'Geography', 'ပထ၀ီ၀င်', 1, NULL, '2022-02-21 01:31:23', '2022-02-21 08:48:45'),
                        array(22, 'History', 'သမိုင်း', 1, NULL, '2022-02-21 01:31:35', '2022-02-21 01:31:35'),
                        array(23, 'Mathematics - 1', 'သင်္ချာ - ၁', 1, NULL, '2022-02-21 08:19:22', '2022-02-21 08:19:22'),
                        array(24, 'Mathematics - 2', 'သင်္ချာ - ၂', 1, NULL, '2022-02-21 08:19:35', '2022-02-21 08:19:35'),
                        array(25, 'Geography & History', 'ပထ၀ီ၀င် နှင့် သမိုင်း', 1, NULL, '2022-02-21 08:48:38', '2022-02-21 08:48:38'),
                        array(26, 'Myanmar', 'မြန်မာသဒ္ဒါ', 1, NULL, '2022-02-21 09:06:04', '2022-02-22 05:04:38'),
                        array(27, 'Myanmar', 'မြန်မာကဗျာလက်ရွေးစင်', 1, NULL, '2022-02-21 09:08:01', '2022-02-22 04:54:20'),
                        array(28, 'Myanmar', 'ဇာတကဝတ္ထုများ', 1, NULL, '2022-02-21 09:08:39', '2022-02-22 04:54:30'),
                        array(29, 'Myanmar', 'မဟော်သဓာဇာတ်တော်ကြီး', 1, NULL, '2022-02-22 01:23:14', '2022-02-22 04:54:35'),
                        array(30, 'Myanmar', 'စိတ်ကြိုက်မြန်မာစာ array(မြန်မာကဗျာ)', 1, NULL, '2022-02-22 03:37:24', '2022-02-22 05:04:13'),
                        array(31, 'Myanmar', 'စိတ်ကြိုက်မြန်မာစာ array(မြန်မာပြဇာတ်နှင့် မြန်မာဝတ္ထုတို)', 1, NULL, '2022-02-22 03:37:40', '2022-02-22 05:04:19'),
                        array(32, 'Myanmar', 'စိတ်ကြိုက်မြန်မာစာarray(မြန်မာစာပေသမိုင်း)', 1, NULL, '2022-02-22 03:37:55', '2022-02-22 05:04:25'),
                        array(33, 'Myanmar', 'စိတ်ကြိုက်မြန်မာစာarray(မြန်မာစကားပြေ)', 1, NULL, '2022-02-22 03:38:08', '2022-02-22 05:04:30'),
                        array(35, 'Myanmar History', 'မြန်မာ့သမိုင်း', 1, NULL, '2022-02-22 04:52:17', '2022-02-22 04:52:17'),
                        array(36, 'World History', 'ကမ္ဘာ့သမိုင်း', 1, NULL, '2022-02-22 04:52:43', '2022-02-22 04:52:43'),
                        array(37, 'Myanmar', 'ရေသည်ပြဇာတ်', 1, NULL, '2022-02-22 04:54:00', '2022-02-22 05:04:44'),
                        array(38, 'Myanmar', 'မြန်မာစကားပြေ', 1, NULL, '2022-02-22 05:05:52', '2022-02-22 05:05:52'),
                        array(39, 'Basic Myanmar', 'အခြေခံမြန်မာစာ', 1, NULL, '2022-02-22 06:19:37', '2022-02-22 06:22:27'),
                        array(40, 'English numbers', 'အင်္ဂလိပ်ကိန်းများ', 1, NULL, '2022-02-22 06:19:53', '2022-02-22 06:19:53'),
                        array(41, 'Drawing and painting', 'ပုံဆွဲခြင်းနှင့် ဆေးခြယ်ခြင်း', 1, NULL, '2022-02-22 06:20:11', '2022-02-22 06:20:11'),
                        array(42, 'Basic Math', 'သင်္ချာအခြေခံ', 1, NULL, '2022-02-22 06:20:32', '2022-02-22 06:20:32')
        ];

        foreach ($subjectLists as $subjectList) {
            $subject = new Subject;
            $subject->name = $subjectList[1];
            $subject->otherlanguage = $subjectList[2];
            $subject->school_id = $subjectList[3];
            $subject->save();
        }

        $subjecttypeLists = [
            array(1, 'Stream - 1', 'အတွဲ - ၁', 1, NULL, '2022-02-21 01:00:57', '2022-02-22 04:00:06'),
            array(2, 'Stream - 2', 'အတွဲ - ၂', 1, NULL, '2022-02-21 01:13:05', '2022-02-22 04:00:33'),
            array(3, 'Stream - 3', 'အတွဲ - ၃', 1, NULL, '2022-02-22 04:00:26', '2022-02-22 04:00:26'),
            array(4, 'Stream - 4', 'အတွဲ - ၄', 1, NULL, '2022-02-22 04:00:45', '2022-02-22 04:00:45')
        ];

        foreach ($subjecttypeLists as $subjecttypeList) {
            $subjecttype = new Subjecttype;
            $subjecttype->name = $subjecttypeList[1];
            $subjecttype->otherlanguage = $subjecttypeList[2];
            $subjecttype->school_id = $subjecttypeList[3];
            $subjecttype->save();
        }
    }
}
