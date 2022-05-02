<x-template>
	@php
	    $authRole = Auth::user()->getRoleNames()[0];
	    $authuser = Auth::user();
	@endphp

	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Schedule")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Schedule")}}</li>
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
                                                            	$batchid = $studentsegment->batch->id;
                                                                $teachersegments = \App\Models\Curriculum::with(['subject','subjecttype','teachersegment'=>function($q1) use ($batchid){
												                                $q1->with(['user','staff'=> function($q2) use($batchid){
												                                    $q2->with('user');
												                                    $q2->get();
												                                }]);
												                                $q1->where('batch_id',$batchid);
												                                $q1->get();
												                            }])
												                ->whereHas('teachersegment',function($q) use($batchid){
												                    $q->where('batch_id',$batchid);
												                })
												                ->get()
												                ->sortBy('sorting');

												                $schedules = \App\Models\Schedule::with([
												                    'batch' => function($q1){
												                        $q1->with(['section']);
												                        $q1->get();
												                    },
												                    'teachersegment' => function($q1){
												                        $q1->with(['curriculum'=> function($q2){
												                            $q2->with('subject','subjecttype');
												                        }]);
												                        $q1->get();
												                    }
												                ])
												                ->where('batch_id', $batchid)
												                ->get();

                                                            @endphp

                                                            <div class="row mb-4 align-items-center">
												            	<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 order-end order-xl-first order-lg-first">
												            		<span class="badge text-wrap fs-6 m-2 lunch_bgcolor lunch_txtcolor">
												            			{{ __("Lunch") }}
												            		</span>

												            		<span class="badge text-wrap fs-6 m-2 breaktime_bgcolor breaktime_txtcolor">
												            			{{ __("Break Time") }}
												            		</span>

													            	@foreach($teachersegments as $teacher)
													            	@php 
													            		$profile = asset($teacher->teachersegment->staff->user->profile_photo_path);
													            		$bgcolor = $teacher->teachersegment->bgcolor;
													            		$txtcolor = $teacher->teachersegment->txtcolor;
													            		$teachername = $teacher->teachersegment->staff->user->name;
													            		$subject = $teacher->teachersegment->curriculum->subject->name;
													            		$subjectotherlanguage = $teacher->teachersegment->curriculum->subject->otherlanguage;
													            		$duration = $teacher->teachersegment->duration;
													            		$id = $teacher->teachersegment->id;


													            		$popoverHeader = "<div class='d-flex flex-wrap align-items-center'>
												                                			<div class='avatar me-3'>
												                                				<img src='$profile' class='rounded-circle'> 
												                                			</div>
												                                			<div> <small> ${teachername} </small> </div>
												                                		</div>";

												                        $popoverText = "<div class='d-flex flex-column'>
											                                				<span class='d-block'> 
											                                					$subject
																			    			</span>
																			    			<small class='d-block'>( $subjectotherlanguage )</small>

											                                				<span class='d-block'> Duration : $duration </span>

											                                			</div>";


													            	@endphp
													            		<span class="badge text-wrap fs-6 m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" data-id="{{ $id }}" data-type="teachersegment">
													            			{{ $subject }}
													            		</span>
													            	@endforeach
													            </div>
												            	<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-first order-xl-end order-lg-end">
												            		<div class="alert alert-info  alert-dismissible fade show">
														            	<h4 class="alert-heading d-inline-block">  
														            		{{ $studentsegment->batch->name }}  
												                      	</h4>

														            	<span class="text-muted small"> | {{ $studentsegment->batch->codeno }}   </span>

														            	<div class="row">
														            		<div class="col-12"> 
														            			<span class="label me-3 small text-muted"> Academic Year </span>
														            			<span class="small"> {{ $studentsegment->batch->section->period->startyear }} -
								                                	{{ $studentsegment->batch->section->period->endyear }}  </span>
														            		</div>

														            		<div class="col-12"> 
														            			<span class="label me-3 small text-muted"> Time </span>
														            			<span class="small"> 
														            				@php
												                                		$s = \Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																	                    $starttime = $s->format('g:i A');

																	                    $e = \Carbon\Carbon::parse($studentsegment->batch->section->endtime);
																	                    $endtime = $e->format('g:i A');

																	                    $totalDuration = $e->diffForHumans($s, true);
																	                    // $totalDuration = $totalDuration->format('g:i A');

												                                	@endphp
												                                	{{ $starttime }} - {{ $endtime }}
														            			</span>
														            		</div>

														            		<div class="col-12"> 
														            			<span class="label me-3 small text-muted"> Grade </span>
														            			<span class="small"> {{ $studentsegment->batch->section->grade->name }}  </span>
														            		</div>

														            	</div>

														            </div>

												            	</div>
												            </div>

												            <div class="cd-schedule loading">
																<div class="events cal-sectionDiv">
																	<ul class="p-0">
																		<li class="events-group">
																			<div class="top-info"><span>Sunday</span></div>

																			<ul class="ui-droppable" data-day="Sunday" data-dayid="6">
																				@if($schedules)
																					@php 
																                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																					@endphp
																					@foreach($schedules as $schedule)
																					@if($schedule->day == "Sunday")
																						@php

																							if($schedule->teachersegment){
																								$bgcolor = $schedule->teachersegment->bgcolor;
																								$txtcolor = $schedule->teachersegment->txtcolor;
																								$subject = $schedule->teachersegment->curriculum->subject->name;
																			            		
													            								$id = $schedule->teachersegment->id;
																								$type = 'teachersegment';


																							}else{
																								$subject = $schedule->title;
																								$bgcolor = "#9e0059";
																								$txtcolor = "#f6b8c5";
																								$id = $schedule->id;
																								$type = 'scheduletype';
																							}

																							$period_starttime = $section_starttime->format('g:i');
																							$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																							
																						@endphp

																						<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																	            			{{ $subject }}
																	            		</span>
																					
																					@endif
																					@endforeach
																				@endif
																			</ul>
																		</li>

																		<li class="events-group">
																			<div class="top-info"><span>Monday</span></div>
																			<ul class="ui-droppable" data-day="Monday" data-dayid="0">
																				@if($schedules)
																					@php 
																                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																					@endphp
																					@foreach($schedules as $schedule)
																					@if($schedule->day == "Monday")
																						@php

																							if($schedule->teachersegment){
																								$bgcolor = $schedule->teachersegment->bgcolor;
																								$txtcolor = $schedule->teachersegment->txtcolor;
																								$subject = $schedule->teachersegment->curriculum->subject->name;
																			            		
													            								$id = $schedule->teachersegment->id;
																								$type = 'teachersegment';


																							}else{
																								$subject = $schedule->title;
																								$bgcolor = "#9e0059";
																								$txtcolor = "#f6b8c5";
																								$id = $schedule->id;
																								$type = 'scheduletype';
																							}

																							$period_starttime = $section_starttime->format('g:i');
																							$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																							
																						@endphp

																						<span class="badge text-wrap d-block fs-6 drag m-2 " style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																	            			{{ $subject }}
																	            		</span>
																					
																					@endif
																					@endforeach
																				@endif
																			</ul>
																		</li>

																		<li class="events-group">
																			<div class="top-info"><span>Tuesday</span></div>
																			<ul class="ui-droppable" data-day="Tuesday" data-dayid="1">
																				@if($schedules)
																					@php 
																                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																					@endphp
																					@foreach($schedules as $schedule)
																					@if($schedule->day == "Tuesday")
																						@php

																							if($schedule->teachersegment){
																								$bgcolor = $schedule->teachersegment->bgcolor;
																								$txtcolor = $schedule->teachersegment->txtcolor;
																								$subject = $schedule->teachersegment->curriculum->subject->name;
																			            		
													            								$id = $schedule->teachersegment->id;
																								$type = 'teachersegment';


																							}else{
																								$subject = $schedule->title;
																								$bgcolor = "#9e0059";
																								$txtcolor = "#f6b8c5";
																								$id = $schedule->id;
																								$type = 'scheduletype';
																							}

																							$period_starttime = $section_starttime->format('g:i');
																							$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																							
																						@endphp

																						<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																	            			{{ $subject }}
																	            		</span>
																					
																					@endif
																					@endforeach
																				@endif
																			</ul>
																		</li>

																		<li class="events-group">
																			<div class="top-info"><span>Wednesday</span></div>
																			<ul class="ui-droppable" data-day="Wednesday" data-dayid="2">
																				@if($schedules)
																					@php 
																                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																					@endphp
																					@foreach($schedules as $schedule)
																					@if($schedule->day == "Wednesday")
																						@php

																							if($schedule->teachersegment){
																								$bgcolor = $schedule->teachersegment->bgcolor;
																								$txtcolor = $schedule->teachersegment->txtcolor;
																								$subject = $schedule->teachersegment->curriculum->subject->name;
																			            		
													            								$id = $schedule->teachersegment->id;
																								$type = 'teachersegment';


																							}else{
																								$subject = $schedule->title;
																								$bgcolor = "#9e0059";
																								$txtcolor = "#f6b8c5";
																								$id = $schedule->id;
																								$type = 'scheduletype';
																							}

																							$period_starttime = $section_starttime->format('g:i');
																							$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																							
																						@endphp

																						<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																	            			{{ $subject }}
																	            		</span>
																					
																					@endif
																					@endforeach
																				@endif
																			</ul>
																		</li>

																		<li class="events-group">
																			<div class="top-info"><span>Thursday</span></div>
																			<ul class="ui-droppable" data-day="Thursday" data-dayid="3">
																				@if($schedules)
																					@php 
																                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																					@endphp
																					@foreach($schedules as $schedule)
																					@if($schedule->day == "Thursday")
																						@php

																							if($schedule->teachersegment){
																								$bgcolor = $schedule->teachersegment->bgcolor;
																								$txtcolor = $schedule->teachersegment->txtcolor;
																								$subject = $schedule->teachersegment->curriculum->subject->name;
																			            		
													            								$id = $schedule->teachersegment->id;
																								$type = 'teachersegment';


																							}else{
																								$subject = $schedule->title;
																								$bgcolor = "#9e0059";
																								$txtcolor = "#f6b8c5";
																								$id = $schedule->id;
																								$type = 'scheduletype';
																							}

																							$period_starttime = $section_starttime->format('g:i');
																							$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																							
																						@endphp

																						<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																	            			{{ $subject }}
																	            		</span>
																					
																					@endif
																					@endforeach
																				@endif
																			</ul>
																		</li>

																		<li class="events-group">
																			<div class="top-info"><span>Friday</span></div>

																			<ul class="ui-droppable" data-day="Friday" data-dayid="4">
																				@if($schedules)
																					@php 
																                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																					@endphp
																					@foreach($schedules as $schedule)
																					@if($schedule->day == "Friday")
																						@php

																							if($schedule->teachersegment){
																								$bgcolor = $schedule->teachersegment->bgcolor;
																								$txtcolor = $schedule->teachersegment->txtcolor;
																								$subject = $schedule->teachersegment->curriculum->subject->name;
																			            		
													            								$id = $schedule->teachersegment->id;
																								$type = 'teachersegment';


																							}else{
																								$subject = $schedule->title;
																								$bgcolor = "#9e0059";
																								$txtcolor = "#f6b8c5";
																								$id = $schedule->id;
																								$type = 'scheduletype';
																							}

																							$period_starttime = $section_starttime->format('g:i');
																							$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																							
																						@endphp

																						<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																	            			{{ $subject }}
																	            		</span>
																					
																					@endif
																					@endforeach
																				@endif
																			</ul>
																		</li>

																		<li class="events-group">
																			<div class="top-info"><span>Saturday</span></div>

																			<ul class="ui-droppable" data-day="Saturday" data-dayid="5">
																				@if($schedules)
																					@php 
																                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																					@endphp
																					@foreach($schedules as $schedule)
																					@if($schedule->day == "Saturday")
																						@php

																							if($schedule->teachersegment){
																								$bgcolor = $schedule->teachersegment->bgcolor;
																								$txtcolor = $schedule->teachersegment->txtcolor;
																								$subject = $schedule->teachersegment->curriculum->subject->name;
																			            		
													            								$id = $schedule->teachersegment->id;
																								$type = 'teachersegment';


																							}else{
																								$subject = $schedule->title;
																								$bgcolor = "#9e0059";
																								$txtcolor = "#f6b8c5";
																								$id = $schedule->id;
																								$type = 'scheduletype';
																							}

																							$period_starttime = $section_starttime->format('g:i');
																							$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																							
																						@endphp

																						<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																	            			{{ $subject }}
																	            		</span>
																					
																					@endif
																					@endforeach
																				@endif
																			</ul>
																		</li>

																		
																	</ul>
																</div>


																<div class="cover-layer"></div>
															</div> <!-- .cd-schedule -->

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
                                    <div class="accordion" id="attendanceAccordion">
                                        @foreach($authuser->student->studentsegments as $key => $studentsegment)
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
                                                        	$batchid = $studentsegment->batch->id;
                                                            $teachersegments = \App\Models\Curriculum::with(['subject','subjecttype','teachersegment'=>function($q1) use ($batchid){
											                                $q1->with(['user','staff'=> function($q2) use($batchid){
											                                    $q2->with('user');
											                                    $q2->get();
											                                }]);
											                                $q1->where('batch_id',$batchid);
											                                $q1->get();
											                            }])
											                ->whereHas('teachersegment',function($q) use($batchid){
											                    $q->where('batch_id',$batchid);
											                })
											                ->get()
											                ->sortBy('sorting');

											                $schedules = \App\Models\Schedule::with([
											                    'batch' => function($q1){
											                        $q1->with(['section']);
											                        $q1->get();
											                    },
											                    'teachersegment' => function($q1){
											                        $q1->with(['curriculum'=> function($q2){
											                            $q2->with('subject','subjecttype');
											                        }]);
											                        $q1->get();
											                    }
											                ])
											                ->where('batch_id', $batchid)
											                ->get();

                                                        @endphp

                                                        <div class="row mb-4 align-items-center">
											            	<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 order-end order-xl-first order-lg-first">
											            		<span class="badge text-wrap fs-6 m-2 lunch_bgcolor lunch_txtcolor">
											            			{{ __("Lunch") }}
											            		</span>

											            		<span class="badge text-wrap fs-6 m-2 breaktime_bgcolor breaktime_txtcolor">
											            			{{ __("Break Time") }}
											            		</span>

												            	@foreach($teachersegments as $teacher)
												            	@php 
												            		$profile = asset($teacher->teachersegment->staff->user->profile_photo_path);
												            		$bgcolor = $teacher->teachersegment->bgcolor;
												            		$txtcolor = $teacher->teachersegment->txtcolor;
												            		$teachername = $teacher->teachersegment->staff->user->name;
												            		$subject = $teacher->teachersegment->curriculum->subject->name;
												            		$subjectotherlanguage = $teacher->teachersegment->curriculum->subject->otherlanguage;
												            		$duration = $teacher->teachersegment->duration;
												            		$id = $teacher->teachersegment->id;


												            		$popoverHeader = "<div class='d-flex flex-wrap align-items-center'>
											                                			<div class='avatar me-3'>
											                                				<img src='$profile' class='rounded-circle'> 
											                                			</div>
											                                			<div> <small> ${teachername} </small> </div>
											                                		</div>";

											                        $popoverText = "<div class='d-flex flex-column'>
										                                				<span class='d-block'> 
										                                					$subject
																		    			</span>
																		    			<small class='d-block'>( $subjectotherlanguage )</small>

										                                				<span class='d-block'> Duration : $duration </span>

										                                			</div>";


												            	@endphp
												            		<span class="badge text-wrap fs-6 m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" data-id="{{ $id }}" data-type="teachersegment">
												            			{{ $subject }}
												            		</span>
												            	@endforeach
												            </div>
											            	<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-first order-xl-end order-lg-end">
											            		<div class="alert alert-info  alert-dismissible fade show">
													            	<h4 class="alert-heading d-inline-block">  
													            		{{ $studentsegment->batch->name }}  
											                      	</h4>

													            	<span class="text-muted small"> | {{ $studentsegment->batch->codeno }}   </span>

													            	<div class="row">
													            		<div class="col-12"> 
													            			<span class="label me-3 small text-muted"> Academic Year </span>
													            			<span class="small"> {{ $studentsegment->batch->section->period->startyear }} -
							                                	{{ $studentsegment->batch->section->period->endyear }}  </span>
													            		</div>

													            		<div class="col-12"> 
													            			<span class="label me-3 small text-muted"> Time </span>
													            			<span class="small"> 
													            				@php
											                                		$s = \Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																                    $starttime = $s->format('g:i A');

																                    $e = \Carbon\Carbon::parse($studentsegment->batch->section->endtime);
																                    $endtime = $e->format('g:i A');

																                    $totalDuration = $e->diffForHumans($s, true);
																                    // $totalDuration = $totalDuration->format('g:i A');

											                                	@endphp
											                                	{{ $starttime }} - {{ $endtime }}
													            			</span>
													            		</div>

													            		<div class="col-12"> 
													            			<span class="label me-3 small text-muted"> Grade </span>
													            			<span class="small"> {{ $studentsegment->batch->section->grade->name }}  </span>
													            		</div>

													            	</div>

													            </div>

											            	</div>
											            </div>

											            <div class="cd-schedule loading">
															<div class="events cal-sectionDiv">
																<ul class="p-0">
																	<li class="events-group">
																		<div class="top-info"><span>Sunday</span></div>

																		<ul class="ui-droppable" data-day="Sunday" data-dayid="6">
																			@if($schedules)
																				@php 
															                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																				@endphp
																				@foreach($schedules as $schedule)
																				@if($schedule->day == "Sunday")
																					@php

																						if($schedule->teachersegment){
																							$bgcolor = $schedule->teachersegment->bgcolor;
																							$txtcolor = $schedule->teachersegment->txtcolor;
																							$subject = $schedule->teachersegment->curriculum->subject->name;
																		            		
												            								$id = $schedule->teachersegment->id;
																							$type = 'teachersegment';


																						}else{
																							$subject = $schedule->title;
																							$bgcolor = "#9e0059";
																							$txtcolor = "#f6b8c5";
																							$id = $schedule->id;
																							$type = 'scheduletype';
																						}

																						$period_starttime = $section_starttime->format('g:i');
																						$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																						
																					@endphp

																					<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																            			{{ $subject }}
																            		</span>
																				
																				@endif
																				@endforeach
																			@endif
																		</ul>
																	</li>

																	<li class="events-group">
																		<div class="top-info"><span>Monday</span></div>
																		<ul class="ui-droppable" data-day="Monday" data-dayid="0">
																			@if($schedules)
																				@php 
															                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																				@endphp
																				@foreach($schedules as $schedule)
																				@if($schedule->day == "Monday")
																					@php

																						if($schedule->teachersegment){
																							$bgcolor = $schedule->teachersegment->bgcolor;
																							$txtcolor = $schedule->teachersegment->txtcolor;
																							$subject = $schedule->teachersegment->curriculum->subject->name;
																		            		
												            								$id = $schedule->teachersegment->id;
																							$type = 'teachersegment';


																						}else{
																							$subject = $schedule->title;
																							$bgcolor = "#9e0059";
																							$txtcolor = "#f6b8c5";
																							$id = $schedule->id;
																							$type = 'scheduletype';
																						}

																						$period_starttime = $section_starttime->format('g:i');
																						$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																						
																					@endphp

																					<span class="badge text-wrap d-block fs-6 drag m-2 " style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																            			{{ $subject }}
																            		</span>
																				
																				@endif
																				@endforeach
																			@endif
																		</ul>
																	</li>

																	<li class="events-group">
																		<div class="top-info"><span>Tuesday</span></div>
																		<ul class="ui-droppable" data-day="Tuesday" data-dayid="1">
																			@if($schedules)
																				@php 
															                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																				@endphp
																				@foreach($schedules as $schedule)
																				@if($schedule->day == "Tuesday")
																					@php

																						if($schedule->teachersegment){
																							$bgcolor = $schedule->teachersegment->bgcolor;
																							$txtcolor = $schedule->teachersegment->txtcolor;
																							$subject = $schedule->teachersegment->curriculum->subject->name;
																		            		
												            								$id = $schedule->teachersegment->id;
																							$type = 'teachersegment';


																						}else{
																							$subject = $schedule->title;
																							$bgcolor = "#9e0059";
																							$txtcolor = "#f6b8c5";
																							$id = $schedule->id;
																							$type = 'scheduletype';
																						}

																						$period_starttime = $section_starttime->format('g:i');
																						$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																						
																					@endphp

																					<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																            			{{ $subject }}
																            		</span>
																				
																				@endif
																				@endforeach
																			@endif
																		</ul>
																	</li>

																	<li class="events-group">
																		<div class="top-info"><span>Wednesday</span></div>
																		<ul class="ui-droppable" data-day="Wednesday" data-dayid="2">
																			@if($schedules)
																				@php 
															                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																				@endphp
																				@foreach($schedules as $schedule)
																				@if($schedule->day == "Wednesday")
																					@php

																						if($schedule->teachersegment){
																							$bgcolor = $schedule->teachersegment->bgcolor;
																							$txtcolor = $schedule->teachersegment->txtcolor;
																							$subject = $schedule->teachersegment->curriculum->subject->name;
																		            		
												            								$id = $schedule->teachersegment->id;
																							$type = 'teachersegment';


																						}else{
																							$subject = $schedule->title;
																							$bgcolor = "#9e0059";
																							$txtcolor = "#f6b8c5";
																							$id = $schedule->id;
																							$type = 'scheduletype';
																						}

																						$period_starttime = $section_starttime->format('g:i');
																						$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																						
																					@endphp

																					<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																            			{{ $subject }}
																            		</span>
																				
																				@endif
																				@endforeach
																			@endif
																		</ul>
																	</li>

																	<li class="events-group">
																		<div class="top-info"><span>Thursday</span></div>
																		<ul class="ui-droppable" data-day="Thursday" data-dayid="3">
																			@if($schedules)
																				@php 
															                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																				@endphp
																				@foreach($schedules as $schedule)
																				@if($schedule->day == "Thursday")
																					@php

																						if($schedule->teachersegment){
																							$bgcolor = $schedule->teachersegment->bgcolor;
																							$txtcolor = $schedule->teachersegment->txtcolor;
																							$subject = $schedule->teachersegment->curriculum->subject->name;
																		            		
												            								$id = $schedule->teachersegment->id;
																							$type = 'teachersegment';


																						}else{
																							$subject = $schedule->title;
																							$bgcolor = "#9e0059";
																							$txtcolor = "#f6b8c5";
																							$id = $schedule->id;
																							$type = 'scheduletype';
																						}

																						$period_starttime = $section_starttime->format('g:i');
																						$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																						
																					@endphp

																					<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																            			{{ $subject }}
																            		</span>
																				
																				@endif
																				@endforeach
																			@endif
																		</ul>
																	</li>

																	<li class="events-group">
																		<div class="top-info"><span>Friday</span></div>

																		<ul class="ui-droppable" data-day="Friday" data-dayid="4">
																			@if($schedules)
																				@php 
															                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																				@endphp
																				@foreach($schedules as $schedule)
																				@if($schedule->day == "Friday")
																					@php

																						if($schedule->teachersegment){
																							$bgcolor = $schedule->teachersegment->bgcolor;
																							$txtcolor = $schedule->teachersegment->txtcolor;
																							$subject = $schedule->teachersegment->curriculum->subject->name;
																		            		
												            								$id = $schedule->teachersegment->id;
																							$type = 'teachersegment';


																						}else{
																							$subject = $schedule->title;
																							$bgcolor = "#9e0059";
																							$txtcolor = "#f6b8c5";
																							$id = $schedule->id;
																							$type = 'scheduletype';
																						}

																						$period_starttime = $section_starttime->format('g:i');
																						$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																						
																					@endphp

																					<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																            			{{ $subject }}
																            		</span>
																				
																				@endif
																				@endforeach
																			@endif
																		</ul>
																	</li>

																	<li class="events-group">
																		<div class="top-info"><span>Saturday</span></div>

																		<ul class="ui-droppable" data-day="Saturday" data-dayid="5">
																			@if($schedules)
																				@php 
															                    	$section_starttime = Carbon\Carbon::parse($studentsegment->batch->section->starttime);
																				@endphp
																				@foreach($schedules as $schedule)
																				@if($schedule->day == "Saturday")
																					@php

																						if($schedule->teachersegment){
																							$bgcolor = $schedule->teachersegment->bgcolor;
																							$txtcolor = $schedule->teachersegment->txtcolor;
																							$subject = $schedule->teachersegment->curriculum->subject->name;
																		            		
												            								$id = $schedule->teachersegment->id;
																							$type = 'teachersegment';


																						}else{
																							$subject = $schedule->title;
																							$bgcolor = "#9e0059";
																							$txtcolor = "#f6b8c5";
																							$id = $schedule->id;
																							$type = 'scheduletype';
																						}

																						$period_starttime = $section_starttime->format('g:i');
																						$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																						
																					@endphp

																					<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
																            			{{ $subject }}
																            		</span>
																				
																				@endif
																				@endforeach
																			@endif
																		</ul>
																	</li>

																	
																</ul>
															</div>


															<div class="cover-layer"></div>
														</div> <!-- .cd-schedule -->

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



@section('script_content')

@stop

</x-template>