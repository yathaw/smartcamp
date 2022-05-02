<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardCtrl extends Controller
{
    public function index(){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        if($role[0] == "Software Admin"){
            return view('backend.dashboard.admin');
        }
    }
}
