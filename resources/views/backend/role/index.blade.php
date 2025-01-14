@extends('backend.layouts.master')
@section('title')
Role
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
         <h4 class="header-title">{{__('Roles')}}</h4>
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
                                <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Role</a>
                            </div>
                            <!-- Start : add factory -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                            <h5 class="modal-title">{{__('Add Role')}}</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('admin.role.store')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role">
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
                                        <th>{{__('Role')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach($role as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->role}}</td>

                                            <td class="d-flex">
                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_edit_btn" 
                                                data-id="{{$data->id}}" 
                                                data-role="{{$data->role}}">
                                                <i class="ti-pencil">edit</i>
                                                </a>&nbsp; --}}

                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_edit_modal" 
                                                class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_edit_btn" 
                                                data-id="{{$data->id}}" 
                                                data-role="{{$data->role}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="bi bi-pencil-square"></i> <!-- Bootstrap Icons filled pencil icon for editing -->
                                                </a>&nbsp;

                                                {{-- <form action="{{route('admin.role.delete',$data->id)}}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger text-white">Delete</button>
                                                </form>&nbsp; --}}
                                                @if($data->id != 1)    
                                                <form action="{{ route('admin.role.delete', $data->id) }}" method="post" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="bi bi-trash-fill"></i> <!-- Bootstrap Icons trash can icon for delete -->
                                                    </button>
                                                </form>&nbsp;
                                                @endif

                                                {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_permission_role_modal" class="btn btn-primary text-white btn-xs mb-3 mr-1 testimonial_permission_role_btn" 
                                                data-id="{{$data->id}}">
                                                <i class="ti-pencil">Role Permission</i>
                                                </a> --}}
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#testimonial_item_permission_role_modal" 
                                                class="btn btn-link text-primary p-0 m-0 mb-3 mr-1 testimonial_permission_role_btn" 
                                                data-id="{{$data->id}}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Role Permission">
                                                <i class="bi bi-shield-plus"></i> <!-- Bootstrap Icons shield-check icon for permissions -->
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
                <h5 class="modal-title">{{__('Edit Role')}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <form action="{{route('admin.role.update')}}" id="testimonial_edit_modal_form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="gallery_id" value="">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="role" id="role" placeholder="Enter Role">
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




<!-- permissions role modal -->
<div class="modal fade" id="testimonial_item_permission_role_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="module_permissionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="module_permissionsModalLabel">Permissions Role</h5>
                <button type="button" class="close" data-bs-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body" id="module_permissionsRoleModalBody">
            .......
            
            </div>
        </div>
    </div>
</div>




@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> --}}


{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<script>
    $(document).ready(function() {
         $("#all_table").dataTable();

        $(document).on('click', '.testimonial_edit_btn', function() {
            var el = $(this);
            var id = el.data('id');
            var role = el.data('role');

            var form = $('#testimonial_edit_modal_form');
            form.find('#gallery_id').val(id);
            form.find('#role').val(el.data('role'));
           
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





        $(document).on('click', '.testimonial_permission_role_btn', function() {
            var el = $(this);
            var id = el.data('id');


            
            //alert(id);
            $.ajax({
                type: "GET",
                url: "{{route('admin.permission_role_list')}}",
                data: {id: id},
                success: function(response) {
                $('#module_permissionsRoleModalBody').html(response);
                }
            });
       });


    });
</script>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this Role?');
    }
</script>
@endsection