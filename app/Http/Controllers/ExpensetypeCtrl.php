<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expensetype;
use DataTables;
use Illuminate\Support\Facades\App;

class ExpensetypeCtrl extends Controller
{
    public function index()
    {
        return view('backend.expensetype');
    }

    public function getlistData(Request $request)
    {

        $data = Expensetype::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Expensetype $expensetype) {
                        return $expensetype->name;
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
            'name'  =>'required|unique:expensetypes,name,NULL,id,deleted_at,NULL|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ကုန်ကျစရိတ်အမျိုးအစား အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'ကုန်ကျစရိတ်အမျိုးအစား အမည်မှာ ထပ်နေပါသည်။',
                'name.min' => 'ကုန်ကျစရိတ်အမျိုးအစား အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '経費タイプ名フィールドは必須です。',
                'name.unique' => '経費タイプ名フィールドは一意です。',
                'name.min' => '経費タイプ名には、少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '费用类型名称字段是必需的。',
                'name.unique' => '费用类型名称字段是唯一的。',
                'name.min' => '费用类型名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Name der Ausgabenart ist erforderlich.',
                'name.unique' => 'Das Namensfeld der Spesenart ist eindeutig.',
                'name.min' => 'Der Spesentypname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom du type de dépense est obligatoire.',
                'name.unique' => 'Le champ du nom du type de dépense est unique.',
                'name.min' => 'Le nom du type de dépense doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The expense type name field is required.',
                'name.unique' => 'The expense type name field is unique.',
                'name.min' => 'The expense type name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        Expensetype::create([
            'name'  => $request->name

        ]);        
   
        return response()->json(['success'=>'Expensetype <b> SAVED </b> successfully.']);
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
                'name.required' => 'ကုန်ကျစရိတ်အမျိုးအစား အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'ကုန်ကျစရိတ်အမျိုးအစား အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '経費タイプ名フィールドは必須です。',
                'name.min' => '経費タイプ名には、少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '费用类型名称字段是必需的。',
                'name.min' => '费用类型名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Name der Ausgabenart ist erforderlich.',
                'name.min' => 'Der Spesentypname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom du type de dépense est obligatoire.',
                'name.min' => 'Le nom du type de dépense doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The expense type name field is required.',
                'name.min' => 'The expense type name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $data = array(
            'name'  =>  $name
        );

        Expensetype::where('id',$id)->update($data);

        return response()->json(['success'=>'Expensetype <b> SAVED </b> successfully.']); 
    }

    public function destroy(Expensetype $Expensetype)
    {
        $Expensetype->delete();

        return response()->json(['success'=>'Expensetype <b> DELETED </b> successfully.']);

    }
}