<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use DataTables;
use Illuminate\Support\Facades\App;

class CountryCtrl extends Controller
{
    public function index()
    {
        return view('backend.country');
    }

    public function getlistData(Request $request)
    {

        $data = Country::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Country $country) {
                        return $country->name;
                    })
                    ->addColumn('sortname', function(Country $country) {
                        return $country->sortname;
                    })
                    ->addColumn('phonecode', function(Country $country) {
                        return $country->phonecode;
                    })
                    ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-sortname="'.$row->sortname.'" data-phonecode="'.$row->phonecode.'">
                                    <i class="bi bi-gear-fill"></i> 
                                </button>';
                        $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-x-lg"></i> 
                                </button>';

                        $btn .='</div>';
                        
                        return $btn;
                    })
                    ->rawColumns(['name'],['sortname'], ['phonecode'], ['action'])
                    ->make(true);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:countries,name,NULL,id,deleted_at,NULL|min:3',
            'sortname'  =>'required|min:2|max:2',
            'phonecode'  =>'required|max:5',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'နိုင်ငံအမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'နိုင်ငံအမည်မှာထပ်နေပါသည်။',
                'name.min' => 'နိုင်ငံအမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'sortname.required' => 'နိုင်ငံအမည်အတိုကောက်အကွက် လိုအပ်သည်။',
                'sortname.min' => 'နိုင်ငံအမည်အတိုကောက်အကွက်တွင်အနည်းဆုံးစာလုံး ၂ လုံး ပါဝင်ရပါမည်။',
                'sortname.max' => 'အများဆုံး စာလုံး 5 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'phonecode.required' => 'ဖုန်းကုဒ်အကွက်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'phonecode.max' => 'အများဆုံး စာလုံး 2 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '国名が必要です。',
                'name.unique' => '国名が重複しています。',
                'name.min' => '国名には少なくとも3文字を含める必要があります',
                'sortname.required' => 'ソート名フィールドは必須です。',
                'sortname.min' => 'ソート名フィールドには、少なくとも2文字を含める必要があります。',
                'sortname.max' => '最大長5文字に達しました。',
                'phonecode.required' => '電話コードフィールドは必須です。',
                'phonecode.max' => '最大長2文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '国家名称是必需的。',
                'name.unique' => '国家名称重复。',
                'name.min' => '国家名称至少应包含 3 个字符',
                'sortname.required' => '排序名称字段是必需的。',
                'sortname.min' => '排序名称字段应至少包含 2 个字符。',
                'sortname.max' => '已达到 5 个字符的最大长度。',
                'phonecode.required' => '电话代码字段是必需的。',
                'phonecode.max' => '已达到 2 个字符的最大长度。',

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Ländername ist erforderlich.',
                'name.unique' => 'Der Ländername ist doppelt vorhanden.',
                'name.min' => 'Der Ländername sollte mindestens 3 Zeichen enthalten',
                'sortname.required' => 'Das Feld Sortiername ist erforderlich.',
                'sortname.min' => 'Das Feld Sortiername sollte mindestens 2 Zeichen enthalten.',
                'sortname.max' => 'Die maximale Länge von 5 Zeichen ist erreicht.',
                'phonecode.required' => 'Das Telefoncode-Feld ist erforderlich.',
                'phonecode.max' => 'Die maximale Länge von 2 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le nom du pays est requis.',
                'name.unique' => 'Le nom du pays est en double.',
                'name.min' => 'Le nom du pays doit contenir au moins 3 caractères',
                'sortname.required' => 'Le champ du nom du tri est obligatoire.',
                'sortname.min' => 'Le champ du nom du tri doit contenir au moins 2 caractères.',
                'sortname.max' => 'La longueur maximale de 5 caractères est atteinte.',
                'phonecode.required' => 'Le champ phonecode est obligatoire.',
                'phonecode.max' => 'La longueur maximale de 2 caractères est atteinte.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The country name field is required.',
                'name.unique' => 'The country name field is unique.',
                'name.min' => 'The country name should contain at least 3 characters',
                'sortname.required' => 'The sortname field is required.',
                'sortname.min' => 'The sortname field should contain at least 2 characters.',
                'sortname.max' => 'The max length of 5 characters is reached.',
                'phonecode.required' => 'The phonecode field is required.',
                'phonecode.max' => 'The max length of 2 characters is reached.',


            ];
        }

        $this->validate($request, $rules, $customMessages);

        Country::create([
            'name'  => $request->name,
            'sortname'  => $request->sortname,
            'phonecode'  => $request->phonecode,

        ]);        
   
        return response()->json(['success'=>'Country <b> SAVED </b> successfully.']);
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
            'sortname'  =>'required|min:2|max:2',
            'phonecode'  =>'required|max:5'

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'နိုင်ငံအမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'နိုင်ငံအမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'sortname.required' => 'နိုင်ငံအမည်အတိုကောက်အကွက် လိုအပ်သည်။',
                'sortname.max' => 'အများဆုံး စာလုံး 5 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'phonecode.required' => 'ဖုန်းကုဒ်အကွက်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'phonecode.max' => 'အများဆုံး စာလုံး 2 လုံး၏ အရှည်ကို ရောက်ပါပြီ။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '国名が必要です。',
                'name.min' => '国名には少なくとも3文字を含める必要があります',
                'sortname.required' => 'ソート名フィールドは必須です。',
                'sortname.max' => '最大長5文字に達しました。',
                'phonecode.required' => '電話コードフィールドは必須です。',
                'phonecode.max' => '最大長2文字に達しました。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '国家名称是必需的。',
                'name.min' => '国家名称至少应包含 3 个字符',
                'sortname.required' => '排序名称字段是必需的。',
                'sortname.max' => '已达到 5 个字符的最大长度。',
                'phonecode.required' => '电话代码字段是必需的。',
                'phonecode.max' => '已达到 2 个字符的最大长度。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Ländername ist erforderlich.',
                'name.min' => 'Der Ländername sollte mindestens 3 Zeichen enthalten',
                'sortname.required' => 'Das Feld Sortiername ist erforderlich.',
                'sortname.max' => 'Die maximale Länge von 5 Zeichen ist erreicht.',
                'phonecode.required' => 'Das Telefoncode-Feld ist erforderlich.',
                'phonecode.max' => 'Die maximale Länge von 2 Zeichen ist erreicht.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le nom du pays est requis.',
                'name.min' => 'Le nom du pays doit contenir au moins 3 caractères',
                'sortname.required' => 'Le champ du nom du tri est obligatoire.',
                'sortname.max' => 'La longueur maximale de 5 caractères est atteinte.',
                'phonecode.required' => 'Le champ phonecode est obligatoire.',
                'phonecode.max' => 'La longueur maximale de 2 caractères est atteinte.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The country name field is required.',
                'name.min' => 'The country name should contain at least 3 characters',
                'sortname.required' => 'The sortname field is required.',
                'sortname.max' => 'The max length of 5 characters is reached.',
                'phonecode.required' => 'The phonecode field is required.',
                'phonecode.max' => 'The max length of 2 characters is reached.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $sortname = $request->sortname;
        $phonecode = $request->phonecode;

        $data = array(
            'name'  =>  $name,
            'sortname'  =>  $sortname,
            'phonecode'  =>  $phonecode,

        );

        Country::where('id',$id)->update($data);

        return response()->json(['success'=>'Country <b> SAVED </b> successfully.']); 
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json(['success'=>'Country <b> DELETED </b> successfully.']);

    }
}
