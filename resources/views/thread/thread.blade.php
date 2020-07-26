@extends('layouts.common')
@section('title', 'スレッド:'.$thread_name)
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">{{ $thread_name }}</div>
            <div class="panel-body">
                @if ($comments->count() !== 0)
                    <table>
                        <tr>
                        @foreach ($comments as $comment)
                            <td class="id">{{ $comment->id.':' }}</td>
                            <td class="comment">{{ $comment->comment }}</td>
                            <td class="create">{{ $comment->created_at }}</td>
                            @if ($comment->account_id === $account_id)
                            <td class="btn-td">
                                <button class="btn btn-primary"
                                onclick="location.href='{{ route('commentFix', ['Thread_id' => $thread_id, 'comment_id' => $comment->id]) }}'">
                                編集</button>
                                <button class="btn btn-primary"
                                onclick="location.href='{{ route('commentDelete', ['Thread_id' => $thread_id, 'comment_id' => $comment->id]) }}'">
                                削除</button>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </table>
                    @if ($comments->lastPage() > 1)
                    <ul class="pagination">
                        <li class="page-item {{ ($comments->currentPage() == 1) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $comments->url(1) }}"><<</a>
                        </li>
                        <li class="page-item {{ ($comments->currentPage() == 1) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $comments->url($comments->currentPage()-1) }}">
                                <span aria-hidden="true"><</span>
                                {{-- Previous --}}
                            </a>
                        </li>
                        <li class="page-item">
                            <p>{{ $comments->currentPage().'/'.$comments->lastPage().'ページ' }}</p>
                        </li>
                        <li class="page-item {{ ($comments->currentPage() == $comments->lastPage()) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $comments->url($comments->currentPage()+1) }}" >
                                <span aria-hidden="true">></span>
                                {{-- Next --}}
                            </a>
                        </li>
                        <li class="page-item {{ ($comments->currentPage() == $comments->lastPage()) ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $comments->url($comments->lastPage()) }}">>></a>
                        </li>
                    </ul>
                    @endif
                @endif
            </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="inline">
            <div class="panel-heading commnet-post">コメント投稿</div>
            <div class="panel-body">
            @if ($dont_write === false)
                <form class="form-horizontal" method="POST"
                action="{{ route('post', ['thread_id' => $thread_id]) }}">
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
                    <div class="post-group">
                        <button type="submit" class="btn btn-submit">
                            投稿
                        </button>
                    </div>
                </form>
            @else
                <div class="panel-body">
                    <p>これ以上コメントを投稿できません。</p>
                    <button class="btn btn-primary" type="submit" disabled>投稿</button>
                </div>
            @endif
            @if ($create_flg === true)
                <div class="deleteButton">
                    <button class="btn btn-primary"
                        onclick="location.href='{{ route('threadDelete', ['thread_id' => $thread_id]) }}'">
                    スレッド削除</button>
                </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
