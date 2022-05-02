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
                        @endif

				        <!-- End Bordered Tabs -->
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
	            <div class="modal-body">
	            	<div class="row">
	            		<p class="col-4"> Installment : </p>
	            		<p class="col-8 detail_installmentTitle"> </p>
	            	</div>
	            	<div class="row">
	            		<p class="col-4"> Date : </p>
	            		<p class="col-8 detail_paymentDate"> </p>
	            	</div>
	            	<div class="row">
	            		<p class="col-4"> Amount : </p>
	            		<p class="col-8 detail_amount"> </p>
	            	</div>
	            	<div class="row">
					    <div class="col-12 mb-3">
					    	<img src="" class="detail_invoicephoto img-fluid">
					    </div>
					</div>	

	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Close")}}</button>
	            </div>
			</div>

        </div>
    </div>
</div>


@section('script_content')
    <script type="text/javascript">
    	$(document).ready(function(){
    		var profile_url = '{{ URL::asset('') }}';
    		// EDIT
            $('.accordion').on('click', '.installment_detailBtn', function (){

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