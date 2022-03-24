<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\App;

class LoginCtrl extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        $rules = [
            'email'  =>'required|min:3|max:255',
            'password' => 'required|min:8|max:255',
        ];
        if (App::isLocale('mm')) {
            $customMessages = [
                'email.required' => 'အီးမေးလ်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'email.min' => 'အီးမေးလ်အကွက်တွင် အနည်းဆုံး စာလုံး 3 လုံး ပါဝင်သင့်သည်။',
                'email.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။',
                'password.required' => 'စကားဝှက်အကွက်သည် ကွက်လပ်မဖြစ်ရပါ။',
                'password.min' => 'စကားဝှက်အကွက်တွင် အနည်းဆုံး စာလုံး 8 လုံး ပါဝင်သင့်သည်။',
                'password.max' => 'အများဆုံး စာလုံး 255 လုံး၏ အရှည်ကို ရောက်ပါပြီ။'
            ];
        }
        else if (App::isLocale('jp')) {
            $customMessages = [
                'email.required' => 'メールフィールドを空白にすることはできません。',
                'email.min' => 'メールフィールドには少なくとも3文字を含める必要があります。',
                'email.max' => '最大長255文字に達しました。',
                'password.required' => 'パスワードフィールドを空白にすることはできません。',
                'password.min' => 'パスワードフィールドには、8文字以上を含める必要があります。',
                'password.max' => '最大長255文字に達しました。'
            ];
        }
        else if (App::isLocale('cn')) {
            $customMessages = [
                'email.required' => '电子邮件字段不能为空。',
                'email.min' => '电子邮件字段应至少包含 3 个字符。',
                'email.max' => '已达到 255 个字符的最大长度。',
                'password.required' => '密码字段不能为空。',
                'password.min' => '密码字段应至少包含 8 个字符。',
                'password.max' => '已达到 255 个字符的最大长度。'
            ];
        }
        else if (App::isLocale('de')) {
            $customMessages = [
                'email.required' => 'Das E-Mail-Feld darf nicht leer sein.',
                'email.min' => 'Das E-Mail-Feld sollte mindestens 3 Zeichen enthalten.',
                'email.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.',
                'password.required' => 'Das Passwortfeld darf nicht leer sein.',
                'password.min' => 'Das Passwortfeld sollte mindestens 8 Zeichen enthalten.',
                'password.max' => 'Die maximale Länge von 255 Zeichen ist erreicht.'
            ];
        }
        else if (App::isLocale('fr')) {
            $customMessages = [
                'email.required' => 'Le champ e-mail ne peut pas être vide.',
                'email.min' => 'Le champ email doit contenir au moins 3 caractères.',
                'email.max' => 'La longueur maximale de 255 caractères est atteinte.',
                'password.required' => 'Le champ du mot de passe ne peut pas être vide.',
                'password.min' => 'Le champ du mot de passe doit contenir au moins 8 caractères.',
                'password.max' => 'La longueur maximale de 255 caractères est atteinte.'
            ];
        }
        else{
            $customMessages = [
                'email.required' => 'The email field cannot be blank.',
                'email.min' => 'The email field should contain at least 3 characters.',
                'email.max' => 'The max length of 255 characters is reached.',
                'password.required' => 'The password field cannot be blank.',
                'password.min' => 'The password field should contain at least 8 characters.',
                'password.max' => 'The max length of 255 characters is reached.'
            ];
        }

        $this->validate($request, $rules, $customMessages);

        $email = $request->email.".smartcamp.com";
        $password = Hash::make($request->password);

        $user= User::where('email', '=', $email)->first();

        if (App::isLocale('mm')) {
            $authcustomMessages = [
                'invalid' => "ဝမ်းနည်းပါသည်၊ ဤအီးမေးလ်လိပ်စာပါသော အကောင့်တစ်ခုကို ကျွန်ုပ်တို့ ရှာမတွေ့ပါ။ ကျေးဇူးပြု၍ ထပ်စမ်းကြည့်ပါ သို့မဟုတ် အကောင့်အသစ်တစ်ခု ဖန်တီးပါ။",
                'notVerified' => "ကျွန်ုပ်တို့သည် သင့်အား အတည်ပြုကုဒ် ပေးပို့ထားပါသည်။ သင်၏အီးမေးလ်ကိုစစ်ဆေးပါ။ အကယ်၍ သင့် အီးမေးလ်သည် အတည်ပြုကုဒ် လက်ခံရရှိခြင်းမရှိပါက၊ ကုဒ်အသစ်တစ်ခုတောင်းဆိုပါ။",
                "incorrectPassword" => "သင်ထည့်လိုက်သော စကားဝှက်သည် မမှန်ပါ။ ထပ်စမ်းကြည့်ပါ။",
                'loginFailure' => "ထိုအကောင့်မှာဝင်ရောက်ခွင့်မရှိသဖြင့် သင့်စီမံခန့်ခွဲသူကို ဆက်သွယ်ပါ။"

            ];
        }
        else if (App::isLocale('jp')) {
            $authcustomMessages = [
                'invalid' => "申し訳ありませんが、このメールアドレスのアカウントが見つかりません。もう一度試すか、新しいアカウントを作成してください。",
                'notVerified' => "アクティベーションコードをお送りしました。あなたのメールをチェック。メールが届かない場合は、別のメールをお送りします。",
                "incorrectPassword" => "あなたの入力したパスワードに誤りがあります。もう一度やり直してください。",
                'loginFailure' => "ユーザーが存在しないか、ログインアクセス権がないことを入力してください。詳細については、管理者に問い合わせてください。"

            ];
        }
        else if (App::isLocale('cn')) {
            $authcustomMessages = [
                'invalid' => "抱歉，我们找不到使用此电子邮件地址的帐户。请重试或创建一个新帐户。",
                'notVerified' => "我们向您发送了激活码。查看你的邮件。如果您没有收到这封电子邮件，我们很乐意再给您发送一封。",
                "incorrectPassword" => "您输入密码不正确。请再试一次。",
                'loginFailure' => "输入用户不存在或没有登录权限。请联系您的管理员以获取更多信息。"

            ];
        }
        else if (App::isLocale('de')) {
            $authcustomMessages = [
                'invalid' => "Wir können leider kein Konto mit dieser E-Mail-Adresse finden. Bitte versuchen Sie es erneut oder erstellen Sie ein neues Konto.",
                'notVerified' => "Wir haben Ihnen einen Aktivierungscode gesendet. Überprüfen Sie Ihren Posteingang. Sollten Sie die E-Mail nicht erhalten haben, senden wir Ihnen gerne eine weitere zu.",
                "incorrectPassword" => "Das eingegebene Passwort ist falsch. Bitte versuche es erneut.",
                'loginFailure' => "Geben Sie den Benutzer ein, der nicht vorhanden ist oder keinen Anmeldezugriff hat. Bitte kontaktieren Sie Ihren Administrator für weitere Informationen."

            ];
        }
        else if (App::isLocale('fr')) {
            $authcustomMessages = [
                'invalid' => "Désolé, nous ne trouvons pas de compte avec cette adresse e-mail. Veuillez réessayer ou créer un nouveau compte.",
                'notVerified' => "Nous vous avons envoyé un code d'activation. Vérifiez votre messagerie. Si vous n'avez pas reçu l'e-mail, nous vous en enverrons un autre avec plaisir.",
                "incorrectPassword" => "Le mot de passe que vous avez entré est incorrect. Veuillez réessayer.",
                'loginFailure' => "Entrez l'utilisateur n'existe pas ou n'a pas d'accès de connexion. Veuillez contacter votre administrateur pour plus d'informations."

            ];
        }
        else{
            $authcustomMessages = [
                'invalid' => "Sorry, we can't find an account with this email address. Please try again or create a new account.",
                'notVerified' => 'We sent you an activation code. Check your email. If you did not receive the email, we will gladly send you another.',
                'incorrectPassword' => 'The password you entered is incorrect. Please try again.',
                'loginFailure' => "Enter the user does not exist or does not have login access. Please contact your administrator for more information."
            ];
        }

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // Success
                $verifiedAccount = $user->email_verified_at;


                if ($verifiedAccount) {
                    
                    $role = $user->getRoleNames();

                    $credentials = [
                        'email' => $request->email.".smartcamp.com",
                        'password' => $request['password'],
                    ];

                    Auth::attempt($credentials);

                    return \Redirect::route('procedure');


                    if ($role[0] == 'Software Admin') {
                        return \Redirect::route('controlpanel');                        
                    }
                    else{
                        $user_staff_status = $user->staff->status;

                        // dd($user_staff_status);

                        if ($user_staff_status == "Active") {
                            return \Redirect::route('master.department.index');
                        }
                        else if($user_staff_status == "Ongoing"){
                            return \Redirect::route('procedure');
                        }else{
                            return redirect()->back()
                            ->with('errmsg', $authcustomMessages['loginFailure'])
                            ->with('type', 'loginFailure');
                        }
                    }

                    

                }else{
                    return redirect()->back()
                        ->with('errmsg', $authcustomMessages['notVerified'])
                        ->with('type', 'notVerified');
                }

            }
            else{
                return redirect()->back()
                ->with('errmsg',$authcustomMessages['incorrectPassword'])
                ->with('type', 'incorrectPassword');
            }

            
        }else{
            return redirect()->back()
            ->with('errmsg',$authcustomMessages['invalid'])
            ->with('type', 'invalid');
        }
        
    }
}
