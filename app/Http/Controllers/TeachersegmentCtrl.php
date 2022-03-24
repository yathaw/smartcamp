<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Teachersegment;
use App\Models\User;
use App\Models\Curriculum;

use Auth;
use Illuminate\Support\Facades\App;

class TeachersegmentCtrl extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'batch'  =>'required',
            'subject'  =>'required',
            'teacher' => 'required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'batch.required' => 'ကျေးဇူးပြု၍ အနည်းဆုံး အတန်းတစ်ခုကို ရွေးပါ။',
                'subject.required' => 'ကျေးဇူးပြု၍ အနည်းဆုံး ဘာသာရပ်တစ်ခုကို ရွေးချယ်ပါ။',
                'teacher.required' => 'ကျေးဇူးပြု၍ ထိုဘာသာရပ်ကို သင်ကြားရန် အနည်းဆုံး ဆရာတစ်ဦးကို ရွေးချယ်ပါ။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'batch.required' => '少なくとも1つのバッチを選択してください。',
                'subject.required' => '少なくとも1つの主題を選択してください。',
                'teacher.required' => 'その科目を教えるために少なくとも1人の教師を選択してください。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'batch.required' => '请至少选择一批。',
                'subject.required' => '请至少选择一门学科。',
                'teacher.required' => '请选择至少一名教师教授该科目。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'batch.required' => 'Bitte wählen Sie mindestens eine Charge aus.',
                'subject.required' => 'Bitte wählen Sie mindestens ein Thema aus.',
                'teacher.required' => 'Bitte wählen Sie mindestens einen Lehrer aus, der dieses Fach unterrichtet.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'batch.required' => 'Veuillez sélectionner au moins un lot.',
                'subject.required' => 'Veuillez sélectionner au moins un sujet.',
                'teacher.required' => 'Veuillez sélectionner au moins un enseignant pour enseigner cette matière.'
            ];
        }
        else{
            $customMessages = [
                'batch.required' => 'Please select at least one batch.',
                'subject.required' => 'Please select at least one subject.',
                'teacher.required' => 'Please select at least one teacher to teach that subject.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $batchid = $request->batch;
        $subjectid = $request->subject;
        $userid = $request->teacher;
        $sectionid = $request->sectionid;

        $section = Section::find($sectionid);

        $curriculum = Curriculum::where('grade_id', $section->grade_id)
                        ->where('subject_id',$subjectid)
                        ->first();

        $user = User::find($userid);
        $staffid = $user->staff->id;

        $teachersegment = new Teachersegment;
        $teachersegment->section_id = $sectionid;
        $teachersegment->batch_id = $batchid;
        $teachersegment->curriculum_id = $curriculum->id;
        $teachersegment->school_id = $authuser->school_id;
        $teachersegment->user_id = $authuser_id;
        $teachersegment->staff_id = $staffid;
        $teachersegment->save();

        return response()->json(['success'=>'Teachersegment <b> SAVED </b> successfully.']);
    }

    public function destroy(Teachersegment $teachersegment)
    {
        $teachersegment->delete();
        return response()->json(['success'=>'Teachersegment <b> DELETED </b> successfully.']);
    }
}
