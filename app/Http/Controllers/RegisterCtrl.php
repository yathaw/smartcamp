<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Spatie\Permission\Models\Role;
use App\Models\Interest;
use App\Models\Socialmedia;
use App\Models\Softwareanalytic;

use App\Models\Staff;
use App\Models\School;
use App\Models\User;
use App\Models\VerifyUser;
use App\Models\Schooltype;
use App\Models\Grade;
use App\Models\Plan;
use App\Models\Blood;
use App\Models\Religion;
use App\Models\Bank;



use Hashids\Hashids;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Auth;
use UxWeb\SweetAlert\SweetAlert;

class RegisterCtrl extends Controller
{
    public function showRegistrationForm(){

        $roles = Role::whereIn('id', [2,3])->orderBy('name')->get();
        $interests = Interest::latest()->get();
        $socialmedias = Socialmedia::latest()->get();

        return view('auth.register',compact('roles','interests','socialmedias'));

    }

    public function register(Request $request){



        $rules = [
            'name' => 'required|min:3|max:255',
            'roleid' => 'required',
            'email'  =>'required|unique:staff,workemail,NULL,id,deleted_at,NULL|min:3|max:255',
            'password' => 'required|min:8|max:255',
            'countryid' => 'required',
            'phone' => 'required|min:2|max:255',
            'schoolname'  =>'required|min:2|max:255',
            'nos'  =>'required|max:255',
            'socialmedia' => 'required|max:255',
            'interestids' => 'required',
            'socialmediaids' => 'required',
            'reasons' => 'max:255',
            'terms' => 'required'

        ];

        if (App::isLocale('mm')) {
            $customMessages = [
                'name.required' => 'အမည်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'name.min' => 'အမည်အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'name.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'roleid.required' => 'သင့်ရဲ့အခန်းကဏ္ဍအကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'email.required' => 'အီးမေးလ်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'email.unique' => 'ဤအီးမေးလ်ကို ယူထားပြီးဖြစ်သည်။ နောက်တစ်ခုကို စမ်းကြည့်ပါ။',
                'email.min' => 'အီးမေးလ်အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'email.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'password.required' => 'စကားဝှက်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'password.min' => 'စကားဝှက်အကွက်တွင် အနည်းဆုံး စာလုံး 8 လုံး ပါဝင်သင့်သည်။',
                'password.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'countryid.required' => 'နိုင်ငံတစ်နိုင်ငံကို ရွေးပါ။',
                'phone.required' => 'ဖုန်းအကွက်ကို အလွတ်မရနိုင်ပါ။',
                'phone.min' => 'ဖုန်းအကွက်တွင် အနည်းဆုံး စာလုံး 2 လုံးပါရပါမည်။',
                'phone.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'schoolname.required' => 'ကျောင်းအမည်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'schoolname.min' => 'ကျောင်းအမည် အကွက်တွင် အနည်းဆုံး စာလုံး 2 လုံး ပါဝင်သင့်သည်။',
                'schoolname.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'nos.required' => 'ကျောင်းသားဦးရေ အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'nos.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'socialmedia.required' => 'fb page link အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'socialmedia.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'interestids.required' => 'ဤစာကွက်လပ်မှာဖြည့်ရန်လိုအပ်ပါသည်။',
                'socialmediaids.required' => 'ဤစာကွက်လပ်မှာဖြည့်ရန်လိုအပ်ပါသည်။',
                'reasons.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'terms.required' => 'မတင်ပြမီ သဘောတူရမည်။'

            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'name.required' => '名前フィールドを空白にすることはできません。',
                'name.min' => '名前フィールドには、少なくとも3文字を含める必要があります。',
                'name.max' => '最大長255文字に達しました。',
                'roleid.required' => '役割フィールドを空白にすることはできません。',
                'email.required' => 'メールフィールドを空白にすることはできません。',
                'email.unique' => 'このメールはすでに届いています。別のを試してみてください',
                'email.min' => 'メールフィールドには少なくとも3文字を含める必要があります。',
                'email.max' => '最大長255文字に達しました。',
                'password.required' => 'パスワードフィールドを空白にすることはできません。',
                'password.min' => 'パスワードフィールドには、8文字以上を含める必要があります。',
                'password.max' => '最大長255文字に達しました。',
                'countryid.required' => '国の1つを選択してください',
                'phone.required' => '電話フィールドを空白にすることはできません。',
                'phone.min' => '電話フィールドには、少なくとも2文字が含まれている必要があります。',
                'phone.max' => '最大長255文字に達しました。',
                'schoolname.required' => '学校名フィールドを空白にすることはできません。',
                'schoolname.min' => '学校名フィールドには、少なくとも2文字を含める必要があります。',
                'schoolname.max' => '最大長255文字に達しました。',
                'nos.required' => '学生数フィールドを空白にすることはできません。',
                'nos.max' => '最大長255文字に達しました。',
                'socialmedia.required' => 'Facebookページのリンクフィールドを空白にすることはできません。',
                'socialmedia.max' => '最大長255文字に達しました。',
                'interestids.required' => 'この項目は必須です。',
                'socialmediaids.required' => 'この項目は必須です。',
                'reasons.max' => '最大長255文字に達しました。',
                'terms.required' => '送信する前に同意する必要があります。'
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'name.required' => '名称字段不能为空。',
                'name.min' => '名称字段应至少包含 3 个字符。',
                'name.max' => '已达到 255 个字符的最大长度。',
                'roleid.required' => '角色字段不能为空。',
                'email.required' => '电子邮件字段不能为空。',
                'email.unique' => '该E-mail已经采取。尝试另一个',
                'email.min' => '电子邮件字段应至少包含 3 个字符。',
                'email.max' => '已达到 255 个字符的最大长度。',
                'password.required' => '密码字段不能为空。',
                'password.min' => '密码字段应至少包含 8 个字符。',
                'password.max' => '已达到 255 个字符的最大长度。',
                'countryid.required' => '选择国家之一',
                'phone.required' => '电话字段不能为空。',
                'phone.min' => '电话字段应至少包含 2 个字符。',
                'phone.max' => '已达到 255 个字符的最大长度。',
                'schoolname.required' => '学校名称字段不能为空。',
                'schoolname.min' => '学校名称字段应至少包含 2 个字符。',
                'schoolname.max' => '已达到 255 个字符的最大长度。',
                'nos.required' => '学生人数字段不能为空。',
                'nos.max' => '已达到 255 个字符的最大长度。',
                'socialmedia.required' => 'Facebook 页面链接字段不能为空。',
                'socialmedia.max' => '已达到 255 个字符的最大长度。',
                'interestids.required' => '这是必填栏。',
                'socialmediaids.required' => '这是必填栏。',
                'reasons.max' => '已达到 255 个字符的最大长度。',
                'terms.required' => '您必须在提交前同意。'

            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'name.required' => 'Das Namensfeld darf nicht leer sein.',
                'name.min' => 'Das Namensfeld sollte mindestens 3 Zeichen enthalten.',
                'name.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'roleid.required' => 'Das Rollenfeld darf nicht leer sein.',
                'email.required' => 'Das E-Mail-Feld darf nicht leer sein.',
                'email.unique' => 'Diese E-Mail ist schon vergeben. Versuche einen anderen',
                'email.min' => 'Das E-Mail-Feld sollte mindestens 3 Zeichen enthalten.',
                'email.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'password.required' => 'Das Passwortfeld darf nicht leer sein.',
                'password.min' => 'Das Passwortfeld sollte mindestens 8 Zeichen enthalten.',
                'password.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'countryid.required' => 'Wählen Sie eines der Länder aus',
                'phone.required' => 'Das Telefonfeld darf nicht leer sein.',
                'phone.min' => 'Das Telefonfeld sollte mindestens 2 Zeichen enthalten.',
                'phone.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'schoolname.required' => 'Das Feld Schulname darf nicht leer sein.',
                'schoolname.min' => 'Das Feld Schulname sollte mindestens 2 Zeichen enthalten.',
                'schoolname.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'nos.required' => 'Das Feld „Anzahl der Schüler“ darf nicht leer sein.',
                'nos.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'socialmedia.required' => 'Das Linkfeld der Facebook-Seite darf nicht leer sein.',
                'socialmedia.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'interestids.required' => 'Dieses Feld ist erforderlich.',
                'socialmediaids.required' => 'Dieses Feld ist erforderlich.',
                'reasons.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'terms.required' => 'Sie müssen vor dem Absenden zustimmen.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'name.required' => 'Le champ du nom ne peut pas être vide.',
                'name.min' => 'Le champ du nom doit contenir au moins 3 caractères.',
                'name.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'roleid.required' => 'Le champ de rôle ne peut pas être vide.',
                'email.required' => 'Le champ e-mail ne peut pas être vide.',
                'email.unique' => 'Cet e-mail est déjà pris. Essaie un autre',
                'email.min' => 'Le champ email doit contenir au moins 3 caractères.',
                'email.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'password.required' => 'Le champ du mot de passe ne peut pas être vide.',
                'password.min' => 'Le champ du mot de passe doit contenir au moins 8 caractères.',
                'password.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'countryid.required' => "Choisissez l'un des pays",
                'phone.required' => 'Le champ du téléphone ne peut pas être vide.',
                'phone.min' => 'Le champ téléphone doit contenir au moins 2 caractères.',
                'phone.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'schoolname.required' => "Le champ du nom de l'école ne peut pas être vide.",
                'schoolname.min' => "Le champ du nom de l'école doit contenir au moins 2 caractères.",
                'schoolname.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'nos.required' => "Le champ du nombre d'étudiants ne peut pas être vide.",
                'nos.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'socialmedia.required' => 'Le champ du lien vers la page facebook ne peut pas être vide.',
                'socialmedia.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'interestids.required' => 'Ce champ est requis.',
                'socialmediaids.required' => 'Ce champ est requis.',
                'reasons.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'terms.required' => 'Vous devez accepter avant de soumettre.'

            ];
        }
        else{
            $customMessages = [
                'name.required' => 'The name field cannot be blank.',
                'name.min' => 'The name field should contain at least 3 characters.',
                'name.max' => 'The max length of 255 characters is reached.',
                'roleid.required' => 'The role field cannot be blank.',
                'email.required' => 'The email field cannot be blank.',
                'email.unique' => 'This email is already taken. Try Another',
                'email.min' => 'The email field should contain at least 3 characters.',
                'email.max' => 'The max length of 255 characters is reached.',
                'password.required' => 'The password field cannot be blank.',
                'password.min' => 'The password field should contain at least 8 characters.',
                'password.max' => 'The max length of 255 characters is reached.',
                'countryid.required' => 'Choose one of Country',
                'phone.required' => 'The phone field cannot be blank.',
                'phone.min' => 'The phone field should contain at least 2 characters.',
                'phone.max' => 'The max length of 255 characters is reached.',
                'schoolname.required' => 'The school name field cannot be blank.',
                'schoolname.min' => 'The school name field should contain at least 2 characters.',
                'schoolname.max' => 'The max length of 255 characters is reached.',
                'nos.required' => 'The number of students field cannot be blank.',
                'nos.max' => 'The max length of 255 characters is reached.',
                'socialmedia.required' => 'The fb page link field cannot be blank.',
                'socialmedia.max' => 'The max length of 255 characters is reached.',
                'interestids.required' => 'This field is required.',
                'socialmediaids.required' => 'This field is required.',
                'reasons.max' => 'The max length of 255 characters is reached.',
                'terms.required' => 'You must agree before submitting.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $roleid = $request->roleid;
        $email = $request->email;
        $password = $request->password;
        $countryid = $request->countryid;
        $phone = $request->phone;

        $schoolname = $request->schoolname;
        $nos = $request->nos;
        $socialmedia = $request->socialmedia;

        $interestids = $request->interestids;
        $socialmediaids = $request->socialmediaids;
        $reason = $request->reason;
        
        $emailhashids = new Hashids($name);
        $generateEmail = $emailhashids->encode(1, 2, 3); // gPUasb

        $verifyNo = substr(number_format(time() * rand(),0,'',''),0,6);

        $school = School::create([
            'name' => $schoolname,
            'studentamount' => $nos
        ]);

        $user =User::create([
            'name' => $name,
            'email' => $generateEmail.'.smartcamp.com',
            'password' => Hash::make($password),
            'school_id' => $school->id
        ]);

        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1($verifyNo)
        ]);
        $user->assignRole($roleid);

        $staff = Staff::create([
            'workemail' => $email,
            'phone' => json_encode($phone),
            'user_id' => $user->id,
            'country_id' => $countryid,
            'status' => 'Ongoing'
        ]);

        
        $school->socailmedias()->attach(['socialmedia_id'=>1],['link'=>$socialmedia]);


        $softwareanalytic = Softwareanalytic::create([
            'reason' => $reason,
            'user_id' => $user->id,
            'school_id' => $school->id
        ]);

        foreach($interestids as $interestid){
            $softwareanalytic->interests()->attach($interestid, ['school_id'=>$school->id]);
        }

        foreach($socialmediaids as $socialmediaid){
            $softwareanalytic->socialmedias()->attach($socialmediaid, ['school_id'=>$school->id]);
        }

        $email = $email;
        $subject = 'Verify Email Address';
        $from = "smartcamp007@gmail.com";

        $data = [
            "name" => $name,
            "verifyNo" => $verifyNo
        ];

        Mail::send('mail.verifymail', compact('data'), function ($message) use ($email,$from,$subject){

            $message->from($from, 'Smart Camp');

            $message->to($email)->subject($subject);

        }); 

        $hashids = new Hashids('', 10);
        $userid = $hashids->encode($user->id);

        return \Redirect::route('verify', [$userid]);

    }

    public function verifyMail($id){
        $hashids = new Hashids('', 10);
        $decode_userid = $hashids->decode($id);

        $userid = $decode_userid[0];

        $user = User::find($userid);

        return view('auth.verify-email',compact('user', 'userid')); 
    }

    public function verifyResendcode($id){
        $now = Carbon::now();
        $newverifyNo = substr(number_format(time() * rand(),0,'',''),0,6);

        $user = User::find($id);

        $data = array(
            'token'  =>  sha1($newverifyNo),
            'created_at'  =>  $now->toDateTimeString(),
            'updated_at'  =>  $now->toDateTimeString()
        );

        VerifyUser::where('id',$id)->update($data);

        $email = $user->staff->workemail;
        $subject = 'Verify Email Address';
        $from = "smartcamp007@gmail.com";

        $data = [
            "name" => $user->name,
            "verifyNo" => $newverifyNo
        ];

        Mail::send('mail.verifymail', compact('data'), function ($message) use ($email,$from,$subject){

            $message->from($from, 'Smart Camp');

            $message->to($email)->subject($subject);

        }); 

        return response()->json(['success'=>'Verify Code <b> resend </b> successfully.']);

    }

    public function verifyUser(Request $request){
        $id = $request->id;

        $number1 = $request->number1;
        $number2 = $request->number2;
        $number3 = $request->number3;
        $number4 = $request->number4;
        $number5 = $request->number5;
        $number6 = $request->number6;

        if (App::isLocale('mm')) {
            $customMessages = [
                'expired' => 'အတည်ပြုကုဒ် သက်တမ်းကုန်သွားပါပြီ။ ကုဒ်အသစ်တစ်ခုတောင်းဆိုပါ။',
                'incorrect' => 'သင်ထည့်လိုက်သောကုဒ်သည် မမှန်ပါ။',
                'successTitle' => "သင့်အားအတည်ပြုပြီးပါပြီ။",
                'successText' => "သင့်အကောင့်ကို အောင်မြင်စွာ အတည်ပြုပြီးပါပြီ။ လိမ်လည်မှု နှင့် တုပမှုရန်က ကာကွယ်ရန် ကျွန်ုပ်တို့ကို ကူညီသည့်အတွက် ကျေးဇူးတင်ပါသည်။ သင်သည် SMART CAMP ၏ အစိတ်အပိုင်းတစ်ခုဖြစ်သည်။"
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'expired' => '確認コードの有効期限が切れています。新しいコードをリクエストします。',
                'incorrect' => '入力したコードが正しくありません。',
                'successTitle' => "あなたは確認されました！",
                'successText' => "アカウントは正常に確認されました。キャットフィッシャーや詐欺師との戦いにご協力いただきありがとうございます。あなたはSMARTCAMPの一員です。"
            ];
            
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'expired' => '验证码已过期。请求新代码。',
                'incorrect' => '您输入的代码不正确。',
                'successTitle' => "您已验证！",
                'successText' => "您的帐户已成功验证。感谢您帮助我们打击鲶鱼和骗子。您是 SMART CAMP 的一员。"
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'expired' => 'Der Bestätigungscode ist abgelaufen. Fordern Sie einen neuen Code.',
                'incorrect' => 'Der eingegebene Code ist falsch.',
                'successTitle' => "Sie sind verifiziert!",
                'successText' => "Ihr Konto wurde erfolgreich verifiziert. Vielen Dank, dass Sie uns helfen, Catfisher und Betrüger zu bekämpfen. Du bist ein Teil des SMART CAMP."
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'expired' => 'Le code de vérification a expiré. Demander un nouveau code.',
                'incorrect' => 'Le code que vous avez entré est incorrect.',
                'successTitle' => "Vous êtes vérifié!",
                'successText' => "Votre compte a été vérifié avec succès. Merci de nous aider à combattre les pêcheurs de chat et les escrocs. Vous faites partie du SMART CAMP."
            ];
        }
        else{
            $customMessages = [
                'expired' => 'Verification Code has expired. Request a new code.',
                'incorrect' => 'The code you entered is incorrect.',
                'successTitle' => "Your're Verified!",
                'successText' => "Your account has been successfully verified. Thank you for helping us battle catfishers and scammers. You're a part of the SMART CAMP."
            ];
        }

        $inputNumber = $number1.$number2.$number3.$number4.$number5.$number6;
        $sha1verifyNumber = sha1($inputNumber);

        $user = User::find($id);
        $dbverifyNumber = $user->verifyUser->token;
        $dbverifyCreatedat = $user->verifyUser->created_at;

        if ($sha1verifyNumber == $dbverifyNumber) {

            $expireTime = Carbon::parse($dbverifyCreatedat)->addHour();
            $currentTime = Carbon::now();

            if($currentTime <= $expireTime){
                $user->email_verified_at = $currentTime;
                $user->save();

                Auth::loginUsingId($id);


                SweetAlert::success($customMessages['successTitle'], $customMessages['successText'])->autoclose(3500);

                return \Redirect::route('procedure');


            }else{
                
                return redirect()->back()->with('error',$customMessages['expired']);
            }

        }else{
            return redirect()->back()->with('error',$customMessages['incorrect']);
        }

        return view('auth.verify-email'); 
        
    }

    public function procedure(){
        $authuser = Auth::user();
        $authuser_id = Auth::id();

        $user = User::find($authuser_id);
        $schooltypes = Schooltype::all();
        $grades = Grade::all();
        $plans = Plan::all();
        $bloods = Blood::all();
        $religions = Religion::all();
        $banks = Bank::whereIn('id',[2,3,4,5])->get();

        return view('auth.procedure',compact('user','schooltypes','grades','plans','bloods', 'religions', 'banks'));
    }

    public function procedureAction(Request $request){
        $rules = [
            'profile' => 'required',
            'profile.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|min:3|max:255',
            'bloodid' => 'required',
            'religionid' => 'required',
            'nrc' => 'required|min:3|max:255',
            'degree' => 'required|min:3|max:255',
            'gender' => 'required',
            'dob' => 'required|date',
            'jod' => 'required|date',
            'address' => 'required|min:3|max:255',
            'planid' => 'required',
            'logo' => 'required',
            'logo.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'schoolname' => 'required|min:3|max:255',
            'schooltypeid' => 'required',
            'mottoes' => 'required|string|min:10|max:255',
            'cityid' => 'required',
            'schooladdress' => 'required|string|min:3|max:255',
            'gradeids' => 'required',
            'credicard' => 'required',
            'number' => 'required',
            'number1' => 'required',
            'number2' => 'required',
            'number3' => 'required',
            'cardholdername' => 'required',
            'cardmonth' => 'required',
            'cardyear' => 'required',
            'ccv' => 'required',
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

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
                'bloodid.required' => 'သွေးကွက်လပ်မဖြစ်နိုင်ပါ။',
                'religionid.required' => 'ဘာသာရေးအကွက်ကို အလွတ်မရနိုင်ပါ။',
                'nrc.required' => 'နိုင်ငံသားစိစစ်ရေးအကွက်မှာ ကွက်လပ်မရှိနိုင်ပါ။',
                'nrc.min' => 'နိုင်ငံသားများ မှတ်ပုံတင်ရေးအကွက်တွင် အနည်းဆုံး စာလုံး ၃ လုံး ပါဝင်သင့်သည်။',
                'nrc.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'degree.required' => 'ဘွဲ့လက်မှတ်အကွက်ကို အလွတ်မရနိုင်ပါ။',
                'degree.min' => 'ဘွဲ့လက်မှတ်အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'degree.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'gender.required' => 'ကျားမအကွက်ကို အလွတ်မရနိုင်ပါ။',
                'dob.required' => 'မွေးသက္ကရာဇ်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'dob.date' => 'မွေးသက္ကရာဇ်အကွက်သည် ရက်စွဲဖြစ်ရမည်။',
                'jod.required' => 'အလုပ်ဆင်းသည့်ရက်ဆွဲ အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'jod.date' => 'အလုပ်ဆင်းသည့်ရက်ဆွဲ အကွက်သည် ရက်စွဲဖြစ်ရမည်။',
                'address.required' => 'လိပ်စာအကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'address.min' => 'လိပ်စာအကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'address.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'planid.required' => 'စျေးနှုန်းအစီအစဉ်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'logo.required' => 'လိုဂိုအကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'logo.image' => 'လိုဂိုအကွက်သည် ပုံတစ်ပုံဖြစ်ရပါမည်။',
                'logo.mimes' => 'ဖိုင်အမျိုးအစားသည် jpeg,jpg,png,gif,svg ဖြစ်ရပါမည်။',
                'logo.max' => 'ဓာတ်ပုံသည် 2048 ကီလိုဘိုက်ထက် မကြီးရပါ။',
                'schoolname.required' => 'ကျောင်းအမည်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'schoolname.min' => 'ကျောင်းအမည် အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'schoolname.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'mottoes.required' => 'ဆောင်ပုဒ်အကွက်ကို အလွတ်မရနိုင်ပါ။',
                'mottoes.min' => 'ဆောင်ပုဒ်အကွက်တွင် အနည်းဆုံး စာလုံး 10 လုံး ပါဝင်သင့်သည်။',
                'mottoes.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'mottoes.string' => 'ဆောင်ပုဒ်အကွက်သည် စာသားဖြစ်ရမည်။',
                'cityid.required' => 'မြို့ကို ကွက်လပ်ထား၍မရပါ။',
                'schooladdress.required' => 'ကျောင်းလိပ်စာအကွက်ကို အလွတ်မရနိုင်ပါ။',
                'schooladdress.min' => 'ကျောင်းလိပ်စာအကွက်တွင် အနည်းဆုံး စာလုံး 10 လုံး ပါဝင်သင့်သည်။',
                'schooladdress.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'schooladdress.string' => 'ကျောင်းလိပ်စာအကွက်သည် စာကြောင်းတစ်ကြောင်းဖြစ်ရမည်။',
                'gradeids.required' => 'အဆင့်အကွက်ကို ကွက်လပ်ထား၍မရပါ။',
                'credicard.required' => 'ဤဆော့ဖ်ဝဲလ်တွင် အသုံးပြုရန် နှစ်သက်သောနည်းလမ်းကို ရွေးချယ်ပါ။',
                'number.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'number1.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'number2.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'number3.required' => 'ကတ်နံပါတ်အကွက် လိုအပ်သည်။',
                'cardholdername.required' => 'ကတ်ကိုင်ဆောင်သူအမည် အကွက် လိုအပ်သည်။',
                'cardmonth.required' => 'ကတ်သက်တမ်းကုန်ဆုံးသည့်လအကွက် လိုအပ်သည်။',
                'cardyear.required' => 'ကတ်သက်တမ်းကုန်ဆုံးသည့်နှစ်အကွက် လိုအပ်သည်။',
                'ccv.required' => 'ccv အကွက် လိုအပ်သည်။'
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
                'bloodid.required' => '血液フィールドを空白にすることはできません。',
                'religionid.required' => '宗教フィールドを空白にすることはできません。',
                'nrc.required' => '市民の全国登録フィールドを空白にすることはできません。',
                'nrc.min' => '市民の全国登録フィールドには、少なくとも3文字が含まれている必要があります。',
                'nrc.max' => '最大長255文字に達しました。',
                'degree.required' => '学位フィールドを空白にすることはできません。',
                'degree.min' => '学位フィールドには、少なくとも3文字が含まれている必要があります。',
                'degree.max' => '最大長255文字に達しました。',
                'gender.required' => '性別フィールドを空白にすることはできません。',
                'dob.required' => '生年月日フィールドを空白にすることはできません。',
                'dob.date' => '生年月日フィールドは日付である必要があります。',
                'jod.required' => '日付の結合フィールドを空白にすることはできません。',
                'jod.date' => '日付フィールドの結合は日付でなければなりません。',
                'address.required' => 'アドレスフィールドを空白にすることはできません。',
                'address.min' => 'アドレスフィールドには、少なくとも3文字を含める必要があります。',
                'address.max' => '最大長255文字に達しました。',
                'planid.required' => '価格プランフィールドを空白にすることはできません。.',
                'logo.required' => 'ロゴフィールドを空白にすることはできません。',
                'logo.image' => 'ロゴフィールドは画像である必要があります。',
                'logo.mimes' => 'ファイルタイプはjpeg、jpg、png、gif、svgである必要がありますs',
                'logo.max' => '写真は2048キロバイトを超えてはなりません。',
                'schoolname.required' => '学校名フィールドを空白にすることはできません。',
                'schoolname.min' => '学校名フィールドには、少なくとも3文字を含める必要があります。',
                'schoolname.max' => '最大長255文字に達しました。',
                'mottoes.required' => 'モットーフィールドを空白にすることはできません。',
                'mottoes.min' => 'モットーフィールドには、少なくとも10文字が含まれている必要があります。',
                'mottoes.max' => '最大長255文字に達しました。',
                'mottoes.string' => 'モットーフィールドは文字列である必要があります。',
                'cityid.required' => '都市フィールドを空白にすることはできません。',
                'schooladdress.required' => '学校の住所フィールドを空白にすることはできません。',
                'schooladdress.min' => '学校の住所フィールドには、少なくとも10文字を含める必要があります。',
                'schooladdress.max' => '最大長255文字に達しました。',
                'schooladdress.string' => '学校の住所フィールドは文字列である必要があります。',
                'gradeids.required' => 'グレードフィールドを空白にすることはできません。',
                'credicard.required' => 'このソフトウェアで使用する優先方法を選択してください。',
                'number.required' => 'カード番号フィールドは必須です。s',
                'number1.required' => 'カード番号フィールドは必須です。',
                'number2.required' => 'カード番号フィールドは必須です。',
                'number3.required' => 'カード番号フィールドは必須です。',
                'cardholdername.required' => 'カード所有者名フィールドは必須です。',
                'cardmonth.required' => 'カードの有効期限の月のフィールドは必須です。',
                'cardyear.required' => 'カードの有効期限フィールドは必須です。',
                'ccv.required' => 'ccvフィールドは必須です。'
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
                'bloodid.required' => '血域不能为空。',
                'religionid.required' => '宗教字段不能为空。',
                'nrc.required' => '国家公民登记字段不能为空。',
                'nrc.min' => '公民的国家注册字段应包含至少 3 个字符。',
                'nrc.max' => '已达到 255 个字符的最大长度。',
                'degree.required' => '学位字段不能为空。',
                'degree.min' => '学位字段应至少包含 3 个字符。',
                'degree.max' => '已达到 255 个字符的最大长度。',
                'gender.required' => '性别字段不能为空。',
                'dob.required' => '出生日期字段不能为空。',
                'dob.date' => '出生日期字段必须是日期。',
                'jod.required' => '日期字段的连接不能为空。',
                'jod.date' => '日期字段的连接必须是日期。',
                'address.required' => '地址字段不能为空。',
                'address.min' => '地址字段应至少包含 3 个字符。',
                'address.max' => '已达到 255 个字符的最大长度。',
                'planid.required' => '价格计划字段不能为空。',
                'logo.required' => '徽标字段不能为空。',
                'logo.image' => '徽标字段必须是图像。',
                'logo.mimes' => '文件类型必须为 jpeg,jpg,png,gif,svg',
                'logo.max' => '照片不得超过 2048 KB。',
                'schoolname.required' => '学校名称字段不能为空。',
                'schoolname.min' => '学校名称字段应至少包含 3 个字符。',
                'schoolname.max' => '已达到 255 个字符的最大长度。',
                'mottoes.required' => '座右铭字段不能为空。',
                'mottoes.min' => '座右铭字段应包含至少 10 个字符。',
                'mottoes.max' => '已达到 255 个字符的最大长度。',
                'mottoes.string' => '格言字段必须是字符串。',
                'cityid.required' => '城市字段不能为空。',
                'schooladdress.required' => '学校地址字段不能为空。',
                'schooladdress.min' => '学校地址字段应至少包含 10 个字符。',
                'schooladdress.max' => '已达到 255 个字符的最大长度。',
                'schooladdress.string' => '学校地址字段必须是字符串。',
                'gradeids.required' => '成绩字段不能为空。',
                'credicard.required' => '请选择在此软件上使用的首选方法。s',
                'number.required' => '卡号字段是必需的。',
                'number1.required' => '卡号字段是必需的。',
                'number2.required' => '卡号字段是必需的。',
                'number3.required' => '卡号字段是必需的。',
                'cardholdername.required' => '持卡人姓名字段为必填项。',
                'cardmonth.required' => '卡到期月份字段为必填项。',
                'cardyear.required' => '卡到期年份字段为必填项。',
                'ccv.required' => 'ccv 字段是必需的。'
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
                'bloodid.required' => 'Das Blutfeld darf nicht leer sein.',
                'religionid.required' => 'Das Religionsfeld darf nicht leer sein.',
                'nrc.required' => 'Das Feld Nationale Registrierung von Bürgern darf nicht leer sein.',
                'nrc.min' => 'Das Feld Nationale Registrierung von Bürgern sollte mindestens 3 Zeichen enthalten.',
                'nrc.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'degree.required' => 'Das Abschlussfeld darf nicht leer sein.',
                'degree.min' => 'Das Abschlussfeld sollte mindestens 3 Zeichen enthalten.',
                'degree.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'gender.required' => 'Das Geschlechtsfeld darf nicht leer sein.',
                'dob.required' => 'Das Feld Geburtsdatum darf nicht leer sein.',
                'dob.date' => 'Das Feld für das Geburtsdatum muss date sein.',
                'jod.required' => 'Das Feld Beitrittsdatum darf nicht leer sein.',
                'jod.date' => 'Das Join-of-Datumsfeld muss date sein.',
                'address.required' => 'Das Adressfeld darf nicht leer sein.',
                'address.min' => 'Das Adressfeld sollte mindestens 3 Zeichen enthalten.',
                'address.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'planid.required' => 'Das Feld Preisplan darf nicht leer sein.',
                'logo.required' => 'Das Logofeld darf nicht leer sein.',
                'logo.image' => 'Das Logofeld muss ein Bild sein.',
                'logo.mimes' => 'Der Dateityp muss JPEG, JPG, PNG, GIF oder SVG sein',
                'logo.max' => 'Das Foto darf nicht größer als 2048 Kilobyte sein.',
                'schoolname.required' => 'Das Feld Schulname darf nicht leer sein.',
                'schoolname.min' => 'Das Feld Schulname sollte mindestens 3 Zeichen enthalten.',
                'schoolname.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'mottoes.required' => 'Das Motto-Feld darf nicht leer sein.',
                'mottoes.min' => 'Das Motto-Feld sollte mindestens 10 Zeichen enthalten.',
                'mottoes.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'mottoes.string' => 'Das Motto-Feld muss eine Zeichenfolge sein.',
                'cityid.required' => 'Das Stadtfeld darf nicht leer sein.',
                'schooladdress.required' => 'Das Adressfeld der Schule darf nicht leer sein.',
                'schooladdress.min' => 'Das Adressfeld der Schule sollte mindestens 10 Zeichen enthalten.',
                'schooladdress.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'schooladdress.string' => 'Das Adressfeld der Schule muss eine Zeichenfolge sein.',
                'gradeids.required' => 'Das Notenfeld darf nicht leer sein.',
                'credicard.required' => 'Bitte wählen Sie die bevorzugte Methode für diese Software aus.',
                'number.required' => 'Das Feld Kartennummer ist erforderlich.',
                'number1.required' => 'Das Feld Kartennummer ist erforderlich.',
                'number2.required' => 'Das Feld Kartennummer ist erforderlich.',
                'number3.required' => 'Das Feld Kartennummer ist erforderlich.',
                'cardholdername.required' => 'Das Feld Name des Karteninhabers ist erforderlich.',
                'cardmonth.required' => 'Das Feld für den Ablaufmonat der Karte ist erforderlich.',
                'cardyear.required' => 'Das Feld für das Ablaufjahr der Karte ist erforderlich.',
                'ccv.required' => 'Das ccv-Feld ist erforderlich.'
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
                'bloodid.required' => 'Le champ de sang ne peut pas être vide.',
                'religionid.required' => 'Le champ religion ne peut pas être vide.',
                'nrc.required' => 'Le champ Enregistrement national des citoyens ne peut pas être vide.',
                'nrc.min' => 'Le champ Enregistrement national des citoyens doit contenir au moins 3 caractères.',
                'nrc.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'degree.required' => 'Le champ diplôme ne peut pas être vide.',
                'degree.min' => 'Le champ diplôme doit contenir au moins 3 caractères.',
                'degree.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'gender.required' => 'Le champ sexe ne peut pas être vide.',
                'dob.required' => 'Le champ de la date de naissance ne peut pas être vide.',
                'dob.date' => 'Le champ de la date de naissance doit être la date.',
                'jod.required' => 'Le champ de jointure de date ne peut pas être vide.',
                'jod.date' => 'Le champ de jointure de date doit être la date.',
                'address.required' => "Le champ d'adresse ne peut pas être vide.",
                'address.min' => "Le champ d'adresse doit contenir au moins 3 caractères.",
                'address.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'planid.required' => 'Le champ du plan tarifaire ne peut pas être vide.',
                'logo.required' => 'Le champ du logo ne peut pas être vide.',
                'logo.image' => 'Le champ du logo doit être une image.',
                'logo.mimes' => 'Le type de fichier doit être au format jpeg, jpg, png, gif, svg',
                'logo.max' => 'La photo ne doit pas dépasser 2048 kilo-octets.',
                'schoolname.required' => "Le champ du nom de l'école ne peut pas être vide.",
                'schoolname.min' => "Le champ du nom de l'école doit contenir au moins 3 caractères.",
                'schoolname.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'mottoes.required' => 'Le champ des devises ne peut pas être vide.',
                'mottoes.min' => 'Le champ Devises doit contenir au moins 10 caractères.',
                'mottoes.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'mottoes.string' => 'Le champ Devises doit être une chaîne.',
                'cityid.required' => 'Das Stadtfeld darf nicht leer sein.',
                'schooladdress.required' => 'Das Adressfeld der Schule darf nicht leer sein.',
                'schooladdress.min' => "Le champ d'adresse de l'école doit contenir au moins 10 caractères.",
                'schooladdress.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'schooladdress.string' => "Le champ d'adresse de l'école doit être une chaîne.",
                'gradeids.required' => 'Le champ de note ne peut pas être vide.',
                'credicard.required' => 'Veuillez sélectionner la méthode préférée à utiliser sur ce logiciel.',
                'number.required' => 'Le champ du numéro de carte est obligatoire.',
                'number1.required' => 'Le champ du numéro de carte est obligatoire.',
                'number2.required' => 'Le champ du numéro de carte est obligatoire.',
                'number3.required' => 'Le champ du numéro de carte est obligatoire.',
                'cardholdername.required' => 'Le champ du nom du titulaire de la carte est obligatoire.',
                'cardmonth.required' => "Le champ du mois d'expiration de la carte est obligatoire.",
                'cardyear.required' => "Le champ Année d'expiration de la carte est obligatoire.",
                'ccv.required' => 'Le champ ccv est obligatoire.'
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
                'bloodid.required' => 'The blood field cannot be blank.',
                'religionid.required' => 'The religion field cannot be blank.',
                'nrc.required' => 'The nrc field cannot be blank.',
                'nrc.min' => 'The nrc field should contain at least 3 characters.',
                'nrc.max' => 'The max length of 255 characters is reached.',
                'degree.required' => 'The degree field cannot be blank.',
                'degree.min' => 'The degree field should contain at least 3 characters.',
                'degree.max' => 'The max length of 255 characters is reached.',
                'gender.required' => 'The gender field cannot be blank.',
                'dob.required' => 'The dob field cannot be blank.',
                'dob.date' => 'The dob field must be date.',
                'jod.required' => 'The jod field cannot be blank.',
                'jod.date' => 'The jod field must be date.',
                'address.required' => 'The address field cannot be blank.',
                'address.min' => 'The address field should contain at least 3 characters.',
                'address.max' => 'The max length of 255 characters is reached.',
                'planid.required' => 'The plan field cannot be blank.',
                'logo.required' => 'The logo field cannot be blank.',
                'logo.image' => 'The logo field must be an image.',
                'logo.mimes' => 'File Type must be in jpeg,jpg,png,gif,svg',
                'logo.max' => 'The photo may not be greater than 2048 kilobytes.',
                'schoolname.required' => 'The school name field cannot be blank.',
                'schoolname.min' => 'The school name field should contain at least 3 characters.',
                'schoolname.max' => 'The max length of 255 characters is reached.',
                'mottoes.required' => 'The mottoes field cannot be blank.',
                'mottoes.min' => 'The mottoes field should contain at least 10 characters.',
                'mottoes.max' => 'The max length of 255 characters is reached.',
                'mottoes.string' => 'The mottoes field must be a string.',
                'cityid.required' => 'The city field cannot be blank.',
                'schooladdress.required' => 'The school address field cannot be blank.',
                'schooladdress.min' => 'The school address field should contain at least 10 characters.',
                'schooladdress.max' => 'The max length of 255 characters is reached.',
                'schooladdress.string' => 'The school address field must be a string.',
                'gradeids.required' => 'The grade field cannot be blank.',
                'credicard.required' => 'Please select preferred method to use on this software.',
                'number.required' => 'The card number field is required.',
                'number1.required' => 'The card number field is required.',
                'number2.required' => 'The card number field is required.',
                'number3.required' => 'The card number field is required.',
                'cardholdername.required' => 'The card holder name field is required.',
                'cardmonth.required' => 'The card expiration month field is required.',
                'cardyear.required' => 'The card expiration year field is required.',
                'ccv.required' => 'The ccv field is required.',
                'description.required' => 'The description field is required.',
                'imagess.required' => 'The cover photo field cannot be blank.',
                'imagess.image' => 'The cover photo field must be an image.',
                'imagess.mimes' => 'File Type must be in jpeg,jpg,png,gif,svg',
                'imagess.max' => 'The photo may not be greater than 2048 kilobytes.',
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $name = $request->name;
        $bloodid = $request->bloodid;
        $religionid = $request->religionid;
        $nrc = $request->nrc;
        $degree = $request->degree;
        $gender = $request->gender;

        $dob = $request->dob;
        $jod = $request->jod;
        $address = $request->address;

        $planid = $request->planid;

        $schoolname = $request->schoolname;
        $schooltypeid = $request->schooltypeid;
        $mottoes = $request->mottoes;
        $established = $request->established;
        $cityid = $request->cityid;
        $schooladdress = $request->schooladdress;
        $gradeids = $request->gradeids;

        $description = $request->description;


        $data=[];

        if ($request->hasfile('images')) {
            $i=1;

            foreach($request->file('images') as $image)
            {
                // File Upload
                $imageName = time().$i.'.'.$image->extension();
                $image->move(public_path('storage/schoolcover'), $imageName);

                $path = 'storage/schoolcover/'.$imageName;
                array_push($data, $path);
                    $i++;

            }
        }
        $coverphoto = json_encode($data);

        if ($request->hasfile('logo')) {

            $logo = $request->file('logo');

            // File Upload
            $logoimageName = time().'.'.$logo->extension();
            $logo->move(public_path('storage/schoollogo'), $logoimageName);

            $logopath = 'storage/schoollogo/'.$logoimageName;
        }

        if ($request->hasfile('profile')) {

            $profile = $request->file('profile');

            // File Upload
            $profileimageName = time().'.'.$profile->extension();
            $profile->move(public_path('storage/profile'), $profileimageName);

            $profilepath = 'storage/profile/'.$profileimageName;
        }

        $authuser = Auth::user();
        $authuser_id = Auth::id();
        $schoolid = $authuser->school_id;

        $school = School::find($schoolid);
        $school->name = $schoolname;
        $school->logo = $logopath;
        $school->coverphoto = $coverphoto;
        $school->address = $schooladdress;
        $school->about = $description;
        $school->mottoes = $mottoes;
        $school->established = $established;
        $school->city_id = $cityid;
        $school->schooltype_id = $schooltypeid;
        $school->save();

        foreach ($gradeids as $grade) {
            $school->grades()->attach($grade);
        }

        $user = User::find($authuser_id);
        $user->name = $name;
        $user->profile_photo_path = $profilepath;
        $user->save();

        $school->plans()->attach($planid,['user_id' => $user->id]);


        $status = 'Active';

        $staff = Staff::where('user_id',$authuser_id)->firstOrFail();
        $staff->gender = $gender;
        $staff->degree = json_encode($degree);
        $staff->nrc = $nrc;
        $staff->dob = $dob;
        $staff->address = $address;
        $staff->status = $status;
        $staff->joindate = $jod;
        $staff->blood_id = $bloodid;
        $staff->religion_id = $religionid;
        $staff->user_id = $user->id;
        $staff->save();

        return \Redirect::route('controlpanel');


    }

}
