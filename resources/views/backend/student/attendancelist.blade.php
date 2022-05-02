<x-template>
	@php
	    $authRole = Auth::user()->getRoleNames()[0];
	    $authuser = Auth::user();
	@endphp

	<div class="pagetitle">
	    <h1> {{ __("Attendance")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Attendance")}}</li>
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
				            @endforeach
				        </div>
				        <!-- End Bordered Tabs -->
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
                                                        $present = $authuser->student->getAttendance_status('App\Models\Attendance',$authuser->student->id, $studentsegment->batch_id, 0) ?? 0;

                                                        $absent = $authuser->student->getAttendance_status('App\Models\Attendance',$authuser->student->id, $studentsegment->batch_id, 1) ?? 0;

                                                        $late = $authuser->student->getAttendance_status('App\Models\Attendance',$authuser->student->id, $studentsegment->batch_id, 2) ?? 0;

                                                        $execused = $authuser->student->getAttendance_status('App\Models\Attendance',$authuser->student->id, $studentsegment->batch_id, 3) ?? 0;

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
                        @endif
				    </div>
				</div>
	        </div>
	    </div>
	</section>



@section('script_content')

@stop

</x-template>