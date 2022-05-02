<x-template>

	<div class="pagetitle">
	    <h1> {{ __("Report")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Report")}}</li>
	        </ol>
	    </nav>
	</div>
	<!-- End Page Title -->
	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	            
                <div class="card">
                    <div class="card-header row align-items-center">
                        <div class="col-12">
                            <form method="get" action="{{route('master.report.index')}}" class="row">

                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12  form-group mb-3">
                                    <label class="mb-2" for="inputStartdate">{{ __("Start Date") }} * </label>
                                    <input type="date" class="form-control" name="startdate" id="inputStartdate">
                                </div>

                                <div class=" col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12  form-group mb-3">
                                    <label class="mb-2" for="inputEnddate">{{ __("End Date") }} * </label>
                                    <input  type="date" class="form-control" name="enddate" id="inputEnddate">

                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12  form-group mb-3  d-grid">
                                    <label class="mb-3"></label>
                                    <button type="submit" class="btn btn-outline-primary" id="searchBtn" > <i class="bi bi-search"></i> Search </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if(isset($startdate))
                    <div class="card">
                        <div class="card-header">
                             {{ date('d M, Y',strtotime($startdate)) }} - {{ date('d M, Y',strtotime($enddate)) }}
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Date </th>
                                        <th> Title </th>
                                        <th> Expense Type </th>

                                        <th> Amount </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i =1; $total = 0; @endphp
                                    @foreach($expenses as $expense)
                                    <tr>
                                        <td> {{ $i++ }} </td>
                                        <td> {{ date('d M, Y',strtotime($expense->date)) }} </td>
                                        <td>
                                            {{ $expense->title }}
                                            @if($expense->description)
                                            <small class="d-block"> Description : </small>
                                            <small> {{ $expense->description }}</small>
                                            @endif
                                        </td> 
                                        <td>
                                            {{ $expense->expensetype->name }}
                                        </td>
                                        <td> {{ $expense->amount }} </td>
                                    </tr>
                                    @php $total += $expense->amount; @endphp

                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"> Total </td>
                                        <td> {{ $total }} </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @endif

	        </div>
	    </div>
	</section>



@section('script_content')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            

        });
    </script>

@stop

</x-template>