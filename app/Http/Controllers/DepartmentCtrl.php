<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\App;

class DepartmentCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;

        $unorderdepartments = Department::where('school_id', $schoolid)->get();

        $departments = $unorderdepartments->sortBy('sorting')->values();


        return view('backend.department', compact('departments'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|min:3|max:255',
            'positions'  =>'required|min:2|max:255'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ဌာနအမည် ကွက်လပ် လိုအပ်ပါသည်။',
                'name.min' => 'ဌာနအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'positions.required' => 'ရာထူးအကွက် လိုအပ်သည်။',
                'positions.min' => 'ရာထူးအကွက်တွင် အနည်းဆုံး စာလုံး 2 လုံး ပါဝင်သင့်သည်။',
                'positions.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '部門名フィールドは必須です。',
                'name.min' => '部門名には少なくとも3文字を含める必要があります',
                'name.max' => '最大長255文字に達しました。',
                'positions.required' => '位置フィールドは必須です。',
                'positions.min' => '位置フィールドには、少なくとも2文字を含める必要があります。',
                'positions.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '部门名称字段是必需的。',
                'name.min' => '部门名称至少应包含 3 个字符',
                'name.max' => '已达到 255 个字符的最大长度。',
                'positions.required' => '职位字段是必需的。',
                'positions.min' => '位置字段应至少包含 2 个字符。',
                'positions.max' => '已达到 255 个字符的最大长度。',

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Abteilungsname ist erforderlich.',
                'name.min' => 'Der Abteilungsname sollte mindestens 3 Zeichen enthalten',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'positions.required' => 'Das Positionsfeld ist erforderlich.',
                'positions.min' => 'Das Positionsfeld sollte mindestens 2 Zeichen enthalten.',
                'positions.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom du département est obligatoire.',
                'name.min' => 'Le nom du département doit contenir au moins 3 caractères',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'positions.required' => 'Le champ poste est obligatoire.',
                'positions.min' => 'Le champ de position doit contenir au moins 2 caractères.',
                'positions.max' => 'La longueur maximale de 255 caractères est atteinte.',

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The department name field is required.',
                'name.min' => 'The department name should contain at least 3 characters',
                'name.max' => 'The max length of 255 characters is reached.',
                'positions.required' => 'The position field is required.',
                'positions.min' => 'The position field should contain at least 2 characters.',
                'positions.max' => 'The max length of 255 characters is reached.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $positions = $request->positions;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $hasdepartments = Department::where('school_id', $user->school_id)->get();

        if($hasdepartments->isEmpty()){
            $sorting_data = 1;
        }else{
            foreach($hasdepartments as $hasdepartment){
                $sorting = $hasdepartment->sorting;
                $sorting_data = ++$sorting;
            }
        }
        
        // Data Insert
        $department = new Department;
        $department->name = $name;
        $department->school_id = $user->school_id;
        $department->sorting = $sorting_data;
        $department->save();

        $sorting = 1;
        foreach ($positions as $value) {
            $position = new Position;
            $position->name = $value;
            $position->department_id = $department->id;
            $position->school_id = $user->school_id;
            $position->sorting = $sorting++;
            $position->save();
        }      
            
        return response()->json(['success'=>'Department <b> SAVED </b> successfully.']);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'  =>'required|min:3',
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ဌာနအမည် ကွက်လပ် လိုအပ်ပါသည်။',
                'name.min' => 'ဌာနအမည်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '部門名フィールドは必須です。',
                'name.min' => '部門名には少なくとも3文字を含める必要があります',
                'name.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '部门名称字段是必需的。',
                'name.min' => '部门名称至少应包含 3 个字符',
                'name.max' => '已达到 255 个字符的最大长度。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Abteilungsname ist erforderlich.',
                'name.min' => 'Der Abteilungsname sollte mindestens 3 Zeichen enthalten',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom du département est obligatoire.',
                'name.min' => 'Le nom du département doit contenir au moins 3 caractères',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The department name field is required.',
                'name.min' => 'The department name should contain at least 3 characters',
                'name.max' => 'The max length of 255 characters is reached.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = array(
            'name'  =>  $name,
            'school_id'  =>  $user->school_id,

        );

        Department::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Department <b> SAVED </b> successfully.']);
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(['success'=>'Department <b> DELETED </b> successfully.']);
    }

    public function storesorting(Request $request){
        $departments = $request->departments;
        foreach ($departments as $key => $value) {
            $id = $value['id'];
            $sorting = $value['sorting'];

            $data = array(
                'sorting'  =>  $sorting,
            );
            Department::where('id',$id)->update($data);

        }
        $data = ['message' => 'Sorting success!'];

        return response()->json($data, 200);
    }
}
