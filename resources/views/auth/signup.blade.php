@extends('templates.main')


@section('content')
	<div class="row">
		<div class="col-lg-6">
			<h3>Sign Up</h3>
			<form action="{{ route('auth.signup') }}" method="POST">
				{{ csrf_field() }}

				<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" placeholder="Choose your username"value="{{ old('username') }}">
					@if( $errors->has('username'))
						<span class="text text-danger">{{ $errors->first('username') }}</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control" placeholder="Choose your email" value="{{ old('email') }}">
					@if( $errors->has('email'))
						<span class="text text-danger">{{ $errors->first('email') }}</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Your password">
					@if( $errors->has('password'))
						<span class="text text-danger">{{ $errors->first('password') }}</span>
					@endif
				</div>

				<div class="form-group">
					<button class="btn btn-success">Sign Up</button>
				</div>
			</form>
		</div>
	</div>

@stop

