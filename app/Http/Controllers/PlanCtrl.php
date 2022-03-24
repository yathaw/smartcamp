<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use DataTables;
use Illuminate\Support\Facades\App;

class PlanCtrl extends Controller
{
    public function index()
    {
        return view('backend.plan');
    }

    public function getlistData(Request $request)
    {

        $data = Plan::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Plan $plan) {
                        return $plan->name;
                    })
                    ->addColumn('amount', function(Plan $plan) {
                        return $plan->amount;
                    })
                    ->addColumn('duration', function(Plan $plan) {
                        return $plan->duration;
                    })
                    ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-amount="'.$row->amount.'" data-duration="'.$row->duration.'">
                                    <i class="bi bi-gear-fill"></i> 
                                </button>';
                        $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-x-lg"></i> 
                                </button>';

                        $btn .='</div>';
                        
                        return $btn;
                    })
                    ->rawColumns(['name'],['amount'], ['duration'], ['action'])
                    ->make(true);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|unique:plans,name,NULL,id,deleted_at,NULL|min:3',
            'amount'  =>'required|min:2',
            'duration'  =>'required|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'စျေးနှုန်းအစီအစဉ် အမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'စျေးနှုန်းအစီအစဉ် အမည်မှာထပ်နေပါသည်။',
                'name.min' => 'စျေးနှုန်းအစီအစဉ် အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'amount.required' => 'ပမာဏ ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'amount.min' => 'ပမာဏ အကွက်တွင် အနည်းဆုံးစာလုံး ၂ လုံး ပါဝင်ရပါမည်။',
                'duration.required' => 'ကြာချိန်ကန့်သတ်ချက် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'duration.min' => 'ကြာချိန်ကန့်သတ်ချက် တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'プラン名フィールドは必須です。',
                'name.unique' => 'プラン名フィールドは一意です。',
                'name.min' => 'プラン名には少なくとも3文字が含まれている必要があります。',
                'amount.required' => '金額フィールドは必須です。',
                'amount.min' => '金額フィールドには、少なくとも2文字を含める必要があります。',
                'duration.required' => '期間フィールドは必須です。',
                'duration.min' => '期間フィールドには、少なくとも2文字を含める必要があります。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '计划名称字段是必需的。',
                'name.unique' => '计划名称字段是唯一的。',
                'name.min' => '计划名称应至少包含 3 个字符。',
                'amount.required' => '金额字段是必需的。',
                'amount.min' => '金额字段应至少包含 2 个字符。',
                'duration.required' => '持续时间字段是必需的。',
                'duration.min' => '持续时间字段应至少包含 2 个字符。',

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Planname ist erforderlich.',
                'name.unique' => 'Das Feld Planname ist eindeutig.',
                'name.min' => 'Der Planname sollte mindestens 3 Zeichen enthalten.',
                'amount.required' => 'Das Betragsfeld ist erforderlich.',
                'amount.min' => 'Das Betragsfeld sollte mindestens 2 Zeichen enthalten.',
                'duration.required' => 'Das Feld für die Dauer ist erforderlich.',
                'duration.min' => 'Das Dauerfeld sollte mindestens 2 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ Nom du plan est obligatoire.',
                'name.unique' => 'Le champ Nom du plan est unique.',
                'name.min' => 'Le nom du plan doit contenir au moins 3 caractères.',
                'amount.required' => 'Le champ montant est obligatoire.',
                'amount.min' => 'Le champ du montant doit contenir au moins 2 caractères.',
                'duration.required' => 'Le champ durée est obligatoire.',
                'duration.min' => 'Le champ de durée doit contenir au moins 2 caractères.'

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The Plan name field is required.',
                'name.unique' => 'The Plan name field is unique.',
                'name.min' => 'The Plan name should contain at least 3 characters',
                'amount.required' => 'The amount field is required.',
                'amount.min' => 'The amount field should contain at least 2 characters.',
                'duration.required' => 'The duration field is required.',
                'duration.min' => 'The duration field should contain at least 2 characters.'


            ];
        }

        $this->validate($request, $rules, $customMessages);

        Plan::create([
            'name'  => $request->name,
            'amount'  => $request->amount,
            'duration'  => $request->duration,

        ]);        
   
        return response()->json(['success'=>'Plan <b> SAVED </b> successfully.']);
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
            'amount'  =>'required|min:2',
            'duration'  =>'required|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'စျေးနှုန်းအစီအစဉ် အမည်ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'စျေးနှုန်းအစီအစဉ် အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'amount.required' => 'ပမာဏ ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'amount.min' => 'ပမာဏ အကွက်တွင် အနည်းဆုံးစာလုံး ၂ လုံး ပါဝင်ရပါမည်။',
                'duration.required' => 'ကြာချိန်ကန့်သတ်ချက် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'duration.min' => 'ကြာချိန်ကန့်သတ်ချက် တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'プラン名フィールドは必須です。',
                'name.min' => 'プラン名には少なくとも3文字が含まれている必要があります。',
                'amount.required' => '金額フィールドは必須です。',
                'amount.min' => '金額フィールドには、少なくとも2文字を含める必要があります。',
                'duration.required' => '期間フィールドは必須です。',
                'duration.min' => '期間フィールドには、少なくとも2文字を含める必要があります。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '计划名称字段是必需的。',
                'name.min' => '计划名称应至少包含 3 个字符。',
                'amount.required' => '金额字段是必需的。',
                'amount.min' => '金额字段应至少包含 2 个字符。',
                'duration.required' => '持续时间字段是必需的。',
                'duration.min' => '持续时间字段应至少包含 2 个字符。',

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Planname ist erforderlich.',
                'name.min' => 'Der Planname sollte mindestens 3 Zeichen enthalten.',
                'amount.required' => 'Das Betragsfeld ist erforderlich.',
                'amount.min' => 'Das Betragsfeld sollte mindestens 2 Zeichen enthalten.',
                'duration.required' => 'Das Feld für die Dauer ist erforderlich.',
                'duration.min' => 'Das Dauerfeld sollte mindestens 2 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ Nom du plan est obligatoire.',
                'name.min' => 'Le nom du plan doit contenir au moins 3 caractères.',
                'amount.required' => 'Le champ montant est obligatoire.',
                'amount.min' => 'Le champ du montant doit contenir au moins 2 caractères.',
                'duration.required' => 'Le champ durée est obligatoire.',
                'duration.min' => 'Le champ de durée doit contenir au moins 2 caractères.'

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The Plan name field is required.',
                'name.min' => 'The Plan name should contain at least 3 characters',
                'amount.required' => 'The amount field is required.',
                'amount.min' => 'The amount field should contain at least 2 characters.',
                'duration.required' => 'The duration field is required.',
                'duration.min' => 'The duration field should contain at least 2 characters.'


            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $amount = $request->amount;
        $duration = $request->duration;

        $data = array(
            'name'  =>  $name,
            'amount'  =>  $amount,
            'duration'  =>  $duration,

        );

        Plan::where('id',$id)->update($data);

        return response()->json(['success'=>'Plan <b> SAVED </b> successfully.']); 
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return response()->json(['success'=>'Plan <b> DELETED </b> successfully.']);

    }
}
