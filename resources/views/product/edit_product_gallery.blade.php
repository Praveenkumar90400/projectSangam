
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
					<h4>Edit Product Gallery</h4>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<form method="post" action="{{route('UpdateProductGallery')}}" enctype="multipart/form-data">
                        @csrf    
                        <input type="hidden" name="id" value="{{$single_data->id}}">
                    <div class="row">
                       
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Product</label>
                                    <select class="select" name="product_id" required>
                                        <option>Choose Product</option>
                                        @foreach($product_list as $value)
                                        <option value="{{$value->id}}" {{ $single_data->product_id == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                        @error('product_id')
                                        <span class="error" style="color:#842029;">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>  
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Title </label>
                                    <div class="input-groupicon">
                                        <input type="text" name="title" class="@error('title')is-invalid @enderror" value="{{$single_data->title}}" required>
                                        @error('title')
                                        <span class="error" style="color:#842029;">{{ $message }}</span>
                                        @enderror 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Image</label>
                                    <div class="input-groupicon">
                                        <input type="hidden" name="old_img" value="{{$single_data->image}}">
                                        <input type="file" name="image" class="form-control">
                                        
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-submit">Update</button>
                               
                            </div>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>

@include('layouts.footer')