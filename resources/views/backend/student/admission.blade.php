<x-template>
	@php
        $authuser = Auth::user();
    @endphp
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Admission")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Admission")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
		    <div class="row">
		        <div class="col-lg-12">
		        	<div class="card">
		            	<div class="card-header row align-items-center">
		            		<div class="col-12">
		                    	{{ __("Assign Student To New Batch") }}
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

		                	<form class="new-added-form" action="{{ route('master.admission') }}" method="POST" enctype="multipart/form-data">
			                    @csrf
			                    
			                    <div class="row mb-3">
			                    	<div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12  form-group mb-3">
			                            <label class="mb-2" for="inputStudent">{{ __("Choose Student") }} * </label>
			                            <select class="select2 students" name="student" id="inputStudent">
			                            	<option></option>
			                            	@foreach($students as $student)
			                            		<option value="{{ $student->id }}" @if(isset($studentid)) selected @endif>
			                            			{{ $student->user->name }}
			                            		</option>
			                            	@endforeach
		                   				</select>

			                    	</div>
			                    </div>

			                    <div class="row mb-3">
			                    	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
	                                    <label for="inputRollno" class="form-label">{{ __("Roll No") }}</label>
	                                    <input type="text" name="rollno" id="inputRollno" class="form-control @if ($errors->has('rollno')) is-invalid @endif @if($errors->any() && !$errors->has('rollno')) is-valid @endif" value="{{ old('rollno') }}">

	                                    <p class="text-danger">
	                                        {{ $errors->first('rollno') }}
	                                    </p>
	                                </div>
			                    </div>


			                    <div class="row mb-3">

			                    	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">

			                    		<div class="col-12  form-group mb-3">
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

				                    	<div class="col-12  form-group mb-3">
				                            <label class="mb-2" for="inputSection">{{ __("Choose Section") }} * </label>
				                            <select class="select2" name="section" id="inputSection" disabled="">
			                   				</select>

				                    	</div>

				                    	<div class="col-12  form-group mb-3">
				                            <label class="mb-2" for="inputBatch">{{ __("Choose Batch") }} * </label>
				                            <select class="select2 batches" name="batch" id="inputBatch" disabled="">
			                   				</select>

				                    	</div>

			                    		<div class="col-12  form-group mb-3">
				                            <label class="mb-2" for="inputPackage">{{ __("Choose Payment Package") }} * </label>
				                            <select class="select2" name="package" id="inputPackage" disabled="">
			                   				</select>

				                    	</div>

				                    	<div class="col-12 form-group mb-3">
		                                    <label for="inputAmount" class="form-label">{{ __("Amount") }}</label>
		                                    <input type="number" name="amount" id="inputAmount" class="form-control @if ($errors->has('amount')) is-invalid @endif @if($errors->any() && !$errors->has('amount')) is-valid @endif" value="{{ old('amount') }}">

		                                    <p class="text-danger">
		                                        {{ $errors->first('amount') }}
		                                    </p>
		                                </div>

				                    	<div class="col-12  form-group mb-3">
				                            <label class="mb-2" for="inputPaymentdate">{{ __("Payment Date") }} * </label>
				                            <input class="form-control date" name="date" id="inputPaymentdate" >

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
	
	<script src="{{ asset('assets/js/syncscroll.js') }}"></script>
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

        	const date = document.querySelector('.date');
            new Datepicker(date, {
                autohide: true,
                'format': 'yyyy/mm/dd',
                // minDate: new Date(),

            });

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
		        pickPackage(section_id);

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

		   	function pickPackage(section_id){
		        $('#inputPackage').prop('disabled',false);

		        $.ajax({
		            url: "/getPackage_bysectionid",
		            type:'POST',
		            data: { id:section_id }
		        }).done(function(data){
		            var packages = data;
		            var packagehtml ='<option></option>';

		            $.each(packages,function (i,v) {
		                packagehtml +=`<option value="${v.id}">${v.installment}</option>`;
		            });

		            $('#inputPackage').html(packagehtml);

		        });
		    }

		    $('#inputPackage').change(function (e) {
		        var package_id = $(this).val();
		        
		        $.ajax({
		            url: "/getAmount_bypackageid",
		            type:'POST',
		            data: { id:package_id }
		        }).done(function(data){
		            var package = data;

		            $('#inputAmount').val(package.amount);

		        });

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