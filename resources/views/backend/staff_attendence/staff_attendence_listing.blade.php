@extends('backend.layouts.master')

@section('title')
    Attendance
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
          

                {{-- start search range --}}

                <span class="d-inline-block">
                    <div class="row mx-2 my-2">
                        <div class="col"><h4 class="header-title">{{ __('Staff Attendence List') }}</h4></div>
                        <div class="col-md-3 form-group">
                            <input class="form-control" type="text" id="date-range" name="date_range" placeholder="Select Date Range"/>
                        </div>
                        <div class="col-md-2">
                            <button id="submit" type="button" title="Search based on filter" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </span>

                {{-- end search range --}}





                    @php
                    use Illuminate\Support\Facades\DB;
                    use Carbon\Carbon;
                        $data = DB::table('staff_attendances')
                    ->join('users', 'staff_attendances.user_id', '=', 'users.id')  // Assuming 'user_id' is the foreign key
                    ->select('staff_attendances.*', 'users.name as staff_name', 'users.phone')
                    ->get();
                            
                    foreach ($data as $attendance) {
                    if ($attendance->punchin && $attendance->punchout) {
                        $punchin = Carbon::parse($attendance->punchin);  
                        $punchout = Carbon::parse($attendance->punchout); 

                       
                        $totalSeconds = $punchin->diffInSeconds($punchout);

                        
                        $hours = floor($totalSeconds / 3600);
                        $minutes = floor(($totalSeconds % 3600) / 60);
                        $seconds = $totalSeconds % 60;

                        // Format the time duration
                        $attendance->time_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    } else {
                        $attendance->time_duration = 'N/A';  
                    }
                }

                @endphp

              
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content margin-top-40">
                            <div class="tab-pane fade show active" id="slider_tab" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_table">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0"> Staff ID</th>
                                                <th class="border-bottom-0">Staff Name</th>
                                                <th class="border-bottom-0">Mobile</th>
                                                <th class="border-bottom-0">Attendance Date</th>
                                                <th class="border-bottom-0">Punch In</th>
                                                <th class="border-bottom-0">Punch Out</th>
                                                <th class="border-bottom-0">Time Duration</th>
                                              
                                            </tr>
                                           
                                        </thead>
                                        <tbody>
                                            @foreach($data as $attendance)
                                                <tr>
                                                    <td>{{ $attendance->id }}</td>
                                                    <td>{{ $attendance->staff_name }}</td>
                                                    <td>{{ $attendance->phone }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($attendance->created_at)->toDateString() }}</td>

                                                    <td>{{ \Carbon\Carbon::parse($attendance->punchin)->format('h:i:s A') }}</td>


                                                    <td>{{ \Carbon\Carbon::parse($attendance->punchout)->format('h:i:s A') }}</td>

                                                    <td>{{ $attendance->time_duration }}</td>  
                                                </tr>
                                            @endforeach
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Date Range Picker
            $('#date-range').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                autoUpdateInput: false,
                opens: 'left'
            });
        
            // Update input field on date range select
            $('#date-range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
            });
        
            // Clear input field on cancel
            $('#date-range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        
            // Initialize DataTable with Buttons
            $("#all_table").DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'print'
                ]
            });
        
            // Handle Search button click
            $('#submit').on('click', function() {
                var dateRange = $('#date-range').val();
                if(dateRange) {
                    window.location.href = '{{ route("factory_in_out") }}?date_range=' + dateRange;
                }
            });
        });
        </script>
@endsection
