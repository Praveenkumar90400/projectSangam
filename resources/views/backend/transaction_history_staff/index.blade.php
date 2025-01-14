@extends('backend.layouts.master')
@section('title')
    Transaction History
@endsection
@section('content')

    {{-- @section('content')  <!-- Use @section to define content that will be injected into the master layout --> --}}

    <div class="card">
        <div class="card-header bg-light">
            <div class="text-end">
                <h4 class="text-dark"> Transaction History </h4>
            </div>
        </div>
        <div class="card-body">
            @if ($transactionData)
          
            <div class="table-responsive ">
                <table class="table table-striped table-bordered" id="all_table" style="width: 100%; margin-top: 20px;">
                    <thead class="thead-dark">
                        <tr>

                            <th>#</th>
                            <th>User Id</th>
                            <th>User name</th>
                            <th>User role</th>
                         
                            <th>Amount</th>
                            <th>Amount Type</th>
                            <th>Balance</th>
                            <th>reason</th>
                            <th>created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                        $counter = 1;
        
                        @endphp
                           
                            @foreach ($transactionData as $transaction)
                            @php
                        @endphp
                                <tr>
                                    <td>{{ $counter++ }}</td> <!-- Increment the counter for each transaction -->
                                    <td>{{ $transaction->user_id }}</td> <!-- Display staff ID -->
                                    <!-- Display transaction ID -->
                                    <td>{{ $transaction->user->name ?? 'N/A' }}</td>
                                    <td>{{ $transaction->user->role->role ?? 'N/A' }}</td> <!-- Accessing the user's role, assuming a relationship to Role -->
                                    <td>{{ number_format($transaction->amount) }}</td>
                                    <td>{{ $transaction->amount_type == 0 ? 'Credit' : 'Debit' }}</td>
                                    <td>{{$transaction->balance}}</td>
                                    <td>{{$transaction->reason}}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') }}
                                </tr>
                            @endforeach
                    </tbody>


                </table>
            </div>
            @else
                
            <p>No transactions available.</p>

            @endif
        </div>
    </div>
    <!-- Transaction History Table -->

@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
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
