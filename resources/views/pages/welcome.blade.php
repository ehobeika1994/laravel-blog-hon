@extends('main')

@section('stylesheets')
	<link rel="stylesheet" type="text/css" href="css/style.css">
@endsection

@section('title', 'Home')

@section('content')
	    <div class="row">
		    <div class="col-md-12">
				<div class="jumbotron">
				  <h1>Welcome to my blog!</h1>
				  <p class="lead">Thank you for visiting. This is my test website built with Laravel. Please read my Popular post!</p>
				  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
				</div>
		    </div>
	    </div> <!-- end of hader .row -->
	    
	    <div class="row">
		    <div class="col-md-8">
			    @foreach($posts as $post)
					<div class="post">
						<h3>{{ $post->title }}</h3>
						<p>{{ substr(strip_tags($post->body),0,300) }}{{ strlen(strip_tags($post->body)) > 300 ? '....' : '' }}</p>
						<a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read more</a>
					</div>
					<hr>
				@endforeach
		    </div>
	    </div>
@endsection

@section('scripts')
	<script src="js/scripts.js"></script>
@endsection