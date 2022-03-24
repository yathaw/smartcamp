<x-template>
	@section('style_content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/pdfViewer/style.css') }}">

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
	    <h1> {{ __("Staff")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Create New Staff")}}</li>
	        </ol>
	    </nav>
	</div>
	
	@if($subjects->isEmpty() || $positions->isEmpty())

		<!-- End Page Title -->
		<section class="section" id="emptyState">
		    <div class="row">
		        <div class="col-lg-12">
		            <div class="card">
		                <div class="card-body pt-4 d-flex flex-column align-items-center">
		                	<div class="container ">
			                	<div class="row align-items-center justify-content-center">
			                		<div class="col-6  text-center">

			                			@if($subjects->isEmpty() && $positions->isEmpty())
			                    			<img src="{{ asset('assets/img/empty_subject.svg') }}" class="img-fluid text-center">
			                    		@else
				                			@if($subjects->isEmpty())
				                    			<img src="{{ asset('assets/img/empty_subject.svg') }}" class="img-fluid text-center">
				                    		@endif
				                    		@if($positions->isEmpty())
				                    			<img src="{{ asset('assets/img/empty.svg') }}" class="img-fluid text-center">
				                    		@endif
				                    	@endif
			                		</div>
			                	</div>
			                </div>
			                @if($subjects->isEmpty() && $positions->isEmpty())
				                    <h2> {{ __("No Curricula Data Found") }} </h2>
				                    <p> {{ __("There have been no curricula in this section yet. Please add some subjects first.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.curriculum.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Curricula")}} </a>
									</div>
							@else
				                @if($subjects->isEmpty())
				                    <h2> {{ __("No Curricula Data Found") }} </h2>
				                    <p> {{ __("There have been no curricula in this section yet. Please add some subjects first.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.curriculum.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Curricula")}} </a>
									</div>
								@endif

				                @if($positions->isEmpty())
				                	<h2> {{ __("No Data Found") }} </h2>
				                    <p> {{ __("There have been no data in this section yet.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.department.index') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add New")}} </a>
									</div>

				                @endif
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
	                    	{{ __("Add New Staff") }}
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
		                    <form id="example-form" action="{{ route('master.staff.store') }}" class="new-added-form tab-wizard wizard-circle wizard clearfix g-3" method="POST" enctype="multipart/form-data">
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
		                                </div>
		                                <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
		                                    <div class="row">
		                                        <div class="form-group col-xl-9 col-lg-6 col-12 mb-3">
			                                        <label for="inputName" class="form-label"> {{ __("Name")}}</label>
			                                        <input type="text" name="name" id="inputName" class="form-control @if ($errors->has('name')) is-invalid @endif @if($errors->any() && !$errors->has('name')) is-valid @endif" value="{{ old('name') }}" placeholder="{{ __("Name")}}">

			                                        <p class="text-danger">
			                                            {{ $errors->first('name') }}
			                                        </p>
			                                    </div>

			                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
					                                <label class="mb-2"> {{ __("Gender") }} *</label>
					                                <div class="switch-field">
					                                    <input type="radio" id="radio-one" name="gender" value="Male" @if(old('gender') == "Male") checked @endif/>
					                                    <label for="radio-one"> {{ __("Male") }} </label>
					                                    <input type="radio" id="radio-two" name="gender" value="Female" @if(old('gender') == "Female") checked @endif/>
					                                    <label for="radio-two"> {{ __("Female") }} </label>
					                                </div>

					                                <p class="text-danger">
			                                            {{ $errors->first('gender') }}
			                                        </p>
					                            </div>

		                                        <div class="form-group col-12 mb-3">
			                                        <label for="inputNrc" class="form-label">{{ __("NRC / Passport")}}</label>
			                                        <input type="text" name="nrc" id="inputNrc" class="form-control @if ($errors->has('nrc')) is-invalid @endif @if($errors->any() && !$errors->has('nrc')) is-valid @endif" placeholder="{{ __("NRC / Passport")}}" value="{!! old('nrc') !!}">
			                                        <p class="text-danger">
			                                            {{ $errors->first('nrc') }}
			                                        </p>
			                                    </div>

		                                        <div class="form-group col-12 mb-3">
				                                    <label for="inputDob" class="form-label">{{ __("Date of Birth")}}</label>
				                                    <input type="text" name="dob" id="inputDob" class="form-control @if ($errors->has('dob')) is-invalid @endif @if($errors->any() && !$errors->has('dob')) is-valid @endif" placeholder="{{ __("DD/MM/YYYY") }}" value="{!! old('dob') !!}">
				                                    <p class="text-danger">
				                                        {{ $errors->first('dob') }}
				                                    </p>
					                            </div>

					                            
		                                    </div>
		                                </div>
		                                
		                            </div>

		                            <div class="row form-group mb-3">

		                                <div class="col-md-12">
		                                    <label for="inputEmail" class="form-label"> {{ __("Email") }} </label>
		                                    <input type="email" class="form-control" id="inputEmail" placeholder="{{ __("Email") }}" name="email" value="{{ old('email') }}">

		                                    @if($errors->first('email'))
		                                        <p class="text-danger"> {{ $errors->first('email') }} </p>
		                                    @endif
		                                </div>
		                            </div>

		                            <div class="row form-group mb-3" data-password="">
		                                <div class="col-md-12">
		                                    <label for="inputPassword" class="form-label"> {{ __("Password") }} </label>
		                                    <input type="password" class="form-control position-relative" id="inputPassword" name="password" value="{{ old('password') }}" data-pass-target="">

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

		                                    @if($errors->first('password'))
		                                        <p class="text-danger"> {{ $errors->first('password') }} </p>
		                                    @endif
		                                </div>
		                            </div>

		                            
		                        </section>
		                     
		                        <h6> {{ __("Contact Info") }} </h6>
		                        <section class="container">

		                            <div class="row form-group mb-3">
		                                <div class="col-12">
		                                    <label for="inputAddress" class="form-label">{{ __("Address") }}</label>
		                                    <textarea class="form-control @if ($errors->has('address')) is-invalid @endif @if($errors->any() && !$errors->has('address')) is-valid @endif" id="inputAddress" name="address">{!! old('address') !!}</textarea>

		                                    <p class="text-danger">
		                                        {{ $errors->first('address') }}
		                                    </p>
		                                </div>
		                            </div>
		                     
		                            <div class="row form-group mb-3">
		                                <div class="col-md-12">
		                                    <label for="inputPhone" class="form-label"> {{ __("Phone Number") }} </label>
		                                    <button type="button" class="btn btn-dark add_phoneno float-end btn-sm">  
		                                        <i class="bi bi-plus-lg me-1"></i>
		                                        Add More Phone 
		                                    </button>

		                                    <input type="text" class="form-control my-2" id="inputPhone" placeholder="E.g (+95) 987654321" name="phoneno[]" value="{{ old('phoneno[0]') }}">

		                                    <div class="phoneno_morewrapperField"></div>
		                                
		                                    @if($errors->first('phoneno'))
		                                        <p class="text-danger"> {{ $errors->first('phoneno') }} </p>
		                                    @endif

		                                    
		                                </div>
		                            </div>
		                            
		                            
		                           
		                        </section>

		                                          
		                        <h6> {{ __("Extra Info") }} </h6>
		                        <section class="container">
		                            <div class="row form-group mb-3">
		                                <div class="col-md-12">
		                                    <label for="inputPosition" class="form-label"> {{ __("Position / Departments") }} </label>
		                                    <select class="select2" name="positionid" id="inputPosition">
		                                        <option value=""></option>
		                                        @foreach($departments as $department)
		                                        	<optgroup label="{{ $department->name }}" class="dropdown-header text-info">
		                                        		@foreach($department->positions as $position)
				                                            <option value="{{ $position->id }}"> 
				                                                {{ $position->name }} 
				                                            </option>
				                                        @endforeach
				                                        <hr class="dropdown-divider"></li>
		                                        	</optgroup>
  												

		                                        @endforeach
		                                        
		                                    </select>

		                                    @if($errors->first('positionid'))
		                                        <p class="text-danger"> {{ $errors->first('positionid') }} </p>
		                                    @endif

		                                </div>
		                            </div>

		                            <div class="row form-group mb-3">
		                                <div class="col-xl-4 col-lg-4 col-12">
			                                <div class="form-group mb-3">
			                                    <label for="inputJod" class="form-label">{{ __("Join of Date")}}</label>
			                                    <input type="text" name="jod" id="inputJod" class="form-control datepicker_input @if ($errors->has('jod')) is-invalid @endif @if($errors->any() && !$errors->has('jod')) is-valid @endif" placeholder="{{ __('DD/MM/YYYY') }}" value="{!! old('jod') !!}">
			                                    <p class="text-danger">
			                                        {{ $errors->first('jod') }}
			                                    </p>
			                                </div>
			                            </div>
		                                
		                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
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
		                            
		                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
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
		                            </div>

		                            <div class="row form-group mb-3">
		                                <div class="col-md-12">
		                                    <label for="inputDegree" class="form-label"> {{ __("Degree") }} </label>
		                                    <button class="btn btn-dark add_degree float-end btn-sm">  
		                                        <i class="bi bi-plus-lg me-1"></i>
		                                        {{ __("Add More Degree") }}
		                                    </button>

		                                    <input type="text" class="form-control my-2" id="inputDegree" placeholder="E.g B.E" name="degree[]" value="{{ old('degree')[0] }}">

		                                    <div class="degree_morewrapperField"></div>
		                                 
		                                </div>
		                                @if($errors->first('degree'))
	                                        <p class="text-danger"> {{ $errors->first('degree') }} </p>
	                                    @endif
		                            </div>


		                        </section>

		                        <h6> {{ __("Related Info") }} </h6>
		                        <section class="container">
		                            
		                            <div class="row form-group mb-5">
		                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
		                                    <label for="inputJoindate" class="form-label"> {{ __("Necessary File") }} </label>
		                                    <input type="file" name="file">
		                                    <small class="d-block"> {{ __("Please upload file like cv (*.PDF)") }} </small>
		                                </div>
		                                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
		                                </div>

		                                @if($errors->has('file'))
		                                    <span class="text-danger fs-6"> {{ $errors->first('file') }} </span>
		                                @elseif($errors->any() && !$errors->has('file')) 
		                                    <span class="text-danger fs-6"> <strong> {{ __("Upload Error!") }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
		                                @endif
		                            </div>

		                            <div class="row form-group mb-3">
		                                <div class="col-12 mb-3">
		                                    <label> {{ __("Is this staff is teacher?") }} </label>
		                                </div>
		                                <div class="col-12">
		                                    <div class="toggle-wrapper">
		                                        <input id="example" class="toggle" type="checkbox" name="teacherstatus" />
		                                        <label for="example" class="toggle--label"></label>
		                                        <div class="foux-toggle"></div>
		                                    </div>
		                                </div>

		                                <div class="mt-3" id="teacherDiv">

		                                    <div class="row mt-3">
		                                        <div class="col-12 form-group mb-3">
		                                            <label for="inputSubject">{{ __("Subject") }} *</label>
		                                            <select class="select2 subjects" name="subjects[]" id="inputSubject" multiple ="">
		                                                <option></option>
		                                                @foreach($subjects as $subject)
		                                                	<option value="{{ $subject->id }}"> 
		                                                		{{ $subject->name }} ( {{ $subject->otherlanguage }} )
		                                                	</option>
		                                                @endforeach
		                                            </select>
		                                        </div>

		                                    </div>



		                                </div>
		                            </div>


		                        </section>
		                     
		                        <h6> Permission Access </h6>
		                        <section class="container">

		                            <h4> Permit Access to Control the system </h4>
		                            <div id="sfield" class="input-group px-4" style="display:none;">
		                                <div class="input-group-prepend">
		                                    <span class="input-group-text"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
		                                </div>
		                                <input id="txt-search" class="form-control" type="text" placeholder="Search" aria-label="Search">
		                            </div>

		                            <div class="row form-group mb-4">
		                                @foreach($permissions as $permission)
		                                    <div class="col-3">
		                                        <div class="form-check form-check-inline">
		                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox{{ $permission->id }}" value="{{ $permission->id }}" checked="" name="permissions[]">
		                                            <label class="form-check-label" for="inlineCheckbox{{ $permission->id }}"> {{ $permission->name }}</label>
		                                        </div>
		                                    </div>
		                                @endforeach
		                            </div>

		                            @if($errors->has('permissions'))
	                                    <span class="text-danger fs-6"> {{ $errors->first('permissions') }} </span>
	                                @endif

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

	        const jod = document.querySelector('input[name="jod"]');
            const jod_datepicker = new Datepicker(jod, {
                'format': 'yyyy/mm/dd',
                title: 'Join of Date (DD/MM/YYYY)',
                autohide: true,
                orientation: 'top left'

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

			var max_fields = 10; //Maximum allowed input fields 
            var phoneno_wrapper    = $(".phoneno_morewrapperField"); //Input fields wrapper
            var degree_wrapper    = $(".degree_morewrapperField"); //Input fields wrapper

            var add_answerBtn = $(".add_phoneno"); //Add button class or ID
            var add_degreeBtn = $(".add_degree"); //Add button class or ID

            var x = 1; //Initial input field is set to 1
            var y =1;

            $(add_answerBtn).click(function(e) {

                e.preventDefault();
                //Check maximum allowed input fields
                    if(x < max_fields){ 
                    x++; //input field increment
                    //add input field
                    $(phoneno_wrapper).append(`<div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="E.g (+95) 987654321" name="phoneno[]">
                                        <button class="btn btn-danger remove_phonenofield" type="button" id="button-addon2"> 
                                        	<i class="bi bi-x-lg"></i> 
                                        </button>
                                    </div>`);
                    }

                });

                
                 
                //when user click on remove button
                $(phoneno_wrapper).on("click",".remove_phonenofield", function(e){ 
                    e.preventDefault();
                $(this).parent('div').remove(); //remove inout field
                x--; //inout field decrement

            });

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

        	$('.select2-results__group').addClass('text-info');

        	$('#teacherDiv').hide();

            $('#example').change(function() {
                if($(this).is(":checked")) {
                    $('#teacherDiv').show();
                }
                else {
                    $('#teacherDiv').hide();

                }
            });

            $(add_degreeBtn).click(function(e) {

                e.preventDefault();
                //Check maximum allowed input fields
                    if(y < max_fields){ 
                    y++; //input field increment
                    //add input field
                    $(degree_wrapper).append(`<div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="E.g BE" name="degree[]">
                                        <button class="btn btn-danger remove_degreefield" type="button" id="button-addon2">
                                        	<i class="bi bi-x-lg"></i> 
                                        </button>
                                    </div>`);
                    }

                });

                
                 
                //when user click on remove button
                $(degree_wrapper).on("click",".remove_degreefield", function(e){ 
                    e.preventDefault();
                $(this).parent('div').remove(); //remove inout field
                y--; //inout field decrement

            });

        });
    </script>

@stop
</x-template>