<x-template>
	@php
        $authuser = Auth::user();
    @endphp
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Student")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Student")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">

	        	<div class="card">
	            	<div class="card-header row align-items-center">
		            	<div class="col-12">
		            		<div class="row">
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
		                    		<button type="button" class="btn btn-outline-primary" id="searchBtn" disabled> <i class="bi bi-search"></i> Search </button>
		                    	</div>
		                    </div>
		            	</div>
	            	</div>
	            </div>

	            <div class="card searchDiv">
	            	<div class="card-body pt-3">
	                    {{ __("All Lists")}}
	                    <div class="table-responsive">
		                    <table class="table datatable" id="table_id">
		                        <thead>
		                            <tr>
		                                <th> {{ __("#") }} </th>
		                                <th>{{ __("Name") }}</th>
		                                <th>{{ __("Login Email") }}</th>
		                                <th>{{ __("Gender") }}</th>
		                                <th> {{ __("Status") }} </th>
		                                <th>{{ __("Action") }}</th>
		                            </tr>
		                        </thead>
		                       	<tbody>
		                       		<tr class="align-items-center">
		                                <td></td>
		                                <td></td>
		                                <td></td>
		                                <td></td>
		                                <td></td>
		                                <td></td>
		                       	</tbody>
		                    </table>
		                </div>
	                </div>
	            </div>

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
		                if(selected_sectionid){
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
		                	if(selected_batchid){
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

		    
			$('#searchBtn').click(function () {
                var batchid = $(".batches option:selected").val();
                var url="{{route('master.getlistStudent',':id')}}";
                url=url.replace(':id',batchid);

                $('.searchDiv').show();


                // READ
                table = $('.datatable').DataTable({
                    processing: true,
                    serverSide: false,
                    "ajax": {
                        "type": "GET",
                        "url": url,
                    },
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'gender', name: 'gender'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    destroy:true,
                    language: {
                       oPaginate: {
                            sNext: 'Next',
                            sPrevious: 'Previous',
                            sFirst: '<i class="fa fa-step-backward"></i>',
                            sLast: '<i class="fa fa-step-forward"></i>'
                        }
                    } ,

                    dom: 'Bfrtip',

                    buttons: [
                        {
                            extend: 'colvis',
                            columns: [0, 1],

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
                            title: 'Grade List',
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
                                                text: '{{ $authuser->school->name }}',
                                                fontSize: 9,
                                            },
                                            {
                                                alignment: 'right',
                                                fontSize: 7,
                                                text: '{{ $authuser->school->address }}'
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
                            title: '<img src="{{ asset($authuser->school->logo) }}" style="width:100px; height:100px"> {{ $authuser->school->name }}',
                            messageTop: function() {
                                return '\r\n <h2> Grade List </h2>'
                            },
                            messageBottom: '{{ $authuser->school->name }} <p class="float-end"> {{ $authuser->school->address }} </p>',
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



                $('.buttons-print').find('span').html('<i class="fas fa-print"></i> Print ');
                $('.buttons-pdf').find('span').html('<i class="fas fa-file-pdf"></i> PDF ');
                $('.buttons-csv').find('span').html('<i class="fas fa-file-csv"></i> CSV ');
                $('.buttons-excel').find('span').html('<i class="fas fa-file-excel"></i> Excel ');
                $('.buttons-collection').find('span').html('<i class="fas fa-eye"></i> Select Column');
                
            });



        });
    </script>

@stop
</x-template>