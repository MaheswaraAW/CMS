@extends('admin.app')
@section('content')
	<h3>Slider</h3>
	<hr>
	@if (Session::has('status'))
		<div class="alert alert-warning" role="alert">
			{{Session::get('status')}}
		</div>
	@endif
	<a href="{{url('admin/slider/create')}}" class="btn btn-md btn-primary mb-3"><i class="fas fa-plus"></i>
	Tambah Data</a>

	<table class="table table-bordered">
		<thead class="bg-primary text-light">
			<tr>
				<th>Title</th>
				<th>Image</th>
				<!-- <th>Url</th>
				<th>Order</th> -->
				<th>Name</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		@foreach ($data as $sld)
		<tr>
			<td>{{$sld->title}}</td>
			<td><img width="150px" src="{{url($sld->image)}}"></td>
			<!-- <td>{{$sld->url}}</td>
			<td>{{$sld->order}}</td> -->
			<td>{{$sld->name}}</td>
			<td>{{$sld->status}}</td>
			<td>
				<a href="{{url('admin/slider/edit/'.$sld->id)}}" class="btn btn-primary btn-md"><i class="far fa-edit"></i>Edit</a>
				<a href="{{url('admin/slider/delete/'.$sld->id)}}" class="btn btn-danger btn-md"><i class="far fa-trash"></i>Delete</a>
			</td>
		</tr>
		@endforeach

	</table>
@endsection