@extends('backend.layouts.master')
@section('title', 'Admin')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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

            <h4 class="header-title">Admin</h4>
            <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="status">
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
                   

                        <div class="float-right mb-3">
                            <a href="" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Add Admin</a>
                        </div>

                        <!-- Start : add admin -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" style="max-width:50%; width:100%">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Add Admin') }}</h5>
                                        <button type="button" class="close"
                                            data-bs-dismiss="modal"><span>×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('store.admin')}}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" placeholder="Enter your name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email <span
                                                                style="color: red;">*</span></label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="email" placeholder="Enter your email"required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="image">Profile Image</label>
                                                        <input type="file" class="form-control" name="image"
                                                            id="image" placeholder="Profile Image">
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
                                                        <input type="number" class="form-control" name="phone"
                                                            id="phone" placeholder="Enter your phone number">
                                                    </div>
                                                  
                                                    <div class="form-group">
                                                        <label for="pincode">Pincode<span
                                                                style="color: red;">*</span></label>
                                                        <input type="number" class="form-control" name="pincode"
                                                            id="add_pincode" placeholder="Enter your pincode" required>
                                                    </div>

                                                 
                                                </div>
                                                <div class="col-md-6">
                                                 
                                                    <div class="form-group">
                                                        <label for="district">District</label>
                                                        <input type="text" class="form-control" name="district"
                                                            id="district" placeholder="" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="city">City</label>
                                                        <select class="form-control" name="city" id="city">
                                                            <option value="">Select your city</option>
                                                            <!-- Cities will be dynamically added here -->
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="state">State</label>
                                                        <input type="text" class="form-control" name="state"
                                                            id="state" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" name="address"
                                                            id="address" placeholder="Enter your address">
                                                    </div>
                                                 
                                                   
                                                    <div class="form-group">
                                                        <label for="password">Password<span
                                                                style="color: red;">*</span></label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" placeholder="Enter your password"required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password">Confirm Password<span
                                                                style="color: red;">*</span></label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="password" placeholder="Enter your password"required>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End : add admin -->

                        {{-- Edit Modal  start --}}

                        <div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
                            <div class="modal-dialog" style="max-width:50%; width:100%">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Edit Staff') }}</h5>
                                        <button type="button" class="close"
                                            data-bs-dismiss="modal"><span>×</span></button>
                                    </div>
                                    <form action="{{ route('users.edit') }}" id="testimonial_edit_modal_form"
                                        method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" name="id" id="gallery_id" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="edit_name" placeholder="Enter your name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="edit_email" placeholder="Enter your email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="image">Profile Image</label>
                                                        <input type="file" class="form-control" name="image"
                                                            id="edit_image" placeholder="Profile Image">
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
                                                        <input type="number" class="form-control" name="phone"
                                                            id="edit_phone" placeholder="Enter your phone number">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pincode">Pincode</label>
                                                        <input type="number" class="form-control" name="pincode"
                                                            id="edit_pincode" placeholder="Enter your pincode">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="district">District</label>
                                                        <input type="text" class="form-control" name="district"
                                                            id="edit_district" readonly>
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
                                                        <input type="text" class="form-control" name="state"
                                                            id="edit_state" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <input type="text" class="form-control" name="address"
                                                            id="edit_address" placeholder="Enter your address">
                                                    </div>
                                                 
                                                    <div class="form-group">
                                                        <label for="guest_name">{{ __('Factory') }}</label>
                                                        <select class="form-control" name="factory_id"
                                                            id="edit_factory_id">
                                                            <option value="">{{ __('Select Factory') }}</option>
                                                         
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password"
                                                            id="edit_password" placeholder="Enter your password">
                                                        <!-- <input type="password" class="form-control" name="password" id="password"> -->
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        {{-- edit modal end --}}



                        <div class="table-wrap table-responsive">
                            <table class="table table-default" id="all_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Pincode</th>
                                        <th>Address</th>
                                        {{-- <th>Role Id</th>
                                        <th>Factory Id</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        @if ($user->role_id == 2)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->image && file_exists(public_path($user->image)))
                                                        <img src="{{ asset($user->image) }}" alt="Image"
                                                            style="height: 45px; width: 65px;">
                                                    @else
                                                        <span>No Image Available</span>
                                                    @endif
                                                </td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->city }}</td>
                                                <td>{{ $user->pincode }}</td>
                                                <td>{{ $user->address }}</td>
                                                {{-- <td>{{ $user->role_id }}</td>
                                                <td>{{ $user->factory_id }}</td> --}}
                                                <td>
                                                    <a class="btn btn-link text-secondary p-0 m-0 mb-3 mr-1 testimonial_view_btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#userModal{{ $user->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    {{-- start edit --}}
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#testimonial_item_edit_modal"
                                                        class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_edit_btn"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-image="{{ $user->image }}"
                                                        data-gender="{{ $user->gender }}"
                                                        data-phone="{{ $user->phone }}" data-city="{{ $user->city }}"
                                                        data-district="{{ $user->district }}"
                                                        data-pincode="{{ $user->pincode }}"
                                                        data-state="{{ $user->state }}"
                                                        data-address="{{ $user->address }}" {{-- data-role_id="{{$data->role_id}}" --}}
                                                        data-factory_id="{{ $user->factory_id }}"
                                                        data-password="{{ $user->password }}" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Edit">
                                                        <i class="bi bi-pencil-square"></i>
                                                        <!-- Bold Bootstrap Icons pencil icon with a larger size -->
                                                    </a>&nbsp;

                                                    {{-- end edit --}}
                                                    <a href="{{ route('users.destroy', $user->id) }}"
                                                        class="btn btn-link text-danger p-0 m-0 mb-3 mr-1 testimonial_edit_btn">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </td>
                                             
                                            </tr>

                                            {{-- view start --}}
                                            <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1"
                                                aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="userModalLabel{{ $user->id }}">User Details</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close">X</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">

                                                                <div class="col-md-8">
                                                                    <p><strong>ID:</strong> {{ $user->id }}</p>
                                                                    <p><strong>Name:</strong> {{ $user->name }}</p>
                                                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                                                    <p><strong>Phone:</strong> {{ $user->phone }}</p>
                                                                    <p><strong>City:</strong> {{ $user->city }}</p>
                                                                    <p><strong>Pincode:</strong> {{ $user->pincode }}</p>
                                                                    <p><strong>Address:</strong> {{ $user->address }}</p>
                                                                    {{-- <p><strong>Role ID:</strong> {{ $user->role_id }}</p>
                                                                    <p><strong>Factory ID:</strong> {{ $user->factory_id }} --}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    {{-- view end --}}


                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
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
    <script>
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
            var password = el.data('password');
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
            form.find('#password').val(password);
            
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

        $(document).on('change', '#edit_pincode', function () {
            var pincode = $(this).val();

            if (pincode) {
                $.ajax({
                    url: " ",
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

         // Pincode change handler for add form
         $('#add_pincode').on('change', function () {
            var pincode = $(this).val();

            if (pincode) {
                $.ajax({
                    url: " ",
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
    


        });
    </script>
@endsection
