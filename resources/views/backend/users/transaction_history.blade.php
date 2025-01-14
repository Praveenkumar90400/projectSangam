@extends('backend.layouts.master')
@section('title')
Transaction History
@endsection
@section('content')

{{-- @section('content')  <!-- Use @section to define content that will be injected into the master layout --> --}}

<div class="card">
    <div class="card-header bg-light">
        <div class="text-end">
            <h4 class="text-dark"> Wallet Balance : ₹{{ number_format($userAmount) }}</h4>
        </div>
    </div>
    <div class="card-body">
        @if ($transactions->isEmpty())
        {{-- @dd($transactionData); --}}
        <p>No transactions available.</p>
    @else
        <div class="table-responsive ">
            <table class="table table-striped table-bordered" id="all_table" style="width: 100%; margin-top: 20px;">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Payment ID</th>
                        <th>Status</th>
                        <th>Transaction Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $key=> $transaction)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $transaction->user_id }}</td>
                            <td>Rs {{ number_format($transaction->amount) }}</td>
                            <td>{{ $transaction->payment_id }}</td>
                            <td>
                                <span class="badge-{{ $transaction->payment_status == 1 ? 'success' : ($transaction->payment_status == 2 ? 'warning' : 'danger') }}">
                                    {{ $transaction->payment_status == 1 ? 'Success' : ($transaction->payment_status == 2? 'Pending' : 'Failed') }}
                                </span>
                                
                            </td>
                            <td>{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
    @endif
    </div>
</div>
<!-- Transaction History Table -->




<script>
    $(document).ready(function() {
        $("#all_table").dataTable();

        // Edit button click handler
        $(document).on('click', '.testimonial_edit_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            
            console.log(city);

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#edit_name').val(name);
           
            
            // Store the previous city in a data attribute
            $('#edit_city').data('previous-city', city);
            
            // Trigger pincode change event to fill city, district, and state
            if (pincode) {
                $('#edit_pincode').trigger('change');
            } else {
                // Preserve the previous city if no pincode
                $('#edit_city').val(city);
            }
        });

        // View button click handler
        $(document).on('click', '.testimonial_view_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
           
            var form = $('#testimonial_view_modal_form');
            form.find('#id').val(id);
            form.find('#view_name').val(name);
            
        });

        // Pincode change handler for add form
        $('#add_pincode').on('change', function () {
            var pincode = $(this).val();

            if (pincode) {
                $.ajax({
                    url: "{{ route('admin_postal.postal.pincode') }}",
                    type: 'GET',
                    data: { pincode: pincode },
                    success: function (response) {
                        if (response.district && response.state && response.city) {
                            $('#district').val(response.district);
                            $('#state').val(response.state);

                            $('#city').empty();
                            $('#city').append('<option value="">Select your city</option>');

                            response.city.forEach(function (city) {
                                $('#city').append('<option value="' + city + '">' + city + '</option>');
                            });
                        } else {
                            $('#district').val('');
                            $('#city').empty();
                            $('#city').append('<option value="">Select your city</option>');
                            $('#state').val('');
                        }
                    },
                    error: function () {
                        $('#district').val('');
                        $('#city').empty();
                        $('#city').append('<option value="">Select your city</option>');
                        $('#state').val('');
                    }
                });
            } else {
                $('#district').val('');
                $('#city').empty();
                $('#city').append('<option value="">Select your city</option>');
                $('#state').val('');
            }
        });

        // Pincode change handler for edit form
       $(document).on('change', '#edit_pincode', function () {
            var pincode = $(this).val();

            if (pincode) {
                $.ajax({
                    url: "{{ route('admin_postal.postal.pincode') }}",
                    type: 'GET',
                    data: { pincode: pincode },
                    success: function (response) {
                        if (response.district && response.state && response.city) {
                            $('#edit_district').val(response.district);
                            $('#edit_state').val(response.state);

                            // Clear and populate the city dropdown
                            $('#edit_city').empty();
                            $('#edit_city').append('<option value="">Select your city</option>');

                            var previousCity = $('#edit_city').data('previous-city');

                            // Add new city options
                            response.city.forEach(function (city) {
                                $('#edit_city').append('<option value="' + city + '">' + city + '</option>');
                            });

                            // Select the previous city if it is in the new options
                            if (previousCity && response.city.includes(previousCity)) {
                                $('#edit_city').val(previousCity);
                            } else {
                                $('#edit_city').val('');
                            }
                        } else {
                            // Clear the fields if no valid response
                            $('#edit_district').val('');
                            $('#edit_city').empty();
                            $('#edit_city').append('<option value="">Select your city</option>');
                            $('#edit_state').val('');
                        }
                    },
                    error: function () {
                        // Handle error case
                        $('#edit_district').val('');
                        $('#edit_city').empty();
                        $('#edit_city').append('<option value="">Select your city</option>');
                        $('#edit_state').val('');
                    }
                });
            } else {
                // If no pincode, clear fields but preserve previous city selection
                $('#edit_district').val('');
                $('#edit_city').empty();
                $('#edit_city').append('<option value="">Select your city</option>');
                $('#edit_city').val($('#edit_city').data('previous-city'));
                $('#edit_state').val('');
            }
        });
    });
</script>

@endsection
