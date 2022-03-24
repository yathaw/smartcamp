<x-template>


    @section('style_content')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/steps.css') }}">
    @endsection
    @include('components.language_dropdown')

    <div class="container pb-5">

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="">
                    <span class="d-none d-lg-block">SMART CAMP</span>
                    </a>
                </div>
            </div>

        </div>

        <form method="POST" id="stepsForm" class="row justify-content-center" action="{{ route('procedure') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div id="wizard" class="col-xl-10 col-lg-10 col-12">
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="bi bi-person"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">{{ __('Personal info') }}</div>
                            <div class="bd-wizard-step-subtitle">{{ __('Step 1') }}</div>
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        <h4 class="section-heading"> {{ __('Personal information')}} </h4>
                        <p class="text-muted fst-italic mb-4">{{ __('Please enter your information and proceed to next step so we can build your account') }} </p>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-1">
                                <div class="avatar-upload">
                                    <div class="avatar-edit" >
                                        <input type='file' id="profileUpload" accept=".png, .jpg, .jpeg" name="profile" />
                                        <label for="profileUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="profilePreview" style="background-image: url({{ asset('assets/img/user.png') }});">
                                        </div>
                                    </div>
                                </div>

                                @if($errors->has('profile'))
                                    <span class="text-danger fs-6"> {{ $errors->first('profile') }} </span>
                                @elseif($errors->any() && !$errors->has('profile')) 
                                    <span class="text-danger fs-6"> <strong> {{ __("Upload Error!") }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
                                @endif
                            </div>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="form-group col-xl-7 col-lg-7 col-12 col-12 mb-3">
                                        <label for="inputName" class="form-label"> {{ __("Name")}}</label>
                                        <input type="text" name="name" id="inputName" class="form-control @if ($errors->has('name')) is-invalid @endif @if($errors->any() && !$errors->has('name')) is-valid @endif" value="{{ $user->name }}" placeholder="{{ __("Your Name")}}">

                                        <p class="text-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    </div>

                                    <div class="form-group col-xl-2 col-lg-2 col-12 mb-3">
                                        <label for="inputBlood" class="form-label">{{ __("Blood")}}</label>
                                        <select class="form-control select2 @if ($errors->has('bloodid')) is-invalid @endif @if($errors->any() && !$errors->has('bloodid')) is-valid @endif" name="bloodid" id="inputBlood">
                                            @foreach($bloods as $blood)
                                                <option value="{{ $blood->id }}" {{(old('bloodid') == $blood->id) ? 'selected' : ''}}> {{ $blood->name }} </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">
                                            {{ $errors->first('bloodid') }}
                                        </p>
                                    </div>

                                    <div class="form-group col-xl-3 col-lg-3 col-12 mb-3">
                                        <label for="inputReligion" class="form-label">{{ __("Religion")}}</label>
                                        <select class="form-control select2 @if ($errors->has('religionid')) is-invalid @endif @if($errors->any() && !$errors->has('religionid')) is-valid @endif" name="religionid" id="inputReligion">
                                            @foreach($religions as $religion)
                                                <option value="{{ $religion->id }}" {{(old('religionid') == $religion->id) ? 'checked' : ''}}> {{ $religion->name }} </option>
                                            @endforeach
                                        </select>
                                        <p class="text-danger">
                                            {{ $errors->first('religionid') }}
                                        </p>
                                    </div>

                                    <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
                                        <label for="inputNrc" class="form-label">{{ __("NRC / Passport")}}</label>
                                        <input type="text" name="nrc" id="inputNrc" class="form-control @if ($errors->has('nrc')) is-invalid @endif @if($errors->any() && !$errors->has('nrc')) is-valid @endif" placeholder="{{ __("Your NRC / Passport")}}" value="{!! old('nrc') !!}">
                                        <p class="text-danger">
                                            {{ $errors->first('nrc') }}
                                        </p>
                                    </div>

                                    <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
                                        <label for="inputDegree" class="form-label">{{ __("Degree")}}</label>
                                        <input type="text" name="degree" id="inputDegree" class="form-control @if ($errors->has('degree')) is-invalid @endif @if($errors->any() && !$errors->has('degree')) is-valid @endif" placeholder="Degree" value="{!! old('degree') !!}">

                                        <p class="text-danger">
                                            {{ $errors->first('degree') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-12">
                                <div class="form-group mb-3">
                                    <label for="phoneNumber" class="form-label d-block mb-3">{{ __("Gender")}}</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inputMale" value="Male" {{(old('gender') == 'Male') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="inputMale">{{ __("Male")}}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inputFemale" value="Female" {{(old('gender') == 'Female') ? 'checked' : ''}}>
                                        <label class="form-check-label" for="inputFemale">{{ __("Female")}}</label>
                                    </div>
                                </div>

                                @if($errors->has('gender'))
                                    <span class="text-danger fs-6"> {{ $errors->first('gender') }} </span>
                                @endif

                            </div>
                            <div class="col-xl-4 col-lg-4 col-12">
                                <div class="form-group mb-3">
                                    <label for="inputDob" class="form-label">{{ __("Date of Birth")}}</label>
                                    <input type="text" name="dob" id="inputDob" class="form-control datepicker_input @if ($errors->has('dob')) is-invalid @endif @if($errors->any() && !$errors->has('dob')) is-valid @endif" placeholder="{{ __("DD/MM/YYYY") }}" value="{!! old('dob') !!}">
                                    <p class="text-danger">
                                        {{ $errors->first('dob') }}
                                    </p>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-12">
                                <div class="form-group mb-3">
                                    <label for="inputJod" class="form-label">{{ __("Join of Date")}}</label>
                                    <input type="text" name="jod" id="inputJod" class="form-control datepicker_input @if ($errors->has('jod')) is-invalid @endif @if($errors->any() && !$errors->has('jod')) is-valid @endif" placeholder="{{ __('DD/MM/YYYY') }}" value="{!! old('jod') !!}">
                                    <p class="text-danger">
                                        {{ $errors->first('jod') }}
                                    </p>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            

                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="inputAddress" class="form-label">{{ __("Address") }}</label>
                                    <textarea class="form-control @if ($errors->has('address')) is-invalid @endif @if($errors->any() && !$errors->has('address')) is-valid @endif" id="inputAddress" name="address">{!! old('address') !!}</textarea>
                                    <p class="text-danger">
                                        {{ $errors->first('address') }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="bi bi-list-stars"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">{{ __('Choose Plan') }}</div>
                            <div class="bd-wizard-step-subtitle">{{ __('Step 2') }}</div>
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        <h4 class="section-heading"> {{ __('Pricing Plan') }} </h4>
                        <p class="text-muted fst-italic mb-4">{{ __("Find a plan that's right for you. ") }}</p>

                        <div class="row">
                            @foreach($plans as $plan)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <label class="card-radio-btn">
                                        <input type="radio" name="planid" class="card-input-element d-none" id="demo1" value="{{ $plan->id }}" {{(old('planid') == $plan->id) ? 'checked' : ''}}>
                                        <div class="card card-body">
                                            <h3 class="py-4"> {{ $plan->name }} </h3>
                                            <div class="content_head py-3">{{ $plan->amount }}</div>
                                            <div class="content_sub "> {{ $plan->duration }} </div>
                                        </div>
                                    </label>
                                </div>

                            @endforeach
                        </div>

                        @if($errors->has('planid'))
                            <span class="text-danger fs-6"> {{ $errors->first('planid') }} </span>
                        @endif
                        
                    </div>
                </section>
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="bi bi-credit-card"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">{{ __('Payment Info ') }}</div>
                            <div class="bd-wizard-step-subtitle">{{ __('Step 3') }}</div>
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        <h4 class="section-heading"> {{ __('Choose your payment method ') }}</h4>
                        <p class="text-muted fst-italic mb-4">{{ __("Enter your payment information below ") }}</p>

                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="row g-3">
                                    @foreach($banks as $bank)
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                        <label class="credi-card__label">
                                            <input class="card-input-element" type="radio" name="credicard" value="{{ $bank->id }}" {{(old('credicard') == $bank->id) ? 'checked' : ''}} />
                                            <div class="credi-card">
                                                <div class="credi-card__content">
                                                    <img src="{{ $bank->logo }}" class="img-fluid credi-card__icon mx-auto">
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                    @if($errors->has('planid'))
                                        <span class="text-danger fs-6"> {{ $errors->first('credicard') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="row">
                                    <label for="inputCardno" class="form-label"> {{ __("Card Number")}}</label>

                                    <div class="form-group col-3 mb-3">
                                        <input type="number" id="inputCardno" class="form-control @if ($errors->has('number')) is-invalid @endif @if($errors->any() && !$errors->has('number')) is-valid @endif" name="number" value="{!! old('number') !!}">
                                    </div>

                                    <div class="form-group col-3 mb-3">
                                        <input type="number" id="inputCardno1" class="form-control @if ($errors->has('number1')) is-invalid @endif @if($errors->any() && !$errors->has('number1')) is-valid @endif" name="number1" value="{!! old('number1') !!}">
                                    </div>

                                    <div class="form-group col-3 mb-3">
                                        <input type="number" id="inputCardn2" class="form-control @if ($errors->has('number2')) is-invalid @endif @if($errors->any() && !$errors->has('number2')) is-valid @endif" name="number2" value="{!! old('number2') !!}">
                                    </div>

                                    <div class="form-group col-3 mb-3">
                                        <input type="number" id="inputCardn3" class="form-control @if ($errors->has('number3')) is-invalid @endif @if($errors->any() && !$errors->has('number3')) is-valid @endif" name="number3" value="{!! old('number3') !!}">
                                    </div>

                                    @php 
                                        $errornumbers = [];
                                        if($errors->has('number')){
                                            $errornumbers[] = $errors->first('number');
                                        }
                                        if($errors->has('number1')){
                                            $errornumbers[] = $errors->first('number1');
                                        }
                                        if($errors->has('number2')){ 
                                            $errornumbers[] = $errors->first('number2');
                                        } 
                                        if($errors->has('number3')){
                                            $errornumbers[] = $errors->first('number3');
                                        }
                                        
                                    @endphp

                                    @if(count($errornumbers) > 0) 
                                        <span class="text-danger fs-6"> {{ __('The card number field is required.') }} </span>
                                    @endif
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="form-group col-12 mb-3">
                                        <label for="inputCardname" class="form-label"> {{ __("Card Holder Name")}}</label>
                                        <input type="text" name="cardholdername" id="inputCardname" class="form-control @if ($errors->has('cardholdername')) is-invalid @endif @if($errors->any() && !$errors->has('cardholdername')) is-valid @endif" placeholder="{{ __("Your Name")}}" value="{!! old('cardholdername') !!}">

                                        @if($errors->has('cardholdername'))
                                            <span class="text-danger fs-6"> {{ $errors->first('cardholdername') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                        <label for="inputCardname" class="form-label"> {{ __("Expiration Date")}}</label>
                                        <div class="row">
                                            <div class="form-group col-6 mb-3">
                                                <input type="text" name="cardmonth" id="inputCardMonth" class="form-control @if ($errors->has('cardmonth')) is-invalid @endif @if($errors->any() && !$errors->has('cardmonth')) is-valid @endif" value="{!! old('cardmonth') !!}">
                                            </div>
                                            <div class="form-group col-6 mb-3">
                                                <input type="text" name="cardyear" id="inputCardYear" class="form-control @if ($errors->has('cardyear')) is-invalid @endif @if($errors->any() && !$errors->has('cardyear')) is-valid @endif" value="{!! old('cardyear') !!}">
                                            </div>
                                            @if($errors->has('cardmonth'))
                                                <span class="text-danger fs-6"> {{ $errors->first('cardmonth') }} </span>
                                            @endif
                                            @if($errors->has('cardyear'))
                                                <span class="text-danger fs-6"> {{ $errors->first('cardyear') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">
                                        <div class="form-group mb-3">
                                            <label for="inputCardccv" class="form-label"> {{ __("CCV")}}</label>
                                            <input type="number" id="inputCardccv" class="form-control @if ($errors->has('ccv')) is-invalid @endif @if($errors->any() && !$errors->has('ccv')) is-valid @endif" name="ccv" value="{!! old('ccv') !!}">

                                            @if($errors->has('ccv'))
                                                <span class="text-danger fs-6"> {{ $errors->first('ccv') }} </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <h3>
                    <div class="media">
                        <div class="bd-wizard-step-icon"><i class="bi bi-building"></i></div>
                        <div class="media-body">
                            <div class="bd-wizard-step-title">{{ __('School Info') }}</div>
                            <div class="bd-wizard-step-subtitle">{{ __('Step 4') }}</div>
                        </div>
                    </div>
                </h3>
                <section>
                    <div class="content-wrapper">
                        <h4 class="section-heading">{{ __(' School Information ') }}</h4>
                        <p class="text-muted fst-italic mb-4">{{ __("Please fill your school's information here to make your school management system") }} </p>

                        <div class="row mb-3">
                            <div class="col-sm-4 col-sm-offset-1">
                                <div class="avatar-upload">
                                    <div class="avatar-edit" >
                                        <input type='file' id="schoollogoUpload" accept=".png, .jpg, .jpeg" name="logo" />
                                        <label for="schoollogoUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="schoollogoPreview" style="background-image: url({{ asset('assets/img/preview.png') }});">
                                        </div>
                                    </div>
                                </div>

                                @if($errors->has('logo'))
                                    <span class="text-danger fs-6"> {{ $errors->first('logo') }} </span>
                                @elseif($errors->any() && !$errors->has('logo')) 
                                    <span class="text-danger fs-6"> <strong> {{ __('Upload Error!') }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
                                @endif

                            </div>
                            <div class="col-sm-8">
                                <label for="coverFile" class="form-label"> {{ __("Upload Your School Cover Photos") }} </label>
                                <div class="input-images"></div>

                                @if($errors->has('images'))
                                    <span class="text-danger fs-6"> {{ $errors->first('images') }} </span>
                                @elseif($errors->any() && !$errors->has('images')) 
                                    <span class="text-danger fs-6"> <strong> {{ __('Upload Error!') }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-xl-4 col-lg-4 col-12 mb-3">
                                <label for="inputSchoolname" class="form-label"> {{ __("School Name")}}</label>
                                <input type="text" name="schoolname" id="inputSchoolname" class="form-control @if ($errors->has('schoolname')) is-invalid @endif @if($errors->any() && !$errors->has('schoolname')) is-valid @endif" placeholder="{{ __("School Name")}}" value="{{ $user->school->name }}">

                                <p class="text-danger">
                                    {{ $errors->first('schoolname') }}
                                </p>
                            </div>

                            <div class="form-group col-xl-2 col-lg-2 col-12 mb-3">
                                <label for="inputSchooltype" class="form-label">{{ __("Please Select")}}</label>
                                <select class="form-control select2 @if ($errors->has('schooltypeid')) is-invalid @endif @if($errors->any() && !$errors->has('schooltypeid')) is-valid @endif" name="schooltypeid" id="inputSchooltype">
                                    @foreach($schooltypes as $schooltype)
                                        <option value="{{ $schooltype->id }}" {{(old('schooltypeid') == $schooltype->id) ? 'checked' : ''}}> {{ $schooltype->name }} </option>
                                    @endforeach
                                </select>

                                <p class="text-danger">
                                    {{ $errors->first('schooltypeid') }}
                                </p>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-12 mb-3">
                                <div class="form-group mb-3">
                                    <label for="inputCity" class="form-label">{{ __("Located at")}}</label>
                                    <select class="form-control select2 @if ($errors->has('cityid')) is-invalid @endif @if($errors->any() && !$errors->has('cityid')) is-valid @endif citieselect" name="cityid" id="inputCity">
                                    </select>

                                    @if($errors->has('cityid'))
                                        <span class="text-danger fs-6"> {{ $errors->first('cityid') }} </span>
                                    @elseif($errors->any() && !$errors->has('cityid')) 
                                        <span class="text-danger fs-6"> Please Select a choice. </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-12 mb-3">
                                <label for="inputEstablished" class="form-label">{{ __("Established")}}</label>
                                <input type="text" name="established" id="inputEstablished" class="form-control @if ($errors->has('established')) is-invalid @endif @if($errors->any() && !$errors->has('established')) is-valid @endif" placeholder="{{ __("Established")}}" value="{!! old('established') !!}">

                                <p class="text-danger">
                                    {{ $errors->first('established') }}
                                </p>
                            </div>


                            <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
                                <label for="inputMottoes" class="form-label">{{ __("Mottoes / Slogans / Sayings *")}}</label>
                                <input type="text" name="mottoes" id="inputMottoes" class="form-control @if ($errors->has('mottoes')) is-invalid @endif @if($errors->any() && !$errors->has('mottoes')) is-valid @endif" placeholder="{{ __("Mottoes / Slogans / Sayings *")}}" value="{!! old('mottoes') !!}">

                                <p class="text-danger">
                                    {{ $errors->first('mottoes') }}
                                </p>
                            </div>

                            <div class="form-group col-xl-6 col-lg-6 col-12  mb-3">
                                <label for="inputSchooladdress" class="form-label">{{ __("Full Address")}}</label>
                                <input type="text" name="schooladdress" id="inputSchooladdress" class="form-control @if ($errors->has('schooladdress')) is-invalid @endif @if($errors->any() && !$errors->has('schooladdress')) is-valid @endif" placeholder="{{ __("Full Address")}}" value="{!! old('schooladdress') !!}">

                                <p class="text-danger">
                                    {{ $errors->first('schooladdress') }}
                                </p>
                            </div>

                            
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="inputGrade" class="form-label">{{ __('Choose Grade in your school') }}</label>
                                    <select class="form-control select2 @if ($errors->has('gradeids')) is-invalid @endif @if($errors->any() && !$errors->has('gradeids')) is-valid @endif " name="gradeids[]" multiple="" id="inputGrade">
                                        <option value="">Please Select Grades *</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}" @if(is_array(old('gradeids')) && in_array($grade->id, old('gradeids'))) selected @endif> {{ $grade->name }} </option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">
                                        {{ $errors->first('gradeids') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="inputDesciptiion" class="form-label">{{ __("Description") }}</label>

                                    <textarea id="inputDesciptiion" class="@if ($errors->has('description')) is-invalid @endif @if($errors->any() && !$errors->has('description')) is-valid @endif" class="" name="description" ></textarea>

                                    <p class="text-danger">
                                        {{ $errors->first('description') }}
                                    </p>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </section>
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="d-flex justify-content-center pt-4">
                    Designed by <a href="http://yathawmyatnoe.tech/">YTMN</a>
                </div>
            </div>

        </div>
    </div>



    @section('script_content')
        <script type="text/javascript">
            var currentLanguage = "{{  Config::get('app.locale') }}";

            
        </script>

        <script src="{{ asset('assets/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
        <script src="{{ asset('assets/js/steps.js') }}"></script>

        <script>
            $('.input-images').imageUploader();

            $('#inputDesciptiion').summernote();

            function profilereadURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profilePreview').css('background-image', 'url('+e.target.result +')');
                        $('#profilePreview').hide();
                        $('#profilePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            function schoollogoreadURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#schoollogoPreview').css('background-image', 'url('+e.target.result +')');
                        $('#schoollogoPreview').hide();
                        $('#schoollogoPreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            
            $('#stepsForm').on('change','#profileUpload', function()
            {
                profilereadURL(this);
            });

            $('#stepsForm').on('change','#schoollogoUpload', function()
            {
                schoollogoreadURL(this);
            });

            const dob = document.querySelector('input[name="dob"]');
            const dob_datepicker = new Datepicker(dob, {
                'format': 'yyyy/mm/dd',
                title: 'Date of Birth (DD/MM/YYYY)',
                autohide: true,

            }); 

            const jod = document.querySelector('input[name="jod"]');
            const jod_datepicker = new Datepicker(jod, {
                'format': 'yyyy/mm/dd',
                title: 'Join of Date (DD/MM/YYYY)',
                autohide: true

            }); 

            const established = document.querySelector('input[name="established"]');
            const established_datepicker = new Datepicker(established, {
                'format': 'yyyy/mm/dd',
                title: 'Established (DD/MM/YYYY)',
                autohide: true

            }); 

            const cardmonth = document.querySelector('input[name="cardmonth"]');
            const cardmonth_datepicker = new Datepicker(cardmonth, {
                autohide: true,
                pickLevel: 1,
                'format': 'mm',
            }); 

            const cardyear = document.querySelector('input[name="cardyear"]');
            const cardyear_datepicker = new Datepicker(cardyear, {
                autohide: true,
                pickLevel: 2,
                'format': 'yyyy',
            }); 

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5'
            });

            $('.citieselect').select2({
                width: '100%',
                placeholder: 'Select a City',
                theme: 'bootstrap5',
                ajax: {
                    url: '/getCities',
                    dataType: 'json',
                    delay: 250,
                    data: function (data) {
                        return {
                            searchTerm: data.term // search term
                        };
                    },
                    processResults: function (response) {
                        console.log(response);
                        return {
                            results: $.map(response, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            @if($errors->has('religionid'))
              $("#inputReligion + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('religionid'))
              $("#inputReligion + span").addClass("is-valid");
            @endif

            @if($errors->has('bloodid'))
              $("#inputBlood + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('bloodid'))
              $("#inputBlood + span").addClass("is-valid");
            @endif

            @if($errors->has('schooltypeid'))
              $("#inputSchooltype + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('schooltypeid'))
              $("#inputSchooltype + span").addClass("is-valid");
            @endif

            @if($errors->has('cityid'))
              $("#inputCity + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('cityid'))
              $("#inputCity + span").addClass("is-valid");
            @endif

            @if($errors->has('gradeids'))
              $("#inputGrade + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('gradeids'))
              $("#inputGrade + span").addClass("is-valid");
            @endif

            @if($errors->has('description'))
              $(".note-editor").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('description'))
              $(".note-editor").addClass("is-valid");
            @endif


        </script>

    @endsection


        <style type="text/css">

            span.is-invalid .select2-selection
            {
                border-color: #dc3545;
                padding-right: calc(1.5em + 0.75rem);
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.1875rem) center;
                background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            }
            span.is-valid .select2-selection
            {
                border-color: #198754 !important;
                padding-right: calc(1.5em + 0.75rem) !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") !important;
                background-repeat: no-repeat !important;
                background-position: right calc(0.375em + 0.1875rem) center !important;
                background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;

            }
            .note-editor.note-frame.is-invalid{
                border-color: #dc3545 !important;

            }
            .note-editor.note-frame.is-valid {
                border-color: #198754 !important;
            }
            .note-editor.is-invalid .note-editable{
                padding-right: calc(1.5em + 0.75rem);
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
                background-repeat: no-repeat;
                background-position: right calc(0.375em + 0.1875rem) center;
                background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
                
            }
            .note-editor.is-valid .note-editable{
                padding-right: calc(1.5em + 0.75rem) !important;
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") !important;
                background-repeat: no-repeat !important;
                background-position: right calc(0.375em + 0.1875rem) center !important;
                background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;

            }
        </style>

    

</x-template>
