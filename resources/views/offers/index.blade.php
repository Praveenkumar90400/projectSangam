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
				<a href="/addoffer" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Offer</a>
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
								<th>Amount Off</th>
								<th>Percentage Off</th>
								<th>Start Time </th>
								<th>End Time</th>
								<th>Coupon Code</th>
								<th>Require Coupon</th>
								<th>Min Total Order Amt</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($offer_list as $value)
							<tr>
							
								<td>{{$value->id}}</td>
								<td>{{$value->amount_off}}</td>
								<td>{{$value->percentage_off}}</td>
								<td>{{$value->start_time}}</td>
								<td>{{$value->end_time}}</td>
								<td>{{$value->coupon_code}}</td>
								<td>{{$value->require_coupon}}</td>
								<td>{{$value->min_total_order_amt}}</td>
								<td>
									<!-- <a class="me-3" href="product-details.html">
										<img src="assets/img/icons/eye.svg" alt="img">
									</a> -->
									<a class="me-3" href="edit/{{$value->id}}">
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