<x-template>
	@section('style_content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/pdfViewer/style.css') }}">
    <style type="text/css">
		#sportsDiv .select2-container--bootstrap5 .select2-selection--single {
		    height: 50px !important;
		}
	</style>

	<style type="text/css">

        span.is-invalid .select2-selection
        {
            border-color: #dc3545 !important;
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
        
    </style>
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Student")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Create New Student")}}</li>
	        </ol>
	    </nav>
	</div>
	
	@if($subjects->isEmpty())

		<!-- End Page Title -->
		<section class="section" id="emptyState">
		    <div class="row">
		        <div class="col-lg-12">
		            <div class="card">
		                <div class="card-body pt-4 d-flex flex-column align-items-center">
		                	<div class="container ">
			                	<div class="row align-items-center justify-content-center">
			                		<div class="col-6  text-center">

			                    			<img src="{{ asset('assets/img/empty_subject.svg') }}" class="img-fluid text-center">
			                		</div>
			                	</div>
			                </div>
			               
			                @if($subjects->isEmpty())
			                    <h2> {{ __("No Curricula Data Found") }} </h2>
			                    <p> {{ __("There have been no curricula in this section yet. Please add some subjects first.") }} </p>

			                    <div class="d-grid gap-2 col-6 mx-auto my-5">
								  	<a href="{{ route('master.curriculum.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Curricula")}} </a>
								</div>
							@endif
		                    
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
		
	@else

	<!-- End Page Title -->
	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="card">
	            	<div class="card-header row align-items-center">
	            		<div class="col-12">
	                    	{{ __("Add New Student") }}
	            		</div>
	            	</div>


	                <div class="card-body">
		                

		                @if(session('successmsg'))
					        <div class="alert alert-success alert-dismissible fade show" role="alert">
					            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
					                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
									    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
									</symbol>
					            </svg>
					            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
					            {{ session('successmsg') }}
					            
					            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					        </div>

					    @endif

		                @if (count($errors) > 0)
		                    <div class="alert alert-danger">
		                        <ul>
		                            @foreach ($errors->all() as $error)
		                              <li>{{ $error }}</li>
		                            @endforeach
		                        </ul>
		                    </div>
		                @endif

		                <div class="wizard-content">
		                    <form id="example-form" action="{{ route('master.student.store') }}" class="new-added-form tab-wizard wizard-circle wizard clearfix g-3" method="POST" enctype="multipart/form-data">
		                    @csrf

		                        <h6> {{ __("Basic Info") }} </h6>
		                        <section class="container">
		                            <div class="row form-group mb-3 mb-4">
		                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
		                                    <div class="avatar-upload">
		                                        <div class="avatar-edit" >
		                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="profile" />
		                                            <label for="imageUpload"></label>
		                                        </div>
		                                        <div class="avatar-preview">
		                                            <div id="imagePreview" style="background-image: url({{ asset('assets/img/user.png') }});">
		                                            </div>
		                                        </div>

		                                        @if($errors->has('profile'))
				                                    <span class="text-danger fs-6"> {{ $errors->first('profile') }} </span>
				                                @elseif($errors->any() && !$errors->has('profile')) 
				                                    <span class="text-danger fs-6"> <strong> {{ __("Upload Error!") }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
				                                @endif
		                                    </div>
		                                    <div>
				                                <div class="switch-field justify-content-center">
				                                    <input type="radio" id="radio-one" name="gender" value="Male" @if(old('gender') == "Male") checked @endif/>
				                                    <label for="radio-one"> {{ __("Male") }} </label>
				                                    <input type="radio" id="radio-two" name="gender" value="Female" @if(old('gender') == "Female") checked @endif/>
				                                    <label for="radio-two"> {{ __("Female") }} </label>
				                                </div>

				                                <p class="text-danger">
		                                            {{ $errors->first('gender') }}
		                                        </p>
		                                    </div>
		                                </div>
		                                <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
		                                    <div class="row">
		                                        <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
			                                        <label for="inputName" class="form-label"> 
			                                        	{{ __("Student Name")}}
			                                        	<small> {{ __("(English Version)")}} </small>
			                                        </label>
			                                        <input type="text" name="name" id="inputName" class="form-control @if ($errors->has('name')) is-invalid @endif @if($errors->any() && !$errors->has('name')) is-valid @endif" value="{{ old('name') }}" placeholder="{{ __("Name : English Version")}}">

			                                        <p class="text-danger">
			                                            {{ $errors->first('name') }}
			                                        </p>
			                                    </div>

		                                        <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
			                                        <label for="inputNamenativeversion" class="form-label">
			                                        	{{ __("Student Name")}}
			                                        	<small> {{ __("(Native Version)")}} </small>
			                                        </label>
			                                        <input type="text" name="namenative" id="inputNamenativeversion" class="form-control @if ($errors->has('namenative')) is-invalid @endif @if($errors->any() && !$errors->has('namenative')) is-valid @endif" placeholder="{{ __("Name : Native Version")}}" value="{!! old('namenative') !!}">
			                                        <p class="text-danger">
			                                            {{ $errors->first('namenative') }}
			                                        </p>
			                                    </div>

		                                        <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
				                                    <label for="inputDob" class="form-label">{{ __("Date of Birth")}}</label>
				                                    <input type="text" name="dob" id="inputDob" class="form-control @if ($errors->has('dob')) is-invalid @endif @if($errors->any() && !$errors->has('dob')) is-valid @endif" placeholder="{{ __("DD/MM/YYYY") }}" value="{!! old('dob') !!}">
				                                    <p class="text-danger">
				                                        {{ $errors->first('dob') }}
				                                    </p>
					                            </div>

					                            <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
				                                    <label for="inputRegisterdate" class="form-label">{{ __("Registry Date")}}</label>
				                                    <input type="text" name="registerdate" id="inputRegisterdate" class="form-control @if ($errors->has('registerdate')) is-invalid @endif @if($errors->any() && !$errors->has('registerdate')) is-valid @endif" placeholder="{{ __("DD/MM/YYYY") }}" value="{!! old('registerdate') !!}">
				                                    <p class="text-danger">
				                                        {{ $errors->first('registerdate') }}
				                                    </p>
					                            </div>


					                            <div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
				                                    <label for="inputSportinterest" class="form-label">{{ __("Class You Want To Apply For") }}</label>

				                                    <select class="select2" name="gradeid">
				                                    	<option></option>
				                                    	@foreach($grades as $grade)
				                                    		<option  value="{{ $grade->id }}">{{ $grade->name }}</option>
				                                    	@endforeach
				                                    </select>

				                                </div>

		                                        <div class="form-group col-xl-6 col-lg-6  col-12 mb-3">
		                                        	<label for="inputPreviousschoolname" class="form-label"> 
			                                        	{{ __("Previous School Name")}}
			                                        </label>
			                                        <input type="text" name="previousschoolname" id="inputPreviousschoolname" class="form-control @if ($errors->has('previousschoolname')) is-invalid @endif @if($errors->any() && !$errors->has('previousschoolname')) is-valid @endif" value="{{ old('previousschoolname') }}" placeholder="{{ __("Previous School Name")}}">

			                                        <p class="text-danger">
			                                            {{ $errors->first('previousschoolname') }}
			                                        </p>
		                                        </div>

				                                

				                                <div class="form-group col-12 mb-3">
			                                        <label for="inputCountry" class="form-label">{{ __("Country") }}</label>

				                                    <select class="sport_select2" name="countryid" id="inputCountry">
				                                    	<option></option>
				                                    	@foreach($countries as $country)
				                                    		<option data-img_src="{{ asset($country->flag) }}"  value="{{ $country->id }}">{{ $country->name }}</option>
				                                    	@endforeach
				                                    </select>

			                                        <p class="text-danger">
			                                            {{ $errors->first('countryid') }}
			                                        </p>
			                                    </div>

				                                
					                            
		                                    </div>
		                                </div>
		                                
		                            </div>

		                            <div class="row form-group mb-3">

		                            	<div class="form-group col-xl-6 col-lg-6 col-12 mb-3">
	                                        <label for="inputAddress" class="form-label">{{ __("Current Address") }}</label>
		                                    <textarea class="form-control @if ($errors->has('address')) is-invalid @endif @if($errors->any() && !$errors->has('address')) is-valid @endif" id="inputAddress" name="address">{!! old('address') !!}</textarea>

		                                    <p class="text-danger">
		                                        {{ $errors->first('address') }}
		                                    </p>
	                                    </div>
                                        
	                                    <div class="form-group col-xl-6 col-lg-6  col-12 mb-3" id="sportsDiv">
		                                    <label for="inputSportinterest" class="form-label">{{ __("Sports Interest") }}</label>

		                                    <select class="sport_select2" name="sportid">
		                                    	<option></option>
		                                    	@foreach($sports as $sport)
		                                    		<option data-img_src="{{ asset($sport->photo) }}"  value="{{ $sport->id }}">{{ $sport->name }}</option>
		                                    	@endforeach
		                                    </select>

		                                </div>
		                                
		                                
		                            </div>

		                            <div class="row form-group mb-3" >
		                            	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
		                                    <label for="inputBio" class="form-label">{{ __("Bio") }}</label>
		                                    <textarea class="form-control @if ($errors->has('bio')) is-invalid @endif @if($errors->any() && !$errors->has('bio')) is-valid @endif" id="inputBio" name="bio">{!! old('bio') !!}</textarea>

		                                    <p class="text-danger">
		                                        {{ $errors->first('bio') }}
		                                    </p>
		                                </div>

		                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
		                                    <label for="inputOtherinterest" class="form-label">{{ __("Other Interest") }}</label>
		                                    <textarea class="form-control @if ($errors->has('otherinterest')) is-invalid @endif @if($errors->any() && !$errors->has('otherinterest')) is-valid @endif" id="inputOtherinterest" name="otherinterest">{!! old('otherinterest') !!}</textarea>

		                                    <p class="text-danger">
		                                        {{ $errors->first('otherinterest') }}
		                                    </p>
		                                </div>

		                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
		                                    <label for="inputAcademicawards" class="form-label">{{ __("Academic Awards") }}</label>
		                                    <textarea class="form-control @if ($errors->has('academicawards')) is-invalid @endif @if($errors->any() && !$errors->has('academicawards')) is-valid @endif" id="inputAcademicawards" name="academicawards">{!! old('academicawards') !!}</textarea>

		                                    <p class="text-danger">
		                                        {{ $errors->first('academicawards') }}
		                                    </p>
		                                </div>

		                            </div>

		                            <div class="row form-group mb-3">
		                            	<div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                    		<label class="mb-3"> {{ __("Take Lunch Box?") }} </label>
		                            		<div class="switch-field">
			                                    <input type="radio" id="lunchboxNo" name="lunchbox" value="No" @if(old('lunchbox') == "No") checked @endif/>
			                                    <label for="lunchboxNo"> {{ __("No") }} </label>
			                                    <input type="radio" id="lunchboxYes" name="lunchbox" value="Yes" @if(old('lunchbox') == "Yes") checked @endif/>
			                                    <label for="lunchboxYes"> {{ __("Yes") }} </label>
			                                </div>
		                            	</div>

		                            	<div class="form-group col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12">
                                    		<label class="mb-3"> {{ __("Take a Ferry?") }} </label>
		                            		<div class="switch-field">
			                                    <input type="radio" id="ferryNo" name="ferry" value="No" @if(old('ferry') == "No") checked @endif/>
			                                    <label for="ferryNo"> {{ __("No") }} </label>
			                                    <input type="radio" id="ferryYes" name="ferry" value="Yes" @if(old('ferry') == "Yes") checked @endif/>
			                                    <label for="ferryYes"> {{ __("Yes") }} </label>
			                                </div>
		                            	</div>

		                            	<div class="form-group col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
                                    		<label class="mb-3"> {{ __("Want to stay in dormitory?") }} </label>
		                            		<div class="switch-field">
			                                    <input type="radio" id="dormitoryNo" name="dormitory" value="No" @if(old('dormitory') == "No") checked @endif/>
			                                    <label for="dormitoryNo"> {{ __("No") }} </label>
			                                    <input type="radio" id="dormitoryYes" name="dormitory" value="Yes" @if(old('dormitory') == "Yes") checked @endif/>
			                                    <label for="dormitoryYes"> {{ __("Yes") }} </label>
			                                </div>
		                            	</div>

			                            <div class="form-group col-xl-3 col-lg-3 col-12 mb-3">
		                                    <label for="inputReligion" class="form-label"> {{ __("Religion") }} </label>
		                                    <select class="select2" name="religionid" id="inputReligion">
		                                        <option></option>
		                                        @foreach($religions as $religion)
		                                            <option value="{{ $religion->id }}" @if(old('religionid') == $religion->id ) selected @endif> {{ $religion->name }} </option>
		                                        @endforeach
		                                    </select>

		                                    @if($errors->first('religionid'))
		                                        <p class="text-danger"> {{ $errors->first('religionid') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-xl-2 col-lg-2 col-12 mb-3">
		                                    <label for="inputBlood" class="form-label"> {{ __("Blood") }} </label>
		                                    <select class="select2" name="bloodid" id="inputBlood">
		                                        <option></option>
		                                        @foreach($bloods as $blood)
		                                            <option value="{{ $blood->id }}" @if(old('bloodid') == $blood->id ) selected @endif> {{ $blood->name }} </option>
		                                        @endforeach
		                                    </select>

		                                    @if($errors->first('bloodid'))
		                                        <p class="text-danger"> {{ $errors->first('bloodid') }} </p>
		                                    @endif
		                                </div>

		                            </div>
		                            
		                        </section>

		                        <h6> {{ ("Medical") }} </h6>
		                        <section class="container">
		                        	
		                            <p class="fs-4 text-dark fw-bold"> {{ __("Medical Problems") }} </p>
		                            <p> {{ ("List of any medical problems the student has as well as any medication currently being taken below") }} </p>

		                            <div class="row form-group mb-3">
		                                
		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
		                                    <label for="inputMedicalproblem" class="form-label">{{ __("Medical Problem") }}</label>
		                                    <input type="text" name="medicalproblem" id="inputMedicalproblem" class="form-control @if ($errors->has('medicalproblem')) is-invalid @endif @if($errors->any() && !$errors->has('medicalproblem')) is-valid @endif" value="{{ old('medicalproblem') }}">

	                                        <p class="text-danger">
	                                            {{ $errors->first('medicalproblem') }}
	                                        </p>
		                                </div>

		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
		                                    <label for="inputMedicalneeds" class="form-label">{{ __("Medical Needs") }}</label>
		                                    <input type="text" name="medicalneeds" id="inputMedicalneeds" class="form-control @if ($errors->has('medicalneeds')) is-invalid @endif @if($errors->any() && !$errors->has('medicalneeds')) is-valid @endif" value="{{ old('medicalneeds') }}">

	                                        <p class="text-danger">
	                                            {{ $errors->first('medicalneeds') }}
	                                        </p>
		                                </div>
		                                
		                            </div>

		                            <p class="fs-4 text-dark fw-bold"> {{ __("Allergies") }} </p>
		                            <p> {{ ("List of any allergies the student has below") }} </p>

		                            <div class="row form-group mb-3">
		                                
		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
		                                    <label for="inputMedicationallergy" class="form-label">{{ __("Medication Allergy") }}</label>
		                                    <input type="text" name="medicationallergy" id="inputMedicationallergy" class="form-control @if ($errors->has('medicationallergy')) is-invalid @endif @if($errors->any() && !$errors->has('medicationallergy')) is-valid @endif" value="{{ old('medicationallergy') }}">

	                                        <p class="text-danger">
	                                            {{ $errors->first('medicationallergy') }}
	                                        </p>
		                                </div>

		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
		                                    <label for="inputFoodallergy" class="form-label">{{ __("Food Allergy") }}</label>
		                                    <input type="text" name="foodallergy" id="inputFoodallergy" class="form-control @if ($errors->has('foodallergy')) is-invalid @endif @if($errors->any() && !$errors->has('foodallergy')) is-valid @endif" value="{{ old('foodallergy') }}">

	                                        <p class="text-danger">
	                                            {{ $errors->first('foodallergy') }}
	                                        </p>
		                                </div>

		                                <div class="col-12">
		                                	<label for="inputOtherallergy" class="form-label">{{ __("Other Allergy") }}</label>
		                                    <textarea class="form-control @if ($errors->has('otherallergy')) is-invalid @endif @if($errors->any() && !$errors->has('otherallergy')) is-valid @endif" id="inputOtherallergy" name="otherallergy">{!! old('otherallergy') !!}</textarea>

		                                    <p class="text-danger">
		                                        {{ $errors->first('otherallergy') }}
		                                    </p>
		                                </div>
		                                
		                            </div>

		                        </section>


		                        <h6> {{ __("Guardian Info") }} </h6>
		                        <section class="container">
		                            
		                            <h5 class="mb-2"> {{ __("Parent / Guardian #1") }} </h5>
		                            <div class="row">
		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG1name" class="form-label"> {{ __("Name") }} </label>
		                                    <input type="text" class="form-control" id="inputG1name" placeholder="{{ __("Name") }}" name="g1name" value="{{ old('g1name') }}">

		                                    @if($errors->first('g1name'))
		                                        <p class="text-danger"> {{ $errors->first('g1name') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG1rs" class="form-label"> {{ __("Relationship of Student") }} </label>
		                                    <input type="text" class="form-control" id="inputG1rs" placeholder="{{ __("Father / Mother") }}" name="g1rs" value="{{ old('g1rs') }}">

		                                    @if($errors->first('g1rs'))
		                                        <p class="text-danger"> {{ $errors->first('g1rs') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG1phone" class="form-label"> {{ __("Phone") }} </label>
		                                    <input type="text" class="form-control" id="inputG1phone" placeholder="09-87654321" name="g1phone" value="{{ old('g1phone') }}">

		                                    @if($errors->first('g1phone'))
		                                        <p class="text-danger"> {{ $errors->first('g1phone') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG1email" class="form-label"> {{ __("Work Email") }} </label>
		                                    <input type="email" class="form-control" id="inputG1email" placeholder="{{ __("Work Email") }}" name="g1email" value="{{ old('g1email') }}">

		                                    @if($errors->first('g1email'))
		                                        <p class="text-danger"> {{ $errors->first('g1email') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-12 form-group mb-3">
		                                    <label for="inputG1occupation" class="form-label"> {{ __("Occupation") }} </label>
		                                    <input type="text" class="form-control" id="inputG1occupation" placeholder="{{ __("Occupation") }}" name="g1occupation" value="{{ old('g1occupation') }}">

		                                    @if($errors->first('g1occupation'))
		                                        <p class="text-danger"> {{ $errors->first('g1occupation') }} </p>
		                                    @endif
		                                </div>
		                            </div>
		                            <hr class="mb-3 text-dark">
		                            
		                            <h5 class="mb-2"> {{ __("Parent / Guardian #2") }} </h5>
		                            
		                            <div class="row">
		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG2name" class="form-label"> {{ __("Name") }} </label>
		                                    <input type="text" class="form-control" id="inputG2name" placeholder="{{ __("Name") }}" name="g2name" value="{{ old('g2name') }}">

		                                    @if($errors->first('g2name'))
		                                        <p class="text-danger"> {{ $errors->first('g2name') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG2rs" class="form-label"> {{ __("Relationship of Student") }} </label>
		                                    <input type="text" class="form-control" id="inputG2rs" placeholder="{{ __("Father / Mother") }}" name="g2rs" value="{{ old('g2rs') }}">

		                                    @if($errors->first('g2rs'))
		                                        <p class="text-danger"> {{ $errors->first('g2rs') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG2phone" class="form-label"> {{ __("Phone") }} </label>
		                                    <input type="text" class="form-control" id="inputG2phone" placeholder="09-87654321" name="g2phone" value="{{ old('g2phone') }}">

		                                    @if($errors->first('g2phone'))
		                                        <p class="text-danger"> {{ $errors->first('g2phone') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-lg-3 col-md-3 col-sm-6 col-12 form-group mb-3">
		                                    <label for="inputG2email" class="form-label"> {{ __("Work Email") }} </label>
		                                    <input type="email" class="form-control" id="inputG2email" placeholder="{{ __("Work Email") }}" name="g2email" value="{{ old('g2email') }}">

		                                    @if($errors->first('g2email'))
		                                        <p class="text-danger"> {{ $errors->first('g2email') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-12 form-group mb-3">
		                                    <label for="inputG2occupation" class="form-label"> {{ __("Occupation") }} </label>
		                                    <input type="text" class="form-control" id="inputG2occupation" placeholder="{{ __("Occupation") }}" name="g2occupation" value="{{ old('g2occupation') }}">

		                                    @if($errors->first('g2occupation'))
		                                        <p class="text-danger"> {{ $errors->first('g2occupation') }} </p>
		                                    @endif
		                                </div>

		                            </div>


		                        </section>

		                        <h6> {{ __("Document File") }} </h6>
		                        <section class="container">

		                            <div class="row">
		                            	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
		                            		<p class="text-dark"> {{ __("Government Birth Certificate") }} </p>
		                            		<div class="box">
											    <div class="js--image-preview"></div>
											    <div class="upload-options">
											      	<label class="">
											        	<input type="file" name="img1" class="image-upload" accept="image/*" />
											      	</label>
											    </div>
											</div>
		                            	</div>

		                            	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 component">
		                            		<p class="text-dark"> {{ __("ID Card - Front") }} </p>
		                            		<div class="box">
											    <div class="js--image-preview"></div>
											    <div class="upload-options">
											      	<label class="">
											        	<input type="file" name="img2" class="image-upload" accept="image/*" />
											      	</label>
											    </div>
											</div>
		                            	</div>

		                            	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 component">
		                            		<p class="text-dark"> {{ __("ID Card - Back ") }} </p>
		                            		<div class="box">
											    <div class="js--image-preview"></div>
											    <div class="upload-options">
											      	<label class="">
											        	<input type="file" name="img3" class="image-upload" accept="image/*" />
											      	</label>
											    </div>
											</div>
		                            	</div>

		                            	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
		                            		<p class="text-dark"> {{ __("Previous Class Marksheet") }} </p>
		                            		<div class="box">
											    <div class="js--image-preview"></div>
											    <div class="upload-options">
											      	<label class="">
											        	<input type="file" name="img4" class="image-upload" accept="image/*" />
											      	</label>
											    </div>
											</div>
		                            	</div>

		                            	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 component">
		                            		<p class="text-dark"> {{ __("Transfer Certificate TC") }} </p>
		                            		<div class="box">
											    <div class="js--image-preview"></div>
											    <div class="upload-options">
											      	<label class="">
											        	<input type="file" name="img5" class="image-upload" accept="image/*" />
											      	</label>
											    </div>
											</div>
		                            	</div>

		                            	<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 component">
		                            		<p class="text-dark"> {{ __("Latest Medical Immunization Record") }} </p>
		                            		<div class="box">
											    <div class="js--image-preview"></div>
											    <div class="upload-options">
											      	<label class="">
											        	<input type="file" name="img6" class="image-upload" accept="image/*" />
											      	</label>
											    </div>
											</div>
		                            	</div>

		                            </div>
		                        </section>

		                                          
		                        <h6> {{ __("Secretary Info") }} </h6>
		                        <section class="container">

		                        	<p class="fs-5 mb-2"> {{ __("For Student") }} </p>

		                            <div class="row form-group mb-3">
		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3">
		                                    <label for="inputCodeno1" class="form-label"> {{ __("Login Codeno") }} </label>
		                                    <div class="input-group">
								                <input type="text" name="logincodeg1" class="form-control @if ($errors->has('logincodeg1')) is-invalid @endif @if($errors->any() && !$errors->has('logincodeg1')) is-valid @endif" id="inputCodeno1" placeholder="{{ __('login-school-code for parents')}}" value="{!! old('logincodeg1') !!}">
								                <span class="input-group-text" id="inputCodeno1">
								                    . smartcamp.com
								                </span>
								            </div>
								            

		                                    @if($errors->first('logincodeg1'))
		                                        <p class="text-danger"> {{ $errors->first('logincodeg1') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3" data-password="">
		                                    <label for="inputPassword1" class="form-label"> {{ __("Password") }} </label>
		                                    <input type="password" class="form-control position-relative" id="inputPassword1" name="password1" value="{{ old('password1') }}" data-pass-target="">

		                                    <div class="password-show-hide" data-pass-show-hide="">

		                                      <svg data-pass-show="" class="password-show" viewBox="0 0 511.99 511.99">
		                                        <path d="m510.1 249.94c-4.032-5.867-100.93-143.28-254.1-143.28-131.44 0-248.56 136.62-253.48 142.44-3.349 3.968-3.349 9.792 0 13.781 4.928 5.824 122.05 142.44 253.48 142.44s248.55-136.62 253.48-142.44c3.094-3.669 3.371-8.981 0.619-12.949zm-254.1 134.06c-105.36 0-205.55-100.48-231-128 25.408-27.541 125.48-128 231-128 123.28 0 210.3 100.33 231.55 127.42-24.534 26.645-125.29 128.58-231.55 128.58z" />
		                                        <path d="m256 170.66c-47.061 0-85.333 38.272-85.333 85.333s38.272 85.333 85.333 85.333 85.333-38.272 85.333-85.333-38.272-85.333-85.333-85.333zm0 149.33c-35.285 0-64-28.715-64-64s28.715-64 64-64 64 28.715 64 64-28.715 64-64 64z" /></svg>
		                                      <svg data-pass-hide="" class="password-hide" viewBox="0 0 512 512" xml:space="preserve">
		                                        <path d="m316.33 195.66c-4.16-4.16-10.923-4.16-15.083 0s-4.16 10.944 0 15.083c12.075 12.075 18.752 28.139 18.752 45.248 0 35.285-28.715 64-64 64-17.109 0-33.173-6.656-45.248-18.752-4.16-4.16-10.923-4.16-15.083 0-4.16 4.139-4.16 10.923 0 15.083 16.085 16.128 37.525 25.003 60.331 25.003 47.061 0 85.333-38.272 85.333-85.333 0-22.807-8.874-44.247-25.002-60.332z" />
		                                        <path d="m270.87 172.13c-4.843-0.853-9.792-1.472-14.869-1.472-47.061 0-85.333 38.272-85.333 85.333 0 5.077 0.619 10.027 1.493 14.869 0.917 5.163 5.419 8.811 10.475 8.811 0.619 0 1.237-0.043 1.877-0.171 5.781-1.024 9.664-6.571 8.64-12.352-0.661-3.627-1.152-7.317-1.152-11.157 0-35.285 28.715-64 64-64 3.84 0 7.531 0.491 11.157 1.131 5.675 1.152 11.328-2.859 12.352-8.64s-2.858-11.328-8.64-12.352z" />
		                                        <path d="m509.46 249.1c-2.411-2.859-60.117-70.208-139.71-111.44-5.163-2.709-11.669-0.661-14.379 4.587-2.709 5.227-0.661 11.669 4.587 14.379 61.312 31.744 110.29 81.28 127.04 99.371-25.429 27.541-125.5 128-231 128-35.797 0-71.872-8.64-107.26-25.707-5.248-2.581-11.669-0.341-14.229 4.971-2.581 5.291-0.341 11.669 4.971 14.229 38.293 18.496 77.504 27.84 116.52 27.84 131.44 0 248.56-136.62 253.48-142.44 3.369-3.969 3.348-9.793-0.023-13.782z" />
		                                        <path d="m326 118.95c-24.277-8.171-47.829-12.288-69.995-12.288-131.44 0-248.56 136.62-253.48 142.44-3.115 3.669-3.371 9.003-0.597 12.992 1.472 2.112 36.736 52.181 97.856 92.779 1.813 1.216 3.84 1.792 5.888 1.792 3.435 0 6.827-1.664 8.875-4.8 3.264-4.885 1.92-11.52-2.987-14.763-44.885-29.845-75.605-65.877-87.104-80.533 24.555-26.667 125.29-128.58 231.55-128.58 19.861 0 41.131 3.755 63.189 11.157 5.589 2.005 11.648-1.088 13.504-6.699 1.878-5.589-1.109-11.626-6.698-13.504z" />
		                                        <path d="m444.86 67.128c-4.16-4.16-10.923-4.16-15.083 0l-362.67 362.67c-4.16 4.16-4.16 10.923 0 15.083 2.091 2.069 4.821 3.115 7.552 3.115s5.461-1.045 7.531-3.115l362.67-362.67c4.16-4.16 4.16-10.923 0-15.083z" /></svg>

		                                    </div>

		                                    @if($errors->first('password1'))
		                                        <p class="text-danger"> {{ $errors->first('password1') }} </p>
		                                    @endif
		                                </div>
		                            </div>

		                            <p class="fs-5 mb-2"> {{ __("For Parent / Guardian #1") }} </p>

		                            <div class="row form-group mb-3">
		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3">
		                                    <label for="inputCodeno2" class="form-label"> {{ __("Login Codeno") }} </label>
		                                    <div class="input-group">
								                <input type="text" name="logincodeg2" class="text-capitalize form-control @if ($errors->has('logincodeg2')) is-invalid @endif @if($errors->any() && !$errors->has('logincodeg2')) is-valid @endif" id="inputCodeno2" placeholder="{{ __('login-school-code for parents')}}" value="{!! old('logincodeg2') !!}">
								                <span class="input-group-text" id="inputCodeno2">
								                    . smartcamp.com
								                </span>
								            </div>
								            

		                                    @if($errors->first('logincodeg2'))
		                                        <p class="text-danger"> {{ $errors->first('logincodeg2') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3" data-password="">
		                                    <label for="inputPassword2" class="form-label"> {{ __("Password") }} </label>
		                                    <input type="password" class="form-control position-relative" id="inputPassword2" name="password2" value="{{ old('password2') }}" data-pass-target="">

		                                    <div class="password-show-hide" data-pass-show-hide="">

		                                      <svg data-pass-show="" class="password-show" viewBox="0 0 511.99 511.99">
		                                        <path d="m510.1 249.94c-4.032-5.867-100.93-143.28-254.1-143.28-131.44 0-248.56 136.62-253.48 142.44-3.349 3.968-3.349 9.792 0 13.781 4.928 5.824 122.05 142.44 253.48 142.44s248.55-136.62 253.48-142.44c3.094-3.669 3.371-8.981 0.619-12.949zm-254.1 134.06c-105.36 0-205.55-100.48-231-128 25.408-27.541 125.48-128 231-128 123.28 0 210.3 100.33 231.55 127.42-24.534 26.645-125.29 128.58-231.55 128.58z" />
		                                        <path d="m256 170.66c-47.061 0-85.333 38.272-85.333 85.333s38.272 85.333 85.333 85.333 85.333-38.272 85.333-85.333-38.272-85.333-85.333-85.333zm0 149.33c-35.285 0-64-28.715-64-64s28.715-64 64-64 64 28.715 64 64-28.715 64-64 64z" /></svg>
		                                      <svg data-pass-hide="" class="password-hide" viewBox="0 0 512 512" xml:space="preserve">
		                                        <path d="m316.33 195.66c-4.16-4.16-10.923-4.16-15.083 0s-4.16 10.944 0 15.083c12.075 12.075 18.752 28.139 18.752 45.248 0 35.285-28.715 64-64 64-17.109 0-33.173-6.656-45.248-18.752-4.16-4.16-10.923-4.16-15.083 0-4.16 4.139-4.16 10.923 0 15.083 16.085 16.128 37.525 25.003 60.331 25.003 47.061 0 85.333-38.272 85.333-85.333 0-22.807-8.874-44.247-25.002-60.332z" />
		                                        <path d="m270.87 172.13c-4.843-0.853-9.792-1.472-14.869-1.472-47.061 0-85.333 38.272-85.333 85.333 0 5.077 0.619 10.027 1.493 14.869 0.917 5.163 5.419 8.811 10.475 8.811 0.619 0 1.237-0.043 1.877-0.171 5.781-1.024 9.664-6.571 8.64-12.352-0.661-3.627-1.152-7.317-1.152-11.157 0-35.285 28.715-64 64-64 3.84 0 7.531 0.491 11.157 1.131 5.675 1.152 11.328-2.859 12.352-8.64s-2.858-11.328-8.64-12.352z" />
		                                        <path d="m509.46 249.1c-2.411-2.859-60.117-70.208-139.71-111.44-5.163-2.709-11.669-0.661-14.379 4.587-2.709 5.227-0.661 11.669 4.587 14.379 61.312 31.744 110.29 81.28 127.04 99.371-25.429 27.541-125.5 128-231 128-35.797 0-71.872-8.64-107.26-25.707-5.248-2.581-11.669-0.341-14.229 4.971-2.581 5.291-0.341 11.669 4.971 14.229 38.293 18.496 77.504 27.84 116.52 27.84 131.44 0 248.56-136.62 253.48-142.44 3.369-3.969 3.348-9.793-0.023-13.782z" />
		                                        <path d="m326 118.95c-24.277-8.171-47.829-12.288-69.995-12.288-131.44 0-248.56 136.62-253.48 142.44-3.115 3.669-3.371 9.003-0.597 12.992 1.472 2.112 36.736 52.181 97.856 92.779 1.813 1.216 3.84 1.792 5.888 1.792 3.435 0 6.827-1.664 8.875-4.8 3.264-4.885 1.92-11.52-2.987-14.763-44.885-29.845-75.605-65.877-87.104-80.533 24.555-26.667 125.29-128.58 231.55-128.58 19.861 0 41.131 3.755 63.189 11.157 5.589 2.005 11.648-1.088 13.504-6.699 1.878-5.589-1.109-11.626-6.698-13.504z" />
		                                        <path d="m444.86 67.128c-4.16-4.16-10.923-4.16-15.083 0l-362.67 362.67c-4.16 4.16-4.16 10.923 0 15.083 2.091 2.069 4.821 3.115 7.552 3.115s5.461-1.045 7.531-3.115l362.67-362.67c4.16-4.16 4.16-10.923 0-15.083z" /></svg>

		                                    </div>

		                                    @if($errors->first('password2'))
		                                        <p class="text-danger"> {{ $errors->first('password2') }} </p>
		                                    @endif
		                                </div>
		                            </div>

		                            <p class="fs-5 mb-2"> {{ __("For Parent / Guardian #2") }} </p>

		                            <div class="row form-group mb-3">
		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3">
		                                    <label for="inputCodeno3" class="form-label"> {{ __("Login Codeno") }} </label>
		                                    <div class="input-group">
								                <input type="text" name="logincodeg3" class="form-control @if ($errors->has('logincodeg3')) is-invalid @endif @if($errors->any() && !$errors->has('logincodeg3')) is-valid @endif" id="inputCodeno3" placeholder="{{ __('login-school-code for parents #2')}}" value="{!! old('logincodeg3') !!}">
								                <span class="input-group-text">
								                    . smartcamp.com
								                </span>
								            </div>
								            

		                                    @if($errors->first('logincodeg3'))
		                                        <p class="text-danger"> {{ $errors->first('logincodeg3') }} </p>
		                                    @endif
		                                </div>

		                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3" data-password="">
		                                    <label for="inputPassword" class="form-label"> {{ __("Password") }} </label>
		                                    <input type="password" class="form-control position-relative" id="inputPassword" name="password3" value="{{ old('password3') }}" data-pass-target="">

		                                    <div class="password-show-hide" data-pass-show-hide="">

		                                      <svg data-pass-show="" class="password-show" viewBox="0 0 511.99 511.99">
		                                        <path d="m510.1 249.94c-4.032-5.867-100.93-143.28-254.1-143.28-131.44 0-248.56 136.62-253.48 142.44-3.349 3.968-3.349 9.792 0 13.781 4.928 5.824 122.05 142.44 253.48 142.44s248.55-136.62 253.48-142.44c3.094-3.669 3.371-8.981 0.619-12.949zm-254.1 134.06c-105.36 0-205.55-100.48-231-128 25.408-27.541 125.48-128 231-128 123.28 0 210.3 100.33 231.55 127.42-24.534 26.645-125.29 128.58-231.55 128.58z" />
		                                        <path d="m256 170.66c-47.061 0-85.333 38.272-85.333 85.333s38.272 85.333 85.333 85.333 85.333-38.272 85.333-85.333-38.272-85.333-85.333-85.333zm0 149.33c-35.285 0-64-28.715-64-64s28.715-64 64-64 64 28.715 64 64-28.715 64-64 64z" /></svg>
		                                      <svg data-pass-hide="" class="password-hide" viewBox="0 0 512 512" xml:space="preserve">
		                                        <path d="m316.33 195.66c-4.16-4.16-10.923-4.16-15.083 0s-4.16 10.944 0 15.083c12.075 12.075 18.752 28.139 18.752 45.248 0 35.285-28.715 64-64 64-17.109 0-33.173-6.656-45.248-18.752-4.16-4.16-10.923-4.16-15.083 0-4.16 4.139-4.16 10.923 0 15.083 16.085 16.128 37.525 25.003 60.331 25.003 47.061 0 85.333-38.272 85.333-85.333 0-22.807-8.874-44.247-25.002-60.332z" />
		                                        <path d="m270.87 172.13c-4.843-0.853-9.792-1.472-14.869-1.472-47.061 0-85.333 38.272-85.333 85.333 0 5.077 0.619 10.027 1.493 14.869 0.917 5.163 5.419 8.811 10.475 8.811 0.619 0 1.237-0.043 1.877-0.171 5.781-1.024 9.664-6.571 8.64-12.352-0.661-3.627-1.152-7.317-1.152-11.157 0-35.285 28.715-64 64-64 3.84 0 7.531 0.491 11.157 1.131 5.675 1.152 11.328-2.859 12.352-8.64s-2.858-11.328-8.64-12.352z" />
		                                        <path d="m509.46 249.1c-2.411-2.859-60.117-70.208-139.71-111.44-5.163-2.709-11.669-0.661-14.379 4.587-2.709 5.227-0.661 11.669 4.587 14.379 61.312 31.744 110.29 81.28 127.04 99.371-25.429 27.541-125.5 128-231 128-35.797 0-71.872-8.64-107.26-25.707-5.248-2.581-11.669-0.341-14.229 4.971-2.581 5.291-0.341 11.669 4.971 14.229 38.293 18.496 77.504 27.84 116.52 27.84 131.44 0 248.56-136.62 253.48-142.44 3.369-3.969 3.348-9.793-0.023-13.782z" />
		                                        <path d="m326 118.95c-24.277-8.171-47.829-12.288-69.995-12.288-131.44 0-248.56 136.62-253.48 142.44-3.115 3.669-3.371 9.003-0.597 12.992 1.472 2.112 36.736 52.181 97.856 92.779 1.813 1.216 3.84 1.792 5.888 1.792 3.435 0 6.827-1.664 8.875-4.8 3.264-4.885 1.92-11.52-2.987-14.763-44.885-29.845-75.605-65.877-87.104-80.533 24.555-26.667 125.29-128.58 231.55-128.58 19.861 0 41.131 3.755 63.189 11.157 5.589 2.005 11.648-1.088 13.504-6.699 1.878-5.589-1.109-11.626-6.698-13.504z" />
		                                        <path d="m444.86 67.128c-4.16-4.16-10.923-4.16-15.083 0l-362.67 362.67c-4.16 4.16-4.16 10.923 0 15.083 2.091 2.069 4.821 3.115 7.552 3.115s5.461-1.045 7.531-3.115l362.67-362.67c4.16-4.16 4.16-10.923 0-15.083z" /></svg>

		                                    </div>

		                                    @if($errors->first('password3'))
		                                        <p class="text-danger"> {{ $errors->first('password3') }} </p>
		                                    @endif
		                                </div>
		                            </div>

		                        </section>

		                        
		                     
		                        

		                    </form>
		                </div>

		            </div>
	            </div>
	        </div>
	    </div>
	</section>


	

	@endif

@section('script_content')
	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";
    </script>

    <script src="{{ asset('assets/vendor/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/js/steps.js') }}"></script>
	<script type="text/javascript">
            var component;

		
        $(document).ready(function() {


        	if (currentLanguage == "mm") {
            	var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";
            	var subject_title = "ဘာသာရပ်";
            	var grade_title ="အတန်း";
            	var subjecttype_note = "ဒီသင်ရိုးမှာ ဘာသာရပ်အမျိုးအစားမရှိရင် အဲဒါကို ကျော်လိုက်ပါ။";
            	var majorminor_title ="အဓိကဘာသာရပ်/ သာမန်ဘာသာရပ်";
            	var maincurriculum_text = "ပင်မဘာသာရပ်များ";
            	var extracurriculum_text = "ထပ်ဆောင်းဘာသာရပ်များ";
            	var remove_btn_text = "ဖယ်ရှားပါ။";
            }
            else if(currentLanguage == "jp"){
            	var placeholder_title = "少なくとも1つのオプションを選択してください";
            	var subject_title = "主題";
            	var grade_title = "学年";
            	var subjecttype_note = "そのカリキュラムに科目タイプがない場合は、スキップしてください。";
            	var majorminor_title ="メジャー、マイナー";
            	var maincurriculum_text = "主なカリキュラム";
            	var extracurriculum_text = "課外活動";
            	var remove_btn_text = "削除";
            }
            else if(currentLanguage == "cn"){
            	var placeholder_title =  "请至少选择一个选项";
            	var subject_title = "主题";
            	var grade_title = "年级";
            	var subjecttype_note =  "如果该课程没有主题类型，请跳过它。";
            	var majorminor_title ="主要次要";
            	var maincurriculum_text = "主要课程";
            	var extracurriculum_text = "课外活动";
            	var remove_btn_text = "消除";
            }
            else if(currentLanguage == "de"){
            	var placeholder_title = "Bitte wählen Sie mindestens eine Option aus";
            	var subject_title = "Fach";
            	var grade_title = "Grad";
            	var subjecttype_note = "Wenn dieser Lehrplan keinen Fachtyp hat, überspringen Sie ihn einfach.";
            	var majorminor_title ="Dur / Moll";
            	var maincurriculum_text = "Hauptlehrplan";
            	var extracurriculum_text = "Extralehrplan";
            	var remove_btn_text = "Entfernen";
            }
            else if(currentLanguage == "fr"){
            	var placeholder_title ="Veuillez sélectionner au moins une option";
            	var subject_title = "Sujette";
            	var grade_title = "Noter";
            	var subjecttype_note ="Si ce programme n'a pas de type de matière, sautez-le simplement.";
            	var majorminor_title ="Majeur / Mineur";
            	var maincurriculum_text = "Programme principal";
            	var extracurriculum_text = "Programme supplémentaire";
            	var remove_btn_text = "Retirer";
            	
            }else{
            	var placeholder_title ="Please select at least one option";
            	var subject_title = "Subject";
            	var grade_title = "Grade";
            	var subjecttype_note ="If that curriculum has no subject type, just skip it..";
            	var majorminor_title = "Major / Minor";
            	var maincurriculum_text = "Main Curriculum";
            	var extracurriculum_text = "Extra Curriculum";
            	var remove_btn_text = "Remove";
            }
        	
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var form = $("#example-form");

            form.steps({
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                onFinished: function (event, currentIndex)
                {
                    
                    form.submit();

                }
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#example-form').on('change','#imageUpload', function()
            {
                readURL(this);
            });


            const dob = document.querySelector('#inputDob');
	        const dob_datepicker = new Datepicker(dob, {
	            autohide: true,
	            'format': 'dd MM yyyy',
	            title: 'Date of Birth (dd MM yyyy)',
                autohide: true,

	        });

	        const registerdate = document.querySelector('#inputRegisterdate');
	        const registerdate_datepicker = new Datepicker(registerdate, {
	            autohide: true,
	            'format': 'dd MM yyyy',
	            title: 'Registry Date (dd MM yyyy)',
                autohide: true,

	        });


	        (function() {
			    "use strict";
			    var jQueryPlugin = (window.jQueryPlugin = function(ident, func) {
			        return function(arg) {
			            if (this.length > 1) {
			                this.each(function() {
			                    var $this = $(this);

			                    if (!$this.data(ident)) {
			                        $this.data(ident, func($this, arg));
			                    }
			                });

			                return this;
			            } else if (this.length === 1) {
			                if (!this.data(ident)) {
			                    this.data(ident, func(this, arg));
			                }

			                return this.data(ident);
			            }
			        };
			    });
			})();

			(function() {
			    "use strict";

			    function Pass_Show_Hide($root) {
			        const element = $root;
			        const pass_target = $root.first("data-password");
			        const pass_elemet = $root.find("[data-pass-target]");
			        const pass_show_hide_btn = $root.find("[data-pass-show-hide]");
			        const pass_show = $root.find("[data-pass-show]");
			        const pass_hide = $root.find("[data-pass-hide]");
			        $(pass_hide).hide();
			        $(pass_show_hide_btn).click(function() {
			            if (pass_elemet.attr("type") === "password") {
			                pass_elemet.attr("type", "text");
			                $(pass_show).hide();
			                $(pass_hide).show();
			            } else {
			                pass_elemet.attr("type", "password");
			                $(pass_hide).hide();
			                $(pass_show).show();
			            }
			        });
			    }
			    $.fn.Pass_Show_Hide = jQueryPlugin("Pass_Show_Hide", Pass_Show_Hide);
			    $("[data-password]").Pass_Show_Hide();
			})();

			

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

            function custom_template(obj){
		        var data = $(obj.element).data();
		        var text = $(obj.element).text();
		        var text_arr = text.split("-");

		        var name = text_arr[0];


		        if(data && data['img_src']){
		            img_src = data['img_src'];
		            template = $("<div><img src=\"" + img_src + "\" style=\"width:30px;height:30px;\"/><p style=\"font-weight: 700;display:inline;margin-left:10px;\">"+ 
		                        "<span>" + name + "</span> </p></div>");
		            return template;
		        }
		    }
		    
		    var options = {
		        'templateSelection': custom_template,
		        'templateResult': custom_template,
		        // allowClear: true,
		        theme: 'bootstrap5',
		        width: '100%',
                placeholder: placeholder_title,
		        // dropdownParent: $("#paymentModal")
		    }
		    $('.sport_select2').select2(options);


            $('#example').change(function() {
                if($(this).is(":checked")) {
                    $('#teacherDiv').show();
                }
                else {
                    $('#teacherDiv').hide();

                }
            });

            function initImageUpload(box) {
			    let uploadField = box.querySelector('.image-upload');

			    uploadField.addEventListener('change', getFile);

			    function getFile(e) {
			        let file = e.currentTarget.files[0];
			        checkType(file);
			    }

			    function previewImage(file) {
			        let thumb = box.querySelector('.js--image-preview'),
			            reader = new FileReader();

			        reader.onload = function() {
			            thumb.style.backgroundImage = 'url(' + reader.result + ')';
			        }
			        reader.readAsDataURL(file);
			        thumb.className += ' js--no-default';
			    }

			    function checkType(file) {
			        let imageType = /image.*/;
			        if (!file.type.match(imageType)) {
			            throw 'Datei ist kein Bild';
			        } else if (!file) {
			            throw 'Kein Bild gewählt';
			        } else {
			            previewImage(file);
			        }
			    }

			}

			// initialize box-scope
			var boxes = document.querySelectorAll('.box');

			for (let i = 0; i < boxes.length; i++) {
			    let box = boxes[i];
			    initDropEffect(box);
			    initImageUpload(box);
			}



			/// drop-effect
			function initDropEffect(box) {
			    let area, drop, areaWidth, areaHeight, maxDistance, dropWidth, dropHeight, x, y;

			    // get clickable area for drop effect
			    area = box.querySelector('.js--image-preview');
			    area.addEventListener('click', fireRipple);

			    function fireRipple(e) {
			        area = e.currentTarget
			        // create drop
			        if (!drop) {
			            drop = document.createElement('span');
			            drop.className = 'drop';
			            this.appendChild(drop);
			        }
			        // reset animate class
			        drop.className = 'drop';

			        // calculate dimensions of area (longest side)
			        areaWidth = getComputedStyle(this, null).getPropertyValue("width");
			        areaHeight = getComputedStyle(this, null).getPropertyValue("height");
			        maxDistance = Math.max(parseInt(areaWidth, 10), parseInt(areaHeight, 10));

			        // set drop dimensions to fill area
			        drop.style.width = maxDistance + 'px';
			        drop.style.height = maxDistance + 'px';

			        // calculate dimensions of drop
			        dropWidth = getComputedStyle(this, null).getPropertyValue("width");
			        dropHeight = getComputedStyle(this, null).getPropertyValue("height");

			        // calculate relative coordinates of click
			        // logic: click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center
			        x = e.pageX - this.offsetLeft - (parseInt(dropWidth, 10) / 2);
			        y = e.pageY - this.offsetTop - (parseInt(dropHeight, 10) / 2) - 30;

			        // position drop and animate
			        drop.style.top = y + 'px';
			        drop.style.left = x + 'px';
			        drop.className += ' animate';
			        e.stopPropagation();

			    }
			}


        });
    </script>

@stop
</x-template>