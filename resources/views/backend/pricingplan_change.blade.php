<x-template>
	@section('style_content')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/steps.css') }}">
    @endsection
	<div class="pagetitle">
	    <h1> {{ __("Change Plan")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item"><a href="{{ route('master.plan.index') }}">{{ __("Billing Information")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Change Plan")}}</li>
	        </ol>
	    </nav>
	</div>
	<!-- End Page Title -->
	<section class="section contact">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('master.plan.change', $plan->id ) }}" method="post">
            @csrf
    	    <div class="row gy-4 align-items-center">
    	        <div class="col-xl-6">
    	            <div class="row g-3">
                        @foreach($banks as $bank)
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <label class="credi-card__label">
                    			<div class="card">
    	                            <input class="card-input-element" type="radio" name="credicard" value="{{ $bank->id }}" {{(old('credicard') == $bank->id) ? 'checked' : ''}} />
    	                            <div class="credi-card">
    	                                <div class="credi-card__content">
    	                                    <img src="{{ $bank->logo }}" class="img-fluid credi-card__icon mx-auto">
    	                                </div>
    	                            </div>
                        		</div>

                            </label>
                        </div>
                        @endforeach
                        @if($errors->has('planid'))
                            <span class="text-danger fs-6"> {{ $errors->first('credicard') }} </span>
                        @endif
                    </div>
    	        </div>
    	        <div class="col-xl-6">
    	            <div class="card p-4">

                        <div class="row">
                            <label for="inputCardno" class="form-label"> {{ __("Card Number")}}</label>

                            <div class="form-group col-3 mb-3">
                                <input type="number" id="inputCardno" class="form-control @if ($errors->has('number')) is-invalid @endif @if($errors->any() && !$errors->has('number')) is-valid @endif" name="number" value="{!! old('number') !!}">
                            </div>

                            <div class="form-group col-3 mb-3">
                                <input type="number" id="inputCardno1" class="form-control @if ($errors->has('number1')) is-invalid @endif @if($errors->any() && !$errors->has('number1')) is-valid @endif" name="number1" value="{!! old('number1') !!}">
                            </div>

                            <div class="form-group col-3 mb-3">
                                <input type="number" id="inputCardn2" class="form-control @if ($errors->has('number2')) is-invalid @endif @if($errors->any() && !$errors->has('number2')) is-valid @endif" name="number2" value="{!! old('number2') !!}">
                            </div>

                            <div class="form-group col-3 mb-3">
                                <input type="number" id="inputCardn3" class="form-control @if ($errors->has('number3')) is-invalid @endif @if($errors->any() && !$errors->has('number3')) is-valid @endif" name="number3" value="{!! old('number3') !!}">
                            </div>

                            @php 
                                $errornumbers = [];
                                if($errors->has('number')){
                                    $errornumbers[] = $errors->first('number');
                                }
                                if($errors->has('number1')){
                                    $errornumbers[] = $errors->first('number1');
                                }
                                if($errors->has('number2')){ 
                                    $errornumbers[] = $errors->first('number2');
                                } 
                                if($errors->has('number3')){
                                    $errornumbers[] = $errors->first('number3');
                                }
                                
                            @endphp

                            @if(count($errornumbers) > 0) 
                                <span class="text-danger fs-6"> {{ __('The card number field is required.') }} </span>
                            @endif
                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-12 mb-3">
                                <label for="inputCardname" class="form-label"> {{ __("Card Holder Name")}}</label>
                                <input type="text" name="cardholdername" id="inputCardname" class="form-control @if ($errors->has('cardholdername')) is-invalid @endif @if($errors->any() && !$errors->has('cardholdername')) is-valid @endif" placeholder="{{ __("Your Name")}}" value="{!! old('cardholdername') !!}">

                                @if($errors->has('cardholdername'))
                                    <span class="text-danger fs-6"> {{ $errors->first('cardholdername') }} </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                                <label for="inputCardname" class="form-label"> {{ __("Expiration Date")}}</label>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <input type="text" name="cardmonth" id="inputCardMonth" class="form-control @if ($errors->has('cardmonth')) is-invalid @endif @if($errors->any() && !$errors->has('cardmonth')) is-valid @endif" value="{!! old('cardmonth') !!}">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <input type="text" name="cardyear" id="inputCardYear" class="form-control @if ($errors->has('cardyear')) is-invalid @endif @if($errors->any() && !$errors->has('cardyear')) is-valid @endif" value="{!! old('cardyear') !!}">
                                    </div>
                                    @if($errors->has('cardmonth'))
                                        <span class="text-danger fs-6"> {{ $errors->first('cardmonth') }} </span>
                                    @endif
                                    @if($errors->has('cardyear'))
                                        <span class="text-danger fs-6"> {{ $errors->first('cardyear') }} </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="inputCardccv" class="form-label"> {{ __("CCV")}}</label>
                                    <input type="number" id="inputCardccv" class="form-control @if ($errors->has('ccv')) is-invalid @endif @if($errors->any() && !$errors->has('ccv')) is-valid @endif" name="ccv" value="{!! old('ccv') !!}">

                                    @if($errors->has('ccv'))
                                        <span class="text-danger fs-6"> {{ $errors->first('ccv') }} </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                        	<div class="d-grid gap-2 col-6 mx-auto">
    						  	<a class="btn btn-outline-secondary" href="{{ route('master.plan.index') }}"> Cancel </a>
    						</div>
    						<div class="d-grid gap-2 col-6 mx-auto">
    						  	<button class="btn btn-primary" type="submit"> Purchase </button>
    						</div>	
                        </div>
    	            </div>
    	        </div>
    	    </div>
        </form>

	</section>

</x-template>