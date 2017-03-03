@extends('main')

@section('title', 'Edit Tags')

@section('content')

<div class="row">
	<div class="col-md-3">
			{!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}
			
			{{ Form::label('name', 'name') }}
			{{ Form::text('name', null, ['class' => 'form-control']) }}
			
			{{ Form::submit('Edit Tag', ['class' => 'btn btn-success btn-block btn-h1-spacing']) }}
			
			{!! Form::close() !!}
		</div>
	</div>
</div>

@endsection