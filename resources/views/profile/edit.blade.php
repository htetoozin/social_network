@extends('templates.main')


@section('content')
<h3>Update Your Profile</h3>

<div class="row">
	<div class="col-lg-6">
		<form action="{{ route('profile.edit') }}" method="POST">
			{{ csrf_field() }}

			<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
				<label for="first_name">First Name</label>
				<input type="text" name="first_name" class="form-control" value="{{ request()->old('first_name') ?: auth()->user()->first_name }}">

				@if($errors->has('first_name'))
					<span class="text text-danger">{{ $errors->first('first_name') }}</span>
				@endif
			</div>
			<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
				<label for="last_name">Last Name</label>
				<input type="text" name="last_name" class="form-control" value="{{ request()->old('last_name') ?: auth()->user()->last_name }}">
				@if($errors->has('last_name'))
					<span class="text text-danger">{{ $errors->first('last_name') }}</span>
				@endif
			</div>
			<div class="form-group {{ $errors->has('location') ? 'has-error' : ''}}">
				<label for="location">Location</label>
				<input type="text" name="location" class="form-control" value="{{ request()->old('location') ?: auth()->user()->location }}"> 
				@if($errors->has('location'))
					<span class="text text-danger">{{ $errors->first('location') }}</span>
				@endif
			</div>
			<button class="btn btn-success">Update</button>
		</form>
	</div>
</div>


@stop