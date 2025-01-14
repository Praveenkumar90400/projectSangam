@extends('backend.layouts.master')
@section('title')
Factory
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBa4HGKRIPl25grMkEoj-Fzl5vbQWyS39g&callback=initMap" async defer></script>
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
        <h4 class="header-title">{{__('Factories')}}</h4>
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
                                        @php
                                            $moduleId = 5;
                                            // add permission
                                            $addPermissionRoleIds = \DB::table('permission_role')
                                                ->whereIn('permission_id', function ($query) use ($moduleId) {
                                                    $query->select('id')
                                                        ->from('permissions')
                                                        ->where('module_id', $moduleId)
                                                        ->where('name', 'Add');
                                                })
                                                ->pluck('role_id')
                                                ->toArray();
                                            $canAdd = in_array(auth()->user()->role_id, $addPermissionRoleIds);
                                        @endphp

                            <div class="float-right mb-3">
                            @if($canAdd)
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Factory</a>
                            @endif    
                            </div>
                            <!-- Start : add factory -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                            <h5 class="modal-title">{{__('Add Factory')}}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.factory.store')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Factory name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="latitude">Latitude</label>
                                                    <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude">
                                                </div>
                                                <div class="form-group">
                                                    <label for="longitude">Longitude</label>
                                                    <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter Langitude">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gates">Number of Gates</label>
                                                    <input type="text" class="form-control" name="gates" id="gates" placeholder="Nu. of Gates">
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
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
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Latitude')}}</th>
                                        <th>{{__('Longitude')}}</th>
                                        <th>{{__('Address')}}</th>
                                        <th>{{__('Nu of Gates')}}</th>
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>

                                        @php
                                            $moduleId = 5;
                                            $editPermissionRoleIds = \DB::table('permission_role')
                                                ->whereIn('permission_id', function ($query) use ($moduleId) {
                                                    $query->select('id')
                                                        ->from('permissions')
                                                        ->where('module_id', $moduleId)
                                                        ->where('name', 'Edit');
                                                })
                                                ->pluck('role_id')
                                                ->toArray();

                                            // delete permission 
                                            $deletePermissionRoleIds = \DB::table('permission_role')
                                                ->whereIn('permission_id', function ($query) use ($moduleId) {
                                                    $query->select('id')
                                                        ->from('permissions')
                                                        ->where('module_id', $moduleId)
                                                        ->where('name', 'Delete');         })
                                                ->pluck('role_id')
                                                ->toArray();


                                            $canEdit = in_array(auth()->user()->role_id, $editPermissionRoleIds);
                                            $canDelete = in_array(auth()->user()->role_id, $deletePermissionRoleIds);
                                        @endphp


                                        @foreach($factory as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->latitude}}</td>
                                            <td>{{$data->longitude}}</td>
                                            <td>{{$data->address}}</td>
                                            <td>{{$data->number_of_gates}}</td>
                                            <td>{{$data->phone}}</td>

                                            <td class="d-flex">

                                                {{-- @if($canEdit)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_edit_btn" 
                                                data-id="{{$data->id}}" 
                                                data-name="{{$data->name}}" 
                                                data-latitude="{{$data->latitude}}" 
                                                data-longitude="{{$data->longitude}}" 
                                                data-address="{{$data->address}}" 
                                                data-gates="{{$data->number_of_gates}}" 
                                                data-phone="{{$data->phone}}">
                                                <i class="ti-pencil">edit</i>
                                                </a>&nbsp;
                                                @endif --}}

                                                @if($canEdit)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" 
                                                class="btn btn-link text-primary btn-xs p-1 m-0 testimonial_edit_btn" 
                                                data-id="{{$data->id}}" 
                                                data-name="{{$data->name}}" 
                                                data-latitude="{{$data->latitude}}" 
                                                data-longitude="{{$data->longitude}}" 
                                                data-address="{{$data->address}}" 
                                                data-gates="{{$data->number_of_gates}}" 
                                                data-phone="{{$data->phone}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="bi bi-pencil-square"></i> <!-- Pencil icon -->
                                                </a>&nbsp;
                                                @endif
                                               
                                                {{-- @if($canDelete)
                                                <form action="{{route('admin.factory.delete',$data->id)}}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>&nbsp;
                                                @endif --}}

                                                @if($canDelete)
                                                <form action="{{ route('admin.factory.delete', $data->id) }}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-danger p-1 m-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
                                                    </button>
                                                </form>&nbsp;
                                                @endif

                                                
                                                 {{-- <a href="{{ route('admin.factory_gates.index', $data->id) }}" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_edit_btn">Gate Details</a> --}}

                                                 <a href="{{ route('admin.factory_gates.index', $data->id) }}" class="btn btn-link text-primary p-1 m-0 mb-3 mr-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Gate Details">
                                                    <i class="fas fa-info-circle"></i> <!-- Font Awesome gate icon -->
                                                </a>
                                                  
                                                 


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

        {{-- map --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="map" style="height: 500px; width: 100%;">
                    </div>
                </div>
            </div>
        </div>        
        {{-- map --}}

    </div>
</div>

<div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Factory')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{route('admin.factory.update')}}" id="testimonial_edit_modal_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="gallery_id" value="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude">
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter Longitude">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                    </div>
                    <div class="form-group">
                        <label for="gates">Number oF Gates</label>
                        <input type="text" class="form-control" name="gates" id="gates" placeholder="Nu. of Gates">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
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



@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>


<script>
    $(document).ready(function() {

        $("#all_table").dataTable();

        $(document).on('click', '.testimonial_edit_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            var latitude = el.data('latitude');
            var longitude = el.data('longitude');
            var address = el.data('address');
            var gates = el.data('gates');
            var phone = el.data('phone');

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#name').val(el.data('name'));
            form.find('#latitude').val(el.data('latitude'));
            form.find('#longitude').val(el.data('longitude'));
            form.find('#address').val(el.data('address'));
            form.find('#gates').val(el.data('gates'));
            form.find('#phone').val(el.data('phone'));
           
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


    });
</script>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this Factory?');
    }
</script>

<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -34.397, lng: 150.644},
        zoom: 8
    });

    var marker = new google.maps.Marker({
        position: {lat: 34.397, lng: 150.644},
        map: map,
        draggable: true
    });

    google.maps.event.addListener(marker, 'position_changed', function() {
        var lat = marker.getPosition().lat();
        var lng = marker.getPosition().lng();
        console.log('Latitude: ' + lat + ', Longitude: ' + lng);
        // You can use these coordinates to save or display the selected location
    });
}
</script>

@endsection