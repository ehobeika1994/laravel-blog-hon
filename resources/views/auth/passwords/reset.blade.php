@extends('main')

@section('title', 'Reset my password')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-heading">Reset Password</div>
			
			<div class="panel-body">
				
				{!! Form::open(['url' => 'password/reset', 'method' => "post"]) !!}
				
				{{ Form::hidden('token', $token) }}
				
				{{ Form::label('email', 'Email Address:') }}
				{{ Form::email('email', $email, ['class' => 'form-control']) }}
				
				{{ Form::label('password', 'New Password:') }}
				{{ Form::password('password', ['class' => 'form-control']) }}
				
				{{ Form::label('password_confirmation', 'Password:') }}
				{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
				
				{{ Form::submit('Reset Password', ['class' => 'btn btn-primary btn-h1-spacing']) }}
				
				{!! Form::close() !!}
				
			</div>
		</div>
	</div>
</div>

@endsection