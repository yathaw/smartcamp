<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Bank;
use App\Models\User;
use App\Models\School;

use DataTables;
use Illuminate\Support\Facades\App;
use Auth;
use Carbon\Carbon;

class PlanCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();
        if($role[0] == "Software Admin"){
            return view('backend.plan');
        }else{
            $plans = Plan::orderBy('amount')->get();
            
            $user = User::find($authuser_id);
            $schoolid = $user->school_id;

            $school = School::find($schoolid);

            $purchase_plans = $school->plans()->where([
                                    ['school_id', '=', $user->school_id],
                                    ['status', '=', '0']
                                ])->get()->toArray();

            $diff_in_days = 0; $created;
            foreach($purchase_plans as $key => $plan){
                $created_at = Carbon::parse($plan['pivot']['created_at']);
                $duration_str = $plan['duration'];
                $duration_arr = explode(" ",$duration_str);
                $duration = $duration_arr[0];

                $enddate = Carbon::parse($created_at)->addMonths($duration);
                $today = Carbon::now();

                $greaterorequal_todaydate = $enddate->gte($today);

                if($greaterorequal_todaydate){
                    $created = $created_at;
                    $diff_in_days += $enddate->diffInDays($today);
                }else{
                    $last_purchase_plan = last($purchase_plans);
                    $created = $last_purchase_plan['pivot']['created_at'];
                }

            }
            $startdate = Carbon::parse($created)->format('d M, Y');
            $enddate = Carbon::parse($created)->addDays($diff_in_days)->format('d M,Y');

            $enddatetime = Carbon::parse($created)->addDays($diff_in_days)->format('d M,Y h:i:s');


            return view('backend.pricingplan',compact('plans','startdate','enddate','enddatetime'));
        }

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

    public function changeForm($id){
        $banks = Bank::whereIn('id',[2,3,4,5])->get();

        $plan = Plan::find($id);
        return view('backend.pricingplan_change',compact('plan','banks'));
        
    }

    public function changePlan(Request $request,$id){
        $rules = [
            'credicard' => 'required',
            'number' => 'required',
            'number1' => 'required',
            'number2' => 'required',
            'number3' => 'required',
            'cardholdername' => 'required',
            'cardmonth' => 'required',
            'cardyear' => 'required',
            'ccv' => 'required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'credicard.required' => 'ဤဆော့ဖ်ဝဲလ်တွင် အသုံးပြုရန် နှစ်သက်သောနည်းလမ်းကို ရွေးချယ်ပါ။',
                'number.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'number1.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'number2.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'number3.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'cardholdername.required' => 'ကတ်ကိုင်ဆောင်သူအမည် အကွက် လိုအပ်သည်။',
                'cardmonth.required' => 'ကတ်သက်တမ်းကုန်ဆုံးသည့်လအကွက် လိုအပ်သည်။',
                'cardyear.required' => 'ကတ်သက်တမ်းကုန်ဆုံးသည့်နှစ်အကွက် လိုအပ်သည်။',
                'ccv.required' => 'ccv အကွက် လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'credicard.required' => 'このソフトウェアで使用する優先方法を選択してください。',
                'number.required' => 'カード番号フィールドは必須です。s',
                'number1.required' => 'カード番号フィールドは必須です。',
                'number2.required' => 'カード番号フィールドは必須です。',
                'number3.required' => 'カード番号フィールドは必須です。',
                'cardholdername.required' => 'カード所有者名フィールドは必須です。',
                'cardmonth.required' => 'カードの有効期限の月のフィールドは必須です。',
                'cardyear.required' => 'カードの有効期限フィールドは必須です。',
                'ccv.required' => 'ccvフィールドは必須です。'
            ];
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'credicard.required' => '请选择在此软件上使用的首选方法。s',
                'number.required' => '卡号字段是必需的。',
                'number1.required' => '卡号字段是必需的。',
                'number2.required' => '卡号字段是必需的。',
                'number3.required' => '卡号字段是必需的。',
                'cardholdername.required' => '持卡人姓名字段为必填项。',
                'cardmonth.required' => '卡到期月份字段为必填项。',
                'cardyear.required' => '卡到期年份字段为必填项。',
                'ccv.required' => 'ccv 字段是必需的。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'credicard.required' => 'Bitte wählen Sie die bevorzugte Methode für diese Software aus.',
                'number.required' => 'Das Feld Kartennummer ist erforderlich.',
                'number1.required' => 'Das Feld Kartennummer ist erforderlich.',
                'number2.required' => 'Das Feld Kartennummer ist erforderlich.',
                'number3.required' => 'Das Feld Kartennummer ist erforderlich.',
                'cardholdername.required' => 'Das Feld Name des Karteninhabers ist erforderlich.',
                'cardmonth.required' => 'Das Feld für den Ablaufmonat der Karte ist erforderlich.',
                'cardyear.required' => 'Das Feld für das Ablaufjahr der Karte ist erforderlich.',
                'ccv.required' => 'Das ccv-Feld ist erforderlich.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'credicard.required' => 'Veuillez sélectionner la méthode préférée à utiliser sur ce logiciel.',
                'number.required' => 'Le champ du numéro de carte est obligatoire.',
                'number1.required' => 'Le champ du numéro de carte est obligatoire.',
                'number2.required' => 'Le champ du numéro de carte est obligatoire.',
                'number3.required' => 'Le champ du numéro de carte est obligatoire.',
                'cardholdername.required' => 'Le champ du nom du titulaire de la carte est obligatoire.',
                'cardmonth.required' => "Le champ du mois d'expiration de la carte est obligatoire.",
                'cardyear.required' => "Le champ Année d'expiration de la carte est obligatoire.",
                'ccv.required' => 'Le champ ccv est obligatoire.'
            ];
        }
        else{
            $customMessages = [
                'credicard.required' => 'Please select preferred method to use on this software.',
                'number.required' => 'The card number field is required.',
                'number1.required' => 'The card number field is required.',
                'number2.required' => 'The card number field is required.',
                'number3.required' => 'The card number field is required.',
                'cardholdername.required' => 'The card holder name field is required.',
                'cardmonth.required' => 'The card expiration month field is required.',
                'cardyear.required' => 'The card expiration year field is required.',
                'ccv.required' => 'The ccv field is required.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $purchase_plans = $school->plans()->where([
                                ['school_id', '=', $user->school_id],
                                ['status', '=', '0']
                            ])->get()->toArray();

        $diff_in_days = 0; $created;
        foreach($purchase_plans as $key => $plan){
            $created_at = Carbon::parse($plan['pivot']['created_at']);
            $duration_str = $plan['duration'];
            $duration_arr = explode(" ",$duration_str);
            $duration = $duration_arr[0];

            $enddate = Carbon::parse($created_at)->addMonths($duration);
            $today = Carbon::now();

            $result = $enddate->lt($today);
            if($result){
                $plan->schools()->updateExistingPivot($plan, array('status' => 1), false);
            }
        }

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;
        $school = School::find($schoolid);

        $school->plans()->attach($id,['user_id' => $authuser_id]);

        return \Redirect::route('master.plan.index')->with('success','Plan has been created.');
    }

    public function getlistPlanhistory(Request $request){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);
        $schoolid = $user->school_id;

        $school = School::find($schoolid);

        $data = $school->plans()->where('school_id',$user->school_id)->orderby('pivot_created_at','DESC')->get();


        return  Datatables::of($data)
                    ->addColumn('plan', function(Plan $plan) {
                        $name = $plan->name.' ('.$plan->amount.')';
                        return $name;
                    })
                    ->addColumn('startdate', function(Plan $plan) {

                        $date = Carbon::create($plan->pivot->created_at)->format('d M,Y h:i:s');
                        return $date;
                    })
                    ->addColumn('enddate', function(Plan $plan) {
                        $startdate = $plan->pivot->created_at;

                        $duration_str = $plan->duration;
                        $duration_arr = (explode(" ",$duration_str));
                        $duration = $duration_arr[0];

                        $enddate = Carbon::create($startdate)->addMonths($duration);
                        $date = Carbon::create($enddate)->format('d M,Y h:i:s');


                        return $date;
                    })
                    ->rawColumns(['plan'],['startdate'], ['enddate'])
                    ->make(true);
    }
}
