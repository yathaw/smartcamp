<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Period;
use App\Models\Recording;
use Auth;
use Illuminate\Support\Facades\App;
use Hashids\Hashids;

class RecordCtrl extends Controller
{
    public function index(Request $request){
       $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        if(in_array($role[0], ["Guardian", "Student"])){
            return view('backend.student.recordlist');

        }else{
            $schoolid = $authuser->school_id;
            $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();

            if (request('batch')) {
                $periodid = request('period');
                $sectionid = request('section');
                $batchid = request('batch');

                $recordings = Recording::where('batch_id',$batchid)->get();


                return view('backend.recording.list',compact('periods', 'periodid','sectionid','batchid', 'recordings')); 

            }else{
                return view('backend.recording.list',compact('periods')); 
            }
        }

        
        
        
    }

    public function create(){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;
        $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();
        
        return view('backend.recording.new',compact('periods'));
    }

    public function store(Request $request)
    {
        $rules = [
            'batch'  => 'required',
            'file' => 'required',
            'file.*' => 'mimes:mp4,mov,ogg,qt | max:20000',  
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'batch.required' => 'အဆင့်အကွက် လိုအပ်သည်။',
                'file.required' => 'ဖိုင်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'file.mimes' => 'ဖိုင်အမျိုးအစားသည် Video ဖြစ်ရပါမည်။',
                'file.max' => 'ဖိုင်သည် 2048 ကီလိုဘိုက်ထက် မကြီးနိုင်ပါ။',
                'successmsg' => 'အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ'

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'batch.required' => 'グレードフィールドは必須です。',
                'file.required' => 'ファイルフィールドを空白にすることはできません。',
                'file.mimes' => 'ファイルタイプはVideoである必要があります',
                'file.max' => 'ファイルは2048キロバイトを超えることはできません。',
                'successmsg' => 'データが保存されました！'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'batch.required' => '成绩字段是必需的。',
                'file.required' => '文件字段不能为空。',
                'file.mimes' => '文件类型必须为 Video',
                'file.max' => '该文件不得大于 2048 KB。',
                'successmsg' => '您的数据已保存！'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'batch.required' => 'Das Notenfeld ist erforderlich.',
                'file.required' => 'Das Dateifeld darf nicht leer sein.',
                'file.mimes' => 'Der Dateityp muss Video sein',
                'file.max' => 'Die Datei darf nicht größer als 2048 Kilobyte sein.',
                'successmsg' => 'Ihre Daten wurden gespeichert!'

            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'batch.required' => 'Le champ note est obligatoire.',
                'file.required' => 'Le champ du fichier ne peut pas être vide.',
                'file.mimes' => 'Le type de fichier doit être au format Video',
                'file.max' => 'Le fichier ne doit pas dépasser 2048 kilo-octets.',
                'successmsg' => 'Vos données ont été enregistrées!'
            ];
        }
        else{
            $customMessages = [
                'batch.required' => 'The batch field is required.',
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

        $batchid = $request->batch;


        if ($request->hasfile('file')) {

            $cv = $request->file('file');

            // File Upload
            $cvfileName = time().'.'.$cv->extension();
            $cv->move(public_path('storage/recording'), $cvfileName);

            $cvpath = 'storage/recording/'.$cvfileName;
        }

        $lesson = new Recording();
        $lesson->title = $request->title;
        $lesson->file = $cvpath;
        $lesson->batch_id = $batchid;
        $lesson->user_id = $authuser_id;
        $lesson->school_id = $authuser->school_id;
        $lesson->save();

        return redirect()->back()->with('successmsg', $customMessages['successmsg']);


    }

    public function edit($id){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;
        $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();

        $recording = Recording::find($id);
        
        return view('backend.recording.new',compact('periods','recording'));
    }

    public function show($id)
    {

        $recording = Recording::find($id);

        // dd($syllabi);
        return view('backend.recording.video',compact('recording'));

    }

    public function destroy($id)
    {
        $recording=Recording::find($id);

        if(\File::exists(public_path($recording->file))){
            \File::delete(public_path($recording->file));
        }

        $recording->delete();

        return response()->json(['success'=>'Recording <b> DELETED </b> successfully.']);
    }


}
