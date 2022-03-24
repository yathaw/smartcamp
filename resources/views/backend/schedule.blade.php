<x-template>
	@section('style_content')
    	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/schedule.css') }}">
    @endsection

	<div class="pagetitle">
	    <h1> {{ __("Schedule")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Add New Schedule")}}</li>
	        </ol>
	    </nav>
	</div>
	@if($scheduletypes->isEmpty())

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
	                        <h2> {{ __("No Scheduletype Found") }} </h2>
	                        <p> {{ __("There have been no scheduletype in this section yet.") }} </p>

	                        <div class="d-grid gap-2 col-6 mx-auto my-5">
	                            <a href="{{ route('master.scheduletype.index') }}" class="btn btn-primary createBtn"> <i class="bi bi-plus-lg"></i> {{ __("Add New")}} </a>
	                        </div>

	                        
	                    </div>
	                </div>
	            </div>
	        </div>
	    </section>

	@else

		<section class="section">
		    <div class="row">
		        <div class="col-lg-12">
		        	<div class="card">
		            	<div class="card-header row align-items-center">
			            	<div class="col-12">

		            			<form method="get" action="{{route('master.schedule.index')}}" class="row">
			                    	<div class="col-10 ">
			                            <select class="select2" name="period" id="inputPeriod">
		                                    <option></option>
		                                    @foreach($periods as $period)
		                                        <option value="{{ $period->id }}">
		                                            {{ $period->name }} 
		                                        </option>
		                                    @endforeach
		                                </select>
			                    	</div>
			                    	<div class="col-2 d-grid gap-2">
			                    		<button type="submit" class="btn btn-outline-primary"> <i class="bi bi-search"></i> Search </button>
			                    	</div>
			            		</form>
			            	</div>
		            	</div>

            			@isset($period)

		                <div class="card-body pt-3">
		                	<!-- DISPLAY USER SCHEDULER-->
							<div class="table-responsive">
							    <div data-parse="1595877840000" id="calplaceholder" style="max-height: 500px; margin-bottom: 0;">
							        <div class="cal-sectionDiv">
							            <table class="table table-striped table-bordered">
							                <thead class="cal-thead">
							                    <tr>
							                        <th class="cal-viewmonth" id="changemonth">	2021 - 2022</th>
							                        <th class="cal-toprow">Monday</th>
							                        <th class="cal-toprow">Tuesday</th>
							                        <th class="cal-toprow">Wednesday</th>
							                        <th class="cal-toprow">Thursday</th>
							                        <th class="cal-toprow">Friday</th>
							                        <th class="cal-toprow">Saturday</th>
							                        <th class="cal-toprow">Sunday</th>
							                    </tr>
							                </thead>
							                <tbody class="cal-tbody">
							                    <tr id="h16">
							                        <td class="cal-usersheader" style="color:#000; background-color:#389fe8; padding: 0px;">Team 1</td>
							                        <td colspan="31" style="color:#FFFFFF; background-color:#389fe8;"></td>
							                    </tr>
							                    <tr id="u1">
							                        <td class="cal-userinfo">
							                            <span><b style="text-decoration: underline">Van Els</b> Numan<span></span></span>
							                            <div class="cal-usercounter">
							                                <span class="cal-userbadge badge badge-light">140:13</span><span class="cal-userbadge badge badge-warning">134:36</span>
							                            </div>
							                            <div class="cal-userarrows">
							                                <i class="up mdi mdi-arrow-up-bold"></i><i class="down mdi mdi-arrow-down-bold"></i>
							                            </div>
							                        </td>
							                        <td class="ui-droppable" data-date="1/7/2020" data-userid="1">
							                            <div class="drag details ui-draggable ui-draggable-handle" data-taskid="13956" data-userid="1" style="border-left: 5px solid rgb(81, 255, 0); position: relative;">
							                                <h3 class="details-task" style=" background: #51FF00; color: #000000">Training</h3>
							                                <div class="details-uren">
							                                    15:00 - 16:30
							                                </div>
							                            </div>
							                        </td>
							                        <td class="ui-droppable" data-date="2/7/2020" data-userid="1">
							                            <div class="drag details ui-draggable ui-draggable-handle" data-taskid="13957" data-userid="1" style="border-left: 5px solid rgb(121, 32, 32); position: relative;">
							                                <h3 class="details-task" style=" background: #792020; color: #FFFFFF">Day Shift</h3>
							                                <div class="details-uren">
							                                    00:00 - 00:00
							                                </div>
							                            </div>
							                        </td>
							                        <td class="ui-droppable" data-date="3/7/2020" data-userid="1">
							                            <div class="drag details ui-draggable ui-draggable-handle" data-taskid="13959" data-userid="1" style="border-left: 5px solid rgb(175, 0, 0); position: relative;">
							                                <h3 class="details-task" style=" background: #AF0000; color: #FFFFFF">Sick</h3>
							                                <div class="details-uren">
							                                    00:00 - 00:00
							                                </div>
							                            </div>
							                        </td>
							                        
							                    </tr>
							                </tbody>
							            </table>
							        </div>
							    </div>
							</div>

		                </div>
		                @endif
		            </div>
		        </div>
		    </div>
		</section>


	@endif

@section('script_content')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.3.3/jscolor.min.js"></script>
	<script src="{{ asset('assets/js/schedule.js') }}"></script>

	<script type="text/javascript">
        var currentLanguage = "{{  Config::get('app.locale') }}";
    </script>
    
    <script type="text/javascript">
    	var starttime=''; var endtime='';
        $(document).ready(function() {

        	if (currentLanguage == "mm") {
            	var placeholder_title = "ကျေးဇူးပြု၍ အနည်းဆုံး ရွေးချယ်မှုတစ်ခုကို ရွေးပါ။";
            }
            else if(currentLanguage == "jp"){
            	var placeholder_title = "少なくとも1つのオプションを選択してください";
            }
            else if(currentLanguage == "cn"){
            	var placeholder_title =  "请至少选择一个选项";
            }
            else if(currentLanguage == "de"){
            	var placeholder_title = "Bitte wählen Sie mindestens eine Option aus";
            }
            else if(currentLanguage == "fr"){
            	var placeholder_title ="Veuillez sélectionner au moins une option";
            }else{
            	var placeholder_title ="Please select at least one option";
            }

        	$('.select2').select2({
                width: '100%',
                theme: 'bootstrap5',
                placeholder: placeholder_title,
            });

        });
    </script>


@stop
</x-template>