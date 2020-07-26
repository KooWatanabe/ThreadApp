@extends('layouts.common')
@section('title', 'スレッド削除')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container delete-form">
    <div class="row">
            <div class="panel-heading">スレッド削除</div>
            <div class="panel-body">
                <div>
                    <p class="excuse">スレッドを削除します。<br>削除すると、全てのユーザーがスレッドを利用できなくなります。</p>
                </div>
                <div>
                    <p class='title'>タイトル　　{{ $thread_name}}</p>
                </div>
                <form class="form-horizontal" method="POST"
                action="{{ route('threadDelete', ['thread_id' => $thread_id]) }}">
                    {{ csrf_field() }}
                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit">
                            削除
                        </button>
                    </div>
                </form>
            </div>
    </div>
</div>
@endsection