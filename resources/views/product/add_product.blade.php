
@include('layouts.header')
<div class="main-wrapper">
    @include('layouts.topheader')
    @include('layouts.sidemenu')
    <style>
        .error {
    color:#842029;;
    font-weight: 400;
    display: block;
    padding: 6px 0;
    font-size: 14px;
}
.form-control.error {
    border-color: #842029;;
    padding: .375rem .75rem;
}
    </style>
    <div class="page-wrapper">
		<div class="content">
			<div class="page-header">
				<div class="page-title">
					<h4>Add Product</h4>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<form method="post" action="{{route('StoreProduct')}}" enctype="multipart/form-data">
                    @csrf    
                    <div class="row">
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="select" name="category_id" required>
                                        <option>Choose Category</option>
                                        @foreach($category as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                        @error('category_id')
                                        <span class="error" style="color:#842029;">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>  
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Name </label>
                                    <div class="input-groupicon">
                                        <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" required>
                                        @error('name')
                                        <span class="error" style="color:#842029;">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Model Name</label>
                                    <div class="input-groupicon">
                                        <input type="text" name="model_name" class="form-control" required>
                                        @error('model_name')
                                        <span class="error" style="color:#842029;">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit">Submit</button>
                                
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>

@include('layouts.footer')