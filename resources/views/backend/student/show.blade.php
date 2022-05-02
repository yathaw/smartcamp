<x-template>
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/pdfViewer/style.css') }}">
    @endsection
	<div class="pagetitle">
	    <h1> {{ __("Student")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item"><a href="{{ route('master.student.index') }}">{{ __("All Students")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Detail")}}</li>
	        </ol>
	    </nav>
	</div>
	@php
		$admissionno = explode('.', $student->user->email);
	@endphp
	<section class="section profile">
        <div class="row">
        	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body profile-card  pt-4 d-flex flex-column align-items-center">
                        <img src="{{ asset($student->user->profile_photo_path) }}" alt="Profile" class="">
                        <div class="text-center">
	                        <h2 class="card-title mb-0 pb-0">
	                        	{{ $student->user->name }}

	                        </h2>
	                        @if($student->nativename)
	                        <p class="text-muted small"> 
	                        	( {{ $student->nativename }} ) 
	                        </p>
	                        @endif
	                    </div>
                        <div>
	                        <span class="text-muted small"> {{ __("Admission No : ") }} </span>
	                        <h5 class="d-inline-block"> {{ $admissionno[0]; }}</h5>
	                    </div>

                        @if ($student->status =='Active')
                            <span class="badge bg-success"> {{ $student->status }} </span>
                        @else
                            <span class="badge bg-danger"> {{ $student->status }} </span>
                        @endif
                    </div>
                </div>

                <div class="row g-2">
                	@foreach($student->studentsegments as $studentsegment)
                	<div class="col-12">
						<div class="card mb-3">
					    	<div class="card-body pt-3">
					    		<div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 label "> {{ __("Course") }} </div>
                                    <div class="col-lg-6 col-md-6">{{ $studentsegment->batch->section->grade->name }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 label "> {{ __("Batch") }} </div>
                                    <div class="col-lg-6 col-md-6">{{ $studentsegment->batch->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 label "> {{ __("Academic Year") }} </div>
                                    <div class="col-lg-6 col-md-6">
                                    	{{ $studentsegment->batch->section->period->startyear }} -
                                    	{{ $studentsegment->batch->section->period->endyear }} 
                                    </div>
                                </div>
						  	</div>
					    	<div class="card-footer bg-transparent d-grid gap-2 d-md-flex justify-content-md-end">
					    		<span class="text-primary">
                                    @php 
                                        $today_date = \Carbon\Carbon::now();
                                        $expire_date = \Carbon\Carbon::createFromFormat('Y-m-d', $studentsegment->batch->section->startdate);
                                        $data_difference = $today_date->diffInDays($expire_date, false);
                                    @endphp

                                    @if($data_difference > 0)
    						    		<i class="bi bi-hourglass-split"></i>
    						    		{{ __("In Progress") }}
                                    @endif

                                    @if($data_difference < 0)
                                        <i class="bi bi-patch-check-fill"></i>
                                        {{ __("Pass") }}
                                    @endif
						    	</span>
							</div>
						</div>
					</div>
					@endforeach
                </div>
            </div>

            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                        	<li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview">
                                	<small> {{ __("Overview") }} </small>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#guardian">
                                	<small>  {{ __("Guardian") }} </small>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#medical"> 
                                	<small>  {{ __("Medical") }} </small>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#payment"> 
                                	<small> {{ __("Payment") }} </small>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#attendance"> 
                                	<small>  {{ __("Attendance") }} </small>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#result"> 
                                    <small> {{ __("Result") }} </small>
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#file"> 
                                	<small> {{ __("File") }} </small>
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#setting"> 
                                	<small> {{ __("Setting") }} </small>
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                        	<div class="tab-pane fade show active profile-overview" id="overview">
                        		@if($student->bio)
                        		<h5 class="card-title">
                        			Bio
                        		</h5>
                        		<p class="small fst-italic">
                        			{{ $student->bio }}
                        		</p>
                        		@endif
                                <h5 class="card-title">{{ __("Profile Details") }}</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Register Date") }} </div>
                                    <div class="col-lg-9 col-md-8">{{ date('d. m. Y',strtotime($student->registerdate)) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Gender") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $student->gender }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Country") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $student->country->name }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Address") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $student->address }}</div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Date of Birth") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ date('d M, Y',strtotime($student->dob)) }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Previous School Name") }}</div>
                                    <div class="col-lg-9 col-md-8">
                                    	@if($student->psn)
                                    		{{ $student->psn }}
                                    	@else
                                    		-
                                    	@endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Academic Awards") }}</div>
                                    <div class="col-lg-9 col-md-8">
                                    	@if($student->academicawards)
                                    		{{ $student->academicawards }}
                                    	@else
                                    		-
                                    	@endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Religion") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $student->religion->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Blood") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $student->blood->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Interest Sport") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $student->sport->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Other Interest") }}</div>
                                    <div class="col-lg-9 col-md-8">
                                    	@if($student->otherinterest)
                                    		{{ $student->otherinterest }}
                                    	@else
                                    		-
                                    	@endif
                                    </div>
                                </div>

                              
                                
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">{{ __("Login Email") }}</div>
                                    <div class="col-lg-9 col-md-8">{{ $student->user->email }}</div>
                                </div>
                                <div class="">
                                	<ul class="list-group list-group-horizontal">
									  	<li class="list-group-item col-4"> Ferry </li>
									  	<li class="list-group-item col-4"> Lunchbox </li>
									  	<li class="list-group-item col-4"> Dormitory </li>
									</ul>
									<ul class="list-group list-group-horizontal-sm">
									  	<li class="list-group-item col-4">
									  		@if($student->ferry == "Yes")
                                    			✅
	                                    	@else
	                                    		❌
	                                    	@endif
									  	</li>
									  	<li class="list-group-item col-4">
									  		@if($student->lunchbox == "Yes")
                                    			✅
	                                    	@else
	                                    		❌
	                                    	@endif
									  	</li>
									  	<li class="list-group-item col-4">
									  		@if($student->dormitory == "Yes")
                                    			✅
	                                    	@else
	                                    		❌
	                                    	@endif
									  	</li>
									</ul>
                                </div>
                            </div>

                        	<div class="tab-pane fade pt-3" id="guardian">
                                <div class="row g-2 ">
                        			@foreach($student->guardians as $guardian)
								    <div class="col-6">
								        <div class="alert bg-primary bg-opacity-10" role="alert">
								        	<div class="d-flex flex-column">
								        		<div>
	                                				<h5 class="card-title py-0"> {{ $guardian->user->name }} </h5>
											  		<h6 class="card-subtitle text-muted mb-3"> {{ $guardian->relatiionship }} </h6>
	                                				<p class="mb-0"> 
	                                					<i class="bi bi-envelope me-2"></i>
	                                					{{ $guardian->workemail }} 
	                                				</p>

	                                				<p class="mb-0"> 
	                                					<i class="bi bi-briefcase me-2"></i>
	                                					{{ $guardian->occupation }} 
	                                				</p>

	                                				<p class="mb-0"> 
	                                					<i class="bi bi-telephone me-2"></i>
	                                					{{ $guardian->phone }} 
	                                				</p>

		                                		</div>
		                                		<div class="d-grid gap-2 mt-3">
		                                			<a href="tel:{{ $guardian->phone }}" class="btn btn-primary">
		                                				Call
		                                			</a>
		                                		</div>
								        	</div>
								        </div>
								    </div>
									@endforeach

								</div>
                            </div>
                            <div class="tab-pane fade pt-3" id="medical">
                            	<div class="row g-3 mb-4">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Medical Problem") }} </div>
                                    <div class="col-lg-9 col-md-8"> 
                                    	@if($student->medicalproblem)
                                    		{{ $student->medicalproblem }} 
                                    	@else
                                    		❌
                                    	@endif
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Medical Needs") }} </div>
                                    <div class="col-lg-9 col-md-8"> 
                                    	@if($student->medicalneeds)
                                    		{{ $student->medicalneeds }} 
                                    	@else
                                    		❌
                                    	@endif
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Food Allergy") }} </div>
                                    <div class="col-lg-9 col-md-8"> 
                                    	@if($student->foodallergy)
                                    		{{ $student->foodallergy }} 
                                    	@else
                                    		❌
                                    	@endif
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Medical Allery") }} </div>
                                    <div class="col-lg-9 col-md-8"> 
                                    	@if($student->medicalallergy)
                                    		{{ $student->medicalallergy }} 
                                    	@else
                                    		❌
                                    	@endif
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Other Allergy") }} </div>
                                    <div class="col-lg-9 col-md-8"> 
                                    	@if($student->otherallergy)
                                    		{{ $student->otherallergy }} 
                                    	@else
                                    		❌
                                    	@endif
                                    </div>
                                </div>
                                
                            </div>

                            <div class="tab-pane fade pt-3" id="payment">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="accordion" id="accordionExample">
                                            @foreach($student->studentsegments as $key => $studentsegment)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header text-primary" id="heading{{ $key }}">
                                                        <button class="accordion-button @if($key == 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}"> 
                                                            {{ $studentsegment->batch->section->grade->name }} |
                                                            {{ $studentsegment->batch->name }}
                                                        </button>
                                                    </h2>

                                                    <div id="collapse{{ $key }}" class="accordion-collapse collapse  @if($key == 0) show @endif" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            @foreach($studentsegment->batch->section->packages as $package)
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="alert bg-secondary bg-opacity-10" role="alert">
                                                                        <div class="d-flex justify-content-between">
                                                                            <div>
                                                                                <h6> {{ $package->installment }} </h6>
                                                                                <p class="text-muted">
                                                                                    {{ $package->description }}
                                                                                </p>
                                                                            </div>

                                                                            <div>
                                                                                @if(in_array($package->id ,$studentinstallments))
                                                                                    
                                                                                    <button type="button" class="btn btn-primary btn-sm me-2 package_detailBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ("View") }}" data-studentid="{{ $student->id }}" data-packageid="{{ $package->id }}" data-sectionid="{{ $studentsegment->batch->section->id }}">
                                                                                        <i class="bi bi-eye"></i> 
                                                                                    </button>

                                                                                @else

                                                                                
                                                                                <a href="{{route('master.installment',['student'=>$student->id,'packageid'=>$package->id, 'batchid'=>$studentsegment->batch_id])}}" class="btn btn-warning btn-sm me-2 package_detailBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ("Pay Installment") }}" data-id="{{ $package->id }}">
                                                                                    <i class="bi bi-cash-coin"></i> 
                                                                                </a>

                                                                                @endif
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        <hr>
                                                                        <div class="d-flex justify-content-between">
                                                                            <p class="mb-0 ">
                                                                                {{ $package->amount }}
                                                                                {{ $studentsegment->batch->section->currency->symbol }}
                                                                            </p>
                                                                            @if(in_array($package->id ,$studentinstallments))

                                                                            <span class="text-success fs-5 fw-bold"> Paid </span>

                                                                            @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade pt-3" id="attendance">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="accordion" id="attendanceAccordion">
                                            @foreach($student->studentsegments as $key => $studentsegment)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header text-primary" id="heading_attendance{{ $studentsegment->id }}">
                                                        <button class="accordion-button @if($key == 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_attendance{{ $studentsegment->id }}" aria-expanded="true" aria-controls="collapse_attendance{{ $studentsegment->id }}"> 
                                                            {{ $studentsegment->batch->section->grade->name }} |
                                                            {{ $studentsegment->batch->name }}
                                                        </button>
                                                    </h2>

                                                    <div id="collapse_attendance{{ $studentsegment->id }}" class="accordion-collapse collapse  @if($key == 0) show @endif" aria-labelledby="heading_attendance{{ $studentsegment->id }}" data-bs-parent="#attendanceAccordion">
                                                        <div class="accordion-body">
                                                            @php 
                                                                $present = $student->getAttendance_status('App\Models\Attendance',$student->id, $studentsegment->batch_id, 0) ?? 0;

                                                                $absent = $student->getAttendance_status('App\Models\Attendance',$student->id, $studentsegment->batch_id, 1) ?? 0;

                                                                $late = $student->getAttendance_status('App\Models\Attendance',$student->id, $studentsegment->batch_id, 2) ?? 0;

                                                                $execused = $student->getAttendance_status('App\Models\Attendance',$student->id, $studentsegment->batch_id, 3) ?? 0;

                                                            @endphp

                                                            <!-- Pie Chart -->
                                                            <canvas id="pieChart{{ $studentsegment->id }}" style="max-height: 400px;"></canvas>
                                                              <script>
                                                                    document.addEventListener("DOMContentLoaded", () => {
                                                                        new Chart(document.querySelector('#pieChart{{ $studentsegment->id }}'), {
                                                                                type: 'pie',
                                                                                data: {
                                                                                    labels: [
                                                                                        'Present',
                                                                                        'Absent',
                                                                                        'Late',
                                                                                        'Execused'
                                                                                    ],
                                                                                    datasets: [{
                                                                                        label: 'Attendance',
                                                                                        data: [{{ $present }}, {{ $absent }}, {{ $late }}, {{ $execused }}],
                                                                                        backgroundColor: [
                                                                                            'rgb(11,218,81)',
                                                                                            'rgb(255,0,0)',
                                                                                            'rgb(54, 162, 235)',
                                                                                            'rgb(255, 205, 86)'
                                                                                        ],
                                                                                        hoverOffset: 4
                                                                                    }]
                                                                                }
                                                                          });
                                                                    });
                                                              </script>
                                                              <!-- End Pie CHart -->
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade pt-3" id="result">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="accordion" id="examAccordion">
                                            @foreach($student->studentsegments as $key => $studentsegment)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header text-primary" id="heading_attendance{{ $studentsegment->id }}">
                                                        <button class="accordion-button @if($key == 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_attendance{{ $studentsegment->id }}" aria-expanded="true" aria-controls="collapse_attendance{{ $studentsegment->id }}"> 
                                                            {{ $studentsegment->batch->section->grade->name }} |
                                                            {{ $studentsegment->batch->name }}
                                                        </button>
                                                    </h2>

                                                    <div id="collapse_attendance{{ $studentsegment->id }}" class="accordion-collapse collapse  @if($key == 0) show @endif" aria-labelledby="heading_attendance{{ $studentsegment->id }}" data-bs-parent="#examAccordion">
                                                        <div class="accordion-body">
                                                            
                                                            @php
                                                                $exams = $studentsegment->batch->section->exams;
                                                            @endphp
                                                            @if(!$exams->isEmpty())
                                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                                @foreach($exams as $exam)
                                                                <li class="nav-item" role="presentation">
                                                                    <button class="nav-link" id="pills-exam{{ $exam->id }}-tab" data-bs-toggle="pill" data-bs-target="#pills-exam{{ $exam->id }}" type="button" role="tab" aria-controls="pills-exam{{ $exam->id }}" aria-selected="false">
                                                                        {{ $exam->name }}
                                                                    </button>
                                                                </li>
                                                                @endforeach
                                                            </ul>

                                                            <div class="tab-content" id="pills-tabContent">
                                                                @foreach($studentsegment->batch->section->exams as $exam)

                                                                    <div class="tab-pane fade" id="pills-exam{{ $exam->id }}" role="tabpanel" aria-labelledby="pills-exam{{ $exam->id }}-tab">
                                                                        <div class="mb-3">
                                                                            <span class="small">
                                                                                <i class="bi bi-calendar-event me-2"></i> 
                                                                                {{ date('d M, Y',strtotime($exam->startdate)) }}
                                                                            </span>
                                                                            <span class="small">
                                                                                <i class="bi bi-calendar-event mx-2"></i>
                                                                                {{ date('d M, Y',strtotime($exam->enddate)) }}
                                                                            </span>
                                                                            <div class="mt-3 row g-1">
                                                                                @foreach($exam->examdetails as $examdetail)
                                                                                    @if($examdetail->results)
                                                                                        <div class="card col-4 shadow-none border">
                                                                                            <div class="card-header">
                                                                                                {{ $examdetail->curriculum->subject->name }}
                                                                                            </div>

                                                                                            @php 
                                                                                                $resultid = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->id ?? '';

                                                                                                $point = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->point ?? '';


                                                                                                $mark = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->mark ?? '';

                                                                                                $comment = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->comment ?? '';                                                                       

                                                                                                $created_by = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->user->name ?? '';


                                                                                                $updatedat = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->updated_at ?? '';

                                                                                            @endphp

                                                                                            <ul class="list-group list-group-flush">
                                                                                                <li class="list-group-item">
                                                                                                    <small class="d-block text-muted">Grade Point</small>
                                                                                                    <span> {{ $point }} </span>
                                                                                                </li>
                                                                                                <li class="list-group-item">
                                                                                                    <small class="d-block text-muted"> Marks </small>
                                                                                                    <span> {{ $mark }} </span>
                                                                                                </li>
                                                                                                <li class="list-group-item">
                                                                                                    <small class="d-block text-muted">Comment </small>
                                                                                                    <span>
                                                                                                        @if($comment)
                                                                                                            {{ $comment }}
                                                                                                        @else
                                                                                                            - 
                                                                                                        @endif
                                                                                                    </span>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @else
                                                                <h3> There have no exam result. </h3>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade pt-3" id="file">
                                <div class="row g-3">
                                	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                		<div class="card shadow-none border h-100">
                                			<a href="{{ asset($student->gbc) }}" class="image-popup-vertical-fit">
									      		<img src="{{ asset($student->gbc) }}" class="card-img-top" alt="...">
										    </a>
									      	<div class="card-body text-center">
									        	<h5 class="card-title"> {{ __("Government Birth Certificate") }} </h5>
									      	</div>
									    </div>
                                	</div>
                                	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                		<div class="card shadow-none border h-100">
                                			<a href="{{ asset($student->lmir) }}" class="image-popup-vertical-fit">
									      		<img src="{{ asset($student->lmir) }}" class="card-img-top" alt="...">
									      	</a>
									      	<div class="card-body text-center">
									        	<h5 class="card-title"> {{ __("Latest Medical Immunization Record") }} </h5>
									      	</div>
									    </div>
                                	</div>
                                	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                		<div class="card shadow-none border h-100">
                                			<a href="{{ asset($student->idf) }}" class="image-popup-vertical-fit">
										      	<img src="{{ asset($student->idf) }}" class="card-img-top" alt="...">
										      </a>
									      	<div class="card-body text-center">
									        	<h5 class="card-title"> {{ __("ID Card - Front") }} </h5>
									      	</div>
									    </div>
                                	</div>
                                	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                		<div class="card shadow-none border h-100">
                                			<a href="{{ asset($student->idb) }}" class="image-popup-vertical-fit">
									      		<img src="{{ asset($student->idb) }}" class="card-img-top" alt="...">
									      	</a>
									      	<div class="card-body text-center">
									        	<h5 class="card-title"> {{ __("ID Card - Back") }} </h5>
									      	</div>
									    </div>
                                	</div>
                                	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                		<div class="card shadow-none border h-100">
                                			<a href="{{ asset($student->tc) }}" class="image-popup-vertical-fit">
									      		<img src="{{ asset($student->tc) }}" class="card-img-top" alt="...">
									      	</a>
									      	<div class="card-body text-center">
									        	<h5 class="card-title"> {{ __("Transfer Certificate TC") }} </h5>
									      	</div>
									    </div>
                                	</div>
                                	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                		<div class="card shadow-none border h-100">
                                			<a href="{{ asset($student->pcm) }}" class="image-popup-vertical-fit">
									      		<img src="{{ asset($student->pcm) }}" class="card-img-top" alt="...">
									      	</a>
									      	<div class="card-body text-center">
									        	<h5 class="card-title"> {{ __("Previous Class Marksheet") }} </h5>
									      	</div>
									    </div>
                                	</div>
                                </div>
                            </div>

                            <div class="tab-pane fade pt-3" id="setting">

                            	<div class="row g-3">
                                    @if($student->status == "Active")
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <a href="{{ route('master.student.edit', $student->id) }}" class="btn btn-warning"> {{ __("Edit") }} </a>
                                        </div>
                                    </div>
                                    

                            		<div class="col-4">
                            			<div class="d-grid">
    										<button class="btn btn-primary pwresetBtn" type="button" data-id="{{ $student->user->id }}" data-status="student"> {{ __("Password Reset for Student") }} </button>
    									</div>
                            		</div>
                                    <div class="col-4">
                                        <div class="d-grid">
                                            <button class="btn btn-primary pwresetBtn" type="button" data-id="{{ $student->guardians[0]->user->id }}" data-status="guardian"> {{ __("Password Reset for Guardian #1") }} </button>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-grid">
                                            <button class="btn btn-primary pwresetBtn" type="button" data-id="{{ $student->guardians[1]->user->id }}" data-status="guardian"> {{ __("Password Reset for Guardian #2") }} </button>
                                        </div>
                                    </div>


                            		<div class="col-6">
                            			<div class="d-grid">
    										<a class="btn btn-outline-danger" href="{{route('master.transfer',['student'=>$student->id])}}"> {{ __("Transfer") }} </a>
    									</div>
                            		</div>

                                    @endif

                                    @if($student->status != "Active")
                                        <div class="col-6">
                                            <div class="d-grid">
                                                <a class="btn btn-outline-danger printBtn" href="{{ route('prnpriview',['transfer'=>$student->transfer->id]) }}"> {{ __("Print Transfer") }} </a>
                                            </div>
                                        </div>
                                    @endif

                            		<div class="col-6">
                            			<div class="d-grid">
    										<button class="btn btn-outline-danger removeBtn" type="button" data-id="{{ $student->id }}">
    										{{ __("Remove") }} 
    										</button>
    									</div>
                            		</div>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


<div class="modal fade" id="showModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
                <form class="row g-3">
                    <input type="hidden" name="id" id="inputId">
                    <input type="hidden" name="status" id="inputStatus">


                    <div class="modal-body">
                        <div class="col-12 mb-3" data-password="">
                            <label for="inputPassword" class="form-label"> {{ __("Password") }} </label>
                            <input type="password" class="form-control position-relative" id="inputPassword" name="password" data-pass-target="">

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
                            <span class="err_name error d-block text-danger"></span>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Close")}}</button>
                        <button type="submit" class="btn btn-primary">{{ __("Save Changes")}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@section('script_content')
    <script type="text/javascript">
		var profile_url = '{{ URL::asset('') }}';

        $(document).ready(function(){

            $('.printBtn').printPage();

            var currentLanguage = "{{  Config::get('app.locale') }}";
            if (currentLanguage == "mm") {
                var n_modal_title = "အသစ်ထည့်ရန်";
                var e_modal_title = "ရှိပြီးသားကို ပြင်ဆင်ရန်";
                var s_success_text = "အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ";
                var e_success_text ="အချက်အလက်များကိုအောင်မြင်စွာ ပြင်ဆင် ပြီးပါပြီ";
                var d_confirm_text ="အချက်အလက်များကို စာရင်းမှပယ်ဖျက်မည်!";
                var d_success_text = "အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ";
                var d_cancel_text = "အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။";
                var confirm_btn_text = "ဟုတ်ကဲ့၊ ဖျက်လိုက်ပါ။";
                var cancel_btn_text = "မလုပ်တော့ပါ။";

            }
            else if(currentLanguage == "jp"){
                var n_modal_title = "新しく追加する";
                var e_modal_title = "既存の編集";
                var s_success_text = "データが保存されました！";
                var e_success_text = "データが更新されました！";
                var d_confirm_text ="そのデータを削除すると、ネットワークから完全に削除されます。";
                var d_success_text = "データが削除されました！";
                var d_cancel_text = "あなたのデータは私たちのデータベースに保存されました！";
                var confirm_btn_text = "はい、削除してください！";
                var cancel_btn_text = "キャンセル";
            }
            else if(currentLanguage == "cn"){
                var n_modal_title =  "添新";
                var e_modal_title =  "编辑现有";
                var s_success_text = "您的数据已保存！";
                var e_success_text = "您的数据已更新！";
                var d_confirm_text ="删除该数据会将其从您的网络中永久删除。";
                var d_success_text = "您的数据已被删除！";
                var d_cancel_text = "您的数据已保存在我们的数据库中！";
                var confirm_btn_text = "是的，删除它！";
                var cancel_btn_text = "取消";
            }
            else if(currentLanguage == "de"){
                var n_modal_title = "Neue hinzufügen";
                var e_modal_title = "Bestehende bearbeiten";
                var s_success_text = "Ihre Daten wurden gespeichert!";
                var e_success_text = "Ihre Daten wurden aktualisiert!";
                var d_confirm_text ="Durch das Löschen dieser Daten werden sie dauerhaft aus Ihrem Netzwerk entfernt.";
                var d_success_text = "Ihre Daten wurden gelöscht!";
                var d_cancel_text = "Ihre Daten wurden in unserer Datenbank gespeichert!";
                var confirm_btn_text = "Ja, löschen!";
                var cancel_btn_text = "Abbrechen";
            }
            else if(currentLanguage == "fr"){
                var n_modal_title ="Ajouter nouveau";
                var e_modal_title ="Modifier existant";
                var s_success_text = "Vos données ont été enregistrées!";
                var e_success_text = "Vos données ont été mises à jour !";
                var d_confirm_text ="La suppression de ces données les supprimera définitivement de votre réseau.";
                var d_success_text = "Vos données ont été supprimées !";
                var d_cancel_text = "Vos données ont été sauvegardées dans notre base de données !";
                var confirm_btn_text = "Oui, supprimez-le !";
                var cancel_btn_text = "Annuler";
                
            }else{
                var n_modal_title ="Add New";
                var e_modal_title ="Edit Existing";
                var s_success_text = "Your data was saved!";
                var e_success_text = "Your data was updated!";
                var d_confirm_text = "Deleting that data will permanently remove it from your network.";
                var d_success_text = "Your data was deleted!";
                var d_cancel_text = "Your data was safed in our database!";
                var confirm_btn_text = "Yes, delete it!";
                var cancel_btn_text = "Cancel";
            }
	 
			$('.image-popup-vertical-fit').magnificPopup({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				fixedContentPos: true,
				mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300 // don't foget to change the duration also in CSS
				}
			});

            // Remove
            $('#setting').on('click', '.removeBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.student.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: d_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_btn_text,
                cancelButtonText: cancel_btn_text,  
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        Swal.fire({
                            icon: "success",
                            text: d_success_text,
                            timer : 1500,
                            showConfirmButton: false
                        }).then(
                            function()
                            {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    success: function (data) {
                                        window.location = "{{route('master.student.index')}}";
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });
                            }
                        );
                        
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: d_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

            $('.pwresetBtn').on('click', function(){
                var id = $(this).data('id');
                var status = $(this).data('status');


                $('#inputId').val(id);
                $('#inputStatus').val(status);

                $("#showModal").modal("show");
                $("form").attr('id', 'addForm');
                $(".modal-title").text("Password Reset");


            });

            // CREATE
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('master.pwreset')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

                        $("#showModal").modal("hide");

                        $('#addForm').trigger("reset");



                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });


            // Remove
            $('#settings').on('click', '.removeBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.student.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: d_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_btn_text,
                cancelButtonText: cancel_btn_text,  
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        Swal.fire({
                            icon: "success",
                            text: d_success_text,
                            timer : 1500,
                            showConfirmButton: false
                        }).then(
                            function()
                            {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    success: function (data) {
                                        window.location = "{{route('master.staff.index')}}";
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });
                            }
                        );
                        
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: d_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
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

            // EDIT
            $('#payment').on('click', '.installment_detailBtn', function (){

                var studentid = $(this).data('studentid');
                var packageid = $(this).data('packageid');
                var sectionid = $(this).data('sectionid');
                
                $.ajax({
                    url: "/getPayment_bystudentid",
                    type:'POST',
                    data: { id:studentid, packageid:packageid, sectionid:sectionid }
                }).done(function(data){

                    console.log(data);

                    $('.detail_paymentDate').text(data.date);
                    $('.detail_amount').text(data.amount);
                    $('.detail_installmentTitle').text(data.package.installment);
                    $('.detail_invoicephoto').attr('src', profile_url+data.photo);
                    $("#showModal").modal("show");
                    $(".modal-title").text(data.voucherno);

                });


                
            });

		});
	</script>
@stop
</x-template>
