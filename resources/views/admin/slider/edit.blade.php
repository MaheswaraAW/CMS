@extends('admin.app')
@section('content')
	<h3>Edit Slider</h3>
	<hr>
	<div class="col-lg-6">
		@if($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<form action="{{url('admin/slider/edit/'.$data->id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			<label for="title">Title</label>
			<input type="text" value="{{$data->title}}" name="title" class="form-control">
			<label for="image">Image</label>
			<br>
			<img width="150px" src="{{url($data->image)}}">
			<input type="file" name="image" class="form-control">
			<input type="text" value="{{$data->image}}" name="image" class="form-control">
			<!-- <label for="url">URL</label>
			<input type="text" value="{{$data->url}}" name="url" class="form-control">
			<label for="Order">Order</label>
			<input type="number" name="order" class="form-control" value="{{$data->order}}"> -->
			<label for="name">Category</label>
			<select class="form-control" name="name" id="name">
				@foreach ($category as $cat)
				<option value="{{$cat->name}}" {{ ($cat->name == $data->name) ? 'selected' : ''}}>{{$cat->name}}</option>
				@endforeach
			</select>
			<label for="status">Status</label>
			<select class="form-control" name="status" id="status">
				<option value="0" {{(1 == $data->status)?'selected':''}}>Tidak Publish</option>
				<option value="1" {{(1 == $data->status)?'selected':''}}>Publish</option>
			</select>
			<br>
			<input type="submit" name="submit" class="btn btn-md btn-primary" value="Edit Data">
			<a href="{{url('admin/slider')}}" class="btn btn-md btn-warning"><i class="fas fa-chevron-circle-left"></i>Kembali</a>
		</form>
	</div>

@endsection