@extends('admin.app')
@section('content')
	<h3>Edit Profile</h3>
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
		<form action="{{url('admin/profile/'.$data->id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			<label for="name">Name</label>
			<input type="text" value="{{$profile->name}}"  name="name" class="form-control">
			<label for="short_descripstion">Short Description</label>
			<input type="text" value="{{$profile->short_description}}" name="short_description" class="form-control">
			<br>
			<img width="150px" src="{{url($profile->photo)}}">
			<br>
			<label for="photo">Photo</label>
			<input type="file" name="photo" class="form-control">
			<label for="content">Content</label>
			<textarea id="content" class="form-control" name="content" rows="10" cols="50">{{$profile->content}}</textarea>
			<br>
			<input type="submit" name="submit" class="btn btn-md btn-primary" value="Edit Data">
		</form>
	</div>

@endsection
@section('js')
<script src="{{url('assets/ckeditor/ckeditor.js')}}"></script>
<script>
	var content=document.getElementById("content");
	CKEDITOR.replace(content,{
		language:'en-gb'
	});
	CKEDITOR.config.allowedContent = true;
</script>
@endsection