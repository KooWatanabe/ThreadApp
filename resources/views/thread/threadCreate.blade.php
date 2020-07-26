@extends('layouts.common')
@section('title', 'スレッド作成')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container create-form">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">スレッド作成</div>
                <p>
                    作成するスレッドの情報を入力してください。
                </p>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('threadCreate') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="form-label">タイトル</label>
                            <input id="title" type="text" class="form-text" name="title" value="{{ old('title') }}" required autofocus>
                            <div class="error-message"
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-submit">
                            <button type="submit" class="btn btn-submit">
                                作成
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection