@extends('layouts.common')
@section('title', 'ホーム')
@include('layouts.head')
@include('layouts.header')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">スレッド一覧</div>
                <div>
                    @if ($create_flg === true)
                        <p><strong>！！！スレッドを作成しました！！！</strong></p>
                    @endif
                </div>
                <div class='thread-create'>
                    <button class="btn btn-primary" onclick="location.href='{{ route('threadCreate') }}'">スレッドを作成する</button>
                </div>
                <div class="panel-body">
                    @if ($flg === true)
                        <table>
                            <tr>
                                <th class="id">ID</th>
                                <th class="name">スレッド名</th>
                                <th class="create">作成日時</th>
                                <th class="update">更新日時</th>
                            </tr>
                            @foreach ($threads as $thread)
                            <tr>
                                <td class="id">{{ $thread->id }}</td>
                                <td class="name"><a href="{{ route('thread', ['thread_id' => $thread->id]) }}">
                                    {{ $thread_datas[strval($thread->id)]['name'] }}</a></td>
                                <td class="create">{{ $thread_datas[$thread->id]['create'] }}</td>
                                <td class="update">{{ $thread_datas[$thread->id]['update'] }}</td>
                            </tr>
                            @endforeach
                        </table>
                        @if ($threads->lastPage() > 1)
                        <ul class="pagination">
                            <li class="page-item {{ ($threads->currentPage() == 1) ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $threads->url(1) }}"><<</a>
                            </li>
                            <li class="page-item {{ ($threads->currentPage() == 1) ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $threads->url($threads->currentPage()-1) }}">
                                    <span aria-hidden="true"><</span>
                                    {{-- Previous --}}
                                </a>
                            </li>
                            <li class="page-item">
                                <p>{{ $threads->currentPage().'/'.$threads->lastPage().'ページ' }}</p>
                            </li>
                            <li class="page-item {{ ($threads->currentPage() == $threads->lastPage()) ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $threads->url($threads->currentPage()+1) }}" >
                                    <span aria-hidden="true">></span>
                                    {{-- Next --}}
                                </a>
                            </li>
                            <li class="page-item {{ ($threads->currentPage() == $threads->lastPage()) ? ' disabled' : '' }}">
                                <a class="page-link" href="{{ $threads->url($threads->lastPage()) }}">>></a>
                            </li>
                        </ul>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
