<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use App\Models\Section;
use App\Models\Curriculum;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\Teachersegment;
use Illuminate\Support\Facades\DB;
use Faker;

class ScheduleSeeder extends Seeder
{
    
    public function run()
    {
        $faker = \Faker\Factory::create();

        $batches = Batch::whereIn('section_id', [14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26])->get();

        $days = ["Monday","Tuesday","Wednesday","Thursday","Friday"];

        foreach($batches as $batch){

            $batchid = $batch->id;

            foreach($days as $day){
                
                $teachersegments = Teachersegment::where('batch_id',$batchid)->inRandomOrder()->pluck('id');

                foreach($teachersegments as $teachersegment){
                    DB::table('schedules')->insert([
                        'day' => $day,
                        'teachersegment_id' => $teachersegment,
                        'batch_id' => $batchid,
                        'staff_id' => 1,
                        'school_id' => 1

                    ]);

                }
            }

            

            // dd($teachersegments);



        }
    }
}
