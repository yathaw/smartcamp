<x-template>
    @section('style_content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/pdfViewer/style.css') }}">
	<style type="text/css">


        span.is-invalid .select2-selection
        {
            border-color: #dc3545 !important;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        span.is-valid .select2-selection
        {
            border-color: #198754 !important;
            padding-right: calc(1.5em + 0.75rem) !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right calc(0.375em + 0.1875rem) center !important;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;

        }
        
    </style>
    @endsection


	<div class="pagetitle">
	    <h1> {{ __("Syllabus")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Edit Existing Syllabus")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	        	<div class="card">
	            	<div class="card-header row align-items-center">
	            		<div class="col-12">
	                    	{{ __("Add New Syllabus") }}
	            		</div>
	            	</div>
	                <form class="new-added-form" action="{{route('master.syllabus.update',$syllabus->id)}}" enctype="multipart/form-data" method="POST">
		            @csrf
                    @method('PUT')

                        <input type="hidden" name="oldphoto" value="{{ $syllabus->photo }}">
                        <input type="hidden" name="oldfile" value="{{ $syllabus->file }}">

	                	<div class="card-body pt-3">
		                    <div class="row">
		                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
		                    		<div class="form-group mb-lg-5 mb-3" id="gradeDiv">
			                            <label for="inputGrade"> {{ __("Grade") }} *</label>
			                            <select class="select2 inputGrades @if ($errors->has('grade')) is-invalid @endif @if($errors->any() && !$errors->has('grade')) is-valid @endif" name="grade" id="inputGrade">
			                                <option></option>
			                                @foreach($grades as $grade)
			                                    <option value="{{ $grade->id }}" @if($grade->id == $syllabus->curriculum->grade_id)selected @endif>
			                                        {{ $grade->name }} 
			                                    </option>
			                                @endforeach
			                            </select>
			                            <p class="text-danger">
                                            {{ $errors->first('grade') }}
                                        </p>
			                        </div>


			                        <div class="form-group mb-lg-5 mb-3" id="subjectDiv">
			                            <label for="inputSyear" for="inputSubject"> Subject *</label>
			                            <select class="select2 subjects @if ($errors->has('subject')) is-invalid @endif @if($errors->any() && !$errors->has('subject')) is-valid @endif" name="subject" id="inputSubject">
			                                <option></option>
			                            </select>

			                            <p class="text-danger">
                                            {{ $errors->first('subject') }}
                                        </p>
			                        </div>

                                    <div class="form-group mb-lg-5 mb-3">
                                        <label class="mb-2"> {{ __("For Student / Teacher") }} *</label>
                                        <div class="switch-field">
                                            <input type="radio" id="radio-one" name="type" value="Student" @if($syllabus->type == "Student") checked @endif />
                                            <label for="radio-one"> {{ __("For Student") }} </label>
                                            <input type="radio" id="radio-two" name="type" value="Teacher" @if($syllabus->type == "Teacher") checked @endif/>
                                            <label for="radio-two"> {{ __("For Teacher") }} </label>
                                        </div>

                                        <p class="text-danger">
                                            {{ $errors->first('types') }}
                                        </p>
                                    </div>

			                        <div class="form-group mb-lg-5 mb-3">
			                            <label for="inputPDF" class="d-block"> {{ __("PDF") }} *</label>

                                        <ul class="nav nav-tabs mb-3 nav-justified" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="oldfile-tab" data-bs-toggle="tab" data-bs-target="#oldfile" type="button" role="tab" aria-controls="oldfile" aria-selected="true">{{ __("Old Preview File") }}</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="newfile-tab" data-bs-toggle="tab" data-bs-target="#newfile" type="button" role="tab" aria-controls="newfile" aria-selected="false">{{ __("New Upload File") }}</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="oldfile" role="tabpanel" aria-labelledby="oldfile-tab">
                                                <div id="pdf-main-container">
                                                    <div id="pdf-contents">
                                                        <div id="pdf-meta">
                                                            <div id="pdf-buttons">
                                                                <button id="pdf-prev" class="btn btn-sm btn-outline-dark">Previous</button>
                                                                <button id="pdf-next" class="btn btn-sm btn-outline-dark">Next</button>
                                                            </div>
                                                            <div id="page-count-container" class="">Page <div id="pdf-current-page"></div> of <div id="pdf-total-pages"></div></div>
                                                        </div>
                                                        <canvas id="pdf-canvas" width="400"></canvas>
                                                        <div id="page-loader">Loading page ...</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="newfile" role="tabpanel" aria-labelledby="newfile-tab">
                                                <input type="file" name="filepdf">
                                                <small class="d-block"> {{ __("Please upload file like cv (*.PDF)") }} </small>

                                            </div>
                                        </div>

			                            
                                        

			                            @if($errors->has('filepdf'))
		                                    <span class="text-danger fs-6"> {{ $errors->first('filepdf') }} </span>
		                                @elseif($errors->any() && !$errors->has('filepdf')) 
		                                    <span class="text-danger fs-6"> <strong> {{ __("Upload Error!") }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
		                                @endif
			                        </div>

			                        

		                        </div>

		                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group mb-3 imgUp">
		                            <label for="inputCover" class="d-block mb-3"> Cover Photo *</label>
                                    <div class="imagePreview" style="background-image: url({{ asset($syllabus->photo) }});"></div>
                                    <label class="btn btn-primary d-block">
                                    Upload
                                    <input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" name="coverphoto">
                                    </label>

                                    <small class="d-block"> Please upload file like cv (*.jpg, .jpeg, .png) </small>

                                    @if($errors->has('coverphoto'))
	                                    <span class="text-danger fs-6"> {{ $errors->first('coverphoto') }} </span>
	                                @elseif($errors->any() && !$errors->has('coverphoto')) 
	                                    <span class="text-danger fs-6"> <strong> {{ __("Upload Error!") }} </strong> {{ __("File could not be uploaded for some reason.") }} </span>
	                                @endif
		                        </div>
		                    </div>
	                	</div>
	                	<div class="card-footer">
	                		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
	                            <button type="reset" class="btn btn-secondary">{{ __("Resets")}}</button>

	                			<button type="submit" class="btn btn-primary">{{ __("Save Changes")}}</button>
	                        </div>
	                	</div>

		            </form>

	            </div>
	        </div>
	    </div>
	</section>

@section('script_content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.228/pdf.min.js"></script>
	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";
        var gid = "{{ $syllabus->curriculum->grade_id }}";
        var subjectid = "{{ $syllabus->curriculum->subject_id }}";

        var url = "{{ asset($syllabus->file) }}";
    </script>
    <script src="{{ asset('assets/vendor/pdfViewer/viewer.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            subjectChange(gid);

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
            	
            }else{
            	var placeholder_title ="Please select at least one option";
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

            
            $('.inputGrades').change(function (e) {
                gid = $(this).val();
                var inputId = e.target.id;

                subjectChange(gid);
            });
            function subjectChange(gid){
                $('#inputSubject').prop('disabled',false);


                $.post("/getCurricula_bygradeid",{gradeid:gid},function (res) {
                    var data = res;
                    var html ='<option></option>';
                    var selected;
                    console.log(data);
                    $.each(data,function (i,v) {
                        if(v.subjecttype_id){
                            var subjecttype_name = v.subjecttype.name;
                            var subjecttype_other = v.subjecttype.otherlanguage; 

                            html +=`<option value="${v.subject_id}"`;

                            if(subjectid == v.subject_id){
                                html += `selected`;
                            }

                            html +=`>
                                ${v.subject.name}
                                ( ${subjecttype_name} - ${subjecttype_other} )
                            </option>`;

                        }else{
                            
                            html +=`<option value="${v.subject_id}"`; 

                            if(subjectid == v.subject_id){
                                html += `selected`;
                            }

                            html += `>${v.subject.name}</option>`;
                        }
                    });

                    $('#inputSubject').html(html);

                });
            }

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

            @if($errors->has('grade'))
              $("#inputGrade + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('grade'))
              $("#inputGrade + span").addClass("is-valid");
            @endif

            @if($errors->has('subject'))
              $("#inputSubject + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('subject'))
              $("#inputSubject + span").addClass("is-valid");
            @endif
        });
    </script>

    

@stop
</x-template>