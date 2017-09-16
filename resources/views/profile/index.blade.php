@extends('templates.main')


@section('content')
	<div class="row">
		<div class="col-lg-5">
			@include('users.partials.userblock')
			<hr>

			@if(! $statuses->count())
			<p>{{ $user->getFirstNameOrUsername() }} has post anything yet.</p>
		@else
			@foreach($statuses as $status)
				<div class="media">
					<a class="pull-left" href="{{ route('profile.index', $status->user->username) }}">
						<img class="media-object" src="{{ $status->user->getAvatorUrl() }}" alt="{{ $status->user->getNameOrUsername() }}">
					</a>
					<div class="media-body">
						<h4 class="media-heading">
							<a href="{{ route('profile.index', $status->user->username) }}">{{ $status->user->getNameOrUsername() }}</a>
						</h4>
						<p>{{ $status->body }}</p>
						<ul class="list-inline">
							<li>{{ $status->created_at->diffForHumans() }}</li>
						</ul>

						@foreach($status->replies as $reply)
							<div class="media">
								<a class="pull-left" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
									<img class="media-object" src="{{ $reply->user->getAvatorUrl() }}" alt="{{ $reply->user->getNameOrUsername() }}">
								</a>
								<div class="media-body">
									<h5 class="media-heading">
										<a href="{{ route('profile.index', ['username' => $reply->user->username ]) }}">{{ $reply->user->getNameOrUsername() }}</a>
									</h5>
									<p>{{ $reply->body }}</p>
									<ul class="list-inline">
										<li>{{ $reply->created_at->diffForHumans() }}</li>
										@if($reply->user->id !== auth()->user()->id)
											<li><a href="{{ route('status.like', ['statusId' => $reply->id]) }}">Likes</a></li>
											<li>4 Likes</li>
										@endif	
									</ul>
								</div>
							</div>
						@endforeach

						@if($authUserIsFriend || auth()->user()->id === $status->user->id)
							<form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="POST">
								{{ csrf_field() }}
								<div class="form-group {{ $errors->has("reply-{$status->id}") ? 'has-error' : ''}}">
									<textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this status"></textarea>

									@if($errors->has("reply-{$status->id}"))
										<span class="text text-danger">{{ $errors->first('reply-{$status->id}') }}</span>
									@endif
								</div>
								<button class="btn btn-primary btn-sm">Reply</button>
							</form>
						@endif	
					</div>
				</div>
			@endforeach
		@endif
		</div>

		<div class="col-lg-4 col-lg-offset-3">
			@if(Auth::user()->hasFriendRequestPending($user))
				<p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
			@elseif(Auth::user()->hasFriendRequestReceived($user))
				<a href="{{ route('friend.accept', $user->username) }}" class="btn btn-primary">Accept friend request</a>
			@elseif(Auth::user()->isFriendWith($user))
				<p>You and {{ $user->getNameOrUsername() }} are friends.</p>
			@elseif(Auth::user()->id !== $user->id)
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