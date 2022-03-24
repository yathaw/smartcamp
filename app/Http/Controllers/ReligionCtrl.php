<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Religion;
use DataTables;
use Illuminate\Support\Facades\App;

class ReligionCtrl extends Controller
{
    public function index()
    {
        return view('backend.religion');
    }

    public function getlistData(Request $request)
    {

        $data = Religion::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Religion $religion) {
                        return $religion->name;
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
            'name'  =>'required|unique:religions,name,NULL,id,deleted_at,NULL|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ကိုးကွယ်သည့်ဘာသာ အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'ကိုးကွယ်သည့်ဘာသာ အမည်မှာ ထပ်နေပါသည်။',
                'name.min' => 'ကိုးကွယ်သည့်ဘာသာ အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '宗教名フィールドは必須です。',
                'name.unique' => '宗教名フィールドは一意です。',
                'name.min' => '宗教名には少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '宗教名称字段是必需的。',
                'name.unique' => '宗教名称字段是唯一的。',
                'name.min' => '宗教名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Religionsname ist erforderlich.',
                'name.unique' => 'Das Feld für den Religionsnamen ist eindeutig.',
                'name.min' => 'Der Religionsname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ Nom de la religion est obligatoire.',
                'name.unique' => 'Le champ du nom de la religion est unique.',
                'name.min' => 'Le nom de la religion doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The religion name field is required.',
                'name.unique' => 'The religion name field is unique.',
                'name.min' => 'The religion name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        Religion::create([
            'name'  => $request->name

        ]);        
   
        return response()->json(['success'=>'Religion <b> SAVED </b> successfully.']);
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
                'name.required' => 'ကိုးကွယ်သည့်ဘာသာ အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'ကိုးကွယ်သည့်ဘာသာ အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '宗教名フィールドは必須です。',
                'name.min' => '宗教名には少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '宗教名称字段是必需的。',
                'name.min' => '宗教名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Religionsname ist erforderlich.',
                'name.min' => 'Der Religionsname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ Nom de la religion est obligatoire.',
                'name.min' => 'Le nom de la religion doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The religion name field is required.',
                'name.min' => 'The religion name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $data = array(
            'name'  =>  $name
        );

        Religion::where('id',$id)->update($data);

        return response()->json(['success'=>'Religion <b> SAVED </b> successfully.']); 
    }

    public function destroy(Religion $religion)
    {
        $religion->delete();

        return response()->json(['success'=>'Religion <b> DELETED </b> successfully.']);

    }
}
