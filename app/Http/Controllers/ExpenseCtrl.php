<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Expensetype;
use App\Models\User;


use DataTables;
use Illuminate\Support\Facades\App;
use Auth;

class ExpenseCtrl extends Controller
{
    public function index()
    {
        $expensetypes = Expensetype::all();

        return view('backend.expense',compact('expensetypes'));
    }

    public function getlistData(Request $request)
    {

        $data = Expense::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Expense $expense) {

                        $name = '<div class="d-flex no-block align-items-center">';

                        if($expense->logo){

                        $name = $name.'<div class="mr-3">
                                        <img src="'.$expense->logo.'"
                                            alt="'.$expense->name.'" class="rounded-circle" width="45"
                                            height="45" />
                                    </div>';
                        }

                        $name = $name.'<div class="">
                                        <p class="ms-3">'.$expense->name.'</p>
                                    </div>
                                </div>';
                        
                        

                        return $name;
                    })

                    ->addColumn('action', function($row){

                        $toggleEdit =  __('Edit');
                        $toggleDelete=__('Remove');
                        
                        $btn = '<div class="">';
                        

                        $btn .= '<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleEdit.'" data-id="'.$row->id.'" data-name="'.$row->name.'" data-image="'.$row->logo.'">
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
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();
        $user = User::find($authuser_id);

        $rules = [
            'title'  => 'required',
            'amount'  => 'required',
            'expensetype'  => 'required',
            'photo' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required'
        ];

        $this->validate($request, $rules);

        $title = $request->title;
        $expensetype = $request->expensetype;
        $amount = $request->amount;
        $date = $request->date;

        if ($request->hasfile('photo')) {

            $photo = $request->file('photo');

            // File Upload
            $photoimageName = time().'.'.$photo->extension();
            $photo->move(public_path('storage/paymentslip'), $photoimageName);

            $photopath = 'storage/paymentslip/'.$photoimageName;
        }

        Expense::create([
            'title'  => $title,
            'amount'  => $amount,
            'date'  => $date,
            'photo'  => $photopath,
            'expensetype_id'  => $expensetype,
            'user_id'  => $authuser_id,
            'school_id'  => $user->school_id,



        ]);        
   
        return redirect()->back()->with('successmsg', 'Successfully, saved in our database.');

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

    public function destroy(Expense $expense)
    {

    }
}

