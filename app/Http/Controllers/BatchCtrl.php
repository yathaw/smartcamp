<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\App;

class BatchCtrl extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'codeno'  =>'required',
            'name'  =>'required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'codeno.required' => 'အတန်း ကုဒ်အကွက် လိုအပ်သည်။',
                'name.required' => 'အတန်း အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'codeno.required' => 'バッチコードフィールドは必須です。',
                'name.required' => 'バッチ名フィールドは必須です。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'codeno.required' => '批次代码字段是必需的。',
                'name.required' => '批次名称字段是必需的。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'codeno.required' => 'Das Chargencode-Feld ist erforderlich.',
                'name.required' => 'Das Feld Stapelname ist erforderlich.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'codeno.required' => 'Le champ du code de lot est obligatoire.',
                'name.required' => 'Le champ du nom du lot est obligatoire.'
            ];
        }
        else{
            $customMessages = [
                'codeno.required' => 'The batch codeno field is required.',
                'name.required' => 'The batch name field is required.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $codeno = $request->codeno;
        $name = $request->name;
        $color = $request->color;
        $sectionid = $request->sectionid;

        $batch = new Batch;
        $batch->codeno = $codeno;
        $batch->name = $name;
        $batch->color = $color;
        $batch->section_id = $sectionid;
        $batch->user_id = $authuser_id;
        $batch->school_id = $authuser->school_id;
        $batch->save();

        return response()->json(['success'=>'Batch <b> SAVED </b> successfully.']);
    }

    public function update(Request $request, $id)
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $codeno = $request->codeno;
        $name = $request->name;
        $color = $request->color;
        $sectionid = $request->sectionid;

        $data = array(
            'codeno'  =>  $codeno,
            'name'  =>  $name,
            'color'   =>  $color,
            'user_id'   =>  $authuser_id,
        );

        Batch::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Batch <b> SAVED </b> successfully.']);
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return response()->json(['success'=>'Batch <b> DELETED </b> successfully.']);

    }
}
