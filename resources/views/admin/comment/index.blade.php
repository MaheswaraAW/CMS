@extends('admin.app')
@section('content')
	<h3>Comment</h3>
	<hr>
	@if (Session::has('status'))
		<div class="alert alert-warning" role="alert">
			{{Session::get('status')}}
		</div>
	@endif

	<table class="table table-bordered">
		<thead class="bg-primary text-light">
			<tr>
				<th>ID Post</th>
				<th>Name</th>
				<th>Email</th>
				<th>Comment</th>
			</tr>
		</thead>
		@foreach ($data as $mes)
		<tr>
			<td>{{$mes->id_post}}</td>
			<td>{{$mes->name}}</td>
			<td>{{$mes->email}}</td>
			<td>{{$mes->comment}}</td>
		</tr>
		@endforeach

	</table>
@endsection