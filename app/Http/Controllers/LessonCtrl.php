<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
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
use Hashids\Hashids;

class LessonCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

            $school = School::find($authuser->school_id);
            $gradeids = [];

            if($role[0] == "Guardian"){
                foreach($authuser->guardian->students as $key => $student){
                    foreach($student->studentsegments as $key => $studentsegment){
                        array_push($gradeids, $studentsegment->batch->section->grade->id);
                    }
                }
            }else if($role[0] == "Student"){
                foreach($authuser->student->studentsegments as $key => $studentsegment){
                    array_push($gradeids, $studentsegment->batch->section->grade->id);
                }
            }
            else{
                
                foreach ($school->grades as $grade) {
                    array_push($gradeids, $grade->id);
                }

                
            }
            $schoolid = $school->id;


            $grades = Grade::whereHas('curricula', function($q) use ($schoolid)
            {
                $q->whereHas('lesson', function($q1) use ($schoolid)
                {
                    $q1->where('school_id', '=', $schoolid);
                });
            })
            ->whereIn('id',$gradeids)
            ->get();

        $subjecttypeids = array();
        foreach ($grades as $grade) {
            foreach ($grade->curricula as $curriculum) {
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


        return view('backend.lesson.list',compact('grades','subjecttypes'));
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


        return view('backend.lesson.new', compact('grades','subjects','subjecttypes'));
        
    }

    public function store(Request $request)
    {
        $rules = [
            'grade'  => 'required',
            'subject'  => 'required',
            'coverphoto' => 'required',
            'coverphoto.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'required',
            'file.*' => 'mimes:mp4,mov,ogg,qt | max:20000',  
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'grade.required' => 'အဆင့်အကွက် လိုအပ်သည်။',
                'subjects.*' => 'ဘာသာရပ်အကွက် လိုအပ်သည်။',
                'coverphoto.required' => 'စာအုပ်မျက်နှာဖုံးဓာတ်ပုံအကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'coverphoto.image' => 'စာအုပ်အဖုံးဓာတ်ပုံအကွက်သည် ပုံတစ်ပုံဖြစ်ရပါမည်။',
                'coverphoto.mimes' => 'ဖိုင်အမျိုးအစားသည် JPEG, JPG, PNG, GIF, SVG ဖြစ်ရပါမည်။',
                'coverphoto.max' => 'ဓာတ်ပုံသည် 2048 ကီလိုဘိုက်ထက် မကြီးရပါ။',
                'file.required' => 'ဖိုင်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'file.mimes' => 'ဖိုင်အမျိုးအစားသည် Video ဖြစ်ရပါမည်။',
                'file.max' => 'ဖိုင်သည် 2048 ကီလိုဘိုက်ထက် မကြီးနိုင်ပါ။',
                'successmsg' => 'အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ'

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'grade.required' => 'グレードフィールドは必須です。',
                'subjects.*' => '件名フィールドは必須です。',
                'coverphoto.required' => '本の表紙の写真フィールドを空白にすることはできません。',
                'coverphoto.image' => '本の表紙の写真フィールドは画像である必要があります。',
                'coverphoto.mimes' => 'ファイルタイプは JPEG, JPG, PNG, GIF, SVG である必要があります',
                'coverphoto.max' => '写真は2048キロバイトを超えてはなりません。',
                'file.required' => 'ファイルフィールドを空白にすることはできません。',
                'file.mimes' => 'ファイルタイプはVideoである必要があります',
                'file.max' => 'ファイルは2048キロバイトを超えることはできません。',
                'successmsg' => 'データが保存されました！'

            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'grade.required' => '成绩字段是必需的。',
                'subjects.*' => '主题字段是必需的。',
                'coverphoto.required' => '书籍封面照片字段不能为空。',
                'coverphoto.image' => '书籍封面照片字段必须是图像。',
                'coverphoto.mimes' => '文件类型必须为 JPEG, JPG, PNG, GIF, SVG',
                'coverphoto.max' => '照片不得超过 2048 KB。',
                'file.required' => '文件字段不能为空。',
                'file.mimes' => '文件类型必须为 Video',
                'file.max' => '该文件不得大于 2048 KB。',
                'successmsg' => '您的数据已保存！'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'grade.required' => 'Das Notenfeld ist erforderlich.',
                'subjects.*' => 'Das Betrefffeld ist erforderlich.',
                'coverphoto.required' => 'Das Fotofeld für das Buchcover darf nicht leer sein.',
                'coverphoto.image' => 'Das Fotofeld für das Buchcover muss ein Bild sein.',
                'coverphoto.mimes' => 'Der Dateityp muss JPEG, JPG, PNG, GIF oder SVG sein',
                'coverphoto.max' => 'Das Foto darf nicht größer als 2048 Kilobyte sein.',
                'file.required' => 'Das Dateifeld darf nicht leer sein.',
                'file.mimes' => 'Der Dateityp muss Video sein',
                'file.max' => 'Die Datei darf nicht größer als 2048 Kilobyte sein.',
                'successmsg' => 'Ihre Daten wurden gespeichert!'

            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'grade.required' => 'Le champ note est obligatoire.',
                'subjects.*' => 'Le champ objet est obligatoire.',
                'coverphoto.required' => 'Le champ de la photo de couverture du livre ne peut pas être vide.',
                'coverphoto.image' => 'Le champ de la photo de couverture du livre doit être une image.',
                'coverphoto.mimes' => 'Le type de fichier doit être au format JPEG, JPG, PNG, GIF, SVG',
                'coverphoto.max' => 'La photo ne doit pas dépasser 2048 kilo-octets.',
                'file.required' => 'Le champ du fichier ne peut pas être vide.',
                'file.mimes' => 'Le type de fichier doit être au format Video',
                'file.max' => 'Le fichier ne doit pas dépasser 2048 kilo-octets.',
                'successmsg' => 'Vos données ont été enregistrées!'
            ];
        }
        else{
            $customMessages = [
                'grade.required' => 'The grade field is required.',
                'subjects.*' => 'The subject field is required.',
                'coverphoto.required' => 'The book cover photo field cannot be blank.',
                'coverphoto.image' => 'The book cover photo field must be an image.',
                'coverphoto.mimes' => 'File Type must be in JPEG, JPG, PNG, GIF, SVG',
                'coverphoto.max' => 'The photo may not be greater than 2048 kilobytes.',
                'file.required' => 'The file field cannot be blank.',
                'file.mimes' => 'File Type must be in Video',
                'file.max' => 'The file may not be greater than 2048 kilobytes.',
                'successmsg' => 'Your data was saved!'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $curriculumid = $request->subject;

        if ($request->hasfile('coverphoto')) {

            $cover = $request->file('coverphoto');

            // File Upload
            $coverimageName = time().'.'.$cover->extension();
            $cover->move(public_path('storage/lessoncover'), $coverimageName);

            $coverpath = 'storage/lessoncover/'.$coverimageName;
        }

        if ($request->hasfile('file')) {

            $cv = $request->file('file');

            // File Upload
            $cvfileName = time().'.'.$cv->extension();
            $cv->move(public_path('storage/lessonvideo'), $cvfileName);

            $cvpath = 'storage/lessonvideo/'.$cvfileName;
        }

        $lesson = new Lesson();
        $lesson->photo = $coverpath;
        $lesson->file = $cvpath;
        $lesson->curriculum_id = $curriculumid;
        $lesson->user_id = $authuser_id;
        $lesson->school_id = $authuser->school_id;
        $lesson->save();

        return redirect()->back()->with('successmsg', $customMessages['successmsg']);


    }

    public function show($id)
    {
        $hashids = new Hashids('', 10);
        $lessonid = $hashids->decode($id);

        $lesson = Lesson::find($lessonid[0]);

        // dd($syllabi);
        return view('backend.lesson.video',compact('lesson'));

    }

    public function edit($id)
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

        $hashids = new Hashids('', 10);
        $lessonid = $hashids->decode($id);

        $lesson = Lesson::find($lessonid[0]);

        return view('backend.lesson.edit', compact('grades','subjects','subjecttypes', 'lesson'));
    }

    public function update(Request $request, $id)
    {
        if (App::isLocale('mm')) {
            $customMessages = [
                'successmsg' => 'အချက်အလက်များကိုအောင်မြင်စွာ ပြင်ဆင် ပြီးပါပြီ'

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'successmsg' => 'データが更新されました！'

            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'successmsg' => '您的数据已更新！'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'successmsg' => 'Ihre Daten wurden aktualisiert!'

            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'successmsg' => 'Vos données ont été mises à jour !'
            ];
        }
        else{
            $customMessages = [
                'successmsg' => 'Your data was updated!'
            ];
        }


        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $lesson=Lesson::find($id);

        
        if ($request->hasfile('coverphoto')) {

            if(\File::exists(public_path($lesson->photo))){
                \File::delete(public_path($lesson->photo));
            }

            $cover = $request->file('coverphoto');

            // File Upload
            $coverimageName = time().'.'.$cover->extension();
            $cover->move(public_path('storage/lessoncover'), $coverimageName);

            $coverpath = 'storage/lessoncover/'.$coverimageName;
        }else{
            $coverpath = $request->oldphoto;
        }

        if ($request->hasfile('file')) {

            if(\File::exists(public_path($lesson->file))){
                \File::delete(public_path($lesson->file));
            }

            $cv = $request->file('file');

            // File Upload
            $cvfileName = time().'.'.$cv->extension();
            $cv->move(public_path('storage/lessonvideo'), $cvfileName);

            $cvpath = 'storage/lessonvideo/'.$cvfileName;
        }else{
            $cvpath = $request->oldfile;
        }

        $data = array(
            'photo'  =>  $coverpath,
            'file'  =>  $cvpath,
            'user_id'   =>  $authuser_id,
            'school_id'  =>  $authuser->school_id,

        );

        Lesson::where('id',$id)->update($data);

        return \Redirect::route('master.lesson.index')->with('successupdatemsg', $customMessages['successmsg']);

    }

    public function destroy($id)
    {
        $syllabi=Lesson::find($id);

        if(\File::exists(public_path($syllabi->photo))){
            \File::delete(public_path($syllabi->photo));
        }

        if(\File::exists(public_path($syllabi->file))){
            \File::delete(public_path($syllabi->file));
        }

        $syllabi->delete();

        return response()->json(['success'=>'Lesson <b> DELETED </b> successfully.']);
    }
}
