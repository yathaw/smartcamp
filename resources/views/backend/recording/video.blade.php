<x-template>
    @section('style_content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/pdfViewer/style.css') }}">
	<style type="text/css">


        span.is-invalid .select2-selection
        {
            border-color: #dc3545 !important;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
        span.is-valid .select2-selection
        {
            border-color: #198754 !important;
            padding-right: calc(1.5em + 0.75rem) !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%23198754' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right calc(0.375em + 0.1875rem) center !important;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;

        }
        
    </style>
    @endsection


	<div class="pagetitle">
	    <h1> {{ __("Lesson")}}</h1>
	    <nav>
	        <ol class="breadcrumb">
	            <li class="breadcrumb-item"><a href="">{{ __("Dashboard")}}</a></li>
	            <li class="breadcrumb-item active">{{ __("Play Lesson")}}</li>
	        </ol>
	    </nav>
	</div>

	<section class="section">
	    <div class="row">
	        <div class="col-lg-12">
	        	<div class="card">
	            	<div class="card-header row align-items-center">
	            		<div class="col-12">
	                    	{{ $recording->title }}
	            		</div>
	            	</div>
	                	<div class="card-body pt-3">
		                    <div class="row">
		                    	<div class="col-12">
		                    		<video id="player" playsinline controls  style="--plyr-color-main: #192060;">
                                        <source src="{{ asset($recording->file) }}" type="video/mp4" />
                                        <source src="{{ asset($recording->file) }}" type="video/webm" />

                                    </video>
			                        

		                        </div>

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
        $(document).ready(function() {
            const player = new Plyr('#player');
            
        });
    </script>

    

@stop
</x-template>