@extends('templates.main')


@section('content')
	<div class="row">
		<div class="col-lg-6">
			<h3>Sign In</h3>
			<form action="{{ route('auth.signin') }}" method="POST">
				{{ csrf_field() }}

				<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control">
					@if( $errors->has('email'))
						<span class="text text-danger">{{ $errors->first('email') }}</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control">
					@if( $errors->has('password'))
						<span class="text text-danger">{{ $errors->first('password') }}</span>
					@endif
				</div>

				<div class="form-group">
					<label>
						<input type="checkbox" name="remember"> Remember Me
					</label>
				</div>

				<div class="form-group">
					<button class="btn btn-success">Sign In</button>
				</div>
			</form>
		</div>
	</div>

@stop

