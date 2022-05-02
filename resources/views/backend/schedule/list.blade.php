<x-template>
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
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
	

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	        	<div class="card">
	            	<div class="card-header row align-items-center">
		            	<div class="col-12">

	            			<form method="get" action="{{route('master.schedule.index')}}" class="row">
		                    	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12  form-group mb-3">
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

		                    	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12  form-group mb-3">
		                            <label class="mb-2" for="inputSection">{{ __("Choose Section") }} * </label>
		                            <select class="select2" name="section" id="inputSection" disabled="">
                       				</select>

		                    	</div>

		                    	<div class=" col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12  form-group mb-3">
		                            <label class="mb-2" for="inputBatch">{{ __("Choose Batch") }} * </label>
		                            <select class="select2" name="batch" id="inputBatch" disabled="">
                       				</select>

		                    	</div>
		                    	<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12  form-group mb-3  d-grid">
		                    		<label class="mb-3"></label>
		                    		<button type="submit" class="btn btn-outline-primary" id="searchBtn" disabled> <i class="bi bi-search"></i> Search </button>
		                    	</div>
		            		</form>
		            	</div>
	            	</div>
	            </div>

	            @if(isset($teachersegments))

	            
			            <div class="card" >
			            	<div class="card-body">

			            		<h6 class="card-title"> {{ __("Draggable To Schedule") }} </h6>

			            		<div class="row mb-4 align-items-center">
					            	<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 order-end order-xl-first order-lg-first">
					            		<span class="badge text-wrap fs-6 clone m-2 lunch_bgcolor lunch_txtcolor">
					            			{{ __("Lunch") }}
					            		</span>

					            		<span class="badge text-wrap fs-6 clone m-2 breaktime_bgcolor breaktime_txtcolor" >
					            			{{ __("Break Time") }}
					            		</span>

						            	@foreach($teachersegments as $teacher)
						            	@php 
						            		$profile = asset($teacher->teachersegment->staff->user->profile_photo_path);
						            		$bgcolor = $teacher->teachersegment->bgcolor;
						            		$txtcolor = $teacher->teachersegment->txtcolor;
						            		$teachername = $teacher->teachersegment->staff->user->name;
						            		$subject = $teacher->teachersegment->curriculum->subject->name;
						            		$subjectotherlanguage = $teacher->teachersegment->curriculum->subject->otherlanguage;
						            		$duration = $teacher->teachersegment->duration;
						            		$id = $teacher->teachersegment->id;


						            		$popoverHeader = "<div class='d-flex flex-wrap align-items-center'>
					                                			<div class='avatar me-3'>
					                                				<img src='$profile' class='rounded-circle'> 
					                                			</div>
					                                			<div> <small> ${teachername} </small> </div>
					                                		</div>";

					                        $popoverText = "<div class='d-flex flex-column'>
				                                				<span class='d-block'> 
				                                					$subject
												    			</span>
												    			<small class='d-block'>( $subjectotherlanguage )</small>

				                                				<span class='d-block'> Duration : $duration </span>

				                                			</div>";


						            	@endphp
						            		<span class="badge text-wrap fs-6 clone m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-title="{{ $popoverHeader }}" data-bs-placement="top" data-bs-content="{{ $popoverText }}" data-bs-html="true" data-id="{{ $id }}" data-type="teachersegment">
						            			{{ $subject }}
						            		</span>
						            	@endforeach
						            </div>
					            	<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 order-first order-xl-end order-lg-end">
					            		<div class="alert alert-info  alert-dismissible fade show">
							            	<h4 class="alert-heading d-inline-block">  
							            		{{ $batch->name }}  
					                      	</h4>

							            	<span class="text-muted small"> | {{ $batch->codeno }}   </span>

							            	<div class="row">
							            		<div class="col-12"> 
							            			<span class="label me-3 small text-muted"> Academic Year </span>
							            			<span class="small"> {{ $period->startyear }} -
	                                	{{ $period->endyear }}  </span>
							            		</div>

							            		<div class="col-12"> 
							            			<span class="label me-3 small text-muted"> Time </span>
							            			<span class="small"> 
							            				@php
					                                		$s = Carbon\Carbon::parse($section->starttime);
										                    $starttime = $s->format('g:i A');

										                    $e = Carbon\Carbon::parse($section->endtime);
										                    $endtime = $e->format('g:i A');

										                    $totalDuration = $e->diffForHumans($s, true);
										                    // $totalDuration = $totalDuration->format('g:i A');

					                                	@endphp
					                                	{{ $starttime }} - {{ $endtime }}
							            			</span>
							            		</div>

							            		<div class="col-12"> 
							            			<span class="label me-3 small text-muted"> Grade </span>
							            			<span class="small"> {{ $section->grade->name }}  </span>
							            		</div>

							            	</div>

							            </div>

					            	</div>
					            </div>

			            		<div class="cd-schedule loading">
			            			<div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
									  	<button class="btn btn-primary @if($schedules->isEmpty()) saveBtn @else updateBtn @endif" type="button"> Save Changes </button>
									</div>
									<div class="events cal-sectionDiv">
										<ul class="p-0">
											<li class="events-group">
												<div class="top-info"><span>Sunday</span></div>

												<ul class="ui-droppable" data-day="Sunday" data-dayid="6">
													@if($schedules)
														@php 
									                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
														@endphp
														@foreach($schedules as $schedule)
														@if($schedule->day == "Sunday")
															@php

																if($schedule->teachersegment){
																	$bgcolor = $schedule->teachersegment->bgcolor;
																	$txtcolor = $schedule->teachersegment->txtcolor;
																	$subject = $schedule->teachersegment->curriculum->subject->name;
												            		
						            								$id = $schedule->teachersegment->id;
																	$type = 'teachersegment';


																}else{
																	$subject = $schedule->title;
																	$bgcolor = "#9e0059";
																	$txtcolor = "#f6b8c5";
																	$id = $schedule->id;
																	$type = 'scheduletype';
																}

																$period_starttime = $section_starttime->format('g:i');
																$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																
															@endphp

															<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
										            			{{ $subject }}
										            		</span>
														
														@endif
														@endforeach
													@endif
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Monday</span></div>
												<ul class="ui-droppable" data-day="Monday" data-dayid="0">
													@if($schedules)
														@php 
									                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
														@endphp
														@foreach($schedules as $schedule)
														@if($schedule->day == "Monday")
															@php

																if($schedule->teachersegment){
																	$bgcolor = $schedule->teachersegment->bgcolor;
																	$txtcolor = $schedule->teachersegment->txtcolor;
																	$subject = $schedule->teachersegment->curriculum->subject->name;
												            		
						            								$id = $schedule->teachersegment->id;
																	$type = 'teachersegment';


																}else{
																	$subject = $schedule->title;
																	$bgcolor = "#9e0059";
																	$txtcolor = "#f6b8c5";
																	$id = $schedule->id;
																	$type = 'scheduletype';
																}

																$period_starttime = $section_starttime->format('g:i');
																$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																
															@endphp

															<span class="badge text-wrap d-block fs-6 drag m-2 " style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
										            			{{ $subject }}
										            		</span>
														
														@endif
														@endforeach
													@endif
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Tuesday</span></div>
												<ul class="ui-droppable" data-day="Tuesday" data-dayid="1">
													@if($schedules)
														@php 
									                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
														@endphp
														@foreach($schedules as $schedule)
														@if($schedule->day == "Tuesday")
															@php

																if($schedule->teachersegment){
																	$bgcolor = $schedule->teachersegment->bgcolor;
																	$txtcolor = $schedule->teachersegment->txtcolor;
																	$subject = $schedule->teachersegment->curriculum->subject->name;
												            		
						            								$id = $schedule->teachersegment->id;
																	$type = 'teachersegment';


																}else{
																	$subject = $schedule->title;
																	$bgcolor = "#9e0059";
																	$txtcolor = "#f6b8c5";
																	$id = $schedule->id;
																	$type = 'scheduletype';
																}

																$period_starttime = $section_starttime->format('g:i');
																$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																
															@endphp

															<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
										            			{{ $subject }}
										            		</span>
														
														@endif
														@endforeach
													@endif
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Wednesday</span></div>
												<ul class="ui-droppable" data-day="Wednesday" data-dayid="2">
													@if($schedules)
														@php 
									                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
														@endphp
														@foreach($schedules as $schedule)
														@if($schedule->day == "Wednesday")
															@php

																if($schedule->teachersegment){
																	$bgcolor = $schedule->teachersegment->bgcolor;
																	$txtcolor = $schedule->teachersegment->txtcolor;
																	$subject = $schedule->teachersegment->curriculum->subject->name;
												            		
						            								$id = $schedule->teachersegment->id;
																	$type = 'teachersegment';


																}else{
																	$subject = $schedule->title;
																	$bgcolor = "#9e0059";
																	$txtcolor = "#f6b8c5";
																	$id = $schedule->id;
																	$type = 'scheduletype';
																}

																$period_starttime = $section_starttime->format('g:i');
																$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																
															@endphp

															<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
										            			{{ $subject }}
										            		</span>
														
														@endif
														@endforeach
													@endif
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Thursday</span></div>
												<ul class="ui-droppable" data-day="Thursday" data-dayid="3">
													@if($schedules)
														@php 
									                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
														@endphp
														@foreach($schedules as $schedule)
														@if($schedule->day == "Thursday")
															@php

																if($schedule->teachersegment){
																	$bgcolor = $schedule->teachersegment->bgcolor;
																	$txtcolor = $schedule->teachersegment->txtcolor;
																	$subject = $schedule->teachersegment->curriculum->subject->name;
												            		
						            								$id = $schedule->teachersegment->id;
																	$type = 'teachersegment';


																}else{
																	$subject = $schedule->title;
																	$bgcolor = "#9e0059";
																	$txtcolor = "#f6b8c5";
																	$id = $schedule->id;
																	$type = 'scheduletype';
																}

																$period_starttime = $section_starttime->format('g:i');
																$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																
															@endphp

															<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
										            			{{ $subject }}
										            		</span>
														
														@endif
														@endforeach
													@endif
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Friday</span></div>

												<ul class="ui-droppable" data-day="Friday" data-dayid="4">
													@if($schedules)
														@php 
									                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
														@endphp
														@foreach($schedules as $schedule)
														@if($schedule->day == "Friday")
															@php

																if($schedule->teachersegment){
																	$bgcolor = $schedule->teachersegment->bgcolor;
																	$txtcolor = $schedule->teachersegment->txtcolor;
																	$subject = $schedule->teachersegment->curriculum->subject->name;
												            		
						            								$id = $schedule->teachersegment->id;
																	$type = 'teachersegment';


																}else{
																	$subject = $schedule->title;
																	$bgcolor = "#9e0059";
																	$txtcolor = "#f6b8c5";
																	$id = $schedule->id;
																	$type = 'scheduletype';
																}

																$period_starttime = $section_starttime->format('g:i');
																$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																
															@endphp

															<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
										            			{{ $subject }}
										            		</span>
														
														@endif
														@endforeach
													@endif
												</ul>
											</li>

											<li class="events-group">
												<div class="top-info"><span>Saturday</span></div>

												<ul class="ui-droppable" data-day="Saturday" data-dayid="5">
													@if($schedules)
														@php 
									                    	$section_starttime = Carbon\Carbon::parse($section->starttime);
														@endphp
														@foreach($schedules as $schedule)
														@if($schedule->day == "Saturday")
															@php

																if($schedule->teachersegment){
																	$bgcolor = $schedule->teachersegment->bgcolor;
																	$txtcolor = $schedule->teachersegment->txtcolor;
																	$subject = $schedule->teachersegment->curriculum->subject->name;
												            		
						            								$id = $schedule->teachersegment->id;
																	$type = 'teachersegment';


																}else{
																	$subject = $schedule->title;
																	$bgcolor = "#9e0059";
																	$txtcolor = "#f6b8c5";
																	$id = $schedule->id;
																	$type = 'scheduletype';
																}

																$period_starttime = $section_starttime->format('g:i');
																$period_endtime = $section_starttime->addMinutes($duration)->format('g:i');


																
															@endphp

															<span class="badge text-wrap d-block fs-6 drag m-2" style="background-color: {{ $bgcolor }}; color:{{ $txtcolor }};" data-id="{{ $id }}" data-type="{{ $type }}">
										            			{{ $subject }}
										            		</span>
														
														@endif
														@endforeach
													@endif
												</ul>
											</li>

											
										</ul>
									</div>


									<div class="cover-layer"></div>
								</div> <!-- .cd-schedule -->
			            		

			            		
			            	</div>
			            </div>


			            

	            @endif
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

        	var selected_periodid = "{{ $periodid ?? '' }}";
        	var selected_sectionid = "{{ $sectionid  ?? '' }}";
        	var selected_batchid = "{{ $batchid  ?? '' }}";

        	if(selected_periodid){
        		pickSection(selected_periodid);
        		pickBatch(selected_sectionid);
        	}


        	if (currentLanguage == "mm") {
            	var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";
            	var s_success_text = "အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ";
            	var e_success_text ="အချက်အလက်များကိုအောင်မြင်စွာ ပြင်ဆင် ပြီးပါပြီ";
            	var d_confirm_text ="အချက်အလက်များကို စာရင်းမှပယ်ဖျက်မည်!";
            	var d_success_text = "အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ";
            	var d_cancel_text = "အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။";
            	var confirm_btn_text = "ဟုတ်ကဲ့၊ ဖျက်လိုက်ပါ။";
            	var cancel_btn_text = "မလုပ်တော့ပါ။";
            }
            else if(currentLanguage == "jp"){
            	var placeholder_title = "少なくとも1つのオプションを選択してください";
            	var s_success_text = "データが保存されました！";
            	var e_success_text = "データが更新されました！";
            	var d_confirm_text ="そのデータを削除すると、ネットワークから完全に削除されます。";
            	var d_success_text = "データが削除されました！";
            	var d_cancel_text = "あなたのデータは私たちのデータベースに保存されました！";
            	var confirm_btn_text = "はい、削除してください！";
            	var cancel_btn_text = "キャンセル";
            }
            else if(currentLanguage == "cn"){
            	var placeholder_title =  "请至少选择一个选项";
            	var s_success_text = "您的数据已保存！";
            	var e_success_text = "您的数据已更新！";
            	var d_confirm_text ="删除该数据会将其从您的网络中永久删除。";
            	var d_success_text = "您的数据已被删除！";
            	var d_cancel_text = "您的数据已保存在我们的数据库中！";
            	var confirm_btn_text = "是的，删除它！";
            	var cancel_btn_text = "取消";
            }
            else if(currentLanguage == "de"){
            	var placeholder_title = "Bitte wählen Sie mindestens eine Option aus";
            	var s_success_text = "Ihre Daten wurden gespeichert!";
            	var e_success_text = "Ihre Daten wurden aktualisiert!";
            	var d_confirm_text ="Durch das Löschen dieser Daten werden sie dauerhaft aus Ihrem Netzwerk entfernt.";
            	var d_success_text = "Ihre Daten wurden gelöscht!";
            	var d_cancel_text = "Ihre Daten wurden in unserer Datenholiday gespeichert!";
            	var confirm_btn_text = "Ja, löschen!";
            	var cancel_btn_text = "Abbrechen";
            }
            else if(currentLanguage == "fr"){
            	var placeholder_title ="Veuillez sélectionner au moins une option";
            	var s_success_text = "Vos données ont été enregistrées!";
            	var e_success_text = "Vos données ont été mises à jour !";
            	var d_confirm_text ="La suppression de ces données les supprimera définitivement de votre réseau.";
            	var d_success_text = "Vos données ont été supprimées !";
            	var d_cancel_text = "Vos données ont été sauvegardées dans notre base de données !";
            	var confirm_btn_text = "Oui, supprimez-le !";
            	var cancel_btn_text = "Annuler";
            }else{
            	var placeholder_title ="Please select at least one option";
            	var s_success_text = "Your data was saved!";
            	var e_success_text = "Your data was updated!";
            	var d_confirm_text = "Deleting that data will permanently remove it from your network.";
            	var d_success_text = "Your data was deleted!";
            	var d_cancel_text = "Your data was safed in our database!";
            	var confirm_btn_text = "Yes, delete it!";
            	var cancel_btn_text = "Cancel";
            }

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
		                if(selected_sectionid == v.id){
		                	sectionhtml += `selected`;
		                }
		                sectionhtml += `>${grade}</option>`;
		            });

		            $('#inputSection').html(sectionhtml);

		        });

		        
		    }

            $('#inputSection').change(function (e) {
		        var section_id = $(this).val();
		        pickBatch(section_id);
		    });

		    function setCodeno(obj) {
			    var data = $(obj.element).data();
		        var text = $(obj.element).text();
		        var text_arr = text.split("|");

		        var name = text_arr[0];
		        var codeno = text_arr[1];

		        if(name){

			    	template = $("<div>"+ 
	                        "<span>" + name + "</span> <span class='badge text-wrap d-block bg-warning text-dark float-end'>"+ codeno +" </span> </p></div>");
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

		                sectionhtml +=`<option value="${v.id}"`
		                	if(selected_batchid){
		                		sectionhtml += `selected`;
		        				$('#searchBtn').prop('disabled',false);

		                	}
		                sectionhtml +=`>${name}|${codeno}</option>`;
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
		        $('#searchBtn').prop('disabled',false);

		    });

		    $(".clone")
			    .mousedown(function(e) {
			        $(this).draggable("option", {
			            helper: $(this).hasClass("clone") ? "clone" : "original"
			        });
			    })
			    .draggable({
			        revert: "invalid",
			        start: function(e, ui) {
			            if ($(this).hasClass("clone")) {
			                // DRAG TASK FROM "ADD new Tasks" = DUPLICATE
			                $(this).data("clone", "admintask");
			            }
			            $(this).data("oldDate", $(this).parent().data("day"));
			        }
			    });

			//  DROP AND SAVE
			$(".ui-droppable").droppable({
			    drop: function(e, ui) {
			        var drag = ui.draggable,
			            drop = $(this),
			            oldDate = drag.data("oldDate"),
			            newDate = drop.data("day");
			            console.log(newDate);
			        (dragID = drag.attr("id")), (dropID = drop.attr("id"));
			        if (drag.data("clone") == "admintask") {
			            $(drag).clone().appendTo(drop).removeClass('clone').addClass('drag').attr("data-dragday",newDate);

			        } else if (oldDate != newDate || dragID != dropID) {
			            $(drag).detach().css({
			                top: 0,
			                left: 0
			            }).appendTo(drop);
			        } else {
			            return $(drag).css({
			                top: 0,
			                left: 0
			            });
			        }
			    }
			});

			$('.ui-droppable').on('mouseenter', '.drag', function() {
			    //stuff to do on mouseover

			    $(this)
			        .css('z-index', '9999999')
			        .prepend('<div class="opt-tools"><div class="opt-trash"><i class="bi bi-x-lg"></i></div></div>');
			});

			$('.ui-droppable').on('mouseleave', '.drag', function() {
			    //stuff to do on mouseover
			    $(this).css("z-index", "0").find(".opt-tools").remove();
			});

			$('.ui-droppable').on('click', '.opt-trash', function() {
  				var id = $(this).parent().parent().data('id');
  				var type = $(this).parent().parent().data('type');

  				var day = $(this).parent().parent().parent().data('day');

  				console.log(type);

  				$(".ui-droppable[data-day='" + day +"']").find('[data-type='+type+'][data-id='+id+']').remove();

			});

			$('.saveBtn').click(function (e) {
				var scheduleday= [];
				var scheduledetail;

				$('.ui-droppable').each(function(index){
					var dayid = $(this).data('dayid');
					var day = $(this).data('day');
					scheduledetail = new Array();

					$('.drag').each(function() {
						var type = $(this).data('type');
						var id = $(this).data('id');
						var dragday = $(this).data('dragday');
						const scheduleid = {
							'day' : dragday,
						  	'type': type,
						  	'id': id 
						}

						scheduledetail.push(scheduleid);
	                });



				});

				$.ajax({
                    type:'POST',
                    url: "{{ route('master.schedule.store')}}",
                    data: {
                    	batchid : selected_batchid,
                    	scheduledetail:scheduledetail
                    },
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

                    },
                    error: function(error){
                        console.log(error.responseJSON.errors);
                        
                    }
                });

		    });
			



        });
    </script>


@stop
</x-template>