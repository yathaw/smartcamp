<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Position;
use App\Models\Curriculum;
use App\Models\Section;
use App\Models\Package;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\Teachersegment;
use App\Models\Schedule;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Payment;


class FetchCtrl extends Controller
{
    public function getCountries(){

        $countries = Country::orderBy('name')->get();
        return $countries;
    }

    public function getStates(){

        $states = State::orderBy('name')->get();
        return $states;
    }

    public function getCities(Request $request){

        $searchkeyword = $request->searchTerm;

        $cities = City::where('name','like','%'.$searchkeyword.'%')->get();
        return $cities;

    }

    public function getPositions_bydepartmentid(Request $request){
        $departmentid = $request->departmentid;

        $unorderpositions = Position::where('department_id', $departmentid)->get();

        $positions = $unorderpositions->sortBy('sorting')->values();

        return $positions;

    }

    public function getCurricula_bygradeid(Request $request){
        $gradeid = $request->gradeid;
        if($request->type){
            $type = $request->type;
            $subjecttypeid = $request->subjecttypeid;
            if ($subjecttypeid == 'NULL') {
                $curricula = Curriculum::with('subject')
                                    ->where('grade_id', $gradeid)
                                    ->where('type',$type)
                                    ->get()
                                    ->sortBy('subject.sorting');
                
            }else{
                $curricula = Curriculum::with('subject')
                                    ->where('grade_id', $gradeid)
                                    ->where('type',$type)
                                    ->where('subjecttype_id',$subjecttypeid)
                                    ->get()
                                    ->sortBy('subject.sorting');

            }

        }else{
            $curricula = Curriculum::with('subject','subjecttype')
                        ->where('grade_id', '=', $gradeid)
                        ->get()
                        ->sortBy('subject.sorting');

        }

        return $curricula;
    }

    public function getTotalinstallment_bysectionid(Request $request){
        $sectionid = $request->sectionid;
        $section = Section::with('currency')->where('id',$sectionid)->first();

        return $section;
    }

    public function getPackageinstallments_bysectionid(Request $request){
        $sectionid = $request->sectionid;

        $packages = Package::with(['section' => function($q){
                                    $q->with('currency');
                    }],'user')
                    ->where('section_id',$sectionid)->get();

        return $packages;
    }

    public function getBatches_bysectionid(Request $request){

        $sectionid = $request->sectionid;

        $batches = Batch::with('user')->where('section_id',$sectionid)->get();

        return $batches;
    }

    public function getTeachersegments_bysectionid(Request $request){
        $sectionid = $request->sectionid;

        $data = Batch::with(['teachersegment'=>function($q){
                $q->with(['user','staff'=>function($q1){
                    $q1->with('user')->get();
                },'curriculum'=>function($q2){
                        $q2->with('subject','subjecttype')->get();
                    }
                ])->get();
            }])
            ->whereHas('teachersegment',function($q) use($sectionid){
                $q->where('section_id',$sectionid);
            })
            ->get();


        return $data;

    }

    public function getUser_bysubjectid(Request $request){
        
        $subjectid = $request->id;
        $subject = Subject::find($subjectid);

        $users = $subject->users()->get();


        return $users;
    }



    public function getSection_byperiodid(Request $request)
    {
        $periodid = $request->id;
        $section = Section::with(['grade'])
                    ->where('period_id',$periodid)->latest()->get();

        return $section;

    }

    public function getSection(Request $request){
        $sectionid = $request->id;
        $section = Section::with(['period'])
                    ->find($sectionid);

        return $section;

    }

    public function getSubjects_bybatchid(Request $request){
        $batchid = $request->id;

        $teachersegment_curriculumids = Teachersegment::where('batch_id', $batchid)->pluck('curriculum_id')->toArray();

        $subjects = Curriculum::with(['subject'])
                    ->whereIn('id', $teachersegment_curriculumids)->get();

        return $subjects;
    }

    public function getTeachersegments_bybatchid(Request $request){
        $batchid = $request->batch_id;

        $batch = Batch::find($batchid);

        $sectionid = $batch->section_id;

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

        

        $teachersegments1 = Teachersegment::with(['user','staff'=>function($q1){
                                            $q1->with('user')->get();
                                        },'curriculum'=>function($q2){
                                            $q2->with('subject','subjecttype')->get();
                                        }])
                                        ->where('batch_id', $batchid)
                                        ->get();

        return $teachersegments;
    }

    public function getSchedules_byperiodid(Request $request){
        $periodid = $request->period_id;

        $schedules = Schedule::with([
                        'batch' => function($q1) use ($periodid){
                                $q1->with(['section'=> function($q2) use($periodid){
                                    $q2->where('period_id',$periodid);
                                    $q2->get();
                                }]);
                                $q1->get();
                            },
                        'teachersegment' => function($q1){
                                $q1->with(['curriculum'=> function($q2){
                                    $q2->with('subject','subjecttype');
                                }]);
                                $q1->get();
                            },
                        'scheduletype'
                    ])->get();
        return $schedules;
    }

    public function getCurricula_bysectionid(Request $request){
        $sectionid = $request->sectionid;
        $section = Section::find($sectionid);

        $gradeid = $section->grade_id;

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

        $data = [$grade, $curricula, $subjecttypes];

        return $data;

    }

    public function getPackage_bysectionid(Request $request){
        $sectionid = $request->id;

        $packages = Package::where('section_id',$sectionid)->get();

        return $packages;
    }

    public function getAmount_bypackageid(Request $request){
        $packageid = $request->id;

        $package = Package::find($packageid);

        return $package;
    }

    public function getStudentsegments_bybatchid(Request $request){
        $batchid = $request->id;

        $students = Student::with('studentsegments','user')->whereHas('studentsegments', function ($query) use ($batchid) {
                    $query->where('studentsegments.batch_id', $batchid);
                })->get();

        return $students;
    }

    public function getPackage_bystudentid(Request $request){
        $studentid = $request->id;
        $sectionid = $request->sectionid;

        $packages = Package::where('section_id',$sectionid)->get();


        $studentpayment = Payment::where('student_id','=',$studentid)
                        ->where('section_id','=',$sectionid)
                        ->pluck('package_id');

        $data = [$packages, $studentpayment];

        return $data;

    }

    public function getPayment_bystudentid(Request $request){
        $studentid = $request->id;
        $packageid = $request->packageid;
        $sectionid = $request->sectionid;


        $data = Payment::with('package')
                        ->where('student_id','=',$studentid)
                        ->where('section_id','=',$sectionid)
                        ->where('package_id','=',$packageid)
                        ->first();


        return $data;

    }

    
}
