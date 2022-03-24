<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blood;
use DataTables;
use Illuminate\Support\Facades\App;

class BloodCtrl extends Controller
{
    public function index()
    {
        return view('backend.blood');
    }

    public function getlistData(Request $request)
    {

        $data = Blood::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Blood $blood) {
                        return $blood->name;
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
            'name'  =>'required|unique:bloods,name,NULL,id,deleted_at,NULL',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'သွေး အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'သွေး အမည်မှာ ထပ်နေပါသည်။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '血液名フィールドは必須です。',
                'name.unique' => '血の名前のフィールドは一意です。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '血名字段是必填项。',
                'name.unique' => '血名字段是唯一的。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Blutname ist erforderlich.',
                'name.unique' => 'Das Blutnamensfeld ist eindeutig.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de sang est obligatoire.',
                'name.unique' => 'Le champ du nom du sang est unique.',
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The blood name field is required.',
                'name.unique' => 'The blood name field is unique.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        Blood::create([
            'name'  => $request->name

        ]);        
   
        return response()->json(['success'=>'Blood <b> SAVED </b> successfully.']);
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
            'name'  =>'required',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'သွေး အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '血液名フィールドは必須です。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '血名字段是必填项。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Blutname ist erforderlich.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de sang est obligatoire.',
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The blood name field is required.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $data = array(
            'name'  =>  $name
        );

        Blood::where('id',$id)->update($data);

        return response()->json(['success'=>'Blood <b> SAVED </b> successfully.']); 
    }

    public function destroy(Blood $Blood)
    {
        $Blood->delete();

        return response()->json(['success'=>'Blood <b> DELETED </b> successfully.']);

    }
}
