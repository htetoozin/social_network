@extends('templates.main')


@section('content')
	<div class="row">
		<div class="col-lg-5">
			@include('users.partials.userblock')
			<hr>
		</div>

		<div class="col-lg-4 col-lg-offset-3">
			@if(Auth::user()->hasFriendRequestPending($user))
				<p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
			@elseif(Auth::user()->hasFriendRequestReceived($user))
				<a href="#" class="btn btn-primary">Accept friend request</a>
			@elseif(Auth::user()->isFriendWith($user))
				<p>You and {{ $user->getNameOrUsername() }} are friends.</p>
			@else
				<a href="{{ route('friend.add', $user->username) }}" class="btn btn-primary">Add as friend</a>	
			@endif
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