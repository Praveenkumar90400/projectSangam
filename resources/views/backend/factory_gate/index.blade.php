@extends('backend.layouts.master')
@section('title')
Factory Gate
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
         <h4 class="header-title">{{__('Factory Gate')}}</h4>
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
                   
                    <div class="bulk-delete-wrapper">
                        <div class="select-box-wrap d-flex justify-content-end">
                            <div class="float-right mb-3">
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Factory Gate</a>
                            </div>
                            <!-- Start : add factory -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{__('Add Factory Gate')}}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.factory_gates.store')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Gate Number</label>
                                                    <input type="text" class="form-control" name="gate_no" id="gate_no" placeholder="Enter Factory name">
                                                </div>

                                                <input type="hidden" name="factory_id" value="{{$factory->id}}">
                                                <input type="hidden" name="factory_name" value="{{$factory->name}}">

                                                <div class="form-group">
                                                    <label for="latitude">Latitude</label>
                                                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Longitude</label>
                                                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter Langitude">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End : add factory -->
                        </div>

                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @php $a=0; @endphp
                    </ul>
                    <div class="tab-content margin-top-40">
                        @php $b=0; @endphp

                        <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab" role="tabpanel">
                            <div class="table-wrap table-responsive">
                                <table class="table table-default" id="all_table">
                                    <thead>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Gate Number')}}</th>
                                        <th>{{__('Factory Name')}}</th>
                                        <th>{{__('Latitude')}}</th>
                                        <th>{{__('Longitude')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                    {{-- @dd($factoryGate); --}}
                                        @foreach($factoryGate as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->gate_nu}}</td>
                                            <td>{{$data->factory_name}}</td>
                                            <td>{{$data->latitude}}</td>
                                            <td>{{$data->longitude}}</td>

                                            <td class="d-flex">
                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="btn text-white btn-secondary btn-xs mb-3 mr-1 testimonial_view_btn" data-id="{{$data->id}}" data-name="{{$data->name}}" data-email="{{$data->email}}" data-phone="{{$data->phone}}" data-city="{{$data->city}}" data-pincode="{{$data->pincode}}" data-state="{{$data->state}}" data-address="{{$data->address}}" data-role_id="{{$data->role_id}}">
                                                    <i class="ti-eye">view</i>
                                                </a>&nbsp;
                                                </a> --}}
                                                
                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_edit_btn" 
                                                data-id="{{$data->id}}" 
                                                data-gate_nu="{{$data->gate_nu}}" 
                                                data-latitude="{{$data->latitude}}" 
                                                data-longitude="{{$data->longitude}}">
                                                <i class="ti-pencil">edit</i>
                                                </a>&nbsp; --}}
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" 
                                                class="btn btn-link p-1 testimonial_edit_btn" 
                                                data-id="{{ $data->id }}" 
                                                data-gate_nu="{{ $data->gate_nu }}" 
                                                data-latitude="{{ $data->latitude }}" 
                                                data-longitude="{{ $data->longitude }}" 
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                                </a>&nbsp;&nbsp;
                                                {{-- <form action="{{route('admin.factory_gates.delete',$data->id)}}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>&nbsp; --}}

                                                <form action="{{ route('admin.factory_gates.delete', $data->id) }}" method="POST" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-danger p-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </form>&nbsp;


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

<div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Factory Gate')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{route('admin.factory_gates.update')}}" id="testimonial_edit_modal_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="gallery_id" value="">
                    <div class="form-group">
                        <label for="name">Gate Number</label>
                        <input type="text" class="form-control" name="gate_nu" id="gate_nu" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude">
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter Longitude">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- View Modal Satrt --}}
<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Staff Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body  input-amenty">
                <table class="table view-table" id="testimonial_view_modal_form">
                    <tbody>
                        <tr>
                            <th scope="row">ID</th>
                            <td></td>
                            <td><input type="text" id="id" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>
                            <td></td>
                            <td><input type="text" id="name" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td></td>
                            <td><input type="text" id="email" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td></td>
                            <td><input type="text" id="phone" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">City</th>
                            <td></td>
                            <td><input type="text" id="city" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Pincode</th>
                            <td></td>
                            <td><input type="text" id="pincode" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">State</th>
                            <td></td>
                            <td><input type="text" id="state" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td></td>
                            <td><input type="text" id="address" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Role ID</th>
                            <td></td>
                            <td><input type="text" id="role_id" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- View Modal End --}}


@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}

<!-- Bootstrap JS and dependencies -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script>
    $(document).ready(function() {
         $("#all_table").dataTable();


        $(document).on('click', '.testimonial_edit_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var gate_nu = el.data('gate_nu');
            var latitude = el.data('longitude');
            var longitude = el.data('longitude');

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#gate_nu').val(el.data('gate_nu'));
            form.find('#latitude').val(el.data('latitude'));
            form.find('#longitude').val(el.data('longitude'));
           
            // form.find('#password').val(el.data('password'));
            form.find('.form-check-input').each(function() {
                var checkbox = $(this);
                if (amenities.includes(checkbox.val())) {
                    checkbox.prop('checked', true);
                } else {
                    checkbox.prop('checked', false);
                }
            });


        });

        $(document).on('click', '.testimonial_view_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            var image = el.data('email');
            var description = el.data('phone');
            var status = el.data('city');
            var pincode = el.data('pincode');
            var state = el.data('state');
            var address = el.data('address');
            var role_id = el.data('role_id');

            var form = $('#testimonial_view_modal_form');
            form.find('#id').val(id);
            form.find('#name').val(el.data('name'));
            form.find('#email').val(el.data('email'));
            form.find('#phone').val(el.data('phone'));
            form.find('#city').val(el.data('city'));
            form.find('#pincode').val(el.data('pincode'));
            form.find('#state').val(el.data('state'));
            form.find('#address').val(el.data('address'));
            form.find('#role_id').val(el.data('role_id'));


        });


    });
</script>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this Factory Gate?');
    }
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>
@endsection