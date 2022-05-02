<div class="card" >
			            	<div class="card-header row align-items-center">
			            		<div class="col-xl-10 col-lg-10 col-md-6 col-sm-12 col-12">
				            		<h4 class="d-inline-block">  
					            		{{ $batch->name }} 
			                      	</h4>

					            	<span class="text-muted small"> | {{ $batch->codeno }}  </span>

					            	<div class="row">
					            		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"> 
					            			<span class="label me-3 small text-muted"> Academic Year </span>
					            			<span class="small"> {{ $period->startyear }} -
	                                	{{ $period->endyear }}  </span>
					            		</div>

					            		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"> 
					            			<span class="label me-3 small text-muted"> Time </span>
					            			<span class="small"> 
					            				@php
			                                		$s = Carbon\Carbon::parse($section->starttime);
								                    $starttime = $s->format('g:i A');

								                    $e = Carbon\Carbon::parse($section->endtime);
								                    $endtime = $e->format('g:i A');

								                    $totalDuration = $e->diffForHumans($s, true);
								                    // $totalDuration = $totalDuration->format('g:i A');

			                                	@endphp
			                                	{{ $starttime }} - {{ $endtime }}
					            			</span>
					            		</div>

					            		<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"> 
					            			<span class="label me-3 small text-muted"> Grade </span>
					            			<span class="small"> {{ $section->grade->name }}  </span>
					            		</div>

					            	</div>
					            </div>
					            <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 d-grid gap-2">
					            	<a href="" class="btn btn-outline-primary createBtn"> Export </a>
					            </div>
			            	</div>
			            	<div class="card-body">
			            		

			            		<div class="cd-schedule loading">
	            				 
	            					<div class="events cal-sectionDiv">
										<ul class="p-0">
											<li class="events-group" >
												<div class="top-info"><span>Sunday</span></div>
												<ul class="mx-2">
													@php 
								                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
													@endphp
													@foreach($schedules as $schedule)
													@if($schedule->day == "Sunday")
														@php

															if($schedule->teachersegment){
																$bgcolor = $schedule->teachersegment->bgcolor;
																$txtcolor = $schedule->teachersegment->txtcolor;
																$duration = Carbon\Carbon::parse($schedule->teachersegment->duration);

								                    			$duration = $duration->format('g:i');

								                    			$minutes = 0; 
															    if (strpos($duration, ':') !== false) 
															    { 
															        list($duration, $minutes) = explode(':', $duration); 
															    } 
															    $duration =  $duration * 60 + $minutes; 

						            							$profile = asset($schedule->teachersegment->staff->user->profile_photo_path);
															    $teachername = $schedule->teachersegment->staff->user->name;
											            		$subject = $schedule->teachersegment->curriculum->subject->name;
											            		$subjectotherlanguage = $schedule->teachersegment->curriculum->subject->otherlanguage;
											            		$duration = $schedule->teachersegment->duration;

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


									                                			</div>";

															}else{
																$bgcolor = "#9e0059";
																$txtcolor = "#f6b8c5";
															}

															$period_starttime = $section_starttime->format('g:i');
															$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


															
														@endphp
													<li class="single-event my-2" style="background-color: {{ $bgcolor }};" @if($schedule->teachersegment) data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" @endif>
														<a tabindex="0" class="text-decoration-none pe-none" >
															<small class="event-date small" style="color: {{ $txtcolor }}">
																{{ $period_starttime }} - {{ $period_endtime }}
															</small>

															<p class="event-name h-100" style="color: {{ $txtcolor }}"> 
																@if($schedule->teachersegment)
																	{{ $schedule->teachersegment->curriculum->subject->name }} 
																@else
																	{{ $schedule->title }} 

																@endif
															</p>
														</a>
													</li>
													@endif
													@endforeach
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info">
													<span>Monday</span>
													<a href="">  </a>
												</div>
												<ul class="mx-2">
													@php 
								                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
													@endphp
													@foreach($schedules as $schedule)
													@if($schedule->day == "Monday")
														@php

															if($schedule->teachersegment){
																$bgcolor = $schedule->teachersegment->bgcolor;
																$txtcolor = $schedule->teachersegment->txtcolor;
																$duration = Carbon\Carbon::parse($schedule->teachersegment->duration);

								                    			$duration = $duration->format('g:i');

								                    			$minutes = 0; 
															    if (strpos($duration, ':') !== false) 
															    { 
															        list($duration, $minutes) = explode(':', $duration); 
															    } 
															    $duration =  $duration * 60 + $minutes; 

						            							$profile = asset($schedule->teachersegment->staff->user->profile_photo_path);
															    $teachername = $schedule->teachersegment->staff->user->name;
											            		$subject = $schedule->teachersegment->curriculum->subject->name;
											            		$subjectotherlanguage = $schedule->teachersegment->curriculum->subject->otherlanguage;
											            		$duration = $schedule->teachersegment->duration;

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


									                                			</div>";

															}else{
																$bgcolor = "#9e0059";
																$txtcolor = "#f6b8c5";
															}

															$period_starttime = $section_starttime->format('g:i');
															$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


															
														@endphp
													<li class="single-event my-2" style="background-color: {{ $bgcolor }};" @if($schedule->teachersegment) data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" @endif>
														<a tabindex="0" class="text-decoration-none pe-none" >
															<small class="event-date small" style="color: {{ $txtcolor }}">
																{{ $period_starttime }} - {{ $period_endtime }}
															</small>

															<p class="event-name h-100" style="color: {{ $txtcolor }}"> 
																@if($schedule->teachersegment)
																	{{ $schedule->teachersegment->curriculum->subject->name }} 
																@else
																	{{ $schedule->title }} 

																@endif
															</p>
														</a>
													</li>
													@endif
													@endforeach
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Tuesday</span></div>
												<ul class="mx-2">
													@php 
								                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
													@endphp
													@foreach($schedules as $schedule)
													@if($schedule->day == "Tuesday")
														@php

															if($schedule->teachersegment){
																$bgcolor = $schedule->teachersegment->bgcolor;
																$txtcolor = $schedule->teachersegment->txtcolor;
																$duration = Carbon\Carbon::parse($schedule->teachersegment->duration);

								                    			$duration = $duration->format('g:i');

								                    			$minutes = 0; 
															    if (strpos($duration, ':') !== false) 
															    { 
															        list($duration, $minutes) = explode(':', $duration); 
															    } 
															    $duration =  $duration * 60 + $minutes; 

						            							$profile = asset($schedule->teachersegment->staff->user->profile_photo_path);
															    $teachername = $schedule->teachersegment->staff->user->name;
											            		$subject = $schedule->teachersegment->curriculum->subject->name;
											            		$subjectotherlanguage = $schedule->teachersegment->curriculum->subject->otherlanguage;
											            		$duration = $schedule->teachersegment->duration;

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


									                                			</div>";

															}else{
																$bgcolor = "#9e0059";
																$txtcolor = "#f6b8c5";
															}

															$period_starttime = $section_starttime->format('g:i');
															$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


															
														@endphp
													<li class="single-event my-2" style="background-color: {{ $bgcolor }};" @if($schedule->teachersegment) data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" @endif>
														<a tabindex="0" class="text-decoration-none pe-none" >
															<small class="event-date small" style="color: {{ $txtcolor }}">
																{{ $period_starttime }} - {{ $period_endtime }}
															</small>

															<p class="event-name h-100" style="color: {{ $txtcolor }}"> 
																@if($schedule->teachersegment)
																	{{ $schedule->teachersegment->curriculum->subject->name }} 
																@else
																	{{ $schedule->title }} 

																@endif
															</p>
														</a>
													</li>
													@endif
													@endforeach
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Wednesday</span></div>
												<ul class="mx-2">
													@php 
								                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
													@endphp
													@foreach($schedules as $schedule)
													@if($schedule->day == "Wednesday")
														@php

															if($schedule->teachersegment){
																$bgcolor = $schedule->teachersegment->bgcolor;
																$txtcolor = $schedule->teachersegment->txtcolor;
																$duration = Carbon\Carbon::parse($schedule->teachersegment->duration);

								                    			$duration = $duration->format('g:i');

								                    			$minutes = 0; 
															    if (strpos($duration, ':') !== false) 
															    { 
															        list($duration, $minutes) = explode(':', $duration); 
															    } 
															    $duration =  $duration * 60 + $minutes; 

						            							$profile = asset($schedule->teachersegment->staff->user->profile_photo_path);
															    $teachername = $schedule->teachersegment->staff->user->name;
											            		$subject = $schedule->teachersegment->curriculum->subject->name;
											            		$subjectotherlanguage = $schedule->teachersegment->curriculum->subject->otherlanguage;
											            		$duration = $schedule->teachersegment->duration;

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


									                                			</div>";

															}else{
																$bgcolor = "#9e0059";
																$txtcolor = "#f6b8c5";
															}

															$period_starttime = $section_starttime->format('g:i');
															$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


															
														@endphp
													<li class="single-event my-2" style="background-color: {{ $bgcolor }};" @if($schedule->teachersegment) data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" @endif>
														<a tabindex="0" class="text-decoration-none pe-none" >
															<small class="event-date small" style="color: {{ $txtcolor }}">
																{{ $period_starttime }} - {{ $period_endtime }}
															</small>

															<p class="event-name h-100" style="color: {{ $txtcolor }}"> 
																@if($schedule->teachersegment)
																	{{ $schedule->teachersegment->curriculum->subject->name }} 
																@else
																	{{ $schedule->title }} 

																@endif
															</p>
														</a>
													</li>
													@endif
													@endforeach
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Thursday</span></div>
												<ul class="mx-2">
													@php 
								                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
													@endphp
													@foreach($schedules as $schedule)
													@if($schedule->day == "Thursday")
														@php

															if($schedule->teachersegment){
																$bgcolor = $schedule->teachersegment->bgcolor;
																$txtcolor = $schedule->teachersegment->txtcolor;
																$duration = Carbon\Carbon::parse($schedule->teachersegment->duration);

								                    			$duration = $duration->format('g:i');

								                    			$minutes = 0; 
															    if (strpos($duration, ':') !== false) 
															    { 
															        list($duration, $minutes) = explode(':', $duration); 
															    } 
															    $duration =  $duration * 60 + $minutes; 

						            							$profile = asset($schedule->teachersegment->staff->user->profile_photo_path);
															    $teachername = $schedule->teachersegment->staff->user->name;
											            		$subject = $schedule->teachersegment->curriculum->subject->name;
											            		$subjectotherlanguage = $schedule->teachersegment->curriculum->subject->otherlanguage;
											            		$duration = $schedule->teachersegment->duration;

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


									                                			</div>";

															}else{
																$bgcolor = "#9e0059";
																$txtcolor = "#f6b8c5";
															}

															$period_starttime = $section_starttime->format('g:i');
															$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


															
														@endphp
													<li class="single-event my-2" style="background-color: {{ $bgcolor }};" @if($schedule->teachersegment) data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" @endif>
														<a tabindex="0" class="text-decoration-none pe-none" >
															<small class="event-date small" style="color: {{ $txtcolor }}">
																{{ $period_starttime }} - {{ $period_endtime }}
															</small>

															<p class="event-name h-100" style="color: {{ $txtcolor }}"> 
																@if($schedule->teachersegment)
																	{{ $schedule->teachersegment->curriculum->subject->name }} 
																@else
																	{{ $schedule->title }} 

																@endif
															</p>
														</a>
													</li>
													@endif
													@endforeach
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Friday</span></div>

												<ul class="mx-2">
													@php 
								                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
													@endphp
													@foreach($schedules as $schedule)
													@if($schedule->day == "Friday")
														@php

															if($schedule->teachersegment){
																$bgcolor = $schedule->teachersegment->bgcolor;
																$txtcolor = $schedule->teachersegment->txtcolor;
																$duration = Carbon\Carbon::parse($schedule->teachersegment->duration);

								                    			$duration = $duration->format('g:i');

								                    			$minutes = 0; 
															    if (strpos($duration, ':') !== false) 
															    { 
															        list($duration, $minutes) = explode(':', $duration); 
															    } 
															    $duration =  $duration * 60 + $minutes; 

						            							$profile = asset($schedule->teachersegment->staff->user->profile_photo_path);
															    $teachername = $schedule->teachersegment->staff->user->name;
											            		$subject = $schedule->teachersegment->curriculum->subject->name;
											            		$subjectotherlanguage = $schedule->teachersegment->curriculum->subject->otherlanguage;
											            		$duration = $schedule->teachersegment->duration;

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


									                                			</div>";

															}else{
																$bgcolor = "#9e0059";
																$txtcolor = "#f6b8c5";
															}

															$period_starttime = $section_starttime->format('g:i');
															$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


															
														@endphp
													<li class="single-event my-2" style="background-color: {{ $bgcolor }};" @if($schedule->teachersegment) data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" @endif>
														<a tabindex="0" class="text-decoration-none pe-none" >
															<small class="event-date small" style="color: {{ $txtcolor }}">
																{{ $period_starttime }} - {{ $period_endtime }}
															</small>

															<p class="event-name h-100" style="color: {{ $txtcolor }}"> 
																@if($schedule->teachersegment)
																	{{ $schedule->teachersegment->curriculum->subject->name }} 
																@else
																	{{ $schedule->title }} 

																@endif
															</p>
														</a>
													</li>
													@endif
													@endforeach
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Saturday</span></div>

												<ul class="mx-2">
													@php 
								                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
													@endphp
													@foreach($schedules as $schedule)
													@if($schedule->day == "Saturday")
														@php

															if($schedule->teachersegment){
																$bgcolor = $schedule->teachersegment->bgcolor;
																$txtcolor = $schedule->teachersegment->txtcolor;
																$duration = Carbon\Carbon::parse($schedule->teachersegment->duration);

								                    			$duration = $duration->format('g:i');

								                    			$minutes = 0; 
															    if (strpos($duration, ':') !== false) 
															    { 
															        list($duration, $minutes) = explode(':', $duration); 
															    } 
															    $duration =  $duration * 60 + $minutes; 


															}else{
																$bgcolor = "#9e0059";
																$txtcolor = "#f6b8c5";


															}

															$period_starttime = $section_starttime->format('g:i');
															$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


														@endphp
													<li class="single-event my-2" style="background-color: {{ $bgcolor }};">
														<a href="javascript:void(0)" class="text-decoration-none pe-none">
															<small class="event-date small" style="color: {{ $txtcolor }}">
																{{ $period_starttime }} - {{ $period_endtime }}
															</small>

															<p class="event-name h-100" style="color: {{ $txtcolor }}"> 
																@if($schedule->teachersegment)
																	{{ $schedule->teachersegment->curriculum->subject->name }} 
																@else
																	{{ $schedule->title }} 

																@endif
															</p>
														</a>
													</li>
													@endif
													@endforeach
												</ul>
											</li>

											
										</ul>
									</div>

									<div class="cover-layer"></div>
								</div> <!-- .cd-schedule -->
			            	</div>
			            </div>