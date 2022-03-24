<x-template>

	<div class="pagetitle">
	    <h1> {{ __("Section")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("All Sections")}}</li>
	        </ol>
	    </nav>
	</div>
	<!-- End Page Title -->

	<section class="section" id="fullState">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="card">
	            	<div class="card-header row align-items-center">
	            		<div class="col-xl-10 col-lg-10 col-md-6 col-sm-12 col-12">
	                    	{{ __("All Lists")}}
	            		</div>
	            		<div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12 d-grid gap-2">
	                    	<a href="javascript:void(0)" class="btn btn-outline-primary createBtn"> <i class="bi bi-plus-lg"></i> {{ __("Add New")}} </a>
	            		</div>
	            	</div>


	                <div class="card-body pt-3">
	                    
	                    <!-- Table with stripped rows -->
	                    <table class="table datatable" id="table_id">
	                        <thead>
	                            <tr>
	                                <th scope="col">{{ __("#")}}</th>
	                                <th scope="col">{{ __("Codeno")}}</th>
                                    <th scope="col">{{ __("Grade")}}</th>
                                    <th scope="col">{{ __("Start Date")}}</th>
                                    <th scope="col">{{ __("End Date")}}</th>
                                    <th scope="col">{{ __("Time")}}</th>
                                    <th scope="col">{{ __("Period")}}</th>

	                                <th scope="col">{{ __("Action")}}</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            
	                        </tbody>
	                    </table>
	                    <!-- End Table with stripped rows -->
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

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
                            <a href="javascript:void(0)" class="btn btn-primary createBtn"> <i class="bi bi-plus-lg"></i> {{ __("Add New")}} </a>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>


<div class="modal fade" id="showModal" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
	            <form class="row g-3">
	            	<input type="hidden" name="id" id="inputId">

		            <div class="modal-body">
					    <div class="col-12 mb-3">
					        <label for="inputCodeno" class="form-label">{{ __("Codeno")}}</label>
					        <input type="text" class="form-control" id="inputCodeno" name="codeno">

                            <span class="err_codeno error d-block text-danger"></span>

					    </div>

                        <div class="row form-group mb-3">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group" id="gradeDiv">
                                <label for="inputPeriod"> {{ __("Period") }} *</label>
                                <select class="select2" name="period" id="inputPeriod">
                                    <option></option>
                                    @foreach($periods as $period)
                                        <option value="{{ $period->id }}">
                                            {{ $period->name }} 
                                        </option>
                                    @endforeach
                                </select>
                                <span class="err_period error d-block text-danger"></span>

                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 form-group" id="gradeDiv">
                                <label for="inputGrade"> {{ __("Grade") }} *</label>
                                <select class="select2 inputGrades" name="grade" id="inputGrade">
                                    <option></option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">
                                            {{ $grade->name }} 
                                        </option>
                                    @endforeach
                                </select>

                                <span class="err_grade error d-block text-danger"></span>

                            </div>

                            

                        </div>


                        <div class="col-12 mb-3">
                            <label for="inputDate" class="form-label">{{ __("Start & End Date")}}</label>

                            <div class="input-group mb-3 daterange">
                                <input type="text" class="form-control " name="startdate" id="inputStartdate" >
                                <span class="input-group-text">{{ __('to') }}</span>
                                <input type="text" class="form-control" name="enddate" id="inputEnddate">
                            </div>

                            <span class="err_startdate error d-block text-danger"></span>
                            <span class="err_enddate error d-block text-danger"></span>


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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const startdate = document.querySelector('.daterange');
            const startdate_datepicker = new DateRangePicker(startdate, {
                autohide: true,
                'format': 'dd MM yyyy',
                title: 'Start & End Date (dd MM yyyy)',
                minDate: new Date(),
                allowOneSidedRange: true

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
                var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";


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
                var placeholder_title = "少なくとも1つのオプションを選択してください";

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
                var placeholder_title =  "请至少选择一个选项";

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
                var placeholder_title = "Bitte wählen Sie mindestens eine Option aus";

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
                var placeholder_title ="Veuillez sélectionner au moins une option";

            	
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
                var placeholder_title ="Please select at least one option";

            }

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
                dropdownParent: $("#showModal")

            });

            // READ
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('master.getlistSections') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'codeno', name: 'codeno'},
                    {data: 'grade', name: 'grade'},
                    {data: 'startdate', name: 'startdate'},
                    {data: 'enddate', name: 'enddate'},
                    {data: 'time', name: 'time'},
                    {data: 'period', name: 'period'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                destroy:true,
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
                        columns: [0, 1, 2,3,4,5,6],

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
                        title: 'section List',
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
                            return '\r\n <h2> section List </h2>'
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
                    
                ],
                drawCallback: function( settings, start, end, max, total, pre ) {  
                    if (this.fnSettings().fnRecordsTotal()) {
                        $('#table_id').removeAttr('style');
                        $('#emptyState').hide();
                        $('#fullState').show();
                        
                    }else{
                        $('#emptyState').show();
                        $('#fullState').hide();
                    }
                },
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
                    url: "{{ route('master.section.store')}}",
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

                        $('.err_codeno').html('');
                        $('#inputCodeno').removeClass('border border-danger');

                        $('.err_startdate').html('');
                        $('#inputStartdate').removeClass('border border-danger');

                        $('.err_enddate').html('');
                        $('#inputEnddate').removeClass('border border-danger');

                        $('.err_starttime').html('');
                        $('#inputStarttime').removeClass('border border-danger');

                        $('.err_endtime').html('');
                        $('#inputEndtime').removeClass('border border-danger');

                        $('.err_period').html('');
                        $('#inputPeriod').removeClass('border border-danger');

                        $('.err_grade').html('');
                        $('#inputGrade').removeClass('border border-danger');

                    },
                    error: function(error){
                        $('.err_codeno').html('');
                        $('#inputCodeno').removeClass('border border-danger');

                        $('.err_startdate').html('');
                        $('#inputStartdate').removeClass('border border-danger');

                        $('.err_enddate').html('');
                        $('#inputEnddate').removeClass('border border-danger');

                        $('.err_starttime').html('');
                        $('#inputStarttime').removeClass('border border-danger');

                        $('.err_endtime').html('');
                        $('#inputEndtime').removeClass('border border-danger');

                        $('.err_period').html('');
                        $('#inputPeriod').removeClass('border border-danger');

                        $('.err_grade').html('');
                        $('#inputGrade').removeClass('border border-danger');

                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "codeno") 
                            {
                                $('.err_codeno').html(err[key]);
                                $('#inputCodeno').addClass('border border-danger');
                            }

                            if (key == "startdate") 
                            {
                                $('.err_startdate').html(err[key]);
                                $('#inputStartdate').addClass('border border-danger');
                            }

                            if (key == "enddate") 
                            {
                                $('.err_enddate').html(err[key]);
                                $('#inputEnddate').addClass('border border-danger');
                            }

                            if (key == "starttime") 
                            {
                                $('.err_starttime').html(err[key]);
                                $('#inputStarttime').addClass('border border-danger');
                            }

                            if (key == "endtime") 
                            {
                                $('.err_endtime').html(err[key]);
                                $('#inputEndtime').addClass('border border-danger');
                            }

                            if (key == "period") 
                            {
                                $('.err_period').html(err[key]);
                                $("#inputPeriod + span").addClass("border border-danger");
                            }

                            if (key == "grade") 
                            {
                                $('.err_grade').html(err[key]);
                                $("#inputGrade + span").addClass("border border-danger");

                            }
                            
                        });
                        //console.log(error.responseJSON.errors);
                        
                        
                    }
                });
            });

            $("#showModal").on('click','.btnclose',function(e){
                $('form').trigger("reset");

                $('.err_codeno').remove();
                $('#inputCodeno').removeClass('border border-danger');

                $('.err_startyear').remove();
                $('#inputSyear').removeClass('border border-danger');

                $('.err_endyear').remove();
                $('#inputEyear').removeClass('border border-danger');
            });

            // EDIT
            $('tbody').on('click', '.editBtn', function (){

                var id = $(this).data('id');
                var codeno = $(this).data('codeno');
                var startdate = $(this).data('startdate');
                var enddate = $(this).data('enddate');
                var starttime = $(this).data('starttime');
                var endtime = $(this).data('endtime');
                var period = $(this).data('period_id');
                var grade = $(this).data('grade_id');

                $('#inputId').val(id);
                $('#inputCodeno').val(codeno);
                $('#inputStartdate').val(startdate);
                $('#inputEnddate').val(enddate);
                $('#inputStarttime').val(starttime);
                $('#inputEndtime').val(endtime);

                $('#inputPeriod').val(period).trigger('change');
                $('#inputGrade').val(grade).trigger('change');

				$("#showModal").modal("show");
                $("form").attr('id', 'editForm');
                $(".modal-title").text(e_modal_title);
            });

            // UPDATE
            $("#showModal").on('submit','#editForm',function(e){
                e.preventDefault();
                
                var formData = new FormData(this);

                var id = $('#inputId').val();
                
                var url="{{route('master.section.update',':id')}}";
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

                        $('.err_codeno').html('');
                        $('#inputCodeno').removeClass('border border-danger');

                        $('.err_startdate').html('');
                        $('#inputStartdate').removeClass('border border-danger');

                        $('.err_enddate').html('');
                        $('#inputEnddate').removeClass('border border-danger');

                        $('.err_starttime').html('');
                        $('#inputStarttime').removeClass('border border-danger');

                        $('.err_endtime').html('');
                        $('#inputEndtime').removeClass('border border-danger');

                        $('.err_period').html('');
                        $('#inputPeriod').removeClass('border border-danger');

                        $('.err_grade').html('');
                        $('#inputGrade').removeClass('border border-danger');
                        

                    },
                    error: function(error){
                        $('.err_codeno').html('');
                        $('#inputCodeno').removeClass('border border-danger');

                        $('.err_startdate').html('');
                        $('#inputStartdate').removeClass('border border-danger');

                        $('.err_enddate').html('');
                        $('#inputEnddate').removeClass('border border-danger');

                        $('.err_starttime').html('');
                        $('#inputStarttime').removeClass('border border-danger');

                        $('.err_endtime').html('');
                        $('#inputEndtime').removeClass('border border-danger');

                        $('.err_period').html('');
                        $('#inputPeriod').removeClass('border border-danger');

                        $('.err_grade').html('');
                        $('#inputGrade').removeClass('border border-danger');
                        
                        var message=error.responseJSON.message;
                        var err=error.responseJSON.errors;

                        $.each(err, function( key, value ) {
                            console.log(key);

                            if (key == "codeno") 
                            {
                                $('.err_codeno').html(err[key]);
                                $('#inputCodeno').addClass('border border-danger');
                            }

                            if (key == "startdate") 
                            {
                                $('.err_startdate').html(err[key]);
                                $('#inputStartdate').addClass('border border-danger');
                            }

                            if (key == "enddate") 
                            {
                                $('.err_enddate').html(err[key]);
                                $('#inputEnddate').addClass('border border-danger');
                            }

                            if (key == "starttime") 
                            {
                                $('.err_starttime').html(err[key]);
                                $('#inputStarttime').addClass('border border-danger');
                            }

                            if (key == "endtime") 
                            {
                                $('.err_endtime').html(err[key]);
                                $('#inputEndtime').addClass('border border-danger');
                            }

                            if (key == "period") 
                            {
                                $('.err_period').html(err[key]);
                                $("#inputPeriod + span").addClass("border border-danger");
                            }

                            if (key == "grade") 
                            {
                                $('.err_grade').html(err[key]);
                                $("#inputGrade + span").addClass("border border-danger");

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

                
                var url="{{route('master.section.destroy',':id')}}";
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