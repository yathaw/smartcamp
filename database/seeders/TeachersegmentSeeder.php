<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Curriculum;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Faker;

class TeachersegmentSeeder extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create();

        $sections = Section::where('period_id', 3)->get();
        // $durations = ["1:00","1:30"]; // 18
        $colors =[
            // bg , txt
            array("#fbf8cc","#19544e"),
            array("#fde4cf","#b54370"),
            array("#ffcfd2","#441c75"),
            array("#f1c0e8","#76338f"),
            array("#cfbaf0","#0b555f"),
            array("#a3c4f3","#0c066a"),
            array("#90dbf4","#b84078"),
            array("#8eecf5","#ee37c9"),
            array("#98f5e1","#07614c"),
            array("#b9fbc0","#0206d1"),
            array("#ffadad","#d12d6c"),
            array("#ffd6a5","#cc3254"),
            array("#fdffb6","#aa20e9"),
            array("#caffbf","#66561e"),
            array("#9bf6ff","#7b674f"),
            array("#a0c4ff","#26515e"),
            array("#bdb2ff","#26115f"),
            array("#ffc6ff","#b12c66"),
            array("#fec5bb","#d55761"),
            array("#fcd5ce","#6a1277"),
            array("#fae1dd","#10655f"),
            array("#f8edeb","#3c2465"),
            array("#e8e8e4","#0e019f"),
            array("#d8e2dc","#645714"),
            array("#ece4db","#b2b71d"),
            array("#ffe5d9","#7b937f"),
            array("#ffd7ba","#d30259"),
            array("#fec89a","#817c55"),
            array("#eae4e9","#7b1e8b"),
            array("#fff1e6","#195b63"),
            array("#fde2e4","#cc3f6b"),
            array("#fad2e1","#452256"),
            array("#e2ece9","#829985"),
            array("#bee1e6","#170a6b"),
            array("#f0efeb","#452358"),
            array("#dfe7fd","#1d256f"),
            array("#cddafd","#6b6857"),
            array("#eddcd2","#b85456"),
            array("#fff1e6","#7f2322"),
            array("#fde2e4","#2f19be"),
            array("#fad2e1","#952f5d"),
            array("#c5dedd","#60600c"),
            array("#dbe7e4","#1f4847"),
            array("#f0efeb","#1f5148"),
            array("#d6e2e9","#4b2378"),
            array("#bcd4e6","#f46856"),
            array("#99c1de","#876d43"),
            array("#fec89a","#f89a03"),
            array("#aec68d","#9e416f"),
            array("#ede7b1","#737e5a"),
            array("#fdecef","#ff5959")


        ];

        foreach($sections as $section){
            $sectionid = $section->id;
            $gradeid = $section->grade_id;

            // dd($gradeid);
            $batches = $section->batches;

            foreach($batches as $batch){
                $batchid = $batch->id;

                $curricula = Curriculum::where('grade_id',$gradeid)->get(['subject_id','id']);
                // dd($curricula[0]->subject_id);

                // $subjectids = Curriculum::where('grade_id',$gradeid)->pluck('subject_id');
                // dd($subjectids); // 39
                foreach($curricula as $curriculum){
                    $curriculumid = $curriculum->id;

                    $subjectid = $curriculum->subject_id;


                    $subject = Subject::find($subjectid);
                    $userids = $subject->users()->pluck('user_id');

                    $userids_count = $userids->count();

                    if($userids_count == 1){
                        $randomNumber1 = 0;
                        $userid = $userids[$randomNumber1];
                    }
                    elseif($userids_count > 1 ){
                        $randomNumber1 = $faker->numberBetween(0, $userids_count-1);
                        $userid = $userids[$randomNumber1];

                    }else{
                        $userid = 113;

                    }


                    $randomNumber2 = $faker->numberBetween(0, 50);

                    $color = $colors[$randomNumber2];



                    DB::table('teachersegments')->insert([
                        'duration' => '1:00',
                        'txtcolor' => $color[1],
                        'bgcolor' => $color[0],
                        'section_id' => $sectionid,
                        'batch_id' => $batchid,
                        'curriculum_id' => $curriculumid,
                        'school_id' => 1,
                        'user_id' => $userid,
                        'staff_id' => 2,

                    ]);
                }
            }
        }
    }
}
