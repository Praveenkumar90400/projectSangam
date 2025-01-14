@include('layouts.header')
<div class="main-wrapper">
@include('layouts.topheader')
@include('layouts.sidemenu')
	<div class="page-wrapper">
		<div class="content">
		<div class="page-header">
			<div class="page-title">
				<h4>Govt Scheme Category List</h4>
			</div>
			<div class="page-btn">
				<a href="/add_govt_scheme_category" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New</a>
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
                                    <th>#ID</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->scheme_category}}</td>
                                    <td>
                                        <a class="me-3" href="GovtSchemeCategoryEdit/{{$value->id}}">
                                            <img src="assets/img/icons/edit.svg" alt="img">
                                        </a>
                                        <a class="me-3" href="GovtSchemeCategorydestroy/{{$value->id}}">
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