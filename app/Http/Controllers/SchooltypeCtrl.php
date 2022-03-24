<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schooltype;
use DataTables;
use Illuminate\Support\Facades\App;

class SchooltypeCtrl extends Controller
{
    public function index()
    {
        return view('backend.schooltype');
    }

    public function getlistData(Request $request)
    {

        $data = Schooltype::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Schooltype $schooltype) {
                        return $schooltype->name;
                    })
                    ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-gear-fill"></i> 
                                </button>';
                        $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-x-lg"></i> 
                                </button>';

                        $btn .='</div>';
                        
                        return $btn;
                    })
                    ->rawColumns(['name'],['action'])
                    ->make(true);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:schooltypes,name,NULL,id,deleted_at,NULL|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ကျောင်းအမျိုးအစား အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'ကျောင်းအမျိုးအစား အမည်မှာ ထပ်နေပါသည်။',
                'name.min' => 'ကျောင်းအမျိုးအစား အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '学校タイプ名フィールドは必須です。',
                'name.unique' => '学校タイプ名フィールドは一意です。',
                'name.min' => '学校タイプ名には、少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '学校类型名称字段是必需的。',
                'name.unique' => '学校类型名称字段是唯一的。',
                'name.min' => '学校类型名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Name der Schulart ist erforderlich.',
                'name.unique' => 'Das Namensfeld des Schultyps ist eindeutig.',
                'name.min' => 'Der Schultypname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ du nom du type d'école est obligatoire.",
                'name.unique' => "Le champ du nom du type d'école est unique.",
                'name.min' => "Le nom du type d'école doit contenir au moins 3 caractères."
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The schooltype name field is required.',
                'name.unique' => 'The schooltype name field is unique.',
                'name.min' => 'The schooltype name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        Schooltype::create([
            'name'  => $request->name

        ]);        
   
        return response()->json(['success'=>'Schooltype <b> SAVED </b> successfully.']);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'  =>'required|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ကျောင်းအမျိုးအစား အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'ကျောင်းအမျိုးအစား အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '学校タイプ名フィールドは必須です。',
                'name.min' => '学校タイプ名には、少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '学校类型名称字段是必需的。',
                'name.min' => '学校类型名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Name der Schulart ist erforderlich.',
                'name.min' => 'Der Schultypname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ du nom du type d'école est obligatoire.",
                'name.min' => "Le nom du type d'école doit contenir au moins 3 caractères."
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The schooltype name field is required.',
                'name.min' => 'The schooltype name should contain at least 3 characters.'
            ];
        }
        
        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $data = array(
            'name'  =>  $name
        );

        Schooltype::where('id',$id)->update($data);

        return response()->json(['success'=>'Schooltype <b> SAVED </b> successfully.']); 
    }

    public function destroy(Schooltype $Schooltype)
    {
        $Schooltype->delete();

        return response()->json(['success'=>'Schooltype <b> DELETED </b> successfully.']);

    }
}
