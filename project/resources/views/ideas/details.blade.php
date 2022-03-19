@extends('layouts.main')

@section('title', 'Ideas')

@section('custom-css')
<style>
	body {
		margin-top: 20px;
	}

	.be-comment-block {
		margin-bottom: 50px !important;
		border: 1px solid #edeff2;
		border-radius: 2px;
		padding: 50px 70px;
		border: 1px solid #ffffff;
	}

	.comments-title {
		font-size: 20px;
		margin-bottom: 15px;
	}

	.be-img-comment {
		width: 60px;
		height: 60px;
		float: left;
		margin-bottom: 15px;
	}

	.be-ava-comment {
		width: 60px;
		height: 60px;
		border-radius: 50%;
	}

	.be-comment-content {
		margin-left: 80px;
	}

	.be-comment-content span {
		display: inline-block;
		width: 49%;
		margin-bottom: 15px;
	}

	.be-comment-name {
		font-size: 13px;
		font-family: 'Conv_helveticaneuecyr-bold';
	}

	.be-comment-content span {
		display: inline-block;
		width: 49%;
		margin-bottom: 15px;
	}

	.be-comment-time {
		text-align: right;
	}

	.be-comment-time {
		font-size: 11px;
	}

	.be-comment-text {
		font-size: 13px;
		line-height: 18px;
		display: block;
		background: #f6f6f7;
		border: 1px solid #edeff2;
		padding: 15px 20px 20px 20px;
	}

	.form-group.fl_icon .icon {
		position: absolute;
		top: 1px;
		left: 16px;
		width: 48px;
		height: 48px;
		color: #b5b8c2;
		text-align: center;
		line-height: 50px;
		-webkit-border-top-left-radius: 2px;
		-webkit-border-bottom-left-radius: 2px;
		-moz-border-radius-topleft: 2px;
		-moz-border-radius-bottomleft: 2px;
		border-top-left-radius: 2px;
		border-bottom-left-radius: 2px;
	}

	.form-group .form-input {
		font-size: 13px;
		line-height: 50px;
		font-weight: 400;
		width: 100%;
		height: 50px;
		padding-left: 20px;
		padding-right: 20px;
		border: 1px solid #edeff2;
		border-radius: 3px;
	}

	.form-group.fl_icon .form-input {
		padding-left: 70px;
	}

	.form-group textarea.form-input {
		height: 150px;
	}
</style>
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Trirong">
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7 col-lg-4 mb-5 mb-lg-0 wow fadeIn">
			<div class="card border-0 shadow">
				<img src="https://marketingai.vn/wp-content/uploads/2018/07/big-idea.jpg" alt="...">
				<div class="card-body p-1-9 p-xl-5">
					<div class="mb-4">
						<h3 class="h4">How do you feel about this idea?</h3>
						@livewire('react-component', ['model' => $idea])
					</div>
				</div>
			</div>
		</div>
		<div class="container col-lg-8 border" style="background: #f6f6f7;">
			<div class="ps-lg-1-6 ps-xl-5">
				<div class="mb-5 wow fadeIn">
					<div class="text-start mb-1-6 wow fadeIn">
						<h2 class="h1 mb-0" style="font-family: Trirong, serif; line-height:3.5em;">
							<img src="https://iconarchive.com/download/i107291/vexels/office/bulb.ico" width="60" height="60"></img>
							New Idea:
						</h2>
						<h1 class="mb-0 text-primary" style="font-family: Audiowide, sans-serif;">"{{$idea -> title}}"</h1>
					</div>
					<span class="container rounded">
						<p>{{$idea -> content}}</p>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="be-comment-block">
		<h1 class="comments-title">Comments</h1>
		@foreach ($comments as $comment)
		<div class="comment-block">
			<div class="be-img-comment">
				<a href="">
					<img src="{{ (auth()->user()->avatar == null) ? asset('/images/avatar.png') : asset('/storage/images/' . Auth::user()->avatar) }}" alt="" class="be-ava-comment">
				</a>
			</div>
			<div class="be-comment-content">

				<span class="be-comment-name">
					<strong>{{ auth()->user()->hasRole('staff')? 'Anonymous': $comment->user->name }}</strong>
				</span>
				<span class="be-comment-time">
					<i class="fa fa-clock-o"></i>
					{{ $comment->created_at->diffForHumans() }}
				</span>

				<p class="be-comment-text">
					{{ $comment->content }}
				</p>
			</div>
		</div>
		@endforeach
		{{ $comments->links() }}
		<div class="be-comment mb-3">
			<form action="{{ url('/ideas/add-comment/' . $idea->id) }}" method="POST">
				@csrf
				<div class="input-group">
					<input type="text" class="form-control rounded-corner" name="content" placeholder="Write a comment...">
					<span class="input-group-btn p-l-10">
						<button class="btn btn-primary f-s-12 rounded-corner pull-right" type="submit">Submit</button>
					</span>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection