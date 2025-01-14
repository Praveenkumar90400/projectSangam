@include('layouts.header')
<div class="main-wrapper">
	@include('layouts.topheader')
	@include('layouts.sidemenu')
	<div class="page-wrapper">
		<div class="content">
			<div class="page-header">
				<div class="page-title">
					<h4>Member Details</h4>
				</div>
			</div>
			@php 
			//print_r($profile_details);
			@endphp
			<div class="card">
				<div class="card-body">
					<div class="profile-set">
						<div class="profile-head">
						</div>
						<div class="profile-top">
							<div class="profile-content">
								<div class="profile-contentimg">
								
									@if($profile_details->member_pic)
									<img src="{{URL::asset($profile_details->member_pic)}}" alt="img">
									@else
									<img src="{{URL::asset('images/profile/profile.jpg')}}" alt="img">
									@endif
								</div>
								<div class="profile-contentname">
									<h2>{{$profile_details->first_name.' '.$profile_details->second_name}}</h2>
								</div>
							</div>
						
						</div>
					</div>
					<div class="row">
						<h4><u style="font-weight:bold;">Professional Details</u></h4>
						<div class="row">

							<div class="col-lg-4 col-sm-12"></div>
							<div class="col-lg-4 col-sm-12">
								
								<span style="font-weight:bold;">Qualification</span> : {{$professional_detail->educational_qualification}}
								
							</div>
							<div class="col-lg-4 col-sm-12">
								<div class="form-group">
								<span style="font-weight:bold;">Work</span> : {{$professional_detail->work_category}}
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-4 col-sm-12"></div>
							<div class="col-lg-4 col-sm-12">
								<div class="form-group">
								<span style="font-weight:bold;">Designation</span> :	{{$professional_detail->job_designation}}
								</div>
							</div>
							<div class="col-lg-4 col-sm-12">
								<div class="form-group">
									<span style="font-weight:bold;">Company</span> : {{$professional_detail->company_name}}
								</div>
							</div>

						</div>
					</div>
					<hr/>
					<div class="row">
						<h4><u style="font-weight:bold;">Contact Details</u></h4>
						<div class="row">

							<div class="col-lg-4 col-sm-12"></div>
							<div class="col-lg-4 col-sm-12">
								
								<span style="font-weight:bold;">Mobile Number</span> : {{$contact_info->mobile_number}}
								
							</div>
							<div class="col-lg-4 col-sm-12">
								<div class="form-group">
								<span style="font-weight:bold;">Email</span> : {{$contact_info->email}}
								</div>
							</div>
							
						</div>
					</div>

					<hr/>
					
					<div class="row">
						<h4><u style="font-weight:bold;">Basic Information</u></h4>
						<div class="row">

							<div class="col-lg-4 col-sm-12"></div>
							<div class="col-lg-4 col-sm-12">
								
								<span style="font-weight:bold;">Date Of Birth</span> : {{$basic_info->date_of_Birth}}
								
							</div>
							<div class="col-lg-4 col-sm-12">
								<div class="form-group">
								<span style="font-weight:bold;">Gender</span> : {{$basic_info->gender}}
								</div>
							</div>
							
						</div>
					</div>
					<hr/>
					<div class="row">
						<h4><u style="font-weight:bold;">Place Lived</u></h4>
						<div class="row">

							<div class="col-lg-4 col-sm-12"></div>
							<div class="col-lg-4 col-sm-12">
								
								<span style="font-weight:bold;">City</span> : {{$place_lived->city}}
								
							</div>
							<div class="col-lg-4 col-sm-12">
								<div class="form-group">
								<span style="font-weight:bold;">State</span> : {{$place_lived->state}}
								</div>
							</div>
							<div class="col-lg-4 col-sm-12"></div>
							<div class="col-lg-4 col-sm-12">
								<div class="form-group">
								<span style="font-weight:bold;">Nationality</span> : {{$place_lived->nationality}}
								</div>
							</div>
							
							
						</div>
					</div>

				</div>
			</div>	

		</div>
	</div>
</div>
@include('layouts.footer')