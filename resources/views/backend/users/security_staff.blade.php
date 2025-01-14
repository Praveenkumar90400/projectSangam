@extends('backend.layouts.master')
@section('title')
Staff
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <h4 class="header-title">{{__('Security Staff')}}</h4>
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
                            <!-- <select name="bulk_option" id="bulk_option">
                                <option value="">{{{__('Bulk Action')}}}</option>
                                <option value="delete">{{{__('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm" id="bulk_delete_btn">{{__('Apply')}}</button> -->

                                        @php
                                            $moduleId = 2;
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
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Staff</a>
                            @endif    
                            </div>
                            <!-- Start : add staff -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                <div class="modal-dialog" style="max-width:50%; width:100%">
                                    <div class="modal-content" >
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{__('Add Staff')}}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.staff.store' )}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email <span style="color: red;">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email"required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Profile Image</label>
                                                    <input type="file" class="form-control" name="image" id="image" placeholder="Profile Image">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select class="form-control" name="gender" id="gender">
                                                        <option value="">Select your gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Enter your phone number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="pincode">Pincode<span style="color: red;">*</span></label>
                                                    <input type="number" class="form-control" name="pincode" id="add_pincode" placeholder="Enter your pincode" required>
                                                </div>
                                               
                                           
                                                <div class="form-group">
                                                    <label for="district">District</label>
                                                    <input type="text" class="form-control" name="district" id="district" placeholder="" readonly>
                                                </div>
                                             </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">City</label>
                                                    <select class="form-control" name="city" id="city">
                                                        <option value="">Select your city</option>
                                                        <!-- Cities will be dynamically added here -->
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">State</label>
                                                    <input type="text" class="form-control" name="state" id="state" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter your address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="guest_name">{{ __('Role') }}<span style="color: red;">*</span></label>
                                                    <select class="form-control" name="role_id" id="role_id" required>
                                                        <option value="">{{ __('Select Role') }}</option>
                                                        {{-- @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                                                        @endforeach --}}
                                                        <option value=3>Staff</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="guest_name">{{ __('Factory') }}</label>
                                                    <select class="form-control" name="factory_id" id="factory_id">
                                                        <option value="">{{ __('Select Factory') }}</option>
                                                        @foreach($factories as $factory)
                                                        <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password<span style="color: red;">*</span></label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password"required>
                                                </div>
                                             
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>  
                                        </div>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End : add staff -->
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
                                        <th>{{__('Email')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Phone')}}</th>
                                        <th>{{__('City')}}</th>
                                        <th>{{__('Pincode')}}</th>
                                        <th>{{__('Address')}}</th>
                                        {{-- <th>{{__('Role Id')}}</th> --}}
                                        {{-- <th>{{__('Factory Id')}}</th> --}}
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>

                                        @php
                                            $moduleId = 2;
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
                                            // edit permission
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
                                            // view permission 
                                            $viewPermissionRoleIds = \DB::table('permission_role')
                                                ->whereIn('permission_id', function ($query) use ($moduleId) {
                                                    $query->select('id')
                                                        ->from('permissions')
                                                        ->where('module_id', $moduleId)
                                                        ->where('name', 'View');         })
                                                ->pluck('role_id')
                                                ->toArray();


                                            $canAdd = in_array(auth()->user()->role_id, $addPermissionRoleIds);
                                            $canEdit = in_array(auth()->user()->role_id, $editPermissionRoleIds);
                                            $canDelete = in_array(auth()->user()->role_id, $deletePermissionRoleIds);
                                            $canView = in_array(auth()->user()->role_id, $viewPermissionRoleIds);
                                        @endphp

                                        @foreach($staffs as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>
                                                @if($data->image && file_exists(public_path($data->image)))
                                                    <img src="{{ asset($data->image) }}" alt="Image" style="height: 45px;width: 65px;">
                                                @else
                                                    <span> No Image Available</span>
                                                @endif
                                            </td>
                                            
                                            <td>{{$data->phone}}</td>
                                            <td>{{$data->city}}</td>
                                            <td>{{$data->pincode}}</td>
                                            <td>{{$data->address}}</td>
                                            {{-- <td>{{$data->role_id}}</td> --}}
                                            {{-- <td>{{$data->factory_id}}</td> --}}


                                            <td class="d-flex">
                                                {{-- @if($canView)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" class="btn text-white btn-secondary btn-xs mb-3 mr-1 testimonial_view_btn" data-id="{{$data->id}}" data-name="{{$data->name}}" data-email="{{$data->email}}" data-phone="{{$data->phone}}" data-city="{{$data->city}}" data-pincode="{{$data->pincode}}" data-state="{{$data->state}}" data-address="{{$data->address}}" data-role_id="{{$data->role_id}}">
                                                    <i class="ti-eye">view</i>
                                                </a>&nbsp;
                                                @endif --}}

                                                @if($canView)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#viewModal" 
                                                class="btn btn-link text-secondary p-0 m-0 mb-3 mr-1 testimonial_view_btn" 
                                                data-id="{{$data->id}}" 
                                                data-name="{{$data->name}}" 
                                                data-email="{{$data->email}}" 
                                                data-phone="{{$data->phone}}" 
                                                data-city="{{$data->city}}" 
                                                data-pincode="{{$data->pincode}}" 
                                                data-state="{{$data->state}}" 
                                                data-address="{{$data->address}}" 
                                                {{-- data-role_id="{{$data->role_id}}" --}}
                                                data-factory_id="{{$data->factory_id}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <i class="bi bi-eye"></i> <!-- Bootstrap Icons eye icon for view -->
                                                </a>&nbsp;
                                                @endif

                                                
                                                {{-- @if($canEdit)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_edit_btn"
                                                    data-id="{{$data->id}}"
                                                    data-name="{{$data->name}}"
                                                    data-email="{{$data->email}}"
                                                    data-image="{{$data->image}}"
                                                    data-gender="{{$data->gender}}"
                                                    data-phone="{{$data->phone}}"
                                                    data-city="{{$data->city}}"
                                                    data-pincode="{{$data->pincode}}"
                                                    data-state="{{$data->state}}"
                                                    data-address="{{$data->address}}"
                                                    data-role_id="{{$data->role_id}}"
                                                    data-password="{{$data->password}}">
                                                    <i class="ti-pencil">edit</i>
                                                </a>&nbsp;
                                                @endif --}}

                                                @if($canEdit)
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" 
                                                class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_edit_btn" 
                                                data-id="{{$data->id}}"
                                                data-name="{{$data->name}}"
                                                data-email="{{$data->email}}"
                                                data-image="{{$data->image}}"
                                                data-gender="{{$data->gender}}"
                                                data-phone="{{$data->phone}}"
                                                data-city="{{$data->city}}"
                                                data-district="{{$data->district}}"
                                                data-pincode="{{$data->pincode}}"
                                                data-state="{{$data->state}}"
                                                data-address="{{$data->address}}"
                                                {{-- data-role_id="{{$data->role_id}}" --}}
                                                data-factory_id="{{$data->factory_id}}"
                                                data-password="{{$data->password}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="bi bi-pencil-square"></i> <!-- Bold Bootstrap Icons pencil icon with a larger size -->
                                                </a>&nbsp;
                                                @endif

                                                {{-- @if($canDelete)
                                                <form action="{{route('admin.staff.destroy', $data->id)}}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>
                                                @endif --}}

                                                @if($canDelete)
                                                <form action="{{ route('admin.staff.destroy', $data->id) }}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="bi bi-trash"></i> <!-- Bootstrap Icons trash can icon -->
                                                    </button>
                                                </form>&nbsp;
                                                @endif


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
    <div class="modal-dialog" style="max-width:50%; width:100%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Staff')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{ route('users.edit') }}" id="testimonial_edit_modal_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="gallery_id" value="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" class="form-control" name="image" id="edit_image" placeholder="Profile Image">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="edit_gender">
                            <option value="">Select your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" id="edit_phone" placeholder="Enter your phone number">
                    </div>
                   
                    <div class="form-group">
                        <label for="pincode">Pincode</label>
                        <input type="number" class="form-control" name="pincode" id="edit_pincode" placeholder="Enter your pincode">
                    </div>
                    <div class="form-group">
                        <label for="district">District</label>
                        <input type="text" class="form-control" name="district" id="edit_district" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                  
                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control" name="city" id="edit_city">
                            <option value="">Select your city</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" name="state" id="edit_state" readonly>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="edit_address" placeholder="Enter your address">
                    </div>
                    <div class="form-group">
                        <label for="guest_name">{{ __('Role') }}</label>
                        <select class="form-control" name="role_id" id="edit_role_id">
                            <option value="">{{ __('Select Role') }}</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="guest_name">{{ __('Factory') }}</label>
                        <select class="form-control" name="factory_id" id="edit_factory_id">
                            <option value="">{{ __('Select Factory') }}</option>
                            @foreach($factories as $factory)
                            <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="edit_password" placeholder="Enter your password">
                        <!-- <input type="password" class="form-control" name="password" id="password"> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
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
                            <td><input type="text" id="view_name" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td></td>
                            <td><input type="text" id="view_email" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone</th>
                            <td></td>
                            <td><input type="text" id="view_phone" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">City</th>
                            <td></td>
                            <td><input type="text" id="view_city" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Pincode</th>
                            <td></td>
                            <td><input type="text" id="pincode" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">State</th>
                            <td></td>
                            <td><input type="text" id="view_state" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Address</th>
                            <td></td>
                            <td><input type="text" id="view_address" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Role ID</th>
                            <td></td>
                            <td><input type="text" id="view_role_id" readonly></td>
                        </tr>
                        <tr>
                            <th scope="row">Factory ID</th>
                            <td></td>
                            <td><input type="text" id="view_factory_id" readonly></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- View Modal End --}}


@endsection



@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>


{{-- <script>
    $(document).ready(function() {
        $("#all_table").dataTable();

        $(document).on('click', '.testimonial_edit_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            var email = el.data('email');
            var gender = el.data('gender');
            var phone = el.data('phone');
            var city = el.data('city');
            var district = el.data('district');
            var pincode = el.data('pincode');
            var state = el.data('state');
            var address = el.data('address');
            var role_id = el.data('role_id');
            var factory_id = el.data('factory_id');

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#name').val(el.data('name'));
            form.find('#email').val(el.data('email'));
            form.find('#gender').val(el.data('gender'));
            form.find('#phone').val(el.data('phone'));
            form.find('#city').val(el.data('city'));
            form.find('#district').val(el.data('district'));
            form.find('#pincode').val(el.data('pincode'));
            form.find('#state').val(el.data('state'));
            form.find('#address').val(el.data('address'));
            form.find('#role_id').val(el.data('role_id'));
            form.find('#factory_id').val(el.data('factory_id'));
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
            var factory_id = el.data('factory_id');

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
            form.find('#factory_id').val(el.data('factory_id'));


        });


        $('#add_pincode').on('change', function () {
            var pincode = $(this).val();

            if (pincode) {
                $.ajax({
                    url: "{{ route('admin_postal.postal.pincode') }}", // URL to hit the postal controller
                    type: 'GET',
                    data: {
                        pincode: pincode
                    },
                    success: function (response) {
                        if (response.district && response.state && response.city) {
                            // Set district and state as single values
                            $('#district').val(response.district);
                            $('#state').val(response.state);

                            // Clear the existing city dropdown options
                            $('#city').empty();
                            $('#city').append('<option value="">Select your city</option>');

                            // Add each city to the city dropdown
                            response.city.forEach(function (city) {
                                $('#city').append('<option value="' + city + '">' + city + '</option>');
                            });
                        } else {
                            // If no data is returned, clear the fields
                            $('#district').val('');
                            $('#city').empty();
                            $('#city').append('<option value="">Select your city</option>');
                            $('#state').val('');
                        }
                    },
                    error: function () {
                        // If error occurs, clear the fields
                        $('#district').val('');
                        $('#city').empty();
                        $('#city').append('<option value="">Select your city</option>');
                        $('#state').val('');
                    }
                });
            } else {
                // If no pincode is entered, clear the fields
                $('#district').val('');
                $('#city').empty();
                $('#city').append('<option value="">Select your city</option>');
                $('#state').val('');
            }
        });

    });
</script> --}}


<script>
    $(document).ready(function() {
        $("#all_table").dataTable();

        // Edit button click handler
        $(document).on('click', '.testimonial_edit_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            var email = el.data('email');
            var gender = el.data('gender');
            var phone = el.data('phone');
            var city = el.data('city');
            var district = el.data('district');
            var pincode = el.data('pincode');
            var state = el.data('state');
            var address = el.data('address');
            var role_id = el.data('role_id');
            var factory_id = el.data('factory_id');
            console.log(city);

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#edit_name').val(name);
            form.find('#edit_email').val(email);
            form.find('#edit_gender').val(gender);
            form.find('#edit_phone').val(phone);
            form.find('#edit_city').val(city);
            form.find('#edit_district').val(district);
            form.find('#edit_pincode').val(pincode);
            form.find('#edit_state').val(state);
            form.find('#edit_address').val(address);
            form.find('#edit_role_id').val(role_id);
            form.find('#edit_factory_id').val(factory_id);
            
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
            var email = el.data('email');
            var phone = el.data('phone');
            var city = el.data('city');
            var pincode = el.data('pincode');
            var state = el.data('state');
            var address = el.data('address');
            var role_id = el.data('role_id');
            var factory_id = el.data('factory_id');

            var form = $('#testimonial_view_modal_form');
            form.find('#id').val(id);
            form.find('#view_name').val(name);
            form.find('#view_email').val(email);
            form.find('#view_phone').val(phone);
            form.find('#view_city').val(city);
            form.find('#pincode').val(pincode);
            form.find('#view_state').val(state);
            form.find('#view_address').val(address);
            form.find('#view_role_id').val(role_id);
            form.find('#view_factory_id').val(factory_id);
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

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this Staff?');
    }
</script>
@endsection