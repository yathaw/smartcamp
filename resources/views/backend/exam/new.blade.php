<x-template>

	<div class="pagetitle">
	    <h1> {{ __("Exam")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Add New Exam")}}</li>
	        </ol>
	    </nav>
	</div>
	@if($batches->isEmpty() || $periods->isEmpty())

		<!-- End Page Title -->
		<section class="section" id="emptyState">
		    <div class="row">
		        <div class="col-lg-12">
		            <div class="card">
		                <div class="card-body pt-4 d-flex flex-column align-items-center">
		                	<div class="container ">
			                	<div class="row align-items-center justify-content-center">
			                		<div class="col-6  text-center">

			                    		<img src="{{ asset('assets/img/empty_batch.svg') }}" class="img-fluid text-center">
			                		</div>
			                	</div>
			                </div>
			                @if($periods->isEmpty() && $batches->isEmpty())
			                    <h2> {{ __("No Academic Year Data Found") }} </h2>
			                    <p> {{ __("There have been no academic year in this section yet. Please add some period first.") }} </p>

			                    <div class="d-grid gap-2 col-6 mx-auto my-5">
								  	<a href="{{ route('master.period.index') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Academic Year")}} </a>
								</div>
							@else
				                @if($periods->isEmpty())
				                    <h2> {{ __("No Academic Year Data Found") }} </h2>
				                    <p> {{ __("There have been no academic year in this section yet. Please add some period first.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.period.index') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Academic Year")}} </a>
									</div>
								@endif

				                @if($batches->isEmpty())
				                	<h2> {{ __("No Batch Found") }} </h2>
				                    <p> {{ __("There have been no batches in this section yet.") }} </p>

				                    <div class="d-grid gap-2 col-6 mx-auto my-5">
									  	<a href="{{ route('master.section.index') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Batch")}} </a>
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
		                    	{{ __("Add New Exam") }}
		            		</div>
		            	</div>
		                <div class="card-body pt-3">
		                	<form class="new-added-form" action="{{ route('master.exam.store') }}" method="POST">
			                    @csrf
			                    <div class="row mb-3">
			                    	<div class="col-12">
								        <label for="inputTitle" class="form-label">{{ __("Title")}}</label>
								        <input type="text" class="form-control" id="inputTitle" name="title">
								    </div>
			                    </div>

			                    <div class="row mb-3">
			                    	<div class="col-12 form-group ruleDiv mb-3">
			                            <label for="inputRule"> 
			                            	{{ __("Rule *") }}
			                            	
			                            </label>
			                            <button class="btn btn-sm btn-dark float-end addruleBtn" type="button">
									  		{{ __("+ Add Rule") }}
									  	</button>
									  	
			                            <input type="text" placeholder="{{ __('Rule No 1')}}" class="form-control mt-3" id="inputRule" name="rules[]">


			                        </div>

			                        <div class="col-12 " id="moreruleDiv"></div>
			                    </div>

			                    <div class="row mb-3">
			                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputPeriod">{{ __("Choose Period") }} * </label>
			                            <select class="select2" name="period" id="inputPeriod">
		                                    <option></option>
		                                    @foreach($periods as $period)
		                                        <option value="{{ $period->id }}" @if(isset($periodid)) selected @endif>
		                                            {{ $period->name }} 
		                                        </option>
		                                    @endforeach
		                                </select>

			                    	</div>

			                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputSection">{{ __("Choose Grade") }} * </label>
			                            <select class="select2" name="section" id="inputSection" disabled="">
	                       				</select>

			                    	</div>
			                    </div>

			                    <div class="row mb-3">
			                    	<div class="col-12" id="curriculumDiv">
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


	@endif

@section('script_content')
	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";
    </script>
    
    <script type="text/javascript">
        $(document).ready(function() {
        	var selected_periodid = "{{ $periodid ?? '' }}";
        	var selected_sectionid = "{{ $sectionid  ?? '' }}";
        	var selected_batchid = "{{ $batchid  ?? '' }}";

        	if(selected_periodid){
        		pickSection(selected_periodid);
        		pickBatch(selected_sectionid);
        	}
            $("#curriculumDiv").on('focus','.examdate',function(e){

	        	const items = document.querySelectorAll(".examdate");
	        	for(let i=0; i<items.length; i++){
				  	const node = items[i];
				  
					new Datepicker(node, {
		                autohide: true,
		                'format': 'yyyy/mm/dd',
		                minDate: new Date(),

		            });
				}
			});
            $("#curriculumDiv").on('focus','.starttime',function(e){

	            $(".starttime").datetimepicker({
	                format: "LT",
	                icons: {
	                    up: "bi bi-chevron-up",
	                    down: "bi bi-chevron-down"
	                }
	            });
	        })
            $("#curriculumDiv").on('focus','.endtime',function(e){
	            $(".endtime").datetimepicker({
	                format: "LT",
	                icons: {
	                    up: "bi bi-chevron-up",
	                    down: "bi bi-chevron-down"
	                }
	            });
	        });

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
            	var date_inputlabel = "Choose Date";
            	var starttime_inputlabel = "Start Time";
            	var endtime_inpitlabel = "End Time";

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

            $('#inputPeriod').change(function (e) {
		        var period_id = $(this).val();

		        pickSection(period_id);
		    });

		    function pickSection(period_id){
		        $('#inputSection').prop('disabled',false);

		        $.ajax({
		            url: "/getSection_byperiodid",
		            type:'POST',
		            data: { id:period_id }
		        }).done(function(data){
		            var sections = data;
		            var sectionhtml ='<option></option>';

		            $.each(sections,function (i,v) {
		            	var grade = v.grade.name;
		            	var codeno = v.codeno;
		            	var startdate = v.startdate;
		            	var enddate = v.enddate;
		            	var starttime = v.starttime;
		            	var endtime = v.endtime;


		                sectionhtml +=`<option value="${v.id}"`;
		                if(selected_sectionid){
		                	sectionhtml += `selected`;
		                }
		                sectionhtml += `>${grade}</option>`;
		            });

		            $('#inputSection').html(sectionhtml);

		        });

		        
		    }

            $('#inputSection').change(function (e) {
		        var section_id = $(this).val();
		        showCurricula(section_id);
			    $('#curriculumDiv').html("");


		    });


		    function showCurricula(section_id){
		    	$.ajax({
		            url: "/getCurricula_bysectionid",
		            type:'POST',
		            data: { sectionid:section_id }
		        }).done(function(data){
		            var grade = data[0];
		            var curricula = data[1];
		            var subjecttypes = data[2];


		            console.log(grade);
		            console.log(grade.subjecttypes);
		            console.log(curricula.length);


		            if(curricula.length > 0){
		            	var grade = grade.name;
			            var curriculahtml =`<ul class="list-group"> `;

			            if(subjecttypes.length > 0){
				            $.each(subjecttypes,function (st_i,st_v) {
				            	var subjecttype_name = st_v.name;
				            	var subjecttype_otherlanguage = st_v.otherlanguage;
				            	var subjecttype_id = st_v.id;
				            	curriculahtml += `<li class="list-group-item list-group-item-primary fw-bold" aria-current="true"> 
									    			${grade}
									    			<i class="bi bi-dot mx-2"></i>
									    			${subjecttype_name} <small> ( ${subjecttype_otherlanguage} ) </small>
									    		</li>`;

								$.each(curricula,function (i,v) {
									var curricula_id = v.id;
					            	var subject = v.subject.name;
					            	var subject_otherlanguage = v.subject.otherlanguage;
					            	var curricula_subjecttype_id = v.subjecttype.id;

					            	if(subjecttype_id == curricula_subjecttype_id){
						            	curriculahtml +=`<li class="list-group-item list-group-item d-flex justify-content-between align-items-center"> 
						            			<input type="hidden" name="cid[]" value="${curricula_id}">
										    	<small class="w-25"> ${subject} ( ${subject_otherlanguage} ) </small>
										    	<div class="row form-group mb-3">
										    		<div class="col-12">
										                <small> ${date_inputlabel} *</small>

										        		<input type="text" class="form-control examdate" name="examdate[]" id="inputStartdate1" >
										        	</div>
										    	</div>
										    	<div class="row form-group mb-3 time" id="timepicker">
										            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
										                <small> ${starttime_inputlabel} *</small>
										                <input type="text" placeholder="HH:MM AM/PM" class="form-control starttime" id="inputStarttime${i}" name="starttime[]">

										                <span class="err_starttime error d-block text-danger"></span>

										            </div>

										            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
										                <small> ${endtime_inpitlabel} *</small>
										                <input type="text" placeholder="HH:MM AM/PM" class="form-control endtime" id="inputEndtime${i}" name="endtime[]">

										                <span class="err_enddtime error d-block text-danger"></span>

										            </div>
										        </div>
										    </li>
						            	`;
					            	}

					            });

				            });
			            }else{
			            	curriculahtml += `<li class="list-group-item list-group-item-primary fw-bold" aria-current="true"> 
									    			${grade}
									    		</li>`;
				            $.each(curricula,function (i,v) {
								var curricula_id = v.id;
				            	var subject = v.subject.name;
				            	var subject_otherlanguage = v.subject.otherlanguage;

				            	curriculahtml +=`<li class="list-group-item list-group-item d-flex justify-content-between align-items-center"> 
				            			<input type="hidden" name="cid[]" value="${curricula_id}">
								    	<small class="w-25"> ${subject} ( ${subject_otherlanguage} ) </small>
								    	<div class="row form-group mb-3">
								    		<div class="col-12">
								                <small> ${date_inputlabel} *</small>

								        		<input type="text" class="form-control examdate" name="examdate[]" id="inputStartdate1" >
								        	</div>
								    	</div>
								    	<div class="row form-group mb-3 time" id="timepicker">
								            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
								                <small> ${starttime_inputlabel} *</small>
								                <input type="text" placeholder="HH:MM AM/PM" class="form-control starttime" id="inputStarttime${i}" name="starttime[]">

								                <span class="err_starttime error d-block text-danger"></span>

								            </div>

								            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
								                <small> ${endtime_inpitlabel} *</small>
								                <input type="text" placeholder="HH:MM AM/PM" class="form-control endtime" id="inputEndtime${i}" name="endtime[]">

								                <span class="err_enddtime error d-block text-danger"></span>

								            </div>
								        </div>
								    </li>
				            	`;

				            });
				        }

			            curriculahtml +=`</ul>`;
			          	$('#curriculumDiv').html(curriculahtml);
		          	}


		        });
		    }

		    var max_fields = 10; 
            var x = 1;
            $(".addruleBtn").click(function(e) {
                if(x < max_fields){ 
                    var html = `<div class="col-12 form-group input-group mb-3">
                                    <input type="text" class="form-control" placeholder="More Rules" name="rules[]">
                                    <button class="btn btn-danger" type="button" id="removeruleDiv">
                                        <i class="bi bi-x-lg position-static text-white px-2"></i>

                                    </button>
                                </div>`;

                    $("#moreruleDiv").append(html);

                }
            });
            $("#moreruleDiv").on("click","#removeruleDiv", function(e){ 
                e.preventDefault();
                $(this).parent('.input-group').remove();
                x--;

            });


        });
    </script>

    
@stop
</x-template>