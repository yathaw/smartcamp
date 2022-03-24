<x-template>

    @include('components.authheader')
    
        <h5 class="card-title text-center pb-0 fs-4">{{ __("Sign In")}}</h5>
        <p class="text-center small">{{ __("Enter your school’s SMART CAMP url. & password to login.")}}</p>
    </div>
    <form  action="{{ route('login') }}" method="POST" class="row g-3">
        @csrf
        
        @if(session('errmsg'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            {{ session('errmsg') }}

            @if(session('type') == "incorrectPassword")
                <br> <a href="#" class="alert-link text-decoration-underline">{{ __("Forgot Password")}}</a>
            @endif

            @if(session('type') == "notVerified")
                <br>  <a href="#" class="alert-link text-decoration-underline">{{ __("Resend a new code")}}</a>
            @endif


            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        @endif


        <div class="col-12 form-group">
            <label for="inputEmail" class="form-label fw-bolder text-dark">{{ __("Code No")}}</label>
            <div class="input-group">
                <input type="text" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif @if($errors->any() && !$errors->has('email')) is-valid @endif" id="inputEmail" placeholder="{{ __('your-school-code')}}" value="{!! old('email') !!}">
                <span class="input-group-text" id="inputEmail">
                    . smartcamp.com
                </span>
            </div>
            <p class="text-danger">
                {{ $errors->first('email') }}
            </p>
            
        </div>


        <div class="col-12 form-group">
            <label for="inputPassword" class="form-label fw-bolder text-dark">{{ __("Your Password")}}</label>
            <input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif" id="inputPassword">
            <p class="text-danger">
                {{ $errors->first('password') }}
            </p>
        </div>

        <div class="col-12">
            <p class="small mb-0"> <a href="{{ route('register') }}">{{ __("Don’t remember?")}}</a></p>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit"> {{ __("Login")}}</button>
        </div>
        <div class="col-12">
            <p class="small mb-0"> {{ __("Don't have account? ")}} <a href="{{ route('register') }}">{{ __("Create an account")}}</a></p>
        </div>
    </form>
    @include('components.authfooter')

</x-template>