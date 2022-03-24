<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use DataTables;
use Illuminate\Support\Facades\App;
use Auth;
use App\Models\Scheduletype;
use App\Models\Section;
use App\Models\Period;
use App\Models\Holiday;
use App\Models\User;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class ScheduleCtrl extends Controller
{
    public function index()
    {

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;

        $school = School::find($schoolid);
        $gradeids = [];
        foreach ($school->grades as $grade) {
            array_push($gradeids, $grade->id);
        }

        $grades = Grade::whereIn('id', $gradeids)->get();

        $scheduletypes = Scheduletype::where('school_id', '=', $schoolid)->latest()->get();
        $sections = Section::where('school_id', '=', $schoolid)->orderby('startdate','DESC')->get();    
        $holidays = Holiday::where('school_id', '=', $schoolid)->latest()->get();
        $periods = Period::where('school_id', '=', $schoolid)->latest()->get();

        if (request('period')) {
            $period = Period::find(request('period'));

            $sections = Section::where('period_id', '=', $period->id)->orderby('grade_id')->get();

            return view('backend.schedule',compact('scheduletypes','periods','period','sections'));

        }else{
            return view('backend.schedule',compact('scheduletypes','periods'));
        }


    }

    public function create()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;

        $scheduletypes = Scheduletype::where('school_id', '=', $schoolid)->latest()->get();
        $sections = Section::where('school_id', '=', $schoolid)->orderby('startdate','DESC')->get();    
        $periods = Period::where('school_id', '=', $schoolid)->latest()->get();
        $holidays = Holiday::where('school_id', '=', $schoolid)->latest()->get();

        return view('backend.schedule.new',compact('scheduletypes','sections','periods','holidays'));
        
    }

    public function store(Request $request)
    {

        $request->merge([
            'startdate' =>  Carbon::parse($request->startdate)->format('Y-m-d'),
            'enddate' =>  Carbon::parse($request->enddate)->format('Y-m-d')
        ]);

        $rules = [
            'scheduletype'  => 'required',
            'startdate' =>'required|date',
            'enddate' =>'required|date|after_or_equal:startdate',
            'starttime' => 'required',
            'endtime' => 'required',
            'teacher' => 'required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'scheduletype.required' => 'အနည်းဆုံး အချိန်ဇယား အမျိုးအစားတစ်ခုကို ရွေးပါ။',
                'startdate.required' => 'စတင်သည့်ရက်စွဲအကွက် လိုအပ်သည်။',
                'startdate.date' => 'စတင်သည့်ရက်စွဲအကွက်သည် ရက်စွဲတစ်ခု ဖြစ်ရပါမည်။',
                'enddate.required' => 'ပြီးဆုံးသည့်ရက်စွဲအကွက်သည် လိုအပ်သည်။',
                'enddate.date' => 'ပြီးဆုံးသည့်ရက်စွဲအကွက်သည် ရက်စွဲတစ်ခု ဖြစ်ရပါမည်။',
                'enddate.after_or_equal' => 'ပြီးဆုံးသည့်ရက်စွဲသည် စတင်ရက်စွဲပြီးနောက် ဖြစ်ရပါမည်။',
                'starttime.required' => 'အတန်းစတင်မည့်ချိန်အကွက် လိုအပ်သည်။',
                'endtime.required' => 'အတန်းဆုံးမည့်အချိန်အကွက် လိုအပ်သည်။',
                'teacher.required' => 'ထိုအချိန်ဇယားအတွက် အနည်းဆုံး ဆရာတစ်ဦးကို ရွေးချယ်ပါ။',
                'successmsg' => 'အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'scheduletype.required' => '少なくとも1つのスケジュールタイプを選択してください。',
                'startdate.required' => '開始日フィールドは必須です。',
                'startdate.date' => '開始日フィールドは日付である必要があります。',
                'enddate.required' => '終了日フィールドは必須です。',
                'enddate.date' => '終了日フィールドは日付である必要があります。',
                'enddate.after_or_equal' => '終了日は開始日より後でなければなりません',
                'starttime.required' => '開始時刻フィールドは必須です。',
                'endtime.required' => '終了時間フィールドは必須です。',
                'teacher.required' => 'そのスケジュールには少なくとも1人の教師を選択してください。',
                'successmsg' => 'データが保存されました！'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'scheduletype.required' => '请至少选择一种日程安排类型。',
                'startdate.required' => '开始日期字段是必需的。',
                'startdate.date' => '开始日期字段必须是日期。',
                'enddate.required' => '结束日期字段是必需的。',
                'enddate.date' => '结束日期字段必须是日期。',
                'enddate.after_or_equal' => '结束日期必须晚于开始日期',
                'starttime.required' => '开始时间字段是必需的。',
                'endtime.required' => '结束时间字段是必需的。',
                'teacher.required' => '请为该时间表选择至少一名教师。',
                'successmsg' => '您的数据已保存！'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'scheduletype.required' => 'Bitte wählen Sie mindestens einen Zeitplantyp aus.',
                'startdate.required' => 'Das Feld Startdatum ist erforderlich.',
                'startdate.date' => 'Das Startdatumsfeld muss ein Datum sein.',
                'enddate.required' => 'Das Feld Enddatum ist erforderlich.',
                'enddate.date' => 'Das Enddatumsfeld muss ein Datum sein.',
                'enddate.after_or_equal' => 'Das Enddatum muss nach dem Startdatum liegen',
                'starttime.required' => 'Das Feld Startzeit ist erforderlich.',
                'endtime.required' => 'Das Endzeitfeld ist erforderlich.',
                'teacher.required' => 'Bitte wählen Sie mindestens einen Lehrer für diesen Stundenplan aus.',
                'successmsg' => 'Ihre Daten wurden gespeichert!'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'scheduletype.required' => 'Veuillez sélectionner au moins un type de planification.',
                'startdate.required' => 'Le champ date de début est obligatoire.',
                'startdate.date' => 'Le champ de date de début doit être une date.',
                'enddate.required' => 'Le champ date de fin est obligatoire.',
                'enddate.date' => 'Le champ de date de fin doit être une date.',
                'enddate.after_or_equal' => 'La date de fin doit être postérieure à la date de début',
                'starttime.required' => 'Le champ Heure de début est obligatoire.',
                'endtime.required' => 'Le champ heure de fin est obligatoire.',
                'teacher.required' => 'Veuillez sélectionner au moins un enseignant pour cet horaire.',
                'successmsg' => "Vos données ont été enregistrées!"
            ];
        }
        else{
            $customMessages = [
                'scheduletype.required' => 'Please select at least one scheduletype.',
                'startdate.required' => 'The start date field is required.',
                'startdate.date' => 'The start date field must be a date.',
                'enddate.required' => 'The end date field is required.',
                'enddate.date' => 'The end date field must be a date.',
                'enddate.after_or_equal' => 'End date must be after start date.',
                'starttime.required' => 'The start time field is required.',
                'endtime.required' => 'The end time field is required.',
                'teacher.required' => 'Please select at least one teacher for that schedule.',
                'successmsg' => 'Your data was saved!'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();
        $user = User::find($authuser_id);


        $scheduletype = $request->scheduletype;
        $color = $request->color;
        $batch = $request->batch;
        $title = $request->title;

        $startdate = $request->startdate;
        $enddate = $request->enddate;

        $starttime = $request->starttime;
        $endtime = $request->endtime;
        $time = $starttime.' - '.$endtime;

        $teacher = $request->teacher;

        $dt = Carbon::create($startdate);
        $dt2 = Carbon::create($enddate);
        $daysForExtraCoding = $dt->diffInDaysFiltered(function(Carbon $date) {
                return !$date->isWeekend();
        }, $dt2);


        $period = CarbonPeriod::create($startdate, $enddate);

        $weekendFilter = function ($date) {
            return $date->isWeekday();
        };
        $period->filter($weekendFilter);

        $days = [];
        foreach ($period as $date) {

            $date_event  = $date->format('Y-m-d');

            $schedule = new Schedule;
            $schedule->title = $title;
            $schedule->date = $date_event;
            $schedule->starttime = $starttime;
            $schedule->endtime = $endtime;
            $schedule->color = $color;
            $schedule->scheduletype_id = $scheduletype;
            $schedule->batch_id = $batch;
            $schedule->teachersegment_id = $teacher;
            $schedule->staff_id = $user->staff->id;
            $schedule->school_id = $user->school_id;

            $schedule->save();


        }


        return redirect()->back()->with('success', $customMessages['successmsg']);

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
