@extends('adminlte::page')

@section('title', '登録画面')

@section('content_header')

@stop
<style>
    label {
        text-indent: 1rem;
        }
    .items {
        padding-top: 100px;
        margin: 0 auto;
        }
    .form-group.item {
        margin-bottom: 1rem;
    }
    .btn {
        margin-top: 30px;
        padding: 5px 60px;
        }
    </style>

@section('content')
    <div class="items col-md-6">
        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
            <h1>登録画面</h1>

            <div class="card card-primary">
                <form method="POST">
                    @csrf
                    <div class="card-body">

                        <div class="form-group item">
                            <label for="name">名前</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="名前" value="{{old('name')}}">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
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
                            @error('stock')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明">
                            @error('detail')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <!-- 編集ボタン -->
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>


        </form>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
