<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Support\Facades\App;

class SubjectCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Subject::where('school_id', '=', $user->school_id)->latest()->get();
        
        $count = count($data);   
        return view('backend.subject',compact('count'));
    }

    public function getlistData(){

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Subject::where('school_id', '=', $user->school_id)->latest()->get();

        return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function(Subject $subject) {
                    return $subject->name;
                })
                ->addColumn('othername', function(Subject $subject) {
                    return '<span class="mmfont">'.$subject->otherlanguage.'</span>';
                })
                ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-othername="'.$row->otherlanguage.'">
                                    <i class="bi bi-gear-fill"></i> 
                                </button>';
                        $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-x-lg"></i> 
                                </button>';

                        $btn .='</div>';
                        
                        return $btn;
                    })
                ->rawColumns(['name','action','othername'])
                ->make(true);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|min:3|max:255',
            'othername'  =>'required|min:3|max:255',


        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ဘာသာရပ်အမည်အကွက် လိုအပ်သည်။',
                'name.min' => 'ဘာသာရပ်အမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'othername.required' => 'ဘာသာရပ်၏ အခြားဘာသာစကားအမည်အကွက် လိုအပ်သည်။',
                'othername.min' => 'ဘာသာရပ်၏ အခြားဘာသာစကားအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'othername.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '件名フィールドは必須です。',
                'name.min' => '件名には少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'othername.required' => 'サブジェクトの他の言語名フィールドは必須です。',
                'othername.min' => '件名の他の言語名には、少なくとも3文字が含まれている必要があります。',
                'othername.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '主题名称字段是必需的。',
                'name.min' => '主题名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'othername.required' => '主题的其他语言名称字段是必需的。',
                'othername.min' => '主题的其他语言名称应至少包含 3 个字符。',
                'othername.max' => '已达到 255 个字符的最大长度。',

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Betreffname ist erforderlich.',
                'name.min' => 'Der Betreffname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'othername.required' => 'Das Feld für den anderen Sprachnamen des Fachgebiets ist erforderlich.',
                'othername.min' => 'Der Name des Faches in der anderen Sprache sollte mindestens 3 Zeichen enthalten.',
                'othername.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom du sujet est obligatoire.',
                'name.min' => 'Le nom du sujet doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'othername.required' => "Le champ du nom de l'autre langue du sujet est obligatoire.",
                'othername.min' => "Le nom de l'autre langue du sujet doit contenir au moins 3 caractères.",
                'othername.max' => 'La longueur maximale de 255 caractères est atteinte.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The subject name field is required.',
                'name.min' => 'The subject name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'othername.required' => 'The subject other language name field is required.',
                'othername.min' => 'The subject other language name should contain at least 3 characters.',
                'othername.max' => 'The max length of 255 characters is reached.',


            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $othername = $request->othername;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);
        
        // Data Insert
        $subject = new Subject;
        $subject->name = $name;
        $subject->otherlanguage = $othername;
        $subject->school_id = $user->school_id;
        $subject->save();      
        
        return response()->json(['success'=>'Subject <b> SAVED </b> successfully.']);

                
    }

    
    public function show(Subject $subject)
    {
        //
    }

    
    public function edit(Subject $subject)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'  =>'required|min:3|max:255',
            'othername'  =>'required|min:3|max:255',


        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ဘာသာရပ်အမည်အကွက် လိုအပ်သည်။',
                'name.min' => 'ဘာသာရပ်အမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'othername.required' => 'ဘာသာရပ်၏ အခြားဘာသာစကားအမည်အကွက် လိုအပ်သည်။',
                'othername.min' => 'ဘာသာရပ်၏ အခြားဘာသာစကားအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'othername.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '件名フィールドは必須です。',
                'name.min' => '件名には少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'othername.required' => 'サブジェクトの他の言語名フィールドは必須です。',
                'othername.min' => '件名の他の言語名には、少なくとも3文字が含まれている必要があります。',
                'othername.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '主题名称字段是必需的。',
                'name.min' => '主题名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'othername.required' => '主题的其他语言名称字段是必需的。',
                'othername.min' => '主题的其他语言名称应至少包含 3 个字符。',
                'othername.max' => '已达到 255 个字符的最大长度。',

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Betreffname ist erforderlich.',
                'name.min' => 'Der Betreffname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'othername.required' => 'Das Feld für den anderen Sprachnamen des Fachgebiets ist erforderlich.',
                'othername.min' => 'Der Name des Faches in der anderen Sprache sollte mindestens 3 Zeichen enthalten.',
                'othername.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom du sujet est obligatoire.',
                'name.min' => 'Le nom du sujet doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'othername.required' => "Le champ du nom de l'autre langue du sujet est obligatoire.",
                'othername.min' => "Le nom de l'autre langue du sujet doit contenir au moins 3 caractères.",
                'othername.max' => 'La longueur maximale de 255 caractères est atteinte.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The subject name field is required.',
                'name.min' => 'The subject name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'othername.required' => 'The subject other language name field is required.',
                'othername.min' => 'The subject other language name should contain at least 3 characters.',
                'othername.max' => 'The max length of 255 characters is reached.',


            ];
        }

        $this->validate($request, $rules, $customMessages);
        
        $name = $request->name;
        $othername = $request->othername;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = array(
            'name'  =>  $name,
            'otherlanguage'  =>  $othername,
            'school_id'  =>  $user->school_id,

        );

        Subject::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Subject <b> SAVED </b> successfully.']);
    }

    public function destroy(Subject $subject)
    {
        // dd($subject);
        $subject->delete();

        return response()->json(['success'=>'Subject <b> DELETED </b> successfully.']);

    }
}