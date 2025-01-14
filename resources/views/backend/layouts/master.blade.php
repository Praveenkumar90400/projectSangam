<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
<meta name="description" content="">
<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
<meta name="author" content="">
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href="{{ URL::asset('assets/img/logo/logo.png') }}" type="image/x-icon">
<title>@yield('title')</title>
<link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/logo.png">
<link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap-datetimepicker.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/animate.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/select2.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/all.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@yield('style')
</head>

<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>
<div class="main-wrapper">
@include('layouts.topheader')
@include('layouts.sidemenu')            
	<div class="page-wrapper">
		<div class="content">
            @yield('content')
		</div>
	</div>
</div>



<script src="{{URL::asset('assets/js/jquery-3.6.0.min.js')}}"></script>

<script src="{{URL::asset('assets/js/feather.min.js')}}"></script>

<script src="{{URL::asset('assets/js/jquery.slimscroll.min.js')}}"></script>

<script src="{{URL::asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{URL::asset('assets/js/select2.min.js')}}"></script>

<script src="{{URL::asset('assets/js/sweetalert2.all.min.js')}}"></script>
<script src="{{URL::asset('assets/js/sweetalerts.min.js')}}"></script>

<script src="{{URL::asset('assets/js/script.js')}}"></script>
    
<script src="{{URL::asset('assets/js/moment.min.js')}}"></script>
<script src="{{URL::asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>

<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>



<script>
    $(document).ready(function() {
    var tableSelector = '.table-wrap > table';

    {{-- //check if DataTable is already initialized
    if($.fn.DataTable.isDataTable(tableSelector)){
        //Destroy exiting DataTable instance
        $(tableSelector).DataTable().destroy();
    }

    // Initialize DataTable
    $(tableSelector).DataTable({
        "order": [
            [0, "desc"]
        ],
        'columnDefs': [{
            'targets': 'no-sort',
            'orderable': false
        }]
    }); --}}
});

</script>
@yield('script')
</body>
</html>