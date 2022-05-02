<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class ReportCtrl extends Controller
{
    public function index(Request $request){
        
        if($request->startdate){
            $startdate = $request->startdate;
            $enddate = $request->enddate;

            $expenses = Expense::whereBetween('date', [$startdate,$enddate])->get();

            return vieW('backend.report',compact('startdate','enddate','expenses'));

        }else{
            return vieW('backend.report');

        }

    }
}
