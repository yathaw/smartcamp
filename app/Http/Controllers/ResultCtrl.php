<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


use Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class ResultCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();
        if(in_array($role[0],["Guardian", "Student"])){
            return view('backend.student.resultlist');
        }else{

            $schoolid = $authuser->school_id;
            $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();
            if (request('batch')) {
                $periodid = request('period');
                $sectionid = request('section');
                $batchid = request('batch');

                $dt = Carbon::now()->toDateString();

                $batch = Batch::find($batchid);

                $students = Student::with('studentsegments')->whereHas('studentsegments', function ($query) use ($batchid) {
                        $query->where('studentsegments.batch_id', $batchid);
                    })->get();

                $exams = Exam::where('section_id',$sectionid)->get();


                // dd($exams);
                return view('backend.result',compact('periods','periodid','sectionid','batchid','students','batch','exams'));

            }else{
                return view('backend.result',compact('periods'));
            }
        }
    }

    public function store(Request $request){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();
        $user = User::find($authuser_id);

        $examdetailid = $request->examdetailid;
        $studentids = $request->studentids;
        $points = $request->points;
        $marks = $request->marks;
        $comments = $request->comments;

        foreach($studentids as $key => $studentid){
            Result::create([
                'point'  => $points[$key],
                'mark'  => $marks[$key],
                'comment' => $comments[$key],
                'examdetail_id' => $examdetailid,
                'student_id' => $studentid,
                'user_id'  => $authuser_id,
                'school_id'  => $user->school_id
            ]);        
        }
        return back();

    }

    public function update(Request $request, $id)
    {
        $authuser_id = Auth::id();

        $point = $request->point;
        $mark = $request->mark;
        $comment = $request->comment;


        $data = array(
            'point'  =>  $point,
            'mark' => $mark,
            'comment' => $comment,
            'user_id'  => $authuser_id,
        );


        Result::where('id',$id)->update($data);

        return response()->json(['success'=>'Result <b> SAVED </b> successfully.']); 
    }
}
