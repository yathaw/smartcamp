<x-template>
    @php
        $authuser = Auth::user();
        $authRole = Auth::user()->getRoleNames()[0];
    @endphp
	<div class="pagetitle">
	    <h1> {{ __("School")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
                @if($authRole == "Software Admin")
	               <li class="breadcrumb-item active">{{ __("All Schools")}}</li>
                @else
                   <li class="breadcrumb-item active">{{ __("School Profile")}}</li>

                @endif
	        </ol>
	    </nav>
	</div>
	<!-- End Page Title -->
    @if($authRole == "Software Admin")
	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="card">
	            	<div class="card-header row align-items-center">
	            		<div class="col-xl-10 col-lg-10 col-md-6 col-sm-12 col-12">
	                    	{{ __("All Schools")}}
	            		</div>

	            	</div>


	                <div class="card-body pt-3">
	                    
	                    <!-- Table with stripped rows -->
	                    <table class="table datatable" id="table_id">
	                        <thead>
	                            <tr>
	                                <th scope="col">{{ __("#")}}</th>
	                                <th scope="col">{{ __("Name")}}</th>
                                    <th scope="col">{{ __("Expire Plan")}}</th>

	                                <th scope="col">{{ __("Action")}}</th>
	                            </tr>
	                        </thead>
	                        <tbody>
                                @php $i=1; @endphp
	                            @foreach($schools as $school)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td> 
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3">
                                                    <img src="{{ asset($school->logo) }}"
                                                        alt="{{ $school->logo }}" class="rounded-circle" width="45"
                                                        height="45" />
                                                </div>
                                                <div class="">
                                                    <p class="ms-3"> {{ $school->name }} </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $purchase_plans = $school->plans()->where([
                                                                        ['school_id', '=', $school->id],
                                                                        ['status', '=', '0']
                                                                    ])->get()->toArray();

                                                $diff_in_days = 0; $created;
                                                foreach($purchase_plans as $key => $plan){
                                                    $created_at = \Carbon\Carbon::parse($plan['pivot']['created_at']);
                                                    $duration_str = $plan['duration'];
                                                    $duration_arr = explode(" ",$duration_str);
                                                    $duration = $duration_arr[0];

                                                    $enddate = \Carbon\Carbon::parse($created_at)->addMonths($duration);
                                                    $today = \Carbon\Carbon::now();

                                                    $greaterorequal_todaydate = $enddate->gte($today);

                                                    if($greaterorequal_todaydate){
                                                        $created = $created_at;
                                                        $diff_in_days += $enddate->diffInDays($today);
                                                    }else{
                                                        $last_purchase_plan = last($purchase_plans);
                                                        $created = $last_purchase_plan['pivot']['created_at'];
                                                    }

                                                }
                                                $startdatetime = \Carbon\Carbon::parse($created)->format('d M, Y h:i:s');

                                                $enddatetime = \Carbon\Carbon::parse($created)->addDays($diff_in_days)->format('d M,Y h:i:s');
                                            @endphp
                                            <p> Start : {{ $startdatetime }} </p>
                                            <p> End : {{ $enddatetime }} </p>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger me-2 deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove" data-id="{{ $school->id }}" data-name="{{ $school->name }}">
                                                <i class="bi bi-x-lg"></i> 
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
	                        </tbody>
	                    </table>
	                    <!-- End Table with stripped rows -->
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
    @else
    @php
        $img_str = $school->coverphoto;
        $images = json_decode($img_str);

    @endphp
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div id="carouselExampleIndicators" class="carousel slide card-img-top" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($images as $key => $image)
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" class="@if($key == 0) active @endif" aria-current="@if($key == 0) true @endif"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach($images as $key => $image)
                                <div class="carousel-item @if($key == 0)  active @endif">
                                    <img src="{{ asset($image) }}" class="d-block img-fluid" alt="...">
                                </div>
                                @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> {{ __("Mottoes") }} : {{ $school->mottoes }} </h5>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span class="card-subtitlem">School Type : </span> 
                                    <span class="text-muted">
                                        {{ $school->schooltype->name }}
                                    </span>
                                </li>

                                <li class="list-group-item">
                                    <span class="card-subtitlem"> City : </span> 
                                    <span class="text-muted">
                                        {{ $school->city->name }}, 
                                        {{ $school->city->state->name }} 
                                    </span>
                                </li>

                                <li class="list-group-item"> 
                                    <span class="card-subtitlem"> Address : </span>
                                    <span class="text-muted">
                                        {{ $school->address }} 
                                    </span>
                                </li>
                                <li class="list-group-item"> 
                                    <span class="card-subtitlem"> Total Student : </span>
                                    <span class="text-muted">
                                        {{ $school->studentamount }} 
                                    </span>
                                </li>
                            </ul>

                            <p class="card-text">
                                {!! $school->about !!}
                            </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    @endif


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
            }

            // READ
            var table = $('.datatable').DataTable({
                language: {
                   oPaginate: {
                        sNext: '<i class="bi bi-chevron-right"></i>',
                        sPrevious: '<i class="bi bi-chevron-left"></i>',
                        sFirst: '<i class="bi bi-chevron-double-left"></i>',
                        sLast: '<i class="bi bi-chevron-double-right"></i>'
                    }
                } ,

                dom: 'Bfrtip',

                buttons: [
                    {
                        extend: 'colvis',
                        columns: [0, 1, 2],

                        collectionLayout: "fixed two-column",
                            collectionTitle: "Select Columns to Display",
                            postfixButtons: ["colvisRestore"],
                            columnText: function(dt, idx, title) {
                                console.log(idx != 3);
                                    return idx + 1 + ": " + title;
                            }
                    },
                    
                    {
                        extend: 'pdfHtml5',
                        title: 'Bank List',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: [ ':visible:not(:last-child)' ]
                        },
                        customize: function ( pdf ){

                            pdf.content[1].table.widths = Array(pdf.content[1].table.body[0].length + 1).join('*').split('');

                            //Create a date string that we use in the footer. Format is dd-mm-yyyy
                            var now = new Date();
                            var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();

                            pdf['header']=(function() {
                                return {
                                    columns: [
                                        {
                                            alignment: 'left',
                                            text: 'SMART CAMP',
                                            fontSize: 9,
                                        },
                                        {
                                            alignment: 'right',
                                            fontSize: 7,
                                            text: 'No.(14), Pon Nya Wuttana Street, Tamwe Tsp., Yangon. Tel: 095166021, 09785166021'
                                        }
                                    ],
                                    margin: 20
                                }
                            });

                            pdf['footer']=(function(page, pages) {
                                return {
                                    columns: [
                                        {
                                            alignment: 'left',
                                            text: ['Created on: ', { text: jsDate.toString() }]
                                        },
                                        {
                                            alignment: 'right',
                                            text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                        }
                                    ],
                                    margin: 20
                                }
                            });

                        }
                    },

                    {
                        extend: 'print',
                        title: 'SMART CAMP',
                        messageTop: function() {
                            return '\r\n <h2> Bank List </h2>'
                        },
                        messageBottom: 'SMART CAMP <p> No.(14), Pon Nya Wuttana Street, Tamwe Tsp., Yangon. Tel: 095166021, 09785166021 </p>',
                        exportOptions: {
                            modifier: {
                                page: 'all',
                                search: 'none'   
                            },
                            columns: [ ':visible:not(:last-child)' ]

                        },
                        customize: function ( print ){

                            $(print.document.body).find('h1').css('text-align', 'center');

                            // $('tfoot tr th').attr('colspan',2);
                            // $('row c[r*="10"]', print).attr( 's', '25' );
                        },
                        oSelectorOpts: {
                            page: 'all'
                        },
                    },

                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ ':visible' ]
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
             
                            // Loop over the cells in column `C`
                            $('row c[r^="C"]', sheet).each( function () {
                                // Get the value
                                if ( $('is t', this).text() == 'New York' ) {
                                    $(this).attr( 's', '20' );
                                }
                            });
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ ':visible:not(:last-child)' ]
                        },
                        exportOptions: {
                            modifier: {
                                search: 'none'
                            }
                        }
                    }
                    
                ]
            });
			
			$('.btn-group>.btn').removeClass('btn-secondary');

			// $('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-outline-info mr-1');

			$('.buttons-print').addClass('btn btn-danger me-1');
			$('.buttons-pdf').addClass('btn btn-primary me-1');
			$('.buttons-excel').addClass('btn btn-success me-1');
			$('.buttons-csv').addClass('btn btn-info me-1');

			$('.buttons-collection').addClass('btn-dark me-1');

            $('.buttons-print').find('span').html('<i class="bi bi-printer"></i> Print ');
            $('.buttons-pdf').find('span').html('<i class="bi bi-file-earmark-ppt"></i> PDF ');
            $('.buttons-excel').find('span').html('<i class="bi bi-file-earmark-excel"></i> Excel ');
            $('.buttons-csv').find('span').html('<i class="bi bi-file-spreadsheet"></i> CSV ');


            $('.createBtn').on('click', function(){
                $("#showModal").modal("show");
                $("form").attr('id', 'addForm');
                $(".modal-title").text(n_modal_title);
            });

            // CREATE
            $("#showModal").on('submit','#addForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    type:'POST',
                    url: "{{ route('master.bank.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: (data) => { 
                        Swal.fire({
                            icon: "success",
                            text: s_success_text,
                            showConfirmButton: false,
                            timer : 1500
                        });

                        $("#showModal").modal("hide");

                        $('#addForm').trigger("reset");
                        table.draw();

                        $('.alert').removeClass('d-none');
                        $('.msg').html(data.success);

                        $(".alert").fadeOut(3000, function() {
                            $(this).addClass("d-none");
                            $(this).fadeIn();
                        });

                        $('.err_name').remove();
                        $('#inputName').removeClass('border border-danger');

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
                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });

            $("#showModal").on('click','.btnclose',function(e){
                $('form').trigger("reset");

                $('.err_name').remove();
                $('#inputName').removeClass('border border-danger');
            });

            // EDIT
            $('tbody').on('click', '.editBtn', function (){

                var id = $(this).data('id');
                var name = $(this).data('name');
                var image = $(this).data('image');


                $('#inputId').val(id);
                $('#inputName').val(name);
                $('#oldimage').val(image);
                $('#imagePreview').css('background-image', 'url('+image+')');

				$("#showModal").modal("show");
                $("form").attr('id', 'editForm');
                $(".modal-title").text(e_modal_title);
            });

            // UPDATE
            $("#showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputId').val();
                
                var url="{{route('master.bank.update',':id')}}";
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
                        });

                        $("#showModal").modal("hide");

                        $('#editForm').trigger("reset");
                        table.draw();

                        $('.alert').removeClass('d-none');
                        $('.msg').html(data.success);

                        $(".alert").fadeOut(3000, function() {
                            $(this).addClass("d-none");
                            $(this).fadeIn();
                        });

                        $('.err_name').remove();
                        $('#inputName').removeClass('border border-danger');
                        

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

                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });

                
            });

            // DELETE
            $('tbody').on('click', '.deleteBtn', function () {
     
                var id = $(this).data("id");
                var name = $(this).data("name");

                
                var url="{{route('master.school.destroy',':id')}}";
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
                                        table.draw();

                                        $('.alert').removeClass('d-none');
                                        $('.msg').html(data.success);

                                        $(".alert").fadeOut(3000, function() {
                                            $(this).addClass("d-none");
                                            $(this).fadeIn();

                                        });
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