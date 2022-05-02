<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\School;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Subjecttype;
use App\Models\Country;
use App\Models\Sport;
use App\Models\User;
use App\Models\VerifyUser;
use App\Models\Guardian;
use App\Models\Section;
use App\Models\Period;
use App\Models\Studentsegment;
use App\Models\Batch;
use App\Models\Payment;
use App\Models\Package;
use App\Models\Transfer;

use Hashids\Hashids;
use Carbon\Carbon;
use DataTables;

use Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;


class StudentCtrl extends Controller
{
    public function index()
    {

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;

        $school = School::find($schoolid);
        $gradeids = [];
        foreach ($school->grades as $grade) {
            array_push($gradeids, $grade->id);
        }

        $grades = Grade::whereIn('id', $gradeids)->get();

        $sections = Section::where('school_id', '=', $schoolid)->orderby('startdate','DESC')->get();    
        $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();

        return view('backend.student.list',compact('periods'));

    }
    public function getlistData($id){

        $data1 = Studentsegment::with(['student'])
                        ->where('batch_id',$id)->get();

        $data = Student::with('studentsegments')->whereHas('studentsegments', function ($query) use ($id) {
                    $query->where('studentsegments.batch_id', $id);
                })->get();



        $tables = Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function(Student $student) {

                    $profile = asset($student->user->profile_photo_path);
                    $name = $student->user->name;
                    $nativename = $student->nativename;

                    $data = '<div class="d-flex justify-content-start align-items-center">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        <img src="'.$profile.'" class="rounded-circle">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="text-truncate">'.$name.'</span>
                                    <small class="text-truncate text-muted">'.
                                        $nativename
                                    .'</small>
                                </div>
                            </div>';

                    return $data;
                })
                ->addColumn('email', function(Student $student) {
                    return $student->user->email;
                })
                ->addColumn('gender', function(Student $student) {
                    return $student->gender;
                })
                ->addColumn('status', function(Student $student) {
                    $status = $student->status;

                    if ($status =='Active') {
                        $data = '<span class="badge bg-success">'.$status.'</span>';
                    }else{
                        $data = '<span class="badge bg-danger">'.$status.'</span>';
                    }
                    return $data;
                })
                    
                ->addColumn('action', function($row){

                    $role = $row->user->getRoleNames();

                    $detailurl = route('master.student.show',$row->id);
                    $editurl = route('master.student.edit',$row->id);

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
                ->rawColumns(['name','action','gender','status'])
                ->make(true);

        return $tables;
    }

    public function create(){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $school = School::find($authuser->school_id);
        
        $gradeids = [];
        foreach ($school->grades as $grade) {
            array_push($gradeids, $grade->id);
        }

        $grades = Grade::whereIn('id', $gradeids)->get();

        $subjects = Subject::where('school_id', '=', $authuser->school_id)->latest()->get();
        $subjecttypes = Subjecttype::where('school_id', '=', $authuser->school_id)->latest()->get();

        $bloods = Blood::latest()->get();
        $religions = Religion::latest()->get();
        $countries = Country::all();
        $sports = Sport::all();



        return view('backend.student.new',compact('bloods', 'religions', 'subjects','grades','countries','sports'));
    }

    public function show($id)
    {
        $studentid = $id;
        $student = Student::with(['user',
            'studentsegments' => function ($q) {
                $q->orderBy('batch_id', 'desc');
            }, 
            'attendances' => function ($q1){
                $q1->groupBy('batch_id');
            }
        ])->find($studentid);
        $studentinstallments = Payment::where('student_id',$studentid)
                            ->pluck('package_id')
                            ->toArray();
        
        $payments = Payment::where('student_id',$studentid)->get();
        // dd($student);

        return view('backend.student.show',compact('student','studentinstallments'));
    }

    public function store(Request $request){
        $request->merge([
            'dob' =>  Carbon::parse($request->startdate)->format('Y-m-d'),
            'registerdate' =>  Carbon::parse($request->registerdate)->format('Y-m-d')
        ]);
        $rules = [
            'profile' => 'required',
            'profile.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender' => 'required',
            'name' => 'required|min:3|max:255', 
            'dob' => 'required|date',
            'registerdate' => 'required|date',
            'gradeid' => 'required',
            'countryid' => 'required',
            // 'previousschoolname' => 'required',
            'address' => 'required|min:3|max:255',
            'sportid' => 'required',
            'religionid' => 'required',
            'bloodid' => 'required',
            // 'medicalproblem' => 'required',
            // 'medicalneeds' => 'required',
            // 'medicationallergy' => 'required',
            // 'foodallergy' => 'required',
            // 'otherallergy' => 'required',

            'g1email' => 'required|unique:guardians,workemail,NULL,id,deleted_at,NULL|min:3|max:255',
            'g2email' => 'required|unique:guardians,workemail,NULL,id,deleted_at,NULL|min:3|max:255',

            'password1' => 'required|min:8|max:255',
            'password2' => 'required|min:8|max:255',
            'password3' => 'required|min:8|max:255',
            'g1phone' => 'required'
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
        $namenative = $request->namenative; 
        $dob = $request->dob; 
        $registerdate = $request->registerdate; 
        $gradeid = $request->gradeid; 
        $previousschoolname = $request->previousschoolname;
        $countryid = $request->countryid;
        $address = $request->address;
        $sportid = $request->sportid;
        $bio = $request->bio;
        $otherinterest = $request->otherinterest;
        $academicawards = $request->academicawards;
        $lunchbox = $request->lunchbox;
        $ferry = $request->ferry;
        $dormitory = $request->dormitory;
        $religionid = $request->religionid; 
        $bloodid = $request->bloodid; 
        $medicalproblem = $request->medicalproblem;
        $medicalneeds = $request->medicalneeds;
        $medicationallergy = $request->medicationallergy;
        $foodallergy = $request->foodallergy;
        $otherallergy = $request->otherallergy;

        $g1name = $request->g1name;
        $g1rs = $request->g1rs;
        $g1phone = $request->g1phone;
        $g1email = $request->g1email;
        $g1occupation = $request->g1occupation;

        $g2name = $request->g2name;
        $g2rs = $request->g2rs;
        $g2phone = $request->g2phone;
        $g2email = $request->g2email;
        $g2occupation = $request->g2occupation;

        $gbc = $request->img1;
        $idf = $request->img2;
        $idb = $request->img3;
        $pcm = $request->img4;
        $tc = $request->img5;
        $lmir = $request->img6;

        $logincodeg1 = $request->logincodeg1;
        $password1 = $request->password1;

        $logincodeg2 = $request->logincodeg2;
        $password2 = $request->password2;

        $logincodeg3 = $request->logincodeg3;
        $password3 = $request->password3;


        if ($request->hasfile('profile')) {

            $profile = $request->file('profile');

            // File Upload
            $profileimageName = time().'.'.$profile->extension();
            $profile->move(public_path('storage/profile'), $profileimageName);

            $profilepath = 'storage/profile/'.$profileimageName;
        }

        if ($request->hasfile('img1')) {

            $img1 = $request->file('img1');

            // File Upload
            $img1Name = time().'_1.'.$img1->extension();
            $img1->move(public_path('storage/studentfile'), $img1Name);

            $img1path = 'storage/studentfile/'.$img1Name;
        }else{
            $img1path = NULL;
        }

        if ($request->hasfile('img2')) {

            $img2 = $request->file('img2');

            // File Upload
            $img2Name = time().'_2.'.$img2->extension();
            $img2->move(public_path('storage/studentfile'), $img2Name);

            $img2path = 'storage/studentfile/'.$img2Name;
        }else{
            $img2path = NULL;
        }

        if ($request->hasfile('img3')) {

            $img3 = $request->file('img3');

            // File Upload
            $img3Name = time().'_3.'.$img3->extension();
            $img3->move(public_path('storage/studentfile'), $img3Name);

            $img3path = 'storage/studentfile/'.$img3Name;
        }else{
            $img3path = NULL;
        }

        if ($request->hasfile('img4')) {

            $img4 = $request->file('img4');

            // File Upload
            $img4Name = time().'_4.'.$img4->extension();
            $img4->move(public_path('storage/studentfile'), $img4Name);

            $img4path = 'storage/studentfile/'.$img4Name;
        }else{
            $img4path = NULL;
        }

        if ($request->hasfile('img5')) {

            $img5 = $request->file('img5');

            // File Upload
            $img5Name = time().'_5.'.$img5->extension();
            $img5->move(public_path('storage/studentfile'), $img5Name);

            $img5path = 'storage/studentfile/'.$img5Name;
        }else{
            $img5path = NULL;
        }

        if ($request->hasfile('img6')) {

            $img6 = $request->file('img6');

            // File Upload
            $img6Name = time().'_6.'.$img6->extension();
            $img6->move(public_path('storage/studentfile'), $img6Name);

            $img6path = 'storage/studentfile/'.$img6Name;
        }else{
            $img6path = NULL;
        }

        $now = Carbon::now();
        $status = 'Active';

        $student_user = new User();
        $student_user->name = $name;
        $student_user->email = $logincodeg1.'.smartcamp.com';
        $student_user->profile_photo_path = $profilepath;
        $student_user->school_id = $authuser->school_id;
        $student_user->email_verified_at = $now;
        $student_user->password = Hash::make($password1);
        $student_user->save();

        $verifyUser = VerifyUser::create([
            'user_id' => $student_user->id,
            'token' => sha1(time())
        ]);
        $student_user->assignRole('Student');

        $student = new Student();
        $student->registerdate = $registerdate;
        $student->medicalproblem = $medicalproblem;
        $student->psn = $previousschoolname;
        $student->nativename = $name;
        $student->gender = $gender;
        $student->dob = $dob;
        $student->address = $address;
        $student->status = $status;
        $student->bio = $bio;
        $student->academicawards = $academicawards;
        $student->otherinterest = $otherinterest;
        $student->ferry = $ferry;
        $student->lunchbox = $lunchbox;
        $student->otherallergy = $otherallergy;
        $student->foodallergy = $foodallergy;
        $student->medicalallergy = $medicationallergy;
        $student->medicalneeds = $medicalneeds;
        $student->dormitory = $dormitory;
        $student->lmir = $img6path;
        $student->tc = $img5path;
        $student->pcm = $img4path;
        $student->idb = $img3path;
        $student->idf = $img2path;
        $student->gbc = $img1path;
        $student->religion_id = $religionid;
        $student->grade_id = $gradeid;
        $student->country_id = $countryid;
        $student->blood_id = $bloodid;
        $student->sport_id = $sportid;
        $student->school_id = $authuser->school_id;
        $student->staff_id = $authuser_id;
        $student->user_id = $student_user->id;
        $student->save();

        $g1_user = new User();
        $g1_user->name = $g1name;
        $g1_user->email = $logincodeg2.'.smartcamp.com';
        $g1_user->school_id = $authuser->school_id;
        $g1_user->email_verified_at = $now;
        $g1_user->password = Hash::make($password2);
        $g1_user->save();
        $g1_user->students()->attach($student->id);

        $verifyUser = VerifyUser::create([
            'user_id' => $g1_user->id,
            'token' => sha1(time())
        ]);
        $g1_user->assignRole('Guardian');

        $g1 = new Guardian();
        $g1->workemail = $g1email;
        $g1->relatiionship = $g1rs;
        $g1->phone = $g1phone;
        $g1->occupation = $g1occupation;
        $g1->user_id = $g1_user->id;
        $g1->staff_id = $authuser_id;
        $g1->save();

        $g2_user = new User();
        $g2_user->name = $g2name;
        $g2_user->email = $logincodeg3.'.smartcamp.com';
        $g2_user->school_id = $authuser->school_id;
        $g2_user->email_verified_at = $now;
        $g2_user->password = Hash::make($password3);
        $g2_user->save();
        $g2_user->students()->attach($student->id);

        $verifyUser = VerifyUser::create([
            'user_id' => $g2_user->id,
            'token' => sha1(time())
        ]);
        $g2_user->assignRole('Guardian');

        $g2 = new Guardian();
        $g2->workemail = $g2email;
        $g2->relatiionship = $g2rs;
        $g2->phone = $g2phone;
        $g2->occupation = $g2occupation;
        $g2->user_id = $g2_user->id;
        $g2->staff_id = $authuser_id;
        $g2->save();

        // return view('backend.student.admission',compact('periods','students'));
        return redirect()->route('master.admission',['student'=>$student->id]);
    }

    public function edit(Student $student){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $school = School::find($authuser->school_id);
        
        $gradeids = [];
        foreach ($school->grades as $grade) {
            array_push($gradeids, $grade->id);
        }

        $grades = Grade::whereIn('id', $gradeids)->get();

        $subjects = Subject::where('school_id', '=', $authuser->school_id)->latest()->get();
        $subjecttypes = Subjecttype::where('school_id', '=', $authuser->school_id)->latest()->get();

        $bloods = Blood::latest()->get();
        $religions = Religion::latest()->get();
        $countries = Country::all();
        $sports = Sport::all();
        // dd($student);
        return view('backend.student.edit',compact('bloods', 'religions', 'subjects','grades','countries','sports','student'));
    }

    public function update(Request $request,Student $student){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $profile = $request->profile; 
        $gender = $request->gender;
        $name = $request->name; 
        $namenative = $request->namenative; 
        $dob = $request->dob; 
        $registerdate = $request->registerdate; 
        $gradeid = $request->gradeid; 
        $previousschoolname = $request->previousschoolname;
        $countryid = $request->countryid;
        $address = $request->address;
        $sportid = $request->sportid;
        $bio = $request->bio;
        $otherinterest = $request->otherinterest;
        $academicawards = $request->academicawards;
        $lunchbox = $request->lunchbox;
        $ferry = $request->ferry;
        $dormitory = $request->dormitory;
        $religionid = $request->religionid; 
        $bloodid = $request->bloodid; 
        $medicalproblem = $request->medicalproblem;
        $medicalneeds = $request->medicalneeds;
        $medicationallergy = $request->medicationallergy;
        $foodallergy = $request->foodallergy;
        $otherallergy = $request->otherallergy;

        $g1name = $request->g1name;
        $g1rs = $request->g1rs;
        $g1phone = $request->g1phone;
        $g1email = $request->g1email;
        $g1occupation = $request->g1occupation;

        $g2name = $request->g2name;
        $g2rs = $request->g2rs;
        $g2phone = $request->g2phone;
        $g2email = $request->g2email;
        $g2occupation = $request->g2occupation;

        $gbc = $request->img1;
        $idf = $request->img2;
        $idb = $request->img3;
        $pcm = $request->img4;
        $tc = $request->img5;
        $lmir = $request->img6;

        $logincodeg1 = $request->logincodeg1;
        $logincodeg2 = $request->logincodeg2;
        $logincodeg3 = $request->logincodeg3;

        $old_gbc = $request->gbc;
        $old_idf = $request->idf;
        $old_idb = $request->idb;
        $old_pcm = $request->pcm;
        $old_tc = $request->tc;
        $old_lmir = $request->lmir;
        $old_profile = $request->oldprofile;

        if ($request->hasfile('profile')) {

            $profile = $request->file('profile');

            // File Upload
            $profileimageName = time().'.'.$profile->extension();
            $profile->move(public_path('storage/profile'), $profileimageName);

            $profilepath = 'storage/profile/'.$profileimageName;
        }else{
            $profilepath = $old_profile;
        }

        if ($request->hasfile('img1')) {

            $img1 = $request->file('img1');

            // File Upload
            $img1Name = time().'_1.'.$img1->extension();
            $img1->move(public_path('storage/studentfile'), $img1Name);

            $img1path = 'storage/studentfile/'.$img1Name;
        }else{
            $img1path = $old_gbc;
        }

        if ($request->hasfile('img2')) {

            $img2 = $request->file('img2');

            // File Upload
            $img2Name = time().'_2.'.$img2->extension();
            $img2->move(public_path('storage/studentfile'), $img2Name);

            $img2path = 'storage/studentfile/'.$img2Name;
        }else{
            $img2path = $old_idf;
        }

        if ($request->hasfile('img3')) {

            $img3 = $request->file('img3');

            // File Upload
            $img3Name = time().'_3.'.$img3->extension();
            $img3->move(public_path('storage/studentfile'), $img3Name);

            $img3path = 'storage/studentfile/'.$img3Name;
        }else{
            $img3path = $old_idb;
        }

        if ($request->hasfile('img4')) {

            $img4 = $request->file('img4');

            // File Upload
            $img4Name = time().'_4.'.$img4->extension();
            $img4->move(public_path('storage/studentfile'), $img4Name);

            $img4path = 'storage/studentfile/'.$img4Name;
        }else{
            $img4path = $old_pcm;
        }

        if ($request->hasfile('img5')) {

            $img5 = $request->file('img5');

            // File Upload
            $img5Name = time().'_5.'.$img5->extension();
            $img5->move(public_path('storage/studentfile'), $img5Name);

            $img5path = 'storage/studentfile/'.$img5Name;
        }else{
            $img5path = $old_tc;
        }

        if ($request->hasfile('img6')) {

            $img6 = $request->file('img6');

            // File Upload
            $img6Name = time().'_6.'.$img6->extension();
            $img6->move(public_path('storage/studentfile'), $img6Name);

            $img6path = 'storage/studentfile/'.$img6Name;
        }else{
            $img6path = $old_lmir;
        }

        $student_user = User::find($student->user->id);
        $student_user->name = $name;
        $student_user->email = $logincodeg1.'.smartcamp.com';
        $student_user->profile_photo_path = $profilepath;
        $student_user->save();

        $student = Student::find($student->id);
        $student->registerdate = $registerdate;
        $student->medicalproblem = $medicalproblem;
        $student->psn = $previousschoolname;
        $student->nativename = $name;
        $student->gender = $gender;
        $student->dob = $dob;
        $student->address = $address;
        // $student->status = $status;
        $student->bio = $bio;
        $student->academicawards = $academicawards;
        $student->otherinterest = $otherinterest;
        $student->ferry = $ferry;
        $student->lunchbox = $lunchbox;
        $student->otherallergy = $otherallergy;
        $student->foodallergy = $foodallergy;
        $student->medicalallergy = $medicationallergy;
        $student->medicalneeds = $medicalneeds;
        $student->dormitory = $dormitory;
        $student->lmir = $img6path;
        $student->tc = $img5path;
        $student->pcm = $img4path;
        $student->idb = $img3path;
        $student->idf = $img2path;
        $student->gbc = $img1path;
        $student->religion_id = $religionid;
        $student->grade_id = $gradeid;
        $student->country_id = $countryid;
        $student->blood_id = $bloodid;
        $student->sport_id = $sportid;
        $student->staff_id = $authuser_id;
        $student->save();

        $g1_user = User::find($student->guardians[0]->user->id);
        $g1_user->name = $g1name;
        $g1_user->email = $logincodeg2.'.smartcamp.com';
        $g1_user->save();

        $g1 = Guardian::find($student->guardians[0]->id);
        $g1->workemail = $g1email;
        $g1->relatiionship = $g1rs;
        $g1->phone = $g1phone;
        $g1->occupation = $g1occupation;
        $g1->staff_id = $authuser_id;
        $g1->save();

        $g2_user = User::find($student->guardians[1]->user->id);
        $g2_user->name = $g2name;
        $g2_user->email = $logincodeg3.'.smartcamp.com';
        $g2_user->save();

        $g2 = Guardian::find($student->guardians[1]->id);
        $g2->workemail = $g2email;
        $g2->relatiionship = $g2rs;
        $g2->phone = $g2phone;
        $g2->occupation = $g2occupation;
        $g2->staff_id = $authuser_id;
        $g2->save();

        // return view('backend.student.admission',compact('periods','students'));
        return redirect()->route('master.student.show',$student->id);

    }
    public function destroy(Student $student)
    {
        $student->delete(); // Easy right?
        
        return redirect('master.student.index');  // -> resources/views/stocks/index.blade.php
    }

    public function passwordreset(Request $request){
        $id = $request->id;
        $password = $request->password;

        
        $user = User::find($id);
        $user->password = Hash::make($password);
        $user->save();

        return response()->json(['success'=>'Password <b> UPDATED </b> successfully.']);
    }

    public function admissionForm(Request $request){

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;
        $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();

        $students = Student::with('user')->where('school_id',$schoolid)->get();
        
        if(request('student')){
            $studentid = $request->student;

            return view('backend.student.admission',compact('periods','students','studentid'));
        }else{
            return view('backend.student.admission',compact('periods','students'));
        }
    }

    public function admissionStore(Request $request)
    {
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $rules = [
            'student'  => 'required',
            'rollno' => 'required',
            'amount'  => 'required',
            'batch'  => 'required',
            'photo' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required'
        ];

        $this->validate($request, $rules);

        $student = $request->student;
        $rollno = $request->rollno;
        $batch = $request->batch;
        $package = $request->package;
        $section = $request->section;
        $amount = $request->amount;
        $date = $request->date;
        
        if ($request->hasfile('photo')) {

            $photo = $request->file('photo');

            // File Upload
            $photoimageName = time().'.'.$photo->extension();
            $photo->move(public_path('storage/paymentslip'), $photoimageName);

            $photopath = 'storage/paymentslip/'.$photoimageName;
        }
        $voucherno = uniqid();

        $hasExist = Studentsegment::where('student_id',$student)->first();

        if($hasExist){
            $type = "old";
        }else{
            $type = "new";
        }

        $studentsegment = new Studentsegment();
        $studentsegment->rollno = $rollno;
        $studentsegment->type = $type;
        $studentsegment->student_id = $student;
        $studentsegment->batch_id = $batch;
        $studentsegment->save();



        $payment = new Payment();
        $payment->voucherno = $voucherno;
        $payment->amount = $amount;
        $payment->photo = $photopath;
        $payment->date = $date;
        $payment->package_id = $package;
        $payment->student_id = $student;
        $payment->staff_id = $authuser_id;
        $payment->school_id = $authuser->school_id;
        $payment->section_id = $section;
        $payment->save();



        return redirect()->back()->with('successmsg', 'Successfully, saved in our database.');

    }

    public function installmentForm(Request $request){

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        if($role[0] == "Guardian"){
            return view('backend.student.installmentlist');
        }
        else{
            $schoolid = $authuser->school_id;
            $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();


            $students = Student::with('user')->where('school_id',$schoolid)->get();

            if(request('packageid')){
                $studentid = $request->student;
                $packageid = $request->packageid;
                $batchid = $request->batchid;

                $package = Package::find($packageid); 

                $section = Section::find($package->section_id);

                $periodid = $section->period_id;
                $sectionid = $section->id;

                return view('backend.student.installment',compact('periods','students','periodid','sectionid','batchid','studentid','packageid'));

            }
            
            else{
                return view('backend.student.installment',compact('periods','students'));
            }
        }

    }

    public function installmentStore(Request $request){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $rules = [
            'student'  => 'required',
            'amount'  => 'required',
            'batch'  => 'required',
            'photo' => 'required',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date' => 'required'
        ];

        $this->validate($request, $rules);

        $student = $request->student;
        $batch = $request->batch;
        $package = $request->package;
        $section = $request->section;
        $amount = $request->amount;
        $date = $request->date;
        
        if ($request->hasfile('photo')) {

            $photo = $request->file('photo');

            // File Upload
            $photoimageName = time().'.'.$photo->extension();
            $photo->move(public_path('storage/paymentslip'), $photoimageName);

            $photopath = 'storage/paymentslip/'.$photoimageName;
        }
        $voucherno = uniqid();

        $payment = new Payment();
        $payment->voucherno = $voucherno;
        $payment->amount = $amount;
        $payment->photo = $photopath;
        $payment->date = $date;
        $payment->package_id = $package;
        $payment->student_id = $student;
        $payment->staff_id = $authuser_id;
        $payment->school_id = $authuser->school_id;
        $payment->section_id = $section;
        $payment->save();

        return redirect()->back()->with('successmsg', 'Successfully, saved in our database.');
    }

    public function transferForm(Request $request){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $schoolid = $authuser->school_id;
        $periods = Period::where('school_id', '=', $schoolid)->orderby('id','DESC')->get();

        $students = Student::with('user')->where('school_id',$schoolid)->get();
        
        if(request('student')){
            $studentid = $request->student;
            return view('backend.student.transfer',compact('students','studentid'));
        }elseif(request('transfer')){
            $transferid = $request->transfer;
            $transfer = Transfer::find($transferid);
            // dd($transfer);
            return view('backend.student.transfer',compact('students','transfer'));

        }
        else{
            return view('backend.student.transfer',compact('students'));
        }
    }
    public function transferStore(Request $request){
        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $role = $authuser->getRoleNames();

        $rules = [
            'student'  => 'required',
            'admitted' => 'required',
            'ay' => 'required',
            'pc'  => 'required',
            'pcy'  => 'required',
            'ppc' => 'required',
            'acyear1' => 'required',
            'dc' => 'required',
            'acyear2' => 'required',
            'desscription' => 'required',
            'approvedate' => 'required',
            'lastattendance' => 'required'

        ];

        $this->validate($request, $rules);

        $studentid = $request->student;
        $admitted = $request->admitted;
        $ay = $request->ay;
        $pc = $request->pc;
        $pcy = $request->pcy;
        $ppc = $request->ppc;
        $acyear1 = $request->acyear1;
        $dc = $request->dc;
        $acyear2 = $request->acyear2;
        $desscription = $request->desscription;
        $approvedate = $request->approvedate;
        $lastattendance = $request->lastattendance;

        $invoiceno = strtotime(now());
        
        $transfer = new Transfer();
        $transfer->invoiceno = $invoiceno;
        $transfer->admitted = $admitted;
        $transfer->ay = $ay;
        $transfer->pc = $pc;
        $transfer->pcy = $pcy;
        $transfer->ppc = $ppc;
        $transfer->acyear1 = $acyear1;
        $transfer->dc = $dc;
        $transfer->acyear2 = $acyear2;
        $transfer->desscription = $desscription;
        $transfer->lastattendance = $lastattendance;
        $transfer->approvedate = $approvedate;

        $transfer->staff_id = $authuser->staff->id;
        $transfer->school_id = $authuser->school_id;
        $transfer->student_id = $studentid;
        $transfer->save();

        $student = Student::find($studentid);
        $student->status = "Transfer";
        $student->save();


        // return redirect()->back()->with('successmsg', 'Successfully, saved in our database.');
        return redirect()->route('master.transfer',['transfer'=>$transfer->id])->with('successmsg', 'Successfully, saved in our database.');

    }

    public function prnpriview(Request $request){
        $transferid = $request->transfer;
        $transfer = Transfer::find($transferid);
        return view('backend.student.prnpriview',compact('transfer'));
    }
}
