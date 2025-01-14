@include('layouts.header')
	<div class="main-wrapper">
		@include('layouts.topheader')
		@include('layouts.sidemenu')
				<div class="page-wrapper">
					<div class="content">
						<div class="page-header">
							<div class="page-title">
								<h4>Edit Govt Scheme Category</h4>
							</div>
						</div>
						<div class="card">
							<div class="card-body">
                                <form method="post" action="{{route('GovtSchemeCategoryUpdate')}}">
                                    <div class="row">
                                        @csrf
                                        <input type="hidden" value="{{$single_data->id}}" name="id"/>
                                        <div class="col-lg-3 col-sm-6 col-12">
                                            <div class="form-group">
                                                <label>Scheme Category</label>
                                                <input type="text" name ="scheme_category" value="{{$single_data->scheme_category}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                                            <a href="#" class="btn btn-cancel">Cancel</a>
                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
                    </div>
				</div>
			</div>
			@include('layouts.footer')