@extends('templates.main')


@section('content')
	<div class="row">
		<div class="col-lg-5">
			@include('users.partials.userblock')
			<hr>
		</div>

		<div class="col-lg-4 col-lg-offset-3">
			<h4>{{ $user->getNameOrUsername() }}'s friends</h4>

			@if(!$user->friends()->count())
				<p>{{ $user->getNameOrUsername() }}'s no friends</p>

			@else
				@foreach($user->friends() as $user)
					@include('users.partials.userblock')
				@endforeach
			@endif
		</div>
	</div>

@stop