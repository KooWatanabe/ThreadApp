@extends('layouts.common')
@section('title', 'ログイン')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container login-form">
    <div class="row">
        <div>
            <p class="excuse">
            ゲーム攻略掲示板へようこそ! <br>この掲示板は会員制です。<br>掲示板を利用するにはログインしてください。
            </p>
            <div class="panel-heading">ログイン</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('login_id') ? ' has-error' : '' }}">
                        <label for="login_id" class="form-label">ログインID</label>
                        <input id="login_id" type="text" class="form-text" name="login_id" value="{{ old('login_id') }}" required autofocus>
                        <div class="error-message">
                        @if ($errors->has('login_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('login_id') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="form-label">パスワード</label>
                        <input id="password" type="password" class="form-text" name="password" required>
                        <div class="error-message">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group form-submit">
                        <button type="submit" class="btn btn-submit">
                            ログイン
                        </button>
                    </div>
                </form>
                <div class="panel-heading inline">アカウントをお持ちでない方</div>
                <p>ユーザー登録してください</p>
                <button class="btn btn-submit" onclick="location.href='{{ route('register') }}'">ユーザー登録</button>
            </div>
        </div>
    </div>
</div>
@endsection
