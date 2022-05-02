<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use App\Models\Permission;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Guardian;
use App\Models\Sport;
use App\Models\User;
use App\Models\Student;
use App\Models\School;
use App\Models\Section;

use Hashids\Hashids;

use App\Models\VerifyUser;

use Illuminate\Support\Facades\Hash;
use Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentsegmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $now = Carbon::now();

        

        $students = Student::all();

        foreach($students as $student){
            $studentid = $student->id;

            $old_gradeid = $student->studentsegments[0]->batch->section->grade->id;
            $old_sectionid = $student->studentsegments[0]->batch->section->id;

            $new_gradeid = $old_gradeid+1;


            if($new_gradeid < 13 ){

                $new_sectionid = Section::where('grade_id',$new_gradeid)->pluck('id')->last();

                $new_batchids = Batch::where('section_id',$new_sectionid)->pluck('id');
                $count_new_batches = count($new_batchids);

                $prepare_count = $count_new_batches-1;
                $new_batchid = $new_batchids[$faker->numberBetween(0, $prepare_count)];

                $new_studentsegment_batch = Batch::find($new_batchid);
                // dd($new_studentsegment_batch);

                DB::table('studentsegments')->insert([
                    'rollno' => 'ES4E'.uniqid(),
                    'type' => 'old',
                    'student_id' => $studentid,
                    'batch_id' => $new_studentsegment_batch->id
                ]);
            }
        }

        for ($i=184; $i <= 205; $i++) { 
            $new_batchids = Batch::where('section_id',25)->pluck('id');
            $count_new_batches = count($new_batchids);

            $prepare_count = $count_new_batches-1;
            $new_batchid = $new_batchids[$faker->numberBetween(0, $prepare_count)];

            $new_studentsegment_batch = Batch::find($new_batchid);
            
            DB::table('studentsegments')->insert([
                'rollno' => 'ES4E'.uniqid(),
                'type' => 'old',
                'student_id' => $i,
                'batch_id' => $new_studentsegment_batch->id
            ]);
        }

        
    }
}
