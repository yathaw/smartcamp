<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Auth;


class SchoolCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        if($role[0] == "Software Admin"){
            $schools = School::all();

            return view('backend.school',compact('schools'));

        }else{
            
            $schoolid = $authuser->school_id;
            $school = School::find($schoolid);

            return view('backend.school',compact('school'));
        }
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy(School $school)
    {
        $school->delete();

        return response()->json(['success'=>'Bank <b> DELETED </b> successfully.']);
    }
}
