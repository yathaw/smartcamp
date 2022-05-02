<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Smart Camp </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/favicon.png') }}" rel="apple-touch-icon">

</head>
<body>
	<div id="example1"></div>
</body>

<!-- PDF Viewer -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/vendor/pdfViewer/pdfobject.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        PDFObject.embed("{{ asset($syllabi->file) }}", document.body);
    });

</script>

</html>