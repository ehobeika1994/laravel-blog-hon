@extends('main')

@section('title', ' View Post')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
	
			<p class="lead">{{ $post->body }}</p>
			
			<hr>
			
			<div class="tags">
				@foreach ($post->tags as $tag)
					<span class="label label-default">{{ $tag->name }}</span>
				@endforeach
			</div>
			
			<div class="" id="backend-comments" style="margin-top: 50px;">
				<h3>Comments <small>{{ $post->comments()->count() }}</small></h3>
				
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comment</th>
							<th width="70px"></th>
						</tr>
					</thead>
					
					<tbody>
						@foreach($post->comments as $comment)
						<tr>
							<td>{{ $comment->name }}</td>
							<td>{{ $comment->email }}</td>
							<td>{{ $comment->comment }}</td>
							<td>
								<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
								<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="col-md-4">
			<div class="well">
				<dl>
					<dt>URL Slug:</dt>
					<dd><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></dd>
				</dl>
				<dl>
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>
				<dl>
					<dt>Updated At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
				<dl>
					<dt>Category:</dt>
					<dd>{{ $post->category->name }}</dd>
				</dl>
				<dl>
					<dt>Posted By:</dt>
					<dd>{{ $post->user->name }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
							{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
						{!! Form::close() !!}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						{{ Html::linkRoute('posts.index', 'See all posts', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection