@extends('backend.layouts.master')
@section('title')
Driver
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
        <h4 class="header-title">{{__('Driver List')}}</h4>
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

                        <div class="tab-pane fade @if($b == 0) show active @endif" id="slider_tab" role="tabpanel">
                            <div class="table-wrap table-responsive">
                                <table class="table table-default" id="all_table">
                                    <thead>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('License Holder')}}</th>
                                        <th>{{__('License Number')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('RTO_Name')}}</th>
                                        <th>{{__('Onboard Date')}}</th>
                                        <th>{{__('State')}}</th>
                                        <th>{{__('KYC Completed')}}</th>
                                        <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                        @foreach($drivers as $data)
                                        <tr>
                                            <td>{{$data->id}}</td>
                                            <td>{{$data->license_holder}}</td>
                                            <td>{{$data->license_number}}</td>
                                            <td>
                                                <img src="{{ asset($data->image) }}" alt="Image" style="height: 45px;width: 65px;">
                                            </td>
                                            <td>{{$data->rto_name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->created_at)->format('m/d/Y') }}</td>

                                            <td>{{$data->state}}</td>
                                           <td>
                                                @if($data->kyc_completed == 0)
                                                    Not Completed
                                                @else
                                                    Completed
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.driver.delete', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this driver?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 mb-3 mr-1 testimonial_edit_btn">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

<script>
 $(document).ready(function() {

        $("#all_table").dataTable();
 });
</script>

@endsection

