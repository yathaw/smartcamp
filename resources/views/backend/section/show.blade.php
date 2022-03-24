<x-template>
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/pdfViewer/style.css') }}">
    	<style type="text/css">
    		#assignSelection .select2-container--bootstrap5 .select2-selection--single {
			    height: 70px !important;
			}
    	</style>
    @endsection
	<div class="pagetitle">
	    <h1> {{ __("Section")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item"><a href="{{ route('master.section.index') }}">{{ __("All Sections")}}</a></li>
	            <li class="breadcrumb-item active"> {{ $section->codeno }} </li>
	        </ol>
	    </nav>
	</div>

	<section class="section dashboard profile">
	    <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
            	<div class="card info-card sales-card">
                  	<div class="card-body">
                      	<h5 class="card-title d-inline-block"> {{ $section->codeno }} 
                      	</h5>
                      	<span class="text-muted small">| {{ $section->period->name }} </span>
                      	<div class="d-flex align-items-center">
                          	<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
						        <i class="bi bi-award-fill"></i>
						    </div>
                          	<div class="ps-3">
                              	<h5> {{ $section->grade->name }} </h5>
                              	<span class=" small pt-2 ps-1 heather_color">
                              		@php
                                		$s = Carbon\Carbon::parse($section->starttime);
					                    $starttime = $s->format('g:i A');

					                    $e = Carbon\Carbon::parse($section->endtime);
					                    $endtime = $e->format('g:i A');
                                	@endphp
                                	{{ $starttime }} - {{ $endtime }}
                              	</span>
                          	</div>
                      	</div>
                  	</div>
              	</div>

              	<div class="card info-card revenue-card">
                  	<div class="card-body">
                      	<h5 class="card-title"> Total Installment </h5>
	                      	
	                      	<div class="d-flex align-items-center" id="fullinstallmentState">
	                      		<div class="filter">
		                  			<a class="icon installment_editBtn" href="javascript:void(0)">
		                  				<i class="bi bi-gear-fill text-dark"></i>
		                  			</a>
		                  		</div>
							    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
							        <i class="bi bi-cash-coin"></i>
							    </div>
							    <div class="ps-3">
							        <h6 class="d-inline-block"> <span class="totalAmount"></span> </h6> <span class="currencysymbol badge bg-warning text-dark"></span> 
							        <span class="text-muted small pt-2 ps-1 d-block currency"> </span>

							    </div>
							</div>
							<div id="emptyinstallmentState">
								<div class="row align-items-center justify-content-center">
	                                <div class="col-3 pb-3 text-center">
	                                    <img src="{{ asset('assets/img/empty_card.png') }}" class="img-fluid text-center">
	                                </div>
	                            </div>
								<p class="text-center heather_color"> {{ __("There have been no installment in this section yet.") }} </p>
							</div>
                  	</div>
              	</div>

              	<div class="card info-card customers-card">
                  	<div class="card-body">
                      	<h5 class="card-title d-inline-block"> Enrollment </h5>
                      	@if($section->price)

	                      	<div class="d-flex align-items-center">
							    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
			                      	<i class="bi bi-people"></i>
			                    </div>
							    <div class="ps-3">
							        <h6>3,264</h6>
							        <span class="text-muted small pt-2 ps-1"> Students </span>
							    </div>
							</div>
						@else
							<div class="row align-items-center justify-content-center">
                                <div class="col-3 pb-3 text-center">
                                    <img src="{{ asset('assets/img/empty_student.png') }}" class="img-fluid text-center">
                                </div>
                            </div>
							<p class="text-center heather_color"> {{ __("There have been no enrollment in this section yet.") }} </p>


						@endif
						
                  	</div>
              	</div>

            </div>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
            	<div class="card">
                    <div class="card-body pt-3">
                    	<!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview">
                                	{{ __("Overview") }}
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#installment"> 
                                	{{ __("Installment") }} 
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#batch">
                                	{{ __("Batch") }}
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#assignteacher">
                                	{{ __("Assign Teacher") }}
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="overview">
                                <h5 class="card-title">{{ __("Details") }}</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Grade") }} </div>
                                    <div class="col-lg-9 col-md-8">
                                    	{{ $section->grade->name }} 
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Date") }} </div>
                                    <div class="col-lg-9 col-md-8">
                                    	{{ date('M d, Y',strtotime($section->startdate)) }} -
                                    	{{ date('M d, Y',strtotime($section->enddate)) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Academic Year") }} </div>
                                    <div class="col-lg-9 col-md-8">
                                    	{{ $section->period->startyear }} -
                                    	{{ $section->period->endyear }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Time") }} </div>
                                    <div class="col-lg-9 col-md-8">
                                    	@php
	                                		$s = Carbon\Carbon::parse($section->starttime);
						                    $starttime = $s->format('g:i A');

						                    $e = Carbon\Carbon::parse($section->endtime);
						                    $endtime = $e->format('g:i A');

						                    $totalDuration = $e->diffForHumans($s, true);
						                    // $totalDuration = $totalDuration->format('g:i A');

	                                	@endphp
	                                	{{ $starttime }} - {{ $endtime }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Duration") }} </div>
                                    <div class="col-lg-9 col-md-8">
                                    	{{ $totalDuration }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label "> {{ __("Whole Batch") }} </div>
                                    <div class="col-lg-9 col-md-8">
                                    	0
                                    </div>
                                </div>

                                
                            </div>
                            <div class="tab-pane fade installment pt-3" id="installment">
                            	<div class="mb-5" id="emptypackageState">
	                            	<div class="container">
			                            <div class="row align-items-center justify-content-center">
			                                <div class="col-6  text-center">
			                                    <img src="{{ asset('assets/img/empty_package.svg') }}" class="img-fluid text-center">
			                                </div>
			                            </div>
			                        </div>
			                        <h2 class="text-center"> {{ __("No Installment Found") }} </h2>
			                        <p class="text-center"> {{ __("There have been no installment in this section yet.") }} </p>
			                    </div>

                                <div class="d-grid gap-2 col-4 mx-auto mb-2">
								  	<button class="btn btn-outline-primary createpackageBtn" type="button"> 
								  		<i class="bi bi-plus-lg pe-1"></i> 
								  		{{ __("Add Package") }} 
								  	</button>
								</div>

								<div id="fullpackageState">
									
								</div>
                            </div>

                            <div class="tab-pane fade pt-3" id="batch">
                                <div class="mb-5" id="emptybatchState">
	                            	<div class="container">
			                            <div class="row align-items-center justify-content-center">
			                                <div class="col-6  text-center">
			                                    <img src="{{ asset('assets/img/empty_batch.svg') }}" class="img-fluid text-center">
			                                </div>
			                            </div>
			                        </div>
			                        <h2 class="text-center"> {{ __("No Batch Found") }} </h2>
			                        <p class="text-center"> {{ __("There have been no batch in this section yet.") }} </p>
			                    </div>
			                    
                                <div class="d-grid gap-2 col-4 mx-auto mb-2">
								  	<button class="btn btn-outline-primary createbatchBtn" type="button"> 
								  		<i class="bi bi-plus-lg pe-1"></i> 
								  		{{ __("Add Batch") }} 
								  	</button>
								</div>

								<div id="fullbatchState">
									<div class="row g-2">
										
									</div>
								</div>
                            </div>

                            <div class="tab-pane fade pt-3" id="assignteacher">
                                <div class="mb-5" id="emptyassignteacherState">
	                            	<div class="container">
			                            <div class="row align-items-center justify-content-center">
			                                <div class="col-6  text-center">
			                                    <img src="{{ asset('assets/img/empty_assignteacher.svg') }}" class="img-fluid text-center">
			                                </div>
			                            </div>
			                        </div>
			                        <h2 class="text-center"> {{ __("No Assign Teacher Found") }} </h2>
			                        <p class="text-center"> {{ __("There have been no teacher assign in this section yet.") }} </p>
			                    </div>

			                    <div class="d-grid gap-2 col-4 mx-auto mb-2">
								  	<button class="btn btn-outline-primary createassignteacherBtn" type="button"> 
								  		<i class="bi bi-plus-lg pe-1"></i> 
								  		{{ __("Add Assign Teacher") }} 
								  	</button>
								</div>

								<div id="fullassignteacherState">
									<div class="row">
										<div class="col-12">
              								<div class="accordion" id="accordionExample">
              									
											</div>
										</div>
									</div>
								</div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
	    </div>
	</section>

<!-- Package Modal -->
<div class="modal fade" id="packageModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
	            <form class="row g-3">
                	<input type="hidden" name="sectionid" id="inputsectionId" value="{{ $section->id }}">
	            	<input type="hidden" name="id" id="inputPackageid">

		            <div class="modal-body">
					    <div class="row form-group mb-3" id="installmentPart">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group" id="gradeDiv">
                            	<label for="inputPrice" class="mb-2"> {{ __("Total Fees") }} *</label>
	                            <input type="text" placeholder="" class="form-control" id="inputPrice" name="price">

	                            <span class="n_err_price error d-block text-danger"></span>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group" id="gradeDiv">
                            	<label for="inputCurrency"> {{ __("Currency") }} *</label>
	                            <select class="currency_select2" name="currencyid" id="inputCurrency">
	                                @foreach($currencies as $currency)
	                                	<option data-currency="{{ $currency->symbol }}" value="{{ $currency->id }}"> 
	                                		{{ $currency->name }}-{{ $currency->symbol }}  
	                                	</option>
	                                @endforeach
	                            </select>

	                            <span class="n_err_price error d-block text-danger"></span>
                            </div>
                            
                        </div>

					    <div class="row form-group mb-3" id="packageinterrogationDiv">
					        <div class="col-12 mb-3">
                                <label> {{ __("Is there an installment in this section?") }} </label>
                            </div>
                            <div class="col-12">
                                <div class="toggle-wrapper">
                                    <input id="example" class="toggle" type="checkbox" name="teacherstatus" />
                                    <label for="example" class="toggle--label"></label>
                                    <div class="foux-toggle"></div>
                                </div>
                            </div>

					    </div>

					    <div class="row form-group mb-3" id="packageDiv">

		                        <div class="col-12 ">
		                            <div class="d-grid gap-2 d-md-flex justify-content-md-end packagelistbuttonDiv">
		                                <button class="btn btn-dark btn-sm addpackageBtn float-end packagelistbuttonDiv" type="button"> 
		                                    <i class="bi bi-plus-lg"></i> {{ __("Add Another package") }} 
		                                </button>
		                            </div>
		                        </div>  



	                            <div class="row mt-3" id="originalcurriculumDiv">
	                                <div class="col-xl-6 col-lg-6 col-12 form-group mb-3">
	                                    <label for="inputInstallment" class="mb-2">{{ __("Installment Title") }} *</label>
	                                    <input type="text" name="installment[]" id="inputInstallment" class="form-control" placeholder="e.g First Installment">

	                                    <span class="n_err_installment error d-block text-danger"></span>
	                                    

	                                </div>
	                                
	                                <div class="col-xl-6 col-lg-6 col-12 form-group mb-3">
	                                    <label for="inputAmount" class="mb-2">{{ __("Amount") }} *</label>
	                                    <input type="number" name="amount[]" id="inputAmount" class="form-control">

	                                    <span class="n_err_amount error d-block text-danger"></span>

	                                </div>

	                                <div class="col-xl-12 col-lg-12 col-12 form-group mb-3">
	                                    <label for="inputDescription" class="mb-2">{{ __("Description") }} *</label>
	                                    <textarea class="form-control" name="description[]" id="inputDescription"></textarea>

	                                    <span class="n_err_description error d-block text-danger"></span>

	                                </div>

	                                <hr>                                    

	                            </div>

	                            <div id="clonepackageDiv"></div>



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

<!-- Batch Modal -->
<div class="modal fade" id="batchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="new-added-form">
                <input type="hidden" name="sectionid" id="inputsectionId" value="{{ $section->id }}">

                <input type="hidden" name="id" id="inputBatchid">
                <input type="hidden" name="color" id="inputColorpicker">



                <div class="modal-body">
                    
                    <div class="row form-group mb-3">
                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
                        	<label for="inputCodeno" class="mb-2"> {{ __("Codeno") }} *</label>
                            <input type="text" placeholder="" class="form-control" id="inputCodeno" name="codeno">

                            <span class="err_codeno error d-block text-danger"></span>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group">
                            <label for="inputName" class="mb-2"> {{ __("Batch Name") }} *</label>
                            <input type="text" placeholder="E.g Class-A" class="form-control" id="inputName" name="name">

                            <span class="err_name error d-block text-danger"></span>
                        </div>
                        
                    </div>

                    <div class="row form-group mb-3">
                        <div class="col-12 form-group">
                            <label for="inputColor" class="mb-2"> {{ __("Choose Color") }} *</label>
                            <div class='color-picker'></div>

                            <span class="n_err_color error d-block text-danger"></span>
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

<!-- Assign Teacher Modal -->
<div class="modal fade" id="assignteacherModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ __("Assign Teacher") }} </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="new-added-form">
                <input type="hidden" name="sectionid" id="inputsectionId" value="{{ $section->id }}">
                <input type="hidden" name="id" id="inputteachersegmentId">


                <div class="modal-body">
                    <div class="row form-group mb-3">
                        <div class="col-12 form-group">
                            <label for="inputBatch" class="mb-2"> {{ __("Choose Batch") }} *</label>
                            <select class="select2 batch" name="batch" id="inputBatch">
                                
                            </select>

                            <span class="err_batch error d-block text-danger"></span>
                        </div>
                    </div>


                    <div class="row form-group mb-3" id="assignSelection">
                        <div class="col-12 form-group">
                            <label for="inpuSubject" class="mb-2"> {{ __("Choose Subject") }} *</label>
                            <select class="subject_select2 subject" name="subject" id="inputSubject">
                                <option></option>
                                @foreach($curricula as $curriculum)
                                	<option value="{{ $curriculum->subject->id }}">
                                		{{ $curriculum->subject->name }}|{{ $curriculum->subject->otherlanguage }}|{{ $curriculum->type }}
                                	</option>
                                @endforeach
                            </select>

                            <span class="err_subject error d-block text-danger"></span>

                        </div>
                    </div>

                    <div class="row form-group mb-3">
                    	<div class="col-12 form-group">
                            <label for="inputTeacher" class="mb-2"> {{ __("Choose Teacher") }} *</label>
                            <select class="select2 teacher" name="teacher" id="inputTeacher" disabled="">
                            </select>

                            <span class="err_teacher error d-block text-danger"></span>

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

@section('script_content')
    <script type="text/javascript">
    	var installment; var pickcolor;
        var sectionid = "{{ $section->id }}";

        $(document).ready(function() {
        	getTotalinstallment();
        	getPackageinstallments();
        	getBatches();
        	getAssignteachers();

        	var currentLanguage = "{{  Config::get('app.locale') }}";

        	if (currentLanguage == "mm") {
            	var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";
            	var remove_toggle_text = "ဖယ်ရှားပါ။";
            	var edit_toggle_text = "ပြင်ဆင်ရန်";
            	var detail_toggle_text= "အသေးစိတ်ကြည့်ရန်";
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
            	var remove_toggle_text = "削除";
            	var edit_toggle_text = "編集";
            	var detail_toggle_text= "詳細";
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
            	var remove_toggle_text = "消除";
            	var edit_toggle_text = "编辑";
            	var detail_toggle_text= "细节";
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
            	var remove_toggle_text = "Entfernen";
            	var edit_toggle_text = "Bearbeiten";
            	var detail_toggle_text= "Detail";
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
            	var remove_toggle_text = "Retirer";
            	var edit_toggle_text = "Éditer";
            	var detail_toggle_text= "Détail";
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
            	var remove_toggle_text = "Remove";
            	var edit_toggle_text = "Edit";
            	var detail_toggle_text= "Detail";
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
                dropdownParent: $("#assignteacherModal")
            });

        // Installment
            function getTotalinstallment(){
            	return $.ajax({
                    type:'POST',
                    url: "/getTotalinstallment_bysectionid",
                    data: {sectionid:sectionid},
                    dataType: 'json',
                    success: (response) => { 
                    	var section = response; 
                    	installment = response;
                        var price = CommaFormatted(section.price.toString());
                        var currencysymbol = section.currency.symbol;
                        var currency = section.currency.name;
                        console.log(section);
                        if(price){
                        	$('#emptyinstallmentState').removeClass('d-block');
        					$('#emptyinstallmentState').addClass('d-none');

        					$('#fullinstallmentState').removeClass('d-none');
        					$('#fullinstallmentState').addClass('d-block');


        					$('#installmentPart').hide();
        					$('#packageinterrogationDiv').hide();
        					$('#packageDiv').show();



                        	$('.totalAmount').html(price);
                        	$('.currencysymbol').html(currencysymbol);
                        	$('.currency').html(currency);


                        }else{
        					$('#emptyinstallmentState').removeClass('d-none');
        					$('#emptyinstallmentState').addClass('d-block');

        					$('#fullinstallmentState').removeClass('d-block');
        					$('#fullinstallmentState').addClass('d-none');

        					$('#installmentPart').show();
        					$('#packageinterrogationDiv').show();
        					$('#packageDiv').hide();

                        }


                    }
                });
            }

            function getPackageinstallments(){
            	return $.ajax({
                    type:'POST',
                    url: "/getPackageinstallments_bysectionid",
                    data: {sectionid:sectionid},
                    dataType: 'json',
                    success: (response) => {  
                        var packages = response;
                        var html ='';
                        console.log(packages);
                        if(packages.length > 0){
                        	$('#emptypackageState').removeClass('d-block');
                        	$('#emptypackageState').addClass('d-none');

        					$('#fullpackageState').removeClass('d-none');
        					$('#fullpackageState').addClass('d-block');


	                        $.each(packages, function(i,v){
	                        	var id = v.id;
	                        	var installment = v.installment;
	                        	var amount = CommaFormatted(v.amount.toString());
	                        	var description = v.description;
                        		var currencysymbol = v.section.currency.symbol;


	                            html += `<div class="row g-2 ">
										    <div class="col-12 ">
										        <div class="alert bg-secondary bg-opacity-10" role="alert">
										        	<div class="d-flex justify-content-between">
										        		<div>
														  	<h6> ${installment} </h6>
														  	<p class="text-muted">${description}</p>
														</div>
														<div>
															<button type="button" class="btn btn-warning btn-sm me-2 package_editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="${edit_toggle_text}" data-id="${id}" data-installment="${installment}" data-amount="${v.amount}" data-description="${description}">
							                                    <i class="bi bi-gear-fill"></i> 
							                                </button>
							                                <button type="button" class="btn btn-danger btn-sm me-2 package_deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="${remove_toggle_text}" data-id="${id}">
							                                    <i class="bi bi-x-lg"></i> 
							                                </button>
														</div>
													</div>
												  	<hr>
												  	<p class="mb-0 price">${amount} ${currencysymbol}</p>
												</div>
										    </div>
										</div>`;
	                        });

	                        $('#fullpackageState').html(html);
	                    }else{

        					$('#emptypackageState').addClass('d-block');
        					$('#emptypackageState').removeClass('d-none');

        					$('#fullpackageState').addClass('d-none');
        					$('#fullpackageState').removeClass('d-block');


	                    }


                    }
                });
            }

            function setCurrency(obj) {
			    var data = $(obj.element).data();
		        var text = $(obj.element).text();
		        var text_arr = text.split("-");

		        var country = text_arr[0];
		        var currency = text_arr[1];
		        console.log(text);

			    template = $("<div>"+ 
	                        "<span>" + country + "</span> <span class='badge bg-warning text-dark float-end'>"+ currency +" </span> </p></div>");
	            return template;
			};

            $('.currency_select2').select2({
            	'templateSelection': setCurrency,
	        	'templateResult': setCurrency,
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
                dropdownParent: $("#packageModal")
            });
			
			$('#installment').on('click','.createpackageBtn', function(){
		        $("#packageModal").modal("show");
                $("#packageModal .modal-title").text(n_modal_title);
		        $("#packageModal form").attr('id', 'addForm');

		    });

			$('#packageModal').on('change','#example', function(){

		        if($(this).is(":checked")) {
		            $('#packageDiv').show();
		        }
		        else {
		            $('#packageDiv').hide();

		        }
		    });

		    var max_fields = 10; //Maximum allowed input fields 
		    var x=1;
		    $('#packageModal').on('click','.addpackageBtn', function(e){

		        if(x <= max_fields){ 
		        
		            var html =` <section class="remove row"> <div class="col-xl-6 col-lg-6 col-12 form-group mb-3">
		                                    <label for="inputInstallment" class="mb-2">Installment Title *</label>
		                                    <input type="text" name="installment[]" id="inputInstallment" class="form-control" placeholder="e.g First Installment">

		                                    <span class="n_err_installment error d-block text-danger"></span>
		                                    

		                                </div>
		                                
		                                <div class="col-xl-6 col-lg-6 col-12 form-group mb-3">
		                                    <label for="inputAmount" class="mb-2">Amount *</label>
		                                    <input type="number" name="amount[]" id="inputAmount" class="form-control">

		                                    <span class="n_err_amount error d-block text-danger"></span>

		                                </div>

		                                <div class="col-xl-12 col-lg-12 col-12 form-group mb-3">
		                                    <label for="inputDescription" class="mb-2"> Description *</label>
		                                    <textarea class="form-control" name="description[]" id="inputDescription"></textarea>

		                                    <span class="n_err_description error d-block text-danger"></span>

		                                </div>`;


		            html += ` <a href="javascript:void(0)" class="btn btn-danger mt-2 d-inline-block" id="removepackageDiv"> Remove </a> <hr> </section>`;

		            $("#clonepackageDiv").append(html);
		            
		            x++; //input field increment

		        }
		    });

		    $("#clonepackageDiv").on("click","#removepackageDiv", function(e){ 
		        e.preventDefault();
		        $(this).parent('.remove').remove();
		        x--;

		    });

		    // Store
		    $("#packageModal").on('submit','#addForm',function(e){
		        e.preventDefault();
		        
		        var formData = new FormData(this);

		        $.ajax({
		            type:'POST',
		            url: '{{ route('master.package.store')}}',
		            data: formData,
		            cache:false,
		            contentType: false,
		            processData: false,
		            success: (data) => {  
		                // jQuery.noConflict();
		                getTotalinstallment();
        				getPackageinstallments();

		                $("#packageModal").modal("hide");
		                $('form').trigger("reset");
		                

        				Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

		                

		            },
		            error: function(error){
		                var message=error.responseJSON.message;
		                
		                //console.log(error.responseJSON.errors);
		                
		                
		            }
		        });
		    });

		    // EDIT
		    $("#fullpackageState").on('click','.package_editBtn',function(e){

		        var id = $(this).data('id');
		        var installment = $(this).data('installment');
		        var amount = $(this).data('amount');
		        var description = $(this).data('description');

		        $('#inputPackageid').val(id);
		        $('#inputInstallment').val(installment);
		        $('#inputAmount').val(amount);
		        $('#inputDescription').val(description);

                $("#packageModal .modal-title").text(e_modal_title);

		        $("#packageModal form").attr('id', 'editForm');

		        $("#packageModal").modal("show");
		    });

		    // UPDATE
		    $("#packageModal").on('submit','#editForm',function(e){
		        e.preventDefault();
		        
		        var formData = new FormData(this);

		        var id = $('#inputPackageid').val();

		        
		        var url="{{route('master.package.update',':id')}}";
                url=url.replace(':id',id);

		        $.ajax({
		            type:'POST',
		            dataType: 'json',
		            url: url,
		            data: formData,
		            cache:false,
		            contentType: false,
		            processData: false,
		            success: function (data){
		                
		               getPackageinstallments();

		                $("#packageModal").modal("hide");
		                $('form').trigger("reset");
		                

        				Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

		            },
		            error: function(error){
		            }
		        });

		        
		    });

		    // DELETE
		    $("#fullpackageState").on('click','.package_deleteBtn',function(e){

		        var id = $(this).data("id");
		        
		        var url="{{route('master.package.destroy',':id')}}";
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
		               					getPackageinstallments();
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
		    $("#fullinstallmentState").on('click','.installment_editBtn',function(e){

		        console.log(installment);
		        var id = installment.id;
		        var price = installment.price;
                var currencyid = installment.currency_id;

                console.log(currencyid);

		        $('#inputPackageid').val(id);
		        $('#inputPrice').val(price);
		        $("#inputCurrency").val(currencyid).change();


                $(".modal-title").text(e_modal_title);

		        $("form").attr('id', 'installment_editForm');

		        $('#installmentPart').show();
				$('#packageinterrogationDiv').hide();
				$('#packageDiv').hide();

		        $("#packageModal").modal("show");

		   	});

		    // UPDATE
		    $("#packageModal").on('submit','#installment_editForm',function(e){
		        e.preventDefault();
		        
		        var formData = new FormData(this);

		        var id = $('#inputPackageid').val();
		        
		        var url="{{route('master.sectioninstallment.update',':id')}}";
                url=url.replace(':id',id);

		        $.ajax({
		            type:'POST',
		            dataType: 'json',
		            url: url,
		            data: formData,
		            cache:false,
		            contentType: false,
		            processData: false,
		            success: function (data){
		                
		               	getTotalinstallment();
		               	$("#packageModal").modal("hide");
		                $('form').trigger("reset");

        				Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

		            },
		            error: function(error){
		            }
		        });
		    });

		// Batch

			function getBatches(){
            	return $.ajax({
                    type:'POST',
                    url: "/getBatches_bysectionid",
                    data: {sectionid:sectionid},
                    dataType: 'json',
                    success: (response) => {  
                        var batches = response;
                        var html =''; var batchhtml ='<option></option>';
                        if(batches.length > 0){
                        	$('#emptybatchState').removeClass('d-block');
                        	$('#emptybatchState').addClass('d-none');

        					$('#fullbatchState').removeClass('d-none');
        					$('#fullbatchState').addClass('d-block');


	                        $.each(batches, function(i,v){
	                        	var id = v.id;
	                        	var codeno = v.codeno;
	                        	var name = v.name;
                        		var color = v.color;


	                            html += `<div class="col-4">
											<div class="card text-white mb-3" style="background-color:${color}">
										    	<div class="card-body">
										    		<h5 class="card-title text-white">${codeno}</h5>
											    	<p class="card-text">${name}</p>
											  	</div>
										    	<div class="card-footer bg-transparent d-grid gap-2 d-md-flex justify-content-md-end">
										    		<a href="" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="${edit_toggle_text}">
														<i class="bi bi-info-lg"></i>
													</a>
													<a href="javascript:void(0)" class="btn btn-warning btn-sm batch_editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="${edit_toggle_text}" data-id="${id}" data-codeno="${codeno}" data-name="${v.name}" data-color="${v.color}">
														<i class="bi bi-gear-fill"></i>
													</a>
													<a href="javascript:void(0)" class="btn btn-danger btn-sm batch_deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="${remove_toggle_text}" data-id="${id}">
														<i class="bi bi-x-lg"></i>
													</a>
												</div>
											</div>
										</div>`;

								batchhtml +=`<option value="${v.id}">${v.name}</option>`;
	                        });

	                        $('#fullbatchState > div').html(html);
	                        $('#inputBatch').html(batchhtml);

	                    }else{

        					$('#emptybatchState').addClass('d-block');
        					$('#emptybatchState').removeClass('d-none');

        					$('#fullbatchState').addClass('d-none');
        					$('#fullbatchState').removeClass('d-block');


	                    }


                    }
                });
            }

            $('#batch').on('click','.createbatchBtn', function(){
		        $("#batchModal").modal("show");
                $("#batchModal .modal-title").text(n_modal_title);
		        $("#batchModal form").attr('id', 'addForm');

				$('#inputColorpicker').val('#0A6C96');

		        const pickr = Pickr.create({
				    el: '.color-picker',
				    showAlways: true,
				    inline: true,
				    container: 'body',
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

				pickr.on('change', (color, source, instance) => {
				   	const hex = color.toHEXA();
				    const hexcolor = '#' + hex[0] + hex[1] + hex[2];

				    $('#inputColorpicker').val(hexcolor);

				})

		    });

            // Store
		    $("#batchModal").on('submit','#addForm',function(e){
		        e.preventDefault();
		        
		        var formData = new FormData(this);

		        $.ajax({
		            type:'POST',
		            url: '{{ route('master.batch.store')}}',
		            data: formData,
		            cache:false,
		            contentType: false,
		            processData: false,
		            success: (data) => {  
		            	$('.err_name').html('');
                        $('#inputName').removeClass('border border-danger');
                        
                        $('.err_codeno').html('');
                        $('#inputCodeno').removeClass('border border-danger');

		                // jQuery.noConflict();
		                getBatches();

		                $("#batchModal").modal("hide");
		                $('form').trigger("reset");
		                

        				Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

		                

		            },
		            error: function(error){
		                var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "name") 
                            {
                                $('.err_name').html(err[key]);
                                $('#inputName').addClass('border border-danger');
                            }

                            if (key == "codeno") 
                            {
                                $('.err_codeno').html(err[key]);
                                $('#inputCodeno').addClass('border border-danger');
                            }
                            
                        });
		                
		                //console.log(error.responseJSON.errors);
		                
		                
		            }
		        });
		    });

		    // EDIT
            $("#fullbatchState").on('click','.batch_editBtn',function(e){

                var id = $(this).data('id');
                var codeno = $(this).data('codeno');
                var name = $(this).data('name');
                var color = $(this).data('color');

                $('#inputBatchid').val(id);
                $('#inputPackageid').val(id);
                $('#inputCodeno').val(codeno);
                $('#inputName').val(name);
                $('#inputColorpicker').val(color);

                $("#batchModal .modal-title").text(e_modal_title);

                $("#batchModal form").attr('id', 'editForm');

                $("#batchModal").modal("show");

	                const editpickr = Pickr.create({
					    el: '.color-picker',
					    showAlways: true,
					    inline: true,
					    container: 'body',
					    outputPrecision: 0,
					    position: 'bottom-middle',
					    default: color,
					    comparison: false,
					    components: {
					        hue: true,
					        interaction: {
					            hex: true,
					            input: true,
					        }
					    }
					});

					editpickr.on('change', (color, source, instance) => {
					   	const hex = color.toHEXA();
					    const hexcolor = '#' + hex[0] + hex[1] + hex[2];

					    $('#inputColorpicker').val(hexcolor);

					})

                
            });
		    
		    // UPDATE
            $("#batchModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputBatchid').val();

                console.log(id);

                
                var url="{{route('master.batch.update',':id')}}";
                url=url.replace(':id',id);

                $.ajax({
                    type:'POST',
                    dataType: 'json',
                    url: url,
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function (data){
                        
                       getBatches();

                        $("#batchModal").modal("hide");
                        $('form').trigger("reset");
                        

                        Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

                    },
                    error: function(error){
                    }
                });

                
            });

            // DELETE
            $("#fullbatchState").on('click','.batch_deleteBtn',function(e){

                var id = $(this).data("id");
                
                var url="{{route('master.batch.destroy',':id')}}";
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
                                        getBatches();
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

        // Assign Teacher

        	function getAssignteachers() {
        		return $.ajax({
                    type:'POST',
                    url: "/getTeachersegments_bysectionid",
                    data: {sectionid:sectionid},
                    dataType: 'json',
                    success: (response) => {  
                        var assignteachers = response;
                        var html ='';
                        console.log(response);
                        if(assignteachers.length > 0){
                        	$('#emptyassignteacherState').removeClass('d-block');
                        	$('#emptyassignteacherState').addClass('d-none');

        					$('#fullassignteacherState').removeClass('d-none');
        					$('#fullassignteacherState').addClass('d-block');

	                        $.each(assignteachers, function(i,v){
	                        	var id = v.id;
	                        	var batch_name = v.name;
	                        	var batch_codeno = v.codeno;
	                        	var batch_color = v.color;
	                        	if (i == 0) {
	                        		var collapse_show = "show";
	                        		var collapse = "";	                        	
	                        	}else{
	                        		var collapse = "collapsed";
	                        		var collapse_show = "";
	                        	}

	                        	var teachersegments = v.teachersegment;


	                            html += `<div class="accordion-item">
											<h2 class="accordion-header text-primary" id="heading${id}">
										        <button class="accordion-button ${collapse} " type="button" data-bs-toggle="collapse" data-bs-target="#collapse${id}" aria-expanded="true" aria-controls="collapse${id}"> 
										        	${batch_name} 
										        	<span class="badge ms-3" style="background-color: ${batch_color}"> ${batch_codeno}</span>
										        </button>
										    </h2>
										    <div id="collapse${id}" class="accordion-collapse collapse ${collapse_show}" aria-labelledby="heading${id}" data-bs-parent="#accordionExample">
										        <div class="accordion-body">
										            <ul class="list-group">
										            `;


								$.each(teachersegments, function(i1,v1){

									var curriculum_type = v1.curriculum.type;
									var teacher = v1.staff.user.name;
									var teacher_profile = v1.staff.user.profile_photo_path;
									var profile_url = '{{ URL::asset('') }}';

									var subject_name = v1.curriculum.subject.name;
									var subject_otherlanguage = v1.curriculum.subject.otherlanguage;

                               		html += `
		                                <li class="list-group-item "> 
		                                	<div class="d-flex justify-content-between flex-wrap align-items-center">
		                                		<div class="d-flex flex-wrap align-items-center">
		                                			<div class="avatar me-3">
		                                				<img src="${profile_url+teacher_profile}" class="rounded-circle"> 
		                                			</div>
		                                			<div class="d-flex flex-column">
		                                				<span> ${teacher} </span>
		                                				<span class="text-muted "> 
		                                					${subject_name}
										    				<small class="ps-3">( ${subject_otherlanguage} )</small>
										    			</span>
		                                			</div>
		                                		</div>
		                                		<div>
		                                			<button type="button" class="btn btn-outline-danger btn-sm float-end assignteacher_deleteBtn" data-id="${id}"> 
			                                            <i class="bi bi-x-lg"></i> ${remove_toggle_text} 
			                                        </button>
		                                		</div>
											</div>		
										    
		                                </li>`;

		                        })
		                                            
		                        html += `</ul>
									    </div>
										</div>
									   	</div>`;

	                        });
	                        $('#fullassignteacherState div#accordionExample').html(html);

	                    }else{

        					$('#emptyassignteacherState').addClass('d-block');
        					$('#emptyassignteacherState').removeClass('d-none');

        					$('#fullassignteacherState').addClass('d-none');
        					$('#fullassignteacherState').removeClass('d-block');


	                    }


                    }
                });
        	}

		    function formatSelected(obj) {
		    	var data = $(obj.element).data();
		        var text = $(obj.element).text();
		        var text_arr = text.split("|");

		        var subject = text_arr[0];
		        var otherlanguage = text_arr[1];
		        var curriculumtype = text_arr[2];

		        console.log(text);
		        if(subject){
			    	template = $(`<div class="d-flex align-items-center justify-content-between">
			    					<div>
				    					<span class="d-block"> ${subject} </span>
				    					<small class="text-muted"> ${otherlanguage} </small>
				    				</div>
				    				<div>
			    						<span class='badge bg-warning text-dark float-end'>${curriculumtype} </span>
			    					</div>
			    				</div>`);
			    }else{

			    	template = placeholder_title;
			    }

	            return template;

		    };
		    $('.subject_select2').select2({
		        templateResult: formatSelected,
		        templateSelection: formatSelected,
		        width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
                dropdownParent: $("#assignteacherModal")
		    });

	        $('#assignteacher').on('click','.createassignteacherBtn', function(){
		        $("#assignteacherModal").modal("show");
                $("#assignteacherModal .modal-title").text(n_modal_title);
		        $("#assignteacherModal form").attr('id', 'addForm');

		    });

		    $('#inputSubject').change(function (e) {
		        var sid = $(this).val();

		        console.log(sid);

		        teacherChange(sid);
		    });

		    function teacherChange(sid){
		        $('#inputTeacher').prop('disabled',false);

		        $.ajax({
		            url: "/getUser_bysubjectid",
		            type:'POST',
		            data: { id:sid }
		        }).done(function(data){
		            var teachers = data;
		            var teacherhtml ='';

		            $.each(teachers,function (i,v) {
		                teacherhtml +=`<option value="${v.id}">${v.name}</option>`;
		            });

		            $('#inputTeacher').html(teacherhtml);
		        });

		        
		    }

            // Store
		    $("#assignteacherModal").on('submit','#addForm',function(e){
		        e.preventDefault();
		        
		        var formData = new FormData(this);

		        $.ajax({
		            type:'POST',
		            url: '{{ route('master.teachersegment.store')}}',
		            data: formData,
		            cache:false,
		            contentType: false,
		            processData: false,
		            success: (data) => {  
		            	$('.err_batch').html('');
                        $('#inputBatch').removeClass('border border-danger');
                        
                        $('.err_subject').html('');
                        $('#inputSubject').removeClass('border border-danger');

                        $('.err_teacher').html('');
                        $('#inputTeacher').removeClass('border border-danger');

		                // jQuery.noConflict();
		                getAssignteachers();

		                $("#assignteacherModal").modal("hide");
		                $('form').trigger("reset");
		                

        				Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

		                

		            },
		            error: function(error){
		                var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "batch") 
                            {
                                $('.err_batch').html(err[key]);
                                $('#inputBatch').addClass('border border-danger');
                            }

                            if (key == "subject") 
                            {
                                $('.err_subject').html(err[key]);
                                $('#inputSubject').addClass('border border-danger');
                            }

                            if (key == "teacher") 
                            {
                                $('.err_teacher').html(err[key]);
                                $('#inputTeacher').addClass('border border-danger');
                            }
                            
                        });
		                
		                //console.log(error.responseJSON.errors);
		                
		                
		            }
		        });
		    });

		    // DELETE
            $("#fullassignteacherState").on('click','.assignteacher_deleteBtn',function(e){

                var id = $(this).data("id");
                
                var url="{{route('master.teachersegment.destroy',':id')}}";
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
                                        getAssignteachers();
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

		function CommaFormatted(amount) 
	    {
	        var delimiter = ","; // replace comma if desired
	        var a = amount.split('.',2)
	        var i = parseInt(a[0]);
	        
	        if(isNaN(i)) 
	        {
	            return ''; 
	        }
	        
	        var minus = '';
	        
	        if(i < 0) 
	        {
	            minus = '-'; 
	        }
	        
	        i = Math.abs(i);
	        var n = new String(i);

	        var a = [];
	        
	        while(n.length > 3) {
	            var nn = n.substr(n.length-3);
	            a.unshift(nn);
	            n = n.substr(0,n.length-3);
	        }

	        if(n.length > 0) 
	        { 
	            a.unshift(n); 
	        }
	        n = a.join(delimiter);

	        amount = minus + amount;

	        // console.log(n);

	        return n;

	    }


    </script>

@stop


</x-template>