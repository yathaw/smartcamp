<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\User;
use App\Models\School;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Subjecttype;


use DataTables;
use Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\App;

class CurriculumCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;

        $grades = Grade::whereHas('curricula', function($q) use ($schoolid)
        {
            $q->where('school_id', $schoolid);

        })
        ->orderBy('id')
        ->get();

        $curriculum_exists = 0;

        $subjecttypeids = array();
        foreach ($grades as $grade) {
            foreach ($grade->curricula as $curriculum) {
                $curriculum_exists = 1;
               $subjecttypeid = $curriculum->subjecttype_id;
                if(!in_array($subjecttypeid,$subjecttypeids))
                {
                    array_push($subjecttypeids, $subjecttypeid);
                }
            }
        }

        $subjecttypeids = array_filter($subjecttypeids);

        if ($subjecttypeids) {
            $subjecttypes = Subjecttype::whereIn('id', $subjecttypeids)->get();
        }else{
            $subjecttypes = null;
        }
        return view('backend.curriculum.list',compact('grades', 'subjecttypes', 'curriculum_exists', 'subjecttypeids'));
    }

    public function create()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $school = School::find($authuser->school_id);
        $gradeids = [];
        foreach ($school->grades as $grade) {
            array_push($gradeids, $grade->id);
        }

        $grades = Grade::whereIn('id', $gradeids)->get();
        $subjects = Subject::where('school_id', '=', $authuser->school_id)->latest()->get();
        $subjecttypes = Subjecttype::where('school_id', '=', $authuser->school_id)->latest()->get();


        return view('backend.curriculum.new', compact('grades','subjects','subjecttypes'));
        
    }

    public function store(Request $request)
    {
        // dd($request->subjects);
        $rules = [
            'grade'  => 'required',
            'subjects.*'  => 'required|gt:0',  
            'types'  => 'required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'grade.required' => 'အဆင့်အကွက် လိုအပ်သည်။',
                'subjects.*' => 'ဘာသာရပ်အကွက် လိုအပ်သည်။',
                'types.required' => 'အဓိက/အသေးအဖွဲအကွက် လိုအပ်သည်။',
                'successmsg' => 'အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'grade.required' => 'グレードフィールドは必須です。',
                'subjects.*' => '件名フィールドは必須です。',
                'types.required' => 'メジャー/マイナーフィールドは必須です。',
                'successmsg' => 'データが保存されました！'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'grade.required' => '成绩字段是必需的。',
                'subjects.*' => '主题字段是必需的。',
                'types.required' => '主要/次要字段是必需的。',
                'successmsg' => '您的数据已保存！'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'grade.required' => 'Das Notenfeld ist erforderlich.',
                'subjects.*' => 'Das Betrefffeld ist erforderlich.',
                'types.required' => 'Das Haupt-/Nebenfach ist erforderlich.',
                'successmsg' => 'Ihre Daten wurden gespeichert!'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'grade.required' => 'Le champ note est obligatoire.',
                'subjects.*' => 'Le champ objet est obligatoire.',
                'types.required' => 'Le champ majeure/mineure est obligatoire.',
                'successmsg' => "Vos données ont été enregistrées!"
            ];
        }
        else{
            $customMessages = [
                'grade.required' => 'The grade field is required.',
                'subjects.*' => 'The subject field is required.',
                'types.required' => 'The major / minor field is required.',
                'successmsg' => 'Your data was saved!'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $grade = $request->grade;
        $subjects = $request->subjects;
        $subjecttypes = $request->subjecttypes;
        $types = $request->types;
        $user = User::find($authuser_id);

        $hasgrade_inCurriculum = Curriculum::where('grade_id', $grade)
                                    ->where('school_id', $user->school_id)
                                    ->get();

        foreach ($subjects as $key => $subject) {

            if($hasgrade_inCurriculum->isEmpty()){
                $sorting_data = 1;
            }else{
                if($subjecttypes[$key]){
                    $hassubjecttypeid_inCurriculum = Curriculum::where('grade_id',$grade)
                                                ->where('type',$types[$key])
                                                ->where('subjecttype_id',$subjecttypes[$key])
                                                ->latest('sorting')->first();
                    if($hassubjecttypeid_inCurriculum){
                        $sorting = $hassubjecttypeid_inCurriculum->sorting;
                        $sorting_data = ++$sorting;

                    }
                    else{
                        $sorting_data = 1;
                    }
                }else{
                    $hasnotsubjecttypeid_inCurriculum = Curriculum::where('grade_id',$grade)
                                                ->where('type',$types[$key])
                                                ->where('subjecttype_id',NULL)
                                                ->latest('sorting')->first();
                    if($hasnotsubjecttypeid_inCurriculum){
                        $sorting = $hasnotsubjecttypeid_inCurriculum->sorting;
                        $sorting_data = ++$sorting;
                    }else{
                        $sorting_data = 1;
                    }   
                }
            }

            $curricula = new Curriculum;
            $curricula->type = $types[$key];
            $curricula->grade_id = $grade;
            $curricula->subject_id = $subject;
            $curricula->subjecttype_id = $subjecttypes[$key];
            $curricula->school_id = $authuser->school_id;
            $curricula->sorting = $sorting_data++;
            $curricula->save();

        }

        // alert()->success('');
        Alert::success('Success', $customMessages['successmsg']);

        return redirect()->back();


    }

    
    public function show(Curriculum $curriculum)
    {
        //
    }

    public function edit(Curriculum $curriculum)
    {
        //
    }

    
    public function update(Request $request, Curriculum $curriculum)
    {
        //
    }

    
    public function destroy(Curriculum $curriculum)
    {
        $curriculum->delete();

        return response()->json(['success'=>'Curriculum <b> DELETED </b> successfully.']);

    }

    public function storesorting(Request $request){
        $curricula = $request->curricula;
        foreach ($curricula as $key => $value) {
            $id = $value['id'];
            $sorting = $value['sorting'];

            $data = array(
                'sorting'  =>  $sorting,
            );
            Curriculum::where('id',$id)->update($data);

        }
        $data = ['message' => 'Sorting success!'];

        return response()->json($data, 200);
    }
}
