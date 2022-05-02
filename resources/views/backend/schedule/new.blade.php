<x-template>
	@section('style_content')
    	<style type="text/css">
    		#Teachersegment .select2-container--bootstrap5 .select2-selection--single {
			    height: 70px !important;
			}
    	</style>
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Schedule")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Add New Schedule")}}</li>
	        </ol>
	    </nav>
	</div>
	@if($scheduletypes->isEmpty())

		    <!-- End Page Title -->
    <section class="section" id="emptyState">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body pt-4 d-flex flex-column align-items-center">
                        <div class="container ">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-6  text-center">
                                    <img src="{{ asset('assets/img/empty.svg') }}" class="img-fluid text-center">
                                </div>
                            </div>
                        </div>
                        <h2> {{ __("No Scheduletype Found") }} </h2>
                        <p> {{ __("There have been no scheduletype in this section yet.") }} </p>

                        <div class="d-grid gap-2 col-6 mx-auto my-5">
                            <a href="{{ route('master.scheduletype.index') }}" class="btn btn-primary createBtn"> <i class="bi bi-plus-lg"></i> {{ __("Add New")}} </a>
                        </div>

                        
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
		                    	{{ __("Add New Schedule") }}
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

		                	@if ($errors->any())
			                    <div class="alert alert-danger">
			                        <ul>
			                            @foreach ($errors->all() as $error)
			                                <li>{{ $error }}</li>
			                            @endforeach
			                        </ul>
			                    </div>
			                @endif

		                	<form class="new-added-form" action="{{ route('master.schedule.store') }}" method="POST">
			                    @csrf

                				<input type="hidden" name="txtcolor" id="inputTxtcolorpicker">
                				<input type="hidden" name="bgcolor" id="inputBgcolorpicker">
                				<input type="hidden" name="batch" id="inputBatchid">



			                    <div class="row">
			                    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 form-group mb-3">
			                    		<label class="mb-2" for="inputTitle">{{ __("Title") }}</label>
				                        <input type="text" name="title" class="form-control" id="inputTitle">
				                        <small class="fst-italic text-secondary"> {{ __("If that schedule has no title to descripe, just skip it.") }} </small>
			                    	</div>
			                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputScheduletype">{{ __("Scheduletype") }} * </label>
			                            <select class="select2" name="scheduletype" id="inputScheduletype">
			                                <option> </option>

			                                @foreach($scheduletypes as $scheduletype)
			                                    <option value="{{ $scheduletype->id }}" @if($scheduletype->id == old('scheduletype')) selected @endif > {{ $scheduletype->name }} </option>
			                                @endforeach
			                            </select>

			                            <p class="text-danger">
                                            {{ $errors->first('scheduletype') }}
                                        </p>
			                        </div>

			                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12  form-group mb-3">
			                        	<label class="mb-2" for="inputDay">{{ __("Select Day") }} * </label>
			                        	<select class="select2" name="day" id="inputDay">
			                                <option> </option>
			                                <option value="Monday"> Monday </option>
			                                <option value="Tuesday"> Tuesday </option>
			                                <option value="Wednesday"> Wednesday </option>
			                                <option value="Thursday"> Thursday </option>
			                                <option value="Saturday"> Saturday </option>
			                                <option value="Sunday"> Sunday </option>


			                            </select>
			                        </div>
			                        
			                    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputPeriod">{{ __("Choose Period") }} * </label>
			                            <select class="select2" name="period" id="inputPeriod">
		                                    <option></option>
		                                    @foreach($periods as $period)
		                                        <option value="{{ $period->id }}">
		                                            {{ $period->name }} 
		                                        </option>
		                                    @endforeach
		                                </select>

			                    	</div>

			                    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputSection">{{ __("Choose Section") }} * </label>
			                            <select class="select2" name="section" id="inputSection" disabled="">
                           				</select>

			                    	</div>

			                    	<div class=" col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputBatch">{{ __("Choose Batch") }} * </label>
			                            <select class="select2" name="batch" id="inputBatch" disabled="">
                           				</select>

			                    	</div>
			                    	
			                    </div>

			                    <div class="row">
			                    	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12  form-group mb-3">
			                        	<label class="mb-2" for="inputColor">{{ __("Choose Text Color") }} * </label>
			                        	<div class='txt-color-picker'></div>
			                        </div>

			                        <div class="col-xl-3  col-lg-3 col-md-3 col-sm-12 col-12  form-group mb-3">
			                        	<label class="mb-2" for="inputColor">{{ __("Choose Background Color") }} * </label>
			                        	<div class='bg-color-picker'></div>
			                        </div>

			                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

				                        <div class="col-12 mb-3 time" id="timepicker">
				                        	<div class="row">
					                            <div class="col-6 form-group">
					                                <label for="inputStarttime"> {{ __("Start Time") }} *</label>
					                                <input type="hidden" name="starttime" id="inputStarttime">

					                                <span class="err_starttime error d-block text-danger"></span>

					                            </div>

					                            <div class="col-6 form-group">
					                                <label for="inputEndtime"> {{ __("End Time") }} *</label>
					                                <input type="hidden" name="endtime" id="inputEndtime">

					                                <span class="err_enddtime error d-block text-danger"></span>

					                            </div>
					                        </div>
				                        </div>

			                    	</div>
			                    </div>
			                    

			                    <div class="row">
			                    	<div class="col-6" id="MainassignteacherPart">
			                    		
			                    	</div>
			                    	<div class="col-6" id="ExtraassignteacherPart">
			                    		
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
    	var starttime=''; var endtime='';
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

            const txtpickr = Pickr.create({
			    el: '.txt-color-picker',
				useAsButton: false,
			    showAlways: true,
			    inline: true,
			    outputPrecision: 0,
			    position: 'bottom-middle',
			    default: '#0A6C96',
			    comparison: false,
			    components: {
			        hue: true,
			        interaction: {
			            hex: true,
			            input: true,
			        }
			    }
			});

			txtpickr.on('change', (color, source, instance) => {
			   	const hex = color.toHEXA();
			    const hexcolor = '#' + hex[0] + hex[1] + hex[2];

			    $('#inputTxtcolorpicker').val(hexcolor);

			});

			const bgpickr = Pickr.create({
			    el: '.bg-color-picker',
				useAsButton: false,
			    showAlways: true,
			    inline: true,
			    outputPrecision: 0,
			    position: 'bottom-middle',
			    default: '#0A6C96',
			    comparison: false,
			    components: {
			        hue: true,
			        interaction: {
			            hex: true,
			            input: true,
			        }
			    }
			});

			bgpickr.on('change', (color, source, instance) => {
			   	const hex = color.toHEXA();
			    const hexcolor = '#' + hex[0] + hex[1] + hex[2];

			    $('#inputBgcolorpicker').val(hexcolor);

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


		                sectionhtml +=`<option value="${v.id}">${grade}</option>`;
		            });

		            $('#inputSection').html(sectionhtml);

		        });

		        
		    }

            $('#inputSection').change(function (e) {
		        var section_id = $(this).val();
		        pickDaterange(section_id);
		        pickBatch(section_id);
		    });

		    function pickDaterange(section_id){
		        $('#inputStartdate').prop('disabled',false);
		        $('#inputEnddate').prop('disabled',false);

		    	$.ajax({
		            url: "/getSection",
		            type:'POST',
		            data: { id:section_id }
		        }).done(function(data){
		            var section = data;
	            	var startdate = section.startdate;
	            	var enddate = section.enddate;
	            	var starttime = section.starttime;
	            	var endtime = section.endtime;


	            	starttime = starttime;
	            	endtime = endtime;

	            	
		            timePicker(starttime, endtime);

		        });
		    }

		    function timePicker(starttime, endtime){
		    	const formatYmd = date => date.toISOString().slice(0, 10);
		    	var today = formatYmd(new Date()); 

		    	const stime = starttime.split(':');
		    	const etime = endtime.split(':');
		    	console.log(stime);
		    	console.log(etime);


		    	var enableHours = [];

		    	for (let i = stime[0]; i <= etime[0]; i++) { 
					enableHours.push(i);
				}

		    	console.log(enableHours);
	            $("#inputStarttime").datetimepicker({
	                format: "LT",
	                inline: true,
	                useCurrent : false,
	                defaultDate: today+' '+starttime,
	                // disabledTimeIntervals: [[moment({ h: 0 }), moment({ h: 12 })]],
	                enabledHours: enableHours,
	                icons: {
	                    up: "bi bi-chevron-up",
	                    down: "bi bi-chevron-down"
	                },
	                disabledDates: [
	                     moment("12/25/2013"),
	                     new Date(2013, 11 - 1, 21),
	                     "11/22/2013 00:53"
	                 ]
	            });

	            $("#inputEndtime").datetimepicker({
	                format: "LT",
	                inline: true,
	                useCurrent : false,
	                defaultDate: today+' '+starttime,
	                // disabledTimeIntervals: [[moment({ h: 0 }), moment({ h: 12 })]],
	                enabledHours: enableHours,
	                icons: {
	                    up: "bi bi-chevron-up",
	                    down: "bi bi-chevron-down"
	                }
	            });
	        }

		    function setCodeno(obj) {
			    var data = $(obj.element).data();
		        var text = $(obj.element).text();
		        var text_arr = text.split("|");

		        var name = text_arr[0];
		        var codeno = text_arr[1];

		        if(name){

			    	template = $("<div>"+ 
	                        "<span>" + name + "</span> <span class='badge bg-warning text-dark float-end'>"+ codeno +" </span> </p></div>");
			    }else{
			    	template = placeholder_title;
			    }
	            return template;
			};

		    function pickBatch(section_id){
		        $('#inputBatch').prop('disabled',false);
		        $('#inputBatch').removeClass('select2');
		        $('#inputBatch').addClass('batch_select2');


		        $.ajax({
		            url: "/getBatches_bysectionid",
		            type:'POST',
		            data: { sectionid:section_id }
		        }).done(function(data){
		            var batches = data;
		            var sectionhtml ='<option></option>';

		            $.each(batches,function (i,v) {

		            	var id = v.id;
                    	var codeno = v.codeno;
                    	var name = v.name;
                		var color = v.color;

		                sectionhtml +=`<option value="${v.id}">${name}|${codeno}</option>`;
		            });

		            $('#inputBatch').html(sectionhtml);
		            
		            $('.batch_select2').select2({
		            	'templateSelection': setCodeno,
			        	'templateResult': setCodeno,
		                width: '100%',
		                theme: 'bootstrap5',
		                placeholder: placeholder_title
		            });

		        });

		    }

		    $('#inputBatch').change(function (e) {
		        var batch_id = $(this).val();
		        $('#inputBatchid').val(batch_id);
		        pickTeachsegment(batch_id);
		    });

		    

		    function pickTeachsegment(batch_id){


		        $.ajax({
		            url: "/getTeachersegments_bybatchid",
		            type:'POST',
		            data: { batch_id:batch_id}
		        }).done(function(data){
		            var teachersegments = data;
		            var curriculumthtml ='';
		            var teachersegmenthtml ='';


		            var main_curriculumtype_html = `<ul class="list-group" id="main_curriculumtype_div">
	                                                <li class="list-group-item list-group-item-success fw-bold" aria-current="true" > 
	                                                	${maincurriculum_text}
	                                                </li> 
	                                                </ul>`;

	                var extra_curriculumtype_html = `<ul class="list-group" id="extra_curriculumtype_div">
	                                                <li class="list-group-item list-group-item-success fw-bold" aria-current="true" > 
	                                                	${extracurriculum_text}
	                                                </li> 
	                                                </ul>`;

		            $.each(teachersegments,function (i,v) {

		            	var id = v.id;
                    	var type = v.type;
                    	var subject_name = v.subject.name;
                		var subject_otherlanguage = v.subject.otherlanguage;

                		var teachersegmentid = v.teachersegment.id;

                		var teacher_profile = v.teachersegment.staff.user.profile_photo_path;
                		var teacher_name = v.teachersegment.staff.user.name;
                		var profile_url = '{{ URL::asset('') }}';

                		if(type == 'Main'){
	                		$('#MainassignteacherPart').html(main_curriculumtype_html);
                		}else{
	                		$('#ExtraassignteacherPart').html(extra_curriculumtype_html);
                		}

            			curriculumthtml += `<li class="list-group-item "> 
                                	<div class="d-flex flex-wrap align-items-center">
                                		<input class="form-check-input me-1" type="radio" value="${id}" name="teacher" id="teacher${teachersegmentid}">

                                		<label class="d-flex flex-wrap align-items-center" for="teacher${teachersegmentid}">
                                			<div class="avatar me-3">
                                				<img src="${profile_url+teacher_profile}" class="rounded-circle"> 
                                			</div>
                                			<div class="d-flex flex-column">
                                				<span> ${teacher_name} </span>
                                				<span class="text-muted "> 
                                					${subject_name}
								    				<small class="ps-3">( ${subject_otherlanguage} )</small>
								    			</span>
                                			</div>
                                		</label>
                                		
									</div>		
								    
                                </li>`;

                        console.log(curriculumthtml);
                		if(type == 'Main'){
		            		$('#main_curriculumtype_div').append(curriculumthtml);
                		}else{
		            		$('#extra_curriculumtype_div').append(curriculumthtml);
                		}

		            	

                		

		                
		            });

		            
		            

		        });
		    }

        });
    </script>


@stop
</x-template>