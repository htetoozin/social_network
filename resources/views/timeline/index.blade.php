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
</div>

<div class="row">
	<div class="col-lg-5">
		@if(! $statuses->count())
			<p>There's is nothing your timeline yet.</p>
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
							<li><a href="#">Like</a></li>
							<li>10 Likes</li>
						</ul>
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
					</div>
				</div>
			@endforeach
		@endif
	</div>
</div>


@stop