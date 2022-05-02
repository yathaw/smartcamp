<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use DataTables;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Section;
use App\Models\Period;
use App\Models\Holiday;
use App\Models\User;
use App\Models\School;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\Batch;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ScheduleCtrl extends Controller
{
    public function index()
    {

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        if(in_array($role[0],["Guardian", "Student"])){
            return view('backend.student.schedulelist');
        }else{

            $schoolid = $authuser->school_id;

            $school = School::find($schoolid);
            $gradeids = [];
            foreach ($school->grades as $grade) {
                array_push($gradeids, $grade->id);
            }

            $grades = Grade::whereIn('id', $gradeids)->get();

            $sections = Section::where('school_id', '=', $schoolid)->orderby('startdate','DESC')->get();    
            $holidays = Holiday::where('school_id', '=', $schoolid)->latest()->get();
            $periods = Period::where('school_id', '=', $schoolid)->latest()->get();

            if (request('batch')) {
                $batchid = request('batch');
                $sectionid = request('section');
                $periodid = request('period');

                $batch = Batch::find($batchid);
                $section = Section::find($sectionid);
                $period = Period::find($periodid);


                $teachersegments = Curriculum::with(['subject','subjecttype','teachersegment'=>function($q1) use ($batchid){
                                $q1->with(['user','staff'=> function($q2) use($batchid){
                                    $q2->with('user');
                                    $q2->get();
                                }]);
                                $q1->where('batch_id',$batchid);
                                $q1->get();
                            }])
                ->whereHas('teachersegment',function($q) use($batchid){
                    $q->where('batch_id',$batchid);
                })
                ->get()
                ->sortBy('sorting')
                ;


                $schedules = Schedule::with([
                    'batch' => function($q1){
                        $q1->with(['section']);
                        $q1->get();
                    },
                    'teachersegment' => function($q1){
                        $q1->with(['curriculum'=> function($q2){
                            $q2->with('subject','subjecttype');
                        }]);
                        $q1->get();
                    }
                ])
                ->where('batch_id', $batchid)
                ->get();


                return view('backend.schedule.list',compact('periods','teachersegments','periodid','sectionid','batchid', 'schedules', 'batch', 'section', 'period'));

            }else{
                return view('backend.schedule.list',compact('periods'));
            }
        }

    }

    public function create()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;

        $scheduletypes = Scheduletype::where('school_id', '=', $schoolid)->latest()->get();
        $periods = Period::where('school_id', '=', $schoolid)->latest()->get();
        $holidays = Holiday::where('school_id', '=', $schoolid)->latest()->get();

        if (request('batch')) {
            $batchid = request('batch');
            $sectionid = request('section');
            $periodid = request('period');


            $teachersegments = Curriculum::with(['subject','subjecttype','teachersegment'=>function($q1) use ($batchid){
                            $q1->with(['user','staff'=> function($q2) use($batchid){
                                $q2->with('user');
                                $q2->get();
                            }]);
                            $q1->where('batch_id',$batchid);
                            $q1->get();
                        }])
            ->whereHas('teachersegment',function($q) use($batchid){
                $q->where('batch_id',$batchid);
            })
            ->get()
            ->sortBy('sorting');
            dd($periodid);

            // $schedules = Schedule::with([
            //     'batch' => function($q1){
            //         $q1->with(['section']);
            //         $q1->get();
            //     },
            //     'teachersegment' => function($q1){
            //         $q1->with(['curriculum'=> function($q2){
            //             $q2->with('subject','subjecttype');
            //         }]);
            //         $q1->get();
            //     },
            //     'scheduletype',
            // ])
            // ->where('batch_id', $batchid)
            // ->get();

            return view('backend.schedule.list',compact('scheduletypes','periods','teachersegments','batchid','sectionid','periodid'));

        }else{
            return view('backend.schedule.newold1',compact('scheduletypes','periods','holidays'));
        }
    }

    public function store(Request $request)
    {

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();
        $user = User::find($authuser_id);

        $scheduledetails = $request->scheduledetail;
        $batchid = $request->batchid;


        foreach($scheduledetails as $scheduledetail){
            $day = $scheduledetail['day'];
            $type = $scheduledetail['type'];
            $id = $scheduledetail['id'];

            $schedule = new Schedule;
            $schedule->day = $day;

            if ($type == "teachersegment") {
                $schedule->teachersegment_id = $id;
            }else{
                $schedule->scheduletype_id = $id;
            }
            $schedule->batch_id = $batchid;
            $schedule->staff_id = $user->staff->id;
            $schedule->school_id = $user->school_id;
            $schedule->save();


        }


        return response()->json(['success'=>'City <b> SAVED </b> successfully.']);

    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy(Schedule $schedule)
    {
        

    }

}
