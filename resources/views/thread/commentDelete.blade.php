@extends('layouts.common')
@section('title', 'コメント削除')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container delete-form">
    <div class="row">
        <div class="panel-heading">コメント削除</div>
        <div class="panel-body">
            <div>
                <p>コメントを削除します。</p>
            </div>
            <div class="comment-box">
                <p>{{ $comment->comment }}</p>
            </div>
            <form class="form-horizontal" method="POST"
            action="{{ route('commentDelete', ['thread_id' => $thread_id, 'comment_id' => $comment->id]) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="form-submit">
                        <button type="submit" class="btn btn-submit">
                            削除
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection