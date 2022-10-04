@extends('admin.app')
@section('content')
	<h3>Post</h3>
	<hr>
	@if (Session::has('status'))
		<div class="alert alert-warning" role="alert">
			{{Session::get('status')}}
		</div>
	@endif
	<a href="{{url('admin/post/create')}}" class="btn btn-md btn-primary mb-3"><i class="fas fa-plus"></i>
	Tambah Data</a>

	<table class="table table-bordered">
		<thead class="bg-primary text-light">
			<tr>
				<th>Title</th>
				<th>Thumbnail</th>
				<th>Category</th>
				<th>Content</th>
				<th>Headline</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		@foreach ($data as $pos)
		<tr>
			<td>{{$pos->title}}</td>
			<td><img width="150px" src="{{url($pos->thumbnail)}}"></td>
			<td>{{$pos->name}}</td>
			<td>{{$pos->content}}</td>
			<td>{{$pos->is_headline}}</td>
			<td>{{$pos->status}}</td>
			<td>
				<a href="{{url('admin/post/edit/'.$pos->id)}}" class="btn btn-primary btn-md"><i class="far fa-edit"></i>Edit</a>
				<a href="{{url('admin/post/delete/'.$pos->id)}}" class="btn btn-danger btn-md"><i class="far fa-trash"></i>Delete</a>
			</td>
		</tr>
		@endforeach

	</table>
@endsection