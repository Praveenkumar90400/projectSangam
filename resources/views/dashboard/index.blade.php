
@section('title')
Dashboard
@endsection
@include('layouts.header')
<div class="main-wrapper">
@include('layouts.topheader')
@include('layouts.sidemenu')
	<div class="page-wrapper">
       
    

  
    
    @if(Auth::check() && Auth::user()->role_id == 1)
		<div class="content" style="margin-top: -10px;margin-bottom: -70px;">
        <div><i class="bi bi-bar-chart"></i> Today's Status</div>
		    <div class="row">
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a class="dash-count">
                        <div class="dash-counts">
                            <h4 class="new-font">Total Drivers added</h4>
                            <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="users"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="" class="dash-count das1">
                        <div class="dash-counts">
                            <h4 class="new-font">Total vehicles added </h4>
                           <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="calendar"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href=""class="dash-count das2">
                        <div class="dash-counts">
                            <h4 class="new-font">Scanned Driver</h4>
                            <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="" class="dash-count das3">
                        <div class="dash-counts">
                            <h4 class="new-font">Scanned Vehicle</h4>
                            <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="calendar"></i>
                        </div>
                    </a>
                </div>
            </div>
		</div>
	
		<div class="content">
        <div><i class="bi bi-bar-chart"></i> This Month's Status</div>
		    <div class="row">
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="" class="dash-count">
                        <div class="dash-counts">
                            <h4 class="new-font">Total Drivers added</h4>
                            <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="users"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="" class="dash-count das1">
                        <div class="dash-counts">
                            <h4 class="new-font">Total vehicles added</h4>
                           <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="calendar"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="" class="dash-count das2">
                        <div class="dash-counts">
                            <h4 class="new-font">Scanned Driver</h4>
                            <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="user"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <a href="" class="dash-count das3">
                        <div class="dash-counts">
                            <h4 class="new-font">Scanned Vehicle</h4>
                            <h5 class="new-font2"></h5>
                        </div>
                        <div class="dash-imgs">
                            <i data-feather="calendar"></i>
                        </div>
                    </a>
                </div>
            </div>
		</div>
    @endif  


    {{-- @if($role_id == 2)
    <div class="content" style="margin-top: -5px; padding: 20px; background-color: #f8f9fa; border-radius: 8px;">
        <h2 class="table-heading" style="text-align: left;margin-bottom: 0px;font-size: 24px;color: #333;margin-top: -20px;">
            User Amount
        </h2>
        <div class="div">
            <h1></h1>
        </div>

      
    </div>
@endif --}}

    </div>
</div>

<style>
.new-font{
    font-size: 18px !important;
}
.new-font2{
    font-size: 25px !important; 
}


</style>
@include('layouts.footer')