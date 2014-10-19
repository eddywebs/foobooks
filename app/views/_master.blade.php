<!-- app/views/index.blade.php -->
<html>
<head>
	<title>foo books</title>
</head>
<body>
	<h1>welcome to foo books</h1>
	@yield('content')
	<br>
	{{ Form::open(array('url' => '/list', 'method' => 'GET')) }}
		{{ Form::label('query', 'Search')}}
		{{ Form::text('query')}}
		{{ Form::submit('Search') }}
		{{ Form::close() }}
</body>
</html>