<x-template>
	@php
        $authuser = Auth::user();
    @endphp
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Result")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Result")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">

	        	<div class="card">
	            	<div class="card-header row align-items-center">
		            	<div class="col-12">
		            		<form method="get" action="{{route('master.result.index')}}" class="row">
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

	            @if(isset($exams))

	            <div class="accordion" id="accordionExample">
				    

			        @foreach($exams as $key => $exam)
			            <div class="accordion-item">
					        <h2 class="accordion-header" id="heading{{ $exam->id }}">
					            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $exam->id }}" @if($key == 0) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse{{ $exam->id }}">
					            {{ $exam->name }} | 
					            <span class="text-muted small"> {{ $exam->section->grade->name }} </span>
					            </button>
					        </h2>
					        <div id="collapse{{ $exam->id }}" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="heading{{ $exam->id }}" data-bs-parent="#accordionExample">
					            <div class="accordion-body">
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
				            		<div class="mt-3">
				            			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				            				@foreach($exam->examdetails as $examdetail)

										  	<li class="nav-item mx-2 rounded-1 bg-light" role="presentation">
										    	<button class="nav-link" id="pills-{{ $exam->id }}-{{ $examdetail->curriculum->subject->id }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $exam->id }}-{{ $examdetail->curriculum->subject->id }}" type="button" role="tab" aria-controls="pills-{{ $exam->id }}-{{ $examdetail->curriculum->subject->id }}" aria-selected="false">
										    		{{ $examdetail->curriculum->subject->name }}
										    	</button>
										  	</li>

										  	@endforeach
										</ul>

										<div class="tab-content" id="pills-tabContent">
				            				@foreach($exam->examdetails as $examdetail)


										  	<div class="tab-pane fade" id="pills-{{ $exam->id }}-{{ $examdetail->curriculum->subject->id }}" role="tabpanel" aria-labelledby="pills-{{ $exam->id }}-{{ $examdetail->curriculum->subject->id }}-tab">
				            					@if($examdetail->results->isEmpty())

											  		<form action="{{ route('master.result.store') }}" method="POST" >
					                    			@csrf

											  			<input type="hidden" name="examdetailid" value="{{ $examdetail->id }}">
											  			<div class="row">
											  				@foreach($students as $student)
											  				<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
											  					<div class="card shadow-none border">
																  	<div class="card-header">
																    	<input type="hidden" name="studentids[]" value="{{$student->id}}" multiple="">
														  				<p class="text-truncate mb-0"> {{ $student->user->name }} </p>
														  				@if($student->nativename)
									                                    	<small class="text-truncate text-muted"> {{ $student->nativename }} </small>
									                                    @endif
																  	</div>
																  	<ul class="list-group list-group-flush">
																    	<li class="list-group-item">
																    		<div class="input-group mb-3">
																				<span class="input-group-text" id="basic-addon1"><i class="bi bi-star"></i></span>
																				<input type="text" class="form-control" placeholder="Grade Point" name="points[]">
																			</div>
																    	</li>
																    	<li class="list-group-item">
																    		<div class="input-group mb-3">
																				<span class="input-group-text" id="basic-addon1"><i class="bi bi-tags"></i></span>
																				<input type="number" class="form-control" placeholder="Marks" name="marks[]">
																			</div>
																    	</li>
																    	<li class="list-group-item">
																    		<div class="input-group">
																			  	<span class="input-group-text"><i class="bi bi-chat-left-dots"></i></span>
																			  	<textarea class="form-control" placeholder="Comment" name="comments[]"></textarea>
																			</div>
																    	</li>
																  	</ul>
																</div>
											  				</div>
										  					@endforeach
											  			</div>
											  			<div class="row">
												  			<div class="d-grid gap-2 col-6 mx-auto">
															  	<button class="btn btn-primary" type="submit">Save</button>
															</div>
														</div>
											  		</form>
											  	@else

											  		<div class="row">
										  				@foreach($students as $student)
										  				<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
										  					<div class="card-flip">
	                                							<div class="flip flip-{{ $student->id }}">
												  					<div class="card shadow-none border front">
																	  	<div class="card-header">
															  				<p class="text-truncate mb-0"> {{ $student->user->name }} </p>
															  				@if($student->nativename)
										                                    	<small class="text-truncate text-muted"> {{ $student->nativename }} </small>
										                                    @endif
																	  	</div>
																	  	@php 
																	  		$resultid = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->id ?? '';

																	  		$point = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->point ?? '';


																	  		$mark = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->mark ?? '';

																	  		$comment = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->comment ?? '';																  		

																	  		$created_by = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->user->name ?? '';


																	  		$updatedat = $student->getExamresult('App\Models\Result',$examdetail->id, $student->id)->updated_at ?? '';

																	  	@endphp
																	  	<ul class="list-group list-group-flush">
																	    	<li class="list-group-item">
																	    		<small class="d-block text-muted">Grade Point</small>
																	    		<span> {{ $point }} </span>
																	    	</li>
																	    	<li class="list-group-item">
																	    		<small class="d-block text-muted"> Marks </small>
																	    		<span> {{ $mark }} </span>
																	    	</li>
																	    	<li class="list-group-item">
																	    		<small class="d-block text-muted">Comment </small>
																	    		<span>
																	    			@if($comment)
																	    				{{ $comment }}
																	    			@else
																	    				- 
																	    			@endif
																	    		</span>
																	    	</li>
																	    	<li class="list-group-item">
																    			<div>
																    				<small class="d-block text-muted mb-1">Created: </small>
																    				<small class="d-block mb-1"> 
																    					<i class="bi bi-person-bounding-box"></i>
																    					{{ $created_by  }}
																    				</small>
																    				<small class="d-block"> 
																    					<i class="bi bi-clock-history"></i>
																    					{{ date('d M, Y',strtotime($updatedat)) }}
																    				</small>
																    			</div>
																    			<div class="d-grid gap-2 d-md-flex justify-content-md-end">
																				  	<button class="btn btn-outline-warning btn-sm editBtn" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-id="{{ $student->id }}" data-resultid="{{ $resultid }}" data-point="{{ $point }}" data-mark="{{ $mark }}" data-comment="{{ $comment }}">
																				  		<i class="bi bi-gear-fill"></i> 
																				  	</button>
																				</div>
																	    	</li>
																	  	</ul>
																	</div>
												  					<div class="card shadow-none border back stucard-{{ $student->id }}">
												  						<div class="card-header">
																	    	<input type="hidden" name="studentid" value="{{$student->id}}" >
																	    	<input type="hidden" name="examdetailid" value="{{ $examdetail->id }}">
																	    	<input type="hidden" name="resultid">


															  				<p class="text-truncate mb-0"> {{ $student->user->name }} </p>
															  				@if($student->nativename)
										                                    	<small class="text-truncate text-muted"> {{ $student->nativename }} </small>
										                                    @endif
																	  	</div>
																	  	<ul class="list-group list-group-flush">
																	    	<li class="list-group-item">
																	    		<div class="input-group mb-3">
																					<span class="input-group-text" id="basic-addon1"><i class="bi bi-star"></i></span>
																					<input type="text" class="form-control" placeholder="Grade Point" name="point">
																				</div>
																	    	</li>
																	    	<li class="list-group-item">
																	    		<div class="input-group mb-3">
																					<span class="input-group-text" id="basic-addon1"><i class="bi bi-tags"></i></span>
																					<input type="number" class="form-control" placeholder="Marks" name="mark">
																				</div>
																	    	</li>
																	    	<li class="list-group-item">
																	    		<div class="input-group">
																				  	<span class="input-group-text"><i class="bi bi-chat-left-dots"></i></span>
																				  	<textarea class="form-control" placeholder="Comment" name="comment"></textarea>
																				</div>
																	    	</li>
																	    	<li class="list-group-item">
																	    		<div class="d-grid gap-2 mb-2">
	  																				<button class="btn btn-primary updateBtn" type="button" data-id="{{ $student->id }}">Save</button>
	  																			</div>
	  																			<div class="d-grid gap-2">
	  																				<button class="btn btn-outline-secondary cancelBtn" type="button" data-id="{{ $student->id }}">Cancel</button>
	  																			</div>
																	    	</li>
																	  	</ul>
												  					</div>
											  					</div>
															</div>

										  				</div>
									  					@endforeach
										  			</div>	

											  	@endif


										  	</div>

										  	@endforeach

										</div>

				            		</div>

					            </div>
					        </div>
				    	</div>

					@endforeach

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
            	var d_confirm_text ="တစ်ချက်နှိပ်ရုံဖြင့် အချက်အလက်များကို ပြင်ဆင်ပါမည်။ ရှေ့ဆက်လိုသည်မှာ သေချာပါသလား။";
            	var d_success_text = "အချက်အလက်များကိုအောင်မြင်စွာ ပြင်ဆင် ပြီးပါပြီ";
            	var d_cancel_text = "အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။";
            	var confirm_btn_text = "ဟုတ်ကဲ့၊ ဆက်လက်လုပ်ဆောင်မည်။";
            	var cancel_btn_text = "မလုပ်တော့ပါ။";
            }
            else if(currentLanguage == "jp"){
            	var placeholder_title = "少なくとも1つのオプションを選択してください";
            	var s_success_text = "データが保存されました！";
            	var e_success_text = "データが更新されました！";
            	var d_confirm_text ="ワンクリックアップグレードの実行中に結果が更新されます。続行しますか？";
            	var d_success_text = "データが変更されました！";
            	var d_cancel_text = "あなたのデータは私たちのデータベースに保存されました！";
            	var confirm_btn_text = "はい、続けてください！";
            	var cancel_btn_text = "キャンセル";
            }
            else if(currentLanguage == "cn"){
            	var placeholder_title =  "请至少选择一个选项";
            	var s_success_text = "您的数据已保存！";
            	var e_success_text = "您的数据已更新！";
            	var d_confirm_text ="結果將在執行一鍵升級時更新。您確定要繼續嗎？";
            	var d_success_text = "您的數據已更改！";
            	var d_cancel_text = "您的数据已保存在我们的数据库中！";
            	var confirm_btn_text = "是的，繼續！";
            	var cancel_btn_text = "取消";
            }
            else if(currentLanguage == "de"){
            	var placeholder_title = "Bitte wählen Sie mindestens eine Option aus";
            	var s_success_text = "Ihre Daten wurden gespeichert!";
            	var e_success_text = "Ihre Daten wurden aktualisiert!";
            	var d_confirm_text ="Das Ergebnis wird aktualisiert, während das One-Click-Upgrade ausgeführt wird. Möchten Sie wirklich fortfahren?.";
            	var d_success_text = "Ihre Daten wurden geändert!";
            	var d_cancel_text = "Ihre Daten wurden in unserer Datenholiday gespeichert!";
            	var confirm_btn_text = "Ja, weiter!";
            	var cancel_btn_text = "Abbrechen";
            }
            else if(currentLanguage == "fr"){
            	var placeholder_title ="Veuillez sélectionner au moins une option";
            	var s_success_text = "Vos données ont été enregistrées!";
            	var e_success_text = "Vos données ont été mises à jour !";
            	var d_confirm_text ="Le résultat sera mis à jour pendant l'exécution de la mise à niveau en un clic. Voulez-vous vraiment continuer ?";
            	var d_success_text = "Vos données ont été modifiées !";
            	var d_cancel_text = "Vos données ont été sauvegardées dans notre base de données !";
            	var confirm_btn_text = "Oui, continuez !";
            	var cancel_btn_text = "Annuler";
            }
            else{
            	var placeholder_title ="Please select at least one option";
            	var s_success_text = "Your data was saved!";
            	var e_success_text = "Your data was updated!";
            	var d_confirm_text = "Result will be updated while one click upgrade is executing. Are you sure want to proceed?";
            	var d_success_text = "Your data has been changed!";
            	var d_cancel_text = "Your data was safed in our database!";
            	var confirm_btn_text = "Yes, Continue!";
            	var cancel_btn_text = "No, Cancel";
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

		    $('.editBtn').on('click', function(e) {
				e.preventDefault();
		        var student_id = $(this).data('id');
		        var result_id = $(this).data('resultid');
		        var point = $(this).data('point');
		        var mark = $(this).data('mark');
		        var comment = $(this).data('comment');

		         $('.tooltip').not(this).hide();
		        // $(`.stucard`).val(result_id);

		        $('.stucard-'+student_id+' input[name="resultid"]').val(result_id);
		        $('.stucard-'+student_id+' input[name="point"]').val(point);
		        $('.stucard-'+student_id+' input[name="mark"]').val(mark);
		        $('.stucard-'+student_id+' textarea[name="comment"]').val(comment);

				$('.flip-'+student_id).toggleClass('flipped');
			});
			$('.cancelBtn').on('click', function(e) {
				e.preventDefault();
		        var student_id = $(this).data('id');

				$('.flip-'+student_id).toggleClass('flipped');
			});


		    $('.updateBtn').on('click', function(e) {

		        var student_id = $(this).data('id');

		        var result_id = $('.stucard-'+student_id+' input[name="resultid"]').val();
		        var point = $('.stucard-'+student_id+' input[name="point"]').val();
		        var mark = $('.stucard-'+student_id+' input[name="mark"]').val();
		        var comment = $('.stucard-'+student_id+' textarea[name="comment"]').val();

                
                var url="{{route('master.result.update',':id')}}";
                url=url.replace(':id',result_id);
              
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
                                    type: "POST",
                                    url: url,
                                    data: {point:point, mark:mark, comment:comment},
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