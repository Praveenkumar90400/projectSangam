@include('layouts.header')
<div class="main-wrapper">
@include('layouts.topheader')
@include('layouts.sidemenu')
	<div class="page-wrapper">
		<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Product Gallery List</h4>
			</div>
			<div class="page-btn">
				<a href="/AddProductGallery" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New</a>
			</div>
		</div>
		<div class="card">
			<div class="card-body">

                    <!-- message box -->
                    @if($message = Session::get('success'))
                     <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong>{{$message}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    
                    @if($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{$message}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <!-- message box -->

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
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product_gallery as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->title}}</td>
                                    <td><img src="{{URL::asset($value->image)}}" height="50" width="50"/></td>
                                    <td>{{$value->product_name}}</td>
                                    <td>
                                        <a class="me-3" href="ProductGalleryEdit/{{$value->id}}">
                                            <img src="assets/img/icons/edit.svg" alt="img">
                                        </a>
                                        <a class="me-3" href="ProductGallerydestroy/{{$value->id}}">
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