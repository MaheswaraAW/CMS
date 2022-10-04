@extends('admin.app')
@section('content')
	<h3>Message</h3>
	<hr>
	@if (Session::has('status'))
		<div class="alert alert-warning" role="alert">
			{{Session::get('status')}}
		</div>
	@endif

	<table class="table table-bordered">
		<thead class="bg-primary text-light">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Subject</th>
				<th>Message</th>
				<th>Action</th>
			</tr>
		</thead>
		@foreach ($data as $mes)
		<tr>
			<td>{{$mes->name}}</td>
			<td>{{$mes->email}}</td>
			<td>{{$mes->subject}}</td>
			<td>{{$mes->message}}</td>
			<td>
				<a href="{{url('admin/message/delete/'.$mes->id)}}" class="btn btn-danger btn-md"><i class="far fa-trash"></i>Delete</a>
			</td>
		</tr>
		@endforeach

	</table>
@endsection