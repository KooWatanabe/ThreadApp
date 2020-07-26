@section('header')
<header class="header">
    ゲーム攻略掲示板
    <!-- Right Side Of Navbar -->
    <!-- Authentication Links -->
    @auth
    <div class="logout-btn">
        <button class="btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ログアウト
        </button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <div class="logout-btn">
        <button class="btn" onclick="location.href='{{ route('home') }}'">
            ホーム
        </form>
    </div>
    @endauth
</header>
@endsection