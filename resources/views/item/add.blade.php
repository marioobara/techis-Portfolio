@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="名前" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <select type="text" name="type" class="form-control" required>
                                @foreach (Config::get('const.type') as $key => $val)
                                    <option value="{{ $key }}" @if( old('type')== $key) selected @endif>{{ $val }}</option>
                                @endforeach
                                @error('type')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫</label>
                            <input type="text" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" placeholder="在庫数" value="{{old('stock')}}">
                        </div>
                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
