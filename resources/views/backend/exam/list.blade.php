<x-template>
	@php
	    $authRole = Auth::user()->getRoleNames()[0];
	    $authuser = Auth::user();
	@endphp

	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Exam")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Exam List")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	        	<div class="card">
	            	<div class="card-header row align-items-center">
		            	<div class="col-12">
	            			<form method="get" action="{{route('master.exam.index')}}" class="row">
		                    	<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12  form-group mb-3">
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

		                    	<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12  form-group mb-3">
		                            <label class="mb-2" for="inputSection">{{ __("Choose Section") }} * </label>
		                            <select class="select2" name="section" id="inputSection" disabled="">
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

	            @if(isset($exams))
		            @foreach($exams as $exam)
			            <div class="card" >
			            	<div class="card-body">
			            		<h6 class="card-title d-inline-block"> {{ $exam->name }} </h6>
			            		<span class="text-muted small"> | {{ $exam->section->grade->name }} </span>

			            		@if(!in_array($authRole,["Guardian", "Student"]))

			            		<div class="float-end mt-3 mx-2">
		                  			<button type="button" class="btn btn-danger me-2 exam_deleteBtn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("Remove") }}" data-id="{{ $exam->id }}" >
		                  				<i class="bi bi-x-lg"></i>
		                  			</button>
		                  		</div>

			            		<div class="float-end mt-3">
		                  			<button type="button" class="btn btn-warning me-2 exam_editBtn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("Edit") }}" data-id="{{ $exam->id }}" data-title="{{ $exam->name }}">
		                  				<i class="bi bi-gear-fill"></i>
		                  			</button>
		                  		</div>
		                  		@endif
		                  		

			            		<div class="mb-3">
			            			<span class="small">
			            				<i class="bi bi-calendar-event me-2"></i> 
			            				{{ date('d M, Y',strtotime($exam->startdate)) }}
			            			</span>
			            			<span class="small">
			            				<i class="bi bi-calendar-event mx-2"></i>
			            				{{ date('d M, Y',strtotime($exam->enddate)) }}
			            			</span>
			            		</div>

			            		@if(!$exam->section->grade->subjecttypes->isEmpty())
			            		<!-- Default Tabs -->
								<ul class="nav nav-tabs d-flex" id="myTabjustified" role="tablist">
			            			@foreach($exam->section->grade->subjecttypes as $key => $subjecttype)
								    <li class="nav-item flex-fill" role="presentation">
								        <button class="nav-link w-100 @if($key == 0) active @endif" id="subjecttype{{ $subjecttype->id }}tab" data-bs-toggle="tab" data-bs-target="#subjecttype{{ $subjecttype->id }}" type="button">
								        	{{ $subjecttype->name }}
								        	( {{ $subjecttype->otherlanguage }} )
								        </button>
								    </li>
								    @endforeach
								    
								</ul>
								<div class="tab-content pt-2" id="myTabjustifiedContent">
			            			@foreach($exam->section->grade->subjecttypes as $key => $subjecttype)

								    <div class="tab-pane fade show @if($key == 0) active @endif" id="subjecttype{{ $subjecttype->id }}" role="tabpanel" aria-labelledby="subjecttype{{ $subjecttype->id }}tab">
								        
				            			<table class="table table-bordered mt-3">
										  	<thead class="text-center table-primary">
										    	<tr>
											      	<th scope="col">Date</th>
											      	<th scope="col">Day</th>
											      	<th scope="col">Subject</th>
											      	<th scope="col">Timing</th>
											      	@if(!in_array($authRole,["Guardian", "Student"]))
											      		<th scope="col">Action</th>
											      	@endif
											    </tr>
										  	</thead>
										  	<tbody>
										  		@foreach($exam->examdetails as $examdetail)
										  		@if($examdetail->curriculum->subjecttype->id == $subjecttype->id)

										  		<tr>
										  			<td>{{ date('d M, Y',strtotime($examdetail->date)) }}</td>
										  			<td>
										  				{{ date('l',strtotime($examdetail->date)) }}
										  			</td>
										  			<td>
										  				{{ $examdetail->curriculum->subject->name }}
										  			</td>
										  			<td> 
										  				@php
				                                		$s = Carbon\Carbon::parse($examdetail->starttime);
									                    $starttime = $s->format('g:i A');

									                    $e = Carbon\Carbon::parse($examdetail->endtime);
									                    $endtime = $e->format('g:i A');

									                    $totalDuration = $e->diffForHumans($s, true);
									                    // $totalDuration = $totalDuration->format('g:i A');

				                                	@endphp
				                                		{{ $starttime }} - {{ $endtime }}
				                                		<p class="small">
				                                			<i class="bi bi-stopwatch"></i>
				                                			{{ $totalDuration }}
				                                		</p>
										  			</td>
										  			@if(!in_array($authRole,["Guardian", "Student"]))
										  			<td>
										  				<button type="button" class="btn btn-outline-warning me-2 examdetail_editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("Edit") }}" data-id="{{ $examdetail->id }}" data-date="{{ $examdetail->date }}" data-starttime="{{ $examdetail->starttime }}" data-endtime="{{ $examdetail->endtime }}" data-title="{{ $examdetail->curriculum->subject->name }}">
							                                <i class="bi bi-gear-fill"></i> 
							                            </button>
							                            <button type="button" class="btn btn-outline-danger me-2 examdetail_deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("Remove") }}" data-id="{{ $examdetail->id }}">
							                                <i class="bi bi-x-lg"></i> 
							                            </button>
										  			</td>
										  			@endif
										  		</tr>
										  		@endif
										  		@endforeach
										  	</tbody>
										</table>

								    </div>

								    @endforeach

								</div>
								<!-- End Default Tabs -->

			            		@else
			            		<div class="mt-3">
			            			<table class="table table-bordered mt-3">
									  	<thead class="text-center table-primary">
									    	<tr>
										      	<th scope="col">Date</th>
										      	<th scope="col">Day</th>
										      	<th scope="col">Subject</th>
										      	<th scope="col">Timing</th>
										      	@if(!in_array($authRole,["Guardian", "Student"]))
										      	<th scope="col">Action</th>
										      	@endif
										    </tr>
									  	</thead>
									  	<tbody>
									  		@foreach($exam->examdetails as $examdetail)
									  		<tr>
									  			<td>{{ date('d M, Y',strtotime($examdetail->date)) }}</td>
									  			<td>
									  				{{ date('l',strtotime($examdetail->date)) }}
									  			</td>
									  			<td>
									  				{{ $examdetail->curriculum->subject->name }}
									  			</td>
									  			<td> 
									  				@php
			                                		$s = Carbon\Carbon::parse($examdetail->starttime);
								                    $starttime = $s->format('g:i A');

								                    $e = Carbon\Carbon::parse($examdetail->endtime);
								                    $endtime = $e->format('g:i A');

								                    $totalDuration = $e->diffForHumans($s, true);
								                    // $totalDuration = $totalDuration->format('g:i A');

			                                	@endphp
			                                		{{ $starttime }} - {{ $endtime }}
			                                		<p class="small">
			                                			<i class="bi bi-stopwatch"></i>
			                                			{{ $totalDuration }}
			                                		</p>
									  			</td>
									  			@if(!in_array($authRole,["Guardian", "Student"]))
									  			<td>
									  				<button type="button" class="btn btn-outline-warning me-2 editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("Edit") }}" data-id="{{ $examdetail->id }}" data-date="{{ $examdetail->date }}" data-starttime="{{ $examdetail->starttime }}" data-endtime="{{ $examdetail->endtime }}" data-title="{{ $examdetail->curriculum->subject->name }}">
						                                <i class="bi bi-gear-fill"></i> 
						                            </button>
									  			</td>
									  			@endif
									  		</tr>
									  		@endforeach
									  	</tbody>
									</table>
			            		</div>

			            		@endif
			            	</div>
			            </div>
			        @endforeach
	            @endif
	        </div>

	        
	    </div>
	</section>

<div class="modal fade" id="showexamModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
	            <form class="row g-3">
	            	<input type="hidden" name="id" id="inputexamId">


		            <div class="modal-body">
					    <div class="col-12 mb-3">
					        <label for="inputTitle" class="form-label">{{ __("Title")}}</label>
					        <input type="text" class="form-control" id="inputTitle" name="name">

                            <span class="err_title error d-block text-danger"></span>

					    </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Close")}}</button>
		                <button type="submit" class="btn btn-primary">{{ __("Save Changes")}}</button>
		            </div>
				</form>
			</div>

        </div>
    </div>
</div>

<div class="modal fade" id="showexamdetailModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
	            <form class="row g-3">
	            	<input type="hidden" name="id" id="inputexamdetailId">

		            <div class="modal-body">

                        <div class="col-12 mb-3">
                            <label for="inputDate" class="form-label">{{ __("Date")}}</label>

                            <div class="input-group mb-3 daterange">
                                <input type="text" class="form-control date" name="date" id="inputDate" >
                            </div>

                        </div>

                        <div class="row form-group mb-3 time" id="timepicker">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
                                <label for="inputStarttime"> {{ __("Start Time") }} *</label>
                                <input type="text" placeholder="HH:MM AM/PM" class="form-control" id="inputStarttime" name="starttime">

                                <span class="err_starttime error d-block text-danger"></span>

                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
                                <label for="inputEndtime"> {{ __("End Time") }} *</label>
                                <input type="text" placeholder="HH:MM AM/PM" class="form-control" id="inputEndtime" name="endtime">

                                <span class="err_enddtime error d-block text-danger"></span>

                            </div>
                        </div>
                    </div>

		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __("Close")}}</button>
		                <button type="submit" class="btn btn-primary">{{ __("Save Changes")}}</button>
		            </div>
				</form>
			</div>

        </div>
    </div>
</div>

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
            	var n_modal_title = "အသစ်ထည့်ရန်";
            	var e_modal_title = "ရှိပြီးသားကို ပြင်ဆင်ရန်";
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
            	var subject_title = "主題";
            	var subjecttype_title = "件名タイプ";
            	var subjecttype_note = "そのカリキュラムに科目タイプがない場合は、スキップしてください。";
            	var majorminor_title ="メジャー、マイナー";
            	var maincurriculum_text = "主なカリキュラム";
            	var extracurriculum_text = "課外活動";
            	var remove_btn_text = "削除";
            	var n_modal_title = "新しく追加する";
            	var e_modal_title = "既存の編集";
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
            	var subject_title = "主题";
            	var subjecttype_title = "主题类型";
            	var subjecttype_note =  "如果该课程没有主题类型，请跳过它。";
            	var majorminor_title ="主要次要";
            	var maincurriculum_text = "主要课程";
            	var extracurriculum_text = "课外活动";
            	var remove_btn_text = "消除";
            	var n_modal_title =  "添新";
            	var e_modal_title =  "编辑现有";
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
            	var subject_title = "Fach";
            	var subjecttype_title = "Betrefftyp";
            	var subjecttype_note = "Wenn dieser Lehrplan keinen Fachtyp hat, überspringen Sie ihn einfach.";
            	var majorminor_title ="Dur / Moll";
            	var maincurriculum_text = "Hauptlehrplan";
            	var extracurriculum_text = "Extralehrplan";
            	var remove_btn_text = "Entfernen";
            	var n_modal_title = "Neue hinzufügen";
            	var e_modal_title = "Bestehende bearbeiten";
            	var s_success_text = "Ihre Daten wurden gespeichert!";
            	var e_success_text = "Ihre Daten wurden aktualisiert!";
            	var d_confirm_text ="Durch das Löschen dieser Daten werden sie dauerhaft aus Ihrem Netzwerk entfernt.";
            	var d_success_text = "Ihre Daten wurden gelöscht!";
            	var d_cancel_text = "Ihre Daten wurden in unserer Datenbank gespeichert!";
            	var confirm_btn_text = "Ja, löschen!";
            	var cancel_btn_text = "Abbrechen";
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
            	var n_modal_title ="Ajouter nouveau";
            	var e_modal_title ="Modifier existant";
            	var s_success_text = "Vos données ont été enregistrées!";
            	var e_success_text = "Vos données ont été mises à jour !";
            	var d_confirm_text ="La suppression de ces données les supprimera définitivement de votre réseau.";
            	var d_success_text = "Vos données ont été supprimées !";
            	var d_cancel_text = "Vos données ont été sauvegardées dans notre base de données !";
            	var confirm_btn_text = "Oui, supprimez-le !";
            	var cancel_btn_text = "Annuler";
            	
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
            	var n_modal_title ="Add New";
            	var e_modal_title ="Edit Existing";
            	var s_success_text = "Your data was saved!";
            	var e_success_text = "Your data was updated!";
            	var d_confirm_text = "Deleting that data will permanently remove it from your network.";
            	var d_success_text = "Your data was deleted!";
            	var d_cancel_text = "Your data was safed in our database!";
            	var confirm_btn_text = "Yes, delete it!";
            	var cancel_btn_text = "Cancel";

            }

            const date = document.querySelector('.date');
            new Datepicker(date, {
                autohide: true,
                'format': 'yyyy/mm/dd',
                minDate: new Date(),

            });

            $("#inputStarttime").datetimepicker({
                format: "LT",
                icons: {
                    up: "bi bi-chevron-up",
                    down: "bi bi-chevron-down"
                }
            });

            $("#inputEndtime").datetimepicker({
                format: "LT",
                icons: {
                    up: "bi bi-chevron-up",
                    down: "bi bi-chevron-down"
                }
            });

            var selected_periodid = "{{ $periodid ?? '' }}";
        	var selected_sectionid = "{{ $sectionid  ?? '' }}";

        	if(selected_periodid){
        		pickSection(selected_periodid);
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
		        $('#searchBtn').prop('disabled',false);

		    });


            // EDIT
            $('.exam_editBtn').on('click', function(){

                var id = $(this).data('id');
                var title = $(this).data('title');

                $('#inputexamId').val(id);
                $('#inputTitle').val(title);

				$("#showexamModal").modal("show");
                $("#showexamModal form").attr('id', 'editForm');
                $("#showexamModal .modal-title").text(e_modal_title);
            });

            // UPDATE
            $("#showexamModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputexamId').val();
                
                var url="{{route('master.exam.update',':id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    type:'POST',
                    dataType: 'json',
                    url: url,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: e_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        }).then(
                        	function(){
                        		$("#showexamModal").modal("hide");
                            	window.location.reload();
                        	}
                        );
                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "name") 
                            {
                                $('.err_title').html(err[key]);
                                $('#inputTitle').addClass('border border-danger');
                            }

                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });

                
            });

            // DELETE
            $('.exam_deleteBtn').on('click', function(){
     
                var id = $(this).data("id");
                
                var url="{{route('master.exam.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: d_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_btn_text,
  				cancelButtonText: cancel_btn_text,  
  				confirmButtonColor: '#3085d6',
  				cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        Swal.fire({
                            icon: "success",
                            text: d_success_text,
                            timer : 1500,
                            showConfirmButton: false
                        }).then(
                            function()
                            {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    success: function (data) {
                            			window.location.reload();
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });
                            }
                        );
                        
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: d_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

            // EDIT
            $('.examdetail_editBtn').on('click', function(){

                var id = $(this).data('id');
                var date = $(this).data('date');
                var starttime = $(this).data('starttime');
                var endtime = $(this).data('endtime');
                var title = $(this).data('title');

                $('#inputexamdetailId').val(id);
                $('#inputDate').val(date);
                $('#inputStarttime').val(starttime);
                $('#inputEndtime').val(endtime);

				$("#showexamdetailModal").modal("show");
                $("#showexamdetailModal form").attr('id', 'editForm');
                $("#showexamdetailModal .modal-title").text(title+" Exam Date/Time");
            });

            // UPDATE
            $("#showexamdetailModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputexamdetailId').val();
                
                var url="{{route('master.examdetail.update',':id')}}";
                url=url.replace(':id',id);

                console.log(url);

                $.ajax({
                    type:'POST',
                    dataType: 'json',
                    url: url,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: e_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        }).then(
                        	function(){
                        		$("#showexamdetailModal").modal("hide");
                            	window.location.reload();
                        	}
                        );
                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });

                
            });

            // DELETE
            $('.examdetail_deleteBtn').on('click', function(){
     
                var id = $(this).data("id");
                
                var url="{{route('master.examdetail.destroy',':id')}}";
                url=url.replace(':id',id);
              
                Swal.fire({
                text: d_confirm_text,
                icon: "warning",
                showCancelButton:true,
                confirmButtonText: confirm_btn_text,
  				cancelButtonText: cancel_btn_text,  
  				confirmButtonColor: '#3085d6',
  				cancelButtonColor: '#d33',
                dangerMode: true}).then((willDelete)=>{
                    console.log(willDelete);
                    console.log(willDelete.isConfirmed);

                    if (willDelete.isConfirmed != false) 
                    {
                        Swal.fire({
                            icon: "success",
                            text: d_success_text,
                            timer : 1500,
                            showConfirmButton: false
                        }).then(
                            function()
                            {
                                $.ajax({
                                    type: "DELETE",
                                    url: url,
                                    success: function (data) {
                            			window.location.reload();
                                    },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    }
                                });
                            }
                        );
                        
                    }
                    else
                    {
                        Swal.fire({
                            icon: "info",
                            text: d_cancel_text,
                            showConfirmButton: false,
                            timer : 1500
                        });
                        
                    }
                })
            });

        });
    </script>
@stop
</x-template>