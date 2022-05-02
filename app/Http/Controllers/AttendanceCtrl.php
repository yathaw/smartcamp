<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\School;
use App\Models\Period;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\Section;
use App\Models\Holiday;


use DataTables;
use Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Http\Request;

class AttendanceCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        if(in_array($role[0],["Guardian", "Student"])) {
            return view('backend.student.attendancelist');
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

                $now = Carbon::now();
                $todaydate = $now->formatLocalized('%A, %d %B  %Y'); 
                $today = Carbon::parse($todaydate)->format('Y-m-d');

                $todayattendances = Attendance::where('date', $today)->where('batch_id',$batchid)->get();

                $attendances = Attendance::where('batch_id',$batchid)->get()->toArray();


                $period = Period::find($periodid);
                $section = Section::find($sectionid);

                $startyear = $period->startyear;
                $endyear = $period->endyear;

                $startdate = $section->startdate;
                $enddate = $section->enddate;

                $holidays = Holiday::WhereBetween('date',[Carbon::parse($startdate),Carbon::parse($enddate)])->get()->toArray();
                // dd($holidays);
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
                    $datelist  = $date->format('Y-m-d');

                    // $datelist_format  = $date->format('d M, Y');
                    $day_event  = $date->format('D');

                    $search_holiday = array_search($datelist, array_column($holidays, 'date'));
                    if($search_holiday){
                        $holidaydate = $holidays[$search_holiday]['name'];
                    }
                    else{
                        $holidaydate = $search_holiday;
                    }
                    $array = [
                        "date" => $datelist,
                        "day" => $day_event,
                        "holiday" => $holidaydate

                    ];

                    array_push($days, $array);
                }

                $s = \Carbon\Carbon::createFromFormat('Y-m-d',$startdate);
                $e = \Carbon\Carbon::createFromFormat('Y-m-d',$enddate);

                $attcheck = \Carbon\Carbon::now()->between($s,$e);
                

                return view('backend.attendance',compact('periods','periodid','sectionid','batchid','students','batch','dt','todayattendances','attendances','holidays','startdate','enddate','days','attcheck'));

            }else{
                return view('backend.attendance',compact('periods'));
            }
        }
    }

    public function store(Request $request){
        $students = request('studentid');
        $remarks = request('remark');
        $batchid = request('batchid');

        $attendanceStataus = $request->status;

        // dd($remarks);

        for ($i=0; $i < (count($students)); $i++) {

            $studentid = $students[$i];

            $status = $attendanceStataus[$studentid];
            $remark = $remarks[$i];

            $attendances = new Attendance();
            $attendances->date = Carbon::now();
            $attendances->status = $status;
           
            if($remarks[$i]!=''){
                $attendances->remark = $remark;
            }

            else{
                $attendances->remark = 'NULL';
            }

            $attendances->student_id = $studentid;
            $attendances->user_id = Auth::user()->id;
            $attendances->batch_id = $batchid;
        
            $attendances->save();
            // echo ."<br>";
        }

        return redirect()->back();        

    }
}
