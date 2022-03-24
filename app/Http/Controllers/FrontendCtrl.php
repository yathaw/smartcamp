<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendCtrl extends Controller
{
    public function index(){
        return view('frontend.index');
    }
}
