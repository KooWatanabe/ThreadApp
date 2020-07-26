@section('head')
<meta charset="UTF-8">
<title>@yield('title')</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <link href="/css/app.css" rel="stylesheet"> -->
<link href="/css/threadapp.css" rel="stylesheet">
@yield('pageCss')
@endsection