@extends('layouts.common')
@section('title', 'コメント編集')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel-heading">コメント編集</div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST"
            action="{{ route('commentFix', ['thread_id' => $thread_id, 'comment_id' => $comment_id]) }}">
                {{ csrf_field() }}

                <div class="post-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                    <label for="comment"></label>
                    <textarea id="comment" name="comment" value="{{ old('comment') }}"
                        cols="80" rows="5" required autofocus></textarea>
                    <div class="error-message">
                    @if ($errors->has('comment'))
                        <span class="help-block">
                            <strong>{{ $errors->first('comment') }}</strong>
                        </span>
                    @endif
                    </div>
                </div>
                <input type="hidden" name="thread_id" value="{{ $thread_id }}">
            <div class="post-group">
                    <button type="submit" class="btn btn-submit">
                        編集
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection