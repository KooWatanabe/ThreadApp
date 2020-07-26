@extends('layouts.common')
@section('title', '会員登録')
@include('layouts.head')
@include('layouts.header')
@section('content')
<div class="container register-form">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><h2>ユーザー登録</h2></div>
            <div class="panel-heading"><h3>以下の内容で登録します</h3></div>


            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="confilm-group">
                        <label for="login_id" class="form-label">ログインID</label>
                        <div class="confilm-text">{{ $login_id }}</div>
                        <input id="login_id" type="hidden" name="login_id" value="{{ $login_id }}" required>
                    </div>

                    <div class="confilm-group">
                        <label for="password" class="form-label">パスワード</label>
                        <div class="confilm-text">{{ str_repeat('*', mb_strlen($password)) }}</div>
                        <input id="password" type="hidden" name="password" value="{{ $password }}" required>
                    </div>

                    <div class="confilm-group">
                        <label for="nickname" class="form-label">ニックネーム</label>
                        <div class="confilm-text">{{ $nickname }}</div>
                        <input id="nickname" type="hidden" class="form-control" name="nickname" value="{{ $nickname }}" required>
                    </div>

                    <div class="confilm-group">
                        <button type="submit" class="btn btn-submit">
                            登録
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection