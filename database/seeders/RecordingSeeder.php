<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recording;

use App\Models\Exam;
use App\Models\Examdetail;
use App\Models\Batch;
use App\Models\School;
use App\Models\Period;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Attendance;
use App\Models\Student;

use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Faker;

class RecordingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $sections = Section::where('period_id',2)->get();
        $files = ['storage/recording/1651481966.mp4', 'storage/recording/v1.mp4', 'storage/recording/v2.mp4', 'storage/recording/v3.mp4', 'storage/recording/v4.mp4', 'storage/recording/v5.mp4', 'storage/recording/v6.mp4'];

        foreach($sections as $section){
            $startdate = $section->startdate;
            $enddate = $section->enddate;

            foreach($section->batches as $batch){
                $batchid = $batch->id;
                $students = Student::with('studentsegments','user')->whereHas('studentsegments', function ($query) use ($batchid) {
                    $query->where('studentsegments.batch_id', $batchid);
                })->get();

                foreach($students as $student){
                    $dt = Carbon::create($startdate);
                    $dt2 = Carbon::create($enddate);
                    $daysForExtraCoding = $dt->diffInDaysFiltered(function(Carbon $date) {
                            return !$date->isWeekend();
                    }, $dt2);


                    $period = CarbonPeriod::create($startdate, $enddate);

                    $weekendFilter = function ($date) {
                        return $date->isWeekday();
                    };
                    $period->filter($weekendFilter);
                    $days = [];
                    foreach ($period as $date) {

                        $date_event  = $date->format('Y-m-d');

                        $recording = new Recording();
                        $recording->title = $faker->realTextBetween($minNbChars = 10, $maxNbChars = 30);

                        $recording->file = $files[$faker->numberBetween(0, 6)];
                        $recording->user_id = 2;
                        $recording->batch_id = $batchid;
                        $recording->school_id = 1;

                        $recording->save();

                    }
                }

                
            }
        }
    }
}
