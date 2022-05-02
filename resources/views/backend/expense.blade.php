<x-template>
	@php
        $authuser = Auth::user();
    @endphp
	@section('style_content')
    	<style>
    		.select2-results__option[aria-disabled] {
			   background: #ccc;
			   color: #f44336;
			}
    	</style>
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Expense")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Expense")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
		    <div class="row">
		        <div class="col-lg-12">
		        	<div class="card">
		            	<div class="card-header row align-items-center">
		            		<div class="col-12">
		                    	{{ __("Expense") }}
		            		</div>
		            	</div>
		                <div class="card-body pt-3">
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
						    
		                	@if (count($errors) > 0)
			                    <div class="alert alert-danger">
			                        <ul>
			                            @foreach ($errors->all() as $error)
			                              <li>{{ $error }}</li>
			                            @endforeach
			                        </ul>
			                    </div>
			                @endif

		                	<form class="new-added-form" action="{{ route('master.expense.store') }}" method="POST" enctype="multipart/form-data">
			                    @csrf

			                    <div class="row mb-3">

			                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
			                    		<div class="col-12  form-group mb-3">
				                            <label class="mb-2" for="inputTitle">{{ __("Title") }} * </label>
				                            <input class="form-control " name="title" id="inputTitle" >
				                    	</div>
				                    	<div class="col-12  form-group mb-3">
				                            <label class="mb-2" for="inputPaymentdate">{{ __("Payment Date") }} * </label>
				                            <input class="form-control date" name="date" id="inputPaymentdate" >

				                    	</div>

			                    		<div class="col-12  form-group mb-3">
				                            <label class="mb-2" for="inputExpensetype">{{ __("Choose Expense Type") }} * </label>
				                            <select class="select2" name="expensetype" id="inputExpensetype">
			                                    <option></option>
			                                    @foreach($expensetypes as $expensetype)
			                                        <option value="{{ $expensetype->id }}">
			                                            {{ $expensetype->name }} 
			                                        </option>
			                                    @endforeach
			                                </select>
				                    	</div>

				                    	<div class="col-12 form-group mb-3">
		                                    <label for="inputAmount" class="form-label">{{ __("Amount") }}</label>
		                                    <input type="number" name="amount" id="inputAmount" class="form-control @if ($errors->has('amount')) is-invalid @endif @if($errors->any() && !$errors->has('amount')) is-valid @endif" value="{{ old('amount') }}">

		                                    <p class="text-danger">
		                                        {{ $errors->first('amount') }}
		                                    </p>
		                                </div>

			                    	</div>

			                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3 imgUp">
			                            <label for="inputCover" class="d-block mb-3"> Payment Screen Shot *</label>
	                                    <div class="imagePreview"></div>
	                                    <label class="btn btn-primary d-block">
	                                    Upload
	                                    <input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" name="photo">
	                                    </label>

	                                    <small class="d-block"> Please upload file like cv (*.jpg, .jpeg, .png) </small>

	                                    @if($errors->has('photo'))
		                                    <span class="text-danger fs-6"> {{ $errors->first('photo') }} </span>
		                                @elseif($errors->any() && !$errors->has('photo')) 
		                                    <span class="text-danger fs-6"> <strong> {{ __("Upload Error!") }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
		                                @endif
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
        $(document).ready(function() {
        	const date = document.querySelector('.date');
            new Datepicker(date, {
                autohide: true,
                'format': 'yyyy/mm/dd',
                // minDate: new Date(),
            });

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

		    $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                console.log(uploadFile);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
         
                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file
         
                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }
              
            });

        });
    </script>

@stop
</x-template>