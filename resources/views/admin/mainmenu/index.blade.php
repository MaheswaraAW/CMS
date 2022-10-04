@extends('admin.app')
@section('content')
	<h3>MainMenu</h3>
	<hr>
	@if (Session::has('status'))
		<div class="alert alert-warning" role="alert">
			{{Session::get('status')}}
		</div>
	@endif
	<a href="{{url('admin/mainmenu/create')}}" class="btn btn-md btn-primary mb-3"><i class="fas fa-plus"></i>
	Tambah Data</a>

	<table class="table table-bordered">
		<thead class="bg-primary text-light">
			<tr>
				<th>Title</th>
				<th>Parent</th>
				<!-- <th>Category</th>
				<th>Content</th>
				<th>File</th> -->
				<th>Url</th>
				<!-- <th>Order</th> -->
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		@foreach ($data as $main)
		<tr>
			<td>{{$main->title}}</td>
			<td>
				{{$main->parent}}
				<?php
				if($main->parent==0){
					echo "home";
				} 
				foreach ($data as $main2):
				if($main->parent==$main2->id){
					echo $main2->title;
				}
				endforeach;
				?>
			</td>
			<!-- <td>{{$main->category}}</td>
			<td>{{$main->content}}</td>
			<td>{{$main->file}}</td> -->
			<td>{{$main->url}}</td>
			<!-- <td>{{$main->order}}</td> -->
			<td>{{$main->status}}</td>
			<td>
				<a href="{{url('admin/mainmenu/edit/'.$main->id)}}" class="btn btn-primary btn-md"><i class="far fa-edit"></i>Edit</a>
				<a href="{{url('admin/mainmenu/delete/'.$main->id)}}" class="btn btn-danger btn-md"><i class="far fa-trash"></i>Delete</a>
			</td>
		</tr>
		@endforeach

	</table>
@endsection