@include('layouts.header')
	<div class="main-wrapper">
		@include('layouts.topheader')
		@include('layouts.sidemenu')
				<div class="page-wrapper">
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>Add Offers</h4>
								<h6>Create new Offers</h6>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
							<form method="post" action="{{route('offer.store')}}">
								<div class="row">
									@csrf
									
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Amount Off</label>
												<input type="text" name ="amount_off">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Percentage Off</label>
												<input type="text" name ="percentage_off">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Start Time</label>
												<input type="text" name="start_time"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>End Time</label>
												<input type="text"  name="end_time"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Coupon Code</label>
												<input type="text" name="coupon_code"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Require Coupon</label>
												<input type="text" name="require_coupon">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Min Total Order Amt</label>
												<input type="text" name="min_total_order_amt">
											</div>
										</div>
										
										
										<div class="col-lg-12">
											<button type="submit" class="btn btn-submit me-2">Submit</button>
											<a href="productlist.html" class="btn btn-cancel">Cancel</a>
										</div>
									
								</div>
								</form>
							</div>
						</div>
                    </div>
				</div>
			</div>
			@include('layouts.footer')