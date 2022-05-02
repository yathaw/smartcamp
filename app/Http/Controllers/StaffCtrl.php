<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\School;
use App\Models\Position;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Subjecttype;
use App\Models\User;
use App\Models\VerifyUser;
use App\Models\Department;
use App\Models\Curriculum;

use Hashids\Hashids;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class StaffCtrl extends Controller
{
    public function index()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;

        $unorderdepartments = Department::where('school_id', $schoolid)->get();
        $departments = $unorderdepartments->sortBy('sorting')->values();

        return view('backend.staff.list',compact('departments'));
    }

    public function getlistData($id){
        $data = Staff::where('position_id', $id)->get();

        $tables = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function(Staff $staff) {

                    $profile = asset($staff->user->profile_photo_path);
                    $name = $staff->user->name;
                    $phones = json_decode($staff->phone,true);


                    $data = '<div class="d-flex justify-content-start align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        <img src="'.$profile.'" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-truncate">'.$name.'</span>
                                    <small class="text-truncate text-muted"> <i class="bi bi-telephone me-2"></i>'.
                                        $phones[0]
                                    .'</small>
                                </div>
                            </div>';

                    return $data;
                })
                ->addColumn('email', function(Staff $staff) {
                    return $staff->user->email;
                })
                ->addColumn('experience', function(Staff $staff) {
                    $jod = $staff->joindate;

                    $today = date('Y-m-d');
                    $date_diff = abs(strtotime($today) - strtotime($jod));

                    $years = floor($date_diff / (365*60*60*24));
                    $months = floor(($date_diff - $years * 365*60*60*24)/ (30*60*60*24));

                    if($years){
                        $experience = $years." Years";
                    }else{
                        $experience = $months." Months";

                    }
                    return $experience;
                })
                ->addColumn('status', function(Staff $staff) {
                    $status = $staff->status;

                    if ($status =='Active') {
                        $data = '<span class="badge bg-success">'.$status.'</span>';
                    }else{
                        $data = '<span class="badge bg-danger">'.$status.'</span>';
                    }
                    return $data;
                })
                    
                ->addColumn('action', function($row){

                    $role = $row->user->getRoleNames();

                    $detailurl = route('master.staff.show',$row->id);
                    $editurl = route('master.staff.edit',$row->id);

                    $toggleDetail =  __('Detail');
                    $toggleResigned =  __('Resigned');
                    $toggleDelete=__('Remove');

                    $btn = '<div class="">';
                        
                        $btn .= '<a href="'.$detailurl.'" class="btn btn-outline-info me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="'.$toggleDetail.'">
                                    <i class="bi bi-info-lg"></i> 
                                </a>';

                        $btn .='</div>';

                    
                    
                    return $btn;
                })
                ->rawColumns(['name','action','phone','status'])
                ->make(true);

        return $tables;
    }

	public function create()
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $school = School::find($authuser->school_id);

        $subjects = Subject::where('school_id', '=', $authuser->school_id)->latest()->get();
        $subjecttypes = Subjecttype::where('school_id', '=', $authuser->school_id)->latest()->get();

        $bloods = Blood::latest()->get();
        $religions = Religion::latest()->get();

        $positions = Position::whereHas('department',function($q){
                        $q->orderBy('sorting');
                    })
                    ->where('school_id', $school->id)
                    ->get();

        $departments = Department::whereHas('positions',function($q){
                        $q->orderBy('sorting');
                    })
                    ->where('school_id', $school->id)
                    ->orderBy('sorting')
                    ->get();

        $permissions = Permission::get();


        return view('backend.staff.new',compact('bloods', 'religions', 'positions', 'permissions', 'departments','subjects'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'dob' =>  Carbon::parse($request->startdate)->format('Y-m-d'),
            'jod' =>  Carbon::parse($request->enddate)->format('Y-m-d')
        ]);

        $rules = [
            'profile' => 'required',
            'profile.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|min:3|max:255', 
            'gender' => 'required',
            'nrc' => 'required|min:3|max:255',
            'dob' => 'required|date',
            'email' => 'required|unique:staff,workemail,NULL,id,deleted_at,NULL|min:3|max:255',
            'password' => 'required|min:8|max:255',
            'address' => 'required|min:3|max:255',
            'phoneno' => 'required',
            'positionid' => 'required',
            'jod' => 'required|date',
            'bloodid' => 'required',
            'religionid' => 'required',
            'degree' => 'required',
            'file' => 'required',
            'file.*' => 'mimes:pdf|max:2048' 
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'profile.required' => 'ပရိုဖိုင်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'profile.image' => 'ပရိုဖိုင်အကွက်သည် ပုံတစ်ပုံဖြစ်ရမည်။',
                'profile.mimes' => 'ဖိုင်အမျိုးအစားသည် jpeg,jpg,png,gif,svg ဖြစ်ရပါမည်။',
                'profile.max' => 'ဓာတ်ပုံသည် 2048 ကီလိုဘိုက်ထက် မကြီးရပါ။',
                'name.required' => 'အမည်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'name.min' => 'အမည်အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'gender.required' => 'ကျားမအကွက်ကို အလွတ်မရနိုင်ပါ။',
                'nrc.required' => 'နိုင်ငံသားစိစစ်ရေးအကွက်မှာ ကွက်လပ်မရှိနိုင်ပါ။',
                'nrc.min' => 'နိုင်ငံသားများ မှတ်ပုံတင်ရေးအကွက်တွင် အနည်းဆုံး စာလုံး ၃ လုံး ပါဝင်သင့်သည်။',
                'nrc.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'dob.required' => 'မွေးသက္ကရာဇ်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'dob.date' => 'မွေးသက္ကရာဇ်အကွက်သည် ရက်စွဲဖြစ်ရမည်။',
                'email.required' => 'အီးမေးလ်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'email.unique' => 'ဤအီးမေးလ်ကို ယူထားပြီးဖြစ်သည်။ နောက်တစ်ခုကို စမ်းကြည့်ပါ။',
                'email.min' => 'အီးမေးလ်အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'email.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'password.required' => 'စကားဝှက်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'password.min' => 'စကားဝှက်အကွက်တွင် အနည်းဆုံး စာလုံး 8 လုံး ပါဝင်သင့်သည်။',
                'password.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'address.required' => 'လိပ်စာအကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'address.min' => 'လိပ်စာအကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'address.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'phone.required' => 'ဖုန်းအကွက်ကို အလွတ်မရနိုင်ပါ။',
                'positionid.required' => 'ရာထူးအမည် အကွက် လိုအပ်သည်။',
                'jod.required' => 'အလုပ်ဆင်းသည့်ရက်ဆွဲ အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'jod.date' => 'အလုပ်ဆင်းသည့်ရက်ဆွဲ အကွက်သည် ရက်စွဲဖြစ်ရမည်။',
                'bloodid.required' => 'သွေးကွက်လပ်မဖြစ်နိုင်ပါ။',
                'religionid.required' => 'ဘာသာရေးအကွက်ကို အလွတ်မရနိုင်ပါ။',
                'degree.required' => 'ဘွဲ့လက်မှတ်အကွက်ကို အလွတ်မရနိုင်ပါ။',
                'file.required' => 'ဖိုင်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'file.mimes' => 'ဖိုင်အမျိုးအစားသည် PDF ဖြစ်ရပါမည်။',
                'file.max' => 'ဖိုင်သည် 2048 ကီလိုဘိုက်ထက် မကြီးနိုင်ပါ။',
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'profile.required' => 'プロファイルフィールドを空白にすることはできません。',
                'profile.image' => 'プロファイルフィールドは画像である必要があります。',
                'profile.mimes' => 'ファイルタイプはjpeg、jpg、png、gif、svgである必要があります',
                'profile.max' => '写真は2048キロバイトを超えてはなりません。',
                'name.required' => '名前フィールドを空白にすることはできません。',
                'name.min' => '名前フィールドには、少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'gender.required' => '性別フィールドを空白にすることはできません。',
                'nrc.required' => '市民の全国登録フィールドを空白にすることはできません。',
                'nrc.min' => '市民の全国登録フィールドには、少なくとも3文字が含まれている必要があります。',
                'nrc.max' => '最大長255文字に達しました。',
                'dob.required' => '生年月日フィールドを空白にすることはできません。',
                'dob.date' => '生年月日フィールドは日付である必要があります。',
                'email.required' => 'メールフィールドを空白にすることはできません。',
                'email.unique' => 'このメールはすでに届いています。別のを試してみてください',
                'email.min' => 'メールフィールドには少なくとも3文字を含める必要があります。',
                'email.max' => '最大長255文字に達しました。',
                'password.required' => 'パスワードフィールドを空白にすることはできません。',
                'password.min' => 'パスワードフィールドには、8文字以上を含める必要があります。',
                'password.max' => '最大長255文字に達しました。',
                'address.required' => 'アドレスフィールドを空白にすることはできません。',
                'address.min' => 'アドレスフィールドには、少なくとも3文字を含める必要があります。',
                'address.max' => '最大長255文字に達しました。',
                'phoneno.required' => '電話フィールドを空白にすることはできません。',
                'positionid.required' => 'ポジション名フィールドは必須です。',
                'jod.required' => '日付の結合フィールドを空白にすることはできません。',
                'jod.date' => '日付フィールドの結合は日付でなければなりません。',
                'bloodid.required' => '血液フィールドを空白にすることはできません。',
                'religionid.required' => '宗教フィールドを空白にすることはできません。',
                'degree.required' => '学位フィールドを空白にすることはできません。',
                'file.required' => 'ファイルフィールドを空白にすることはできません。',
                'file.mimes' => 'ファイルタイプはPDFである必要があります',
                'file.max' => 'ファイルは2048キロバイトを超えることはできません。',
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'profile.required' => '配置文件字段不能为空。',
                'profile.image' => '配置文件字段必须是图像。',
                'profile.mimes' => '文件类型必须为 jpeg,jpg,png,gif,svg',
                'profile.max' => '照片不得超过 2048 KB。',
                'name.required' => '名称字段不能为空。',
                'name.min' => '名称字段应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'gender.required' => '性别字段不能为空。',
                'nrc.required' => '国家公民登记字段不能为空。',
                'nrc.min' => '公民的国家注册字段应包含至少 3 个字符。',
                'nrc.max' => '已达到 255 个字符的最大长度。',
                'dob.required' => '出生日期字段不能为空。',
                'dob.date' => '出生日期字段必须是日期。',
                'email.required' => '电子邮件字段不能为空。',
                'email.unique' => '该E-mail已经采取。尝试另一个',
                'email.min' => '电子邮件字段应至少包含 3 个字符。',
                'email.max' => '已达到 255 个字符的最大长度。',
                'password.required' => '密码字段不能为空。',
                'password.min' => '密码字段应至少包含 8 个字符。',
                'password.max' => '已达到 255 个字符的最大长度。',
                'address.required' => '地址字段不能为空。',
                'address.min' => '地址字段应至少包含 3 个字符。',
                'address.max' => '已达到 255 个字符的最大长度。',
                'phoneno.required' => '电话字段不能为空。',
                'positionid.required' => '职位名称字段是必需的。',
                'jod.required' => '日期字段的连接不能为空。',
                'jod.date' => '日期字段的连接必须是日期。',
                'bloodid.required' => '血域不能为空。',
                'religionid.required' => '宗教字段不能为空。',
                'degree.required' => '学位字段不能为空。',
                'file.required' => '文件字段不能为空。',
                'file.mimes' => '文件类型必须为 PDF',
                'file.max' => '该文件不得大于 2048 KB。',
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'profile.required' => 'Das Profilfeld darf nicht leer sein.',
                'profile.image' => 'Das Profilfeld muss ein Bild sein.',
                'profile.mimes' => 'Der Dateityp muss JPEG, JPG, PNG, GIF oder SVG sein',
                'profile.max' => 'Das Foto darf nicht größer als 2048 Kilobyte sein.',
                'name.required' => 'Das Namensfeld darf nicht leer sein.',
                'name.min' => 'Das Namensfeld sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'gender.required' => 'Das Geschlechtsfeld darf nicht leer sein.',
                'nrc.required' => 'Das Feld Nationale Registrierung von Bürgern darf nicht leer sein.',
                'nrc.min' => 'Das Feld Nationale Registrierung von Bürgern sollte mindestens 3 Zeichen enthalten.',
                'nrc.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'dob.required' => 'Das Feld Geburtsdatum darf nicht leer sein.',
                'dob.date' => 'Das Feld für das Geburtsdatum muss date sein.',
                'email.required' => 'Das E-Mail-Feld darf nicht leer sein.',
                'email.unique' => 'Diese E-Mail ist schon vergeben. Versuche einen anderen',
                'email.min' => 'Das E-Mail-Feld sollte mindestens 3 Zeichen enthalten.',
                'email.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'password.required' => 'Das Passwortfeld darf nicht leer sein.',
                'password.min' => 'Das Passwortfeld sollte mindestens 8 Zeichen enthalten.',
                'password.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'address.required' => 'Das Adressfeld darf nicht leer sein.',
                'address.min' => 'Das Adressfeld sollte mindestens 3 Zeichen enthalten.',
                'address.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'phoneno.required' => 'Das Telefonfeld darf nicht leer sein.',
                'positionid.required' => 'Das Feld Positionsname ist erforderlich.',
                'jod.required' => 'Das Feld Beitrittsdatum darf nicht leer sein.',
                'jod.date' => 'Das Join-of-Datumsfeld muss date sein.',
                'bloodid.required' => 'Das Blutfeld darf nicht leer sein.',
                'religionid.required' => 'Das Religionsfeld darf nicht leer sein.',
                'degree.required' => 'Das Abschlussfeld darf nicht leer sein.',
                'file.required' => 'Das Dateifeld darf nicht leer sein.',
                'file.mimes' => 'Der Dateityp muss PDF sein',
                'file.max' => 'Die Datei darf nicht größer als 2048 Kilobyte sein.',
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'profile.required' => 'Le champ de profil ne peut pas être vide.',
                'profile.image' => 'Le champ de profil doit être une image.',
                'profile.mimes' => 'Le type de fichier doit être au format jpeg, jpg, png, gif, svg',
                'profile.max' => 'La photo ne doit pas dépasser 2048 kilo-octets.',
                'name.required' => 'Le champ du nom ne peut pas être vide.',
                'name.min' => 'Le champ du nom doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'gender.required' => 'Le champ sexe ne peut pas être vide.',
                'nrc.required' => 'Le champ Enregistrement national des citoyens ne peut pas être vide.',
                'nrc.min' => 'Le champ Enregistrement national des citoyens doit contenir au moins 3 caractères.',
                'nrc.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'dob.required' => 'Le champ de la date de naissance ne peut pas être vide.',
                'dob.date' => 'Le champ de la date de naissance doit être la date.',
                'email.required' => 'Le champ e-mail ne peut pas être vide.',
                'email.unique' => 'Cet e-mail est déjà pris. Essaie un autre',
                'email.min' => 'Le champ email doit contenir au moins 3 caractères.',
                'email.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'password.required' => 'Le champ du mot de passe ne peut pas être vide.',
                'password.min' => 'Le champ du mot de passe doit contenir au moins 8 caractères.',
                'password.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'address.required' => "Le champ d'adresse ne peut pas être vide.",
                'address.min' => "Le champ d'adresse doit contenir au moins 3 caractères.",
                'address.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'phoneno.required' => 'Le champ du téléphone ne peut pas être vide.',
                'positionid.required' => 'Le champ du nom du poste est obligatoire.',
                'jod.required' => 'Le champ de jointure de date ne peut pas être vide.',
                'jod.date' => 'Le champ de jointure de date doit être la date.',
                'bloodid.required' => 'Le champ de sang ne peut pas être vide.',
                'religionid.required' => 'Le champ religion ne peut pas être vide.',
                'degree.required' => 'Le champ diplôme ne peut pas être vide.',
                'file.required' => 'Le champ du fichier ne peut pas être vide.',
                'file.mimes' => 'Le type de fichier doit être au format PDF',
                'file.max' => 'Le fichier ne doit pas dépasser 2048 kilo-octets.',
            ];
        }
        else{
            $customMessages = [
                'profile.required' => 'The profile field cannot be blank.',
                'profile.image' => 'The profile field must be an image.',
                'profile.mimes' => 'File Type must be in jpeg,jpg,png,gif,svg',
                'profile.max' => 'The photo may not be greater than 2048 kilobytes.',
                'name.required' => 'The name field cannot be blank.',
                'name.min' => 'The name field should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'gender.required' => 'The gender field cannot be blank.',
                'nrc.required' => 'The nrc field cannot be blank.',
                'nrc.min' => 'The nrc field should contain at least 3 characters.',
                'nrc.max' => 'The max length of 255 characters is reached.',
                'dob.required' => 'The dob field cannot be blank.',
                'dob.date' => 'The dob field must be date.',
                'email.required' => 'The email field cannot be blank.',
                'email.unique' => 'This email is already taken. Try Another',
                'email.min' => 'The email field should contain at least 3 characters.',
                'email.max' => 'The max length of 255 characters is reached.',
                'password.required' => 'The password field cannot be blank.',
                'password.min' => 'The password field should contain at least 8 characters.',
                'password.max' => 'The max length of 255 characters is reached.',
                'address.required' => 'The address field cannot be blank.',
                'address.min' => 'The address field should contain at least 3 characters.',
                'address.max' => 'The max length of 255 characters is reached.',
                'phoneno.required' => 'The phone field cannot be blank.',
                'positionid.required' => 'The position field cannot be blank.',
                'jod.required' => 'The jod field cannot be blank.',
                'jod.date' => 'The jod field must be date.',
                'bloodid.required' => 'The blood field cannot be blank.',
                'religionid.required' => 'The religion field cannot be blank.',
                'degree.required' => 'The degree field cannot be blank.',
                'file.required' => 'The file field cannot be blank.',
                'file.mimes' => 'File Type must be in PDF',
                'file.max' => 'The file may not be greater than 2048 kilobytes.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $profile = $request->profile; 
        $gender = $request->gender;
        $name = $request->name; 
        $nrc = $request->id; 
        $dob = $request->dob; 
        $email = $request->email; 
        $password = $request->password; 

        $address = $request->address; 
        $phoneno = $request->phoneno; 
        $position = $request->position;
        $joindate = $request->joindate; 
        $blood = $request->bloodid; 
        $religion = $request->religionid; 
        $degree = $request->degree;
        $cvfile = $request->file; 

        $teacherstatus = $request->teacherstatus; 

        $grades = $request->grades;
        $subjects = $request->subjects; // Curriculum_id

        $permissions = $request->permissions;

        $now = Carbon::now();
        $status = 'Active';

        if ($request->hasfile('profile')) {

            $profile = $request->file('profile');

            // File Upload
            $profileimageName = time().'.'.$profile->extension();
            $profile->move(public_path('storage/profile'), $profileimageName);

            $profilepath = 'storage/profile/'.$profileimageName;
        }

        if ($request->hasfile('file')) {

            $cv = $request->file('file');

            // File Upload
            $cvfileName = time().'.'.$cv->extension();
            $cv->move(public_path('storage/cv'), $cvfileName);

            $cvpath = 'storage/cv/'.$cvfileName;
        }else{
            $cvpath = '';        
        }

        $emailhashids = new Hashids($name);
        $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

        $user = new User();
        $user->name = $name;
        $user->email = $generateEmail.'.smartcamp.com';
        $user->profile_photo_path = $profilepath;
        $user->school_id = $authuser->school_id;
        $user->email_verified_at = $now;
        $user->password = Hash::make($password);
        $user->save();

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);
        $user->assignRole('Staff');

        $staff = new Staff();
        $staff->workemail = $email;
        $staff->gender = $gender;
        $staff->degree = json_encode($degree);
        $staff->nrc = $nrc;
        $staff->dob = $dob;
        $staff->phone = json_encode($phoneno);
        $staff->address = $address;
        $staff->status = $status;
        $staff->joindate = $joindate;
        $staff->file = $cvpath;
        $staff->blood_id = $blood;
        $staff->religion_id = $religion;
        $staff->user_id = $user->id;
        $staff->position_id = $position;
        $staff->save();

        if ($teacherstatus == 'on') {
            foreach ($subjects as $key => $subject) {
                $user->subjects()->attach($subject);
            }
        }

        $user->syncPermissions($permissions);

        return redirect()->back()->with('success','Staff has been created.');
        
    } 

    public function show(Staff $staff)
    {
        $user = $staff->user;

        $subjects = Subject::where('school_id', '=', $staff->user->school_id)->orderby('name')->get();

        $permissions = Permission::get();

        $staffpermissions = $user->getDirectPermissions();

        $accesspermissionids = array();
        foreach ($staffpermissions as $permission) {
            $permissionid = $permission->id;
            if(!in_array($permissionid,$accesspermissionids))
            {
                array_push($accesspermissionids, $permissionid);
            }
        }

        $specificsubjectids =array();

        foreach($staff->user->subjects as $subject){
            $specificsubjectid = $subject->id;
            if(!in_array($specificsubjectid,$specificsubjectids))
            {
                array_push($specificsubjectids, $specificsubjectid);
            }
        }


        return view('backend.staff.show',compact('staff','subjects', 'permissions', 'accesspermissionids', 'specificsubjectids'));
    }

    public function destroy(Staff $staff)
    {

        $user = $staff->user;
        // $user->assignRole('Teacher');
        $user_role=$user->getRoleNames();

        $user_permissions = $user->getDirectPermissions();

        foreach ($user_permissions as $user_permission) {
            $user->revokePermissionTo($user_permission->name);
        }
        $user->removeRole($user_role[0]);

        $staff->delete();
        $user->delete();
    }

    public function resign(Request $request, $id)
    {
        $rules = [
            'leavedate' => 'required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'leavedate.required' => 'နုတ်ထွက်မည့်ရက်ကို ကွက်လပ်ထား၍မရပါ။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'leavedate.required' => '辞任日は空白にすることはできません。'
            ];
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'leavedate.required' => '辞职日期不能为空。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'leavedate.required' => 'Das Rücktrittsdatum darf nicht leer sein.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'leavedate.required' => "La date de démission ne peut pas être vide."
            ];
        }
        else{
            $customMessages = [
                'leavedate.required' => 'The resignation date cannot be blank.'
            ];
        }

        $this->validate($request, $rules, $customMessages);
        $status = 'Resign';
        $data = array(
            'leavedate'  =>  $request->leavedate,
            'status'  =>  $status
        );

        Staff::where('id',$id)->update($data);
        return response()->json(['success'=>'Staff <b> SAVED </b> successfully.']);

    }

    public function restore($id){
        $status = 'Active';
        $data = array(
            'leavedate'  =>  NULL,
            'status'  =>  $status
        );

        Staff::where('id',$id)->update($data);
        return response()->json(['success'=>'Staff <b> SAVED </b> successfully.']);
    }

    public function storeSubject_byuserid(Request $request){
        $userid = $request->userid;
        $subjects = $request->subjects;
        $rules = [
            'subjects' => 'array|required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'subjects.required' => 'မည်သည့်ဘာသာရပ်ကိုမျှ သင်မရွေးချယ်ပါ။ ကျေးဇူးပြု၍ တစ်ခုကို ရွေးချယ်ပါ။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'subjects.required' => '科目を選択していません。オプションを選択してください。'
            ];
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'subjects.required' => '您还没有选择任何主题。请选择一个选项。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'subjects.required' => 'Sie haben keine Fächer ausgewählt. Bitte wähle eine Option.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'subjects.required' => "Vous n'avez sélectionné aucun sujet. Veuillez sélectionner une option."
            ];
        }
        else{
            $customMessages = [
                'subjects.required' => 'You have not selected any subjects. Please select an option.'
            ];
        }

        $this->validate($request, $rules, $customMessages);
        $user = User::find($userid);
        
        $user->subjects()->detach();
        $user->subjects()->attach($subjects);

        return response()->json(['success'=>'Subject <b> SAVED </b> successfully.']);
        
    }

    public function storePermission_byuserid(Request $request){
        $userid = $request->userid;
        $permissions = $request->permissions;
        $rules = [
            'permissions' => 'array|required'
        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'permissions.required' => 'ခွင့်ပြုချက်များကို သင်မရွေးချယ်ခဲ့ပါ။ ကျေးဇူးပြု၍ တစ်ခုကို ရွေးချယ်ပါ။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'permissions.required' => '権限を選択していません。オプションを選択してください。'
            ];
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'permissions.required' => '您尚未选择任何权限。请选择一个选项。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'permissions.required' => 'Sie haben keine Berechtigungen ausgewählt. Bitte wähle eine Option.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'permissions.required' => "Vous n'avez sélectionné aucune autorisation. Veuillez sélectionner une option."
            ];
        }
        else{
            $customMessages = [
                'permissions.required' => 'You have not selected any permissions. Please select an option.'
            ];
        }

        $this->validate($request, $rules, $customMessages);
        $user = User::find($userid);
        

        $user->syncPermissions($permissions);

        return response()->json(['success'=>'Subject <b> SAVED </b> successfully.']);
        
    }

}
