<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Syllabus;

use Faker;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $syllabui = Syllabus::whereNotIn('curriculum_id', [271, 272,273, 274])->get();

        $faker = \Faker\Factory::create();
        $photos = ['storage/lessoncover/1651478388.jpg', 'storage/lessoncover/l1.jpeg', 'storage/lessoncover/l2.jpeg', 'storage/lessoncover/l3.jpeg', 'storage/lessoncover/l4.jpeg', 'storage/lessoncover/l5.jpeg', 'storage/lessoncover/l6.jpeg', 'storage/lessoncover/l7.jpeg', 'storage/lessoncover/l8.jpeg', 'storage/lessoncover/l9.jpeg', 'storage/lessoncover/l10.jpeg'];

        $files = ['storage/lessonvideo/1651478388.mp4', 'storage/lessonvideo/v1.mp4', 'storage/lessonvideo/v2.mp4', 'storage/lessonvideo/v3.mp4', 'storage/lessonvideo/v4.mp4', 'storage/lessonvideo/v5.mp4'];
        foreach ($syllabui as $syllabus) {
            $lesson = new Lesson;
            $lesson->photo = $photos[$faker->numberBetween(0, 10)];
            $lesson->file = $files[$faker->numberBetween(0, 5)];
            $lesson->curriculum_id = $syllabus->curriculum_id;
            $lesson->user_id = 2;
            $lesson->school_id = 1;
            $lesson->save();
        }
    }
}
