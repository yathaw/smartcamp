<x-template>
    @section('style_content')
    
        <style type="text/css">
        .select2-selection{ 
            border-top-right-radius: 0.25rem !important;
            border-bottom-right-radius: 0.25rem !important;

        }
        span.is-invalid  .select2-selection{
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        span.is-valid  .select2-selection{
            border-color: #198754;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);

        }
        </style>
    @stop
    @include('components.authheader')
    

        <h5 class="card-title text-center pb-0 fs-4">{{ __("Sign Up")}}</h5>
        <p class="text-center small">{{ __("Create your account and get access to member exclusive education data, world-class experts and instant benefits like fast and manage every time.")}} </p>
        
    </div>
    <form action="{{ route('register') }}" method="POST" class="row g-3 " novalidate>
        @csrf
        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12 form-group">
            <label for="inputName" class="form-label fw-bolder text-dark">{{ __("Your Name")}}</label>
            <input type="text" name="name" class="form-control @if ($errors->has('name')) is-invalid @endif @if($errors->any() && !$errors->has('name')) is-valid @endif" id="inputName" value="{!! old('name') !!}">

            <p class="text-danger">
                {{ $errors->first('name') }}
            </p>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 form-group">
            <label for="inputEmail" class="form-label fw-bolder text-dark">{{ __("Your Role")}}</label>
            <select class="form-select @if ($errors->has('roleid')) is-invalid @endif @if($errors->any() && !$errors->has('roleid')) is-valid @endif " name="roleid">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <p class="text-danger">
                {{ $errors->first('roleid') }}
            </p>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
            <label for="inputEmail" class="form-label fw-bolder text-dark">{{ __("Your work Email address")}}</label>
            <input type="email" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif @if($errors->any() && !$errors->has('email')) is-valid @endif" id="inputEmail" value="{!! old('email') !!}"> 

            <p class="text-danger">
                {{ $errors->first('email') }}
            </p>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
            <label for="inputPassword" class="form-label fw-bolder text-dark">{{ __("Your Password")}}</label>
            <input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif @if($errors->any() && !$errors->has('password')) is-valid @endif" id="inputPassword">

            <p class="text-danger">
                {{ $errors->first('password') }}
            </p>
        </div>

        <div class="col-12">
            <label for="inputPhone" class="form-label fw-bolder text-dark">{{ __("Your Phone")}}</label>
            <div class="row">
                <div class="col-4">
                    <select class="form-control select2 @if ($errors->has('countryid')) is-invalid @endif @if($errors->any() && !$errors->has('countryid')) is-valid @endif" name="countryid" id="inputCountryid">
                    </select>

                    <p class="text-danger">
                        {{ $errors->first('countryid') }}
                    </p>
                </div>
                <div class="col-8">
                    <input type="text" name="phone" class="form-control @if ($errors->has('phone')) is-invalid @endif @if($errors->any() && !$errors->has('phone')) is-valid @endif" id="inputPhone" placeholder="(95) 123456789" value="{!! old('phone') !!}">
                    <p class="text-danger">
                        {{ $errors->first('phone') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12 form-group">
            <label for="inputSchoolname" class="form-label fw-bolder text-dark">{{ __("School Name")}}</label>
            <input type="text" name="schoolname" class="form-control @if ($errors->has('schoolname')) is-invalid @endif @if($errors->any() && !$errors->has('schoolname')) is-valid @endif" id="inputSchoolname" value="{!! old('schoolname') !!}">
            <p class="text-danger">
                {{ $errors->first('schoolname') }}
            </p>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 form-group">
            <label for="inputNos" class="form-label fw-bolder text-dark">{{ __("Number of students")}}</label>
            <input type="number" name="nos" class="form-control @if ($errors->has('nos')) is-invalid @endif @if($errors->any() && !$errors->has('nos')) is-valid @endif" id="inputNos" value="{!! old('nos') !!}">
            <p class="text-danger">
                {{ $errors->first('nos') }}
            </p>
            
        </div>

        <div class="col-12 form-group">
            <label for="inputSchoolfbpage" class="form-label fw-bolder text-dark">{{ __("School FB page")}}</label>
            <input type="text" name="socialmedia" class="form-control @if ($errors->has('socialmedia')) is-invalid @endif @if($errors->any() && !$errors->has('socialmedia')) is-valid @endif" id="inputSchoolfbpage" value="{!! old('socialmedia') !!}">
            <p class="text-danger">
                {{ $errors->first('socialmedia') }}
            </p>
        </div>

        <div class="col-12 form-group">
            <label for="inputInterest" class="form-label fw-bolder text-dark">{{ __("Product interest")}}</label>
            <small class="d-block text-muted small"> {{ __("Which features are you looking for? Select all that apply.")}} </small>

            <select class="form-select" name="interestids[]" id="inputInterest" multiple>
                @foreach($interests as $interest)
                    <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                @endforeach
            </select>

            <p class="text-danger">
                {{ $errors->first('interestids') }}
            </p>

        </div>

        <div class="col-12 form-group">
            <label for="inputSocialmedia" class="form-label fw-bolder text-dark">{{ __("How did you hear about us?")}}</label>
            <select class="form-select @if ($errors->has('socialmediaids')) is-invalid @endif @if($errors->any() && !$errors->has('socialmediaids')) is-valid @endif" name="socialmediaids[]" id="inputSocialmedia" multiple>
                @foreach($socialmedias as $socialmedia)
                    <option value="{{ $socialmedia->id }}">{{ $socialmedia->name }}</option>
                @endforeach
            </select>
            <p class="text-danger">
                {{ $errors->first('socialmediaids') }}
            </p>
        </div>

        <div class="col-12 form-group">
            <label for="inputReason" class="form-label fw-bolder text-dark">{{ __("How can we help?")}}</label>
            <small class="d-block text-muted small"> {{ __("Please share with us the key pain points you want to solve")}} </small>
            <textarea name="reason" class="form-control @if ($errors->has('reason')) is-invalid @endif" id="inputReason">{!! old('reason') !!}</textarea>
            <p class="text-danger">
                {{ $errors->first('reason') }}
            </p>
        </div>


        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input @if ($errors->has('terms')) is-invalid @endif @if($errors->any() && !$errors->has('terms')) is-valid @endif" name="terms" type="checkbox" value="yes" id="acceptTerms" required>
                <label class="form-check-label" for="acceptTerms">{{ __("I agree and accept the")}} <a href="#">{{ __("terms and conditions")}} </a></label>
                <p class="text-danger">
                    {{ $errors->first('terms') }}
                </p>
            </div>
        </div>

        <div class="col-12">
            <p class="small text-danger">{{ __("Don't worry, we'd never share any of your data or post anything on your behalf.")}}</p>
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">{{ __("Create Account")}}</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">{{ __("Already have an account?")}} <a href="{{ route('login') }}">{{ __("Log in")}}</a></p>
        </div>
    </form>

    @include('components.authfooter')

                            

@section('script_content')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#inputInterest").select2({
                width: '100%',
                theme: 'bootstrap5'
            });

            @if($errors->has('interestids'))
              $("#inputInterest + span").addClass("is-invalid");
            @endif

            
            @if($errors->any() && !$errors->has('interestids'))
                $("#inputInterest + span").addClass("is-valid");
            @endif

            $("#inputSocialmedia").select2({
                width: '100%',
                theme: 'bootstrap5'
            });

            @if($errors->has('inputSocialmedia'))
              $("#inputSocialmedia + span").addClass("is-invalid");
            @endif

            
            @if($errors->any() && !$errors->has('interestids'))
                $("#inputSocialmedia + span").addClass("is-valid");
            @endif


            getCountries();

            
            function getCountries(){
                $.ajax({
                    method: 'GET',
                    url: "{{ route('getCountries') }}",
                    success: function(response){
                        var html ='';
                        $.each(response,function(i,v) {
                            html += `<option value="${v.id}">${v.name} (+${v.phonecode})</option>`;
                        });

                        $('#inputCountryid').select2({
                            width: '100%',
                            placeholder: 'Select a Country',
                            theme : 'bootstrap5'
                            
                        });
                        $('#inputCountryid').html(html);
                        
                    }
                });
            }

        })
   </script>

@stop
</x-template>