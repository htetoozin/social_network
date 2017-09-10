@extends('templates.main')


@section('content')

<h3>Your serch for "{{ request()->input('query') }}"</h3>

<div class="row">
	<div class="col-lg-12">

		@if(!$users->count())
			<p>No results found. Sorry!</p>
		@else

			@foreach($users as $user)
				@include('users.partials.userblock')
			@endforeach

		@endif
		
	</div>
</div>

@endsection