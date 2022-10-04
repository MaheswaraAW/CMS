@extends('portal.app')
@section('sc-css')
<link href="{{url('assets/02-Single-post/css/styles.css')}}" rel="stylesheet">
<link href="{{url('assets/02-Single-post/css/responsive.css')}}" rel="stylesheet">
@endsection
@section('content')

<div class="single-post">

	<h3 class="title"><b class="light-color">Contact Me</b></h3>
	<p class="desc">Jika mengalami masalah saat mengakses web, saran, dan kritik harap kontak kami, Terima kasih</p>
</div>

<div class="leave-comment-area">
	<h4 class="title"><b class="light-color">Leave a message</b></h4>
	<div class="leave-comment">
		<form method="post" action="{{url('contact')}}">
			@csrf
			<div class="row">
				<div class="col-sm-6">
					<input name="name" class="name-input" type="text" placeholder="Name">
				</div>
				<div class="col-sm-6">
					<input name="email" class="email-input" type="text" placeholder="Email">
				</div>
				<div class="col-sm-12">
					<input name="subject" class="subject-input" type="text" placeholder="Subject">
				</div>
				<div class="col-sm-12">
					<textarea class="message-input" name="message" rows="6" placeholder="Message"></textarea>
				</div>
				<div class="col-sm-12">
					<button class="btn btn-2" type="submit"><b>Kirim</b></button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection