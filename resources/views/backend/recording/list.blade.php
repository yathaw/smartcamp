<x-template>
	@php
        $authuser = Auth::user();
        $authRole = Auth::user()->getRoleNames()[0];
    @endphp
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Live Recording")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Live Recording")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">

	        	<div class="card">
	            	<div class="card-header row align-items-center">
		            	<div class="col-12">
		            		<form method="get" action="{{route('master.recording.index')}}" class="row">
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

	            @if(isset($recordings))
	            	<div class="card">
	            		<div class="card-body mt-3">
		            		<div class="row">
		            			@foreach($recordings as $recording)
		            			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12" >
	                            	<div class="card shadow-none border">
									  	
									  	<div class="card-body">
									  		<h5 class="card-title">{{ $recording->title }}</h5>

									  		<div class="d-grid gap-2">
											  	<a href="{{ route('master.recording.show', $recording->id) }}" class="btn btn-primary">
											  		<i class="bi bi-play-fill me-2"></i> View Video 
											  	</a>
											</div>
											@if(!in_array($authRole,["Guardian","Student"]))
											<div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
											  	
											  	<a href="javascript:void(0)" class="btn btn-outline-danger btn-sm deleteBtn" data-id="{{ $recording->id }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('Remove') }}" >
	                                                <i class="bi bi-x-lg"></i> 
	                                            </a>

											</div>
											@endif
									  	</div>
									</div>
	                            </div>
	                            @endforeach
		            		</div>
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

            $('.searchDiv').hide();


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
		                	if(selected_batchid == v.id){
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

		    // DELETE
            $('.card').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.recording.destroy',':id')}}";
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
                                }).always(function(){
                                window.location.reload();
                                

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