<x-template>
	@php
	    $authRole = Auth::user()->getRoleNames()[0];
	    $authuser = Auth::user();
	@endphp

	<div class="pagetitle">
	    <h1> {{ __("Result")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Result")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section profile">
	    <div class="row">
	        <div class="col-lg-12">
	        	<div class="card">
				    <div class="card-body pt-3">
                        @if($authRole == "Guardian")
				        <!-- Bordered Tabs -->
				        <ul class="nav nav-tabs nav-tabs-bordered">
				        	@foreach($authuser->guardian->students as $key => $student)
				            <li class="nav-item">
				                <button class="nav-link @if($key == 0) active @endif" data-bs-toggle="tab" data-bs-target="#student-{{ $student->id }}">
				                	{{ $student->user->name }}
				                </button>
				            </li>
				            @endforeach
				        </ul>
				        <div class="tab-content pt-2">
				        	@foreach($authuser->guardian->students as $key => $student)
				            <div class="tab-pane fade @if($key == 0) show active @endif profile-overview" id="student-{{ $student->id }}">
				                
				                <div class="row">
                                    <div class="col-12">
                                        <div class="accordion" id="accordionExample">
                                            @foreach($student->studentsegments as $key => $studentsegment)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header text-primary" id="heading_attendance{{ $studentsegment->id }}">
                                                        <button class="accordion-button @if($key == 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_attendance{{ $studentsegment->id }}" aria-expanded="true" aria-controls="collapse_attendance{{ $studentsegment->id }}"> 
                                                            {{ $studentsegment->batch->section->grade->name }} |
                                                            {{ $studentsegment->batch->name }}
                                                        </button>
                                                    </h2>

                                                    <div id="collapse_attendance{{ $studentsegment->id }}" class="accordion-collapse collapse  @if($key == 0) show @endif" aria-labelledby="heading_attendance{{ $studentsegment->id }}" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                @php
                                                                    $recordings = $studentsegment->batch->recordings;
                                                                @endphp
                                                                @if(!$recordings->isEmpty())
                                                                    @foreach($recordings as $recording)
                                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" >
                                                                        <div class="card shadow-none border">
                                                                            
                                                                            <div class="card-body">
                                                                                <h5 class="card-title">{{ $recording->title }}</h5>

                                                                                <div class="d-grid gap-2">
                                                                                    <a href="{{ route('master.recording.show', $recording->id) }}" class="btn btn-primary">
                                                                                        <i class="bi bi-play-fill me-2"></i> View Video 
                                                                                    </a>
                                                                                </div>
                                                                                @if(!in_array($authRole,["Guardian","Student"]))
                                                                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                                                                    
                                                                                    <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm deleteBtn" data-id="{{ $recording->id }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Remove') }}" >
                                                                                        <i class="bi bi-x-lg"></i> 
                                                                                    </a>

                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                @else
                                                                    <h3> There have no recording. </h3>
                                                                @endif
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

				            </div>
				            @endforeach
				        </div>
                        @endif

                        @if($authRole == "Student")
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion" id="accordionExample">
                                        @foreach($authuser->student->studentsegments as $key => $studentsegment)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header text-primary" id="heading_attendance{{ $studentsegment->id }}">
                                                    <button class="accordion-button @if($key == 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_attendance{{ $studentsegment->id }}" aria-expanded="true" aria-controls="collapse_attendance{{ $studentsegment->id }}"> 
                                                        {{ $studentsegment->batch->section->grade->name }} |
                                                        {{ $studentsegment->batch->name }}
                                                    </button>
                                                </h2>

                                                <div id="collapse_attendance{{ $studentsegment->id }}" class="accordion-collapse collapse  @if($key == 0) show @endif" aria-labelledby="heading_attendance{{ $studentsegment->id }}" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            @php
                                                                $recordings = $studentsegment->batch->recordings;
                                                            @endphp
                                                            @if(!$recordings->isEmpty())
                                                            @foreach($recordings as $recording)
                                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" >
                                                                    <div class="card shadow-none border">
                                                                        
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">{{ $recording->title }}</h5>

                                                                            <div class="d-grid gap-2">
                                                                                <a href="{{ route('master.recording.show', $recording->id) }}" class="btn btn-primary">
                                                                                    <i class="bi bi-play-fill me-2"></i> View Video 
                                                                                </a>
                                                                            </div>
                                                                            @if(!in_array($authRole,["Guardian","Student"]))
                                                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                                                                                
                                                                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm deleteBtn" data-id="{{ $recording->id }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Remove') }}" >
                                                                                    <i class="bi bi-x-lg"></i> 
                                                                                </a>

                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            @else
                                                                <h3> There have no recording. </h3>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @endif

				        <!-- End Bordered Tabs -->
				    </div>
				</div>
	        </div>
	    </div>
	</section>


</x-template>