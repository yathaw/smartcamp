<x-template>
	<div class="pagetitle">
	    <h1> {{ __("Position & Departments")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Position & Departments")}}</li>
	        </ol>
	    </nav>
	</div>

	@if(count($departments) > 0)

	<!-- End Page Title -->
	<section class="section" id="fullState">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="card">
	            	<div class="card-header row align-items-center">
	            		<div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-12">
	                    	{{ __("All Lists")}}
	            		</div>
	            		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 gap-2">
	                    	<a href="javascript:void(0)" class="btn btn-outline-primary departmentcreateBtn px-4"> <i class="bi bi-plus-lg"></i> {{ __("Add New")}} </a>

	                    	@if(count($departments) > 1)
	                            <a href="javascript:void(0)" class="btn btn-outline-info px-4 departmentsortingBtn"> 
	                                <i class='bx bx-sort'></i> {{ __("Sorting")}}
	                            </a>
	                        @endif

	            		</div>
	            	</div>
	                <div class="card-body pt-3">
		                <div class="row">
		                    <div class="col-12">
		                        <div class="accordion" id="accordionExample">

		                            @foreach($departments as $key => $department)
		                            <div class="accordion-item">
		                                <p class="accordion-header" id="heading{{ $key }}">
		                                    <button class="accordion-button @if($key != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
		                                        {{ $department->name }}
		                                    </button>
		                                </p>
		                                <div id="collapse{{ $key }}" class="accordion-collapse collapse @if($key == 0) show @endif" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample">
		                                    <div class="accordion-body row g-5 p-5">
		                                        <div class="col-12">

		                                            <button type="button" class="btn btn-light departmenteditBtn" data-id="{{ $department->id }}" data-name="{{ $department->name }}"> 
		                                                <i class="bi bi-gear text-warning me-2"></i> 
		                                                {{ __("Edit Department") }}
		                                            </button>

		                                            <button type="button" class="btn btn-light me-3 departmentdeleteBtn" data-id="{{ $department->id }}"> 
		                                                <i class="bi bi-x-lg text-danger"></i> 
		                                                {{ __("Delete Department") }}
		                                            </button>

		                                            
		                                            <button type="button" class="btn btn-light float-end positioncreateBtn" data-id="{{ $department->id }}"> 
		                                                <i class="bi bi-plus-lg text-primary"></i> 
		                                                {{ __("Add Position") }}
		                                            </button>

		                                            <button type="button" class="btn btn-light me-3 float-end positionsortingBtn" data-id="{{ $department->id }}"> 
		                                                <i class='bx bx-sort text-info'></i> 
		                                                {{ __("Sorting Position") }}
		                                            </button>

		                                            <ul class="list-group mt-4">
		                                                <li class="list-group-item bg-light-green text-center">
		                                                {{ __("Position List") }}
		                                                    
		                                                </li>

		                                                @php
		                                                    $positions = $department->positions->sortBy('sorting');
		                                                @endphp

		                                                @foreach($positions as $position)
		                                                    <li class="list-group-item"> 
		                                                        {{ $position->name }}

		                                                        <button type="button" class="btn btn-outline-danger float-end positiondeleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("Remove") }}" data-id="{{ $position->id }}"> 
		                                                            <i class="bi bi-x-lg"></i> 
		                                                        </button>

		                                                        <button type="button" class="btn btn-outline-warning float-end me-3 positioneditBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("Edit") }}" data-id="{{ $position->id }}" data-name="{{ $position->name }}"> 
		                                                            <i class="bi bi-gear-fill"></i> 
		                                                        </button>

		                                                         
		                                                    </li>
		                                                @endforeach
		                                            </ul>
		                                        </div>
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
		                    		<img src="{{ asset('assets/img/empty.svg') }}" class="img-fluid text-center">
		                		</div>
		                	</div>
		                </div>
	                    <h2> {{ __("No Data Found") }} </h2>
	                    <p> {{ __("There have been no data in this section yet.") }} </p>

	                    <div class="d-grid gap-2 col-6 mx-auto my-5">
						  	<a href="javascript:void(0)" class="btn btn-primary departmentcreateBtn"> <i class="bi bi-plus-lg"></i> {{ __("Add New")}} </a>
						</div>

	                    
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	@endif


<!-- Department Modal -->
<div class="modal fade" id="department_showModal" tabindex="-1" aria-labelledby="departmentmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departmentmodalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="departmentForm">

                <input type="hidden" name="id" id="inputdepartmentId">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 form-group mb-3">
                            <label for="inputdepartmentName"> {{ __("Department Name *") }}</label>
                            <input type="text" placeholder="" class="form-control" id="inputdepartmentName" name="name">

                            <span class="n_err_name error d-block text-danger"></span>

                        </div>

                        <div class="col-12 form-group positionDiv mb-3">
                            <label for="inputPosition"> 
                            	{{ __("Add Position Title in that Deparment *") }}
                            	
                            </label>
                            <button class="btn btn-sm btn-dark float-end addpositionBtn" type="button">
						  		{{ __("+ Add Position") }}
						  	</button>
						  	
                            <input type="text" placeholder="{{ __('Position Title ( eg. Head Teacher )')}}" class="form-control mt-3" id="inputPosition" name="positions[]">

                            <span class="n_err_position error d-block text-danger"></span>

                        </div>

                        <div class="col-12 " id="morepositionDiv"></div>
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

<!-- Department Sorting Modal -->
<div class="modal fade" id="department_sortingModal" tabindex="-1" aria-labelledby="departmentsortingmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departmentsortingmodalTitle"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="departmentsortingForm">

                <input type="hidden" name="id" id="inputId">

                <div class="modal-body">
                    <div class="row">
                        <ul id="department_sortable">
                            @foreach($departments as $department)
                                <li class="ui-state-default" id="{{ $department->id }}">
                                    <span class="ui-icon ui-icon-arrowthick-2-n-s"></span> 
                                    {{ $department->name }}
                                </li>
                            @endforeach
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


<!-- Position Modal -->
<div class="modal fade" id="position_showModal" tabindex="-1" aria-labelledby="positionmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="positionmodalTitle"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="positionForm">

                <input type="hidden" name="departmentid" id="inputpositiondepartmentId">
                <input type="hidden" name="id" id="inputpositionId">


                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="inputpositionName"> {{ __("Position Title  *") }}</label>
                            <input type="text" placeholder="" class="form-control" id="inputpositionName" name="name">

                            <span class="n_err_position_name error d-block text-danger"></span>

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

<!-- Position Sorting Modal -->
<div class="modal fade" id="position_sortingModal" tabindex="-1" aria-labelledby="positionsortingmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="positionsortingmodalTitle"> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="positionsortingForm">

                <div class="modal-body">
                    <div class="row">
                        <ul id="position_sortable">
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
            	var d_confirm_text ="La suppression de ces données les supprimera définitivement de votre réseau.";
            	var d_success_text = "Vos données ont été supprimées !";
            	var d_cancel_text = "Vos données ont été sauvegardées dans notre base de données !";
            	var confirm_btn_text = "Oui, supprimez-le !";
            	var cancel_btn_text = "Annuler";
            	var sorting_modal_title="Tri par département";
            }
            else{
            	var n_modal_title ="Add New";
            	var e_modal_title ="Edit Existing";
            	var d_confirm_text = "Deleting that data will permanently remove it from your network.";
            	var d_success_text = "Your data was deleted!";
            	var d_cancel_text = "Your data was safed in our database!";
            	var confirm_btn_text = "Yes, delete it!";
            	var cancel_btn_text = "Cancel";
            	var sorting_modal_title = "Sorting";
            }


            var max_fields = 10; 
            var x = 1;
            $(".addpositionBtn").click(function(e) {
                if(x < max_fields){ 
                    var html = `<div class="col-12 form-group input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Position Title ( eg. Head Teacher )" name="positions[]">
                                    <button class="btn btn-danger" type="button" id="removepositionDiv">
                                        <i class="bi bi-x-lg position-static text-white px-2"></i>

                                    </button>
                                </div>`;

                    $("#morepositionDiv").append(html);

                }
            });
            $("#morepositionDiv").on("click","#removepositionDiv", function(e){ 
                e.preventDefault();
                console.log($(this).parent());
                $(this).parent('.input-group').remove();
                x--;

            });

            // CREATE ~ Department
            $('.departmentcreateBtn').on('click', function(){
                $("#department_showModal").modal("show");
                $("#departmentmodalTitle").text(n_modal_title);
                
                $("form.departmentForm").attr('id', 'addForm');
            });  

            // STORE ~ Department
            $("#department_showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('master.department.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {  
                        // jQuery.noConflict();

                        $("#department_showModal").modal("hide");

                        $('form').trigger("reset");
                        window.location.reload();

                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {

                            if (key == "name") 
                            {
                                $('.n_err_name').html(err[key]);
                                $('#inputName').addClass('border border-danger');
                            }

                            if (key == "positions") 
                            {
                                $('.n_err_position').html(err[key]);
                            } 
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });

            // EDIT ~ Department
            $('.accordion-body').on('click', '.departmenteditBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#inputdepartmentId').val(id);
                $('#inputdepartmentName').val(name);

                $("#departmentmodalTitle").text(e_modal_title);
                $("form.departmentForm").attr('id', 'editForm');

                $("#department_showModal").modal("show");
                $('.positionDiv').hide();
            });

            // UPDATE ~ Department
            $("#department_showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputdepartmentId').val();

                console.log(id);
                
                var url="{{route('master.department.update',':id')}}";
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

                        $("#department_showModal").modal("hide");

                        $('form').trigger("reset");
                        window.location.reload();

                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {

                            if (key == "name") 
                            {
                                $('.n_err_name').html(err[key]);
                                $('#inputName').addClass('border border-danger');
                            }
                        });
                    }
                });

                
            });

            // DELETE ~ Department
            $('.accordion-body').on('click', '.departmentdeleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.department.destroy',':id')}}";
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

            // SORTING ~ Department
            $("#department_sortable").sortable();
            $("#department_sortable").disableSelection();

            // SORTING ~ Department
            $('.departmentsortingBtn').on('click', function(){
                $("#department_sortingModal").modal("show");
                $("#departmentsortingmodalTitle").text(sorting_modal_title);
                $("form.departmentsortingForm").attr('id', 'addForm');
            });

            // STORE SORTING ~ Department
            $("#department_sortingModal").on('submit','#addForm',function(e){
                e.preventDefault();

                var x = ""; var departments = []; var a=1;
                $("#department_sortable li").each(function (index, element) {
                    x = x + $(this).text() + " , ";
                    var pid = $(this).data();
                    var id = element.id;

                    departments.push({
                        id: id,
                        sorting: a++,
                    });

                });
                
                $.ajax({
                    url: "{{ route('master.department.store.sorting')}}",
                    data: {departments:departments},
                    type: "POST",
                    dataType: 'json',
                    success: function (data){
                        $("#department_sortingModal").modal("hide");

                        window.location.reload();
                    }
                });
            });

            // CREATE ~ Position
            $('.positioncreateBtn').on('click', function(){
                $("#position_showModal").modal("show");
                var id = $(this).data("id");

                console.log(id);

                $('#inputpositiondepartmentId').val(id);
                
                $("#positionmodalTitle").text(n_modal_title);
                
                $("form.positionForm").attr('id', 'addForm'); 
            });

            // STORE ~ Position
            $("#position_showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('master.position.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => {  
                        // jQuery.noConflict();

                        $("#position_showModal").modal("hide");

                        $('form').trigger("reset");
                        window.location.reload();

                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "name") 
                            {
                                $('.n_err_position_name').html(err[key]);
                                $('#inputpositionName').addClass('border border-danger');
                            }


                        });                        
                        
                    }
                });
            });

            // EDIT ~ Position
            $('.accordion-body').on('click', '.positioneditBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');

                $('#inputpositionId').val(id);
                $('#inputpositionName').val(name);

                $("#positionmodalTitle").text(e_modal_title);
                
                $("form.positionForm").attr('id', 'editForm');

                $("#position_showModal").modal("show");
            });

            // UPDATE ~ Position
            $("#position_showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputpositionId').val();

                console.log(id);
                
                var url="{{route('master.position.update',':id')}}";
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

                        $("#position_showModal").modal("hide");

                        $('form').trigger("reset");
                        window.location.reload();

                    },
                    error: function(error){
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "name") 
                            {
                                $('.n_err_position_name').html(err[key]);
                                $('#inputpositionName').addClass('border border-danger');
                            }


                        });  
                    }
                });
            });

            // DELETE ~ Position
            $('.accordion-item').on('click', '.positiondeleteBtn', function () {
     
                var id = $(this).data("id");
                
                var url="{{route('master.position.destroy',':id')}}";
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
                                        $('form').trigger("reset");
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

            $("#position_sortable").sortable();
            $("#position_sortable").disableSelection();

            // SORTING ~ Position
            $('.positionsortingBtn').on('click', function(){
                
                var departmentid = $(this).data('id');

                $.when(getPositions(departmentid)).done(function(a1){
                    $("#position_sortingModal").modal("show");
                    $("#positionsortingmodalTitle").text(sorting_modal_title);

                    
                    $("form").attr('id', 'addForm');

                });
                
            });

            // STORE SORTING ~ Position
            $("#position_sortingModal").on('submit','#addForm',function(e){
                e.preventDefault();

                var x = ""; var positions = []; var a=1;
                $("#position_sortable li").each(function (index, element) {
                    x = x + $(this).text() + " , ";
                    var pid = $(this).data();
                    var id = element.id;

                    positions.push({
                        id: id,
                        sorting: a++,
                    });

                });

                console.log(positions);
                
                $.ajax({
                    url: "{{ route('master.position.store.sorting')}}",
                    data: {positions:positions},
                    type: "POST",
                    dataType: 'json',
                    success: function (data){
                        $("#position_sortingModal").modal("hide");

                        window.location.reload();
                    }
                });
            });

            function getPositions(departmentid){
                return $.ajax({
                    type:'POST',
                    url: "/getPositions_bydepartmentid",
                    data: {departmentid, departmentid},
                    dataType: 'json',
                    success: (response) => {  
                        var positions = response;
                        var html ='';
                        $.each(positions, function(i,v){
                            html += `<li class="ui-state-default" id="${v.id}"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span> ${v.name} </li>`;
                        });

                        $('#position_sortable').html(html);


                    }
                });

            }
        });
    </script>

@stop

</x-template>