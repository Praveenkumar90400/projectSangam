@include('layouts.header')
<div class="main-wrapper">
@include('layouts.topheader')
@include('layouts.sidemenu')
	<div class="page-wrapper">
		<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Product List</h4>
			</div>
			<div class="page-btn">
				<a href="/AddProduct" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New</a>
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
                                    <th>Product Name</th>
                                    <th>Model Name</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product as $value)
                                <tr>
                                    <td>{{$value->product_id}}</td>
                                    <td>{{$value->product_name}}</td>
                                    <td>{{$value->model_name}}</td>
                                    <td>{{$value->category_name}}</td>
                                    <td>{{$value->description}}</td>
                                    <td>
                                        <a class="me-3" href="ProductEdit/{{$value->product_id}}">
                                            <img src="assets/img/icons/edit.svg" alt="img">
                                        </a>
                                        <a class="me-3" href="Productdestroy/{{$value->product_id}}">
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