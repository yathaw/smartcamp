<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\App;

class PositionCtrl extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required|min:3|max:255',
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ရာထူးအမည် အကွက် လိုအပ်သည်။',
                'name.min' => 'ရာထူးအမည် အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => 'ポジション名フィールドは必須です。',
                'name.min' => '位置名フィールドには、少なくとも3文字を含める必要があります',
                'name.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '职位名称字段是必需的。',
                'name.min' => '职位名称字段应至少包含 3 个字符',
                'name.max' => '已达到 255 个字符的最大长度。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Positionsname ist erforderlich.',
                'name.min' => 'Das Positionsnamensfeld sollte mindestens 3 Zeichen enthalten',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom du poste est obligatoire.',
                'name.min' => 'Le champ du nom du poste doit contenir au moins 3 caractères',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The position name field is required.',
                'name.min' => 'The position name field should contain at least 3 characters',
                'name.max' => 'The max length of 255 characters is reached.',
            ];
        }

        $this->validate($request, $rules, $customMessages);
            
        $name = $request->name;
        $department = $request->departmentid;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);
        
        $hasposition_inDepartment = Position::where('department_id', $department)
                                    ->where('school_id', $user->school_id)
                                    ->get();

        if($hasposition_inDepartment->isEmpty()){
            $sorting_data = 1;
        }else{
            foreach($hasposition_inDepartment as $hasPosition){
                $sorting = $hasPosition->sorting;
                $sorting_data = ++$sorting;
            }
        }
        
        $position = new Position;
        $position->name = $name;
        $position->department_id = $department;
        $position->school_id = $user->school_id;
        $position->sorting = $sorting_data;
        $position->save();
              
        
        return response()->json(['success'=>'Position <b> SAVED </b> successfully.']);
        
    }

    public function update(Request $request, $id)
    {
        $name = $request->name;

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $user = User::find($authuser_id);

        $data = array(
            'name'  =>  $name,
            'school_id'  =>  $user->school_id,

        );

        Position::where('id',$id)->update($data);

        return response()->json(['success'=>'Position <b> SAVED </b> successfully.']);
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json(['success'=>'Position <b> DELETED </b> successfully.']);
    }

    public function storesorting(Request $request){
        $positions = $request->positions;
        foreach ($positions as $key => $value) {
            $id = $value['id'];
            $sorting = $value['sorting'];

            $data = array(
                'sorting'  =>  $sorting,
            );
            Position::where('id',$id)->update($data);

        }
        $data = ['message' => 'Sorting success!'];

        return response()->json($data, 200);
    }
}
