<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

class AttendanceSeeder extends Seeder
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
                        $status = $faker->numberBetween(0, 3);

                        $date_event  = $date->format('Y-m-d');

                        $attendances = new Attendance();
                        $attendances->date = $date_event;
                        $attendances->status = $status;
                       
                        if($status ==  3){
                            $attendances->remark = $faker->realTextBetween($minNbChars = 10, $maxNbChars = 30);
                        }

                        elseif($status ==  2){
                            $attendances->remark = '01:00';
                        }
                        else{
                            $attendances->remark = 'NULL';
                        }

                        $attendances->student_id = $student->id;
                        $attendances->user_id = 2;
                        $attendances->batch_id = $batchid;
                        $attendances->save();

                    }
                }

                
            }
        }
    }
}
