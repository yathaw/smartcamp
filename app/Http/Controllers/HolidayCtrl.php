<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use App\Models\User;

use Auth;
use DataTables;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;


class HolidayCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Holiday::where('school_id', '=', $user->school_id)->latest()->get();
        
        $count = count($data);   
        return view('backend.holiday',compact('count'));
    }

    public function getlistData(){

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Holiday::where('school_id', '=', $user->school_id)->latest()->get();

        return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function(Holiday $holiday) {
                    return $holiday->name;
                })
                ->addColumn('date', function(Holiday $holiday) {
                    $date = date('d M, Y',strtotime($holiday->date));
                    return $date;
                })
                ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-date="'.$row->date.'">
                                    <i class="bi bi-gear-fill"></i> 
                                </button>';
                        $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-x-lg"></i> 
                                </button>';

                        $btn .='</div>';
                        
                        return $btn;
                    })
                ->rawColumns(['name','date','action'])
                ->make(true);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request->merge([
            'date' =>  Carbon::parse($request->date)->format('Y-m-d')
        ]);

        $rules = [
            'name'  =>'required|min:3|max:255',
            'date' =>'required|date',
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'အားလပ်ရက် အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'အားလပ်ရက်အမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'startdate.required' => 'အားလပ်ရက်ရက်စွဲအကွက် လိုအပ်သည်။',
                'startdate.date' => 'အားလပ်ရက်ရက်စွဲအကွက်သည် ရက်စွဲဖြစ်ရပါမည်။',

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '休日名フィールドは必須です。',
                'name.min' => '休日の名前には、少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'startdate.required' => '休日の日付フィールドは必須です。',
                'startdate.date' => '休日の日付フィールドは日付である必要があります。',

            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '假日名称字段是必需的。',
                'name.min' => '假日名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'startdate.required' => '假日日期字段是必需的。',
                'startdate.date' => '假期日期字段必须是日期。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Feiertagsname ist erforderlich.',
                'name.min' => 'Der Feiertagsname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'startdate.required' => 'Das Feld Feiertagsdatum ist erforderlich.',
                'startdate.date' => 'Das Feiertagsdatumsfeld muss ein Datum sein.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ Nom du jour férié est obligatoire.",
                'name.min' => 'Le nom du jour férié doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'startdate.required' => 'Le champ de la date des vacances est obligatoire.',
                'startdate.date' => 'Le champ de date de vacances doit être une date.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The holiday name field is required.',
                'name.min' => 'The holiday name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'startdate.required' => 'The holiday date field is required.',
                'startdate.date' => 'The holiday date field must be a date.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $date = Carbon::parse($request->date)->toDateString();

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);
        
        // Data Insert
        $holiday = new Holiday;
        $holiday->name = $name;
        $holiday->date = $date;

        $holiday->user_id = $authuser_id;
        $holiday->school_id = $user->school_id;
        $holiday->save();      
        
        return response()->json(['success'=>'Holiday <b> SAVED </b> successfully.']);

                
    }

    
    public function show(Holiday $Holiday)
    {
        //
    }

    
    public function edit(Holiday $Holiday)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'date' =>  Carbon::parse($request->date)->format('Y-m-d')
        ]);

        $rules = [
            'name'  =>'required|min:3|max:255',
            'date' =>'required|date',
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'အားလပ်ရက် အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'အားလပ်ရက်အမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'startdate.required' => 'အားလပ်ရက်ရက်စွဲအကွက် လိုအပ်သည်။',
                'startdate.date' => 'အားလပ်ရက်ရက်စွဲအကွက်သည် ရက်စွဲဖြစ်ရပါမည်။',

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '休日名フィールドは必須です。',
                'name.min' => '休日の名前には、少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'startdate.required' => '休日の日付フィールドは必須です。',
                'startdate.date' => '休日の日付フィールドは日付である必要があります。',

            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '假日名称字段是必需的。',
                'name.min' => '假日名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'startdate.required' => '假日日期字段是必需的。',
                'startdate.date' => '假期日期字段必须是日期。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Feiertagsname ist erforderlich.',
                'name.min' => 'Der Feiertagsname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'startdate.required' => 'Das Feld Feiertagsdatum ist erforderlich.',
                'startdate.date' => 'Das Feiertagsdatumsfeld muss ein Datum sein.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ Nom du jour férié est obligatoire.",
                'name.min' => 'Le nom du jour férié doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'startdate.required' => 'Le champ de la date des vacances est obligatoire.',
                'startdate.date' => 'Le champ de date de vacances doit être une date.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The holiday name field is required.',
                'name.min' => 'The holiday name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'startdate.required' => 'The holiday date field is required.',
                'startdate.date' => 'The holiday date field must be a date.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $date = Carbon::parse($request->date)->toDateString();

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = array(
            'name'  =>  $name,
            'date'  =>  $date,
            'user_id' => $authuser_id
        );

        Holiday::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Holiday <b> SAVED </b> successfully.']);
    }

    public function destroy(Holiday $holiday)
    {
        // dd($Holiday);
        $holiday->delete();

        return response()->json(['success'=>'Holiday <b> DELETED </b> successfully.']);

    }
}
