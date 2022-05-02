<x-template>
	@php
        $authuser = Auth::user();
    @endphp
    <div class="row">
		<div class="col-12">
				<div class="row">
					<div class="col-7 mb-3 mb-sm-0">
						<img src="{{ asset($authuser->school->logo) }}" class="img-fluid" style="width: 100px; height:100px">
					</div>
					<div class="col-5 ">
						<h1 class="logo_font"> {{ $authuser->school->name }} </h1>
						<p> ID Number : #{{ $transfer->invoiceno }} </p>
					</div>
				</div>
				<div class="border border-1 my-2"></div>

				<div class="row text-center mt-4">
					<h3 class="text-uppercase"> Application For Transfer  </h3>
					<p class="text-1 text-center text-muted">
						Transfers may be approved for one year only. Parent must request renewals annually.
					</p>
				</div>
				<div class="row">
					<div class="col-12">
		    			<div class="table-responsive">
		    				<table class="table table-bordered text-1 table-sm table-striped">
		    					<tbody>
		    						<tr>
		    							<td colspan="3" >
		    								<div class="float-end">
		        								<span class="fw-600 text-muted me-3"> Date of This Application : </span>
		        								<span> {{ date('d M, Y',strtotime($transfer->approvedate)) }} </span>
		        							</div>
		    							</td>
		    						</tr>
		    						<tr>
		    							<td colspan="2" >
		    								<span class="fw-600 text-muted me-3"> Student Name : </span>
		    								<span> {{ $transfer->student->user->name }} </span>
		    							</td>
		    							<td >
		    								<span class="fw-600 text-muted me-3"> Date of Birth : </span>
		    								<span> {{ date('d M, Y',strtotime($transfer->student->dob)) }} </span>
		    							</td>
		    						</tr>

		    						<tr>
		    							<td >
		    								<span class="fw-600 text-muted me-3"> Parent Name : </span>
		    								<span> {{ $transfer->student->guardians[0]->user->name }} </span>
		    							</td>
		    							<td >
		    								<span class="fw-600 text-muted me-3"> Email : </span>
		    								<span> {{ $transfer->student->guardians[0]->workemail }} </span>
		    							</td>
		    							<td >
		    								<span class="fw-600 text-muted me-3"> Phone : </span>
		    								<span> {{ $transfer->student->guardians[0]->phone }} </span>
		    							</td>
		    						</tr>

		    						<tr>
		    							<td colspan="2" rowspan="2" >
		    								<span class="fw-600 text-muted me-3"> Class to which he/she was admitted  : </span>
		    							</td>
		    							<td colspan="2" class="py-3 text-center">
		    								<span class="text-center">  {{ $transfer->admitted }} </span>
		    							</td>
		    						</tr>

		    						<tr>
		    							<td  class="py-3 text-center">
		    								<small class="text-center text-muted d-block"> Year </small>
		    								<span class="text-center"> {{ $transfer->ay }} </span>
		    							</td>
		    						</tr>

		    						<tr>
		    							<td colspan="2" rowspan="2"  >
		    								<span class="fw-600 text-muted me-3"> The present classs  : </span>
		    							</td>
		    							<td class="py-3 text-center">
		    								<span class="text-center"> {{ $transfer->pc }} </span>
		    							</td>
		    						</tr>

		    						<tr>
		    							<td  class="py-3 text-center">
		    								<small class="text-center text-muted d-block"> Year </small>
		    								<span class="text-center"> {{ $transfer->pcy }} </span>
		    							</td>
		    						</tr>

		    						<tr>
		    							<td colspan="2" >
		    								<span class="fw-600 text-muted me-3"> Last Date of attendance in the School  : </span>
		    							</td>
		    							<td class="py-3 text-center">
		    								<span class="text-center"> {{ $transfer->lastattendance }} </span>
		    							</td>
		    						</tr>

		    						<tr>
		    							<td colspan="3" >
		    								<small class="d-block text-muted text-decoration-underline"> Result at the end of the Academic Year </small>
		    								<div>
		        								<span class="fw-600 text-muted me-3"> Passed and Promoted to Class  : </span>
		        								<span class="text-center"> {{ $transfer->ppc }} </span>
		        								<span class="fw-600 text-muted mx-3"> for the Academic Year </span>
		        								<span class="text-center"> {{ $transfer->acyear1 }} </span>
		    								</div>
		    								<div>
		        								<span class="fw-600 text-muted me-3"> Detained in Class  : </span>
		        								<span class="text-center"> {{ $transfer->dc }} </span>
		        								<span class="fw-600 text-muted mx-3"> for the Academic Year </span>
		        								<span class="text-center"> {{ $transfer->acyear2 }} </span>
		        							</div>
		    							</td>
		    						</tr>
		    						<tr>
		    							<td colspan="3" >
		    								<small class="d-block text-muted text-decoration-underline"> Observations if any </small>
		    								<div>
		        								<span > {{ $transfer->desscription }} </span>
		    								</div>
		    							</td>
		    						</tr>

		    					</tbody>
		    				</table>
		    			</div>
		    		</div>
				</div>

				<div class="row mt-3">
					<div class="row">
						<div class="col-6 ">
							<h5 class="text-dark"> Headmaster / Principal / Director </h5>
							
							<div class="">
								<small class="text-muted"> Name : </small>
								<div class="border border-bottom mt-4"></div>
							</div>

							<div class="">
								<small class="text-muted"> Date : </small>
								<div class="border border-bottom mt-4"></div>
							</div>

							<div class="">
								<small class="text-muted"> Signature : </small>
								<div class="border border-bottom mt-4"></div>
							</div>
						</div>

						<div class="col-6 ">
							<div class="border h-100 w-50 float-end"></div>
						</div>
					</div>

				</div>
		</div>
	</div>
</x-template>