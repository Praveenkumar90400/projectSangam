@extends('backend.layouts.master')
@section('title')
    Factory In Out Listing
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('content')

    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
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
            <span class="d-inline-block">
                <div class="row mx-2 my-2">
                    <div class="col">
                        <h4 class="header-title">{{ __('Factory In Out List') }}</h4>
                    </div>
                    <div class="col-md-3 form-group">
                        <input class="form-control" type="text" id="date-range" name="date_range"
                            placeholder="Select Date Range" />
                    </div>
                    <div class="col-md-2">
                        <button id="submit" type="button" title="Search based on filter"
                            class="btn btn-success">Search</button>
                    </div>
                </div>
            </span>
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="statud">
                        @if (Session::has('status'))
                            <div class="alert alert-success">
                                <h6>{{ Session::get('status') }}</h6>
                            </div>
                        @endif
                        @if (Session::has('danger'))
                            <div class="alert alert-danger">
                                <h6>{{ Session::get('danger') }}</h6>
                            </div>
                        @endif
                        @if (Session::has('primary'))
                            <div class="alert alert-primary">
                                <h6>{{ Session::get('primary') }}</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="tab-content margin-top-40">
                            @php $b=0; @endphp

                            <div class="tab-pane fade @if ($b == 0) show active @endif" id="slider_tab"
                                role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_table">
                                        <thead>
                                            <th>{{ 'ID' }}</th>
                                            <th>{{ 'Staff' }}</th>
                                            <th>{{ 'Factory' }}</th>
                                            <th>{{ 'Entry_Gate' }}</th>
                                            <th>{{ 'Entry Driver Name' }}</th>
                                            <th>{{ 'Vehicle Number' }}</th>
                                            <th>{{ 'In_Time' }}</th>
                                            <th>{{ 'Entry_Remark' }}</th>
                                            <th>{{ 'Entry_Weight' }}</th>
                                            <th>{{ 'Exit Driver Name' }}</th>
                                            <th>{{ 'Exit_Gate' }}</th>
                                            <th>{{ 'Out_Time' }}</th>
                                            <th>{{ 'Exit_Remark' }}</th>
                                            <th>{{ 'Exit_Weight' }}</th>
                                        </thead>
                                        <tbody>

                                            @foreach ($factoryGateLogs as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->entry_gate_number }}</td>
                                                    <td>{{ $data->entry_driver_name }}</td>
                                                    <td>{{ $data->rc_number }}</td>
                                                    {{-- <td>
                                                {{ $data->state_code . '-' . $data->district_code . '-' . $data->serial_code . '-' . $data->unique_code }}
                                            </td> --}}
                                                    <td>{{ \Carbon\Carbon::parse($data->in_time)->format('H:i:s') }}</td>


                                                    <td>{{ $data->entry_remark }}</td>
                                                    <td>{{ $data->entry_weight }}</td>
                                                    <td>{{ $data->exit_driver_name }}</td>
                                                    <td>{{ $data->exit_gate_number }}</td>
                                                    <td>{{ $data->out_time }}</td>
                                                    <td>{{ $data->exit_remark }}</td>
                                                    <td>{{ $data->exit_weight }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @php $b++; @endphp

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
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format(
                    'YYYY-MM-DD'));
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
                ],

                "order": [
                    [0, "desc"] // Assuming the date is in the first column (index 0)
                ]
            });

            // Handle Search button click
            $('#submit').on('click', function() {
                var dateRange = $('#date-range').val();
                if (dateRange) {
                    window.location.href = '{{ route('factory_in_out') }}?date_range=' + dateRange;
                }
            });
        });
    </script>
@endsection
