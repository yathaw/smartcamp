<x-template>
	@php
	    $authRole = Auth::user()->getRoleNames()[0];
	    $authuser = Auth::user();
	@endphp

	<section class="section profile">
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

	    <div class="row">
	        <div class="col-xl-4">
	            <div class="card">
	                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
	                    <img src="{{ asset($authuser->profile_photo_path) }}" alt="Profile" class="rounded-circle">
	                    <h2>{{ $authuser->name }}</h2>
	                    <h3>{{ $authRole }}</h3>
	                    
	                </div>
	            </div>
	        </div>
	        <div class="col-xl-8">
	        	

	            <div class="card h-100">
	                <div class="card-body pt-3 h-100">
	                    <!-- Bordered Tabs -->
	                    <ul class="nav nav-tabs nav-tabs-bordered">
	                        <li class="nav-item">
	                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
	                        </li>
	                        <li class="nav-item">
	                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#info-edit">Setting</button>
	                        </li>
	                        <li class="nav-item">
	                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
	                        </li>
	                        <li class="nav-item">
	                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
	                        </li>
	                    </ul>
	                    <div class="tab-content h-100 pt-2">
	                        <div class="tab-pane fade show active profile-overview " id="profile-overview">
	                        	@if($authRole == "Student")
		                            @if($authuser->student->bio)
	                        		<h5 class="card-title">
	                        			Bio
	                        		</h5>
	                        		<p class="small fst-italic">
	                        			{{ $authuser->student->bio }}
	                        		</p>
	                        		@endif
                        		@endif

	                            <h5 class="card-title">Profile Details</h5>
	                            <div class="row">
	                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
	                                <div class="col-lg-9 col-md-8">{{ $authuser->name }}</div>
	                            </div>
	                            @if($authRole != "Software Admin")
	                            	@if(in_array($authRole,["School Admin", "Principal", "Staff", "Teacher"]))
		                            <div class="row">
	                                    <div class="col-lg-3 col-md-4 label "> {{ __("Joining Date") }} </div>
	                                    <div class="col-lg-9 col-md-8">{{ date('d. m. Y',strtotime($authuser->staff->joindate)) }}</div>
	                                </div>

	                                @if($authuser->staff->status != 'Active')
	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label "> {{ __("Leave Date") }} </div>
	                                    <div class="col-lg-9 col-md-8">{{ date('d. m. Y',strtotime($authuser->staff->leavedate)) }}</div>
	                                </div>
	                                @endif

	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label "> {{ __("Email") }} </div>
	                                    <div class="col-lg-9 col-md-8">{{ $authuser->staff->workemail }}</div>
	                                </div>

	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label "> {{ __("NRC / Passport") }} </div>
	                                    <div class="col-lg-9 col-md-8">{{ $authuser->staff->nrc }}</div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Degree") }}</div>
	                                    <div class="col-lg-9 col-md-8">
	                                    	@php 
	                                    		$degrees = json_decode($authuser->staff->degree,true); 
	                                    	@endphp
	                  			            @foreach($degrees as $degree)
	                                    		{{ $loop->first ? '' : ', ' }}
	                                            {{$degree}}
	                                    	@endforeach
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Gender") }}</div>
	                                    <div class="col-lg-9 col-md-8">{{ $authuser->staff->gender }}</div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Country") }}</div>
	                                    <div class="col-lg-9 col-md-8">{{ $authuser->staff->country->name }}</div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Address") }}</div>
	                                    <div class="col-lg-9 col-md-8">{{ $authuser->staff->address }}</div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Phone") }}</div>
	                                    <div class="col-lg-9 col-md-8">
	                                    	@php 
	                                    		$phones = json_decode($authuser->staff->phone,true); 
	                                    	@endphp
	                  			            @foreach($phones as $phone)
	                                    		{{ $loop->first ? '' : ', ' }}
	                                            {{$phone}}
	                                    	@endforeach
	                                    </div>
	                                </div>
	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Date of Birth") }}</div>
	                                    <div class="col-lg-9 col-md-8">{{ date('d M, Y',strtotime($authuser->staff->dob)) }}</div>
	                                </div>

	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Religion") }}</div>
	                                    <div class="col-lg-9 col-md-8">{{ $authuser->staff->religion->name }}</div>
	                                </div>

	                                <div class="row">
	                                    <div class="col-lg-3 col-md-4 label">{{ __("Blood") }}</div>
	                                    <div class="col-lg-9 col-md-8">{{ $authuser->staff->blood->name }}</div>
	                                </div>
		                            @endif

		                            @if($authRole == "Student")
		                            	<div class="row">
		                                    <div class="col-lg-3 col-md-4 label "> {{ __("Register Date") }} </div>
		                                    <div class="col-lg-9 col-md-8">{{ date('d. m. Y',strtotime($authuser->student->registerdate)) }}</div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Gender") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->student->gender }}</div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Country") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->student->country->name }}</div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Address") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->student->address }}</div>
		                                </div>
		                                
		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Date of Birth") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ date('d M, Y',strtotime($authuser->student->dob)) }}</div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Previous School Name") }}</div>
		                                    <div class="col-lg-9 col-md-8">
		                                    	@if($authuser->student->psn)
		                                    		{{ $authuser->student->psn }}
		                                    	@else
		                                    		-
		                                    	@endif
		                                    </div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Academic Awards") }}</div>
		                                    <div class="col-lg-9 col-md-8">
		                                    	@if($authuser->student->academicawards)
		                                    		{{ $authuser->student->academicawards }}
		                                    	@else
		                                    		-
		                                    	@endif
		                                    </div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Religion") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->student->religion->name }}</div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Blood") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->student->blood->name }}</div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Interest Sport") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->student->sport->name }}</div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Other Interest") }}</div>
		                                    <div class="col-lg-9 col-md-8">
		                                    	@if($authuser->student->otherinterest)
		                                    		{{ $authuser->student->otherinterest }}
		                                    	@else
		                                    		-
		                                    	@endif
		                                    </div>
		                                </div>

		                              
		                                
		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Login Email") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->student->user->email }}</div>
		                                </div>
		                                <div class="">
		                                	<ul class="list-group list-group-horizontal">
											  	<li class="list-group-item col-4"> Ferry </li>
											  	<li class="list-group-item col-4"> Lunchbox </li>
											  	<li class="list-group-item col-4"> Dormitory </li>
											</ul>
											<ul class="list-group list-group-horizontal-sm">
											  	<li class="list-group-item col-4">
											  		@if($authuser->student->ferry == "Yes")
		                                    			✅
			                                    	@else
			                                    		❌
			                                    	@endif
											  	</li>
											  	<li class="list-group-item col-4">
											  		@if($authuser->student->lunchbox == "Yes")
		                                    			✅
			                                    	@else
			                                    		❌
			                                    	@endif
											  	</li>
											  	<li class="list-group-item col-4">
											  		@if($authuser->student->dormitory == "Yes")
		                                    			✅
			                                    	@else
			                                    		❌
			                                    	@endif
											  	</li>
											</ul>
		                                </div>
		                            @endif

		                            @if($authRole == "Guardian")
		                            	@foreach($authuser->guardian->students as $gs)

			                            	<div class="row">
			                                    <div class="col-lg-3 col-md-4 label">{{ __("Student Name") }}</div>
			                                    <div class="col-lg-9 col-md-8">{{ $gs->user->name }}
			                                    </div>
			                                </div>
			                            @endforeach
			                                <div class="row">
			                                    <div class="col-lg-3 col-md-4 label">{{ __("Relationship of Student") }}</div>
			                                    <div class="col-lg-9 col-md-8">{{ $authuser->guardian->relatiionship }}
			                                    </div>
			                                </div>
		                                
		                            	<div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Work Email") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->guardian->workemail }}</div>
		                                </div>
		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Phone") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->guardian->phone }}</div>
		                                </div>

		                                <div class="row">
		                                    <div class="col-lg-3 col-md-4 label">{{ __("Occupation") }}</div>
		                                    <div class="col-lg-9 col-md-8">{{ $authuser->guardian->occupation }}</div>
		                                </div>
	                            	@endif
	                            @endif


	                            <div class="row">
	                                <div class="col-lg-3 col-md-4 label">Login Email</div>
	                                <div class="col-lg-9 col-md-8">{{ $authuser->email }}</div>
	                            </div>
	                        </div>
	                        <div class="tab-pane fade info-edit pt-3 h-100 pb-5" id="info-edit">
	                            <!-- Profile Edit Form -->
	                            <form action="{{ route('master.profile.update',$authuser->id) }}" method="POST">

	                            	@method('PATCH')
	                            	@csrf
	                                
	                                <div class="row mb-3">
	                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">{{ __("Name")}}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <input name="name" type="text" class="form-control" id="fullName" value="{{ $authuser->name }}">
	                                    </div>
	                                </div>
	                                @if(in_array($authRole,["School Admin", "Principal", "Staff", "Teacher"]))
	                                <div class="row mb-3">
	                                	<label class="mb-2 col-md-4 col-lg-3 col-form-label"> {{ __("Gender") }} *</label>
		                                <div class="switch-field col-md-8 col-lg-9">
		                                    <input type="radio" id="radio-one" name="gender" value="Male" @if($authuser->staff->gender == "Male") checked @endif/>
		                                    <label for="radio-one"> {{ __("Male") }} </label>
		                                    <input type="radio" id="radio-two" name="gender" value="Female" @if($authuser->staff->gender == "Female") checked @endif/>
		                                    <label for="radio-two"> {{ __("Female") }} </label>
		                                </div>
	                                </div>
	                                
	                                <div class="row mb-3">
	                                    <label for="nrc" class="col-md-4 col-lg-3 col-form-label">{{ __("NRC / Passport")}}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <input name="nrc" type="text" class="form-control" id="nrc" value="{{ $authuser->staff->nrc }}">
	                                    </div>
	                                </div>
	                                <div class="row mb-3">
	                                    <label for="inputDob" class="col-md-4 col-lg-3 col-form-label">{{ __("Date of Birth")}}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <input type="text" name="dob" id="inputDob" class="form-control @if ($errors->has('dob')) is-invalid @endif @if($errors->any() && !$errors->has('dob')) is-valid @endif" placeholder="{{ __("DD/MM/YYYY") }}" value="{{ date('d M Y',strtotime($authuser->staff->dob)) }}">
	                                    </div>
	                                </div>
	                                <div class="row mb-3">
	                                	<label for="inputPhone" class="col-md-4 col-lg-3 col-form-label">{{ __("Phone No")}}</label>
	                                	@php 
	                                		$phones = json_decode($authuser->staff->phone,true); 

	                                	@endphp
	                                    <div class="col-md-8 col-lg-9">
	                                    	<input name='phoneno[]' value='{{ implode(",",$phones); }}' class="form-control phonenoTag">
	                                    </div>
	                                </div>
	                                <div class="row mb-3">
	                                    <label for="inputEmail" class="col-md-4 col-lg-3 col-form-label">{{ __("Email") }}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <input type="email" class="form-control" id="inputEmail" placeholder="{{ __("Email") }}" name="email" value="{{ $authuser->staff->workemail }}">

		                                    @if($errors->first('email'))
		                                        <p class="text-danger"> {{ $errors->first('email') }} </p>
		                                    @endif
	                                    </div>
	                                </div>
	                                <div class="row mb-3">
	                                    <label for="inputBlood" class="col-md-4 col-lg-3 col-form-label">{{ __("Blood") }}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <select class="select2" name="bloodid" id="inputBlood">
		                                        <option></option>
		                                        @foreach($bloods as $blood)
		                                            <option value="{{ $blood->id }}" @if($authuser->staff->blood_id == $blood->id ) selected @endif> {{ $blood->name }} </option>
		                                        @endforeach
		                                    </select>

		                                    @if($errors->first('bloodid'))
		                                        <p class="text-danger"> {{ $errors->first('bloodid') }} </p>
		                                    @endif
	                                    </div>
	                                </div>
	                                <div class="row mb-3">
	                                    <label for="inputReligion" class="col-md-4 col-lg-3 col-form-label">{{ __("Religion") }}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <select class="select2" name="religionid" id="inputReligion">
		                                        <option></option>
		                                        @foreach($religions as $religion)
		                                            <option value="{{ $religion->id }}" @if($authuser->staff->religion_id == $religion->id ) selected @endif> {{ $religion->name }} </option>
		                                        @endforeach
		                                    </select>

		                                    @if($errors->first('religionid'))
		                                        <p class="text-danger"> {{ $errors->first('religionid') }} </p>
		                                    @endif
	                                    </div>
	                                </div>

	                                <div class="row mb-3">
	                                    <label for="inputCountry" class="col-md-4 col-lg-3 col-form-label">{{ __("Country") }}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <select class="select2" name="countryid" id="inputCountry">
		                                        <option></option>
		                                        @foreach($countries as $country)
		                                            <option value="{{ $country->id }}" @if($authuser->staff->country_id == $country->id ) selected @endif> {{ $country->name }} </option>
		                                        @endforeach
		                                    </select>

		                                    @if($errors->first('countryid'))
		                                        <p class="text-danger"> {{ $errors->first('countryid') }} </p>
		                                    @endif
	                                    </div>
	                                </div>

	                                <div class="row mb-3">
	                                	<label for="inputDegree" class="col-md-4 col-lg-3 col-form-label">{{ __("Degree")}}</label>
	                                	@php 
	                                		$degrees = json_decode($authuser->staff->degree,true); 

	                                	@endphp
	                                    <div class="col-md-8 col-lg-9">
	                                    	<input name='degree[]' value='{{ implode(",",$degrees); }}' class="form-control degreeTag">
	                                    </div>
	                                </div>
	                                
	                                <div class="row mb-3">
	                                    <label for="about" class="col-md-4 col-lg-3 col-form-label">{{ __("Address") }}</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <textarea class="form-control @if ($errors->has('address')) is-invalid @endif @if($errors->any() && !$errors->has('address')) is-valid @endif" id="inputAddress" name="address">{!! $authuser->staff->address !!}</textarea>

		                                    <p class="text-danger">
		                                        {{ $errors->first('address') }}
		                                    </p>
	                                    </div>
	                                </div>
	                                @endif

	                                @if($authRole == "Student")
	                                	<div class="row mb-3">
		                                    <label for="inputDob" class="col-md-4 col-lg-3 col-form-label">{{ __("Date of Birth")}}</label>
		                                    <div class="col-md-8 col-lg-9">
		                                        <input type="text" name="studob" id="inputDob" class="form-control @if ($errors->has('dob')) is-invalid @endif @if($errors->any() && !$errors->has('dob')) is-valid @endif" placeholder="{{ __("DD/MM/YYYY") }}" value="{{ date('d M Y',strtotime($authuser->student->dob)) }}">
		                                    </div>
		                                </div>


		                                <div class="row mb-3">
		                                	<label class="mb-2 col-md-4 col-lg-3 col-form-label"> {{ __("Gender") }} *</label>
			                                <div class="switch-field col-md-8 col-lg-9">
			                                    <input type="radio" id="radio-one" name="stugender" value="Male" @if($authuser->student->gender == "Male") checked @endif/>
			                                    <label for="radio-one"> {{ __("Male") }} </label>
			                                    <input type="radio" id="radio-two" name="stugender" value="Female" @if($authuser->student->gender == "Female") checked @endif/>
			                                    <label for="radio-two"> {{ __("Female") }} </label>
			                                </div>
		                                </div>
	                                	<div class="row mb-3">
		                                    <label for="nativeName" class="col-md-4 col-lg-3 col-form-label">{{ __("Native Name")}}</label>
		                                    <div class="col-md-8 col-lg-9">
		                                        <input name="nativename" type="text" class="form-control" id="nativeName" value="{{ $authuser->student->nativename }}">
		                                    </div>
		                                </div>

		                                
	                                @endif

	                                @if($authRole == "Guardian")
	                                	<div class="row mb-3">
		                                    <label for="g_workemail" class="col-md-4 col-lg-3 col-form-label">{{ __("Work Email")}}</label>
		                                    <div class="col-md-8 col-lg-9">
		                                        <input name="g_workemail" type="text" class="form-control" id="g_workemail" value="{{ $authuser->guardian->workemail }}">
		                                    </div>
		                                </div>
	                                
	                                	<div class="row mb-3">
		                                    <label for="g_phone" class="col-md-4 col-lg-3 col-form-label">{{ __("Phone")}}</label>
		                                    <div class="col-md-8 col-lg-9">
		                                        <input name="g_phone" type="text" class="form-control" id="g_phone" value="{{ $authuser->guardian->phone }}">
		                                    </div>
		                                </div>

		                                <div class="row mb-3">
		                                    <label for="g_occupation" class="col-md-4 col-lg-3 col-form-label">{{ __("Work Email")}}</label>
		                                    <div class="col-md-8 col-lg-9">
		                                        <input name="g_occupation" type="text" class="form-control" id="g_occupation" value="{{ $authuser->guardian->occupation }}">
		                                    </div>
		                                </div>

	                                @endif




	                                <div class="text-center pb-5">
	                                    <button type="submit" class="btn btn-primary">Save Changes</button>
	                                </div>
	                            </form>
	                            <!-- End Profile Edit Form -->
	                        </div>
	                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
	                        	 <form action="{{ route('master.updateprofile') }}" method="POST" enctype="multipart/form-data">
	                        	 	@csrf
		                        	<div class="row mb-3">
	                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
	                                    <div class="col-md-8 col-lg-9">
	                                        <div class="avatar-upload">
		                                        <div class="avatar-edit" >
		                                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" name="profile" />
		                                            <label for="imageUpload"></label>
		                                        </div>
		                                        <div class="avatar-preview">
		                                            <div id="imagePreview" style="background-image: url({{ asset($authuser->profile_photo_path) }});">
		                                            </div>
		                                        </div>

		                                        @if($errors->has('profile'))
				                                    <span class="text-danger fs-6"> {{ $errors->first('profile') }} </span>
				                                @elseif($errors->any() && !$errors->has('profile')) 
				                                    <span class="text-danger fs-6"> <strong> {{ __("Upload Error!") }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
				                                @endif
		                                    </div>
	                                    </div>
	                                </div>

	                                <div class="text-center">
	                                    <button type="submit" class="btn btn-primary">Save Changes</button>
	                                </div>

	                            </form>
	                        </div>

	                        <div class="tab-pane fade pt-3" id="profile-change-password">
	                            <!-- Change Password Form -->
	                            <form action="{{ route('master.changepassword') }}" method="POST">
	                            	@csrf
	                                <div class="row mb-3">
	                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
	                                    <div class="col-md-8 col-lg-9" data-password="">
	                                        <input type="password" class="form-control position-relative" id="currentPassword" name="currentPassword" data-pass-target="">

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
	                                    </div>
	                                </div>
	                                <div class="row mb-3">
	                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
	                                    <div class="col-md-8 col-lg-9" data-password="">
	                                        <input type="password" class="form-control position-relative" id="newPassword" name="newPassword" data-pass-target="">

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
	                                    </div>
	                                </div>
	                                <div class="row mb-3">
	                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
	                                    <div class="col-md-8 col-lg-9" data-password="">
	                                        <input type="password" class="form-control position-relative" id="renewPassword" name="confirmed" data-pass-target="">

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
	                                    </div>
	                                </div>
	                                <div class="text-center">
	                                    <button type="submit" class="btn btn-primary">Change Password</button>
	                                </div>
	                            </form>
	                            <!-- End Change Password Form -->
	                        </div>
	                    </div>
	                    <!-- End Bordered Tabs -->
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

@section('script_content')
	<script type="text/javascript">

		
        $(document).ready(function() {
        	var currentLanguage = "{{  Config::get('app.locale') }}";

        	if (currentLanguage == "mm") {
            	var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";
            }
            else if(currentLanguage == "jp"){
            	var placeholder_title = "少なくとも1つのオプションを選択してください";
            }
            else if(currentLanguage == "cn"){
            	var placeholder_title =  "请至少选择一个选项";
            }
            else if(currentLanguage == "de"){
            	var placeholder_title = "Bitte wählen Sie mindestens eine Option aus";
            }
            else if(currentLanguage == "fr"){
            	var placeholder_title ="Veuillez sélectionner au moins une option";
            	
            }else{
            	var placeholder_title ="Please select at least one option";
            }

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
			$('#imageUpload').on('change', function()
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

			$('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

            var phonenoTag = document.querySelector('.phonenoTag');
			new Tagify(phonenoTag,{
				originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
			});

			var degreeTag = document.querySelector('.degreeTag');
			new Tagify(degreeTag,{
				originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
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
		});
</script>

@stop
</x-template>