<x-template>

	<div class="pagetitle">
	    <h1> {{ __("Billing Information")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Billing Information")}}</li>
	        </ol>
	    </nav>
	</div>
	<!-- End Page Title -->
	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	            <div class="card">
	            	<div class="card-header row align-items-center">
	            		<nav>
						  	<div class="nav nav-tabs" id="nav-tab" role="tablist">
						    	<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
						    		{{ __("Your Current Plan")}}
						    	</button>
						    	<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">
						    		{{ __("Change Plan")}}
						    	</button>
						    	<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">
						    		{{ __("History")}}
						    	</button>
						  </div>
						</nav>
	            	</div>
	                <div class="card-body pt-3">
	                    <div class="tab-content" id="nav-tabContent">
						  	<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						  		<div class="row">
						  			<div class="col-12">
						  				<div class="card shadow-none border">
						  					<div class="card-header text-center">
										    	Start Up Plan
										  	</div>
										  	<div class="card-body ">
										  		<div class="row">
										  			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 py-3 text-center">
										  				<small class="text-muted"> Start Date </small>
										  				<h3> {{ $startdate }} </h3>
										  			</div>
										  			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 py-3 text-center">
										  				<small class="text-muted"> End Date </small>
										  				<h3> {{ $enddate }} </h3>
										  			</div>
										  		</div>
										  	</div>
										  	<div class="card-footer">
										  		<div id="defaultCountdown"></div>
										  	</div>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						  		<div class="row">
						  			@foreach($plans as $plan)
						  			<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
										<div class="card shadow-none border">
										  	<div class="card-header text-center">
										    	{{ $plan->name }}
										  	</div>
										  	<ul class="list-group list-group-flush text-center">
										    	<li class="list-group-item py-5 bg-primary  @if($plan->id == 1) bg-opacity-10 @endif @if($plan->id == 2) bg-opacity-50 text-white @endif @if($plan->id == 3) text-white @endif">
										    		<h1 class="text-center display-5"> {{ $plan->amount }} </h1>
										    	</li>
										    	<li class="list-group-item py-3">
										    		{{ $plan->duration }}
										    	</li>
										    	<li class="list-group-item py-2">30 Days Free Trail </li>
										    	<li class="list-group-item py-2"> Access to all the features </li>
										    	<li class="list-group-item py-2"> Upto 5 GB file Storage </li>
										    	<li class="list-group-item py-3">
										    		<div class="d-grid gap-2 col-6 mx-auto">
													  	<a class="btn btn-primary" href="{{ route('master.plan.change', $plan->id) }}">Purchase Now </a>
													</div>
										    	</li>

										  	</ul>
										</div>
						  			</div>
						  			@endforeach
						  		</div>
						  	</div>
						  	<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
						  		<div class="row">
						  			<div class="col-12">
						  				<!-- Table with stripped rows -->
					                    <table class="table datatable" id="table_id" width="100%">
					                        <thead>
					                            <tr>
					                                <th scope="col">{{ __("Plan")}}</th>
					                                <th scope="col">{{ __("Start Date")}}</th>
					                                <th scope="col">{{ __("End Date")}}</th>
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
	                </div>
	            </div>
	        </div>
	    </div>
	</section>


@section('script_content')

<script>
	var enddate = "{{ $enddatetime }}";
	$(document).ready(function() {
		console.log(enddate);
		var austDay = new Date(enddate);

		$('#defaultCountdown').countdown({until: austDay});

		// READ
            var table = $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('master.getlistPlanhistory') }}",
                columns: [
                    {data: 'plan', name: 'plan'},
                    {data: 'startdate', name: 'startdate'},
                    {data: 'enddate', name: 'enddate'}

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
                        title: 'Plan List',
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
                            return '\r\n <h2> Plan List </h2>'
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

	});

	
</script>

@stop

</x-template>
