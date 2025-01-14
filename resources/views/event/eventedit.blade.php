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
							<form method="post" action="{{route('update')}}" enctype="multipart/form-data">
								<div class="row">
									@csrf
                                    <input type="hidden" name="id" value="{{$event->id}}"/>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Name</label>
												<input type="text" name ="name" value="{{$event->name}}">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Venue</label>
												<input type="text" name ="venue" value="{{$event->venue}}">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Locality</label>
												<input type="text" name="locality" value="{{$event->locality}}"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>City</label>
												<input type="text"  name="city" value="{{$event->city}}"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>State</label>
												<input type="text" name="state" value="{{$event->state}}"/>
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Date</label>
												<input type="text" name="date" value="{{$event->date}}">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>Start Time</label>
												<input type="text" name="start_time" value="{{$event->start_time}}">
											</div>
										</div>
										<div class="col-lg-3 col-sm-6 col-12">
											<div class="form-group">
												<label>End Time</label>
												<input type="text" name="end_time" value="{{$event->end_time}}">
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control" name="description">{{$event->description}}</textarea>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="form-group">
												<label> Product Image</label>
												<div class="image-upload">
												<input type="hidden" name="old_image" value="{{$event->image}}">
												<input type="file" name="image" value="{{$event->image}}">
													<div class="image-uploads">
														<img src="{{URL::asset('assets/img/icons/upload.svg')}}" alt="img">
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