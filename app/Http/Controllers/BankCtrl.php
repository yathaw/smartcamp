<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
use DataTables;
use Illuminate\Support\Facades\App;

class BankCtrl extends Controller
{
    public function index()
    {
        return view('backend.bank');
    }

    public function getlistData(Request $request)
    {

        $data = Bank::latest()->get();

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function(Bank $bank) {

                        $name = '<div class="d-flex no-block align-items-center">';

                        if($bank->logo){

                        $name = $name.'<div class="mr-3">
                                        <img src="'.$bank->logo.'"
                                            alt="'.$bank->name.'" class="rounded-circle" width="45"
                                            height="45" />
                                    </div>';
                        }

                        $name = $name.'<div class="">
                                        <p class="ms-3">'.$bank->name.'</p>
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
        $rules = [
            'name'  =>'required|unique:banks,name,NULL,id,deleted_at,NULL|min:3',
            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'required'],


        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ဘဏ် အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.unique' => 'ဘဏ် အမည်မှာ ထပ်နေပါသည်။',
                'name.min' => 'ဘဏ် အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။',
                'image.required' => 'ပုံဖြည့်သွင်းရန်လိုအပ်သည်။',
                'image.mimes' => 'ပုံမှာ jpeg,png,jpg,gif,svg ဖြင့်သာသိမ်းလို့ရပါသည်။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '銀行名フィールドは必須です。',
                'name.unique' => '宗教名フィールドは一意です。',
                'name.min' => '宗教名には少なくとも3文字を含める必要があります。',
                'image.required' => '画像フィールドは必須です。',
                'image.mimes' => '画像はjpeg、png、jpg、gif、svgでのみ保存できます。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '宗教名称字段是必需的。',
                'name.unique' => '宗教名称字段是唯一的。',
                'name.min' => '宗教名称应至少包含 3 个字符。',
                'image.required' => '图像字段是必需的。',
                'image.mimes' => '图片只能保存为jpeg、png、jpg、gif、svg。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Banksname ist erforderlich.',
                'name.unique' => 'Das Feld für den Banksnamen ist eindeutig.',
                'name.min' => 'Der Banksname sollte mindestens 3 Zeichen enthalten.',
                'image.required' => 'Das Bildfeld ist erforderlich.',
                'image.mimes' => 'Das Bild kann nur in jpeg, png, jpg, gif, svg gespeichert werden.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ Nom de la Bank est obligatoire.',
                'name.unique' => 'Le champ du nom de la Bank est unique.',
                'name.min' => 'Le nom de la Bank doit contenir au moins 3 caractères.',
                'image.required' => 'Le champ image est obligatoire.',
                'image.mimes' => "L'image ne peut être enregistrée qu'au format jpeg, png, jpg, gif, svg."
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The bank name field is required.',
                'name.unique' => 'The bank name field is unique.',
                'name.min' => 'The bank name should contain at least 3 characters.',
                'image.required' => 'The image field is required.',
                'image.mimes' => 'The image can only be saved in jpeg, png, jpg, gif, svg.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $image = $request->file('image');

        // File Upload
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('storage/bank/'), $imageName);

        $imagepath = '/storage/bank/'.$imageName;

        Bank::create([
            'name'  => $request->name,
            'logo'  => $imagepath

        ]);        
   
        return response()->json(['success'=>'Bank <b> SAVED </b> successfully.']);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name'  =>'required|min:3',
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'ကိုးကွယ်သည့်ဘာသာ အမည် ဖြည့်သွင်းရန်လိုအပ်သည်။',
                'name.min' => 'ကိုးကွယ်သည့်ဘာသာ အမည်တွင်အနည်းဆုံးစာလုံး ၃ လုံး ပါဝင်ရပါမည်။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '宗教名フィールドは必須です。',
                'name.min' => '宗教名には少なくとも3文字を含める必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '宗教名称字段是必需的。',
                'name.min' => '宗教名称应至少包含 3 个字符。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Feld Banksname ist erforderlich.',
                'name.min' => 'Der Banksname sollte mindestens 3 Zeichen enthalten.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ Nom de la Bank est obligatoire.',
                'name.min' => 'Le nom de la Bank doit contenir au moins 3 caractères.'
            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The Bank name field is required.',
                'name.min' => 'The Bank name should contain at least 3 characters.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $newphoto = $request->image;
        $oldphoto = $request->oldimage;

        if ($request->hasfile('image')) {

            if(\File::exists(public_path($oldphoto))){
                \File::delete(public_path($newphoto));
            }

            $image = $request->file('image');

            // File Upload
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('storage/bank'), $imageName);

            $imagepath = '/storage/bank/'.$imageName;
        }


        $name = $request->name;

        $data = array(
            'name'  =>  $name,
            'logo' => $imagepath
        );

        Bank::where('id',$id)->update($data);

        return response()->json(['success'=>'Bank <b> SAVED </b> successfully.']); 
    }

    public function destroy(Bank $bank)
    {
        if(\File::exists(public_path($bank->logo))){
            \File::delete(public_path($bank->logo));
        }

        $bank->delete();

        return response()->json(['success'=>'Bank <b> DELETED </b> successfully.']);

    }
}
