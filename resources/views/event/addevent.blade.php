@include('layouts.header')
	<div class="main-wrapper">
		@include('layouts.topheader')
		@include('layouts.sidemenu')
				<div class="page-wrapper">
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>Add Event</h4>
								<h6>Create new Event</h6>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
							    <form method="post" action="{{route('EventStore')}}" enctype="multipart/form-data">
									<div class="row">
										@csrf
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Name</label>
												<input type="text" name ="name">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Venue</label>
												<input type="text" name ="venue">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Locality</label>
												<input type="text" name="locality"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>City</label>
												<input type="text"  name="city"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>State</label>
												<input type="text" name="state"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<div class="input-groupicon">
													<label>Date</label>
													<input name="date" type="text" placeholder="Choose Date" class="datetimepicker">
													<!-- <div class="addonset">
														<img src="assets/img/icons/calendars.svg" alt="img">
													</div> -->
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Start Time</label>
												<input type="text" name="start_time" id="start_time">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>End Time</label>
												<input type="text" name="end_time">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control" name="description"></textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label> Product Image</label>
												<div class="image-upload">
													<input type="file" name="image">
													<div class="image-uploads">
														<img src="assets/img/icons/upload.svg" alt="img">
														<h4>Drag and drop a file to upload</h4>
													</div>
												</div>
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

<script>
	$(document).ready(function(){
		if($('.datetimepicker').length > 0 ){
			$('.datetimepicker').datetimepicker({
				format: 'DD-MM-YYYY',
				icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
				}
			});
		}
	});

	$('#start_time').datetimepicker({
		format:	'Y-m-d H:s'
	});
</script>
