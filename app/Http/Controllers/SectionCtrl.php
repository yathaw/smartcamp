<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use App\Models\Grade;
use App\Models\Period;
use App\Models\School;
use Illuminate\Http\Request;
use Auth;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Carbon\CarbonInterval;
use App\Models\Package;
use App\Models\Batch;
use App\Models\Teachersegment;
use App\Models\Currency;
use App\Models\Curriculum;
use App\Models\Student;
use App\Models\Studentsegment;



class SectionCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $school = School::find($authuser->school_id);
        $schoolid = $school->id;

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

        return view('backend.section.list',compact('grades','periods'));
    }

    public function getlistData(){

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Section::where('school_id', '=', $user->school_id)->orderby('startdate','DESC')->get();

        // dd($data);

        return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('codeno', function(Section $section) {
                    return $section->codeno;
                })
                ->addColumn('grade', function(Section $section) {
                    return $section->grade->name;
                })

                ->addColumn('startdate', function(Section $section) {
                    $sdate = date('d M, Y',strtotime($section->startdate));
                    return $sdate;
                })
                ->addColumn('enddate', function(Section $section) {
                    $edate = date('d M, Y',strtotime($section->enddate));
                    return $edate;
                })
                ->addColumn('time', function(Section $section) {

                    $s = Carbon::parse($section->starttime);
                    $starttime = $s->format('g:i A');

                    $e = Carbon::parse($section->endtime);
                    $endtime = $e->format('g:i A');

                    return $starttime.' - '.$endtime;
                })
                ->addColumn('period', function(Section $section) {
                    return $section->period->name;
                })
                ->addColumn('action', function($row){

                    $startdate = Carbon::parse($row->startdate)->format('d M Y');
                    $enddate = Carbon::parse($row->enddate)->format('d M Y');


                    $detailurl = route('master.section.show',$row->id);

                    $toggleDetail =  __('Detail');
                    $toggleEdit =  __('Edit');
                    $toggleDelete=__('Remove');
                    
                    $btn = '<div class="">';
                    
                    $btn .= '<a href="'.$detailurl.'" class="btn btn-outline-info me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDetail.'">
                                <i class="bi bi-info-lg"></i> 
                            </a>';

                    $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-codeno="'.$row->codeno.'" data-startdate="'.$startdate.'" data-enddate="'.$enddate.'" data-starttime="'.$row->starttime.'" data-endtime="'.$row->endtime.'" data-period_id="'.$row->period_id.'" data-grade_id="'.$row->grade_id.'">
                                <i class="bi bi-gear-fill"></i> 
                            </button>';
                    $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                <i class="bi bi-x-lg"></i> 
                            </button>';

                    $btn .='</div>';
                    
                    return $btn;
                })
                ->rawColumns(['action','time'])
                ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        
        $request->merge([
            'startdate' =>  Carbon::parse($request->startdate)->format('Y-m-d'),
            'enddate' =>  Carbon::parse($request->enddate)->format('Y-m-d')
        ]);

        $rules = [
            'codeno' => 'required|min:3|max:255',
            'period' => 'required',
            'grade' => 'required',
            'startdate' =>'required|date',
            'enddate' =>'required|date|after_or_equal:startdate',
            'starttime' => 'required',
            'endtime' => 'required'

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'codeno.required' => 'မှန်ကန်ကြောင်း ကဏ္ဍကုဒ်နံပါတ်ကို ထည့်သွင်းပါ။',
                'codeno.min' => 'ကုဒ်နံပါတ်သည် စာလုံး 3 လုံးရှည်ရပါမည်။',
                'codeno.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'period.required' => 'ပညာသင်ကာလအပိုင်းအခြားလိုအပ်သည်။',
                'grade.required' => 'အဆင့်အကွက် လိုအပ်သည်။',
                'startdate.required' => 'စတင်သည့်ရက်စွဲအကွက် လိုအပ်သည်။',
                'startdate.date' => 'စတင်သည့်ရက်စွဲအကွက်သည် ရက်စွဲတစ်ခု ဖြစ်ရပါမည်။',
                'enddate.required' => 'ပြီးဆုံးသည့်ရက်စွဲအကွက်သည် လိုအပ်သည်။',
                'enddate.date' => 'ပြီးဆုံးသည့်ရက်စွဲအကွက်သည် ရက်စွဲတစ်ခု ဖြစ်ရပါမည်။',
                'enddate.after_or_equal' => 'ပြီးဆုံးသည့်ရက်စွဲသည် စတင်ရက်စွဲပြီးနောက် ဖြစ်ရပါမည်။',
                'starttime.required' => 'အတန်းစတင်မည့်ချိန်အကွက် လိုအပ်သည်။',
                'endtime.required' => 'အတန်းဆုံးမည့်အချိန်အကွက် လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'codeno.required' => 'セクションコード番号を入力して検証します。',
                'codeno.min' => 'コード番号は3文字の長さである必要があります。',
                'codeno.max' => '最大長255文字に達しました。',
                'period.required' => '学期フィールドは必須です。',
                'grade.required' => 'グレードフィールドは必須です。',
                'startdate.required' => '開始日フィールドは必須です。',
                'startdate.date' => '開始日フィールドは日付である必要があります。',
                'enddate.required' => '終了日フィールドは必須です。',
                'enddate.date' => '終了日フィールドは日付である必要があります。',
                'enddate.after_or_equal' => '終了日は開始日より後でなければなりません',
                'starttime.required' => '開始時刻フィールドは必須です。',
                'endtime.required' => '終了時間フィールドは必須です。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'codeno.required' => '输入部分代码编号验证。',
                'codeno.min' => '代码编号必须为 3 个字符长。',
                'codeno.max' => '已达到 255 个字符的最大长度。',
                'period.required' => '学术期间字段是必需的。',
                'grade.required' => '成绩字段是必需的。',
                'startdate.required' => '开始日期字段是必需的。',
                'startdate.date' => '开始日期字段必须是日期。',
                'enddate.required' => '结束日期字段是必需的。',
                'enddate.date' => '结束日期字段必须是日期。',
                'enddate.after_or_equal' => '结束日期必须晚于开始日期',
                'starttime.required' => '开始时间字段是必需的。',
                'endtime.required' => '结束时间字段是必需的。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'codeno.required' => 'Geben Sie eine Abschnittscodenummer ein validieren.',
                'codeno.min' => 'Die Codenummer muss 3 Zeichen lang sein.',
                'codeno.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'period.required' => 'Das Feld Akademischer Zeitraum ist erforderlich.',
                'grade.required' => 'Das Notenfeld ist erforderlich.',
                'startdate.required' => 'Das Feld Startdatum ist erforderlich.',
                'startdate.date' => 'Das Startdatumsfeld muss ein Datum sein.',
                'enddate.required' => 'Das Feld Enddatum ist erforderlich.',
                'enddate.date' => 'Das Enddatumsfeld muss ein Datum sein.',
                'enddate.after_or_equal' => 'Das Enddatum muss nach dem Startdatum liegen',
                'starttime.required' => 'Das Feld Startzeit ist erforderlich.',
                'endtime.required' => 'Das Endzeitfeld ist erforderlich.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'codeno.required' => 'Saisir un numéro de code section valider.',
                'codeno.min' => 'Le numéro de code doit comporter 3 caractères.',
                'codeno.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'period.required' => 'Le champ période académique est obligatoire.',
                'grade.required' => 'Le champ note est obligatoire.',
                'startdate.required' => 'Le champ date de début est obligatoire.',
                'startdate.date' => 'Le champ de date de début doit être une date.',
                'enddate.required' => 'Le champ date de fin est obligatoire.',
                'enddate.date' => 'Le champ de date de fin doit être une date.',
                'enddate.after_or_equal' => 'La date de fin doit être postérieure à la date de début',
                'starttime.required' => 'Le champ Heure de début est obligatoire.',
                'endtime.required' => 'Le champ heure de fin est obligatoire.'
            ];
        }
        else{
            $customMessages = [
                'codeno.required' => 'Enter a section code number validate.',
                'codeno.min' => 'Code number must be 3 characters long.',
                'codeno.max' => 'The max length of 255 characters is reached.',
                'period.required' => 'The academic period field is required.',
                'grade.required' => 'The grade field is required.',
                'startdate.required' => 'The start date field is required.',
                'startdate.date' => 'The start date field must be a date.',
                'enddate.required' => 'The end date field is required.',
                'enddate.date' => 'The end date field must be a date.',
                'enddate.after_or_equal' => 'End date must be after start date.',
                'starttime.required' => 'The start time field is required.',
                'endtime.required' => 'The end time field is required.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $codeno = $request->codeno;
        $period = $request->period;
        $grade = $request->grade;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $starttime = $request->starttime;
        $endtime = $request->endtime;

        $section = new Section();
        $section->codeno = $codeno;
        $section->startdate = Carbon::parse($startdate)->toDateString();
        $section->enddate = Carbon::parse($enddate)->toDateString();
        $section->starttime = Carbon::parse($starttime)->toTimeString();
        $section->endtime = Carbon::parse($endtime)->toTimeString();
        $section->period_id = $period;
        $section->grade_id = $grade;
        $section->user_id = $authuser_id;
        $section->school_id = $authuser->school_id;
        $section->save();

        return response()->json(['success'=>'Section <b> SAVED </b> successfully.']);

    }

    public function show(Section $section)
    {
        $packages = Package::with('user')->where('section_id',$section->id)->get();
        $batches = Batch::with('user')->where('section_id',$section->id)->get();
        $currencies = Currency::all();

        $curricula = Curriculum::with('subject','subjecttype')
                    ->where('grade_id', $section->grade_id)
                    ->get()
                    ->sortBy('subject.sorting');

        $batchids = Batch::where('section_id',$section->id)->pluck('id');

        $studentsegments = Studentsegment::whereIn('batch_id',$batchids)->get()->count();

        return view('backend.section.show',compact('section','packages','batches','currencies','curricula','studentsegments'));
    }

    public function edit(Section $section)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'startdate' =>  Carbon::parse($request->startdate)->format('Y-m-d'),
            'enddate' =>  Carbon::parse($request->enddate)->format('Y-m-d')
        ]);

        $rules = [
            'codeno' => 'required|min:3|max:255',
            'period' => 'required',
            'grade' => 'required',
            'startdate' =>'required|date',
            'enddate' =>'required|date|after_or_equal:startdate',
            'starttime' => 'required',
            'endtime' => 'required'

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'codeno.required' => 'မှန်ကန်ကြောင်း ကဏ္ဍကုဒ်နံပါတ်ကို ထည့်သွင်းပါ။',
                'codeno.min' => 'ကုဒ်နံပါတ်သည် စာလုံး 3 လုံးရှည်ရပါမည်။',
                'codeno.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'period.required' => 'ပညာသင်ကာလအပိုင်းအခြားလိုအပ်သည်။',
                'grade.required' => 'အဆင့်အကွက် လိုအပ်သည်။',
                'startdate.required' => 'စတင်သည့်ရက်စွဲအကွက် လိုအပ်သည်။',
                'startdate.date' => 'စတင်သည့်ရက်စွဲအကွက်သည် ရက်စွဲတစ်ခု ဖြစ်ရပါမည်။',
                'enddate.required' => 'ပြီးဆုံးသည့်ရက်စွဲအကွက်သည် လိုအပ်သည်။',
                'enddate.date' => 'ပြီးဆုံးသည့်ရက်စွဲအကွက်သည် ရက်စွဲတစ်ခု ဖြစ်ရပါမည်။',
                'enddate.after_or_equal' => 'ပြီးဆုံးသည့်ရက်စွဲသည် စတင်ရက်စွဲပြီးနောက် ဖြစ်ရပါမည်။',
                'starttime.required' => 'အတန်းစတင်မည့်ချိန်အကွက် လိုအပ်သည်။',
                'endtime.required' => 'အတန်းဆုံးမည့်အချိန်အကွက် လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'codeno.required' => 'セクションコード番号を入力して検証します。',
                'codeno.min' => 'コード番号は3文字の長さである必要があります。',
                'codeno.max' => '最大長255文字に達しました。',
                'period.required' => '学期フィールドは必須です。',
                'grade.required' => 'グレードフィールドは必須です。',
                'startdate.required' => '開始日フィールドは必須です。',
                'startdate.date' => '開始日フィールドは日付である必要があります。',
                'enddate.required' => '終了日フィールドは必須です。',
                'enddate.date' => '終了日フィールドは日付である必要があります。',
                'enddate.after_or_equal' => '終了日は開始日より後でなければなりません',
                'starttime.required' => '開始時刻フィールドは必須です。',
                'endtime.required' => '終了時間フィールドは必須です。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'codeno.required' => '输入部分代码编号验证。',
                'codeno.min' => '代码编号必须为 3 个字符长。',
                'codeno.max' => '已达到 255 个字符的最大长度。',
                'period.required' => '学术期间字段是必需的。',
                'grade.required' => '成绩字段是必需的。',
                'startdate.required' => '开始日期字段是必需的。',
                'startdate.date' => '开始日期字段必须是日期。',
                'enddate.required' => '结束日期字段是必需的。',
                'enddate.date' => '结束日期字段必须是日期。',
                'enddate.after_or_equal' => '结束日期必须晚于开始日期',
                'starttime.required' => '开始时间字段是必需的。',
                'endtime.required' => '结束时间字段是必需的。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'codeno.required' => 'Geben Sie eine Abschnittscodenummer ein validieren.',
                'codeno.min' => 'Die Codenummer muss 3 Zeichen lang sein.',
                'codeno.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'period.required' => 'Das Feld Akademischer Zeitraum ist erforderlich.',
                'grade.required' => 'Das Notenfeld ist erforderlich.',
                'startdate.required' => 'Das Feld Startdatum ist erforderlich.',
                'startdate.date' => 'Das Startdatumsfeld muss ein Datum sein.',
                'enddate.required' => 'Das Feld Enddatum ist erforderlich.',
                'enddate.date' => 'Das Enddatumsfeld muss ein Datum sein.',
                'enddate.after_or_equal' => 'Das Enddatum muss nach dem Startdatum liegen',
                'starttime.required' => 'Das Feld Startzeit ist erforderlich.',
                'endtime.required' => 'Das Endzeitfeld ist erforderlich.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'codeno.required' => 'Saisir un numéro de code section valider.',
                'codeno.min' => 'Le numéro de code doit comporter 3 caractères.',
                'codeno.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'period.required' => 'Le champ période académique est obligatoire.',
                'grade.required' => 'Le champ note est obligatoire.',
                'startdate.required' => 'Le champ date de début est obligatoire.',
                'startdate.date' => 'Le champ de date de début doit être une date.',
                'enddate.required' => 'Le champ date de fin est obligatoire.',
                'enddate.date' => 'Le champ de date de fin doit être une date.',
                'enddate.after_or_equal' => 'La date de fin doit être postérieure à la date de début',
                'starttime.required' => 'Le champ Heure de début est obligatoire.',
                'endtime.required' => 'Le champ heure de fin est obligatoire.'
            ];
        }
        else{
            $customMessages = [
                'codeno.required' => 'Enter a section code number validate.',
                'codeno.min' => 'Code number must be 3 characters long.',
                'codeno.max' => 'The max length of 255 characters is reached.',
                'period.required' => 'The academic period field is required.',
                'grade.required' => 'The grade field is required.',
                'startdate.required' => 'The start date field is required.',
                'startdate.date' => 'The start date field must be a date.',
                'enddate.required' => 'The end date field is required.',
                'enddate.date' => 'The end date field must be a date.',
                'enddate.after_or_equal' => 'End date must be after start date.',
                'starttime.required' => 'The start time field is required.',
                'endtime.required' => 'The end time field is required.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $codeno = $request->codeno;
        $period = $request->period;
        $grade = $request->grade;
        $startdate = $request->startdate;
        $enddate = $request->enddate;
        $starttime = $request->starttime;
        $endtime = $request->endtime;

        $data = array(
            'codeno'  =>  $codeno,
            'startdate'  =>  Carbon::parse($startdate)->toDateString(),
            'enddate'  =>  Carbon::parse($enddate)->toDateString(),
            'starttime'  =>  Carbon::parse($starttime)->toTimeString(),
            'endtime'  =>  Carbon::parse($endtime)->toTimeString(),
            'period_id'  =>  $period,
            'grade_id'  =>  $grade,
            'user_id'  =>  $authuser_id,
            'school_id'  =>  $authuser->school_id
        );

        Section::where('id',$id)->update($data);

        return response()->json(['success'=>'Section <b> SAVED </b> successfully.']);
    }

    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();

        return response()->json(['success'=>'Section <b> DELETED </b> successfully.']);
        //
    }
}
