<x-template>

	<div class="pagetitle">
	    <h1> {{ __("Curriculum")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Add New Curriculum")}}</li>
	        </ol>
	    </nav>
	</div>
	@if($subjecttypes->isEmpty() || $subjects->isEmpty())

		<!-- End Page Title -->
		<section class="section" id="emptyState">
		    <div class="row">
		        <div class="col-lg-12">
		            <div class="card">
		                <div class="card-body pt-4 d-flex flex-column align-items-center">
		                	<div class="container ">
			                	<div class="row align-items-center justify-content-center">
			                		<div class="col-6  text-center">

			                    		<img src="{{ asset('assets/img/empty_subject.svg') }}" class="img-fluid text-center">
			                		</div>
			                	</div>
			                </div>
			                @if($subjecttypes->isEmpty() && $subjects->isEmpty())
				                    <h2> {{ __("No Subject-type Data Found") }} </h2>
				                    <p> {{ __("There have been no subject-types in this section yet. Please add some subject-type first.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.subjecttype.index') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Subject Type")}} </a>
									</div>
							@else
				                @if($subjecttypes->isEmpty())
				                    <h2> {{ __("No Subject-type Data Found") }} </h2>
				                    <p> {{ __("There have been no subject-types in this section yet. Please add some subject-type first.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.subjecttype.index') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Subject Type")}} </a>
									</div>
								@endif

				                @if($subjects->isEmpty())
				                	<h2> {{ __("No Subject Found") }} </h2>
				                    <p> {{ __("There have been no subjects in this section yet.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.subject.index') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Subject")}} </a>
									</div>

				                @endif
				            @endif
		                    
		                </div>
		            </div>
		        </div>
		    </div>
		</section>

	@else

		<section class="section">
		    <div class="row">
		        <div class="col-lg-12">
		        	<div class="card">
		            	<div class="card-header row align-items-center">
		            		<div class="col-12">
		                    	{{ __("Add New Curriculum") }}
		            		</div>
		            	</div>
		                <div class="card-body pt-3">
		                	<form class="new-added-form" action="{{ route('master.curriculum.store') }}" method="POST">
			                    @csrf
			                    <div class="row">
			                        <div class="col-xl-8 col-lg-8 col-md-6 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputGrade">{{ __("Grades") }} * </label>
			                            <select class="select2 @if ($errors->has('grade')) is-invalid @endif @if($errors->any() && !$errors->has('grade')) is-valid @endif" name="grade" id="inputGrade">
			                                <option> </option>

			                                @foreach($grades as $grade)
			                                    <option value="{{ $grade->id }}" @if($grade->id == old('grade')) selected @endif > {{ $grade->name }} </option>
			                                @endforeach
			                            </select>

			                            <p class="text-danger">
                                            {{ $errors->first('grade') }}
                                        </p>
			                        </div>

			                        <div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-3">
			                        	<label></label>
				                        <div class="d-grid gap-2">
				                            <button class="btn btn-dark addsubjectBtn" type="button"> 
				                                <i class="bi bi-plus-lg"></i> {{ __("Add Another Subject") }} 
				                            </button>
				                        </div>
				                    </div>

			                        <hr>
			                    </div>

			                        <div class="row " id="originalsubjectDiv">
			                            <div class="col-xl-4 col-lg-6 col-12 form-group ">
			                                <label class="mb-2" for="inputSubject">{{ __("Subject") }} *</label>
			                                <select class="select2 @if ($errors->has('subjects')) is-invalid @endif @if($errors->any() && !$errors->has('subjects')) is-valid @endif" name="subjects[]" id="inputSubject">
			                                    <option> </option>

			                                    @foreach($subjects as $subject)
			                                        <option value="{{ $subject->id }}" {{in_array($subject->id, old("subjects") ?: []) ? "selected": ""}}>
			                                            {{ $subject->name }} 
			                                            <small> ({{ $subject->otherlanguage }}) </small>
			                                        </option>
			                                    @endforeach

			                                </select>
			                                <p class="text-danger">
	                                            {{ $errors->first('subjects') }}
	                                        </p>
			                            </div>
			                            <div class="col-xl-4 col-lg-6 col-12 form-group">
			                                <label class="mb-2" for="inputSubjecttype">{{ __("Subject Type") }} </label>
			                                <select class="select2" name="subjecttypes[]" id="inputSubjecttype">
			                                    <option> </option>
			                                    @foreach($subjecttypes as $subjecttype)
			                                        <option value="{{ $subjecttype->id }}"> 
			                                            {{ $subjecttype->name }}
			                                            <small> ({{ $subjecttype->otherlanguage }}) </small>
			                                        </option>
			                                    @endforeach
			                                </select>
			                                <small class="fst-italic text-secondary"> {{ __("If that curriculum has no subject type, just skip it.") }} </small>
			                            </div>
			                            <div class="col-xl-4 col-lg-6 col-12 form-group">
			                                <label class="mb-2"> {{ __("Major / Minor") }} *</label>
			                                <div class="switch-field">
			                                    <input type="radio" id="radio-one" name="types[0]" value="Main" />
			                                    <label for="radio-one"> {{ __("Main Curriculum") }} </label>
			                                    <input type="radio" id="radio-two" name="types[0]" value="Extra" />
			                                    <label for="radio-two"> {{ __("Extra Curriculum") }} </label>
			                                </div>

			                                <p class="text-danger">
	                                            {{ $errors->first('types') }}
	                                        </p>
			                            </div>

			                            <hr class="my-3">
			                        </div>
			                        <div class=" mb-3" id="clonesubjectDiv"></div>
			                        
			                        <div class="col-md-6 form-group"></div>
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


	@endif

@section('script_content')
	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {

        	if (currentLanguage == "mm") {
            	var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";
            	var subject_title = "ဘာသာရပ်";
            	var subjecttype_title ="ဘာသာရပ်အမျိုးအစား";
            	var subjecttype_note = "ဒီသင်ရိုးမှာ ဘာသာရပ်အမျိုးအစားမရှိရင် အဲဒါကို ကျော်လိုက်ပါ။";
            	var majorminor_title ="အဓိကဘာသာရပ်/ သာမန်ဘာသာရပ်";
            	var maincurriculum_text = "ပင်မဘာသာရပ်များ";
            	var extracurriculum_text = "ထပ်ဆောင်းဘာသာရပ်များ";
            	var remove_btn_text = "ဖယ်ရှားပါ။";
            }
            else if(currentLanguage == "jp"){
            	var placeholder_title = "少なくとも1つのオプションを選択してください";
            	var subject_title = "主題";
            	var subjecttype_title = "件名タイプ";
            	var subjecttype_note = "そのカリキュラムに科目タイプがない場合は、スキップしてください。";
            	var majorminor_title ="メジャー、マイナー";
            	var maincurriculum_text = "主なカリキュラム";
            	var extracurriculum_text = "課外活動";
            	var remove_btn_text = "削除";
            }
            else if(currentLanguage == "cn"){
            	var placeholder_title =  "请至少选择一个选项";
            	var subject_title = "主题";
            	var subjecttype_title = "主题类型";
            	var subjecttype_note =  "如果该课程没有主题类型，请跳过它。";
            	var majorminor_title ="主要次要";
            	var maincurriculum_text = "主要课程";
            	var extracurriculum_text = "课外活动";
            	var remove_btn_text = "消除";
            }
            else if(currentLanguage == "de"){
            	var placeholder_title = "Bitte wählen Sie mindestens eine Option aus";
            	var subject_title = "Fach";
            	var subjecttype_title = "Betrefftyp";
            	var subjecttype_note = "Wenn dieser Lehrplan keinen Fachtyp hat, überspringen Sie ihn einfach.";
            	var majorminor_title ="Dur / Moll";
            	var maincurriculum_text = "Hauptlehrplan";
            	var extracurriculum_text = "Extralehrplan";
            	var remove_btn_text = "Entfernen";
            }
            else if(currentLanguage == "fr"){
            	var placeholder_title ="Veuillez sélectionner au moins une option";
            	var subject_title = "Sujette";
            	var subjecttype_title = "Type de sujet";
            	var subjecttype_note ="Si ce programme n'a pas de type de matière, sautez-le simplement.";
            	var majorminor_title ="Majeur / Mineur";
            	var maincurriculum_text = "Programme principal";
            	var extracurriculum_text = "Programme supplémentaire";
            	var remove_btn_text = "Retirer";
            	
            }else{
            	var placeholder_title ="Please select at least one option";
            	var subject_title = "Subject";
            	var subjecttype_title = "Subject Type";
            	var subjecttype_note ="If that curriculum has no subject type, just skip it..";
            	var majorminor_title = "Major / Minor";
            	var maincurriculum_text = "Main Curriculum";
            	var extracurriculum_text = "Extra Curriculum";
            	var remove_btn_text = "Remove";
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var max_fields = 10; 
            var x = 1;
            $(".addsubjectBtn").click(function(e) {
                if(x < max_fields){ 
                
                    var html =`<section class="row remove"> <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>${subject_title} *</label>
                                    <select class="form-control select2" name="subjects[]">
                                        <option></option>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">
                                                {{ $subject->name }} 
                                                <small> ({{ $subject->otherlanguage }}) </small>
                                            </option>
                                        @endforeach

                                    </select>
                                    
                                    

                                </div>`;

                    html +=`<div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>${subjecttype_title} </label>
                                    <select class="form-control select2" name="subjecttypes[]">
                                        <option></option>
                                        @foreach($subjecttypes as $subjecttype)
                                            <option value="{{ $subjecttype->id }}"> 
                                                {{ $subjecttype->name }}
                                                <small> ({{ $subjecttype->otherlanguage }}) </small>
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="fst-italic text-secondary"> ${subjecttype_note} </small>
                                </div>`;

                    html += `<div class="col-xl-4 col-lg-4 col-8 form-group">
                                <label> ${majorminor_title} *</label>
                                <div class="switch-field">
                                    <input type="radio" id="radiox${x}" name="types[${x}]" value="Main" />
                                    <label for="radiox${x}"> ${maincurriculum_text} </label>

                                    <input type="radio" id="radioy${x}" name="types[${x}]" value="Extra" />
                                    <label for="radioy${x}"> ${extracurriculum_text} </label>
                                </div>

                            </div>`;

                    html += ` <a href="javascript:void(0)" class="btn btn-danger mt-2 d-inline-block" id="removesubjectDiv"> ${remove_btn_text} </a> <hr class="my-3"> </section>`;

                    $("#clonesubjectDiv").append(html);

                    $('.select2').select2({
                        width: '100%',
                        theme: 'bootstrap5',
                		placeholder: placeholder_title,
                    });
                x++; //input field increment

                }
            });

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

            $("#clonesubjectDiv").on("click","#removesubjectDiv", function(e){ 
                e.preventDefault();
                console.log($(this).parent());
                $(this).parent('.remove').remove();
                x--;

            });

            @if($errors->has('grade'))
              $("#inputGrade + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('grade'))
              $("#inputGrade + span").addClass("is-valid");
            @endif

            @if($errors->has('subjects'))
              $("#inputSubject + span").addClass("is-invalid");
            @endif
            @if($errors->any() && !$errors->has('subjects'))
              $("#inputSubject + span").addClass("is-valid");
            @endif

            // $('#clonesubjectDiv .select2').select2({
            //     width: '100%'
            // });

            

        });
    </script>

    <style type="text/css">

            span.is-invalid .select2-selection
            {
                border-color: #dc3545;
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

@stop
</x-template>