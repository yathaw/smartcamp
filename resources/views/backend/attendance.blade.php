<x-template>
	@php
        $authuser = Auth::user();
    @endphp
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Attendance")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Attendance")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">

	        	<div class="card">
	            	<div class="card-header row align-items-center">
		            	<div class="col-12">
		            		<form method="get" action="{{route('master.attendance.index')}}" class="row">
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
		                            <select class="select2 batches" name="batch" id="inputBatch" disabled="">
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

	            @if(isset($students))
	            @if($attcheck)
	            <div class="card" id="dailyattendanceDiv">
	            	<div class="card-body">
	            		<h5 class="card-title"> {{ ("Daily Attendance Entry") }} </h5>

	            		<h6 class="card-title d-inline-block"> {{ $batch->name }} </h6>
	            		<span class="text-muted small"> | {{ $batch->section->grade->name }} </span>

                  		<div class="mb-3">
	            			<span class="small">
	            				<i class="bi bi-calendar-event me-2"></i> 
	            				{{ date('d M, Y',strtotime($dt)) }}
	            			</span>
	            		</div>

                  		<div class="mt-3">
                  			<form action="{{route('master.attendance.store')}}" method="post" >
                  			 	<input type="hidden" name="batchid" value="{{ $batch->id }}">
                        		@csrf
		            			<table class="table table-bordered mt-3">
								  	<thead class="text-center table-primary">
								    	<tr>
								    		<th scope="col w-25"> # </th>
									      	<th scope="col">Student Name</th>
									      	<th scope="col ">Status</th>
									    </tr>
								  	</thead>
								  	<tbody>
								  		@php $i=1; @endphp
								  		@foreach($students as $student)
								  		<tr>
								  			<td> {{ $i++ }} </td>
								  			<td> 
								  				<input type="hidden" name="studentid[]" value="{{$student->id}}" multiple="">
								  				<p class="text-truncate mb-0"> {{ $student->user->name }} </p>
								  				@if($student->nativename)
			                                    	<small class="text-truncate text-muted"> {{ $student->nativename }} </small>
			                                    @endif
								  			</td>
								  			<td class="w-50">
                  								@if($todayattendances->isEmpty())

								  				<div class="mb-2" id="attendanceStataus">
									  				<input type="radio" class="btn-check" name="status[{{ $student->id }}]" id="present{{ $student->id }}" value="0" data-status="0" data-studentid="{{ $student->id }}" checked>
													<label class="btn btn-outline-success btn-sm" for="present{{ $student->id }}">
														<i class="bi bi-check"></i> Present
													</label>

													<input type="radio" class="btn-check" name="status[{{ $student->id }}]" id="absent{{ $student->id }}" value="1" data-status="1" data-studentid="{{ $student->id }}">
													<label class="btn btn-outline-danger btn-sm" for="absent{{ $student->id }}">
														<i class="bi bi-x"></i> Absent
													</label>

													<input type="radio" class="btn-check" name="status[{{ $student->id }}]" id="execused{{ $student->id }}" value="3" data-status="3" data-studentid="{{ $student->id }}">
													<label class="btn btn-outline-warning btn-sm" for="execused{{ $student->id }}">
														<i class="bi bi-journal-text "></i> Execused
													</label>

													<input type="radio" class="btn-check" name="status[{{ $student->id }}]" id="late{{ $student->id }}" value="2" data-status="2" data-studentid="{{ $student->id }}">
													<label class="btn btn-outline-info btn-sm" for="late{{ $student->id }}">
														<i class="bi bi-clock"></i> Late
													</label>

												</div>

												<div id="remark{{ $student->id }}" class="remark">
													<input type="text" name="remark[]" class="form-control" placeholder="">
												</div>

												@else
													<div>
														@foreach($todayattendances as $todayattendance)
															@if($todayattendance->student_id == $student->id)
																@if($todayattendance->status == 1)
																	<span class="badge bg-danger">Absent</span>
																@elseif($todayattendance->status == 2)
																	<span class="badge bg-info">Late</span>

																	<div class="small">
																		<i class="bi bi-alarm-fill"></i>
																		{{ $todayattendance->remark }}
																	</div>
																@elseif($todayattendance->status == 3)
																	<span class="badge bg-warning">Execused</span>
																	<div class="small ">
																		<blockquote class="reason m-auto">
																			{{ $todayattendance->remark }}
																		</blockquote>
																	</div>
																@else
																	<span class="badge bg-success">Present</span>
																@endif
															@endif
														@endforeach
													</div>

												@endif

								  			</td>
								  		</tr>
								  		@endforeach
								  	</tbody>
                  					@if($todayattendances->isEmpty())
								  	<tfoot>
								  		<tr>
								  			<td colspan="3">
								  				<button class="btn btn-outline-primary float-end" type="submit"> Confirm and Save </button> 
								  			</td>
								  		</tr>
								  	</tfoot>
								  	@endif
								</table>
							</form>
	            		</div>
	            	</div>
	            </div>
	            @endif

	            <div class="card" id="studentattendanceDiv">
	            	<div class="card-body">
	            		<h6 class="card-title d-inline-block"> {{ $batch->name }} </h6>
	            		<span class="text-muted small"> | {{ $batch->section->grade->name }} </span>

	            		<svg style="position: absolute; width: 0; height: 0; display: none;">
						    <symbol id="icon-arrow" viewBox="0 0 96 96">
						        <title>Arrow</title>
						        <path d="M39.66,13.34A8,8,0,0,0,28.34,24.66L51.69,48,28.34,71.34A8,8,0,0,0,39.66,82.66l29-29a8,8,0,0,0,0-11.31Z"/>
						    </symbol>
						</svg>

						<div class="table">
					        <div class="headers">
					            <div class="buttons">
					                <button class="btn-left">
					                    <svg>
					                        <use xlink:href="#icon-arrow"></use>
					                    </svg>
					                </button>
					                <button class="btn-right">
					                    <svg>
					                        <use xlink:href="#icon-arrow"></use>
					                    </svg>
					                </button>
					            </div>
					            <div class="scroller syncscroll" name="myElements">
					                <div class="track time">
					                    <div class="heading">{{ __("Student Name") }}</div>
					                </div>
					                @foreach($days as $day)
					                <div class="track">
					                    <div class="heading">
					                    	@if($day['holiday'])
					                    	<span class="text-danger"> {{ date('d M, Y',strtotime($day['date'])) }} </span>
					                    	@else
					                    	<span> {{ date('d M, Y',strtotime($day['date'])) }} </span>
					                    	@endif
					                    </div>
					                </div>
					                @endforeach
					                
					            </div>
					        </div>
					        <div class="tracks syncscroll" name="myElements">
					            <div class="track time">
					            	@foreach($students as $student)
					                <div class="entry">
					                    <span class="small text-dark"> {{ $student->user->name }} </span>
					                </div>
					                @endforeach
					            </div>
					            @php $dayrow = 1; @endphp
					           	@foreach($days as $day)
					           		@if($day['holiday'])
						                <div class="track bg-danger text-white text-center">
						                	<span style="writing-mode: vertical-rl;"> {{ $day['holiday'] }} </span>
						                </div>
					                @else
							            <div class="track">
							            	@php $sturow = 1; @endphp
							            	@for ($i =0; $i < count($students); $i++)
							            		@if(count($attendances) > 0)
							            		@php 
							            			$attendance = $attendances[$i];
							            			$datelist = $day['date'];
							            			$student = $students[$i];
								            	@endphp
								                	@php 
								                		$attid = $student->getAttendance('App\Models\Attendance',$student->id, $datelist)->id ?? '';
								                		$attstatus = $student->getAttendance('App\Models\Attendance',$student->id, $datelist)->status ?? '';
								                		$remark = $student->getAttendance('App\Models\Attendance',$student->id, $datelist)->remark ?? '';

								                		// dd($attid);
								                		$status;
								                		if($attstatus == 1){
								                			$status = '<span class="text-danger fs-4" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Absent">
										                		<i class="bi bi-x-lg"></i>
										                	</span>';
								                		}elseif($attstatus == 2){
								                			$status = '<span class="text-info fs-4" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" title="Late" data-bs-content="'.$remark.'">
										                		<i class="bi bi-check-lg"></i>
										                	</span>';
								                		}elseif($attstatus == 3){
								                			$status = '<span class="text-warning fs-4" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" title="Execused" data-bs-content="'.$remark.'">
										                		<i class="bi bi-x-lg"></i>
										                	</span>';
								                		}else{
								                			$status = '<span class="text-success fs-4" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Present">
										                		<i class="bi bi-check-lg"></i>
										                	</span>';
								                		}
								                	@endphp
									                <div class="entry">
									                	{!! $status !!}
									                </div>
								                @endif

							                @endfor
							            </div>
							        @endif
					            @endforeach

					        </div>
					    </div>

					</div>
	            </div>
	            
	            @endif

	        </div>
	    </div>
	</section>

@section('script_content')
	
	<script src="{{ asset('assets/js/syncscroll.js') }}"></script>
	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";
    </script>
    
    <script type="text/javascript">
    	var starttime=''; var endtime='';
        $(document).ready(function() {

            $('.remark').hide();


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
            }
            else{
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
		                	if(selected_batchid == id){
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

		    $('#dailyattendanceDiv').on('click','input[type="radio"]',function(){
		    	var status=$(this).data('status');
            	var studentid=$(this).data('studentid');

            	// 0 => Present
	            // 1 => Absent
	            // 2 => Late
	            // 3 => Excused
	            var remarkId = '#remark'+studentid;

	            if (status == 3) {
	                console.log(remarkId);
            		$(remarkId).show();

	                $(remarkId + '> input').attr("placeholder", "Enter Some reason");
	                $(remarkId + '> input').attr('type', 'text');

	            }
	            else if(status == 2){
            		$(remarkId).show();
	                $(remarkId + '> input').attr("placeholder", "Enter Late Time");
	                $(remarkId + '> input').attr('type', 'time');

	            }
	            else{
            		$(remarkId).hide();
	            }

		    });

		    const btnR = document.querySelector('.btn-right');
			const btnL = document.querySelector('.btn-left');
			const tracks = document.querySelector('.tracks');
			const tracksW = tracks.scrollWidth;

			btnR.addEventListener('click', _ => {
			  tracks.scrollBy({
			    left: tracksW / 2,
			    behavior: 'smooth'
			  });
			});

			btnL.addEventListener('click', _ => {
			  tracks.scrollBy({
			    left: -tracksW / 2,
			    behavior: 'smooth'
			  });
			});

        });
    </script>

@stop
</x-template>