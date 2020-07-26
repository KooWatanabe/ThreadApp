<DOCTYPE HTML lang="{{ app()->getLocale() }}">
<html lang="ja">
<head>
@yield('head')
</head>
<body>
@yield('header')
<div class="contents">
    <div class="main">
        @yield('content')
    </div>
</div>
</body>
</html>