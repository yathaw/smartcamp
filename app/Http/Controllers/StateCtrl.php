<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\Country;
use DataTables;
use Illuminate\Support\Facades\App;

class StateCtrl extends Controller
{
    public function index()
    {
        return view('backend.state');
    }

    public function getlistData(Request $request)
    {

        $data = State::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(State $state) {
                        return $state->name;
                    })
                    ->addColumn('country', function(State $state) {
                        return $state->country->name;
                    })
                    ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-countryid="'.$row->country_id.'">
                                    <i class="bi bi-gear-fill"></i> 
                                </button>';
                        $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-x-lg"></i> 
                                </button>';

                        $btn .='</div>';
                        
                        return $btn;
                    })
                    ->rawColumns(['name'],['country'], ['action'])
                    ->make(true);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:states,name,NULL,id,deleted_at,NULL|min:3',
            'countryid'  =>'required',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ပြည်နယ်အမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'ပြည်နယ်အမည်မှာထပ်နေပါသည်။',
                'name.min' => 'ပြည်နယ်အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'countryid.required' => 'နိုင်ငံအမည် ရွေးချယ်ရန် လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '状態名フィールドは必須です',
                'name.unique' => '状態名フィールドは一意です。',
                'name.min' => '州名には少なくとも3文字を含める必要があります。',
                'countryid.required' => 'その州の国を選択してください。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '州名字段为必填项',
                'name.unique' => '州名字段是唯一的。',
                'name.min' => '州名至少应包含 3 个字符。',
                'countryid.required' => '请为该州选择国家。'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld für den Bundesstaatsnamen ist erforderlich',
                'name.unique' => 'Das Feld für den Zustandsnamen ist eindeutig.',
                'name.min' => 'Der Zustandsname sollte mindestens 3 Zeichen enthalten.',
                'countryid.required' => 'Bitte wählen Sie das Land für diesen Staat aus.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ du nom de l'état est obligatoire",
                'name.unique' => "Le champ de nom d'état est unique.",
                'name.min' => "Le nom de l'état doit contenir au moins 3 caractères",
                'countryid.required' => 'Veuillez sélectionner un pays pour cet état.'

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The state name field is required.',
                'name.unique' => 'The state name field is unique.',
                'name.min' => 'The state name should contain at least 3 characters.',
                'countryid.required' => 'Please select country for that state.'


            ];
        }

        $this->validate($request, $rules, $customMessages);

        State::create([
            'name'  => $request->name,
            'country_id'  => $request->countryid

        ]);        
   
        return response()->json(['success'=>'State <b> SAVED </b> successfully.']);
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
            'countryid'  =>'required',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ပြည်နယ်အမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'ပြည်နယ်အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'countryid.required' => 'နိုင်ငံအမည် ရွေးချယ်ရန် လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '状態名フィールドは必須です',
                'name.min' => '州名には少なくとも3文字を含める必要があります。',
                'countryid.required' => 'その州の国を選択してください。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '州名字段为必填项',
                'name.min' => '州名至少应包含 3 个字符。',
                'countryid.required' => '请为该州选择国家。'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld für den Bundesstaatsnamen ist erforderlich',
                'name.min' => 'Der Zustandsname sollte mindestens 3 Zeichen enthalten.',
                'countryid.required' => 'Bitte wählen Sie das Land für diesen Staat aus.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ du nom de l'état est obligatoire",
                'name.min' => "Le nom de l'état doit contenir au moins 3 caractères",
                'countryid.required' => 'Veuillez sélectionner un pays pour cet état.'

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The state name field is required.',
                'name.min' => 'The state name should contain at least 3 characters.',
                'countryid.required' => 'Please select country for that state.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $countryid = $request->countryid;

        $data = array(
            'name'  =>  $name,
            'country_id'  =>  $countryid,

        );

        State::where('id',$id)->update($data);

        return response()->json(['success'=>'State <b> SAVED </b> successfully.']); 
    }

    public function destroy(State $state)
    {
        $state->delete();

        return response()->json(['success'=>'State <b> DELETED </b> successfully.']);

    }
}
