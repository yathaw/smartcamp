<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\User;

use Illuminate\Http\Request;
use Auth;
use DataTables;
use Illuminate\Support\Facades\App;

class PeriodCtrl extends Controller
{
    public function index()
    {
        return view('backend.period');
    }

    public function getlistData(){

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Period::where('school_id', '=', $user->school_id)->latest()->get();

        return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function(Period $period) {
                    return $period->name;
                })
                ->addColumn('year', function(Period $period) {
                    return '<span>'.$period->startyear.' - </span>'.'<span>'.$period->endyear.'</span>';
                })
                ->addColumn('action', function($row){

                    $toggleEdit =  __('Edit');
                    $toggleDelete=__('Remove');
                    
                    $btn = '<div class="">';
                    

                    $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-startyear="'.$row->startyear.'" data-endyear="'.$row->endyear.'">
                                <i class="bi bi-gear-fill"></i> 
                            </button>';
                    $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                <i class="bi bi-x-lg"></i> 
                            </button>';

                    $btn .='</div>';
                    
                    return $btn;
                })

                
                ->rawColumns(['name','action','year'])
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
            'startyear' =>'required',
            'endyear' =>'required|date_format:Y|after_or_equal:startyear'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ပညာသင်ကာလအမည် အကွက် လိုအပ်ပါသည်။',
                'name.min' => 'ပညာသင်ကာလအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'startyear.required' => 'စတင်သည့်နှစ်၏ အတန်း အကွက် လိုအပ်ပါသည်။',
                'endyear.required' => 'နှစ်ဆုံးနှစ်၏ အတန်း အကွက် လိုအပ်ပါသည်။',
                'endyear.after_or_equal' => 'အဆုံးနှစ်၏အတန်းသည် စတင်နှစ်၏အတန်းပြီးနောက် ဖြစ်ရမည်။'

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '学期名欄は必須です。',
                'name.min' => '学期名には少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'startyear.required' => '開始年フィールドのクラスは必須です。',
                'endyear.required' => '終了年フィールドのクラスは必須です。',
                'endyear.afafter_or_equalter' => '終了年のクラスは、開始年のクラスの後になければなりません。'

            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '学年名称字段是必需的。',
                'name.min' => '学年名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'startyear.required' => '开始年份字段的类是必需的。',
                'endyear.required' => '年终类别字段是必填项。',
                'endyear.after_or_equal' => '结束学年的班级必须在开始学年的班级之后。'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Name des akademischen Zeitraums ist erforderlich.',
                'name.min' => 'Der akademische Periodenname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'startyear.required' => 'Das Feld Klasse des Startjahres ist erforderlich.',
                'endyear.required' => 'Das Feld „Klasse des Jahresendes“ ist erforderlich.',
                'endyear.after_or_equal' => 'Die Klasse des Endjahres muss nach der Klasse des Startjahres liegen.'

            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de la période universitaire est obligatoire.',
                'name.min' => 'Le nom de la période académique doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'startyear.required' => "Le champ Classe d'année de début est obligatoire.",
                'endyear.required' => "Le champ Classe de fin d'année est obligatoire.",
                'endyear.after_or_equal' => "La classe de l'année de fin doit être postérieure à la classe de l'année de début."

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The academic period name field is required.',
                'name.min' => 'The academic period name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'startyear.required' => 'Class of start year field is required.',
                'endyear.required' => 'Class of end year field is required.',
                'endyear.after_or_equal' => 'Class of end year must be after class of start year.'

            ];
        }
        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $startyear = $request->startyear;
        $endyear = $request->endyear;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);
        
        // Data Insert
        $period = new Period;
        $period->name = $name;
        $period->startyear = $startyear;
        $period->endyear = $endyear;
        $period->school_id = $user->school_id;
        $period->save();      
        
        return response()->json(['success'=>'Period <b> SAVED </b> successfully.']);
    }

    public function show(Period $period)
    {
        //
    }

    public function edit(Period $period)
    {
        //
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'name'  =>'required|min:3|max:255',
            'startyear' =>'required',
            'endyear' =>'required|date_format:Y|after_or_equal:startyear'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ပညာသင်ကာလအမည် အကွက် လိုအပ်ပါသည်။',
                'name.min' => 'ပညာသင်ကာလအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'startyear.required' => 'စတင်သည့်နှစ်၏ အတန်း အကွက် လိုအပ်ပါသည်။',
                'endyear.required' => 'နှစ်ဆုံးနှစ်၏ အတန်း အကွက် လိုအပ်ပါသည်။',
                'endyear.after_or_equal' => 'အဆုံးနှစ်၏အတန်းသည် စတင်နှစ်၏အတန်းပြီးနောက် ဖြစ်ရမည်။'

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '学期名欄は必須です。',
                'name.min' => '学期名には少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'startyear.required' => '開始年フィールドのクラスは必須です。',
                'endyear.required' => '終了年フィールドのクラスは必須です。',
                'endyear.afafter_or_equalter' => '終了年のクラスは、開始年のクラスの後になければなりません。'

            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '学年名称字段是必需的。',
                'name.min' => '学年名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'startyear.required' => '开始年份字段的类是必需的。',
                'endyear.required' => '年终类别字段是必填项。',
                'endyear.after_or_equal' => '结束学年的班级必须在开始学年的班级之后。'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Name des akademischen Zeitraums ist erforderlich.',
                'name.min' => 'Der akademische Periodenname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'startyear.required' => 'Das Feld Klasse des Startjahres ist erforderlich.',
                'endyear.required' => 'Das Feld „Klasse des Jahresendes“ ist erforderlich.',
                'endyear.after_or_equal' => 'Die Klasse des Endjahres muss nach der Klasse des Startjahres liegen.'

            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de la période universitaire est obligatoire.',
                'name.min' => 'Le nom de la période académique doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'startyear.required' => "Le champ Classe d'année de début est obligatoire.",
                'endyear.required' => "Le champ Classe de fin d'année est obligatoire.",
                'endyear.after_or_equal' => "La classe de l'année de fin doit être postérieure à la classe de l'année de début."

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The academic period name field is required.',
                'name.min' => 'The academic period name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'startyear.required' => 'Class of start year field is required.',
                'endyear.required' => 'Class of end year field is required.',
                'endyear.after_or_equal' => 'Class of end year must be after class of start year.'

            ];
        }
        $this->validate($request, $rules, $customMessages);
        
        $name = $request->name;
        $startyear = $request->startyear;
        $endyear = $request->endyear;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = array(
            'name'  =>  $name,
            'startyear'  =>  $startyear,
            'endyear'   =>  $endyear,
            'school_id'  =>  $user->school_id,
        );

        Period::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Period <b> SAVED </b> successfully.']);
    }

    public function destroy(Period $period)
    {
        //
        $period->delete();

        return response()->json(['success'=>'Period <b> DELETED </b> successfully.']);
    }
}