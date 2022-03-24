<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\App;

class RoleCtrl extends Controller
{
    public function index()
    {
        return view('backend.role');
    }

    public function getlistData(Request $request)
    {

        $data = Role::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Role $role) {
                        return $role->name;
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
            'name'  =>'required|unique:roles|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'အခန်းကဏ္ဍအမည်အကွက် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'အခန်းကဏ္ဍအမည်အကွက်သည် ထပ်နေပါသည်။',
                'name.min' => 'အခန်းကဏ္ဍအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'ロール名フィールドは必須です。',
                'name.unique' => 'ロール名フィールドは一意です。',
                'name.min' => 'ロール名には少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '角色名称字段是必需的。',
                'name.unique' => '角色名称字段是唯一的。',
                'name.min' => '角色名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Rollennamensfeld ist erforderlich.',
                'name.unique' => 'Das Rollennamensfeld ist eindeutig.',
                'name.min' => 'Der Rollenname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de rôle est obligatoire.',
                'name.unique' => 'Le champ du nom de rôle est unique.',
                'name.min' => 'Le nom du rôle doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The role name field is required.',
                'name.unique' => 'The role name field is unique.',
                'name.min' => 'The role name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        Role::create([
            'name'  => $request->name

        ]);        
   
        return response()->json(['success'=>'Role <b> SAVED </b> successfully.']);
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
                'name.required' => 'အခန်းကဏ္ဍအမည်အကွက် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'အခန်းကဏ္ဍအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'ロール名フィールドは必須です。',
                'name.min' => 'ロール名には少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '角色名称字段是必需的。',
                'name.min' => '角色名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Rollennamensfeld ist erforderlich.',
                'name.min' => 'Der Rollenname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de rôle est obligatoire.',
                'name.min' => 'Le nom du rôle doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The role name field is required.',
                'name.min' => 'The role name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $data = array(
            'name'  =>  $name
        );

        Role::where('id',$id)->update($data);

        return response()->json(['success'=>'Role <b> SAVED </b> successfully.']); 
    }

    public function destroy(Role $Role)
    {
        $Role->delete();

        return response()->json(['success'=>'Role <b> DELETED </b> successfully.']);

    }
}
