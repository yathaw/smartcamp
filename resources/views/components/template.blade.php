<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title> SMART CAMP</title>
        <meta content="" name="description">
        <meta content="" name="keywords">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicons -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('assets/img/favicon.png') }}" rel="apple-touch-icon">
        <!-- Google Fonts -->
        <link href="{{ asset('assets/css/font.css') }}" rel="stylesheet">
        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/dataTables/datatables.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/vanillajs-datepicker/css/datepicker.min.css') }}">

        <!-- Image Uploader -->
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/vendor/img_uploader/materialicon.css') }}">
        <link href="{{ asset('assets/vendor/img_uploader/image-uploader.min.css') }}" rel="stylesheet">
        
        <!-- Sweetalert 2 CSS -->    
        <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}">

        <!-- Select 2 CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/select2/select2-bootstrap5.css') }}">

        <!-- Sortable CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}">

        <!-- Timepicker -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/timepicker/datetimepicker.min.css') }}">

        <!-- Colorpicker CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/colorpicker/themes/classic.min.css') }}">

        <style type="text/css">
            @php 
                $currentLanguage = Config::get('app.locale');
                if ($currentLanguage == 'mm'):
                    
                else if ($currentLanguage == 'jp'):
                    
                else if ($currentLanguage == 'cn'):
                    $language = "中國";
                else if ($currentLanguage == 'de'):
                    $language = "Deutschland";
                else if ($currentLanguage == 'fr'):
                    $language = "La France";
                else:
                    $language = "English";
                @endif
            @endphp
        </style>

        @php $backendComponents = ["login", "register", "master", "verify","procedure"] @endphp
        @if(in_array(Request::segment(1),$backendComponents))
            <link href="{{ asset('assets/css/backendstyle.css') }}" rel="stylesheet">
        @else
        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/frontendstyle.css') }}" rel="stylesheet">
        @endif
        @yield("style_content")



    </head>
    <body>
        @php $authComponents = ["login", "register", "verify","procedure"] @endphp
        @if(!in_array(Request::segment(1),$authComponents))

            @if(Request::segment(1) === 'master')
                @include('components.backendheader')
            @else
                @include('components.frontendheader')
            @endif

        @endif

        
        <main @if(!in_array(Request::segment(1),$authComponents)) id="main" class="main" @endif>
            {{ $slot }}
            
        </main>
        <!-- End #main -->
        @if(!in_array(Request::segment(1),$authComponents))

        @if(Request::segment(1) === 'master')
            @include('components.backendfooter')
        @else
            @include('components.frontendfooter')
        @endif
        @endif


        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

        <!-- Vendor JS Files -->
        <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/summernote/summernote-lite.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/dataTables/datatables.min.js') }}"></script>

        <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
        
        <!-- Sweetalert 2 Js -->
        <script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}"></script>

        <!-- Select 2 Js -->
        <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>

        <!-- Image Uploader -->
        <script src="{{ asset('assets/vendor/img_uploader/image-uploader.min.js') }}"></script>

        <!-- Sortable JS -->
        <script src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>

        <script src="{{ asset('assets/vendor/vanillajs-datepicker/js/datepicker-full.min.js') }}"></script>

        
        <!-- Time Picker -->
        <script src="{{ asset('assets/vendor/timepicker/moment.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/timepicker/bootstrap-datetimepicker.min.js') }}"></script>

        <!-- Colorpicker JS -->
        <script src="{{ asset('assets/vendor/colorpicker/pickr.min.js') }}"></script>


        @if(in_array(Request::segment(1),$backendComponents))
        <script src="{{ asset('assets/js/backendmain.js') }}"></script>

        
        @else
        <!-- Template Main JS File -->
        <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/frontendmain.js') }}"></script>
        @endif

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                $('[data-bs-toggle="tooltip"]').tooltip();

                $('table').on('draw.dt', function() {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                })

                // $('#table_id').DataTable();
            });
        </script>

        @yield("script_content")


    </body>
</html>