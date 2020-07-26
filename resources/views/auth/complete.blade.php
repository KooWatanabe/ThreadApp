@extends('layouts.common')
@section('title', '登録完了')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">ユーザー登録</div>
        <p>
            ユーザー登録が完了しました。<br>
            掲示板をご利用ください!
        </p>
        <button class="btn btn-primary" onclick="location.href='{{ route('home') }}'">掲示板へ</button>
    </div>
</div>
@endsection
