<x-template>
    @section('style_content')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/verify.css') }}">
    @endsection

    @include('components.authheader')
        
        <h5 class="card-title text-center pb-0 fs-4">{{ __("Verify your account")}} </h5>
        <p class="text-center small">
            {{ __("We emailed you the six digit codes to")}}
            <span class="fw-bold lato_black text-dark"> {{ $user->staff->workemail }} </span>
            {{ __("Enter the code below to confirm your email address.")}} 
        </p>
    </div>
    @if (session('error'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                </svg>
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif
    <form action="{{ route('verify.user') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $userid }}" id="inputId">

        <div class="row">
            <div class="col-12">
                <div class="code-container">
                    <input name="number1" type="number" class="code" placeholder="0" min="0" max="9" required />
                    <input name="number2" type="number" class="code" placeholder="0" min="0" max="9" required />
                    <input name="number3" type="number" class="code" placeholder="0" min="0" max="9" required />
                    <input name="number4" type="number" class="code" placeholder="0" min="0" max="9" required />
                    <input name="number5" type="number" class="code" placeholder="0" min="0" max="9" required />
                    <input name="number6" type="number" id="intLimitTextBox" class="code" placeholder="0" min="0" max="9" required />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary w-100 verifyBtn" type="submit">{{ __("Verify")}}</button>
            </div>
        </div>

    </form>

    <div class="row justify-content-center">
        <div class="col-10 my-3">
            <hr>
        </div>
        <div class="col-8 text-center">
            <p> {{ __("Didn't receive the code?") }} </p>
            <a href="javascript:void(0)" class="sendcodeagainBtn"> {{ __("Send Code Again") }} </a>
        </div>
    </div>



    @include('components.authfooter')

@section('script_content')
    <script type="text/javascript">

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var currentLanguage = "{{  Config::get('app.locale') }}";
            if (currentLanguage == "mm") {
                var n_verified_text = "သင့်အီးမေးလ်အကောင့်သို့ အတည်ပြုကုဒ်တစ်ခု ပေးပို့လိုက်ပါပြီ။";

            }
            else if(currentLanguage == "jp"){
                var n_verified_text = "確認コードがメールアカウントに送信されました。";
            }
            else if(currentLanguage == "cn"){
                var n_verified_text =  "验证码已发送到您的电子邮件帐户。";
            }
            else if(currentLanguage == "de"){
                var n_verified_text = "Ein Bestätigungscode wurde an Ihr E-Mail-Konto gesendet.";
            }
            else if(currentLanguage == "fr"){
                var n_verified_text ="Un code de vérification a été envoyé à votre compte de messagerie.";
                
            }else{
                var n_verified_text ="A verification code has been sent to your email account.";
            }

            // Send Code Again
            $('.sendcodeagainBtn').on('click', function(){
                var id = $('#inputId').val();
                    
                var url="{{route('verify.resend',':id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    type:'POST',
                    dataType: 'json',
                    url: url,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        console.log(data);
                        Swal.fire({
                            icon: "success",
                            text: n_verified_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });

        });

        var body = $('body');

        function goToNextInput(e) {
            var key = e.which,
                t = $(e.target),
                sib = t.next('input');

            if (key != 9 && (key < 48 || key > 57)) {
                e.preventDefault();
                return false;
            }

            if (key === 9) {
                return true;
            }

            if (!sib || !sib.length) {
                sib = body.find('input').eq(0);
            }
            sib.select().focus();
        }

        function onKeyDown(e) {
            var key = e.which;

            if (key === 9 || (key >= 48 && key <= 57)) {
                return true;
            }

            e.preventDefault();
            return false;
        }

        function onFocus(e) {
            $(e.target).select();
        }

        var formsubmit = $("button[type=submit]"),
        codeinputs = $('.code');

        function checkEmpty() {
            return codeinputs.filter(function() {
                return !$.trim(this.value);
            }).length === 0;
        }

        codeinputs.on('blur', function() {
            formsubmit.prop("disabled", !checkEmpty());
        }).blur();

        body.on('keyup', 'input', goToNextInput);
        body.on('keydown', 'input', onKeyDown);
        body.on('click', 'input', onFocus);

        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                    } else {
                        this.value = "";
                    }
                });
            });
        }
        setInputFilter(document.querySelector("form input[name='number1']"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9); 
        });
        setInputFilter(document.querySelector("form input[name='number2']"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9); 
        });

        setInputFilter(document.querySelector("form input[name='number3']"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9); 
        });

        setInputFilter(document.querySelector("form input[name='number4']"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9); 
        });

        setInputFilter(document.querySelector("form input[name='number5']"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9); 
        });

        setInputFilter(document.querySelector("form input[name='number6']"), function(value) {
            return /^\d*$/.test(value) && (value === "" || parseInt(value) <= 9); 
        });

        

    </script>
@stop
</x-template>