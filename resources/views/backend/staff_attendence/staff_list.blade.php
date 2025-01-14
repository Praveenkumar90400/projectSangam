@extends('backend.layouts.master')

@section('title')
    Attendance
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Your stylesheets here -->
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('content')
<div class="col-lg-12 col-ml-12 padding-bottom-30">
    <div class="row">
        <!-- basic form start -->
        <div class="col-lg-12">
            <div class="margin-top-40"></div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <span class="d-inline-block">
            @php
                $date = date('Y-m-d');
                $saveData_spc_lr = [
                    "ssdate" => date('Y-m-d', strtotime($date . ' -29 days')),
                    "sedate" => date('Y-m-d')
                ];

                if (session('saveData_spc_lr')) {
                    $saveData_spc_lr = session('saveData_spc_lr');
                }
            @endphp

            <div class="row mx-2 my-2">
            
                <div class="col"><h4 class="header-title">{{ __('Staff Attendence List') }}</h4></div>
                <div class="col-md-3 form-group">
                    <input class="form-control" type="text" id="datetimes" name="datetimes" />
                </div>
                <div class="col-md-2">
                    <button id="submit" type="button" title="Search based on filter" class="btn btn-success">Search</button>
                </div>
            </div>
        </span>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content margin-top-40">
                        <div class="tab-pane fade show active" id="slider_tab" role="tabpanel">
                            <div class="table-wrap table-responsive">
                                <table class="table table-default" id="all_table">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">ID</th>
                                            <th class="border-bottom-0">Employee Name</th>
                                            @for($i = $saveData_spc_lr['ssdate']; $i <= $saveData_spc_lr['sedate']; $i = date('Y-m-d', strtotime($i . ' +1 day')))
                                                <th class="border-bottom-0" style="width: 80px;">{{ $i }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
  $(document).ready(function() {
    // Initialize daterangepicker
    $('#datetimes').daterangepicker({
        timePicker: false,
        showDropdowns: true,
        startDate: '{{ $saveData_spc_lr["ssdate"] }}',
        endDate: '{{ $saveData_spc_lr["sedate"] }}',
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    // Initialize DataTable
    var table = $('#all_table').DataTable({
        processing: true,
        serverSide: true,
        scrollY: true,
        scrollX: true,
        pageLength: 10,
        lengthMenu: [10, 50, 100, 1000],
        language: {
            search: ''
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print', 'pageLength', 'colvis'
        ],
        ajax: {
            url: '{{ route('admin.attendence.data') }}',
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token here
            },
            data: function(d) {
                d.startDate = $('#datetimes').data('daterangepicker') ? $('#datetimes').data('daterangepicker').startDate.format('YYYY-MM-DD') : '';
                d.endDate = $('#datetimes').data('daterangepicker') ? $('#datetimes').data('daterangepicker').endDate.format('YYYY-MM-DD') : '';
            },
            error: function(data) {
                $("#all_table").hide();
                alert('Error: ' + data.responseText);
            }
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
           @foreach($dates as $date)
        { data: '{{ $date }}', render: function(data, type, row) {
            return data ? data.replace(/\n/g, '<br>') : ''; // Replace newline with <br> for better display
        }},
    @endforeach
        ]
    });

    // Submit button click handler
    $('#submit').click(function() {
        var startD = $('#datetimes').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endD = $('#datetimes').data('daterangepicker').endDate.format('YYYY-MM-DD');

        $.ajax({
            type: 'GET',
            url: '{{ route('admin.attendence.click') }}',
            data: {
                startDate: startD,
                endDate: endD
            },
            success: function(response) {
                table.ajax.reload(); // Reload DataTable data
                location.reload(); // Reload the page
            }
        });
    });
});
    </script>
@endsection
