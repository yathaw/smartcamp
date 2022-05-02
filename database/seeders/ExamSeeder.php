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


class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = '["All school rules must be observed throughout the entire test.","Normal lessons will resume after the Common Test.","Students are required to bring their own writing and mathematical instruments.  No borrowing, lending or exchange of any materials is allowed during the Common Test.","Absentees must produce original medical certificates from approved clinics or hospitals.  No parents\u2019 letter will be accepted.  Students who are absent without valid reasons will be given a \u201c0\u201d for the paper.","A student will be given \u201c0\u201d if he or she is caught cheating in the Common Test.","No mobile phones or electronic gadgets that can store, transmit, receive data or information are allowed.","Students must not talk, whisper, do hand signal or any other form of verbal or non-verbal communication during the Common Test.  Such actions will be considered as having the intention to cheat.","Students must be seated at their assigned desks by 7.25am.","Students who are late will not be given extra time.","Only essential writing materials are allowed on the student\u2019s desk.  All bags, books and any unauthorised materials should be left at the front of the classroom.","Students are to follow any instructions given by the invigilators and instructions stated on the question paper. Failure to follow instructions stated on the question paper or given by the invigilators may lead to students being penalised.","Students are advised that good time management is essential.  They should not spend too much time on few questions and leave no time for others.","Students are advised to read the questions carefully. No marks are awarded for information not asked for in the questions.","Students should write their answers legibly in black or blue ink.  Pens or pencils of other colours may be used for maps and diagrams only."]';

        // $sections = Section::where('period_id',1)->get();

        // foreach($sections as $section){

        //     $sectionid = $section->id;
        //     $gradeid = $section->grade_id;
        //     $schoolid = 1;
        //     $userid = 2;
        //     $grade = Grade::with(['curricula'=>function($q) use($gradeid){
        //                 $q->with(['subject','subjecttype'])
        //                 ->where('type','=','Main')
        //                 ->get();
        //             }])
        //             ->whereHas('curricula',function($q) use($gradeid){
        //                 $q->where('grade_id',$gradeid);
        //             })
        //             ->where('id',$gradeid)
        //             ->first();

        //     $curricula = $grade->curricula;
        //     $subjecttypes = $grade->subjecttypes->toArray();
            
        //     $title = "July Exam";

        //     if($gradeid == 3){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-30';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29", "2020-07-30"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 4){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-30';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29", "2020-07-30"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }
        //     if($gradeid == 5){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-30';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29", "2020-07-30", "2020-07-30"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00"];

        //             $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00", "15:10:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 6){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-30';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29", "2020-07-30"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:15:00", "15:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 7){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-31';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29", "2020-07-27",  "2020-07-30",  "2020-07-30", "2020-07-31", "2020-07-31", "2020-07-31"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00", "12:30:00", "12:30:00", "12:30:00"];

        //             $endtimes = ["13:15:00", "15:15:00", "13:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00",  "13:15:00", "15:15:00", "13:15:00", "13:15:00", "13:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 8){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-31';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29", "2020-07-30", "2020-07-30", "2020-07-31", "2020-07-31", "2020-07-31", "2020-07-27" ];

        //             $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

        //             $endtimes = ["08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00","08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 9){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-29';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29", "2020-07-27"];

        //             $starttimes = ["07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00", "07:30:00"];

        //             $endtimes = ["08:15:00", "08:15:00","10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 10){
        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-29';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29"];

        //             $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00"];

        //             $endtimes = ["08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 11){
        //         $grade->subjecttypes;

        //         $startdate = '2020-07-27';
        //         $enddate = '2020-07-31';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){

        //             $examdates = [ "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-29", "2020-07-29",  "2020-07-30",  "2020-07-30", "2020-07-31", "2020-07-31", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28","2020-07-28", "2020-07-27", "2020-07-27", "2020-07-27"];

        //             $starttimes = ["07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00",  "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "09:30:00", "09:30:00", "09:30:00"];

        //             $endtimes = ["08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00",  "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "10:15:00", "10:15:00", "10:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
                    
        //         }
        //     }

        //     $title = "September Exam"; 

        //     if($gradeid == 3){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-28';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-24", "2020-09-25", "2020-09-25", "2020-09-28"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 4){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-28';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-24", "2020-09-25", "2020-09-25", "2020-09-28"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:30:00", "15:30:00", "13:30:00", "15:30:00", "13:30:00","15:30:00", "13:30:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }
        //     if($gradeid == 5){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-10-02';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-24", "2020-09-25", "2020-09-28", "2020-09-29", "2020-09-30", "2020-10-01", "2020-10-02"];

        //             $starttimes = ["12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00"];

        //             $endtimes = ["14:00:00", "14:00:00", "14:00:00", "14:00:00", "14:00:00","14:00:00", "14:00:00", "14:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 6){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-28';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-24", "2020-09-25", "2020-09-25", "2020-09-28"];

        //             $starttimes = ["12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00"];

        //             $endtimes = ["14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 7){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-30';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-24", "2020-09-24", "2020-09-25", "2020-09-25", "2020-09-28",  "2020-09-29",  "2020-09-29", "2020-09-30", "2020-09-30", "2020-09-30"];

        //             $starttimes = ["12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "12:30:00"];

        //             $endtimes = ["14:00:00", "16:30:00", "14:00:00", "14:00:00", "16:30:00", "14:00:00","16:30:00", "14:00:00",  "14:00:00", "16:30:00", "14:00:00", "14:00:00", "14:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 8){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-29';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-24", "2020-09-24", "2020-09-25", "2020-09-25", "2020-09-28", "2020-09-28", "2020-09-29", "2020-09-29", "2020-09-29", "2020-09-23" ];

        //             $starttimes = ["07:30:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

        //             $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00","11:30:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 9){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-30';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-25", "2020-09-25", "2020-09-28", "2020-09-29", "2020-09-30", "2020-09-23"];

        //             $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00",  "09:00:00", "09:00:00"];

        //             $endtimes = ["12:00:00", "12:00:00","12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 10){
        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-25';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-24", "2020-09-24", "2020-09-25", "2020-09-25"];

        //             $starttimes = ["07:00:00", "07:00:00", "07:00:00", "09:30:00", "07:00:00", "07:00:00",  "09:30:00", "07:00:00",  "09:30:00"];

        //             $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "11:30:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 11){
        //         $grade->subjecttypes;

        //         $startdate = '2020-09-23';
        //         $enddate = '2020-09-29';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){

        //             $examdates = [ "2020-09-23", "2020-09-23", "2020-09-24", "2020-09-24", "2020-09-25", "2020-09-25",  "2020-09-28",  "2020-09-28", "2020-09-29", "2020-09-29", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28","2020-07-28", "2020-07-27", "2020-07-27", "2020-07-27"];

        //             $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

        //             $endtimes = ["12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00",  "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }


        //     $title = "December Exam";
        //     if($gradeid == 3){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-21';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-21"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 4){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-21';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-21"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }
        //     if($gradeid == 5){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-21';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-21", "2020-12-21"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00"];

        //             $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00", "15:10:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 6){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-21';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-21"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:15:00", "15:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 7){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-22';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-16",  "2020-12-21",  "2020-12-21", "2020-12-22", "2020-12-22", "2020-12-22"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00", "12:30:00", "12:30:00", "12:30:00"];

        //             $endtimes = ["13:15:00", "15:15:00", "13:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00",  "13:15:00", "15:15:00", "13:15:00", "13:15:00", "13:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 8){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-21';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-19", "2020-12-19", "2020-12-21", "2020-12-21", "2020-12-21", "2020-12-16" ];

        //             $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

        //             $endtimes = ["08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00","08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 9){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-18';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-16"];

        //             $starttimes = ["07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00", "07:30:00"];

        //             $endtimes = ["08:15:00", "08:15:00","10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 10){
        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-18';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18"];

        //             $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00"];

        //             $endtimes = ["08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 11){
        //         $grade->subjecttypes;

        //         $startdate = '2020-12-16';
        //         $enddate = '2020-12-31';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
        //             $examdates = [ "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18",  "2020-12-21",  "2020-12-21", "2020-12-22", "2020-12-22", "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18", "2020-12-18", "2020-12-16", "2020-12-16", "2020-12-17", "2020-12-17", "2020-12-18","2020-12-18", "2020-12-17", "2020-12-17", "2020-12-17"];

        //             $starttimes = ["07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00",  "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "09:30:00", "09:30:00", "09:30:00"];

        //             $endtimes = ["08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00",  "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "10:15:00", "10:15:00", "10:15:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     $title = "February Exam";
            
        //     if($gradeid == 3){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-18';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-15", "2021-02-16", "2021-02-16", "2021-02-17", "2021-02-17", "2021-02-18"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 4){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-18';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-15", "2021-02-16", "2021-02-16", "2021-02-17", "2021-02-17", "2021-02-18"];

        //             $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

        //             $endtimes = ["13:30:00", "15:30:00", "13:30:00", "15:30:00", "13:30:00","15:30:00", "13:30:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }
        //     if($gradeid == 5){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-24';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-16", "2021-02-17", "2021-02-18", "2021-02-19", "2021-02-22", "2021-02-23", "2021-02-24"];

        //             $starttimes = ["12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00"];

        //             $endtimes = ["14:00:00", "14:00:00", "14:00:00", "14:00:00", "14:00:00","14:00:00", "14:00:00", "14:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 6){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-18';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-15", "2021-02-16", "2021-02-16", "2021-02-17", "2021-02-17",  "2021-02-18"];

        //             $starttimes = ["12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00"];

        //             $endtimes = ["14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 7){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-19';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-15", "2021-02-16", "2021-02-16", "2021-02-16", "2021-02-17", "2021-02-17", "2021-09-15",  "2021-02-18",  "2021-02-18", "2021-02-19", "2021-02-19", "2021-02-19"];

        //             $starttimes = ["12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "12:30:00"];

        //             $endtimes = ["14:00:00", "16:30:00", "14:00:00", "14:00:00", "16:30:00", "14:00:00","16:30:00", "14:00:00",  "14:00:00", "16:30:00", "14:00:00", "14:00:00", "14:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 8){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-19';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-15", "2021-02-15", "2021-02-15", "2021-02-16", "2021-02-16", "2021-02-16", "2021-02-17", "2021-02-17", "2021-02-18", "2021-02-18", "2021-02-19", "2021-02-19", "2021-02-19", "2021-02-15" ];

        //             $starttimes = ["07:30:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

        //             $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00","11:30:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 9){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-22';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-15", "2021-02-16", "2021-02-17", "2021-02-17", "2021-02-18", "2021-02-19", "2021-02-22", "2021-02-15"];

        //             $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00",  "09:00:00", "09:00:00"];

        //             $endtimes = ["12:00:00", "12:00:00","12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 10){
        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-17';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){
                    
        //             $examdates = [ "2021-02-15", "2021-02-15", "2021-02-15", "2021-02-15", "2021-02-16", "2021-02-16", "2021-02-16", "2021-02-17", "2021-02-17"];

        //             $starttimes = ["07:00:00", "07:00:00", "07:00:00", "09:30:00", "07:00:00", "07:00:00",  "09:30:00", "07:00:00",  "09:30:00"];

        //             $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "11:30:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
        //         }
        //     }

        //     if($gradeid == 11){
        //         $grade->subjecttypes;

        //         $startdate = '2021-02-15';
        //         $enddate = '2021-02-26';

        //         $exam = new Exam();
        //         $exam->name = $title;
        //         $exam->startdate = $startdate;
        //         $exam->enddate = $enddate;
        //         $exam->rule = json_encode($rules);
        //         $exam->section_id = $sectionid;
        //         $exam->user_id = $userid;
        //         $exam->school_id = $schoolid;
        //         $exam->save();

        //         foreach($curricula as $key => $curriculum){

        //             $examdates = [ "2021-02-15", "2021-02-16", "2021-02-17", "2021-02-18", "2021-02-19", "2021-02-22",  "2021-02-23",  "2021-02-24", "2021-02-25", "2021-02-26", "2021-02-15", "2021-02-16", "2021-02-17", "2021-02-18", "2021-02-19", "2021-02-22", "2021-02-15", "2021-02-16", "2021-02-17", "2021-02-18", "2021-02-19", "2021-02-22", "2021-02-15", "2021-02-16", "2021-02-17", "2021-02-23", "2021-02-22","2021-02-24", "2021-02-23", "2021-07-23", "2021-02-23"];

        //             $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

        //             $endtimes = ["12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00",  "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

        //             $examdetail = new Examdetail();
        //             $examdetail->date = $examdates[$key];
        //             $examdetail->starttime = $starttimes[$key];
        //             $examdetail->endtime = $endtimes[$key];
        //             $examdetail->curriculum_id = $curriculum->id;
        //             $examdetail->exam_id = $exam->id;
        //             $examdetail->user_id = $userid;
        //             $examdetail->school_id = $schoolid;
        //             $examdetail->save();
                    
        //         }
        //     }
        // } 
    $sections = Section::where('period_id',2)->get();

        foreach($sections as $section){

            $sectionid = $section->id;
            $gradeid = $section->grade_id;
            $schoolid = 1;
            $userid = 2;
            $grade = Grade::with(['curricula'=>function($q) use($gradeid){
                        $q->with(['subject','subjecttype'])
                        ->where('type','=','Main')
                        ->get();
                    }])
                    ->whereHas('curricula',function($q) use($gradeid){
                        $q->where('grade_id',$gradeid);
                    })
                    ->where('id',$gradeid)
                    ->first();

            $curricula = $grade->curricula;
            $subjecttypes = $grade->subjecttypes->toArray();
            // 2020 - 2021
            $title = "July Exam";

            if($gradeid == 3){
                $startdate = '2021-07-26';
                $enddate = '2021-07-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-29"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 4){
                $startdate = '2021-07-26';
                $enddate = '2021-07-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-29"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }
            if($gradeid == 5){
                $startdate = '2021-07-26';
                $enddate = '2021-07-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-29", "2021-07-29"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00"];

                    $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00", "15:10:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 6){
                $startdate = '2021-07-26';
                $enddate = '2021-07-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-29"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:15:00", "15:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 7){
                $startdate = '2021-07-26';
                $enddate = '2021-07-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-26",  "2021-07-29",  "2021-07-29", "2021-07-30","2021-07-30","2021-07-30"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00","12:30:00","12:30:00","12:30:00"];

                    $endtimes = ["13:15:00", "15:15:00", "13:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00",  "13:15:00", "15:15:00", "13:15:00", "13:15:00", "13:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 8){
                $startdate = '2021-07-26';
                $enddate = '2021-07-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-29", "2021-07-29", "2021-07-30", "2021-07-30", "2021-07-30", "2021-07-26" ];

                    $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

                    $endtimes = ["08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00","08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 9){
                $startdate = '2021-07-26';
                $enddate = '2021-07-28';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-26"];

                    $starttimes = ["07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00", "07:30:00"];

                    $endtimes = ["08:15:00", "08:15:00","10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 10){
                $startdate = '2021-07-26';
                $enddate = '2021-07-28';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28"];

                    $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00"];

                    $endtimes = ["08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 11){
                $grade->subjecttypes;

                $startdate = '2021-07-26';
                $enddate = '2021-07-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){

                    $examdates = [ "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28",  "2021-07-29",  "2021-07-29", "2021-07-30", "2021-07-30", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28", "2020-07-28", "2020-07-26", "2020-07-26", "2020-07-27", "2020-07-27", "2020-07-28","2020-07-28", "2020-07-27", "2020-07-27", "2020-07-27"];

                    $starttimes = ["07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00",  "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00","07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "09:30:00", "09:30:00", "09:30:00" ];

                    $endtimes = ["08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00",  "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00","08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00","08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "10:15:00", "10:15:00", "10:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                    
                }
            }

            $title = "September Exam"; 

            if($gradeid == 3){
                $startdate = '2021-09-27';
                $enddate = '2021-09-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-27", "2021-09-27", "2021-09-28", "2021-09-28", "2021-09-29", "2021-09-29", "2021-09-30"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 4){
                $startdate = '2021-09-27';
                $enddate = '2021-09-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-27", "2021-09-27", "2021-09-28", "2021-09-28", "2021-09-29", "2021-09-29", "2021-09-30"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:30:00", "15:30:00", "13:30:00", "15:30:00", "13:30:00","15:30:00", "13:30:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }
            if($gradeid == 5){
                $startdate = '2021-09-20';
                $enddate = '2021-09-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-20", "2021-09-21", "2021-09-22", "2021-09-23", "2021-09-24", "2021-09-27", "2021-09-28", "2021-09-29"];

                    $starttimes = ["12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00"];

                    $endtimes = ["14:00:00", "14:00:00", "14:00:00", "14:00:00", "14:00:00","14:00:00", "14:00:00", "14:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 6){
                $startdate = '2021-09-27';
                $enddate = '2021-09-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-27", "2021-09-27", "2021-09-28", "2021-09-28", "2021-09-29", "2021-09-29", "2021-09-30"];

                    $starttimes = ["12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00"];

                    $endtimes = ["14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 7){
                $startdate = '2021-09-27';
                $enddate = '2021-09-31';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-27", "2021-09-27", "2021-09-28", "2021-09-28", "2021-09-28", "2021-09-29", "2021-09-29", "2021-09-27",  "2021-09-30",  "2021-09-30", "2021-09-31", "2021-09-31", "2021-09-31"];

                    $starttimes = ["12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "12:30:00"];

                    $endtimes = ["14:00:00", "16:30:00", "14:00:00", "14:00:00", "16:30:00", "14:00:00","16:30:00", "14:00:00",  "14:00:00", "16:30:00", "14:00:00", "14:00:00", "14:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 8){
                $startdate = '2021-09-26';
                $enddate = '2021-10-01';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-27", "2021-09-27", "2021-09-27", "2021-09-27", "2021-09-28", "2021-09-28", "2021-09-28", "2021-09-29", "2021-09-29", "2021-09-30", "2021-09-30", "2021-10-01", "2021-10-01", "2021-10-01", "2021-09-27" ];

                    $starttimes = ["07:30:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

                    $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00","11:30:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 9){
                $startdate = '2021-09-20';
                $enddate = '2021-09-27';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-20", "2021-09-20", "2021-09-21", "2021-09-22", "2021-09-22", "2021-09-23", "2021-09-24", "2021-09-27", "2021-09-20"];

                    $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00",  "09:00:00", "09:00:00"];

                    $endtimes = ["12:00:00", "12:00:00","12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 10){
                $startdate = '2021-09-27';
                $enddate = '2021-09-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-09-27", "2021-09-27", "2021-09-27", "2021-09-27", "2021-09-28", "2021-09-28", "2021-09-28", "2021-09-29", "2021-09-29"];

                    $starttimes = ["07:00:00", "07:00:00", "07:00:00", "09:30:00", "07:00:00", "07:00:00",  "09:30:00", "07:00:00",  "09:30:00"];

                    $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "11:30:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 11){
                $grade->subjecttypes;

                $startdate = '2021-09-27';
                $enddate = '2021-10-01';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){

                    $examdates = [ "2021-09-27", "2021-09-27", "2021-09-28", "2021-09-28", "2021-09-29", "2021-09-29",  "2021-09-30",  "2021-09-30", "2021-10-01", "2021-10-01", "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28", "2021-07-28", "2021-07-26", "2021-07-26", "2021-07-27", "2021-07-27", "2021-07-28","2021-07-28", "2021-07-27", "2021-07-27", "2021-07-27"];

                    $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

                    $endtimes = ["12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00",  "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                    
                }
            }


            $title = "December Exam";
            if($gradeid == 3){
                $startdate = '2021-12-27';
                $enddate = '2021-12-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29", "2021-12-30"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 4){
                $startdate = '2021-12-27';
                $enddate = '2021-12-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29", "2021-12-30"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }
            if($gradeid == 5){
                $startdate = '2021-12-27';
                $enddate = '2021-12-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29", "2021-12-30", "2021-12-30"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00"];

                    $endtimes = ["13:10:00", "15:10:00", "13:10:00", "15:10:00", "13:10:00","15:10:00", "13:10:00", "15:10:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 6){
                $startdate = '2021-12-27';
                $enddate = '2021-12-30';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29", "2021-12-30"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:15:00", "15:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 7){
                $startdate = '2021-12-27';
                $enddate = '2021-12-31';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29", "2021-12-27",  "2021-12-30",  "2021-12-30", "2021-12-31", "2021-12-31", "2021-12-31"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "12:30:00", "14:30:00", "12:30:00", "12:30:00", "12:30:00"];

                    $endtimes = ["13:15:00", "15:15:00", "13:15:00", "13:15:00", "15:15:00", "13:15:00","15:15:00", "13:15:00",  "13:15:00", "15:15:00", "13:15:00", "13:15:00", "13:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 8){
                $startdate = '2021-12-27';
                $enddate = '2021-12-31';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29", "2021-12-30", "2021-12-30", "2021-12-31", "2021-12-31", "2021-12-31", "2021-12-27"];

                    $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

                    $endtimes = ["08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00","08:15:00", "08:15:00", "10:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 9){
                $startdate = '2021-12-27';
                $enddate = '2021-12-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29", "2021-12-27"];

                    $starttimes = ["07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00", "07:30:00"];

                    $endtimes = ["08:15:00", "08:15:00","10:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 10){
                $startdate = '2021-12-27';
                $enddate = '2021-12-29';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-12-27", "2021-12-27", "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29"];

                    $starttimes = ["07:30:00", "07:30:00", "07:30:00", "09:30:00", "07:30:00", "07:30:00",  "09:30:00", "07:30:00",  "09:30:00"];

                    $endtimes = ["08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 11){
                $grade->subjecttypes;

                $startdate = '2021-12-27';
                $enddate = '2021-12-31';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){

                        $examdates = [ "2021-12-27", "2021-12-27", "2021-12-28", "2021-12-28", "2021-12-29", "2021-12-29",  "2021-12-30",  "2021-12-30", "2021-12-31", "2021-12-31", "2020-12-27", "2020-12-27", "2020-12-28", "2020-12-28", "2020-12-29", "2020-12-29", "2020-12-27", "2020-12-27", "2020-12-28", "2020-12-28", "2020-12-29", "2020-12-29","2020-12-27", "2020-12-27", "2020-12-28", "2020-12-28", "2020-12-29","2020-12-29", "2020-12-28", "2020-12-28", "2020-12-28"];

                        $starttimes = ["07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00",  "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "07:30:00", "09:30:00", "09:30:00", "09:30:00", "09:30:00"];

                        $endtimes = ["08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00",  "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "08:15:00", "10:15:00", "10:15:00", "10:15:00", "10:15:00"];

                        $examdetail = new Examdetail();
                        $examdetail->date = $examdates[$key];
                        $examdetail->starttime = $starttimes[$key];
                        $examdetail->endtime = $endtimes[$key];
                        $examdetail->curriculum_id = $curriculum->id;
                        $examdetail->exam_id = $exam->id;
                        $examdetail->user_id = $userid;
                        $examdetail->school_id = $schoolid;
                        $examdetail->save();
                    
                    
                }
            }

            $title = "February Exam";
            
            if($gradeid == 3){
                $startdate = '2022-02-16';
                $enddate = '2022-02-19';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2022-09-16", "2022-09-16", "2022-09-17", "2022-09-17", "2022-09-18", "2022-09-18", "2022-09-19"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:00:00", "15:00:00", "13:00:00", "15:00:00", "13:00:00","15:00:00", "13:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 4){
                $startdate = '2022-02-16';
                $enddate = '2022-02-21';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2020-02-16", "2020-02-16", "2020-02-17", "2020-02-17", "2020-02-18", "2020-02-18", "2020-02-21"];

                    $starttimes = ["12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00", "14:30:00", "12:30:00"];

                    $endtimes = ["13:30:00", "15:30:00", "13:30:00", "15:30:00", "13:30:00","15:30:00", "13:30:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }
            if($gradeid == 5){
                $startdate = '2022-02-16';
                $enddate = '2022-02-25';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2021-02-16", "2021-02-17", "2021-02-18", "2021-02-21", "2021-02-22", "2021-02-23", "2021-02-24", "2021-02-25"];

                    $starttimes = ["12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00", "12:30:00"];

                    $endtimes = ["14:00:00", "14:00:00", "14:00:00", "14:00:00", "14:00:00","14:00:00", "14:00:00", "14:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 6){
                $startdate = '2022-02-16';
                $enddate = '2022-02-21';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2022-02-16", "2022-02-16", "2022-02-17", "2022-02-17", "2022-02-18", "2022-02-18", "2022-02-21"];

                    $starttimes = ["12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00"];

                    $endtimes = ["14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00", "16:30:00", "14:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 7){
                $startdate = '2022-02-16';
                $enddate = '2022-02-22';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2022-02-16", "2022-02-16", "2022-02-17", "2022-02-17", "2022-02-17", "2022-02-18", "2022-02-18", "2022-02-16",  "2022-02-21",  "2022-02-21", "2022-02-22", "2022-02-22", "2022-02-22"];

                    $starttimes = ["12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "15:00:00", "12:30:00", "12:30:00", "12:30:00"];

                    $endtimes = ["14:00:00", "16:30:00", "14:00:00", "14:00:00", "16:30:00", "14:00:00","16:30:00", "14:00:00",  "14:00:00", "16:30:00", "14:00:00", "14:00:00", "14:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 8){
                $startdate = '2022-02-16';
                $enddate = '2022-10-22';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2022-02-16", "2022-02-16", "2022-02-16", "2022-02-16", "2022-02-17", "2022-02-17", "2022-02-17", "2020-02-18", "2022-02-18", "2022-02-21", "2022-02-21", "2022-02-22", "2022-02-22", "2022-02-22", "2022-02-16" ];

                    $starttimes = ["07:30:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "10:00:00", "07:30:00", "07:30:00", "07:30:00", "07:30:00"];

                    $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00","11:30:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 9){
                $startdate = '2022-02-16';
                $enddate = '2022-02-23';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2022-02-16", "2022-02-16", "2022-02-17", "2022-02-18", "2022-02-18", "2022-02-21", "2022-02-22", "2022-02-23", "2022-02-16"];

                    $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00",  "09:00:00", "09:00:00"];

                    $endtimes = ["12:00:00", "12:00:00","12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 10){
                $startdate = '2022-02-16';
                $enddate = '2022-02-18';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){
                    
                    $examdates = [ "2022-02-16", "2022-02-16", "2022-02-16", "2022-02-16", "2022-02-17", "2022-02-17", "2022-02-17", "2022-02-18", "2022-02-18"];

                    $starttimes = ["07:00:00", "07:00:00", "07:00:00", "09:30:00", "07:00:00", "07:00:00",  "09:30:00", "07:00:00",  "09:30:00"];

                    $endtimes = ["09:00:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "09:00:00", "11:30:00", "09:00:00", "11:30:00"];

                    $examdetail = new Examdetail();
                    $examdetail->date = $examdates[$key];
                    $examdetail->starttime = $starttimes[$key];
                    $examdetail->endtime = $endtimes[$key];
                    $examdetail->curriculum_id = $curriculum->id;
                    $examdetail->exam_id = $exam->id;
                    $examdetail->user_id = $userid;
                    $examdetail->school_id = $schoolid;
                    $examdetail->save();
                }
            }

            if($gradeid == 11){
                $grade->subjecttypes;

                $startdate = '2022-02-15';
                $enddate = '2022-02-28';

                $exam = new Exam();
                $exam->name = $title;
                $exam->startdate = $startdate;
                $exam->enddate = $enddate;
                $exam->rule = json_encode($rules);
                $exam->section_id = $sectionid;
                $exam->user_id = $userid;
                $exam->school_id = $schoolid;
                $exam->save();

                foreach($curricula as $key => $curriculum){

                        $examdates = [ "2022-02-15", "2022-02-16", "2022-02-17", "2022-02-18", "2022-02-21", "2022-02-22",  "2022-02-23",  "2022-02-24", "2022-02-25", "2022-02-28", "2022-02-15", "2022-02-16", "2022-02-17", "2022-02-18", "2022-02-21", "2022-02-22", "2022-02-15", "2022-02-16", "2022-02-17", "2022-02-18", "2022-02-21", "2022-02-22", "2022-02-15", "2022-02-16", "2022-02-17", "2022-02-18", "2022-02-22","2022-02-21", "2022-02-23", "2022-02-24", "2022-02-25"];

                        $starttimes = ["09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00",  "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00", "09:00:00"];

                        $endtimes = ["12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00",  "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00", "12:00:00"];

                        $examdetail = new Examdetail();
                        $examdetail->date = $examdates[$key];
                        $examdetail->starttime = $starttimes[$key];
                        $examdetail->endtime = $endtimes[$key];
                        $examdetail->curriculum_id = $curriculum->id;
                        $examdetail->exam_id = $exam->id;
                        $examdetail->user_id = $userid;
                        $examdetail->school_id = $schoolid;
                        $examdetail->save();
                    
                    
                    
                }
            }

            

        }
        
    }
}
