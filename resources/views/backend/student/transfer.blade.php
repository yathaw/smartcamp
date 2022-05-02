<x-template>
	@php
        $authuser = Auth::user();
    @endphp
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Transfer")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Transfer")}}</li>
	        </ol>
	    </nav>
	</div>

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

	<section class="section">
	    <div class="row">
	    	@if(isset($transfer))
	    	<div class="col-12">
	        	<div class="d-grid gap-2 d-md-flex justify-content-end mb-2">
				  	<div class="btn-group" role="group" aria-label="Basic example">
					  	<a href="{{ route('master.transfer') }}" class="btn btn-outline-primary">Back</a>
					  	<a href="{{ route('prnpriview',['transfer'=>$transfer->id]) }}" class="btn btn-outline-primary printBtn">Print</a>

					</div>
				</div>
	        	<div class="card p-5">
	        		<div class="row align-items-center">
	        			<div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
	        				<img src="{{ asset($authuser->school->logo) }}" class="img-fluid w-25 p-3">
	        			</div>
	        			<div class="col-sm-5 text-center text-sm-end">
	        				<h1 class="d-none d-lg-block logo_font"> {{ $authuser->school->name }} </h1>
	        				<p> ID Number : #{{ $transfer->invoiceno }} </p>
	        			</div>
	        		</div>
	        		<div class="border border-1 my-2"></div>

	        		<div class="row text-center mt-4">
	        			<h1 class="text-uppercase"> Application For Transfer  </h1>
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
		        							<td colspan="3" class="py-3">
		        								<div class="float-end">
			        								<span class="fw-600 text-muted me-3"> Date of This Application : </span>
			        								<span> {{ date('d M, Y',strtotime($transfer->approvedate)) }} </span>
			        							</div>
		        							</td>
		        						</tr>
		        						<tr>
		        							<td colspan="2" class="py-3">
		        								<span class="fw-600 text-muted me-3"> Student Name : </span>
		        								<span> {{ $transfer->student->user->name }} </span>
		        							</td>
		        							<td class="py-3">
		        								<span class="fw-600 text-muted me-3"> Date of Birth : </span>
		        								<span> {{ date('d M, Y',strtotime($transfer->student->dob)) }} </span>
		        							</td>
		        						</tr>

		        						<tr>
		        							<td class="py-3">
		        								<span class="fw-600 text-muted me-3"> Parent Name : </span>
		        								<span> {{ $transfer->student->guardians[0]->user->name }} </span>
		        							</td>
		        							<td class="py-3">
		        								<span class="fw-600 text-muted me-3"> Email : </span>
		        								<span> {{ $transfer->student->guardians[0]->workemail }} </span>
		        							</td>
		        							<td class="py-3">
		        								<span class="fw-600 text-muted me-3"> Phone : </span>
		        								<span> {{ $transfer->student->guardians[0]->phone }} </span>
		        							</td>
		        						</tr>

		        						<tr>
		        							<td colspan="2" rowspan="2" class="py-3">
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
		        							<td colspan="2" rowspan="2"  class="py-3">
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
		        							<td colspan="2" class="py-3">
		        								<span class="fw-600 text-muted me-3"> Last Date of attendance in the School  : </span>
		        							</td>
		        							<td class="py-3 text-center">
		        								<span class="text-center"> {{ $transfer->lastattendance }} </span>
		        							</td>
		        						</tr>

		        						<tr>
		        							<td colspan="3" class="py-3">
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
		        							<td colspan="3" class="py-3">
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
	        					
	        					<div class="my-2">
	        						<small class="text-muted"> Name : </small>
	        						<div class="border border-bottom mt-4"></div>
	        					</div>

	        					<div class="my-2">
	        						<small class="text-muted"> Date : </small>
	        						<div class="border border-bottom mt-4"></div>
	        					</div>

	        					<div class="my-2">
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
	        @endif

	        <div class="col-lg-12 @if(isset($transfer)) d-none @endif">
	        	<div class="card">
	            	<div class="card-header row align-items-center">
	            		<div class="col-12">
	                    	{{ __("Transfer Student") }}
	            		</div>
	            	</div>
	                <div class="card-body pt-3">
					    
	                	@if (count($errors) > 0)
		                    <div class="alert alert-danger">
		                        <ul>
		                            @foreach ($errors->all() as $error)
		                              <li>{{ $error }}</li>
		                            @endforeach
		                        </ul>
		                    </div>
		                @endif

	                	<form class="new-added-form" action="{{ route('master.transfer') }}" method="POST" enctype="multipart/form-data">
		                    @csrf
		                    
		                    <div class="row mb-3">
		                    	<div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  form-group mb-3">
		                            <label class="mb-2" for="inputStudent">{{ __("Choose Student") }} * </label>
		                            <select class="select2 students" name="student" id="inputStudent">
		                            	<option></option>
		                            	@foreach($students as $student)
		                            		<option value="{{ $student->id }}" @if(isset($studentid)) @if($studentid == $student->id) selected @endif @endif>
		                            			{{ $student->user->name }}
		                            		</option>
		                            	@endforeach
	                   				</select>

		                    	</div>
		                    </div>

		                    <div class="row mb-3">
		                    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="inputAdmitted" class="form-label">{{ __("Class to which he/she was admitted") }}</label>
                                    <div class="input-group mb-3">
									  	<input type="text" name="admitted" class="form-control">
									  	<span class="input-group-text">{{ __("Year") }} </span>
									  	<input type="text" name="ay" id="inputAdmitted" class="form-control @if ($errors->has('ay')) is-invalid @endif @if($errors->any() && !$errors->has('ay')) is-valid @endif" value="{{ old('ay') }}">
									</div>

                                    

                                    <p class="text-danger">
                                        {{ $errors->first('admitted') }}
                                    </p>
                                </div>
		                    </div>

		                    <div class="row mb-3">
		                    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="inputPresentclass" class="form-label">{{ __("The present classs") }}</label>
                                    <div class="input-group mb-3">
									  	<input type="text" name="pc" class="form-control">
									  	<span class="input-group-text">{{ __("Year") }} </span>
	                                    <input type="text" name="pcy" id="inputPresentclass" class="form-control @if ($errors->has('pcy')) is-invalid @endif @if($errors->any() && !$errors->has('pcy')) is-valid @endif" value="{{ old('pcy') }}">
	                                </div>

                                    <p class="text-danger">
                                        {{ $errors->first('pcy') }}
                                    </p>
                                </div>
		                    </div>

		                    <div class="row mb-3">
		                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="inputLastattendance" class="form-label">{{ __("Last Date of attendance in the School :") }}</label>
									<input type="date" name="lastattendance" class="form-control" id="inputLastattendance">

                                    <p class="text-danger">
                                        {{ $errors->first('lastattendance') }}
                                    </p>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="inputApprovedate" class="form-label">{{ __("Approved Date :") }}</label>
									<input type="date" name="approvedate" class="form-control" id="inputApprovedate">

                                    <p class="text-danger">
                                        {{ $errors->first('approvedate') }}
                                    </p>
                                </div>

		                    </div>
		                    

		                    <div class="row mb-3">
		                    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="inputResult" class="form-label">{{ __("Result at the end of the Academic Year") }}</label>
                                    <div class="input-group mb-3">
                                    	<span class="input-group-text"> a) </span>
									  	<span class="input-group-text">{{ __("Passed and Promoted to Class") }} </span>
									  	<input type="text" name="ppc" class="form-control">
									  	<span class="input-group-text">{{ __("for the Academic Year") }} </span>
									  	<input type="text" name="acyear1" class="form-control">
									</div>
									<div class="input-group">
                                    	<span class="input-group-text"> b) </span>

									  	<span class="input-group-text">{{ __("Detained in Class") }} </span>
									  	<input type="text" name="dc" class="form-control">
									  	<span class="input-group-text">{{ __("for the Academic Year") }} </span>
									  	<input type="text" name="acyear2" class="form-control">
									</div>
                                </div>
		                    </div>

		                    <div class="row mb-3">
		                    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <label for="inputDescription" class="form-label">{{ __("Observations if any") }}</label>
                                    <textarea name="desscription" id="inputDescription" class="form-control @if ($errors->has('desscription')) is-invalid @endif @if($errors->any() && !$errors->has('desscription')) is-valid @endif">{{ old('desscription') }}</textarea>

                                    <p class="text-danger">
                                        {{ $errors->first('desscription') }}
                                    </p>
                                </div>
		                    </div>


	                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
	                            <button type="reset" class="btn btn-secondary">{{ __("Resets")}}</button>

	                			<button type="submit" class="btn btn-primary">{{ __("Save Changes")}}</button>

	                        </div>
		                </form>
	                </div>
	            </div>
	        </div>

	        
	    </div>
	</section>



@section('script_content')
	
	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";
    </script>
    
    <script type="text/javascript">
    	var starttime=''; var endtime='';
        $(document).ready(function() {


			$('.printBtn').printPage();


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
            }
            else{
            	var placeholder_title ="Please select at least one option";
            }

        	$('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

            const admitted = document.querySelector('input[name="ay"]');
            const admitted_datepicker = new Datepicker(admitted, {
                autohide: true,
                pickLevel: 2,
                'format': 'yyyy',
                minDate: new Date(),

            }); 


            const presentclass = document.querySelector('input[name="pcy"]');
            const presentclass_datepicker = new Datepicker(presentclass, {
                autohide: true,
                pickLevel: 2,
                'format': 'yyyy',
                minDate: new Date(),

            }); 

        });
    </script>

@stop
</x-template>