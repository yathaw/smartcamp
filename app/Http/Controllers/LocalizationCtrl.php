<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LocalizationCtrl extends Controller
{
    public function index($locale)
    {   
        // dd($locale);
        App::setLocale($locale);
        //store the locale in session so that the middleware can register it
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
