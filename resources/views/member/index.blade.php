@include('layouts.header')
<div class="main-wrapper">
@include('layouts.topheader')
@include('layouts.sidemenu')
	<div class="page-wrapper">
		<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Member List</h4>
			</div>
			<!-- <div class="page-btn">
				<a href="/addoffer" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Offer</a>
			</div> -->
		</div>
		<div class="card">
			<div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Mobile Number</th>
                                    <th>First Name</th>
                                    <th>Second Name </th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($member_list as $value)
                                <tr>
                                
                                    <td>{{$value->member_id}}</td>
                                    <td>{{$value->mobile_number}}</td>
                                    <td>{{$value->first_name}}</td>
                                    <td>{{$value->second_name}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->gender}}</td>
                                    <td>
                                        <a class="me-3" href="view_details/{{$value->member_id}}">
                                            <img src="assets/img/icons/eye.svg" alt="img">
                                        </a>
                                    </td>
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
@include('layouts.footer')