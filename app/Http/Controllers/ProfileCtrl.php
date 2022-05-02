<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Country;
use App\Models\Staff;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class ProfileCtrl extends Controller
{
    public function index(){
        $bloods = Blood::latest()->get();
        $religions = Religion::latest()->get();
        $countries = Country::latest()->get();

        return view('backend.profile',compact('bloods','religions','countries'));
    }

    public function updateprofile(Request $request){
        $rules = [
            'profile' => 'required',
            'profile.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'profile.required' => 'ပရိုဖိုင်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'profile.image' => 'ပရိုဖိုင်အကွက်သည် ပုံတစ်ပုံဖြစ်ရမည်။',
                'profile.mimes' => 'ဖိုင်အမျိုးအစားသည် jpeg,jpg,png,gif,svg ဖြစ်ရပါမည်။',
                'profile.max' => 'ဓာတ်ပုံသည် 2048 ကီလိုဘိုက်ထက် မကြီးရပါ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'profile.required' => 'プロファイルフィールドを空白にすることはできません。',
                'profile.image' => 'プロファイルフィールドは画像である必要があります。',
                'profile.mimes' => 'ファイルタイプはjpeg、jpg、png、gif、svgである必要があります',
                'profile.max' => '写真は2048キロバイトを超えてはなりません。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'profile.required' => '配置文件字段不能为空。',
                'profile.image' => '配置文件字段必须是图像。',
                'profile.mimes' => '文件类型必须为 jpeg,jpg,png,gif,svg',
                'profile.max' => '照片不得超过 2048 KB。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'profile.required' => 'Das Profilfeld darf nicht leer sein.',
                'profile.image' => 'Das Profilfeld muss ein Bild sein.',
                'profile.mimes' => 'Der Dateityp muss JPEG, JPG, PNG, GIF oder SVG sein',
                'profile.max' => 'Das Foto darf nicht größer als 2048 Kilobyte sein.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'profile.required' => 'Le champ de profil ne peut pas être vide.',
                'profile.image' => 'Le champ de profil doit être une image.',
                'profile.mimes' => 'Le type de fichier doit être au format jpeg, jpg, png, gif, svg',
                'profile.max' => 'La photo ne doit pas dépasser 2048 kilo-octets.',
            ];
        }
        else{
            $customMessages = [
                'profile.required' => 'The profile field cannot be blank.',
                'profile.image' => 'The profile field must be an image.',
                'profile.mimes' => 'File Type must be in jpeg,jpg,png,gif,svg',
                'profile.max' => 'The photo may not be greater than 2048 kilobytes.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        if ($request->hasfile('profile')) {

            $profile = $request->file('profile');

            // File Upload
            $profileimageName = time().'.'.$profile->extension();
            $profile->move(public_path('storage/profile'), $profileimageName);

            $profilepath = 'storage/profile/'.$profileimageName;

            $authuser = Auth::user();
            $authuser_id = Auth::id();
            $role = $authuser->getRoleNames();

            $user = User::find($authuser_id);
            $user->profile_photo_path = $profilepath;
            $user->save();

            return redirect()->back()->with('successmsg','Profile Photo has been changed');

        }
    }

    public function update(Request $request, $id){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $name = $request->name; 

        $user = User::find($id);
        $user->name = $name;
        $user->save();

        if(in_array($role[0],["School Admin", "Principal", "Staff", "Teacher"]))
        {
            $gender = $request->gender;
            $nrc = $request->nrc; 
            $dob = $request->dob; 
            $phoneno_input_str = $request->phoneno; 
            $phoneno_str = $phoneno_input_str; 
            $phoneno_arr = explode(',', $phoneno_str[0]);

            $email = $request->email; 
            $blood = $request->bloodid; 
            $religion = $request->religionid; 
            $country = $request->countryid; 
            $degree_input_str = $request->degree;
            $degree_str = $degree_input_str; 
            $degree_arr = explode(',', $degree_str[0]);

            $address = $request->address; 
            // dd($dob);

            $staff = Staff::find($user->staff->id);
            $staff->workemail = $email;
            $staff->gender = $gender;
            $staff->degree = json_encode($degree_arr);
            $staff->nrc = $nrc;
            $staff->dob = Carbon::parse($dob)->format('Y-m-d');
            $staff->phone = json_encode($phoneno_arr);
            $staff->address = $address;
            $staff->blood_id = $blood;
            $staff->religion_id = $religion;
            $staff->country_id = $country;
            $staff->save();

        }

        if($role[0] == "Student"){
            $request->merge([
                'studob' =>  Carbon::parse($request->startdate)->format('Y-m-d'),
            ]);
            $rules = [
                'stugender' => 'required',
                'studob' => 'required|date',
            ];

            if (App::isLocale('mm')) {
                $customMessages = [
                    'stugender.required' => 'ကျားမအကွက်ကို အလွတ်မရနိုင်ပါ။',
                    'studob.required' => 'မွေးသက္ကရာဇ်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                    'studob.date' => 'မွေးသက္ကရာဇ်အကွက်သည် ရက်စွဲဖြစ်ရမည်။',
                ];
            }
            else if (App::isLocale('jp')) {
                $customMessages = [
                    'stugender.required' => '性別フィールドを空白にすることはできません。',
                    'studob.required' => '生年月日フィールドを空白にすることはできません。',
                    'studob.date' => '生年月日フィールドは日付である必要があります。',
                ];
                
            }
            else if (App::isLocale('cn')) {
                $customMessages = [
                    'stugender.required' => '性别字段不能为空。',
                    'studob.required' => '出生日期字段不能为空。',
                    'studob.date' => '出生日期字段必须是日期。',
                ];
            }
            else if (App::isLocale('de')) {
                $customMessages = [
                    'stugender.required' => 'Das Geschlechtsfeld darf nicht leer sein.',
                    'studob.required' => 'Das Feld Geburtsdatum darf nicht leer sein.',
                    'studob.date' => 'Das Feld für das Geburtsdatum muss date sein.',
                ];
            }
            else if (App::isLocale('fr')) {
                $customMessages = [
                    'stugender.required' => 'Le champ sexe ne peut pas être vide.',
                    'studob.required' => 'Le champ de la date de naissance ne peut pas être vide.',
                    'studob.date' => 'Le champ de la date de naissance doit être la date.',
                ];
            }
            else{
                $customMessages = [
                    'stugender.required' => 'The gender field cannot be blank.',
                    'studob.required' => 'The dob field cannot be blank.',
                    'studob.date' => 'The dob field must be date.',
                ];
            }

            $this->validate($request, $rules, $customMessages);


            $gender = $request->stugender;
            $name = $request->name; 
            $nativename = $request->nativename; 
            $dob = $request->studob; 

            $student = Student::find($authuser->student->id);
            $student->nativename = $nativename;
            $student->gender = $gender;
            $student->dob = $dob;
            $student->save();
        }

        if($role[0] == "Guardian"){

            $g_workemail = $request->g_workemail;
            $g_phone = $request->g_phone; 
            $g_occupation = $request->g_occupation;

            $g1 = Guardian::find($authuser->guardian->id);
            $g1->workemail = $g_workemail;
            $g1->phone = $g_phone;
            $g1->occupation = $g_occupation;
            $g1->save(); 

        }

        return redirect()->back()->with('successmsg','Profile has been updated');

    }

    public function changepassword(Request $request){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $rules = [
            'newPassword' => 'required|min:8|max:255|same:confirmed'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'newPassword.required' => 'စကားဝှက်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'newPassword.min' => 'စကားဝှက်အကွက်တွင် အနည်းဆုံး စာလုံး 8 လုံး ပါဝင်သင့်သည်။',
                'newPassword.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'newPassword.required' => 'パスワードフィールドを空白にすることはできません。',
                'newPassword.min' => 'パスワードフィールドには、8文字以上を含める必要があります。',
                'newPassword.max' => '最大長255文字に達しました。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'newPassword.required' => '密码字段不能为空。',
                'newPassword.min' => '密码字段应至少包含 8 个字符。',
                'newPassword.max' => '已达到 255 个字符的最大长度。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'newPassword.required' => 'Das Passwortfeld darf nicht leer sein.',
                'newPassword.min' => 'Das Passwortfeld sollte mindestens 8 Zeichen enthalten.',
                'newPassword.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'newPassword.required' => 'Le champ du mot de passe ne peut pas être vide.',
                'newPassword.min' => 'Le champ du mot de passe doit contenir au moins 8 caractères.',
                'newPassword.max' => 'La longueur maximale de 255 caractères est atteinte.',
            ];
        }
        else{
            $customMessages = [
                'password.required' => 'The password field cannot be blank.',
                'password.min' => 'The password field should contain at least 8 characters.',
                'password.max' => 'The max length of 255 characters is reached.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        if (Hash::check($request->currentPassword, $authuser->password)) { 
            $authuser->fill([
                'password' => Hash::make($request->newPassword)
            ])->save();

            return redirect()->back()->with('successmsg','Password changed');

        } else {
            return redirect()->back()->with('errmsg','Password does not match');
        }
    }
}
