<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use DataTables;
use Illuminate\Support\Facades\App;

class CityCtrl extends Controller
{
    public function index()
    {
        $cities = City::latest()->limit(50)->get();

        return view('backend.city',compact('cities'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:cities,name,NULL,id,deleted_at,NULL|min:3',
            'stateid'  =>'required',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'မြို့အမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'မြို့အမည်မှာထပ်နေပါသည်။',
                'name.min' => 'မြို့အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'stateid.required' => 'ပြည်နယ်အမည် ရွေးချယ်ရန် လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '都市名フィールドは必須です。',
                'name.unique' => '都市名フィールドは一意です。',
                'name.min' => '都市名には少なくとも3文字を含める必要があります。',
                'stateid.required' => 'その都市の州を選択してください。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '城市名称字段是必需的。',
                'name.unique' => '城市名称字段是唯一的。',
                'name.min' => '城市名称应至少包含 3 个字符。',
                'stateid.required' => '请选择该城市的州。'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld für den Stadtnamen ist erforderlich.',
                'name.unique' => 'Das Ortsnamensfeld ist eindeutig.',
                'name.min' => 'Der Ortsname sollte mindestens 3 Zeichen enthalten.',
                'stateid.required' => 'Bitte wählen Sie das Bundesland für diese Stadt aus.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ du nom de la ville est obligatoire.",
                'name.unique' => "Le champ du nom de la ville est unique.",
                'name.min' => "Le nom de la ville doit contenir au moins 3 caractères.",
                'stateid.required' => "Veuillez sélectionner l'état pour cette ville."

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The city name field is required.',
                'name.unique' => 'The city name field is unique.',
                'name.min' => 'The city name should contain at least 3 characters.',
                'stateid.required' => 'Please select state for that city.'


            ];
        }

        $this->validate($request, $rules, $customMessages);

        City::create([
            'name'  => $request->name,
            'state_id'  => $request->stateid

        ]);        
   
        return response()->json(['success'=>'City <b> SAVED </b> successfully.']);
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
            'stateid'  =>'required',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'မြို့အမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'မြို့အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'stateid.required' => 'ပြည်နယ်အမည် ရွေးချယ်ရန် လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '都市名フィールドは必須です。',
                'name.min' => '都市名には少なくとも3文字を含める必要があります。',
                'stateid.required' => 'その都市の州を選択してください。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '城市名称字段是必需的。',
                'name.min' => '城市名称应至少包含 3 个字符。',
                'stateid.required' => '请选择该城市的州。'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld für den Stadtnamen ist erforderlich.',
                'name.min' => 'Der Ortsname sollte mindestens 3 Zeichen enthalten.',
                'stateid.required' => 'Bitte wählen Sie das Bundesland für diese Stadt aus.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ du nom de la ville est obligatoire.",
                'name.min' => "Le nom de la ville doit contenir au moins 3 caractères.",
                'stateid.required' => "Veuillez sélectionner l'état pour cette ville."

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The city name field is required.',
                'name.min' => 'The city name should contain at least 3 characters.',
                'stateid.required' => 'Please select state for that city.'


            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $stateid = $request->stateid;

        $data = array(
            'name'  =>  $name,
            'state_id'  =>  $stateid,

        );

        City::where('id',$id)->update($data);

        return response()->json(['success'=>'City <b> SAVED </b> successfully.']); 
    }

    public function destroy(City $city)
    {
        $city->delete();

        return response()->json(['success'=>'City <b> DELETED </b> successfully.']);

    }
}