<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Package;


use Auth;
use DataTables;

use Illuminate\Support\Facades\Validator;

class PackageCtrl extends Controller
{
	public function store(Request $request){
		$authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $price = $request->price;
        $currencyid = $request->currencyid;
        $installments = $request->installment;
        $amounts = $request->amount;
        $descriptions = $request->description;
        $sectionid = $request->sectionid;

        if ($installments) {
            $pricetype = "Installment";
        }else{
            $pricetype = "Complement Payment";
        }

        if($price){

            $section = Section::find($sectionid);
            $section->price = $price;
            $section->pricetype = $pricetype;
            $section->currency_id = $currencyid;

            $section->save();
        }

        if ($installments) {
            foreach ($installments as $key => $installment) {
                $package = new Package;
                $package->installment = $installment;
                $package->amount = $amounts[$key];
                $package->description = $descriptions[$key];
                $package->section_id = $sectionid;
                $package->user_id = $authuser_id;
                $package->school_id = $authuser->school_id;
                $package->save();
            }
        }


        return response()->json(['success'=>'Installment <b> SAVED </b> successfully.']);
	}

	public function update(Request $request, $id)
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $installment = $request->installment;
        $amount = $request->amount;
        $description = $request->description;

        $data = array(
            'installment'  =>  $installment[0],
            'amount'  =>  $amount[0],
            'description'   =>  $description[0],
            'user_id'   =>  $authuser_id,
        );

        Package::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Payment <b> SAVED </b> successfully.']);
    }

    public function sectioninstallment(Request $request, $id){
        $authuser_id = Auth::id();
    	
    	$price = $request->price;
        $currencyid = $request->currencyid;

        $data = array(
            'price'  =>  $price,
            'currency_id'  =>  $currencyid,
            'user_id'   =>  $authuser_id
        );

        Section::where('id',$id)->update($data);

        
        return response()->json(['success'=>'Payment <b> SAVED </b> successfully.']);
    }

    public function destroy(Package $package)
    {
        $package->delete();

        return response()->json(['success'=>'Payment <b> DELETED </b> successfully.']);
    }
}
