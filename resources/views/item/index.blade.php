@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
    <div class="text-right">
        <form action="{{ route('posts.index') }}" method="GET">
          名前を入力<input type="text" name="keyword" value="">
          <input type="submit" value="検索">
        </form>
      </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            @can('isAdmin')
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                @can('isAdmin')
                                <!-- 編集・操作列表示 -->
                                <th>編集</th>
                                <th>操作</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="type">{{config('const.type.'.$item -> type)}}</td>
                                    <td>{{ $item->detail }}</td>
                                    @can('isAdmin')
                                    <!-- 編集・削除ボタン追加 -->
                                    <td><a href="/edit/{{ $item->id }}">編集</td>
                                    <td>
                                    <form action="{{ url('items/delete')}}" method="POST" onsubmit="return confirm('削除します。宜しいですか？');">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="submit" value="削除" class="btn btn-danger">
                                    </form>
                                    </td>
                                     @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
