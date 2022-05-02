<x-template>
	@php
	    $authRole = Auth::user()->getRoleNames()[0];
	    $authuser = Auth::user();
	@endphp

	<div class="pagetitle">
	    <h1> {{ __("Installment")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Installment")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section profile">
	    <div class="row">
	        <div class="col-lg-12">
	        	<div class="card">
				    <div class="card-body pt-3">
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

                                                                            @php 
                                                                                $studentinstallments = $student->getPaidpayments('App\Models\Payment', $student->id) ?? '';

                                                                            @endphp

                                                                            <div>
                                                                                @if(in_array($package->id ,$studentinstallments))
                                                                                    
                                                                                    <button type="button" class="btn btn-primary btn-sm me-2 installment_detailBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ("View") }}" data-studentid="{{ $student->id }}" data-packageid="{{ $package->id }}" data-sectionid="{{ $studentsegment->batch->section->id }}">
                                                                                        <i class="bi bi-eye"></i> 
                                                                                    </button>

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
                                                                            @else
                                                                            	<span class="text-warning fs-5 fw-bold"> Not Paid </span>

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
				            @endforeach
				        </div>
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