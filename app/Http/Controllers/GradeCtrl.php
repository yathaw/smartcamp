<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\School;

use DataTables;
use Illuminate\Support\Facades\App;
use Auth;

class GradeCtrl extends Controller
{
    public function index()
    {
        return view('backend.grade');
    }

    public function getlistData(Request $request)
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        if ($role[0] == 'Software Admin') {
            $data = Grade::latest()->get();
        }else{
            $school = School::find($authuser->school_id);
            $gradeids = [];
            foreach ($school->grades as $grade) {
                array_push($gradeids, $grade->id);
            }

            $data = Grade::whereIn('id', $gradeids)->get();
        }



        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Grade $grade) {
                        return $grade->name;
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
            'name'  =>'required|unique:grades,name,NULL,id,deleted_at,NULL|min:3',

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'အတန်း အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'အတန်း အမည်မှာ ထပ်နေပါသည်။',
                'name.min' => 'အတန်း အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'グレード名フィールドは必須です。',
                'name.unique' => 'グレード名フィールドは一意です。',
                'name.min' => 'グレード名には少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '成绩名称字段是必需的。',
                'name.unique' => '成绩名称字段是唯一的。',
                'name.min' => '年级名称应至少包含 3 个字符'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Notenname ist erforderlich.',
                'name.unique' => 'Das Feld für den Notennamen ist eindeutig.',
                'name.min' => 'Der Notenname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de la note est obligatoire.',
                'name.unique' => 'Le champ du nom de la note est unique.',
                'name.min' => 'Le nom de la note doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The grade name field is required.',
                'name.unique' => 'The grade name field is unique.',
                'name.min' => 'The grade name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        Grade::create([
            'name'  => $request->name

        ]);        
   
        return response()->json(['success'=>'Grade <b> SAVED </b> successfully.']);
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
                'name.required' => 'အတန်း အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'အတန်း အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'グレード名フィールドは必須です。',
                'name.min' => 'グレード名には少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '成绩名称字段是必需的。',
                'name.min' => '年级名称应至少包含 3 个字符'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Notenname ist erforderlich.',
                'name.min' => 'Der Notenname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom de la note est obligatoire.',
                'name.min' => 'Le nom de la note doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The grade name field is required.',
                'name.min' => 'The grade name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $data = array(
            'name'  =>  $name
        );

        Grade::where('id',$id)->update($data);

        return response()->json(['success'=>'Grade <b> SAVED </b> successfully.']); 
    }

    public function destroy(Grade $Grade)
    {
        $Grade->delete();

        return response()->json(['success'=>'Grade <b> DELETED </b> successfully.']);

    }
}
