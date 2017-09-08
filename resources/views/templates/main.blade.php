<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chatty</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
		@include('templates.partials.nav')
	<div class="container">
		@include('templates.partials.alert')
		@yield('content')
	</div>
</body>
</html>