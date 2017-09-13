@extends('templates.main')


@section('content')
<div class="row">
	<div class="col-lg-6">
		<form action="{{ route('status.post') }}" method="POST">
			{{ csrf_field() }}
			<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
				<textarea name="status"  rows="3" class="form-control" placeholder="What's up {{ Auth::user()->getFirstNameOrUsername() }}?"></textarea>

				@if($errors->has('status'))
					<span class="text text-danger">{{ $errors->first('status') }}</span>

				@endif
			</div>
			<button class="btn btn-primary">Update Status</button>
		</form>
		<hr>
	</div>

	<div class="col-lg-5">
		<!-- Timeline Status and Replies-->
	</div>
</div>


@stop