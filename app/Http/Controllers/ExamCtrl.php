<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Exam;
use App\Models\Examdetail;
use App\Models\Batch;
use App\Models\School;
use App\Models\Period;
use App\Models\Grade;

use DataTables;
use Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;

class ExamCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();


            $schoolid = $authuser->school_id;
            $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();
            if (request('section')) {
                $periodid = request('period');
                $sectionid = request('section');


                $exams = Exam::where('section_id',$sectionid)->get();

                return view('backend.exam.list',compact('periods','periodid','exams','sectionid'));

            }else{
                return view('backend.exam.list',compact('periods'));
            }

    }

    public function create()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();

        $school = School::find($authuser->school_id);
        $schoolid = $school->id;

        $batches = Batch::where('school_id',$schoolid)->get();

        $gradeids = [];
        foreach ($school->grades as $grade) {
            array_push($gradeids, $grade->id);
        }

        $grades = Grade::whereHas('curricula', function($q) use ($schoolid)
        {
            $q->where('school_id', $schoolid);

        })
        ->whereIn('id', $gradeids)
        ->get();

        $periods = Period::where('school_id', '=', $authuser->school_id)->latest()->get();

        return view('backend.exam.new',compact('batches','periods'));
    }

    public function store(Request $request){
        $authuser = Auth::user();

        $title = $request->title;
        $rules = $request->rules;
        $section = $request->section;
        $cids = $request->cid;
        $examdates = $request->examdate;
        $starttimes = $request->starttime;
        $endtimes = $request->endtime;

        $examdate_lastkey = array_key_last($examdates);
        $enddate = $examdates[$examdate_lastkey];
        $startdate = $examdates[0];

        $exam = new Exam();
        $exam->name = $title;
        $exam->startdate = $startdate;
        $exam->enddate = $enddate;
        $exam->rule = json_encode($rules);
        $exam->section_id = $section;
        $exam->user_id = $authuser->id;
        $exam->school_id = $authuser->school_id;
        $exam->save();

        foreach ($cids as $key => $cid) {
            $examdetail = new Examdetail();
            $examdetail->date = $examdates[$key];
            $examdetail->starttime = Carbon::parse($starttimes[$key])->toTimeString();
            $examdetail->endtime = Carbon::parse($endtimes[$key])->toTimeString();
            $examdetail->curriculum_id = $cid;
            $examdetail->exam_id = $exam->id;
            $examdetail->user_id = $authuser->id;
            $examdetail->school_id = $authuser->school_id;
            $examdetail->save();
        }

        return redirect()->back()->with('success','Exam has been created.');

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'  =>'required',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'စာမေးပွဲခေါင်းစဉ်အကွက် လိုအပ်သည်။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '試験タイトルフィールドは必須です。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '考试标题字段是必填项。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Prüfungstitel ist erforderlich.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ du titre de l'examen est obligatoire.",
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The exam title field is required.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $data = array(
            'name'  =>  $name
        );

        Exam::where('id',$id)->update($data);

        return response()->json(['success'=>'Exam <b> SAVED </b> successfully.']); 
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();

        return response()->json(['success'=>'Exam <b> DELETED </b> successfully.']);

    }

    public function examdetailupdate(Request $request, $id){
        $date = $request->date;
        $starttime = $request->starttime;
        $endtime = $request->endtime;


        $data = array(
            'date'  =>  $date,
            'starttime'  =>  Carbon::parse($starttime)->toTimeString(),
            'endtime'  =>  Carbon::parse($endtime)->toTimeString()
        );

        Examdetail::where('id',$id)->update($data);

        return response()->json(['success'=>'Examdetail <b> SAVED </b> successfully.']); 
        
    }

    public function examdetaildestroy($id)
    {
        $examdetail = Examdetail::find($id); 
        $examdetail->delete();

        return response()->json(['success'=>'examdetail <b> DELETED </b> successfully.']);

    }


}
