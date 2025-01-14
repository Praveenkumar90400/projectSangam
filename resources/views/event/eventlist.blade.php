@include('layouts.header')
<div class="main-wrapper">
@include('layouts.topheader')
@include('layouts.sidemenu')
	<div class="page-wrapper">
		<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Event List</h4>
			</div>
			<div class="page-btn">
				<a href="/addevent" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Event</a>
			</div>
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
								<!-- <th>
									<label class="checkboxs">
										<input type="checkbox" id="select-all">
										<span class="checkmarks"></span>
									</label>
								</th> -->
								<th>#ID</th>
								<th>Event Name</th>
								<th>Venue</th>
								<th>Locality </th>
								<th>City</th>
								<th>State</th>
								<th>Date</th>
								<th>Start Time</th>
								<th>End Time</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($event_list as $value)
							<tr>
								<!-- <td>
									<label class="checkboxs">
										<input type="checkbox">
										<span class="checkmarks"></span>
									</label>
								</td>
								<td class="productimgname">
									<a href="javascript:void(0);" class="product-img">
										<img src="assets/img/product/product1.jpg" alt="product">
									</a>
									<a href="javascript:void(0);">Macbook pro</a>
								</td> -->
								<td>{{$value->id}}</td>
								<td>{{$value->name}}</td>
								<td>{{$value->venue}}</td>
								<td>{{$value->locality}}</td>
								<td>{{$value->city}}</td>
								<td>{{$value->state}}</td>
								<td>{{$value->date}}</td>
								<td>{{$value->start_time}}</td>
								<td>{{$value->end_time}}</td>
								<td>
									<!-- <a class="me-3" href="product-details.html">
										<img src="assets/img/icons/eye.svg" alt="img">
									</a> -->
									<a class="me-3" href="EventEdit/{{$value->id}}">
										<img src="assets/img/icons/edit.svg" alt="img">
									</a>
									<a class="confirm-text" href="destroy/{{$value->id}}">
										<img src="assets/img/icons/delete.svg" alt="img">
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