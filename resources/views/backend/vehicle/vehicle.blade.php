@extends('backend.layouts.master')
@section('title')
    Vehicle
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
            <h4 class="header-title">{{ __('Vehicle List') }}</h4>
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

                        {{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @php $a=0; @endphp
                    </ul> --}}
                        <div class="tab-content margin-top-40">
                            @php $b=0; @endphp

                            <div class="tab-pane fade @if ($b == 0) show active @endif" id="slider_tab"
                                role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_table">
                                        <thead>
                                            <th>{{ __('ID') }}</th>
                                            {{-- <th>{{__('State Code')}}</th>
                                        <th>{{__('District Code')}}</th>
                                        <th>{{__('Serial Code')}}</th>
                                        <th>{{__('Unique Code')}}</th> --}}
                                            <th>{{ __('RC_Number') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Onboard date') }}</th>

                                            <th>{{ __('RC Issue Date') }}</th>
                                            <th>{{ __('RC Expiry Date') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </thead>
                                        <tbody>

                                            @foreach ($rcdetails as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    {{-- <td>{{$data->state_code}}</td>
                                            <td>{{$data->district_code}}</td>
                                            <td>{{$data->serial_code}}</td>
                                            <td>{{$data->unique_code}}</td> --}}
                                                    <td>{{ $data->rc_number }}</td>
                                                    <td>
                                                        @if (file_exists(public_path($data->vehicle_image)) && $data->vehicle_image)
                                                            <img src="{{ asset($data->vehicle_image) }}" width="50"
                                                                height="40" style="height: 45px;width: 65px;">
                                                        @else
                                                            <p>No-image-available</p>
                                                        @endif
                                                    </td>

                                                    <td>{{ $data->rc_status ? 'Valid' : 'Invalid' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}</td>

                                                    <td>{{ $data->rc_issue_date }}</td>
                                                    <td>{{ $data->expiry_date }}</td>
                                                    {{-- view data start --}}
                                                    <td>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#viewModal{{ $data->id }}"
                                                            class="btn btn-link text-secondary p-0 m-0 mb-3 mr-1 testimonial_view_btn"
                                                            data-id="{{ $data->id }}"
                                                            data-rc_number="{{ $data->rc_number }}"
                                                            data-status="{{ $data->rc_status ? 'Valid' : 'Invalid' }}"
                                                            data-issue_date="{{ $data->rc_issue_date }}"
                                                            data-expiry_date="{{ $data->expiry_date }}">
                                                            <i class="bi bi-eye"></i>
                                                        </a>

                                                        {{-- view data end --}}

                                                        {{-- edit data start --}}
                                                        <a href="#"
                                                            class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_edit_btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $data->id }}"
                                                            class="btn btn-link text-secondary p-0 m-0 mb-3 mr-1 testimonial_view_btn"
                                                            data-id="{{ $data->id }}"
                                                            data-rc_number="{{ $data->rc_number }}"
                                                            data-status="{{ $data->rc_status ? 'Valid' : 'Invalid' }}"
                                                            data-issue_date="{{ $data->rc_issue_date }}"
                                                            data-expiry_date="{{ $data->expiry_date }}"><i
                                                                class="bi bi-pencil-square"></i></a>
                                                        {{-- edit data end --}}
                                                       <a href="{{route('vehicle.destroy',['id'=>$data->id])}}" class="btn btn-link text-danger p-0 m-0 mb-3 mr-1 testimonial_edit_btn"
                                                        onclick="return confirm('Are you sure you want to delete this vehicle?')">

                                                                <i class="bi bi-trash"></i>
                                                       </a>
                                                        <div>
                                                            {{-- View Modal Satrt --}}
        
                                                            <div class="modal fade" id="viewModal{{ $data->id }}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Vehical
                                                                                Information</h5>
                                                                            <button type="button" class="close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">X</button>
                                                                        </div>
                                                                        <div class="modal-body  input-amenty">
                                                                            <table class="table view-table"
                                                                                id="testimonial_view_modal_form">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th scope="row">ID</th>
                                                                                        <td></td>
                                                                                        <td><input type="text" id="view-id"
                                                                                            value="{{$data->id}}"    readonly></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">RC_Number</th>
                                                                                        <td></td>
                                                                                        <td><input type="text"
                                                                                                id="view-rc-number" readonly></td>
                                                                                    </tr>
        
                                                                                    <tr>
                                                                                        <th scope="row">Status</th>
                                                                                        <td></td>
                                                                                        <td><input type="text" id="view-status"
                                                                                                readonly></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">RC Issue Date</th>
                                                                                        <td></td>
                                                                                        <td><input type="text"
                                                                                                id="view-issue-date" readonly></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th scope="row">RC Expiry Date</th>
                                                                                        <td></td>
                                                                                        <td><input type="text"
                                                                                                id="view-expiry-date" readonly></td>
                                                                                    </tr>
        
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
        
                                                            {{-- View Modal End --}}
        
                                                            {{-- edit modal start --}}
                                                            <div class="modal fade" id="editModal{{ $data->id }}"
                                                                tabindex="-1" aria-labelledby="editModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form id="testimonial_edit_modal_form"
                                                                            action="{{ route('vehicle.update', ['id' => $data->id]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="editModalLabel">Edit
                                                                                    Vehicle</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close">X</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <input type="hidden" id="edit_id"
                                                                                    name="id">
                                                                                <div class="mb-3">
                                                                                    <label for="edit_rc_number"
                                                                                        class="form-label">RC Number</label>
                                                                                    <input type="text" class="form-control"
                                                                                        id="edit_rc_number" value="{{$data->rc_number}}" name="rc_number"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="edit_status"
                                                                                        class="form-label">Status</label>
                                                                                    <select class="form-control" id="edit_status"
                                                                                        name="status" required>
                                                                                        <option value="Valid">Valid</option>
                                                                                        <option value="Invalid">Invalid</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="edit_issue_date"
                                                                                        class="form-label">RC Issue Date</label>
                                                                                    <input type="date" class="form-control"
                                                                                        id="edit_issue_date" name="issue_date"
                                                                                        required>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label for="edit_expiry_date"
                                                                                        class="form-label">RC Expiry Date</label>
                                                                                    <input type="date" class="form-control"
                                                                                        id="edit_expiry_date" name="expiry_date"
                                                                                        required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
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







    {{-- edit modal end --}}

@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}

    <!-- Bootstrap JS and dependencies -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>


    <script>
        $(document).ready(function() {

            $("#all_table").dataTable();


            //  console.log({ id, rcNumber, status, issueDate, expiryDate });

            $(document).on('click', '.testimonial_view_btn', function() {
                // Fetch data from button attributes
                const id = $(this).data('id');
                const rcNumber = $(this).data('rc_number');
                const status = $(this).data('status');
                const issueDate = $(this).data('issue_date');
                const expiryDate = $(this).data('expiry_date');

                // Populate modal fields
                $('#view-id').val(id);
                $('#view-rc-number').val(rcNumber);
                $('#view-status').val(status);
                $('#view-issue-date').val(issueDate);
                $('#view-expiry-date').val(expiryDate);
            });
        });


        $(document).on('click', '.testimonial_edit_btn', function() {
            // Fetch data from button attributes
            const id = $(this).data('id');
            const rcNumber = $(this).data('rc_number');
            const status = $(this).data('status');
            const issueDate = $(this).data('issue_date');
            const expiryDate = $(this).data('expiry_date');

            // Reference the edit modal form
            const form = $('#testimonial_edit_modal_form');

            // Populate the form fields with the data
            form.find('#edit_id').val(id);
            form.find('#edit_rc_number').val(rcNumber);
            form.find('#edit_status').val(status);
            form.find('#edit_issue_date').val(issueDate);
            form.find('#edit_expiry_date').val(expiryDate);

            // Show the modal (if not already shown)
            $('#editModal').modal('show');
        });
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endsection
