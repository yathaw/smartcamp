<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scheduletype;
use App\Models\User;

use Auth;
use DataTables;
use Illuminate\Support\Facades\App;

class ScheduletypeCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Scheduletype::where('school_id', '=', $user->school_id)->latest()->get();
        
        $count = count($data);   
        return view('backend.scheduletype',compact('count'));
    }

    public function getlistData(){

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = Scheduletype::where('school_id', '=', $user->school_id)->latest()->get();

        return  Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function(Scheduletype $scheduletype) {
                    $name = '<span class="badge px-3" style="background-color:'.$scheduletype->bgcolor.'; color:'.$scheduletype->txtcolor.'">'.$scheduletype->name.'</span>';
                    return $name;
                })
                ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-bgcolor="'.$row->bgcolor.'" data-txtcolor="'.$row->txtcolor.'">
                                    <i class="bi bi-gear-fill"></i> 
                                </button>';
                        $btn .= '<button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDelete.'" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                    <i class="bi bi-x-lg"></i> 
                                </button>';

                        $btn .='</div>';
                        
                        return $btn;
                    })
                ->rawColumns(['name','action'])
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
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'အချိန်ဇယား-အမျိုးအစား အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'အချိန်ဇယားအမျိုးအစားအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'スケジュールタイプ名フィールドは必須です。',
                'name.min' => 'スケジュールタイプ名には、少なくとも3文字が含まれている必要があります。',
                'name.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '计划类型名称字段是必需的。',
                'name.min' => '计划类型名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Namensfeld des Zeitplantyps ist erforderlich.',
                'name.min' => 'Der Zeitplantypname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ Nom du type d'horaire est obligatoire.",
                'name.min' => 'Le nom du type de planification doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The schedule-type name field is required.',
                'name.min' => 'The schedule-type name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',


            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $txtcolor = $request->txtcolor;
        $bgcolor = $request->bgcolor;


        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);
        
        // Data Insert
        $scheduletype = new Scheduletype;
        $scheduletype->name = $name;
        $scheduletype->txtcolor = $txtcolor;
        $scheduletype->bgcolor = $bgcolor;
        $scheduletype->user_id = $authuser_id;
        $scheduletype->school_id = $user->school_id;
        $scheduletype->save();      
        
        return response()->json(['success'=>'Schedule Type <b> SAVED </b> successfully.']);

                
    }

    
    public function show(Scheduletype $Scheduletype)
    {
        //
    }

    
    public function edit(Scheduletype $Scheduletype)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'  =>'required|min:3|max:255',
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'အချိန်ဇယား-အမျိုးအစား အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'အချိန်ဇယားအမျိုးအစားအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး ၂၅၅ လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'スケジュールタイプ名フィールドは必須です。',
                'name.min' => 'スケジュールタイプ名には、少なくとも3文字が含まれている必要があります。',
                'name.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '计划类型名称字段是必需的。',
                'name.min' => '计划类型名称应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Namensfeld des Zeitplantyps ist erforderlich.',
                'name.min' => 'Der Zeitplantypname sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => "Le champ Nom du type d'horaire est obligatoire.",
                'name.min' => 'Le nom du type de planification doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The schedule-type name field is required.',
                'name.min' => 'The schedule-type name should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $txtcolor = $request->txtcolor;
        $bgcolor = $request->bgcolor;


        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = array(
            'name'  =>  $name,
            'txtcolor'  =>  $txtcolor,
            'bgcolor'  =>  $bgcolor,
            'user_id' => $authuser_id
        );

        Scheduletype::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Schedule Type <b> SAVED </b> successfully.']);
    }

    public function destroy(Scheduletype $Scheduletype)
    {
        // dd($Scheduletype);
        $Scheduletype->delete();

        return response()->json(['success'=>'Schedule Type <b> DELETED </b> successfully.']);

    }
}
