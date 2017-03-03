@extends('main')

@section('title', ' Edit Post')

@section('stylesheets')
	{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

	<div class="row">
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
		<div class="col-md-8">	
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
			
			{{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
			{{ Form::text('slug', null, ['class' => 'form-control']) }}
			
			{{ Form::label('category_id', "Category:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
			
			{{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}
			
			{{ Form::label('tag_id', "Tags:", ['class' => 'form-spacing-top']) }}
			{{ Form::select('tag_id[]', $tags, null, ['class' => 'form-control select2-multi',  'multiple' => 'multiple']) }}
		</div>
		
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Updated At:</dt>
					<dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Post By:</dt>
					<dd>Edmond Hobeika</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div><!-- end of .row (form) -->
@endsection

@section('scripts')

	{!! Html::script('js/select2.min.js') !!}
	
	<script type="text/javascript">
		$('.select2-multi').select2();
		// display tags in edit
		$('.select2-multi').select2().val(
			{!! json_encode($post->tags()->getRelatedIds()) !!}			
		).trigger('change');	
	</script>
@endsection