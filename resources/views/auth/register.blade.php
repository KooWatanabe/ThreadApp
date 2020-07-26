@extends('layouts.common')
@section('title', '会員登録')
@include('layouts.head')
@include('layouts.header')
@section('content')
<div class="container register-form">
    <div class="row">
            <div>
                <div class="panel-heading">ユーザー登録</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('confirm') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('login_id') ? ' has-error' : '' }}">
                            <label for="login_id" class="form-label">ログインID</label>
                            <input id="login_id" type="text" class="form-text" name="login_id"
                            value="{{ old('login_id') }}" placeholder="必須/半角英数/12文字以内"　required autofocus>
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
                            <input id="password" type="password" class="form-text" name="password"
                            placeholder="必須/半角英数/8文字以上12文字以内" required>
                            <div class="error-message">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                            <label for="nickname" class="form-label">ニックネーム</label>
                            <input id="nickname" type="text" class="form-text" name="nickname"
                            placeholder="任意/12文字以内" value="{{ old('nickname') }}" required>
                            <div class="error-message">
                            @if ($errors->has('nickname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nickname') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>

                        <div class="form-group form-submit">
                            <button type="submit" class="btn btn-primary">
                                確認
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
