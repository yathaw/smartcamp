<x-template>
	<div class="pagetitle">
	    <h1> {{ __("Curricula")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("All Curricula")}}</li>
	        </ol>
	    </nav>
	</div>

	@if($curriculum_exists)
		<section class="section" id="fullState">
		    <div class="row">
		        <div class="col-lg-12">
		            <div class="card">
		            	<div class="card-header row align-items-center">
		            		<div class=" col-12">
		                    	{{ __("All Lists")}}
		            		</div>
		            	</div>

		                <div class="card-body pt-4">
		                	<div class="row">
			                    <div class="col-12">
			                        <div class="accordion" id="accordionExample">

			                            @foreach($grades as $key => $grade)
			                            @php
                                        	$extraStatus = false;
                                            $extraCurricula = $grade->curricula->toArray();
                                        	if(array_search('Extra', array_column($extraCurricula, 'type'), true)){
                                        		$extraStatus = true;
                                        	}

                                        @endphp
			                            <div class="accordion-item">
			                                <p class="accordion-header" id="heading{{ $key }}">
			                                    <button class="accordion-button @if($key != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
			                                        {{ $grade->name }}
			                                    </button>
			                                </p>
			                                <div id="collapse{{ $key }}" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
			                                    <div class="accordion-body row g-5 p-5">
			                                        
			                                        @if(count($grade->subjecttypes) > 0)
		                                                @foreach($grade->subjecttypes as $subjecttype)
		                                                    <h3 class="d-inline-block"> 
		                                                        {{ $subjecttype->name }}
		                                                        <span class="">( {{ $subjecttype->otherlanguage }} ) </span>
		                                                    </h3>

		                                                    <div class="@if($extraStatus) col-xl-6 col-lg-6 col-md-6 @endif col-sm-12 col-12">

		                                                        <ul class="list-group">
		                                                            <li class="list-group-item list-group-item-success fw-bold" aria-current="true"> 
		                                                            	Main Curriculum 
	                                                            		<a href="javascript:void(0)" class="btn btn-light btn-sm sortingBtn float-end" data-id="{{ $grade->id }}" data-type="Main" data-subjecttype="{{ $subjecttype->id }}" > 
											                                <i class='bx bx-sort'></i> {{ __("Sorting")}}
											                            </a>
		                                                            </li>
		                                                            @php 
		                                                            	$x = 1; 

		                                                            	$curricula = $grade->curricula->sortBy('sorting');
		                                                            @endphp
		                                                            @foreach($curricula as $curriculum)
		                                                                @if($curriculum->type == 'Main' && $curriculum->subjecttype_id == $subjecttype->id)
		                                                                    <li class="list-group-item"> 
		                                                                        <span class="pe-3"> {{ $x++ }}. </span>
		                                                                        {{ $curriculum->subject->name }} 
		                                                                        <small class="ps-3"> ( {{ $curriculum->subject->otherlanguage }} ) </small>

		                                                                        <button type="button" class="btn btn-outline-danger btn-sm float-end deleteBtn" data-id="{{ $curriculum->id }}"> 
		                                                                            <i class="bi bi-x-lg"></i> Delete 
		                                                                        </button>
		                                                                    </li>
		                                                                @endif
		                                                            @endforeach
		                                                        </ul>
		                                                    </div>
		                                                    @if($extraStatus)
		                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
		                                                        <ul class="list-group">
		                                                            <li class="list-group-item list-group-item-warning fw-bold" aria-current="true"> 
		                                                            	{{ __("Extra Curriculum") }}
		                                                            	<a href="javascript:void(0)" class="btn btn-light btn-sm sortingBtn float-end" data-id="{{ $grade->id }}" data-type="Extra" data-subjecttype="{{ $subjecttype->id }}"> 
											                                <i class='bx bx-sort'></i> {{ __("Sorting")}}
											                            </a>
		                                                            </li>
		                                                            @php 
		                                                            	$y = 1;
		                                                            	$curricula = $grade->curricula->sortBy('sorting'); 
		                                                            @endphp
		                                                            @foreach($curricula as $curriculum)
		                                                                @if($curriculum->type == 'Extra' && $curriculum->subjecttype_id == $subjecttype->id)
		                                                                    <li class="list-group-item"> 
		                                                                        <span class="pe-3"> {{ $y++ }}. </span>
		                                                                        {{ $curriculum->subject->name }} 
		                                                                        <small class="ps-3"> ( {{ $curriculum->subject->otherlanguage }} ) </small>

		                                                                        <button type="button" class="btn btn-outline-danger btn-sm float-end deleteBtn" data-id="{{ $curriculum->id }}"> 
		                                                                            <i class="bi bi-x-lg"></i> {{ __("Delete") }} 
		                                                                        </button>
		                                                                    </li>
		                                                                @endif
		                                                            @endforeach
		                                                        </ul>
		                                                    </div>
		                                                    @endif
		                                                @endforeach
			                                        @else
			                                        <div class="@if($extraStatus) col-xl-6 col-lg-6 col-md-6 @endif col-sm-12 col-12">

			                                            <ul class="list-group">
			                                                <li class="list-group-item list-group-item-success fw-bold" aria-current="true"> 
			                                                	{{ __("Main Curriculum") }} 
			                                                	<a href="javascript:void(0)" class="btn btn-light btn-sm sortingBtn float-end" data-id="{{ $grade->id }}" data-type="Main" data-subjecttype="NULL"> 
									                                <i class='bx bx-sort'></i> {{ __("Sorting")}}
									                            </a>
			                                                </li>
			                                                @php 
			                                                	$x = 1; 
			                                                	$curricula = $grade->curricula->sortBy('sorting');
			                                                @endphp
			                                                @foreach($curricula as $curriculum)
			                                                    @if($curriculum->type == 'Main')
			                                                        <li class="list-group-item"> 
			                                                            <span class="pe-3"> {{ $x++ }}. </span>
			                                                            {{ $curriculum->subject->name }} 
			                                                            <small class="ps-3"> ( {{ $curriculum->subject->otherlanguage }} ) </small>

			                                                            <button type="button" class="btn btn-outline-danger btn-sm float-end deleteBtn" data-id="{{ $curriculum->id }}"> 
			                                                                <i class="bi bi-x-lg"></i> Delete 
			                                                            </button>
			                                                        </li>
			                                                    @endif
			                                                @endforeach
			                                            </ul>
			                                        </div>
		                                            @if($extraStatus)

			                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
			                                            <ul class="list-group">
			                                                <li class="list-group-item list-group-item-warning  fw-bold" aria-current="true"> 
			                                                	Extra Curriculum 

				                                                	<a href="javascript:void(0)" class="btn btn-light btn-sm sortingBtn float-end" data-id="{{ $grade->id }}" data-type="Extra" data-subjecttype="NULL"> 
										                                <i class='bx bx-sort'></i> {{ __("Sorting")}}
										                            </a>
			                                                </li>
			                                                @php 
			                                                	
			                                                	$y = 1;
			                                                	$curricula = $grade->curricula->sortBy('sorting')
			                                                @endphp
			                                                @foreach($curricula as $curriculum)
			                                                    @if($curriculum->type == 'Extra')
			                                                        <li class="list-group-item"> 
			                                                            <span class="pe-3"> {{ $y++ }}. </span>
			                                                            {{ $curriculum->subject->name }} 
			                                                            <small class="ps-3"> ( {{ $curriculum->subject->otherlanguage }} ) </small>

			                                                            <button type="button" class="btn btn-outline-danger btn-sm float-end deleteBtn" data-id="{{ $curriculum->id }}"> 
			                                                                <i class="bi bi-x-lg"></i>  Delete 
			                                                            </button>
			                                                        </li>
			                                                    @endif
			                                                @endforeach
			                                            </ul>
			                                        </div>
			                                        @endif

			                                        @endif
			                                    </div>
			                                </div>
			                            </div>
			                            @endforeach

			                        </div>
			                    </div>
			                </div>

		                    
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
	@else

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
	                    <h2> {{ __("No Curricula Data Found") }} </h2>
	                    <p> {{ __("There have been no curricula in this section yet. Please add some subjects first.") }} </p>

	                    <div class="d-grid gap-2 col-6 mx-auto my-5">
						  	<a href="{{ route('master.curriculum.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Curricula")}} </a>
						</div>

	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	@endif

<!-- Position Sorting Modal -->
<div class="modal fade" id="sortingModal" tabindex="-1" aria-labelledby="sortingmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sortingmodalTitle"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="positionsortingForm">

                <div class="modal-body">
                    <div class="row">
                        <ul id="sortable">
                        </ul>
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
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var currentLanguage = "{{  Config::get('app.locale') }}";
            if (currentLanguage == "mm") {
            	var n_modal_title = "အသစ်ထည့်ရန်";
            	var e_modal_title = "ရှိပြီးသားကို ပြင်ဆင်ရန်";
            	var s_success_text = "အချက်အလက်များ အောင်မြင်စွာ သိမ်းဆည်း ပြီးပါပြီ";
            	var e_success_text ="အချက်အလက်များကိုအောင်မြင်စွာ ပြင်ဆင် ပြီးပါပြီ";
            	var d_confirm_text ="အချက်အလက်များကို စာရင်းမှပယ်ဖျက်မည်!";
            	var d_success_text = "အချက်အလက်များကိုအောင်မြင်စွာဖျက်ပစ်လိုက်ပြီ";
            	var d_cancel_text = "အချက်အလက်များသည်လုံခြုံစွာရှိနေပါသေးသည်။";
            	var confirm_btn_text = "ဟုတ်ကဲ့၊ ဖျက်လိုက်ပါ။";
            	var cancel_btn_text = "မလုပ်တော့ပါ။";
            	var sorting_modal_title="အစဥ်လိုက်စီစဥ်ခြင်း။";


            }
            else if(currentLanguage == "jp"){
            	var n_modal_title = "新しく追加する";
            	var e_modal_title = "既存の編集";
            	var s_success_text = "データが保存されました！";
            	var e_success_text = "データが更新されました！";
            	var d_confirm_text ="そのデータを削除すると、ネットワークから完全に削除されます。";
            	var d_success_text = "データが削除されました！";
            	var d_cancel_text = "あなたのデータは私たちのデータベースに保存されました！";
            	var confirm_btn_text = "はい、削除してください！";
            	var cancel_btn_text = "キャンセル";
            	var sorting_modal_title="部門の並べ替え";

            }
            else if(currentLanguage == "cn"){
            	var n_modal_title =  "添新";
            	var e_modal_title =  "编辑现有";
            	var s_success_text = "您的数据已保存！";
            	var e_success_text = "您的数据已更新！";
            	var d_confirm_text ="删除该数据会将其从您的网络中永久删除。";
            	var d_success_text = "您的数据已被删除！";
            	var d_cancel_text = "您的数据已保存在我们的数据库中！";
            	var confirm_btn_text = "是的，删除它！";
            	var cancel_btn_text = "取消";
            	var sorting_modal_title="部门排序";

            }
            else if(currentLanguage == "de"){
            	var n_modal_title = "Neue hinzufügen";
            	var e_modal_title = "Bestehende bearbeiten";
            	var s_success_text = "Ihre Daten wurden gespeichert!";
            	var e_success_text = "Ihre Daten wurden aktualisiert!";
            	var d_confirm_text ="Durch das Löschen dieser Daten werden sie dauerhaft aus Ihrem Netzwerk entfernt.";
            	var d_success_text = "Ihre Daten wurden gelöscht!";
            	var d_cancel_text = "Ihre Daten wurden in unserer Datenbank gespeichert!";
            	var confirm_btn_text = "Ja, löschen!";
            	var cancel_btn_text = "Abbrechen";
            	var sorting_modal_title="Abteilungssortierung";

            }
            else if(currentLanguage == "fr"){
            	var n_modal_title ="Ajouter nouveau";
            	var e_modal_title ="Modifier existant";
            	var s_success_text = "Vos données ont été enregistrées!";
            	var e_success_text = "Vos données ont été mises à jour !";
            	var d_confirm_text ="La suppression de ces données les supprimera définitivement de votre réseau.";
            	var d_success_text = "Vos données ont été supprimées !";
            	var d_cancel_text = "Vos données ont été sauvegardées dans notre base de données !";
            	var confirm_btn_text = "Oui, supprimez-le !";
            	var cancel_btn_text = "Annuler";
            	var sorting_modal_title="Tri par département";

            	
            }else{
            	var n_modal_title ="Add New";
            	var e_modal_title ="Edit Existing";
            	var s_success_text = "Your data was saved!";
            	var e_success_text = "Your data was updated!";
            	var d_confirm_text = "Deleting that data will permanently remove it from your network.";
            	var d_success_text = "Your data was deleted!";
            	var d_cancel_text = "Your data was safed in our database!";
            	var confirm_btn_text = "Yes, delete it!";
            	var cancel_btn_text = "Cancel";
            	var sorting_modal_title = "Sorting";

            }

            // DELETE
            $('.accordion-item').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.curriculum.destroy',':id')}}";
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


            $("#sortable").sortable();
            $("#sortable").disableSelection();

            // SORTING ~ sortingBtn

            $('.sortingBtn').on('click', function(){
                
                var gradeid = $(this).data('id');
                var type = $(this).data('type');
                var subjecttypeid = $(this).data('subjecttype');

                console.log('gradeid => '+gradeid);
                console.log('type => '+type);
                console.log('subjecttypeid => '+subjecttypeid);


                $.when(getCurricula(gradeid, type, subjecttypeid)).done(function(a1){
                    $("#sortingModal").modal("show");
                    $("#sortingmodalTitle").text(sorting_modal_title);
                    
                    $("form").attr('id', 'addForm');

                });
                
            });

            // STORE SORTING 
            $("#sortingModal").on('submit','#addForm',function(e){
                e.preventDefault();

                var x = ""; var curricula = []; var a=1;
                $("#sortable li").each(function (index, element) {
                    x = x + $(this).text() + " , ";
                    var pid = $(this).data();
                    var id = element.id;

                    curricula.push({
                        id: id,
                        sorting: a++,
                    });

                });

                console.log(curricula);
                
                $.ajax({
                    url: "{{ route('master.curriculum.store.sorting')}}",
                    data: {curricula:curricula},
                    type: "POST",
                    dataType: 'json',
                    success: function (data){
                        $("#sortingModal").modal("hide");

                        window.location.reload();
                    }
                });
            });

            function getCurricula(gradeid, type, subjecttypeid){
                return $.ajax({
                    type:'POST',
                    url: "/getCurricula_bygradeid",
                    data: {gradeid:gradeid, type:type, subjecttypeid:subjecttypeid},
                    dataType: 'json',
                    success: (response) => {  
                        var positions = response;
                        var html ='';
                        $.each(positions, function(i,v){
                        	var id = v.id;
                        	var name = v.subject.name;
                        	var otherlanguage = v.subject.otherlanguage;

                            html += `<li class="ui-state-default" id="${id}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> ${name} ( ${otherlanguage} ) </li>`;
                        });

                        $('#sortable').html(html);


                    }
                });

            }

        });
    </script>

@stop

</x-template>