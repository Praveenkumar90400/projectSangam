@extends('backend.layouts.master')
@section('title')
Module
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
        <h4 class="header-title">{{__('Modules')}}</h4>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="status">
                    @if (Session('status'))
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
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Module</a>
                            </div>
                            <!-- Start : add factory -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{__('Add Module')}}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.module.store')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="module_name">Module Name</label>
                                                    <input type="text" class="form-control" name="module_name" id="module_name" placeholder="Enter Module Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <input type="text" class="form-control" name="description" id="description" placeholder="Write Description">
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
                                        <th>{{__('Module Name')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach($module as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->module_name}}</td>
                                            <td>{{$data->description}}</td>

                                            <td class="d-flex">
                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_edit_btn" 
                                                data-id="{{$data->id}}" 
                                                data-module_name="{{$data->module_name}}" 
                                                data-description="{{$data->description}}">
                                                <i class="ti-pencil">edit</i>
                                                </a>&nbsp; --}}
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" 
                                                class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_edit_btn" 
                                                data-id="{{$data->id}}" 
                                                data-module_name="{{$data->module_name}}" 
                                                data-description="{{$data->description}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="bi bi-pencil-square"></i> <!-- Bootstrap Icons pencil icon -->
                                                </a>&nbsp;
                                                
                                                {{-- <form action="{{route('admin.module.delete',$data->id)}}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>&nbsp; --}}

                                                <form action="{{ route('admin.module.delete', $data->id) }}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="bi bi-trash"></i> <!-- Bootstrap Icons trash can icon -->
                                                    </button>
                                                </form>&nbsp;

                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_permission_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_permission_btn" 
                                                data-id="{{$data->id}}" 
                                                data-permission_module_name="{{$data->module_name}}">
                                                <i class="ti-pencil">Permission Add</i>
                                                </a> --}}

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_permission_modal" 
                                                class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_permission_btn" 
                                                data-id="{{$data->id}}" 
                                                data-permission_module_name="{{$data->module_name}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Add Permission">
                                                <i class="bi bi-plus-circle-fill"></i> <!-- Bootstrap Icons key icon -->
                                                </a>

                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_permission_modal_list" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_permission_list" 
                                                 data-id="{{$data->id}}">
                                                <i class="ti-pencil">Permission View</i>
                                                </a> --}}

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_permission_modal_list" 
                                                class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_permission_list" 
                                                data-id="{{$data->id}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="View Permission">
                                                <i class="bi bi-eye"></i> <!-- Bootstrap Icons eye icon for viewing -->
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

    </div>
</div>

<div class="modal fade" id="testimonial_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Module')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{route('admin.module.update')}}" id="testimonial_edit_modal_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="gallery_id" value="">
                    <div class="form-group">
                        <label for="module_name">Module Name</label>
                        <input type="text" class="form-control" name="module_name" id="module_name" placeholder="Enter">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="description" id="description" placeholder="Enter">
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


{{-- permission modal --}}
<div class="modal fade" id="testimonial_item_permission_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Add Permission')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{route('admin.module_permission.permission_add')}}" id="testimonial_permission_modal_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="module_id" value="">
                    <div class="form-group">
                        <label for="module_name">Module Name</label>
                        <input type="text" class="form-control" name="permission_module_name" id="permission_module_name" placeholder="Enter">
                    </div>
                    <div class="form-group">
                        <label for="module_name">Permission</label>
                        <input type="text" class="form-control" name="permission_name" id="permission_name" placeholder="Enter Permission">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" name="permission_description" id="permission_description" placeholder="Enter">
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
{{-- permission modal end --}}




<!-- module -permissions modal -->
<div class="modal fade" id="testimonial_item_permission_modal_list" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="module_permissionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="module_permissionsModalLabel">Module Permissions</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body" id="module_permissionsModalBody">
            .......
            
            </div>
        </div>
    </div>
</div>




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
            var module_name = el.data('module_name');
            var description = el.data('description');

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#module_name').val(el.data('module_name'));
            form.find('#description').val(el.data('description'));
           
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





        $(document).on('click', '.testimonial_permission_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var permission_module_name = el.data('permission_module_name');
            console.log(id);
            console.log(permission_module_name);

            var form = $('#testimonial_permission_modal_form');
            form.find('#module_id').val(id);
            form.find('#permission_module_name').val(el.data('permission_module_name'));

            form.find('.form-check-input').each(function() {
                var checkbox = $(this);
                if (amenities.includes(checkbox.val())) {
                    checkbox.prop('checked', true);
                } else {
                    checkbox.prop('checked', false);
                }
            });


        });




       $(document).on('click', '.testimonial_permission_list', function() {
            var el = $(this);
            var id = el.data('id');
            $.ajax({
                type: "GET",
                url: "{{route('admin.module_permission_list')}}",
                data: {id: id},
                success: function(response) {
                $('#module_permissionsModalBody').html(response);
                }
            });
       });

            


    });
</script>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this Module?');
    }
</script>
@endsection