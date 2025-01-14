@extends('backend.layouts.master')
@section('title', 'Category')

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

            <h4 class="header-title">Category</h4>
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
                                data-bs-target="#exampleModal">Add Category</a>
                        </div>

                        <!-- Start : add Category -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" style="max-width:30%; width:100%">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Add Category') }}</h5>
                                        <button type="button" class="close"
                                            data-bs-dismiss="modal"><span>×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('category.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Title<span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="title"
                                                            id="name" placeholder="Enter your title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Description <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="description"
                                                            id="email" placeholder="Enter your description"required>
                                                    </div>

                                                </div>
                                            </div>

                                            <button class="btn btn-primary"> Add</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End : add Category -->

                        {{-- Edit Modal  start --}}

                        <div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
                            <div class="modal-dialog" style="max-width:50%; width:100%">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Edit Staff') }}</h5>
                                        <button type="button" class="close"
                                            data-bs-dismiss="modal"><span>×</span></button>
                                    </div>
                                    <form action="" id="testimonial_edit_modal_form" method="post"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" name="id" id="gallery_id" value="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Title</label>
                                                        <input type="text" class="form-control" name="title"
                                                            id="edit_name" placeholder="Enter your name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Description</label>
                                                        <input type="text" class="form-control" name="description"
                                                            id="edit_email" placeholder="Enter your email">
                                                    </div>
                                                    {{-- <div class="form-group">
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
                                                    </div> --}}
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
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>status</th>
                                        <th>action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>

                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->title }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                @if ($category->status == 1)
                                                    Active
                                                @else
                                                    Inactive
                                                @endif
                                            </td>
                                            <td>

                                                <a href="#" class="btn btn-link text-secondary p-0 m-0 mb-3 mr-1 testimonial_view_btn" data-bs-toggle="modal"
                                                    data-bs-target="#viewModal{{ $category->id }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                               
                                                    <a class="btn btn-link text-danger p-0 m-0 mb-3 mr-1 testimonial_edit_btn" href="{{route('categories.destroy', $category->id)}}" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                        
                                                <a href="#" class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_edit_btn" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $category->id }}">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                            </td>

                                            <!-- Modal for Viewing Category start -->
                                            <div class="modal fade" id="viewModal{{ $category->id }}" tabindex="-1"
                                                aria-labelledby="viewModalLabel{{ $category->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="viewModalLabel{{ $category->id }}">Category Details
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p><strong>Title:</strong> {{ $category->title }}</p>
                                                            <p><strong>Description:</strong> {{ $category->description }}
                                                            </p>
                                                            <p><strong>Status:</strong>
                                                                @if ($category->status == 1)
                                                                    Active
                                                                @else
                                                                    Inactive
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal for Viewing Category  end -->

                                            <!-- Edit Modal for Category  start-->
                                            <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1"
                                                aria-labelledby="editModalLabel{{ $category->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editModalLabel{{ $category->id }}">Edit Category</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Edit Form -->
                                                            <form action="{{ route('categories.update', $category->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="mb-3">
                                                                    <label for="title" class="form-label">Title</label>
                                                                    <input type="text" class="form-control"
                                                                        id="title" name="title"
                                                                        value="{{ $category->title }}" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="description"
                                                                        class="form-label">Description</label>
                                                                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ $category->description }}</textarea>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="status"
                                                                        class="form-label">Status</label>
                                                                    <select class="form-select" id="status"
                                                                        name="status" required>
                                                                        <option value="1"
                                                                            {{ $category->status == 1 ? 'selected' : '' }}>
                                                                            Active</option>
                                                                        <option value="0"
                                                                            {{ $category->status == 0 ? 'selected' : '' }}>
                                                                            Inactive</option>
                                                                    </select>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                              <!-- Edit Modal for Category  end-->
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

            $(document).on('change', '#edit_pincode', function() {
                var pincode = $(this).val();

                if (pincode) {
                    $.ajax({
                        url: " ",
                        type: 'GET',
                        data: {
                            pincode: pincode
                        },
                        success: function(response) {
                            if (response.district && response.state && response.city) {
                                $('#edit_district').val(response.district);
                                $('#edit_state').val(response.state);

                                // Clear and populate the city dropdown
                                $('#edit_city').empty();
                                $('#edit_city').append(
                                    '<option value="">Select your city</option>');

                                var previousCity = $('#edit_city').data('previous-city');

                                // Add new city options
                                response.city.forEach(function(city) {
                                    $('#edit_city').append('<option value="' + city +
                                        '">' + city + '</option>');
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
                                $('#edit_city').append(
                                    '<option value="">Select your city</option>');
                                $('#edit_state').val('');
                            }
                        },
                        error: function() {
                            // Handle error case
                            $('#edit_district').val('');
                            $('#edit_city').empty();
                            $('#edit_city').append(
                                '<option value="">Select your city</option>');
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
            $('#add_pincode').on('change', function() {
                var pincode = $(this).val();

                if (pincode) {
                    $.ajax({
                        url: " ",
                        type: 'GET',
                        data: {
                            pincode: pincode
                        },
                        success: function(response) {
                            if (response.district && response.state && response.city) {
                                $('#district').val(response.district);
                                $('#state').val(response.state);

                                $('#city').empty();
                                $('#city').append('<option value="">Select your city</option>');

                                response.city.forEach(function(city) {
                                    $('#city').append('<option value="' + city + '">' +
                                        city + '</option>');
                                });
                            } else {
                                $('#district').val('');
                                $('#city').empty();
                                $('#city').append('<option value="">Select your city</option>');
                                $('#state').val('');
                            }
                        },
                        error: function() {
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
