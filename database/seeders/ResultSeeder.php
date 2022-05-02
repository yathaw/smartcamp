<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use App\Models\School;
use App\Models\Period;
use App\Models\Grade;
use App\Models\Result;
use App\Models\Student;
use App\Models\Section;
use App\Models\Exam;
use App\Models\Examdetail;
use App\Models\User;
use Faker;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $examdetails = Examdetail::all();

        foreach($examdetails as $examdetail){
            
            $sectionid = $examdetail->exam->section_id;
            $section = Section::find($sectionid);
            foreach($section->batches as $batch){

                $batchid = $batch->id;
                $students = Student::with('studentsegments','user')->whereHas('studentsegments', function ($query) use ($batchid) {
                    $query->where('studentsegments.batch_id', $batchid);
                })->get();

                foreach($students as $student){
                    $mark = $faker->numberBetween(60, 100);
                    if ($mark <= 75) {
                        $point = 'C';
                    }elseif($mark <= 85){
                        $point = 'B';
                    }else{
                        $point = 'A';
                    }
                    Result::create([
                        'point'  => $point,
                        'mark'  => $mark,
                        'examdetail_id' => $examdetail->id,
                        'student_id' => $student->id,
                        'user_id'  => 2,
                        'school_id'  => 1
                    ]); 
                }

                
            }
            
             
        }
    }
}
