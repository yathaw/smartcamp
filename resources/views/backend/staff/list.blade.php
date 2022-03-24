<x-template>
	@php
        $authuser = Auth::user();
    @endphp
	<div class="pagetitle">
	    <h1> {{ __("Staff")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("All Staff")}}</li>
	        </ol>
	    </nav>
	</div>
	@if($departments->isEmpty())

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
		                    <h2> {{ __("No Departments / Position Data Found") }} </h2>
		                    <p> {{ __("There have been no departments in this section yet. Please add some department first.") }} </p>

		                    <div class="d-grid gap-2 col-6 mx-auto my-5">
							  	<a href="{{ route('master.department.create') }}" class="btn btn-primary"> <i class="bi bi-plus-lg"></i> {{ __("Add Departments")}} </a>
							</div>

		                    
		                </div>
		            </div>
		        </div>
		    </div>
		</section>
		
	@else

	<!-- End Page Title -->
	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="card">
	            	<div class="card-header">
	                    

		                    <div class="row align-items-center">
		                    	<div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
		                    		<select class="select2 departments" name="department">
		                    			<option></option>
		                    			@foreach($departments as $department):
		                    				<option value="{{ $department->id }}"> {{ $department->name }} </option>
		                    			@endforeach
		                    		</select>
		                    	</div>
		                    	<div class="col-xl-5 col-lg-5 col-12 form-group">
		                            <select class="select2 positions" name="position" disabled="">
		                                <option></option>
		                            </select>
		                        </div>
		                        <div class="col-xl-2 col-lg-2 col-12 form-group">
		                        	<div class="d-grid gap-2">
		                            	<button type="button" class="btn btn-outline-primary searchBtn">
		                            		<i class="bi bi-search me-2"></i> {{ __("Search") }}
		                            	</button>
		                            </div>
		                        </div>
		                    </div>
	            	</div>


	                <div class="card-body pt-3">
	                    {{ __("All Lists")}}
	                    <div class="table-responsive">
		                    <table class="table datatable" id="table_id">
		                        <thead>
		                            <tr>
		                                <th> {{ __("#") }} </th>
		                                <th>{{ __("Name") }}</th>
		                                <th>{{ __("Login Email") }}</th>
		                                <th>{{ __("Experience") }}</th>
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

		                       		</tr>
		                       	</tbody>
		                    </table>
		                </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>

	@endif

@section('script_content')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.card-body').hide();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var currentLanguage = "{{  Config::get('app.locale') }}";
            if (currentLanguage == "mm") {
            	var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";
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

            $('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

            $('.departments').change(function (e) {
                var did = $(this).val();

                $('.positions').prop('disabled',false);

                $.post("/getPositions_bydepartmentid",{departmentid:did},function (res) {
                    var data = res;
                    var html ='';

                    $.each(data,function (i,v) {
                        html +=`<option value="${v.id}">${v.name}</option>`;
                    });

                    $('.positions').html(html);

                });
            });

            $('.searchBtn').click(function () {
                var positionid = $(".positions option:selected").val();
                var url="{{route('master.getlistStaff',':id')}}";
                url=url.replace(':id',positionid);

                $('.card-body').show();


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
                        {data: 'experience', name: 'experience'},
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